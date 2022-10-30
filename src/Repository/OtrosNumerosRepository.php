<?php

namespace App\Repository;

use App\Entity\OtrosNumeros;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OtrosNumeros>
 *
 * @method OtrosNumeros|null find($id, $lockMode = null, $lockVersion = null)
 * @method OtrosNumeros|null findOneBy(array $criteria, array $orderBy = null)
 * @method OtrosNumeros[]    findAll()
 * @method OtrosNumeros[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OtrosNumerosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OtrosNumeros::class);
    }

    public function save(OtrosNumeros $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(OtrosNumeros $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return OtrosNumeros[] Returns an array of OtrosNumeros objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('o.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?OtrosNumeros
//    {
//        return $this->createQueryBuilder('o')
//            ->andWhere('o.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
