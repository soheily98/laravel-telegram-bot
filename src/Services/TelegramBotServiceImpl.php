<?php

namespace SoheilY98\TelegramBot\Services;

use SoheilY98\TelegramBot\Contracts\TelegramBotService;
use SoheilY98\TelegramBot\Entities\Message;
use SoheilY98\TelegramBot\Entities\TelegramRequest;

class TelegramBotServiceImpl implements TelegramBotService
{
    public function request(): TelegramRequest
    {
        $telegramRequest = new TelegramRequest();

        $message = new Message();
        $message->text = "ABC";

        $telegramRequest->message = $message;

        return $telegramRequest;
    }
}