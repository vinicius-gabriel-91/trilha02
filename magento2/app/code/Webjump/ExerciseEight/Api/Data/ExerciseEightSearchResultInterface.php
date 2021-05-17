<?php
namespace Webjump\ExerciseEight\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface ExerciseEightSearchResultInterface extends SearchResultsInterface
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
