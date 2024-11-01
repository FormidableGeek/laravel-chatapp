<?php

namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use App\Events\sendMessage;

class ChatController extends Controller
{
    //
    public function __construct()
    {
        $this->userId= (int)auth()->user()->id;
    }
    public function index()
    {
        return view('chat.index');
    }

    public function inbox()
    {
        // Number of results per page
        $perPage = 10;

        // Get the distinct conversations the current user has participated in, with pagination
        $paginatedConversations = Message::where('user_id', $this->userId)
            ->orWhere('receiver_id', $this->userId)
            ->select('conversation_id')
            ->distinct()
            ->paginate($perPage);

        $latestMessages = [];

        // Loop through the paginated conversations
        foreach ($paginatedConversations as $conversation) {
            // Retrieve the latest message in each conversation
            $latestMessage = Message::where('conversation_id', $conversation->conversation_id)
                ->orderBy('created_at', 'desc')
                ->first();

            if ($latestMessage) {
                // Determine the "other person" in the conversation
                $otherPersonId = ($latestMessage->user_id == $this->userId)
                    ? $latestMessage->receiver_id
                    : $latestMessage->user_id;

                // Fetch the other user's details from the users table
                $otherUser = User::find($otherPersonId);

                // Attach the other user details to the message
                $latestMessage->other_user = $otherUser;

                $latestMessages[] = $latestMessage;
            }
        }

        // Optionally, sort the messages by the latest message timestamp
        usort($latestMessages, function ($a, $b) {
            return strtotime($b->created_at) - strtotime($a->created_at);
        });

        // Return the paginated results with the latest messages
        $response= [
            'latest_messages' => $latestMessages,
            'pagination' => [
                'total' => $paginatedConversations->total(),
                'per_page' => $paginatedConversations->perPage(),
                'current_page' => $paginatedConversations->currentPage(),
                'last_page' => $paginatedConversations->lastPage(),
            ]
        ];
        return response()->json($response);
    }


    public function show()
    {

    }

    public function fetchMessages($id) 
    {
        $info['receiver']=User::find($id);
        $info['receiver']['chatId']=$this->generateChatID($this->userId,$id);
        $info['user_id']=$this->userId;
        return view('chat.chat',$info);
    }

    public function loadMessages($receiver_id)
    {
        
        $messages = Message::where(function($query) use ($receiver_id) {
                $query->where('user_id', $this->userId)
                    ->where('receiver_id', $receiver_id);
            })->orWhere(function($query) use ($receiver_id) {
                $query->where('user_id', $receiver_id)
                    ->where('receiver_id', $this->userId);
            })->orderBy('created_at', 'DESC')
            ->paginate(10);


        return response()->json($messages);
    }

    

    public function sendMessage(Request $request) 
    {
        
        $chatId=$this->generateChatID($this->userId,$request->receiver_id);

        $conversation=Conversation::firstOrCreate(['conversation_id'=>$chatId],['conversation_id'=>$chatId]);

        $message = Message::create([
            'user_id'=>$this->userId,
            'message' => $request->message,
            'receiver_id' => $request->receiver_id,
            'conversation_id'=>$chatId

        ]);

        broadcast(new sendMessage($message,$chatId))->toOthers();
        return response()->json(['status' => 'Message Sent!', 'message' => $message]);
    }

    private function generateChatID($user_id,$receiver_id)
    {
        $ids=[$user_id,(int)$receiver_id];
        sort($ids);
        $chatId=hash('sha256',$ids[0].$ids[1]);
        return $chatId;
    }

}
