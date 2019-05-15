<?php

namespace SoheilY98\TelegramBot\Tests;

use PHPUnit\Framework\TestCase;
use SoheilY98\TelegramBot\Contracts\TelegramBotService;
use SoheilY98\TelegramBot\Services\TelegramBotServiceImpl;

class TelegramBotServiceProviderTest extends TestCase
{
    /**
     * @test
     */
    public function it_providers_the_service()
    {
        $this->assertInstanceOf(TelegramBotService::class, new TelegramBotServiceImpl());
    }
}