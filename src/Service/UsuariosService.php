<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\UsuariosRepository;
use App\Service\GeneratorCodeUsuariosService;
use App\Repository\Aliados_merkasRepository;

final class UsuariosService
{
    private UsuariosRepository $usuariosRepository;

    private GeneratorCodeUsuariosService $generateCode;

    private Aliados_merkasRepository $aliado_merkasRepository;

    public function __construct(UsuariosRepository $usuariosRepository , Aliados_merkasRepository $aliado_merkasRepository )
    {
        $this->usuariosRepository = $usuariosRepository;

        $this->aliado_merkasRepository = $aliado_merkasRepository;
 
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
        /**validar creación  */
        $data = json_decode((string) json_encode($input), false);
        //buscar aliado comercial
        $aliado_merkas = $this->aliado_merkasRepository->checkAndGet($data->aliado_merkas_id);
        //se crea objecto user
        $user = new \stdclass();
        //generate code
        $this->generateCode = new  GeneratorCodeUsuariosService();

        $code = $this->generateCode->generate();

        $user->usuario_codigo = $code;
        //validar si referido es 0 o nulo
        if($data->referido == "0" || empty($data->referido)) 
        {
            //en caso que sea nulo se procede a colocar el id de merkas global
            $user->usuario_id_padre = 4;

        }else{
            //en caso que que no sea nulo se procede a buscar en usuario con codigo de referido

            $referido = $this->usuariosRepository->findByReferido($data->referidos);

            $user->usuario_id_padre = $referido->usuario_id;
            $user->usuario_rol_principal = "ALIADO COMERCIAL";
            $user->usuario_nombre_completo = $aliado_merkas->aliado_merkas_nombre;
            $user->usuario_nombre = null;
            $user->usuario_apellido = null;
            $user->usuario_genero = null;
            $user->usuario_tipo_documento = null;
            $user->usuario_numero_documento = null;
            $user->usuario_correo = $data->mail;
            /*usuario_telefono
            usuario_whatssap
            usuario_direccion
            municipio_id
            usuario_estado
            usuario_status
            usuario_puntos
            usuario_merkash,
            usuario_contrasena
            usuario_terminos
            usuario_ruta_img
            usuario_token_contrasena
            usuario_token_fecha
            usuario_token_merkash
            usuario_token_merkash_fecha
            usuario_bienvenida
            usuario_latitud
            usuario_longitud*/
        }
        $user->usuario_fecha_registro = date("Y-m-d");

        
        return $this->usuariosRepository->create($data);
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
