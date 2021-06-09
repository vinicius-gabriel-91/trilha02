<?php


namespace Trilha\Pet\Model\ResourceModel\Pet;


class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(\Trilha\Pet\Model\Pet::class, \Trilha\Pet\Model\ResourceModel\Pet::class);
    }

}
