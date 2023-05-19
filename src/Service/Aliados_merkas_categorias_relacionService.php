<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\Aliados_merkas_categorias_relacionRepository;

final class Aliados_merkas_categorias_relacionService
{
    private Aliados_merkas_categorias_relacionRepository $aliados_merkas_categorias_relacionRepository;

    public function __construct(Aliados_merkas_categorias_relacionRepository $aliados_merkas_categorias_relacionRepository)
    {
        $this->aliados_merkas_categorias_relacionRepository = $aliados_merkas_categorias_relacionRepository;
    }

    public function checkAndGet(int $aliados_merkas_categorias_relacionId): object
    {
        return $this->aliados_merkas_categorias_relacionRepository->checkAndGet($aliados_merkas_categorias_relacionId);
    }

    public function getAll(): array
    {
        return $this->aliados_merkas_categorias_relacionRepository->getAll();
    }

    public function getOne(int $aliados_merkas_categorias_relacionId): object
    {
        return $this->checkAndGet($aliados_merkas_categorias_relacionId);
    }

    public function create(array $input): object
    {
        $aliados_merkas_categorias_relacion = json_decode((string) json_encode($input), false);

        return $this->aliados_merkas_categorias_relacionRepository->create($aliados_merkas_categorias_relacion);
    }

    public function update(array $input, int $aliados_merkas_categorias_relacionId): object
    {
        $aliados_merkas_categorias_relacion = $this->checkAndGet($aliados_merkas_categorias_relacionId);
        $data = json_decode((string) json_encode($input), false);

        return $this->aliados_merkas_categorias_relacionRepository->update($aliados_merkas_categorias_relacion, $data);
    }

    public function delete(int $aliados_merkas_categorias_relacionId): void
    {
        $this->checkAndGet($aliados_merkas_categorias_relacionId);
        $this->aliados_merkas_categorias_relacionRepository->delete($aliados_merkas_categorias_relacionId);
    }
}
