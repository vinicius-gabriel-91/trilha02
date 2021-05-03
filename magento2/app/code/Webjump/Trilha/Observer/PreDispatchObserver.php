<?php


namespace Webjump\Trilha\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Webjump\Trilha\Library\Logger;


class PreDispatchObserver implements ObserverInterface
{
    protected $logger;

    public function __construct(Logger $logger)
    {
        $this->logger = $logger;
    }

    public function execute(Observer $observer)
    {
        $this->logger->debug("Mensagem sendo gravada através do observer");
    }
}
