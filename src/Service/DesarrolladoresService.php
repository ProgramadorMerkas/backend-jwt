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
        $numero_cuenta = $this->decryct($desarrolladores->step_3->numero_cuenta , $_SERVER["KEY_SECRET"]);
        $documento = $this->decryct($desarrolladores->step_1->documento , $_SERVER["KEY_SECRET"]);
        $nombre_titular = $this->decryct($desarrolladores->step_3->titular , $_SERVER["KEY_SECRET"]);
        $desarrolladores->step_3->numero_cuenta = $numero_cuenta;
        $desarrolladores->step_1->documento =  $documento ;
        $desarrolladores->step_3->titular =$nombre_titular;

        return $desarrolladores;//$this->desarrolladoresRepository->create($desarrolladores);
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

    public function decryct($encryptedData, $secretKey)
    {
        $decodedData = base64_decode($encryptedData);

        $ivSize = openssl_cipher_iv_length('aes-128-cbc');

        $iv = substr($decodedData, 0, $ivSize);

        $encryptedData = substr($decodedData, $ivSize);

        $decryptedData = openssl_decrypt($encryptedData, 'aes-128-cbc', $secretKey, OPENSSL_RAW_DATA, $iv);

        return $decryptedData;
    }
}
