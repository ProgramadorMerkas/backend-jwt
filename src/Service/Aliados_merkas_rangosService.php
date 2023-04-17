<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\Aliados_merkas_rangosRepository;

final class Aliados_merkas_rangosService
{
    private Aliados_merkas_rangosRepository $aliados_merkas_rangosRepository;

    public function __construct(Aliados_merkas_rangosRepository $aliados_merkas_rangosRepository)
    {
        $this->aliados_merkas_rangosRepository = $aliados_merkas_rangosRepository;
    }

    public function checkAndGet(int $aliados_merkas_rangosId): object
    {
        return $this->aliados_merkas_rangosRepository->checkAndGet($aliados_merkas_rangosId);
    }

    public function getAll(): array
    {
        return $this->aliados_merkas_rangosRepository->getAll();
    }

    public function getOne(int $aliados_merkas_rangosId): object
    {
        return $this->checkAndGet($aliados_merkas_rangosId);
    }

    public function create(array $input): object
    {
        $aliados_merkas_rangos = json_decode((string) json_encode($input), false);

        return $this->aliados_merkas_rangosRepository->create($aliados_merkas_rangos);
    }

    public function update(array $input, int $aliados_merkas_rangosId): object
    {
        $aliados_merkas_rangos = $this->checkAndGet($aliados_merkas_rangosId);
        $data = json_decode((string) json_encode($input), false);

        return $this->aliados_merkas_rangosRepository->update($aliados_merkas_rangos, $data);
    }

    public function delete(int $aliados_merkas_rangosId): void
    {
        $this->checkAndGet($aliados_merkas_rangosId);
        $this->aliados_merkas_rangosRepository->delete($aliados_merkas_rangosId);
    }
}
