<?php

namespace OAuth2\Model;

class SHA256CodeChallenge implements CodeChallengeInterface
{
    const CHALLENGE_METHOD = 'S256';

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
        return hash_equals(
            $this->challenge,
            rtrim(
                strtr(
                    base64_encode(hash('sha256', $verifier, true)),
                    '+/', '-_'
                ),
                '='
            )
        );
    }

    public function acceptVisitor(CodeChallengeVisitorInterface $visitor)
    {
        $visitor->visitChallenge($this->challenge);
        $visitor->visitMethod(self::CHALLENGE_METHOD);
    }
}