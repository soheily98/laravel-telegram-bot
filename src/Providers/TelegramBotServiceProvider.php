<?php

namespace SoheilY98\TelegramBot\Providers;

use Illuminate\Support\ServiceProvider;
use SoheilY98\TelegramBot\Commands\MakeHandlerCommand;
use SoheilY98\TelegramBot\Contracts\TelegramBotService;
use SoheilY98\TelegramBot\Services\TelegramBotServiceImpl;

class TelegramBotServiceProvider extends ServiceProvider
{
    public function register()
    {
        $configPath = __DIR__ . '/../Config/telegrambot.php';

        $this->publishes(
            [
                $configPath => config_path('telegrambot.php'),
                __DIR__ . '/../../assets/Telegram/Handlers/' => app_path('/Telegram/Handlers/')
            ]
        );

        $this->mergeConfigFrom($configPath, 'telegrambot');

        $this->app->singleton(TelegramBotService::class, TelegramBotServiceImpl::class);
    }

    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeHandlerCommand::class
            ]);
        }
    }
}