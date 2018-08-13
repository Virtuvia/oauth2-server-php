<?php

namespace OAuth2\Model;

interface CodeChallengeInterface
{
    /**
     * @param string $codeVerifier
     * @return bool
     */
    public function doesMatchVerifier($codeVerifier);
}