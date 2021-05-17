<?php

declare(strict_types=1);

namespace Webjump\ExerciseEight\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Webjump\ExerciseEight\Api\Data\ExerciseEightInterface;
use Webjump\ExerciseEight\Api\Data\ExerciseEightSearchResultInterface;

interface ExerciseEightRepositoryInterface
{

    /**
     * getById
     *
     * @param  int $id
     * @return Webjump\ExerciseEight\Api\Data\ExerciseEightInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById(int $id): ExerciseEightInterface;

     /**
     * @param Webjump\ExerciseEight\Api\Data\ExerciseEightInterface $pet
     * @return Webjump\ExerciseEight\Api\Data\ExerciseEightInterface
     */
    public function save(ExerciseEightInterface $pet): bool;

    /**
     * getList
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Webjump\ExerciseEight\Api\Data\ExerciseEightSearchResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(SearchCriteriaInterface $searchCriteria): ExerciseEightSearchResultInterface;
}
