<?php


namespace Trilha\PetGraphQl\Model\Resolver;


use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Trilha\Pet\Api\PetRepositoryInterface;
use Trilha\Pet\Model\PetFactory;

class PetKindSave implements \Magento\Framework\GraphQl\Query\ResolverInterface
{

    private $petRepository;
    /**
     * @var PetFactory
     */
    private $petFactory;

    public function __construct(PetRepositoryInterface $petRepository, PetFactory $petFactory)
    {
        $this->petRepository = $petRepository;
        $this->petFactory = $petFactory;
    }
    /**
     * @inheritDoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (isset($args['id'])){
            $searchResult = $this->petRepository->getById($args['id']);
            $searchResult->setDescription($args['description']);
            $searchResult->setName($args['name']);
            return $this->petRepository->save($searchResult);
        }
        $pet = $this->petFactory->create();
        $pet->setDescription($args['description']);
        $pet->setName($args['name']);
        return $this->petRepository->save($pet);
    }
}
