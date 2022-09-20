<?php

namespace App\Repository;

use App\Entity\Dni;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Dni>
 *
 * @method Dni|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dni|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dni[]    findAll()
 * @method Dni[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DniRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dni::class);
    }

    public function add(Dni $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Dni $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

// metodos hechos por mi

    public function guardar( Dni $dni): Dni
    {
        $this->getEntityManager()->persist($dni);
        $this->getEntityManager()->flush();
        return $dni;
    }
    public function recargar(Dni $dni): Dni
    {
        $this->getEntityManager()->refresh($dni);
        return $dni;
    }

    public function delete(Dni $dni): Dni
    {
        $this->em->remove($dni);
        $this->em->flush();
        return $dni;

    }

//    /**
//     * @return Dni[] Returns an array of Dni objects
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

//    public function findOneBySomeField($value): ?Dni
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
