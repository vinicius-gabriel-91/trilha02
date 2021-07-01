<?php


namespace Trilha\Pet\Controller\Adminhtml\Pet;


use Magento\Backend\App\Action\Context;
use Trilha\Pet\Model\PetFactory;

class Save extends \Magento\Backend\App\Action
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

        $this->petFactory->create()
            ->setData($this->getRequest()->getPostValue()['general'])
            ->save();
        return $this->resultRedirectFactory->create()->setPath('trilha/index/index');
    }
}
