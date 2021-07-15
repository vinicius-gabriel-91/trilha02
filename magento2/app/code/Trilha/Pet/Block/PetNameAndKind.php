<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Trilha\Pet\Block;

use Magento\Customer\Model\SessionFactory;
use Magento\Framework\View\Element\Template\Context;
use Trilha\Pet\Model\Config as Conf;
use Trilha\Pet\Model\PetAttributeSource;

class PetNameAndKind extends \Magento\Framework\View\Element\Template
{
    private $config;
    private $session;
    private $petAttributeSource;

    /**
     * Constructor
     *
     * @param Context  $context
     * @param array $data
     */
    public function __construct(
        Conf $config,
        Context $context,
        SessionFactory $session,
        PetAttributeSource $petAttributeSource,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->config = $config;
        $this->session = $session;
        $this->petAttributeSource = $petAttributeSource;
    }

    public function displayPetNameKind()
    {
        $session = $this->session->create();
        $isLogged = $session->isLoggedIn();
        $isEnabled = $this->config->isEnabled();
        $selectedKind ='';

        if ($isLogged && $isEnabled) {
            $petName = $session->getCustomerData()->getCustomAttribute('new_pet_name')->getValue();
            $kindId = $session->getCustomerData()->getCustomAttribute('new_pet_kind')->getValue();

            $kindList = $this->petAttributeSource->getAllOptions();
            foreach ($kindList as $kind) {
                if ($kind['value'] == $kindId) {
                    $selectedKind = $kind['label'];
                }
            }

            return ("Nome seu pet: $petName || Tipo do pet: $selectedKind");
        }
        return __('');
    }
}
