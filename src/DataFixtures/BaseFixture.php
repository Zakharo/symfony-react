<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

abstract class BaseFixture extends Fixture implements OrderedFixtureInterface
{
    /**
     * @var ObjectManager
     */
    public $manager;

    abstract protected function loadData(ObjectManager $manager);

    public function load(ObjectManager $manager):void
    {
        $this->manager = $manager;
        $this->loadData($manager);
        $manager->flush();
    }

    protected function createMany(int $count, string $groupName, callable $factory):void
    {
        for ($i = 0; $i < $count; $i++) {
            $entity = $factory($i);

            if (null === $entity) {
                throw new \LogicException(
                    'Did you forget to return the entity object from your callback to BaseFixture::createMany()?'
                );
            }

            $this->manager->persist($entity);

            $this->addReference(sprintf('%s_%d', $groupName, $i), $entity);
        }
    }
}
