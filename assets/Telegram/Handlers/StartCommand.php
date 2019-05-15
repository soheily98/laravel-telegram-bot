<?php

namespace App\Telegram\Handlers;

use SoheilY98\TelegramBot\Contracts\BotRequestHandler;
use SoheilY98\TelegramBot\Entities\BotRequest;
use SoheilY98\TelegramBot\Entities\BotResponse;

class StartCommand extends BotRequestHandler
{
    public $pattern = '/^\/start$/is';

    public function handle(BotRequest $botRequest): BotResponse
    {
        // TODO: Implement handle() method.

        return new BotResponse('sendMessage', [
            'chat_id' => $botRequest->payload->message->from->id,
            'text' => 'Hello!'
        ]);
    }
}
