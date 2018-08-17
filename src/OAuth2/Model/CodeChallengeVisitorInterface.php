<?php

namespace OAuth2\Model;

interface CodeChallengeVisitorInterface
{
    /**
     * @param string $method
     */
    public function visitMethod($method);

    /**
     * @param string $challenge
     */
    public function visitChallenge($challenge);
}