<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\Aliados_merkas_categoriasRepository;

final class Aliados_merkas_categoriasService
{
    private Aliados_merkas_categoriasRepository $aliados_merkas_categoriasRepository;

    public function __construct(Aliados_merkas_categoriasRepository $aliados_merkas_categoriasRepository)
    {
        $this->aliados_merkas_categoriasRepository = $aliados_merkas_categoriasRepository;
    }

    /***
     * 
     * 
    */

    public function getFindByTipo(int $tipo):array
    {

        return $this->aliados_merkas_categoriasRepository->getFindByTipo($tipo);
    }

    public function checkAndGet(int $aliados_merkas_categoriasId): object
    {
        return $this->aliados_merkas_categoriasRepository->checkAndGet($aliados_merkas_categoriasId);
    }

    public function getAll(): array
    {
        return $this->aliados_merkas_categoriasRepository->getAll();
    }

    public function getOne(int $aliados_merkas_categoriasId): object
    {
        return $this->checkAndGet($aliados_merkas_categoriasId);
    }



    public function create(array $input): object
    {
        $aliados_merkas_categorias = json_decode((string) json_encode($input), false);

        return $this->aliados_merkas_categoriasRepository->create($aliados_merkas_categorias);
    }

    public function update(array $input, int $aliados_merkas_categoriasId): object
    {
        $aliados_merkas_categorias = $this->checkAndGet($aliados_merkas_categoriasId);
        $data = json_decode((string) json_encode($input), false);

        return $this->aliados_merkas_categoriasRepository->update($aliados_merkas_categorias, $data);
    }

    public function delete(int $aliados_merkas_categoriasId): void
    {
        $this->checkAndGet($aliados_merkas_categoriasId);
        $this->aliados_merkas_categoriasRepository->delete($aliados_merkas_categoriasId);
    }
}
