<?php


namespace Trilha\Pet\Test\Unit\Controller\Adminhtml\Pet;

use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\HTTP\PhpEnvironment\Request;
use Magento\Framework\Message\ManagerInterface;
use Trilha\Pet\Controller\Adminhtml\Pet\Edit;
use Magento\Backend\App\Action\Context;
use Trilha\Pet\Model\PetRepository;
use Trilha\Pet\Model\PetFactory;
use Trilha\Pet\Model\ResourceModel\Pet as PetResource;
use Trilha\Pet\Api\Data\PetInterface;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\View\Page\Config;
use Magento\Framework\View\Page\Title;

class EditTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var Context|\PHPUnit\Framework\MockObject\MockObject
     */
    private $contextMock;
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|PetRepository
     */
    private $petRepositoryMock;
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|PetFactory
     */
    private $petFactoryMock;
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|PetResource
     */
    private $petResourceMock;
    /**
     * @var Request|\PHPUnit\Framework\MockObject\MockObject
     */
    private $requestMock;
    /**
     * @var RedirectFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    private $redirectFactory;
    /**
     * @var Redirect|\PHPUnit\Framework\MockObject\MockObject
     */
    private $resultRedirect;
    /**
     * @var ResultFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    private $resultFactoryMock;
    /**
     * @var ManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    private $messageManagerMock;
    /**
     * @var Save
     */
    private $subjectTest;
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|PetInterface
     */
    private $petInterfaceMock;
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $pageFactory;
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $resultPage;
    /**
     * @var Config|\PHPUnit\Framework\MockObject\MockObject
     */
    private $pageConfigMock;
    /**
     * @var Title|\PHPUnit\Framework\MockObject\MockObject
     */
    private $titleMock;

    protected function setUp(): void
    {
        $this->contextMock = $this->createMock(Context::class);
        $this->petRepositoryMock = $this->createMock(PetRepository::class);
        $this->petFactoryMock = $this->createMock(PetFactory::class);
        $this->petResourceMock = $this->createMock(PetResource::class);
        $this->requestMock = $this->createMock(Request::class);
        $this->redirectFactory = $this->createMock(RedirectFactory::class);
        $this->resultRedirect = $this->createMock(Redirect::class);
        $this->resultFactoryMock = $this->createMock(ResultFactory::class);
        $this->messageManagerMock = $this->createMock(ManagerInterface::class);
        $this->petInterfaceMock = $this->createMock(PetInterface::class);
        $this->pageFactory = $this->createMock(PageFactory::class);
        $this->resultPage = $this->createMock(Page::class);
        $this->pageConfigMock = $this->createMock(Config::class);
        $this->titleMock = $this->createMock(Title::class);

        $this->contextMock
            ->expects($this->any())
            ->method('getRequest')
            ->willReturn($this->requestMock);

        $this->contextMock
            ->expects($this->any())
            ->method('getResultRedirectFactory')
            ->willReturn($this->redirectFactory);

        $this->contextMock
            ->expects($this->any())
            ->method('getResultFactory')
            ->willReturn($this->resultFactoryMock);


        $this->contextMock
            ->expects($this->any())
            ->method('getMessageManager')
            ->willReturn($this->messageManagerMock);

        $this->subjectTest = new Edit(
            $this->contextMock,
            $this->petRepositoryMock,
            $this->pageFactory
        );
    }

    public function testExecute()
    {
        $expectedResult = $this->resultPage;
        $arguments = [
            'id' => 15,
            'title' => __('Edit pet kind %1', '')
        ];

        $this->requestMock
            ->expects($this->once())
            ->method('getParam')
            ->willReturn($arguments['id']);
        $this->petRepositoryMock
            ->expects($this->once())
            ->method('getById')
            ->willReturn($this->petInterfaceMock);
        $this->pageFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->resultPage);
        $this->resultPage
            ->expects($this->atLeastOnce())
            ->method('getConfig')
            ->willReturn($this->pageConfigMock);
        $this->pageConfigMock
            ->expects($this->atLeastOnce())
            ->method('getTitle')
            ->willReturn($this->titleMock);
        $this->titleMock
            ->expects($this->once())
            ->method('prepend')
            ->with($arguments['title']);

        $this->assertEquals($expectedResult, $this->subjectTest->execute());
    }

    public function testExecuteExpectsException()
    {
        $expectedResult = $this->resultRedirect;
        $arguments = [
            'id' => 15,
            'title' => __('Edit pet kind %1', ''),
            'errormessage' => 'This Pet no longer exists.'
        ];

        $this->requestMock
            ->expects($this->once())
            ->method('getParam')
            ->willReturn($arguments['id']);
        $this->petRepositoryMock
            ->expects($this->once())
            ->method('getById')
            ->willThrowException(new \Exception($arguments['errormessage']));
        $this->messageManagerMock
            ->expects($this->once())
            ->method('addErrorMessage')
            ->with($arguments['errormessage'])
            ->willReturnSelf();
        $this->redirectFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->resultRedirect);
        $this->resultRedirect
            ->expects($this->once())
            ->method('setPath')
            ->with('*/*/')
            ->willReturnSelf();

        $this->assertEquals($expectedResult, $this->subjectTest->execute());
    }
}
