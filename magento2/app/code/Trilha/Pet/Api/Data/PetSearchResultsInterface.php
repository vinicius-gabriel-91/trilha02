<?php

namespace Trilha\Pet\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface PetSearchResultsInterface extends SearchResultsInterface
{
    /**
     * @return \Magento\Framework\Api\ExtensibleDataInterface[]
     */
    public function getItems();

    /**
     * @param array $items
     * @return $this
     */
    public function setItems(array $items);
}
