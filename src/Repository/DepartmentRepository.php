<?php

namespace App\Repository;

use App\Entity\Department;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Department|null find($id, $lockMode = null, $lockVersion = null)
 * @method Department|null findOneBy(array $criteria, array $orderBy = null)
 * @method Department[]    findAll()
 * @method Department[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepartmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry) {
        parent::__construct($registry, Department::class);
    }
	
    public function findEmailByDepName() {
		return $this->createQueryBuilder('d')
			->andWhere('d.dep_name = dep_name')
			->getQuery()
			->getResult();
	}
    // /**
    //  * @return Department[] Returns an array of Department objects
    //  */
	
	/*
    public function findByExampleField($value) {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Department
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
