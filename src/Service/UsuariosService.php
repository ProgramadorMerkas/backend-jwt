<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\UsuariosRepository;

final class UsuariosService
{
    private UsuariosRepository $usuariosRepository;

    public function __construct(UsuariosRepository $usuariosRepository)
    {
        $this->usuariosRepository = $usuariosRepository;
    }

    public function checkAndGet(int $usuariosId): object
    {
        return $this->usuariosRepository->checkAndGet($usuariosId);
    }

    public function getAll(): array
    {
        return $this->usuariosRepository->getAll();
    }

    public function getOne(int $usuariosId): object
    {
        return $this->checkAndGet($usuariosId);
    }

    public function create(array $input): object
    {
        $usuarios = json_decode((string) json_encode($input), false);

        return $this->usuariosRepository->create($usuarios);
    }

    public function update(array $input, int $usuariosId): object
    {
        $usuarios = $this->checkAndGet($usuariosId);
        $data = json_decode((string) json_encode($input), false);

        return $this->usuariosRepository->update($usuarios, $data);
    }

    public function delete(int $usuariosId): void
    {
        $this->checkAndGet($usuariosId);
        $this->usuariosRepository->delete($usuariosId);
    }
}
