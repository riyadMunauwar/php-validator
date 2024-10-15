<?php
// src/Translator.php

namespace MyValidator;

class Translator {
    protected $locale;
    protected $messages = [];

    public function __construct($locale = 'en') {
        $this->locale = $locale;
        $this->loadMessages();
    }

    protected function loadMessages() {
        $path = __DIR__ . "/Messages/{$this->locale}.php";
        if (file_exists($path)) {
            $this->messages = require $path;
        }
    }

    public function get($key, $replace = []): string {
        $message = $this->messages[$key] ?? $key;

        foreach ($replace as $key => $value) {
            $message = str_replace(":{$key}", $value, $message);
        }

        return $message;
    }
}
