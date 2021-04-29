<?php

namespace Webjump\Trilha\Plugins;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\RequestInterface;

class Dispatch
{
    protected $_logger;

    public function __construct(\Psr\Log\LoggerInterface $logger)
    {
        $this->_logger = $logger;
    }

    public function afterDispatch(Action $action, $result)
    {
        $this->_logger->info("Salvando mensagem a partir de plugin com metodo after");

        return $result;
    }

    public function beforeDispatch()
    {
        $this->_logger->info("Salvando mensagem a partir de plugin com metodo before");
    }

    public function aroundDispatch(Action $action, callable $proceed, RequestInterface $request)
    {
        $this->_logger->info("Salvando mensagem a partir de plugin com metodo around antes do metodo ser chamado");

        $result = $proceed($request);

        $this->_logger->info("Salvando mensagem a partir de plugin com metodo around depois do metodo ser chamado");

        return $result;
    }
}
