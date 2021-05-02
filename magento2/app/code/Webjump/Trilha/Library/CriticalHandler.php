<?php

namespace Webjump\Trilha\Library;

use Magento\Framework\Filesystem\DriverInterface;
use Monolog\Logger;

class CriticalHandler extends \Magento\Framework\Logger\Handler\Base
{

    protected $loggerType = Logger::CRITICAL;
    protected $fileName = '/var/log/custom-critical.log';

}
