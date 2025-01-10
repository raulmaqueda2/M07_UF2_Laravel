<?php
namespace App\Models;


class film
{
    private $name;
    private $year;
    private $genre;
    private $country;
    private $duration;
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

}