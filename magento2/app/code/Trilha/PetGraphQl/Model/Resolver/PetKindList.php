<?php


namespace Trilha\PetGraphQL\Model\Resolver;


use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\Resolver\ContextInterface;
use Magento\Framework\GraphQl\Query\Resolver\Value;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Trilha\Pet\Api\PetRepositoryInterface;
use Magento\Framework\GraphQl\Query\Resolver\Argument\SearchCriteria\Builder as SearchCriteriaBuilder;

class PetKindList implements \Magento\Framework\GraphQl\Query\ResolverInterface
{

    private PetRepositoryInterface $petRepository;
    private SearchCriteriaBuilder $searchCriteriaBuilder;

    public function __construct(
        PetRepositoryInterface $petRepository,
        SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->petRepository = $petRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
    }

    /**
     * @inheritDoc
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $this->validateArgs($args);

        $searchCriteria = $this->searchCriteriaBuilder->build('pet_kind_list', $args);
        $searchCriteria->setPageSize($args['pageSize']);
        $searchResult = $this->petRepository->getList($searchCriteria);

        $items = [
            'total_count' => $searchResult->getTotalCount(),
            'items' => $searchResult->getItems(),
        ];

        return $items;
    }

    private function validateArgs(array $args): void
    {
        if (isset($args['pageSize']) && $args['pageSize'] < 1){
            throw new GraphQlInputException(__('pageSize value must be greater than 0.'));
        }
    }
}
