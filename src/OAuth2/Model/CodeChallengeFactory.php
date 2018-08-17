<?php

namespace OAuth2\Model;

class CodeChallengeFactory
{
    // https://tools.ietf.org/html/rfc7636#section-4.3
    const DEFAULT_CHALLENGE_METHOD = 'plain';

    public function createWith($method, $challenge)
    {
        switch ($method) {
            case PlainCodeChallenge::CHALLENGE_METHOD:
                return new PlainCodeChallenge($challenge);
            case SHA256CodeChallenge::CHALLENGE_METHOD:
                return new SHA256CodeChallenge($challenge);
        }

        // @TODO use a more specific Exception class
        throw new \InvalidArgumentException(sprintf('Unsupported Code Challenge Method "%s"', $method));
    }
}