<?php


namespace Trilha\Pet\Model;


use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    const XML_PATH_PET_NAME_KIND = 'customer/address/pet_name_kind';

    private $config;

    public function __construct(
        ScopeConfigInterface $config
    )
    {
        $this->config = $config;
    }


    public function isEnabled()
    {
        return $this->config->getValue(self::XML_PATH_PET_NAME_KIND, \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
    }

}
