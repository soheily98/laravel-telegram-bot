<?php

namespace SoheilY98\TelegramBot\Services;

use SoheilY98\TelegramBot\Contracts\TelegramBotService;
use SoheilY98\TelegramBot\Entities\Telegram\Message;
use SoheilY98\TelegramBot\Entities\Telegram\Update;
use SoheilY98\TelegramBot\Entities\TelegramRequest;

class TelegramBotServiceImpl implements TelegramBotService
{
    /** @var TelegramRequest $telegramRequest */
    private $telegramRequest;

    public function request(): TelegramRequest
    {
        if (!isset($this->telegramRequest)) {
            $update = new Update();

            $message = new Message();
            $message->text = "ABC";

            $update->message = $message;

            $telegramRequest = new TelegramRequest();
            $telegramRequest->update = $update;

            $this->telegramRequest = $telegramRequest;
        }

        return $this->telegramRequest;
    }
}