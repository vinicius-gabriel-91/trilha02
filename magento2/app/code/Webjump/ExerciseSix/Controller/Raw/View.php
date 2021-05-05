<?php
declare(strict_types=1);

namespace Webjump\ExerciseSix\Controller\Raw;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class View extends Action
{
    public function execute()
    {
        $rawResult = $this->resultFactory->create(ResultFactory::TYPE_RAW);
        $rawResult->setContents("<h1><strong>Retornando dados a partir do RAW</strong></h1>");
        return $rawResult;
    }
}
