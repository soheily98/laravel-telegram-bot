<?php

namespace SoheilY98\TelegramBot\Controllers;

use Illuminate\Support\Facades\Request;
use SoheilY98\TelegramBot\Contracts\TelegramBotService;

class TelegramController
{
    /** @var array $handlers */
    private $handlers = [];

    public function hook(Request $request, TelegramBotService $botService)
    {
        foreach (glob(app_path('/Telegram/Handlers/') . '*.php') as $filename) {
            $className = explode('/', $filename);
            $className = end($className);
            $className = explode(".", $className)[0];
            $className = app()->getNamespace() . "Telegram\Handlers\\" . $className;

            $handlerClass = new $className();
            $this->handlers[] = $handlerClass;
        }
    }
}