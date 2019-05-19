<?php

namespace SoheilY98\TelegramBot\Contracts;

use SoheilY98\TelegramBot\Entities\BotRequest;
use SoheilY98\TelegramBot\Entities\BotResponse;

abstract class BotRequestHandler
{
    /** @var $pattern string */
    protected $pattern;

    /** @var $matches array */
    private $matches = [];

    abstract public function handle(BotRequest $botRequest): BotResponse;

    public function matches(BotRequest $botRequest): bool
    {
        return preg_match($this->pattern, $botRequest->payload->message->text);
    }
}
