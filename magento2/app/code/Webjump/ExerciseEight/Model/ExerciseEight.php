<?php


namespace Webjump\ExerciseEight\Model;


use Magento\Framework\Model\AbstractModel;
use Webjump\ExerciseEight\Api\Data\ExerciseEightInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

class ExerciseEight extends AbstractExtensibleModel implements ExerciseEightInterface
{
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init(\Webjump\ExerciseEight\Model\ResourceModel\ExerciseEight::class);
    }

     public function getEntityId(): int
    {
        return (int)$this->getData(self::ENTITY_ID);
    }

    public function setEntityId($entityId): void
    {
        $this->setData(self::ENTITY_ID, (int)$entityId);
    }

    public function getPetName(): string
    {
       return $this->getData(self::PET_NAME);
    }

    public function setPetName(string $name)
    {
        $this->setData(self::PET_NAME, $name);
    }

    public function getPetOwner(): string
    {
        return $this->getData(self::PET_OWNER);
    }

    public function setPetOwner(string $petOwner)
    {
        $this->setData(self::PET_OWNER, $petOwner);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function getOwnerTelephone()
    {
        return $this->getData(self::OWNER_TELEPHONE);
    }

    public function setOwnerTelephone(string $ownerTelephone)
    {
        $this->setData(self::OWNER_TELEPHONE, $ownerTelephone);
    }

    public function getOwnerId()
    {
        return $this->getData(self::OWNER_ID);
    }

    public function setOwnerId($ownerId)
    {
        $this->setData(self::OWNER_ID, $ownerId);
    }
}

