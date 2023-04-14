<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\Aliados_merkasException;
use App\Repository\Aliados_merkasRepository;

final class Aliados_merkasService
{
    private Aliados_merkasRepository $aliados_merkasRepository;

    public function __construct(Aliados_merkasRepository $aliados_merkasRepository)
    {
        $this->aliados_merkasRepository = $aliados_merkasRepository;
    }

    public function checkAndGet(int $aliados_merkasId): object
    {
        return $this->aliados_merkasRepository->checkAndGet($aliados_merkasId);
    }

    public function getAll(): array
    {
        return $this->aliados_merkasRepository->getAll();
    }

    public function getOne(int $aliados_merkasId): object
    {
        return $this->checkAndGet($aliados_merkasId);
    }

    public function create(array $input): object
    {
        $aliados_merkas = json_decode((string) json_encode($input), false);

        return $this->aliados_merkasRepository->create($aliados_merkas);
    }

    public function update(array $input, int $aliados_merkasId): object
    {
        $aliados_merkas = $this->checkAndGet($aliados_merkasId);
        $data = json_decode((string) json_encode($input), false);

        return $this->aliados_merkasRepository->update($aliados_merkas, $data);
    }

    public function delete(int $aliados_merkasId): void
    {
        $this->checkAndGet($aliados_merkasId);
        $this->aliados_merkasRepository->delete($aliados_merkasId);
    }
}
