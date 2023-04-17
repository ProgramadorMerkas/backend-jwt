<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\MunicipiosRepository;

final class MunicipiosService
{
    private MunicipiosRepository $municipiosRepository;

    public function __construct(MunicipiosRepository $municipiosRepository)
    {
        $this->municipiosRepository = $municipiosRepository;
    }

    public function checkAndGet(int $municipiosId): object
    {
        return $this->municipiosRepository->checkAndGet($municipiosId);
    }

    public function getAll(): array
    {
        return $this->municipiosRepository->getAll();
    }

    public function getAllMunicipiosByDepartamento(int $municipiosId): array
    {
        return $this->municipiosRepository->find_by_id_departamento($municipiosId);

        #return $this->checkAndGet($municipiosId);
    }

    public function create(array $input): object
    {
        $municipios = json_decode((string) json_encode($input), false);

        return $this->municipiosRepository->create($municipios);
    }

    public function update(array $input, int $municipiosId): object
    {
        $municipios = $this->checkAndGet($municipiosId);
        $data = json_decode((string) json_encode($input), false);

        return $this->municipiosRepository->update($municipios, $data);
    }

    public function delete(int $municipiosId): void
    {
        $this->checkAndGet($municipiosId);
        $this->municipiosRepository->delete($municipiosId);
    }
}
