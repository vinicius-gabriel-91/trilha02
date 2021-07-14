<?php


namespace Trilha\Pet\Test\Unit\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;
use Trilha\Pet\Model\PetRepository;
use Trilha\Pet\Controller\Adminhtml\Index\MassDelete;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\HTTP\PhpEnvironment\Request;
use  Magento\Framework\Message\ManagerInterface;



class MassDeleteTest extends \PHPUnit\Framework\TestCase
{
    private $PetRepositoryMock;

    private $contextMock;

    private $requestMock;
    /**
     * @var MassDelete
     */
    private $subjectTest;
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


    protected function setUp(): void
    {
        $this->PetRepositoryMock = $this->createMock(PetRepository::class);
        $this->contextMock = $this->createMock(context::class);
        $this->requestMock = $this->createMock(Request::class);
        $this->redirectFactory = $this->createMock(RedirectFactory::class);
        $this->resultRedirect = $this->createMock(Redirect::class);
        $this->resultFactoryMock = $this->createMock(ResultFactory::class);
        $this->messageManagerMock = $this->createMock(ManagerInterface::class);

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


        $this->subjectTest = new MassDelete(
            $this->PetRepositoryMock,
            $this->contextMock
        );


    }

    public function testExecute()
    {
        $expectedResult = $this->resultRedirect;
        $idList = ['selected' => [1,2,3,5]];

        $this->requestMock
            ->expects($this->exactly(2))
            ->method('getPostValue')
            ->willReturn($idList);
        $this->PetRepositoryMock
            ->expects($this->any())
            ->method('delete')
            ->willReturn(true);


        $this->assertEquals($expectedResult, $this->subjectTest->execute());

    }

    public function testExecuteExpectsException()
    {
        $expectedResult = $this->resultRedirect;
        $idList = ['selected' => [1,2,3,5]];
        $errorMessage = 'Could not save Pet';

        $this->requestMock
            ->expects($this->exactly(2))
            ->method('getPostValue')
            ->willReturn($idList);
        $this->PetRepositoryMock
            ->expects($this->any())
            ->method('delete')
            ->willThrowException(new \Exception($errorMessage));
        $this->messageManagerMock
            ->expects($this->once())
            ->method('addErrorMessage')
            ->with($errorMessage)
            ->willReturnSelf();


        $this->assertEquals($expectedResult, $this->subjectTest->execute());

    }



}
