<?php
class DotEnv {
    private $path;

    public function __construct($path) {
        $this->path = $path;
    }

    public function load() {
        if (!file_exists($this->path)) {
            throw new Exception("Arquivo .env não encontrado: {$this->path}");
        }

        $lines = file($this->path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            if (str_starts_with(trim($line), '#')) continue;

            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
            putenv(trim($key) . '=' . trim($value));
        }
    }
}

