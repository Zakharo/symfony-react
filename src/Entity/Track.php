<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="track")
 * @ORM\HasLifecycleCallbacks
 */
class Track extends BaseEntity
{
    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $singer;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $genre;

    /**
     * @var int
     * @ORM\Column(type="integer", nullable=false)
     */
    private $year;

    /**
     * @return string
     */
    public function getSinger(): string
    {
        return $this->singer;
    }

    /**
     * @param string $singer
     * @return Track
     */
    public function setSinger(string $singer): self
    {
        $this->singer = $singer;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Track
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getGenre(): string
    {
        return $this->genre;
    }

    /**
     * @param string $genre
     * @return Track
     */
    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     * @return Track
     */
    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'singer' => $this->singer,
            'name' => $this->name,
            'genre' => $this->genre,
            'year' => $this->year
        ];
    }
}
