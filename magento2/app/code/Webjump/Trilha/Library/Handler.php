<?php

namespace Webjump\Trilha\Library;

use Magento\Framework\Filesystem\DriverInterface;
use Monolog\Logger;

class Handler extends \Magento\Framework\Logger\Handler\Base
{

    protected $loggerType = Logger::DEBUG;
    protected $fileName = '/var/log/custom-debug.log';

}
