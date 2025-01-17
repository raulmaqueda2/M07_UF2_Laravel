<?php
namespace App\Models;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class film
{
    #[ORM\Id]
    #[ORM\Column(type: "string", nullable: false)]
    private $name;

    #[ORM\Column(type: "integer", nullable: false)]
    private $year;

    #[ORM\Column(type: "string", nullable: false)]
    private $genre;

    #[ORM\Column(type: "string", nullable: false)]
    private $country;

    #[ORM\Column(type: "integer", nullable: false)]
    private $duration;

    #[ORM\Column(type: "string", nullable: false)]
    private $img_url;

    public function __construct(
        $name,
        $year,
        $genre,
        $country,
        $duration,
        $img_url
    ) {
        $this->name = $name;
        $this->year = $year;
        $this->genre = $genre;
        $this->country = $country;
        $this->duration = $duration;
        $this->img_url = $img_url;
    }

    // Getters
    public function getName(): string
    {
        return $this->name;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getImgUrl(): string
    {
        return $this->img_url;
    }

    // Setters
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setYear(int $year): void
    {
        $this->year = $year;
    }

    public function setGenre(string $genre): void
    {
        $this->genre = $genre;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    public function setImgUrl(string $img_url): void
    {
        $this->img_url = $img_url;
    }
}
