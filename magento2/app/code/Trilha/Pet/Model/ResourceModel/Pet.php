<?php


namespace Trilha\Pet\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Pet extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('pet_kind', 'entity_id');
    }
}
