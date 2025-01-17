<?php
namespace App\Repositories;

use Doctrine\ORM\EntityRepository;
use App\Models\film;

class FilmRepository extends EntityRepository
{
    /**
     * Encuentra todas las películas.
     *
     * @return film[]
     */
    public function findAllFilms(): array
    {
        return $this->findAll();
    }

    /**
     * Encuentra una película por su nombre.
     *
     * @param string $name
     * @return film|null
     */
    public function findFilmByName(string $name): ?film
    {
        return $this->findOneBy(['name' => $name]);
    }

    /**
     * Encuentra películas por género.
     *
     * @param string $genre
     * @return film[]
     */
    public function findFilmsByGenre(string $genre): array
    {
        return $this->findBy(['genre' => $genre]);
    }

    /**
     * Guarda o actualiza una película.
     *
     * @param film $film
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function saveFilm(film $film): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->persist($film);
        $entityManager->flush();
    }

    /**
     * Elimina una película.
     *
     * @param film $film
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function deleteFilm(film $film): void
    {
        $entityManager = $this->getEntityManager();
        $entityManager->remove($film);
        $entityManager->flush();
    }
}
