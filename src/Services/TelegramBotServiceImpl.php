<?php

namespace SoheilY98\TelegramBot\Services;

use GuzzleHttp\Client;
use SoheilY98\TelegramBot\Contracts\BotRequestHandler;
use SoheilY98\TelegramBot\Contracts\TelegramBotService;
use SoheilY98\TelegramBot\Entities\BotRequest;
use SoheilY98\TelegramBot\Entities\BotResponse;

class TelegramBotServiceImpl implements TelegramBotService
{
    /**
     * @var array $handlers
     */
    private $handlers = [];

    /**
     * @var Client $client
     */
    private $client;

    /**
     * @var string $baseUrl
     */
    private $baseUrl;

    /**
     * TelegramBotServiceImpl constructor.
     */
    public function __construct()
    {
        $this->client = new Client([]);
        $this->baseUrl = "https://api.telegram.org/bot" . config('telegrambot.token') . "/";

        $this->registerHandlers();
    }

    public function handle(BotRequest $botRequest): BotResponse
    {
        /** @var BotRequestHandler $handler */

        foreach ($this->handlers as $handler) {
            if ($handler->matches($botRequest)) {
                return $handler->handle($botRequest);
            }
        }

        return new BotResponse('sendMessage', [
            'chat_id' => $botRequest->payload->message->chat->id,
            'text' => 'no match'
        ]);
    }

    public function __call($name, $arguments)
    {
        return $this->makeRequest($name, $arguments[0]);
    }

    public function makeRequest($method, $arguments)
    {
        $response = $this->client->post($this->baseUrl . $method, [
            'form_params' => $arguments
        ]);

        $json = json_decode($response->getBody());

        return $json;
    }

    private function registerHandlers()
    {
        foreach (glob(app_path('/Telegram/Handlers/') . '*.php') as $filename) {
            $className = explode('/', $filename);
            $className = end($className);
            $className = explode(".", $className)[0];
            $className = app()->getNamespace() . "Telegram\Handlers\\" . $className;

            /** @var BotRequestHandler $handlerClass */
            $handlerClass = new $className();

            $this->handlers[] = $handlerClass;
        }
    }
}
