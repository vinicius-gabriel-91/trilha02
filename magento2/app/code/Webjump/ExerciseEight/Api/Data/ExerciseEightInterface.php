<?php

namespace Webjump\ExerciseEight\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

interface ExerciseEightInterface extends ExtensibleDataInterface
{
    const ENTITY_ID = 'entity_id';
    const PET_NAME = 'pet_name';
    const PET_OWNER = 'pet_owner';
    const CREATED_AT = 'created_at';
    const OWNER_TELEPHONE = 'owner_telephone';
    const OWNER_ID = 'owner_id';

    /**
     * @return mixed
     */
    public function getEntityId();

    /**
     * @param $entityId
     * @return mixed
     */
    public function setEntityId($entityId);

    /**
     * Get Pet Name
     *
     * @return string
     */
    public function getPetName();

    /**
     * setPetName
     *
     * @param string $name
     * @return void
     */
    public function setPetName(string $name);

    /**
     * Get Pet Owner
     *
     * @return string
     */
    public function getPetOwner();

    /**
     * setPetName
     *
     * @param string $petOwner
     * @return void
     */
    public function setPetOwner(string $petOwner);

    /**
     * Get Created At
     *
     * @return string
     */
    public function getCreatedAt();

    /**
     * Get Owner Telephone
     *
     * @return string
     */
    public function getOwnerTelephone();

    /**
     * setPetName
     *
     * @param string $ownerTelephone
     * @return void
     */
    public function setOwnerTelephone(string $ownerTelephone);

    /**
     * Get Owner Id
     *
     * @return string
     */
    public function getOwnerId();

    /**
     * setPetName
     *
     * @param string $getOwnerId
     * @return void
     */
    public function setOwnerId($ownerId);

}
