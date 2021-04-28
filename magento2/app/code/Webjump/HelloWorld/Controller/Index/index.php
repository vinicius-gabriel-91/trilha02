<?php

namespace Webjump\HelloWorld\Controller\Index;

use Magento\Framework\App\Action\Action;

class Index extends Action
{
    public function execute()
    {
        echo "Hello World!";
    }
}
