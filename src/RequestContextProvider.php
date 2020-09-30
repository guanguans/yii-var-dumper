<?php

/*
 * This file is part of the guanguans/yii-var-dumper.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\YiiVarDumper;

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Yii;
use yii\base\Request;

/**
 * This file is modified from `beyondcode/laravel-dump-server`.
 *
 * @see https://github.com/beyondcode/laravel-dump-server
 */
class RequestContextProvider
{
    /**
     * The current request.
     *
     * @var \yii\base\Request|null
     */
    private $currentRequest;

    /**
     * The variable cloner.
     *
     * @var \Symfony\Component\VarDumper\Cloner\VarCloner
     */
    private $cloner;

    /**
     * RequestContextProvider constructor.
     */
    public function __construct(Request $currentRequest = null)
    {
        $this->currentRequest = $currentRequest;
        $this->cloner = new VarCloner();
        $this->cloner->setMaxItems(0);
    }

    /**
     * Get the context.
     *
     * @return array|null
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function getContext()
    {
        if (null === $this->currentRequest) {
            return null;
        }

        $controller = null;

        if ($this->currentRequest) {
            $controller = Yii::$app->controller;
        }

        return [
            'uri' => $this->currentRequest instanceof \yii\web\Request ? $this->currentRequest->getUrl() : implode(' ', Yii::$app->request->getParams()),
            'method' => $this->currentRequest instanceof \yii\web\Request ? $this->currentRequest->getHostInfo() : basename($this->currentRequest->getScriptFile()),
            'controller' => $controller ? $this->cloner->cloneVar(get_class($controller)) : $this->cloner->cloneVar(null),
            'identifier' => spl_object_hash($this->currentRequest),
        ];
    }
}
