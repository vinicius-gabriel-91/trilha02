<?php


namespace Trilha\Pet\Model;

use Trilha\Pet\Model\PetRepository;

class PetAttributeSource extends \Magento\Eav\Model\Entity\Attribute\Source\AbstractSource
{
    private $petRepository;

    public function __construct(
        PetRepository $petRepository
    ) {
        $this->petRepository = $petRepository;
    }

    public function getAllOptions()
    {
        $kindList = $this->petRepository->getList()->getItems();

        foreach ($kindList as $item) {
            $this->_options[] =
                ['value' => $item->getEntityId(),
                'label' => $item->getName()
                ];
        }
        return $this->_options;
    }
}
