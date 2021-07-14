<?php


namespace Trilha\Pet\Test\Unit\Block;

use Magento\Framework\Api\AttributeInterface;
use Trilha\Pet\Block\PetNameAndKind;
use Magento\Customer\Model\SessionFactory;
use Magento\Customer\Model\Session;
use Trilha\Pet\Model\Config;
use Trilha\Pet\Model\PetAttributeSource;
use Magento\Framework\View\Element\Template\Context;
use Magento\Customer\Api\Data\CustomerInterface;

class PetNameAndKindTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $sessionFactoryMock;
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|Config
     */
    private $configMock;
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|PetAttributeSource
     */
    private $petAttributeSourceMock;
    /**
     * @var object
     */
    private $petNameAndKindConfig;

    private $sessionMock;
    /**
     * @var Context|\PHPUnit\Framework\MockObject\MockObject
     */
    private $contextMock;
    /**
     * @var CustomerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private $customerDataMock;
    /**
     * @var AttributeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private $attributeInterfaceMock;

    public function setUp(): void
    {

        $this->sessionFactoryMock = $this->createMock(SessionFactory::class);
        $this->configMock = $this->createMock(Config::class);
        $this->sessionMock = $this->createMock(Session::class);
        $this->petAttributeSourceMock = $this->createMock(PetAttributeSource::class);
        $this->contextMock = $this->createMock(Context::class);
        $this->customerDataMock = $this->createMock(CustomerInterface::class);
        $this->attributeInterfaceMock = $this->createMock(AttributeInterface::class);
        $this->petNameAndKindConfig = new PetNameAndKind($this->configMock,$this->contextMock,$this->sessionFactoryMock,$this->petAttributeSourceMock);
    }

    public function testShouldReturnMessageWhenCustomerLoggedInAndConfigIsEnabled()
    {
        $petName = "Nome";
        $kindId = 17;
        $selectedKind = 'teste';
        $expectedMessage = "Nome seu pet: $petName || Tipo do pet: $selectedKind";
        $kindList = [['value' => 17, 'label' => 'teste']];

        $this->sessionFactoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->sessionMock);
        $this->sessionMock
            ->expects($this->once())
            ->method('isLoggedIn')
            ->willReturn(true);
        $this->configMock
            ->expects($this->once())
            ->method('isEnabled')
            ->willReturn(true);
        $this->sessionMock
            ->expects($this->exactly(2))
            ->method('getCustomerData')
            ->willReturn($this->customerDataMock);
        $this->customerDataMock
            ->expects($this->exactly(2))
            ->method('getCustomAttribute')
            ->withConsecutive(['new_pet_name'], ['new_pet_kind'])
            ->willReturn($this->attributeInterfaceMock);
        $this->attributeInterfaceMock
            ->expects($this->exactly(2))
            ->method('getValue')
            ->willReturnOnConsecutiveCalls($petName, $kindId);
        $this->petAttributeSourceMock
            ->expects($this->once())
            ->method('getAllOptions')
            ->willReturn($kindList);

        $this->assertEquals($expectedMessage, $this->petNameAndKindConfig->displayPetNameKind());
    }

        public function testShouldReturnEmptyMessageWhenCustomerIsNotLoggedInButConfigIsEnabled()
    {
        $petName = "Nome";
        $kindId = 17;
        $selectedKind = 'teste';
        $expectedMessage = "";
        $kindList = [['value' => 17, 'label' => 'teste']];

        $this->sessionFactoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->sessionMock);
        $this->sessionMock
            ->expects($this->once())
            ->method('isLoggedIn')
            ->willReturn(false);
        $this->configMock
            ->expects($this->once())
            ->method('isEnabled')
            ->willReturn(true);
        $this->sessionMock
            ->expects($this->never())
            ->method('getCustomerData')
            ->willReturn($this->customerDataMock);
        $this->customerDataMock
            ->expects($this->never())
            ->method('getCustomAttribute')
            ->withConsecutive(['new_pet_name'], ['new_pet_kind'])
            ->willReturn($this->attributeInterfaceMock);
        $this->attributeInterfaceMock
            ->expects($this->never())
            ->method('getValue')
            ->willReturnOnConsecutiveCalls($petName, $kindId);
        $this->petAttributeSourceMock
            ->expects($this->never())
            ->method('getAllOptions')
            ->willReturn($kindList);

        $this->assertEquals($expectedMessage, $this->petNameAndKindConfig->displayPetNameKind());
    }

        public function testShouldReturnEmptyMessageWhenCustomerIsLoggedInButConfigIsDisabled()
    {
        $petName = "Nome";
        $kindId = 17;
        $selectedKind = 'teste';
        $expectedMessage = "";
        $kindList = [['value' => 17, 'label' => 'teste']];

        $this->sessionFactoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->sessionMock);
        $this->sessionMock
            ->expects($this->once())
            ->method('isLoggedIn')
            ->willReturn(true);
        $this->configMock
            ->expects($this->once())
            ->method('isEnabled')
            ->willReturn(false);
        $this->sessionMock
            ->expects($this->never())
            ->method('getCustomerData')
            ->willReturn($this->customerDataMock);
        $this->customerDataMock
            ->expects($this->never())
            ->method('getCustomAttribute')
            ->withConsecutive(['new_pet_name'], ['new_pet_kind'])
            ->willReturn($this->attributeInterfaceMock);
        $this->attributeInterfaceMock
            ->expects($this->never())
            ->method('getValue')
            ->willReturnOnConsecutiveCalls($petName, $kindId);
        $this->petAttributeSourceMock
            ->expects($this->never())
            ->method('getAllOptions')
            ->willReturn($kindList);

        $this->assertEquals($expectedMessage, $this->petNameAndKindConfig->displayPetNameKind());
    }

        public function testShouldReturnEmptyMessageWhenCustomerIsNotLoggedInAndConfigIsDisabled()
    {
        $petName = "Nome";
        $kindId = 17;
        $selectedKind = 'teste';
        $expectedMessage = "";
        $kindList = [['value' => 17, 'label' => 'teste']];

        $this->sessionFactoryMock
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->sessionMock);
        $this->sessionMock
            ->expects($this->once())
            ->method('isLoggedIn')
            ->willReturn(false);
        $this->configMock
            ->expects($this->once())
            ->method('isEnabled')
            ->willReturn(false);
        $this->sessionMock
            ->expects($this->never())
            ->method('getCustomerData')
            ->willReturn($this->customerDataMock);
        $this->customerDataMock
            ->expects($this->never())
            ->method('getCustomAttribute')
            ->withConsecutive(['new_pet_name'], ['new_pet_kind'])
            ->willReturn($this->attributeInterfaceMock);
        $this->attributeInterfaceMock
            ->expects($this->never())
            ->method('getValue')
            ->willReturnOnConsecutiveCalls($petName, $kindId);
        $this->petAttributeSourceMock
            ->expects($this->never())
            ->method('getAllOptions')
            ->willReturn($kindList);

        $this->assertEquals($expectedMessage, $this->petNameAndKindConfig->displayPetNameKind());
    }
}
