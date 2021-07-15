<?php


namespace Trilha\Pet\Test\Unit\Model;

use Magento\Framework\Model\Context;
use Magento\Framework\Registry;
use Trilha\Pet\Model\ResourceModel\Pet as ResourceModel;
use Trilha\Pet\Model\ResourceModel\Pet\Collection;
use Trilha\Pet\Model\Pet;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

class PetTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Context|\PHPUnit\Framework\MockObject\MockObject
     */
    private $contextMock;
    /**
     * @var Registry|\PHPUnit\Framework\MockObject\MockObject
     */
    private $registryMock;
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|ResourceModel
     */
    private $resourceMock;
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|Collection
     */
    private $resourceCollectionMock;
    /**
     * @var Pet
     */
    private $testSubject;
    /**
     * @var ObjectManager
     */
    private $objectManager;

    protected function setUp(): void
    {
        $this->objectManager = new ObjectManager($this);

        $this->contextMock = $this->createMock(Context::class);
        $this->registryMock = $this->createMock(Registry::class);
        $this->resourceMock = $this->createMock(ResourceModel::class);
        $this->resourceCollectionMock = $this->createMock(Collection::class);

        $this->testSubject = $this->objectManager->getObject(
            Pet::class,
            [
                'context' => $this->contextMock,
                'registry' => $this->registryMock,
                'resource' => $this->resourceMock,
                'resourceCollection' => $this->resourceCollectionMock,
            ]
        );
    }

    public function testGetSetEntityId(): void
    {
        $id = '1';
        //Arrange
        $this->testSubject->setEntityId($id);

        //Act
        $result = $this->testSubject->getEntityId();

        //Assert
        $this->assertEquals($id, $result);
    }

    public function testGetSetName(): void
    {
        $name = 'teste';
        //Arrange
        $this->testSubject->setName($name);

        //Act
        $result = $this->testSubject->getName();

        //Assert
        $this->assertEquals($name, $result);
    }

    public function testGetSetDescription(): void
    {
        $Description = 'teste';
        //Arrange
        $this->testSubject->setDescription($Description);

        //Act
        $result = $this->testSubject->getDescription();

        //Assert
        $this->assertEquals($Description, $result);
    }
}
