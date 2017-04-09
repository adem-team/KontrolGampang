	<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php')
    //require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
	'modules' => [
		'gridview' => [
            'class' => '\kartik\grid\Module',
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            'i18n' => [
                'class' => 'yii\i18n\PhpMessageSource',
                'basePath' => '@kvgrid/messages',
                'forceTranslation' => true
            ],
        ],
		'treemanager' =>  [
			'class' => '\kartik\tree\Module',
			// other module settings, refer detailed documentation
		],
		'dashboard' => [
            'class' => 'frontend\backend\dashboard\Modul',
        ],
		'sistem' => [
            'class' => 'frontend\backend\sistem\Modul',
        ],
		'master' => [
            'class' => 'frontend\backend\master\Modul',
        ],
	],
    'components' => [
		'view' => [
            'theme' => [
                'pathMap' => [
                    'frontend/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/phundament/app'
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_kg', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
		'getUserOpt' =>[
            'class'=>'common\components\Useroption',
        ],
		'arrayBantuan' =>[
            'class'=>'common\components\ArrayBantuan',
        ],
		'gv' => [
            'class' =>'common\components\GridviewCustomize'
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
