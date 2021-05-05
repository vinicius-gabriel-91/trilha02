<?php
declare(strict_types=1);

namespace Webjump\ExerciseSix\Controller\Redirect;

use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultFactory;

class View extends Action
{
    public function execute()
    {
        $redirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        $redirect->setUrl("https://magento.local/exercisesix/page/view/");
        return $redirect;
    }
}

