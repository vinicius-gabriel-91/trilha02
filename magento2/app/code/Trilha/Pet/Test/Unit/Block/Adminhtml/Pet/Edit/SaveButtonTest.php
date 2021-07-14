<?php


namespace Trilha\Pet\Test\Unit\Block\Adminhtml\Pet\Edit;


use PHPUnit\Framework\TestCase;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Trilha\Pet\Block\Adminhtml\Pet\Edit\SaveButton;

class SaveButtonTest extends TestCase
{
    private $objectManager;

    private $testSubject;

    public function setUp(): void
    {
        $this->objectManager = new ObjectManager($this);

        $this->testSubject = $this->objectManager->getObject(
            SaveButton::class
        );
    }

        public function testGetButtonData(): void
    {
        //Arrange
        $expectedResult = [
            'label' => __('Save pet'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['event' => 'save'],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];

        //Act
        $result = $this->testSubject->getButtonData();

        //Assert
        $this->assertEquals($expectedResult,$result);
    }
}
