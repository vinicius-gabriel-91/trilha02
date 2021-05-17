<?php

declare(strict_types=1);

namespace Webjump\ExerciseEight\Model;

use Webjump\ExerciseEight\Model\ResourceModel\ExerciseEight\Collection;
use Webjump\ExerciseEight\Api\Data\ExerciseEightInterface;
use Webjump\ExerciseEight\Api\ExerciseEightRepositoryInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Webjump\ExerciseEight\Api\Data\ExerciseEightSearchResultInterface;
use Webjump\ExerciseEight\Api\Data\ExerciseEightSearchResultInterfaceFactory;
use Webjump\ExerciseEight\Model\ExerciseEightFactory;
use Webjump\ExerciseEight\Model\ResourceModel\ExerciseEight\CollectionFactory;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Webjump\ExerciseEight\Model\ResourceModel\ExerciseEight as ExerciseEightResource;
use Magento\Framework\Controller\ResultFactory;


class ExerciseEightRepository implements ExerciseEightRepositoryInterface
{
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;

    /**
     * @var ExerciseEightResource
     */
    private $exerciseEightResource;

    /**
     * @var ExerciseEightFactory
     */
    private $exerciseEightFactory;

    /**
     * @var SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    /**
     * @var CollectionFactory
     */
    private $exerciseEightCollectionFactory;

    /**
     * @var ExerciseEightSearchResultInterfaceFactory
     */
    private $exerciseEightSearchResultInterfaceFactory;

    public function __construct(
        ExerciseEightResource $exerciseEightResource,
        ExerciseEightFactory $exerciseEightFactory,
        CollectionFactory $collectionFactory,
        SearchCriteriaBuilder $searchCriteriaBuilder,
        CollectionProcessorInterface $collectionProcessor,
        ExerciseEightSearchResultInterfaceFactory $exerciseEightSearchResultInterfaceFactory
    ) {
        $this->exerciseEightResource = $exerciseEightResource;
        $this->exerciseEightFactory = $exerciseEightFactory;
        $this->exerciseEightCollectionFactory = $collectionFactory;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->collectionProcessor = $collectionProcessor;
        $this->exerciseEightSearchResultInterfaceFactory = $exerciseEightSearchResultInterfaceFactory;
    }

    /**
     * @param ExerciseEightInterface $pet
     * @return bool
     * @throws CouldNotSaveException
     */
    public function save(ExerciseEightInterface $pet): bool
    {
        $pets = $this->exerciseEightFactory->create();
        $pets->setPetName($pet->getPetName());
        $pets->setPetOwner($pet->getPetOwner());
        $pets->setOwnerTelephone($pet->getOwnerTelephone());
        $pets->setOwnerId($pet->getOwnerId());

        try {
            $this->exerciseEightResource->save($pets);
            return true;
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__('Could not save Pet'), $e);
        }
    }

    public function getById($id): ExerciseEightInterface
    {
        $petId = $this->exerciseEightFactory->create();
        $this->exerciseEightResource->load($petId, $id);

        return $petId;
    }

    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria): ExerciseEightSearchResultInterface
    {
        $collection = $this->exerciseEightCollectionFactory->create();

        if(null === $searchCriteria) {
            $searchCriteria = $this->searchCriteriaBuilder->create();
        } else {
            $this->collectionProcessor->process($searchCriteria, $collection);
        }
        /** @var ExerciseEightSearchResultInterface $searchResult */
        $searchResult = $this->exerciseEightSearchResultInterfaceFactory->create();
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        $searchResult->setSearchCriteria($searchCriteria);

        return $searchResult;
    }
}










































//
//namespace Webjump\ExerciseEight\Model;
//
//use Webjump\ExerciseEight\Api\ExerciseEightRepositoryInterface;
//use Webjump\ExerciseEight\Api\Data\ExerciseEightInterface;
//use Webjump\ExerciseEight\Api\Data\ExerciseEightSearchResultInterface;
//use Webjump\ExerciseEight\Api\Data\ExerciseEightSearchResultInterfaceFactory;
//use Webjump\ExerciseEight\Model\ResourceModel\ExerciseEight\CollectionFactory as ExerciseEightCollectionFactory;
//use Webjump\ExerciseEight\Model\ResourceModel\ExerciseEight\Collection;
//use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
//use Magento\Framework\Api\SearchCriteriaInterface;
//use Magento\Framework\Api\SortOrder;
//use Magento\Framework\Exception\NoSuchEntityException;
//
//class ExerciseEightRepository implements ExerciseEightRepositoryInterface
//{
//
//    private $ExerciseEightFactory;
//
//    private $ExerciseEightCollectionFactory;
//
//    private $searchResultFactory;
//
//    private $collectionProcessor;
//
//    public function __construct(
//        ExerciseEightFactory $ExerciseEightFactory,
//        ExerciseEightCollectionFactory $ExerciseEightCollectionFactory,
//        ExerciseEightSearchResultInterfaceFactory $ExerciseEightSearchResultInterfaceFactory,
//        CollectionProcessorInterface $collectionProcessor
//    ) {
//        $this->ExerciseEightFactory = $ExerciseEightFactory;
//        $this->ExerciseEightCollectionFactory = $ExerciseEightCollectionFactory;
//        $this->searchResultFactory = $ExerciseEightSearchResultInterfaceFactory;
//        $this->collectionProcessor = $collectionProcessor;
//    }
//
//    public function getById($id)
//    {
//        $ExerciseEight = $this->ExerciseEightFactory->create();
//        $ExerciseEight->getResource()->load($ExerciseEight, $id);
//        if (! $ExerciseEight->getId()) {
//           throw new NoSuchEntityException(__('Unable to find a pet with ID "%1"', $id));
//        }
//        return $ExerciseEight;
//    }
//
//    public function save(ExerciseEightInterface $ExerciseEight)
//    {
//        $ExerciseEight->getResource()->save($ExerciseEight);
//        return $ExerciseEight;
//    }
//
//    public function delete(ExerciseEightInterface $ExerciseEight)
//    {
//        $ExerciseEight->getResource()->delete($ExerciseEight);
//    }
//    public function getList(SearchCriteriaInterface $searchCriteria)
//    {
//       $collection = $this->collectionFactory->create();
//       $this->collectionProcessor->process($searchCriteria, ($collection));
//       $searchResults = $this->searchResultFactory->create();
//
//       $searchResults->setSearchCriteria($searchCriteria);
//       $searchResults->setItems($collection->getItems());
//
//       return $searchResults;
//    }
//}
