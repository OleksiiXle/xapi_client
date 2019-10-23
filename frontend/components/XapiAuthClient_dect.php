<?php

namespace frontend\components;

use yii\authclient\OAuth2;
use yii\authclient\InvalidResponseException;
use dektrium\user\models\User;
use dektrium\user\events\AuthEvent;
use dektrium\user\clients\ClientInterface;


class XapiAuthClient extends OAuth2 implements ClientInterface
{
    public function init() {
        /*\yii\base\Event::on(
            \dektrium\user\controllers\SecurityController::className(),
            \dektrium\user\controllers\SecurityController::EVENT_BEFORE_AUTHENTICATE,
            [$this, 'connectUser']
        );*/
    }

    /**
     * @param $event AuthEvent
     */
    public function connectUser($event) {
        echo '';
        if (!$event->account->user instanceof User) {
            $userModel = new User();
        }
    }

    public function buildAuthUrl(array $params = [])
    {
        $defaultParams = [
            'client_id' => $this->clientId,
            'response_type' => 'code',
            'redirect_uri' => $this->getReturnUrl(),
            'xoauth_displayname' => \Yii::$app->name,
        ];
        if (!empty($this->scope)) {
            $defaultParams['scope'] = $this->scope;
        }

        if ($this->validateAuthState) {
            $authState = $this->generateAuthState();
            $this->setState('authState', $authState);
            $defaultParams['state'] = $authState;
        }

        return $this->composeUrl($this->authUrl, array_merge($defaultParams, $params));
    }

    protected function defaultName()
    {
        return 'upzapi';
    }

    protected function defaultTitle()
    {
        return 'UPZAPI Client';
    }

    protected function defaultViewOptions()
    {
        return [
            'popupWidth' => 800,
            'popupHeight' => 500,
        ];
    }

    protected function initUserAttributes() {
        $accessToken = $this->restoreAccessToken();
        $token = $accessToken->params['access_token'];

        //$this->api();
        $apiRequest = $this->getHttpClient()
            ->createRequest()
            ->setHeaders(['Authorization' => 'Bearer '. $token ])
            ->setMethod('GET')
            ->setUrl($this->apiBaseUrl . '/user/info?expand=email');

        $apiAnswer = $apiRequest->send();

        if (!$apiAnswer->getIsOk()) {
            throw new InvalidResponseException($apiAnswer, 'Request failed with code: ' . $apiAnswer->getStatusCode() . ', message: ' . $apiAnswer->getContent());
        }
        return $apiAnswer->getData();
    }

    public function getUsername() {
        return $this->userAttributes['email'];
    }

    public function getEmail() {
        return $this->userAttributes['email'];
    }
}