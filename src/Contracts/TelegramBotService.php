<?php

namespace SoheilY98\TelegramBot\Contracts;

use SoheilY98\TelegramBot\Entities\BotRequest;
use SoheilY98\TelegramBot\Entities\BotResponse;

interface TelegramBotService
{
    public function handle(BotRequest $botRequest): BotResponse;
}
