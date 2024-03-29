<?php

namespace App\Repository;

use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contact>
 *
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    /**
     * @return Contact[] Returns an array of contact objects
     */
    public function search(string $search): array
    {
        $qb = $this->createQueryBuilder('c')
            ->addSelect('ca as category')
            ->leftJoin('c.category', 'ca')
            ->where('c.lastname LIKE :search')
            ->orWhere('c.firstname LIKE :search')
            ->orderBy('c.lastname', 'ASC')
            ->setParameter(':search', "%{$search}%");

        //        $qb->expr()->orX(
        //            $qb->expr()->like('c.lastname', ':search'),
        //            $qb->expr()->like('c.firstname', ':search')
        //        )

        $query = $qb->getQuery();

        return $query->execute();
    }

    /**
     * @throws NonUniqueResultException
     */
    public function findWithCategory(int $id): ?Contact
    {
        $qb = $this->createQueryBuilder('co')
                    ->addSelect('c as category')
                    ->leftJoin('co.category', 'c')
                    ->where('co.id = :id')
                    ->setParameter(':id', "$id");

        return $qb->getQuery()->getOneOrNullResult(); // A utiliser quand on recupère qu'un seul resultat
    }

    //    /**
    //     * @return Contact[] Returns an array of Contact objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Contact
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
