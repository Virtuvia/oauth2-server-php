<?php

namespace OAuth2\Storage;

use PHPUnit\Framework\TestCase;

abstract class BaseTest extends TestCase
{
    public function provideStorage()
    {
        $memory = Bootstrap::getInstance()->getMemoryStorage();

        /* hack until we can fix "default_scope" dependencies in other tests */
        $memory->defaultScope = 'defaultscope1 defaultscope2';

        return array(
            array($memory),
        );
    }
}
