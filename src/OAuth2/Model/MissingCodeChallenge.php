<?php

namespace OAuth2\Model;

class MissingCodeChallenge implements CodeChallengeInterface
{
    static public function getInstance()
    {
        static $instance;

        if (!$instance instanceof self) {
            $instance = new self();
        }

        return $instance;
    }

    public function doesMatchVerifier($codeVerifier)
    {
        return false;
    }

    public function acceptVisitor(CodeChallengeVisitorInterface $visitor)
    {
        // noop
    }
}