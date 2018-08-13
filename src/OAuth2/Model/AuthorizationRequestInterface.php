<?php

namespace OAuth2\Model;

interface AuthorizationRequestInterface
{
    /**
     * @return string
     */
    public function getClientId();

    /**
     * @return string
     */
    public function getState();

    /**
     * @return CodeChallengeInterface
     */
    public function getCodeChallenge();

    /**
     * @return string
     */
    public function getRedirectUri();

    /**
     * @return string[]
     */
    public function getScopes();

    /**
     * @return string
     */
    public function getResponseType();
}