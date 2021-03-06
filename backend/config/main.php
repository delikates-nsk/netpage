<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'rbac' => 'dektrium\rbac\RbacWebModule',
        'user' => [
            'class' => 'dektrium\user\Module',
            'enableFlashMessages' => true,
            'enableRegistration' => true,
            'enableGeneratingPassword' => false,
            'enableConfirmation' => true,
            'enableUnconfirmedLogin' => true,
            'enablePasswordRecovery' => true,
            'enableAccountDelete' => false,
            'emailChangeStrategy' => \dektrium\user\Module::STRATEGY_DEFAULT,
            'confirmWithin' => 86400,
            'rememberFor' => 1209600,
            'recoverWithin' => 21600,
            'admins' => ['admin'],
            'adminPermission' => null,
            'cost' => 10,
            'urlPrefix' => 'user',
            'urlRules' => [],
            //'enableUnconfirmedLogin' => true
        ],
        'cms' => [
            'class' => 'app\modules\cms\Module',
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
