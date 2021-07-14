<?php


namespace Trilha\Pet\Controller\Adminhtml\Pet;

use Magento\Backend\App\Action\Context;
use Trilha\Pet\Model\PetRepository;
use Trilha\Pet\Model\PetFactory;
use Trilha\Pet\Model\ResourceModel\Pet as PetResource;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var PetFactory
     */
    private $petFactory;

    private $petResource;
    /**
     * @var PetRepository
     */
    private $petRepository;

    public function __construct(
        PetResource $petResource,
        Context $context,
        PetFactory $petFactory,
        PetRepository $petRepository
    ) {
        parent::__construct($context);
        $this->petFactory = $petFactory;
        $this->petResource = $petResource;
        $this->petRepository = $petRepository;
    }

    public function execute()
    {
        $requestValue = $this->getRequest()->getPostValue();

        if (isset($requestValue['general']['entity_id'])) {
            $entityId = $requestValue['general']['entity_id'];
            $pet = $this->petRepository->getById($entityId);
            $pet->setName($requestValue['name']);
            $pet->setDescription($requestValue['description']);
            $this->petRepository->save($pet);
            return $this->resultRedirectFactory->create()->setPath('trilha/index/index');
        }
        $this->petFactory->create()->setData($this->getRequest()->getPostValue())->save();

        return $this->resultRedirectFactory->create()->setPath('trilha/index/index');
    }
}
