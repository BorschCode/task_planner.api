<?php

namespace App\Repository;

use App\Entity\User;
use DateTimeImmutable;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @implements PasswordUpgraderInterface<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array<string, mixed> $criteria, array<string, string> $orderBy = null)
 * @method User[] findAll()
 * phpcs:disable
 * @method User[] findBy(array<string, mixed> $criteria, array<string, string> $orderBy = null, $limit = null, $offset = null)
 * phpcs:enable
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        /** @var User $user */
        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function findByAccessToken(string $accessToken): ?User
    {
        $now = new DateTimeImmutable();
        return $this->createQueryBuilder('u')
            // Replace 'accessTokens' with the actual property name representing the association
            ->leftJoin('u.apiTokens', 'at')
            ->where('at.token = :accessToken')
            ->andWhere('at.expiresAt > :date')
            ->setParameter('accessToken', $accessToken)
            ->setParameter('date', $now)
            ->getQuery()
            ->getOneOrNullResult();
    }
}
