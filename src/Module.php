<?php

/*
 * This file is part of the guanguans/yii-var-dumper.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\YiiVarDumper;

use Symfony\Component\VarDumper\Dumper\ContextProvider\SourceContextProvider;
use Symfony\Component\VarDumper\Server\Connection;
use Symfony\Component\VarDumper\VarDumper;
use Yii;

/**
 * Class Module.
 */
class Module extends \yii\base\Module
{
    const VERSION = '1.0.0';

    public $defaultRoute = 'web'; // 设置默认控制器

    public $host = 'tcp://127.0.0.1:9913';

    public $controllerNamespace = 'Guanguans\YiiVarDumper\controllers';

    public function init()
    {
        parent::init();

        require __DIR__.'/bootstrap.php';

        if (Yii::$app instanceof \yii\console\Application) {
            $this->controllerNamespace = 'Guanguans\YiiVarDumper\commands';
        }

        $connection = new Connection($this->host, [
            'request' => new RequestContextProvider(Yii::$app->request),
            'source' => new SourceContextProvider('utf-8', Yii::$app->getBasePath()),
        ]);

        VarDumper::setHandler(function ($var) use ($connection) {
            (new Dumper($connection))->dump($var);
        });
    }
}
