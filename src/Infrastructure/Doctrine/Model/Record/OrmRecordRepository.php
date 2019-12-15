<?php

declare(strict_types=1);

namespace App\Infrastructure\Doctrine\Model\Record;

use App\Domain\Model\Record\Record;
use App\Domain\Model\Record\RecordRepository;
use Doctrine\ORM\EntityManager;

final class OrmRecordRepository implements RecordRepository
{
    private EntityManager $em;
    private string $className;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->className = Record::class;
    }

    public function all(): array
    {
        return $this->em->getRepository($this->className)->findAll();
    }

    public function add(Record $record): void
    {
        $this->em->persist($record);
        $this->em->flush($record);
    }
}
