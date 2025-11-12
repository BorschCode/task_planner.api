<?php

namespace App\Repository;

use App\Entity\ApiToken;
use DateTimeImmutable;
use DateTimeInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ApiToken>
 *
 * @method ApiToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method ApiToken|null findOneBy(array<string, mixed> $criteria, array<string, string> $orderBy = null)
 * @method ApiToken[]    findAll()
 * @method ApiToken[]    findBy(array<string, mixed> $criteria, array<string, string> $orderBy = null, $limit = null, $offset = null)
 */
class ApiTokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ApiToken::class);
    }
}
