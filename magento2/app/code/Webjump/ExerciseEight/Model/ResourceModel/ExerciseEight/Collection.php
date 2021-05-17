<?php


namespace Webjump\ExerciseEight\Model\ResourceModel\ExerciseEight;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

//    protected $_eventPrefix = 'pet_table';
//
//    protected $_eventObject = 'exerciseeight_collection';

    protected function _construct()
    {
        $this->_init(\Webjump\ExerciseEight\Model\ExerciseEight::class, \Webjump\ExerciseEight\Model\ResourceModel\ExerciseEight::class);
    }
}
