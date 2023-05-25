<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\Aliados_merkas_sucursalesRepository;
use App\Repository\Aliados_merkasRepository;

final class Aliados_merkas_sucursalesService
{
    private Aliados_merkas_sucursalesRepository $aliados_merkas_sucursalesRepository;

    private Aliados_merkasRepository $aliados_merkasRepository;

    public function __construct(Aliados_merkas_sucursalesRepository $aliados_merkas_sucursalesRepository , Aliados_merkasRepository $aliados_merkasRepository)
    {
        $this->aliados_merkas_sucursalesRepository = $aliados_merkas_sucursalesRepository;
        $this->aliados_merkasRepository = $aliados_merkasRepository;
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
        
        //actualizar la información de la sucurlsa y actualizar el comercio, consultamos el id_comercio y nos traemos su informacion

        //buscando el aliado merkas
        $aliado_merkas = $this->aliados_merkasRepository->checkAndGet($aliados_merkas_sucursales->aliado_merkas_id);
        //actualizamos los datos del aliado merkas
        $aliado_merkas->aliado_merkas_instagram = $data->instagram;
        $aliado_merkas->aliado_merkas_facebook = $data->facebook;
        $aliado_merkas->aliado_merkas_youtube = $data->youtube;
        $aliado_merkas->aliado_merkas_twitter = $data->twitter;
        $aliado_merkas->aliado_merkas_website = $data->website;
        $this->aliados_merkasRepository->update($aliado_merkas);

        //actualizando sucursal
        $aliados_merkas_sucursales->aliado_merkas_sucursal_correo = $data->mailForConsumers; 
        $aliados_merkas_sucursales->aliado_merkas_sucursal_direccion = $data->address; //direccion sucursal
        $aliados_merkas_sucursales->aliado_merkas_sucursal_whatssap = $data->wpp;
        $aliados_merkas_sucursales->municipio_id =  $data->municipality;
        $aliados_merkas_sucursales->aliado_merkas_sucursal_latitud = $data->latitud;
        $aliados_merkas_sucursales->aliado_merkas_sucursal_longitud = $data->longitud;
        $aliados_merkas_sucursales->aliado_merkas_sucursal_telefono = $data->phone;   
        $aliados_merkas_sucursales->aliado_merkas_sucursal_domicilio = $data->delivery;
        $aliados_merkas_sucursales->aliado_merkas_sucursal_string_horarios = $data->schedules;

        return $this->aliados_merkas_sucursalesRepository->update($aliados_merkas_sucursales);

        //return //$this->aliados_merkas_sucursalesRepository->update($aliados_merkas_sucursales, $data);
    }

    public function delete(int $aliados_merkas_sucursalesId): void
    {
        $this->checkAndGet($aliados_merkas_sucursalesId);
        $this->aliados_merkas_sucursalesRepository->delete($aliados_merkas_sucursalesId);
    }
}
