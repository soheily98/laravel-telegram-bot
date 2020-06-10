<?php

namespace SoheilY98\TelegramBot\Entities;

class BotResponse
{
    public $method;
    public $arguments;

    /**
     * BotResponse constructor.
     * @param $method
     * @param $arguments
     */
    public function __construct($method, $arguments)
    {
        $this->method = $method;
        $this->arguments = $arguments;
    }
}
