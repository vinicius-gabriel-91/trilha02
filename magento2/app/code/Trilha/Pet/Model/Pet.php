<?php


namespace Trilha\Pet\Model;


use Magento\Framework\Model\AbstractExtensibleModel;
use Trilha\Pet\Api\Data\PetInterface;

class Pet extends AbstractExtensibleModel implements PetInterface
{
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init(\Trilha\Pet\Model\ResourceModel\Pet::class);
    }

    public function setEntityId($entityId)
    {
        $this->setData(self::ENTITY_ID, $entityId);
    }

    public function getEntityId(): int
    {
        return (int)$this->getData(self::ENTITY_ID);
    }

    public function getName(): string
    {
       return $this->getData(self::NAME);
    }

    public function setName(string $name)
    {
        $this->setData(self::NAME, $name);
    }

    public function getDescription(): string
    {
       return $this->getData(self::DESCRIPTION);
    }

    public function setDescription(string $description)
    {
        $this->setData(self::DESCRIPTION, $description);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

}
