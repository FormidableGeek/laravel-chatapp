<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;


class UserController extends Controller
{
    public function __construct()
    {
        $this->user=auth()->user();
    }
    public function index()
    {
        return view('user.profile',$this->user);
    }

    public function showUsers(Request $request)
    {
        $result=User::where('name','like',"%$request->data%")
                ->whereNot('id',$this->user->id)
                ->get();
        return response()->json([
            'status'=>'success',
            'data'=>$result
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {
        $user = auth()->user();
        $currentPhotoPath = "user/" . $user->photo;
        
        // Start the DB transaction
        DB::beginTransaction();

        try {
            // Handle profile photo upload if a new photo is provided
            if ($request->file('photo')) {
                $newPhotoPath = $request->file('photo')->store('user');
                
                // Delete old photo if it exists and is not the default
                if (Storage::exists($currentPhotoPath) && $user->photo != 'default.png') {
                    Storage::delete($currentPhotoPath);
                }

                // Update user's photo
                $user->photo = basename($newPhotoPath);
            }

            // Update other user details
            $user->name = $request->name;
            if($this->user->email != $request->email && $request->filled('email')){
                $user->email = $request->email;
            }

            // Check if the password field is filled before updating
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            // Save the user and commit the transaction
            $user->save();
            DB::commit();

            
        } catch (\Exception $e) {
            // Rollback the transaction if there's any error
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }

        return view('user.profile',$this->user)->with('success', 'Profile updated successfully.');
    }

}
