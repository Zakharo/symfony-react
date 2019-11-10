<?php

namespace App\Http\Handler;

use App\Entity\Track;
use App\Http\Request\CreateTrackRequest;
use Doctrine\ORM\EntityManagerInterface;

class CreateTrackHandler
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * CreateTrackHandler constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param CreateTrackRequest $request
     */
    public function __invoke(CreateTrackRequest $request)
    {
        $track = (new Track())
            ->setSinger($request->getSinger())
            ->setName($request->getName())
            ->setYear($request->getYear())
            ->setGenre($request->getGenre());

        $this->em->persist($track);
        $this->em->flush();
    }
}