<?php

namespace App\Repository;

use App\Entity\Pokemon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Pokemon>
 */
class PokemonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pokemon::class);
    }


    public function findLikeTitle($search)
    {
//           createQueryBuilder는 constructeur de request
//        1. QueryBuilder 인스턴스를 생성
        $qb = $this->createQueryBuilder('pokemon');

//        2. 쿼리 설정
        $query = $qb->select('pokemon')
            ->where('pokemon.title LIKE :search')
            ->setParameter('search', '%' . $search . '%')
            ->getQuery();

//        3. 쿼리 실행 후 결과 반환
        $pokemons = $query->getArrayResult();
        return $pokemons;
    }

    //    /**
    //     * @return Pokemon[] Returns an array of Pokemon objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Pokemon
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
