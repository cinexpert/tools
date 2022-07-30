# CineXpert Tools

[![CircleCI](https://dl.circleci.com/status-badge/img/gh/cinexpert/tools/tree/master.svg?style=svg)](https://dl.circleci.com/status-badge/redirect/gh/cinexpert/tools/tree/master)

This repository contains tools & services like a Queue, Encryption, etc. Every tool comes with an adapter pattern.

### Install dependencies
```bash
$ ./composer.phar install
```

### PHPCS
```bash
$ vendor/bin/phpcs --standard=phpcs.xml ./src
```

### PHPUnit
```bash
$ cd tests && ../vendor/bin/phpunit
```

### Basic Usage Example
```php
$config = new \Cinexpert\Tools\ToolsConfig();
$config
    ->setAwsRegion('eu-west-1')
    ->setAwsKey('...')
    ->setAwsSecret('...');

$tools = new \Cinexpert\Tools\Tools($config);

$queue = $tools->get('queue');

$queue->sendMessage('https://my-queue-url', 'message text');
```
