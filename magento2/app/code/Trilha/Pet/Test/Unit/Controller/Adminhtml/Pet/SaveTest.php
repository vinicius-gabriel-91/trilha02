<?php


namespace Trilha\Pet\Test\Unit\Controller\Adminhtml\Pet;

use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\HTTP\PhpEnvironment\Request;
use Magento\Framework\Message\ManagerInterface;
use Trilha\Pet\Controller\Adminhtml\Pet\Save;
use Magento\Backend\App\Action\Context;
use Trilha\Pet\Model\PetRepository;
use Trilha\Pet\Model\PetFactory;
use Trilha\Pet\Model\ResourceModel\Pet as PetResource;
use Trilha\Pet\Api\Data\PetInterface;

class SaveTest extends \PHPUnit\Framework\TestCase
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

        $this->redirectFactory
            ->expects($this->once())
            ->method('create')
            ->willReturn($this->resultRedirect);

        $this->resultRedirect
            ->expects($this->once())
            ->method('setPath')
            ->with('trilha/index/index')
            ->willReturnSelf();

        $this->contextMock
            ->expects($this->any())
            ->method('getMessageManager')
            ->willReturn($this->messageManagerMock);

        $this->subjectTest = new Save(
            $this->petResourceMock,
            $this->contextMock,
            $this->petFactoryMock,
            $this->petRepositoryMock
        );
    }

    public function testExecute()
    {
        $expectedResult = $this->resultRedirect;
        $arguments = [
            'requestValue' => [
                'general' => [
                    'entity_id' => 53
                ],
                'name' => 'teste',
                'description' => 'teste'
                ],
        ];

        $this->requestMock
            ->expects($this->once())
            ->method('getPostValue')
            ->willReturn($arguments['requestValue']);
        $this->petRepositoryMock
            ->expects($this->once())
            ->method('getById')
            ->willReturn($this->petInterfaceMock);
        $this->petInterfaceMock
            ->expects($this->once())
            ->method('setName');
        $this->petInterfaceMock
            ->expects($this->once())
            ->method('setDescription');
        $this->petRepositoryMock
            ->expects($this->once())
            ->method('save')
            ->with($this->petInterfaceMock)
            ->willReturn(true);
        $this->assertEquals($expectedResult, $this->subjectTest->execute());
    }

    public function testExecuteExpectsException()
    {
        $expectedResult = $this->resultRedirect;
        $arguments = [
            'requestValue' => [
                'general' => [
                    'entity_id' => 53
                ],
                'name' => 'teste',
                'description' => 'teste'
                ],
        ];
        $errorMessage = 'Could not save Pet';

        $this->requestMock
            ->expects($this->once())
            ->method('getPostValue')
            ->willReturn($arguments['requestValue']);
        $this->petRepositoryMock
            ->expects($this->once())
            ->method('getById')
            ->willReturn($this->petInterfaceMock);
        $this->petInterfaceMock
            ->expects($this->once())
            ->method('setName');
        $this->petInterfaceMock
            ->expects($this->once())
            ->method('setDescription');
        $this->petRepositoryMock
            ->expects($this->once())
            ->method('save')
            ->with($this->petInterfaceMock)
            ->willThrowException(new \Exception($errorMessage));
        $this->messageManagerMock
            ->expects($this->once())
            ->method('addErrorMessage')
            ->with($errorMessage)
            ->willReturnSelf();

        $this->assertEquals($expectedResult, $this->subjectTest->execute());
    }
}
