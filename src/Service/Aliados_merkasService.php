<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\Aliados_merkasException;
use App\Repository\Aliados_merkasRepository;
use App\Repository\UsuariosRepository;
use App\Repository\DesarrolladoresRepository;
use App\Repository\Aliados_merkas_categorias_relacionRepository;

final class Aliados_merkasService
{
    private Aliados_merkasRepository $aliados_merkasRepository; 

    private UsuariosRepository $usuariosRepository;

    private DesarrolladoresRepository $desarrolladoresRepository;

    private Aliados_merkas_categorias_relacionRepository $categoria_relacionRepository;

    public function __construct(Aliados_merkasRepository $aliados_merkasRepository  , 
    UsuariosRepository $usuariosRepository , 
    DesarrolladoresRepository $desarrolladoresRepository,
    Aliados_merkas_categorias_relacionRepository $categoria_relacionRepository)
    {
        $this->aliados_merkasRepository = $aliados_merkasRepository;
        
        $this->usuariosRepository = $usuariosRepository;

        $this->desarrolladoresRepository = $desarrolladoresRepository;

        $this->categoria_relacionRepository = $categoria_relacionRepository;
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

        return $this->aliados_merkasRepository->update($aliados_merkas, $data);
    }

    public function delete(int $aliados_merkasId): void
    {
        $this->checkAndGet($aliados_merkasId);
        $this->aliados_merkasRepository->delete($aliados_merkasId);
    }
}
