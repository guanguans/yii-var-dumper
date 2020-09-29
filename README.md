# yii-var-dumper

![usage](./doc/usage.gif)

![CI](https://github.com/guanguans/yii-var-dumper/workflows/CI/badge.svg)
[![Build Status](https://travis-ci.org/guanguans/yii-var-dumper.svg?branch=master)](https://travis-ci.org/guanguans/yii-var-dumper)
[![StyleCI](https://github.styleci.io/repos/299001049/shield?branch=master)](https://github.styleci.io/repos/299001049?branch=master)
[![Latest Stable Version](https://poser.pugx.org/guanguans/yii-var-dumper/v)](//packagist.org/packages/guanguans/yii-var-dumper)
[![Total Downloads](https://poser.pugx.org/guanguans/yii-var-dumper/downloads)](//packagist.org/packages/guanguans/yii-var-dumper)
[![License](https://poser.pugx.org/guanguans/yii-var-dumper/license)](//packagist.org/packages/guanguans/yii-var-dumper)

> Bringing the [symfony/var-dumper](https://symfony.com/components/VarDumper) to Yii.

## Requirement

* Yii >= 2.0

## Installation

``` bash
$ composer require guanguans/yii-var-dumper -v
```

## Configuration

config file `config/main.php` add:

``` php
...
'bootstrap' => [
    ...
    'dumper',
    ...
],
'modules' => [
    ...
    'dumper' => [
        'class' => 'Guanguans\YiiVarDumper\Module',
        // 'host' => 'tcp://127.0.0.1:9913',
    ],
    ...
],
...
```

## Usage

### Run `dumper/server`

``` bash
php yii dumper/server
```

### Dump your variable

``` php
<?php
dump($yourVariate);
```

## Testing

``` bash
$ composer test
```

## Related Links

* [https://github.com/beyondcode/laravel-dump-server](https://github.com/beyondcode/laravel-dump-server), [beyondcode](https://github.com/beyondcode)
* [https://github.com/symfony/var-dumper](https://github.com/symfony/var-dumper), [symfony](https://github.com/symfony)

## License

[MIT](LICENSE)
