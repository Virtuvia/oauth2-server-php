<?php

namespace OAuth2\Model;

class SHA256CodeChallenge implements CodeChallengeInterface
{
    /**
     * @var string
     */
    protected $codeChallenge;

    /**
     * @param string $codeChallenge
     */
    public function __construct($codeChallenge)
    {
    }

    public function doesMatchVerifier($codeVerifier)
    {
        return false;
    }
}