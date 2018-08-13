<?php

namespace OAuth2\ResponseType;

use OAuth2\Model\AuthorizationRequestInterface;

interface ResponseTypeInterface
{
    /**
     * @param AuthorizationRequestInterface $request
     * @param mixed $user_id
     * @return mixed
     */
    public function getAuthorizeResponse(AuthorizationRequestInterface $request, $user_id = null);
}
