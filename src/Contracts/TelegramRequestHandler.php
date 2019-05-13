<?php

namespace SoheilY98\TelegramBot\Contracts;

use SoheilY98\TelegramBot\Entities\TelegramRequest;

abstract class TelegramRequestHandler
{
    /** @var $pattern string */
    protected $pattern;

    /** @var $matches array */
    private $matches = [];

    /** @var $bot TelegramBotService */
    private $bot;

    /**
     * @param TelegramBotService $bot
     */
    public function setBot(TelegramBotService $bot)
    {
        $this->bot = $bot;
    }

    abstract public function handle(TelegramRequest $request);

    public function matches(TelegramRequest $request): bool
    {
        return preg_match($this->pattern, $request->update->message->text);
    }
}