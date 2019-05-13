<?php

namespace SoheilY98\TelegramBot\Controllers;

use Illuminate\Support\Facades\Request;
use SoheilY98\TelegramBot\Contracts\TelegramBotService;
use SoheilY98\TelegramBot\Contracts\TelegramRequestHandler;

class TelegramController
{
    /** @var array $handlers */
    private $handlers = [];

    public function hook(Request $request, TelegramBotService $botService)
    {
        $telegramRequest = $botService->request();

        foreach (glob(app_path('/Telegram/Handlers/') . '*.php') as $filename) {
            $className = explode('/', $filename);
            $className = end($className);
            $className = explode(".", $className)[0];
            $className = app()->getNamespace() . "Telegram\Handlers\\" . $className;

            /** @var TelegramRequestHandler $handlerClass */
            $handlerClass = new $className();

            if ($handlerClass->matches($telegramRequest)) {
                return "Found.";
            }

            $this->handlers[] = $handlerClass;
        }

        return "Not Found.";
    }
}