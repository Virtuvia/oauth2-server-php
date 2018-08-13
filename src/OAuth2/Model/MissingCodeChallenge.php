<?php

namespace OAuth2\Model;

class MissingCodeChallenge implements CodeChallengeInterface
{
    public function doesMatchVerifier($codeVerifier)
    {
        return false;
    }
}

