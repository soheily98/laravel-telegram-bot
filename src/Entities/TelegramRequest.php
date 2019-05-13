<?php

namespace SoheilY98\TelegramBot\Entities;

class TelegramRequest
{
    /** @var integer $update_id */
    public $update_id;

    /** @var Message $message */
    public $message;
}

class Message
{
    /** @var integer $message_id */
    public $message_id;

    /** @var string $text */
    public $text;
}