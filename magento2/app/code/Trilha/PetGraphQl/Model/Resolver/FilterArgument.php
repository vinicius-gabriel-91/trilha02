<?php


namespace Trilha\PetGraphQL\Model\Resolver;


use Magento\Framework\GraphQl\Query\Resolver\Argument\FieldEntityAttributesInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\ConfigInterface;

class FilterArgument implements FieldEntityAttributesInterface
{

    private ConfigInterface $config;

    public function __construct(ConfigInterface $config)
    {
        $this->config = $config;
    }

    public function getEntityAttributes(): array
    {
        $fields = [];
        /** @var Field $field */
        foreach ($this->config->getConfigElement('PetKind')->getFields() as $field) {
            $fields[$field->getName()] = '';
        }

        return array_keys($fields);
    }
}
