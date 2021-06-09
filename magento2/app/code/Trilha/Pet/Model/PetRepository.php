<?php


namespace Trilha\Pet\Model;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Trilha\Pet\Api\Data\PetInterface;
use Trilha\Pet\Api\PetRepositoryInterface;
use Trilha\Pet\Model\ResourceModel\Pet as PetResource;
use Trilha\Pet\Model\ResourceModel\Pet\CollectionFactory;
use Trilha\Pet\Model\PetFactory;

class PetRepository implements PetRepositoryInterface
{

    /**
     * @var PetResource
     */
    private $petResource;

    /**
     * @var CollectionFactory
     */
    private $collectionFactory;

    /**
     * @var \Trilha\Pet\Model\PetFactory
     */
    private $petFactory;

    public function __construct(
        PetResource $petResource,
        CollectionFactory $collectionFactory,
        PetFactory $petFactory
    )
    {

        $this->petResource = $petResource;
        $this->collectionFactory = $collectionFactory;
        $this->petFactory= $petFactory;
    }

    /**
     * @param PetInterface $pet
     * @return bool
     * @throws CouldNotSaveException
     */
    public function save(PetInterface $pet): bool
    {
        $pets = $this->petFactory->create();

        if ($pet->getEntityId()){
            $this->petResource->load($pets, $pet->getEntityId());
        }

        $pets->setName($pet->getName());
        $pets->setDescription($pet->getDescription());

        try {
            $this->petResource->save($pets);
            return true;
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Could not save Pet'), $e);
        }
    }

    /**
     * @param int $id
     * @return PetInterface
     */
    public function getById(int $id): PetInterface
    {
        $pet = $this->petFactory->create();
        $this->petResource->load($pet, $id);

        return $pet;
    }

    /**
     * @param int $id
     * @return bool
     * @throws CouldNotSaveException
     */
    public function delete(int $id): bool
    {
        $pet = $this->petFactory->create();
        $this->petResource->load($pet, $id);

        try {
            $this->petResource->delete($pet);
            return true;
        } catch (\Exception $e){
            throw new CouldNotSaveException(__('Could not delete Pet'), $e);
        }

    }
}
