<?php

namespace App\Repository;

use App\Entity\Help;
use App\Entity\Message;
use App\Entity\StatusType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Message|null find($id, $lockMode = null, $lockVersion = null)
 * @method Message|null findOneBy(array $criteria, array $orderBy = null)
 * @method Message[]    findAll()
 * @method Message[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MessageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Message::class);
    }

    public function getReportedMessages()
    {
        return $this->findBy(['reported' => true]);
    }

    public function getUserMessages($user)
    {
        return $this->findBy(['user' => $user]);
    }

    public function getUserSolvedProblems($user)
    {
        return $this->findBy(['solver' => $user, 'solved' => true, 'status' => StatusType::approved()->id()]);
    }
}
