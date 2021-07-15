<?php


namespace Trilha\Pet\Controller\Adminhtml\Pet;

use Magento\Backend\App\Action\Context;
use Trilha\Pet\Model\PetRepository;
use Magento\Framework\View\Result\PageFactory;

class Edit extends \Magento\Backend\App\Action
{
    private $petRepository;
    private $resultPageFactory;

    public function __construct(
        Context $context,
        PetRepository $petRepository,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->petRepository = $petRepository;
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');

        if ($id) {
            try {
                $pet = $this->petRepository->getById($id);
            } catch (\Exception $exception) {
                $this->messageManager->addErrorMessage(__('This Pet no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(
            $id ? __('Edit pet kind %1', $pet->getName()) : __('New Pet')
        );

        return $resultPage;
    }
}
