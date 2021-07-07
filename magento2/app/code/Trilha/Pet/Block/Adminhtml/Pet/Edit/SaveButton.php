<?php


namespace Trilha\Pet\Block\Adminhtml\Pet\Edit;


use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use Magento\Backend\Block\Widget\Context;

class SaveButton implements ButtonProviderInterface
{

    private Context $context;

    public function __construct(
        Context $context
    )
    {
        $this->context = $context;
    }

    public function getModelId(): ?string
    {
        return $this->context->getRequest()->getParam('entity_id');
    }

    public function getUrl($route ='', $params = []): string
    {
        $this->context->getUrlBuilder()->getUrl($route, $params);
    }

    public function getButtonData()
    {
        return [
            'label' => __('Save pet'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['event' => 'save'],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}
