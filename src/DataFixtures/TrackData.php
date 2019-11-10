<?php

namespace App\DataFixtures;

use App\Entity\Track;
use Doctrine\Common\Persistence\ObjectManager;

class TrackData extends BaseFixture
{
    private const TRACKS = [
        [
            'singer' => 'The Kingston Trio',
            'name' => 'Tom Dooley',
            'genre' => 'Folk',
            'year' => 1958
        ],
        [
            'singer' => 'Led Zeppelin',
            'name' => 'Kashmir',
            'genre' => 'Rock',
            'year' => 1975
        ],
        [
            'singer' => 'Miles Davis',
            'name' => 'Blue in Green',
            'genre' => 'Jazz',
            'year' => 1959
        ],
        [
            'singer' => 'Muddy Waters',
            'name' => 'Mannish Boy',
            'genre' => 'Blues',
            'year' => 1955
        ]
    ];

    /**
     * @param ObjectManager $manager
     */
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(count(self::TRACKS), 'main_tracks', function ($i) {
            $track = (new Track())
                ->setSinger(self::TRACKS[$i]['singer'])
                ->setName(self::TRACKS[$i]['name'])
                ->setGenre(self::TRACKS[$i]['genre'])
                ->setYear(self::TRACKS[$i]['year']);

            return $track;
        });
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 0;
    }
}