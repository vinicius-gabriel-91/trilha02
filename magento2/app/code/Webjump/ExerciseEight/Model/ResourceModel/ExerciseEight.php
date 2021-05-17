<?php

namespace Webjump\ExerciseEight\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ExerciseEight extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('pet_table', 'entity_id');
    }

}
