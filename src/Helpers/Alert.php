<?php

namespace App\Helpers;

class Alert
{
    public string $message;
    public string $type;

    public const ERROR = 'danger';
    public const OK = 'success';

    public function __construct(string $message, string $type)
    {
        $this->type = $type;
        $this->message = $message;
    }

    public static function create(string $message, string $type) : Alert {
        return new Alert($message, $type);
    }
}