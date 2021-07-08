<?php


namespace Trilha\PetGraphQl\Model\Resolver;


use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Trilha\Pet\Api\PetRepositoryInterface;

class PetKindDelete implements \Magento\Framework\GraphQl\Query\ResolverInterface
{

    private $petRepository;

    public function __construct(
        PetRepositoryInterface $petRepository
    )
    {
        $this->petRepository = $petRepository;
    }

    /**
     * @inheritDoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        return $this->petRepository->delete($args['id']);
    }
}
