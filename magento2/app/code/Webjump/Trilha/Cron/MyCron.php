<?php


namespace Webjump\Trilha\Cron;

//use Webjump\Trilha\Library\Logger;
use Psr\Log\LoggerInterface;

class MyCron
{
    protected $_logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->_logger = $logger;
    }

    public function execute()
    {
        $this->_logger->info("Mensagem sendo gravada pelo cron");
        return $this;
    }

}
