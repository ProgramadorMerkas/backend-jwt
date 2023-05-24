<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\Aliados_merkasException;
use App\Repository\Aliados_merkasRepository;
use App\Repository\UsuariosRepository;
use App\Repository\DesarrolladoresRepository;
use App\Repository\Aliados_merkas_categorias_relacionRepository;
use App\Repository\Aliados_merkas_sucursalesRepository;

final class Aliados_merkasService
{
    private Aliados_merkasRepository $aliados_merkasRepository; 

    private UsuariosRepository $usuariosRepository;

    private DesarrolladoresRepository $desarrolladoresRepository;

    private Aliados_merkas_categorias_relacionRepository $categoria_relacionRepository;

    private Aliados_merkas_sucursalesRepository  $sucursalesRepository;

    public function __construct(Aliados_merkasRepository $aliados_merkasRepository  , 
    UsuariosRepository $usuariosRepository , 
    DesarrolladoresRepository $desarrolladoresRepository,
    Aliados_merkas_categorias_relacionRepository $categoria_relacionRepository ,
    Aliados_merkas_sucursalesRepository $sucursalesRepository
    )
    {
        $this->aliados_merkasRepository = $aliados_merkasRepository;
        
        $this->usuariosRepository = $usuariosRepository;

        $this->desarrolladoresRepository = $desarrolladoresRepository;

        $this->categoria_relacionRepository = $categoria_relacionRepository;

        $this->sucursalesRepository = $sucursalesRepository;
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

    public function create(array $input): int
    {
        $aliados_merkas = json_decode((string) json_encode($input), false);
        //agregar campo desarrollador_id , aliado_merkas_id_padre
        $aliados_merkas->desarrollador_id = 0;

        $aliados_merkas->aliado_merkas_id_padre = 0;
        //validar si existe el valor
        if($aliados_merkas->referido == 0)
        {
            //buscar el referido con el codigo q8i67yz865
            $usuario = $this->usuariosRepository->find_by_usuario_codigo((string) "q8i67yz865");

            $desarrollador = $this->desarrolladoresRepository->find_by_usuario_id($usuario->usuario_id);
             
            $aliados_merkas->desarrollador_id = $desarrollador->desarrollador_id;
            
        }else{

            $usuario = $this->usuariosRepository->find_by_usuario_codigo((string) $aliados_merkas->referido);

            if(is_null($usuario))
            {
                //si el código no retorna un usuario entonces se asigna a merkas global
                $usuario = $this->usuariosRepository->find_by_usuario_codigo((string) "q8i67yz865");

                $desarrollador = $this->desarrolladoresRepository->find_by_usuario_id($usuario->usuario_id);
             
                $aliados_merkas->desarrollador_id = $desarrollador->desarrollador_id;
            
            }else{
                 //dado el caso que si retorne se valida si es comercio o desarrollador
                 if($usuario->usuario_rol_principal == "DESARROLLADOR MASTER")
                 {
                    //en caso de ser desarrollador, tiene que buscar el id del desarrolllador
                    $desarrollador = $this->desarrolladoresRepository->find_by_usuario_id($usuario->usuario_id);

                    if(!is_null($desarrollador))
                    {
                        $aliados_merkas->desarrollador_id = $desarrollador->desarrollador_id;

                    }

                 }else if($usuario->usuario_rol_principal == "ALIADO COMERCIAL")
                 {
                    //buscar el id del aliado comercial
                    $aliado = $this->aliados_merkasRespository->find_by_usuario_id($usuario->usuario_id);
                    
                    if(!is_null($aliado))
                    {
                        $aliados_merkas->aliado_merkas_id_padre = $aliado->aliado_merkas_id;
                    }
                 }
            }
        }

        $aliadoCreated =  $this->aliados_merkasRepository->create_data_1($aliados_merkas);
        //guardar la categoria
        $categoria = ["categoria" =>$aliados_merkas->category  , "aliado_merkas_id" => $aliadoCreated->aliado_merkas_id];

        $saveCategoriaRelation = $this->categoria_relacionRepository->created_data_1($categoria);

        return $aliadoCreated->aliado_merkas_id;
    }

    public function update(array $input, int $aliados_merkasId): object
    {
        $aliados_merkas = $this->checkAndGet($aliados_merkasId);

        $data = json_decode((string) json_encode($input), false);

        $aliado = new \stdClass();

        $aliados_merkas->aliado_merkas_instagram = $data->instagram;
        $aliados_merkas->aliado_merkas_facebook = $data->facebook;
        $aliados_merkas->aliado_merkas_youtube = $data->youtube;
        $aliados_merkas->aliado_merkas_twitter = $data->twitter;
        $aliados_merkas->aliado_merkas_website = $data->website;

        $this->aliados_merkasRepository->update($aliados_merkas);
        //crear la sucursal
        $sucursal = new \stdClass();

        $sucursal->aliado_merkas_id = $aliados_merkasId;
        $sucursal->aliado_merkas_sucursal_fecha_registro = date("Y-m-d");
        $sucursal->aliado_merkas_sucursal_principal = 1;
        $sucursal->aliado_merkas_sucursal_correo = $data->mailForConsumers; 
        $sucursal->aliado_merkas_sucursal_direccion = $data->address; //direccion sucursal
        $sucursal->aliado_merkas_sucursal_whatssap = $data->wpp;
        $sucursal->municipio_id =  $data->municipality;
        $sucursal->aliado_merkas_sucursal_latitud = $data->latitud;
        $sucursal->aliado_merkas_sucursal_longitud = $data->longitud;
        $sucursal->aliado_merkas_sucursal_telefono = $data->phone;   
        $sucursal->aliado_merkas_sucursal_domicilio = $data->delivery; //domicilios
        
        return $this->sucursalesRepository->create($sucursal);
 
    }

    public function delete(int $aliados_merkasId): void
    {
        $this->checkAndGet($aliados_merkasId);
        $this->aliados_merkasRepository->delete($aliados_merkasId);
    }


    /***almacenar la imagen de portada del aliado merkas */

    public function updatePortada(int $aliado_merkas_id , $file):string
    {
        //consultar el aliado recibido
        $aliado_merkas = $this->checkAndGet($aliado_merkas_id);
        $carpeta = uniqid();
        $path =  "/home/programador/Documentos/assets/media/users/";
        return $path;
    }

}
