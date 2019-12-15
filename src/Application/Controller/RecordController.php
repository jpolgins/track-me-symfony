<?php

declare(strict_types=1);

namespace App\Application\Controller;

use App\Domain\Model\Record\Record;
use App\Domain\Model\Record\RecordRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/v13/records")
 */
final class RecordController
{
    private RecordRepository $records;

    public function __construct(RecordRepository $records)
    {
        $this->records = $records;
    }

    /**
     * @param string $timeSpent
     * @param string $description
     *
     * @return JsonResponse
     *
     * @Route(methods={"POST"})
     */
    public function createAction(string $timeSpent, string $description): JsonResponse
    {
        $record = new Record($timeSpent, $description);
        $this->records->add($record);

        return new JsonResponse($record, Response::HTTP_CREATED);
    }

    /**
     * @return JsonResponse
     *
     * @Route(methods={"GET"})
     */
    public function getAction(): JsonResponse
    {
        return new JsonResponse($this->records->all());
    }
}
