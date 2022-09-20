<?php

namespace App\Repository;

use App\Entity\Destino;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Destino>
 *
 * @method Destino|null find($id, $lockMode = null, $lockVersion = null)
 * @method Destino|null findOneBy(array $criteria, array $orderBy = null)
 * @method Destino[]    findAll()
 * @method Destino[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DestinoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Destino::class);
    }

    public function add(Destino $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Destino $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function save(Destino $destino): Destino
    {
        $this->getEntityManager()->persist($destino);
        $this->getEntityManager()->flush();
        return $destino;
    }

//    /**
//     * @return Destino[] Returns an array of Destino objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Destino
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
