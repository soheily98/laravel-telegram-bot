<?php

namespace SoheilY98\TelegramBot\Contracts;

use SoheilY98\TelegramBot\Entities\TelegramRequest;

interface TelegramBotService
{
    public function request(): TelegramRequest;
}