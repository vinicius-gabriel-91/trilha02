<?php


namespace Trilha\Pet\Ui;

use Magento\Ui\DataProvider\AbstractDataProvider;
use \Magento\Backend\App\Action;
use Trilha\Pet\Model\PetFactory;
use Trilha\Pet\Model\ResourceModel\Pet as PetResource;
use Trilha\Pet\Model\ResourceModel\Pet\Collection;

class DataProvider extends AbstractDataProvider
{
    protected $collection;
    /**
     * @var Action
     */
    private $action;
    /**
     * @var PetFactory
     */
    private $petFactory;
    /**
     * @var PetResource
     */
    private $pet;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Collection $collectionFactory,
        array $meta = [],
        array $data = [],
        Action $action,
        PetFactory $petFactory,
        PetResource $pet
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory;
        $this->action = $action;
        $this->petFactory = $petFactory;
        $this->pet = $pet;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $pet = $this->petFactory->create();
        $id = $this->action->getRequest()->getPostValue()['selected'];
        $this->pet->load($pet, $id);
        $result[$pet->getId()]['general'] = $pet->getData();
        var_dump($result);
        return $result;
    }
}
//        $result = [];
//        foreach ($this->collection->getItems() as $item){
//            $result['general'] = $item->getData();
//        }
