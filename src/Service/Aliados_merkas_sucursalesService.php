<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\Aliados_merkas_sucursalesRepository;

final class Aliados_merkas_sucursalesService
{
    private Aliados_merkas_sucursalesRepository $aliados_merkas_sucursalesRepository;

    public function __construct(Aliados_merkas_sucursalesRepository $aliados_merkas_sucursalesRepository)
    {
        $this->aliados_merkas_sucursalesRepository = $aliados_merkas_sucursalesRepository;
    }

    public function checkAndGet(int $aliados_merkas_sucursalesId): object
    {
        return $this->aliados_merkas_sucursalesRepository->checkAndGet($aliados_merkas_sucursalesId);
    }

    public function getAll(): array
    {
        return $this->aliados_merkas_sucursalesRepository->getAll();
    }

    public function getOne(int $aliados_merkas_sucursalesId): object
    {
        return $this->checkAndGet($aliados_merkas_sucursalesId);
    }

    public function create(array $input): object
    {
        $aliados_merkas_sucursales = json_decode((string) json_encode($input), false);

        return $this->aliados_merkas_sucursalesRepository->create($aliados_merkas_sucursales);
    }

    public function update(array $input, int $aliados_merkas_sucursalesId): object
    {
        $aliados_merkas_sucursales = $this->checkAndGet($aliados_merkas_sucursalesId);
        $data = json_decode((string) json_encode($input), false);

        return $this->aliados_merkas_sucursalesRepository->update($aliados_merkas_sucursales, $data);
    }

    public function delete(int $aliados_merkas_sucursalesId): void
    {
        $this->checkAndGet($aliados_merkas_sucursalesId);
        $this->aliados_merkas_sucursalesRepository->delete($aliados_merkas_sucursalesId);
    }
}
