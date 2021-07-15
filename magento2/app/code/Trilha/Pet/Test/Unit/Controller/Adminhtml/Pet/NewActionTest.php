<?php


namespace Trilha\Pet\Test\Unit\Controller\Adminhtml\Pet;

use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\Page;
use Trilha\Pet\Controller\Adminhtml\Pet\NewAction;
use Magento\Backend\App\Action\Context;

class NewActionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var ResultFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    private $resultFactoryMock;
    /**
     * @var Context|\PHPUnit\Framework\MockObject\MockObject
     */
    private $contextMock;
    /**
     * @var Index
     */
    private $subjectTest;
    /**
     * @var Page|\PHPUnit\Framework\MockObject\MockObject
     */
    private $resultPageMock;

    protected function setUp(): void
    {
        $this->resultFactoryMock = $this->createMock(ResultFactory::class);
        $this->contextMock = $this->createMock(Context::class);
        $this->resultPageMock = $this->createMock(Page::class);

        $this->contextMock
            ->expects($this->once())
            ->method('getResultFactory')
            ->willReturn($this->resultFactoryMock);

        $this->subjectTest = new NewAction($this->contextMock);
    }

    public function testExecute()
    {
        $expectedResult = $this->resultPageMock;

        $this->resultFactoryMock
            ->expects($this->once())
            ->method('create')
            ->with($this->resultFactoryMock::TYPE_PAGE)
            ->willReturn($this->resultPageMock);

        $this->assertEquals($expectedResult, $this->subjectTest->execute());

    }
}
