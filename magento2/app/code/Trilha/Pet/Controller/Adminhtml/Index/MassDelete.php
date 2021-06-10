<?php


namespace Trilha\Pet\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Trilha\Pet\Model\PetFactory;

class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * @var PetFactory
     */
    private $petFactory;

    public function __construct(
        Context $context,
        PetFactory $petFactory
    )
    {
        parent::__construct($context);
        $this->petFactory = $petFactory;
    }

    public function execute()
    {
        var_dump($this->getRequest()->getPostValue()['general']);
    }
}
