<?php
declare(strict_types=1);

namespace Trilha\Pet\Test\Unit\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Trilha\Pet\Model\Config;

/**
 * Test for Config
 */
class ConfigTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfigMock;

    /**
     * @var Config
     */
    protected $model;

    public function setUp():void
    {
        $this->objectManager = new ObjectManager($this);
        $this->scopeConfigMock = $this->createMock(ScopeConfigInterface::class);
        $this->model = new Config($this->scopeConfigMock);
    }

    /**
     * Test module is enabled should return true
     */
    public function testConfigShouldReturnTrueWhenEnabled()
    {
        $configPath = 'customer/address/pet_name_kind';
        $this->scopeConfigMock
            ->expects($this->once())
            ->method('isSetFlag')
            ->with($configPath)
            ->willReturn(true);
        $this->assertTrue($this->model->isEnabled());
    }
    /**
     * Test module is disabled should return false
     */
    public function testConfigShouldReturnFalseWhenDisabled()
    {
        $configPath = 'customer/address/pet_name_kind';
        $this->scopeConfigMock
            ->expects($this->any())
            ->method('isSetFlag')
            ->with($configPath)
            ->willReturn(false);
        $this->assertEquals(false, $this->model->isEnabled());
    }
}
