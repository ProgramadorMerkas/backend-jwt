<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\DesarrolladoresRepository;

final class DesarrolladoresService
{
    private DesarrolladoresRepository $desarrolladoresRepository;

    public function __construct(DesarrolladoresRepository $desarrolladoresRepository)
    {
        $this->desarrolladoresRepository = $desarrolladoresRepository;
    }

    public function checkAndGet(int $desarrolladoresId): object
    {
        return $this->desarrolladoresRepository->checkAndGet($desarrolladoresId);
    }

    public function getAll(): array
    {
        return $this->desarrolladoresRepository->getAll();
    }

    public function getOne(int $desarrolladoresId): object
    {
        return $this->checkAndGet($desarrolladoresId);
    }

    public function create(array $input): object
    {
        $desarrolladores = json_decode((string) json_encode($input), false);

        return $this->desarrolladoresRepository->create($desarrolladores);
    }

    public function update(array $input, int $desarrolladoresId): object
    {
        $desarrolladores = $this->checkAndGet($desarrolladoresId);
        $data = json_decode((string) json_encode($input), false);

        return $this->desarrolladoresRepository->update($desarrolladores, $data);
    }

    public function delete(int $desarrolladoresId): void
    {
        $this->checkAndGet($desarrolladoresId);
        $this->desarrolladoresRepository->delete($desarrolladoresId);
    }
}
