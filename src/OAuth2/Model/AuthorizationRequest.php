<?php

namespace OAuth2\Model;

class AuthorizationRequest implements AuthorizationRequestInterface
{
    /**
     * @var string
     */
    protected $clientId;

    /**
     * @var string
     */
    protected $state;

    /**
     * @var CodeChallengeInterface
     */
    protected $codeChallenge;

    /**
     * @var string
     */
    protected $redirectUri;

    /**
     * @var string[]
     */
    protected $scopes;

    /**
     * @var string
     */
    protected $responseType;

    /**
     * @param $clientId
     * @param $responseType
     */
    public function __construct($clientId, $responseType)
    {
        $this->clientId = $clientId;
        $this->responseType = $responseType;
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function getResponseType()
    {
        return $this->responseType;
    }

    public function getState()
    {
        return $this->state;
    }

    /**
     * @param $state
     * @return AuthorizationRequest
     */
    public function withState($state)
    {
        $new = clone $this;
        $new->state = $state;

        return $new;
    }

    public function getCodeChallenge()
    {
        return $this->codeChallenge;
    }

    /**
     * @param CodeChallengeInterface $challenge
     * @return AuthorizationRequest
     */
    public function withCodeChallenge(CodeChallengeInterface $challenge)
    {
       $new = clone $this;
       $new->codeChallenge = $challenge;

       return $new;
    }

    public function getRedirectUri()
    {
        return $this->redirectUri;
    }

    /**
     * @param $redirectUri
     * @return AuthorizationRequest
     */
    public function withRedirectUri($redirectUri)
    {
        $new = clone $this;
        $new->redirectUri = $redirectUri;

        return $new;
    }

    public function getScopes()
    {
        return $this->scopes;
    }

    /**
     * @param array|string|null $scopes
     * @return AuthorizationRequest
     */
    public function withScopes($scopes = null)
    {
        $new = clone $this;
        $new->scopes = is_array($scopes) ?: (($scopes === null || $scopes === '') ? [] : explode(' ', $scopes));

        return $new;
    }
}