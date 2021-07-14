<?php


namespace Trilha\Pet\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Trilha\Pet\Model\PetRepository;

class MassDelete extends \Magento\Backend\App\Action
{

    private $petRepository;

    public function __construct(
        PetRepository $petRepository,
        Context $context
    )
    {
        parent::__construct($context);
        $this->petRepository = $petRepository;
    }

    public function execute()
    {
        $selectedIds = $this->getRequest()->getPostValue()['selected'];

        if (empty($selectedIds)){
            $this->messageManager->addErrorMessage(__("Sorry we could not find any pet kind to delete"));
            return $this->resultRedirectFactory->create()->setPath('trilha/index/index');
        }
        foreach ($selectedIds as $id){
                try{
                    $this->petRepository->delete($id);
                } catch (\Exception $e) {
                    $this->messageManager->addErrorMessage($e->getMessage());

                    return $this->resultRedirectFactory->create()->setPath('trilha/index/index');
                }
        }
        return $this->resultRedirectFactory->create()->setPath('trilha/index/index');
    }
}

