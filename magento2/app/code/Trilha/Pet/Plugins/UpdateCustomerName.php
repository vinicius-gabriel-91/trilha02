<?php


namespace Trilha\Pet\Plugins;


use Magento\Customer\Model\Customer;
use Magento\Customer\Model\Session;

class UpdateCustomerName
{

    private Session $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function afterGetDataModel(Customer $customer, $result)
    {
        return $result;
    }

}
