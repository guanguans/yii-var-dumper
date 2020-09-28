<?php

/*
 * This file is part of the guanguans/yii-var-dumper.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\YiiVarDumper\controllers;

use yii\web\Controller;

/**
 * Class WebController.
 */
class WebController extends Controller
{
    /**
     * @return string
     */
    public function actionIndex()
    {
        dump('This is a web dump server testing.');

        return $this->render('index');
    }
}
