<?php


namespace Trilha\Pet\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Trilha\Pet\Api\Data\PetInterface;
use Trilha\Pet\Api\Data\PetSearchResultsInterfaceFactory;
use Trilha\Pet\Api\PetRepositoryInterface;
use Trilha\Pet\Api\searchResultsFactory;
use Trilha\Pet\Model\ResourceModel\Pet as PetResource;
use Trilha\Pet\Model\ResourceModel\Pet\CollectionFactory;

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
    private $searchCriteriaBuilder;
    private $collectionProcessor;
    private $petSearchResults;

    public function __construct(
        PetResource $petResource,
        CollectionFactory $collectionFactory,
        PetFactory $petFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        CollectionProcessorInterface $collectionProcessor,
        PetSearchResultsInterfaceFactory $petSearchResults
    )
    {

        $this->petResource = $petResource;
        $this->collectionFactory = $collectionFactory;
        $this->petFactory= $petFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->collectionProcessor = $collectionProcessor;
        $this->petSearchResults = $petSearchResults;
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
        try {
            $this->petResource->load($pet, $id);
            if ($pet->getEntityId() == 0){
                throw new \Exception();
            }
        }catch (\Exception $e) {
            throw new \Exception('Invalid Id');
        }

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

    /**
     * @param SearchCriteriaInterface $criteria
     * @return \Trilha\Pet\Api\Data\PetSearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $criteria = null): \Trilha\Pet\Api\Data\PetSearchResultsInterface
    {
        $collection = $this->collectionFactory->create();

        if($criteria == null) {
            $criteria = $this->searchCriteriaBuilder->create();
            $criteria->setPageSize(100);
        } else {
            $this->collectionProcessor->process($criteria, $collection);
        }

        $searchResult = $this->petSearchResults->create();
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($criteria);

        return $searchResult;
    }
}
