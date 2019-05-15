<?php

namespace SoheilY98\TelegramBot\Commands;

use Illuminate\Console\Command;
use SoheilY98\TelegramBot\Contracts\TelegramBotService;
use SoheilY98\TelegramBot\Entities\BotRequest;
use SoheilY98\TelegramBot\Entities\BotResponse;

class TelegramPollCommand extends Command
{
    /**
     * @var TelegramBotService $botService
     */
    private $botService;

    /**
     * @var int $latestUpdateId
     */
    private $latestUpdateId = 0;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'telegram:poll';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the Telegram\'s Poll Worker.';

    /**
     * Execute the console command.
     *
     * @param TelegramBotService $botService
     * @return mixed
     */
    public function handle(TelegramBotService $botService)
    {
        $this->botService = $botService;

        $this->loop();
    }

    private function loop()
    {
        while (true) {
            $this->handleNewMessages();
            usleep(500);
        }
    }

    private function handleNewMessages()
    {
        $response = $this->botService->getUpdates([
            'offset' => $this->latestUpdateId + 1
        ]);

        if (count($response->result) > 0) {
            $this->latestUpdateId = $response->result[count($response->result) - 1]->update_id;

            foreach ($response->result as $update) {
                $this->handleUpdate($update);
            }
        }
    }

    private function handleUpdate($update)
    {
        /** @var BotResponse $botResponse */
        $botResponse = $this->botService->handle(new BotRequest($update));

        $this->botService->makeRequest($botResponse->method, $botResponse->arguments);
    }
}
