<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function getOtherUsers(int $userId): array
    {
        $qb = $this->createQueryBuilder('u')
            ->where('u.id != :user_id')
            ->setParameter('user_id', $userId)
            ->getQuery()
        ;

        return $qb->execute();
    }
}