<?php

namespace Webjump\Trilha\Plugins;

use Magento\Framework\App\Action\Action;

class Dispatch
{
    protected $_logger;

    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->_logger = $logger;
    }

    public function afterDispatch(Action $action, $result, $response)
    {
        $this->_logger->info("Salvando mensagem a partir de plugin com metodo after");

        return $result ?: $response;
    }

    public function beforeDispatch()
    {
        $this->_logger->info("Salvando mensagem a partir de plugin com metodo before");
    }

//    public function aroundDispatch(Action $action, $result, $response)
//    {
//        $this->_logger->info("Salvando mensagem a partir de plugin com metodo around");
//
//        return $result ?: $response;
//    }
}
