<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('favicon.svg')}}">
    <link rel="stylesheet" href="{{asset('assets/icons/fontawesome-free-6.6.0-web/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <title>Chats</title>
</head>
<body>
  
    <main class="chats-container">
       @include('layout.header')
        <section class="chats">
            <div class="chats-header">
            <h2>Chats</h2>
            <i class="fa-solid fa-ellipsis"></i>
            </div>
        </section>
        <section id="inbox-container" class="scrollable">
           <!-- <div class="chat">
                <div class="user-logo">
                    <img src="{{asset('assets/images/users/user-1.jpg')}}">
                </div>
                <div class="">
                    <h4>Martha Adama</h4>
                    <p>Hello, how are you?</p>
                </div>
                <div class="chat-time-detail">
                    <p class="chat-time">02:11</p>
                    <div class="chat-count">1</div>
                </div>
            </div> -->
        </section>
    </main>
    @include('layout.footer')
</body>
<script src='{{asset("assets/js/jquery-3.7.1.min.js")}}'></script>
<script src='{{asset("assets/js/inbox.js")}}'></script>
</html>