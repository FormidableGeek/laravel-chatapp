<footer class="footer">
        <a href="{{route('chat.index')}}"><i class="fas fa-home"></i></a>
        <button class="search-trigger"> 
            <i class="fas fa-plus"></i>
            <p>New Chat</p>
        </button>
        <a href="{{route('profile')}}"><i class="fas fa-user"></i></a>

</footer>
<div class="modal">
    <div class="modal-content flex-center scrollable">
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <form class="profile-form ">
            <input type="search" name="search" id="search">
            <ul class="search-result"></ul>

        </form>
    </div>
</div>
<script src='{{asset("assets/js/app.js")}}'></script>
    