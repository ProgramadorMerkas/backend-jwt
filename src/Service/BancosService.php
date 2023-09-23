<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\BancosRepository;

final class BancosService
{
    private BancosRepository $bancosRepository;

    public function __construct(BancosRepository $bancosRepository)
    {
        $this->bancosRepository = $bancosRepository;
    }

    public function checkAndGet(int $bancosId): object
    {
        return $this->bancosRepository->checkAndGet($bancosId);
    }

    public function getAll(): array
    {
        return $this->bancosRepository->getAll();
    }

    public function getOne(int $bancosId): object
    {
        return $this->checkAndGet($bancosId);
    }

    public function create(array $input): object
    {
        $bancos = json_decode((string) json_encode($input), false);

        return $this->bancosRepository->create($bancos);
    }

    public function update(array $input, int $bancosId): object
    {
        $bancos = $this->checkAndGet($bancosId);
        $data = json_decode((string) json_encode($input), false);

        return $this->bancosRepository->update($bancos, $data);
    }

    public function delete(int $bancosId): void
    {
        $this->checkAndGet($bancosId);
        $this->bancosRepository->delete($bancosId);
    }
}
