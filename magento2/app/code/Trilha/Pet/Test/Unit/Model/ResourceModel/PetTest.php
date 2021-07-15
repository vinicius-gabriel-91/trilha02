<?php


namespace Trilha\Pet\Test\Unit\Model\ResourceModel;

use Trilha\Pet\Model\ResourceModel\Pet;
use Magento\Framework\Model\ResourceModel\Db\Context;

class PetTest extends \Codeception\PHPUnit\TestCase
{
    protected function setUp(): void
    {
        $contextMock = $this->createMock(Context::class);
        $subjectTest = new Pet($contextMock);
    }

    /**
     * Test Empty
     */
    public function testEmpty(): void
    {
        $this->assertNull(null);
    }
}
