<?php

namespace OAuth2\ResponseType;

use OAuth2\ExpirationUtil;
use OAuth2\Storage\AuthorizationCodeInterface as AuthorizationCodeStorageInterface;
use OAuth2\Model\AuthorizationRequestInterface;

/**
 * @author Brent Shaffer <bshafs at gmail dot com>
 */
class AuthorizationCode implements AuthorizationCodeInterface
{
    protected $storage;
    protected $config;

    public function __construct(AuthorizationCodeStorageInterface $storage, array $config = array())
    {
        $this->storage = $storage;
        $this->config = array_merge(array(
            'enforce_redirect' => false,
            'auth_code_lifetime' => 30,
        ), $config);
    }

    /**
     * @param AuthorizationRequestInterface $request
     * @param null $user_id
     * @return array|mixed
     */
    public function getAuthorizeResponse(AuthorizationRequestInterface $request, $user_id = null)
    {
        // build the URL to redirect to
        $result = array('query' => array());

        $code = $this->createAuthorizationCode($request->getClientId(), $user_id, $request->getRedirectUri(), $request->getScopes());

        $result['query']['code'] = $code;

        if ($request->getCodeChallenge()) {
            $this->storage->setCodeChallenge($code, $request->getCodeChallenge());
        }

        if (($state = $request->getState()) !== null) {
            $result['query']['state'] = $state;
        }

        return array($request->getRedirectUri(), $result);
    }

    /**
     * Handle the creation of the authorization code.
     *
     * @param $client_id
     * Client identifier related to the authorization code
     * @param $user_id
     * User ID associated with the authorization code
     * @param $redirect_uri
     * An absolute URI to which the authorization server will redirect the
     * user-agent to when the end-user authorization step is completed.
     * @param $scope
     * (optional) Scopes to be stored in space-separated string.
     *
     * @see http://tools.ietf.org/html/rfc6749#section-4
     * @ingroup oauth2_section_4
     */
    public function createAuthorizationCode($client_id, $user_id, $redirect_uri, $scope = null)
    {
        $code = $this->generateAuthorizationCode();

        $expires = ExpirationUtil::expiresAfterSeconds($this->config['auth_code_lifetime']);

        $this->storage->setAuthorizationCode($code, $client_id, $user_id, $redirect_uri, $expires, $scope);

        return $code;
    }

    /**
     * @return
     * TRUE if the grant type requires a redirect_uri, FALSE if not
     */
    public function enforceRedirect()
    {
        return $this->config['enforce_redirect'];
    }

    /**
     * Generates an unique auth code.
     *
     * Implementing classes may want to override this function to implement
     * other auth code generation schemes.
     *
     * @return
     * An unique auth code.
     *
     * @ingroup oauth2_section_4
     */
    protected function generateAuthorizationCode()
    {
        $tokenLen = 40;

        $randomData = random_bytes(100);

        return substr(hash('sha512', $randomData), 0, $tokenLen);
    }
}
