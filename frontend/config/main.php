<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'configs' => [
            'class' => 'common\components\ConfigsComponent',
        ],
        'authClientCollection' => [
            'class'   => 'yii\authclient\Collection',
            'clients' => [
                'xapi' => [
                    'class'        => 'frontend\components\XapiAuthClient',
                    'clientId'     => 'xapi',
                    'clientSecret' => '123',
                    'tokenUrl'     => 'http://api.server/oauth2/auth/token',
                    'authUrl'      => 'http://api.server/oauth2/auth/index',
                   // 'authUrl'      => 'http://api.server/oauth2/index?expand=email',
                    'apiBaseUrl'   => 'http://api.server/v1',
                    /*
                    'clientId'     => $params['clientId'],
                    'clientSecret' => $params['clientSecret'],
                    'tokenUrl'     => $params['tokenUrl'],
                    'authUrl'      => $params['authUrl'],
                    'apiBaseUrl'   => $params['apiBaseUrl'],
                    */
                    'stateStorage' => 'frontend\components\XapiStateStorage'
                ],
            ],
        ],
        'xapi'  => [
            'class'      => 'frontend\components\XapiV1Client',
            'apiBaseUrl' => $params['apiBaseUrl'],
        ],
        'authManager' => [
            'class' => 'common\components\access\DbManager',
            'cache' => 'cache'
        ],
        'user' => [
            'class' => 'frontend\components\UserX',
            'identityClass' => 'common\models\User',
            'loginUrl' => ['site/login'],
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'params' => $params,
];
