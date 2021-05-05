<?php
declare(strict_types=1);

namespace Webjump\ExerciseSix\Controller\Forward;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class View extends Action
{
    public function execute()
    {
        $forward = $this->resultFactory->create(ResultFactory::TYPE_FORWARD);
        $forward->forward("defaultNoRoute");
        return $forward;
    }
}
