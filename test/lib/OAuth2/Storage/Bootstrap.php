<?php

namespace OAuth2\Storage;

class Bootstrap
{
    const DYNAMODB_PHP_VERSION = 'none';

    protected static $instance;
    private $configDir;

    public function __construct()
    {
        $this->configDir = __DIR__.'/../../../config';
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getMemoryStorage()
    {
        return new Memory(json_decode(file_get_contents($this->configDir. '/storage.json'), true));
    }

    public function getConfigDir()
    {
        return $this->configDir;
    }

    public function getTestPublicKey()
    {
        return file_get_contents(__DIR__.'/../../../config/keys/id_rsa.pub');
    }

    private function getTestPrivateKey()
    {
        return file_get_contents(__DIR__.'/../../../config/keys/id_rsa');
    }

    private function getEnvVar($var, $default = null)
    {
        return isset($_SERVER[$var]) ? $_SERVER[$var] : (getenv($var) ?: $default);
    }
}
