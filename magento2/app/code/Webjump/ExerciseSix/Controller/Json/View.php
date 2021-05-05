<?php
declare(strict_types=1);

namespace Webjump\ExerciseSix\Controller\Json;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class View extends Action
{
    public function execute()
    {
        $jsonResult = $this->resultFactory->create(ResultFactory::TYPE_JSON);
        $jsonResult->setData([
            "message" => "Rotoranando dados em JSON"
        ]);
        return $jsonResult;
    }
}
