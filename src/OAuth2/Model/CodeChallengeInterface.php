<?php

namespace OAuth2\Model;

interface CodeChallengeInterface
{
    /**
     * @param string $codeVerifier
     * @return bool
     */
    public function doesMatchVerifier($verifier);

    /**
     * @param CodeChallengeVisitorInterface $visitor
     */
    public function acceptVisitor(CodeChallengeVisitorInterface $visitor);
}