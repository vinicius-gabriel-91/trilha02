<?php

namespace Webjump\Trilha\Plugins;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\RequestInterface;
use Webjump\Trilha\Library\CriticalLogger;
use Webjump\Trilha\Library\Logger;


class Dispatch
{
    protected Logger $_logger;
    protected CriticalLogger $criticalLogger;

    public function __construct(Logger $logger, CriticalLogger $criticalLogger)
    {
        $this->_logger = $logger;
        $this->criticalLogger = $criticalLogger;
    }

    public function afterDispatch(Action $action, $result)
    {

        $this->_logger->debug("Salvando mensagem a partir de plugin com metodo after");
        return $result;
    }

    public function beforeDispatch()
    {
        $this->criticalLogger->critical("Salvando mensagem a partir de plugin com metodo before");
    }

    public function aroundDispatch(Action $action, callable $proceed, RequestInterface $request)
    {
        $this->criticalLogger->critical("Salvando mensagem a partir de plugin com metodo around antes do metodo ser chamado");

        $result = $proceed($request);

        $this->criticalLogger->critical("Salvando mensagem a partir de plugin com metodo around depois do metodo ser chamado");

        return $result;
    }
}
