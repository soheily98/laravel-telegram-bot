<?php

namespace SoheilY98\TelegramBot\Contracts;

use SoheilY98\TelegramBot\Contracts\TelegramRequest;

abstract class TelegramRequestHandler
{
    /** @var $pattern string */
    private $pattern;

    /** @var $matches array */
    private $matches;

    abstract public function handle(TelegramRequest $request);
}