<?php

/*
 * This file is part of the guanguans/yii-var-dumper.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\YiiVarDumper\controllers;

use Yii;
use yii\web\Controller;
use yii\web\Response;

/**
 * Class ApiController.
 */
class ApiController extends Controller
{
    public function init()
    {
        parent::init();
        Yii::$app->response->format = Response::FORMAT_JSON;
    }

    /**
     * @return array
     */
    public function actionIndex()
    {
        dump('This is a api dump server testing.');

        return [
            'name' => 'guanguans/yii-var-dumper',
            'description' => '将 symfony/var-dumper 带到 Yii。 - Bringing the symfony/var-dumper to Yii.',
            'homepage' => 'https://github.com/guanguans/yii-var-dumper',
            'support' => [
                'issues' => 'https://github.com/guanguans/yii-var-dumper/issues',
                'source' => 'https://github.com/guanguans/yii-var-dumper',
            ],
            'authors' => [
                [
                    'name' => 'guanguans',
                    'email' => 'ityaozm@gmail.com',
                    'homepage' => 'https://guanguans.cn',
                    'role' => 'developer',
                ],
            ],
            'license' => 'MIT',
        ];
    }
}
