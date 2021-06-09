<?php

namespace Trilha\Pet\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Trilha\Pet\Api\Data\PetInterface;

interface PetRepositoryInterface
{
    /**
     * @param PetInterface $pet
     * @return bool
     */
    public function save(PetInterface $pet): bool;

    /**
     * @param int $id
     * @return PetInterface
     */
    public function getById(int $id): PetInterface;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
