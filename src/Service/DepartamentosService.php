<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\DepartamentosRepository;

final class DepartamentosService
{
    private DepartamentosRepository $departamentosRepository;

    public function __construct(DepartamentosRepository $departamentosRepository)
    {
        $this->departamentosRepository = $departamentosRepository;
    }

    public function checkAndGet(int $departamentosId): object
    {
        return $this->departamentosRepository->checkAndGet($departamentosId);
    }

    public function getAll(): array
    {
        return $this->departamentosRepository->getAll();
    }

    public function getOne(int $departamentosId): object
    {
        return $this->checkAndGet($departamentosId);
    }

    public function create(array $input): object
    {
        $departamentos = json_decode((string) json_encode($input), false);

        return $this->departamentosRepository->create($departamentos);
    }

    public function update(array $input, int $departamentosId): object
    {
        $departamentos = $this->checkAndGet($departamentosId);
        $data = json_decode((string) json_encode($input), false);

        return $this->departamentosRepository->update($departamentos, $data);
    }

    public function delete(int $departamentosId): void
    {
        $this->checkAndGet($departamentosId);
        $this->departamentosRepository->delete($departamentosId);
    }
}
