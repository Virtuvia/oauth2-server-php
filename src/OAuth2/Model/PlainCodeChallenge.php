<?php

namespace OAuth2\Model;

class PlainCodeChallenge implements CodeChallengeInterface
{
    const CHALLENGE_METHOD = 'plain';

    /**
     * @var string
     */
    protected $challenge;

    /**
     * @param string $challenge
     */
    public function __construct($challenge)
    {
        $this->challenge = $challenge;
    }

    public function doesMatchVerifier($verifier)
    {
        return \is_string($this->challenge) && \is_string($verifier) && \hash_equals($this->challenge, $verifier);
    }

    public function acceptVisitor(CodeChallengeVisitorInterface $visitor)
    {
        $visitor->visitChallenge($this->challenge);
        $visitor->visitMethod(self::CHALLENGE_METHOD);
    }
}