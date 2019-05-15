<?php

namespace SoheilY98\TelegramBot\Controllers;

use SoheilY98\TelegramBot\Contracts\TelegramBotService;
use SoheilY98\TelegramBot\Contracts\BotRequestHandler;

class TelegramController
{
    public function hook(TelegramBotService $botService)
    {
        $telegramRequest = $botService->request();

        foreach (glob(app_path('/Telegram/Handlers/') . '*.php') as $filename) {
            $className = explode('/', $filename);
            $className = end($className);
            $className = explode(".", $className)[0];
            $className = app()->getNamespace() . "Telegram\Handlers\\" . $className;

            /** @var BotRequestHandler $handlerClass */
            $handlerClass = new $className();

            if ($handlerClass->matches($telegramRequest)) {
                $handlerClass->setBot($botService);
                return $handlerClass->handle($telegramRequest);
            }
        }

        return "Not Found.";
    }
}