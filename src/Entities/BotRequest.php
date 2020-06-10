<?php

namespace SoheilY98\TelegramBot\Entities;

class BotRequest
{
    /**
     * @var mixed $payload
     */
    public $payload;

    /**
     * BotRequest constructor.
     * @param mixed $payload
     */
    public function __construct($payload)
    {
        $this->payload = $payload;
    }
}
