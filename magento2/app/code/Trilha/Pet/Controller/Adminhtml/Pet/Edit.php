<?php


namespace Trilha\Pet\Controller\Adminhtml\Pet;

use Magento\Backend\App\Action\Context;
use Trilha\Pet\Model\PetFactory;
use Trilha\Pet\Model\PetRepository;
use Trilha\Pet\Model\ResourceModel\Pet as PetResource;
use Magento\Framework\View\Result\PageFactory;

class Edit extends \Magento\Backend\App\Action
{
    private $petFactory;
    private $petRepository;
    private $petResource;
    private $resultPageFactory;

    public function __construct(
        Context $context,
        PetFactory $petFactory,
        PetRepository $petRepository,
        PetResource $petResource,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->petFactory = $petFactory;
        $this->petRepository = $petRepository;
        $this->petResource = $petResource;
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
                $model = $this->loadPet($id);
                $id = $model->getEntityId();
            } catch (\Exception $exception) {
                $this->messageManager->addErrorMessage(__('This Pet no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(
            $id ? __('Edit pet %1', $id) : __('New Pet')
        );

        return $resultPage;
    }

    public function loadPet($id)
    {
        $petFactory = $this->petFactory->create();
        $this->petResource->load($petFactory, $id);

        return $petFactory;
    }
}
