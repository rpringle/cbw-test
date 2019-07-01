<?php

namespace App\Repository;

use App\Entity\Contacts;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Contacts|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contacts|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contacts[]    findAll()
 * @method Contacts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactsRepository extends ServiceEntityRepository
{
        
    public function __construct(RegistryInterface $registry)
    {        
        parent::__construct($registry, Contacts::class);
    }
    
    /**
     * Find contacts
     * 
     * @param $active
     * @param $state
     * @param $sort
     * @param $direction
     * @return Contacts[]
     */
    public function findContacts($active, $state, $sort, $direction): array
    {
        $qb = $this->createQueryBuilder('c');
        
        if ($active != 'all') {
            $qb->andWhere('c.active = :active');
            $qb->setParameter('type', $active);
        }
        if ($state != 'all') {
            $qb->andWhere('c.state = :state');
            $qb->setParameter('state', $state);
        }
        
        $qb->orderBy($sort, $direction);
        $qb->getQuery();

        // TODO: Figure out the proper method for dynamically building a query
        // using QueryBuilder. Currently returns the following error:
        // Attempted to call an undefined method named "execute" of class "Doctrine\ORM\QueryBuilder"
        return $qb->execute();
    }
    
    /**
     * @param $sort
     * @param $direction
     * @return Contacts[]
     */
    public function findAllContacts($sort, $direction): array
    {
        // Select all, sort by passed field
        $qb = $this->createQueryBuilder('c')
            ->orderBy($sort, $direction)
            ->getQuery();

        return $qb->execute();
    }

    // /**
    //  * @return Contacts[] Returns an array of Contacts objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Contacts
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
