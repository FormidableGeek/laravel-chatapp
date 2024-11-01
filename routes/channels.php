<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('send-message.{chatId}', function () {
   return true;
});
