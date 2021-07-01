<?php


namespace Trilha\Pet\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Trilha\Pet\Model\PetFactory;
use Trilha\Pet\Model\ResourceModel\Pet as PetResource;

class MassDelete extends \Magento\Backend\App\Action
{
    /**
     * @var PetFactory
     */
    private $petFactory;
    private $petResource;

    public function __construct(
        PetResource $petResource,
        Context $context,
        PetFactory $petFactory
    )
    {
        parent::__construct($context);
        $this->petFactory = $petFactory;
        $this->petResource = $petResource;
    }

    public function execute()
    {
        foreach ($this->getRequest()->getPostValue()['selected'] as $id){
            $pet = $this->petFactory->create();
            $this->petResource->load($pet, $id);
            $this->petResource->delete($pet);
        }
        return $this->resultRedirectFactory->create()->setPath('trilha/index/index');
    }
}

