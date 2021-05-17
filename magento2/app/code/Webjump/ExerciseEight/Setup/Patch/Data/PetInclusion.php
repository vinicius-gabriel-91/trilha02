<?php


namespace Webjump\ExerciseEight\Setup\Patch\Data;


use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Webjump\ExerciseEight\Model\ExerciseEight;
use Webjump\ExerciseEight\Model\ExerciseEightFactory;
use Webjump\ExerciseEight\Model\ExerciseEightRepository;


class PetInclusion implements DataPatchInterface
{
    /**
     * @var ExerciseEight
     */
    private $exerciseEight;
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;
    /**
     * @var ExerciseEightRepository
     */
    private $exerciseEightRepository;

    public function __construct(
        ExerciseEightFactory $exerciseEight,
        ModuleDataSetupInterface $moduleDataSetup,
        ExerciseEightRepository $exerciseEightRepository
    )
    {
        $this->exerciseEight = $exerciseEight;
        $this->moduleDataSetup = $moduleDataSetup;
        $this->exerciseEightRepository = $exerciseEightRepository;
    }


    /**
     * @inheritDoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getAliases()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $this->addPet();
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    public function addPet()
    {
        $petIncluded = $this->exerciseEight->create();
        $petIncluded->setPetName('Jully');
        $petIncluded->setPetOwner('Maisa');
        $petIncluded->setOwnerTelephone('9555655585');
        $petIncluded->setOwnerId(2);

        $this->exerciseEightRepository->save($petIncluded);
    }
}
