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

    public function create(array $input , $fileUpload): object
    {
        /**validar creación  */
        $data = json_decode((string) json_encode($input), false);

        //validar si existe usuario_id para crear o para actualizar
        if(empty($data->usuario_id))
        {
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

            $referido = $this->usuariosRepository->findByReferido($data->referido);

            $user->usuario_id_padre = $referido->usuario_id;
        }
            $user->usuario_fecha_registro = date("Y-m-d");
            $user->usuario_rol_principal = "ALIADO COMERCIAL";
            $user->usuario_nombre_completo = $aliado_merkas->aliado_merkas_nombre;
            $user->usuario_nombre = null;
            $user->usuario_apellido = null;
            $user->usuario_genero = null;
            $user->usuario_tipo_documento = null;
            $user->usuario_numero_documento = null;
            $user->usuario_correo = $data->mail;
            $user->usuario_telefono = null;
            $user->usuario_whatssap = null;
            $user->usuario_direccion = null;
            $user->municipio_id = $data->municipality;
            $user->usuario_estado = 0;
            $user->usuario_status = "ROOKIE";
            $user->usuario_puntos = 0;
            $user->usuario_merkash = 0;
            $user->usuario_contrasena = md5($data->password);
            $user->usuario_terminos = null;
            $user->usuario_ruta_img = 
            $user->usuario_token_contrasena = null;
            $user->usuario_token_fecha = null;
            $user->usuario_token_merkash = null;
            $user->usuario_token_merkash_fecha = null;
            $user->usuario_bienvenida = false;
            $user->usuario_latitud = $data->latitud;
            $user->usuario_longitud = $data->longitud;
            $loadImage = loadLogoImagen($fileUpload);

            $user->usuario_ruta_img = $loadImage;

            $usuarioCreated =  $this->usuariosRepository->create($data);

            //actualizar el $aliado_merkas
            $aliado_merkas->usuario_id = $usuarioCreated->usuario_id;

            $this->aliado_merkasRepository->update($aliado_merkas);
        
            return $usuarioCreated;

        }else{
            
            //consultamos el usuario por id;
            $usuario = $this->UsuariosRepository->checkAndGet($data->usuario_id);

            $usuario->usuario_correo = $data->mail;
            $usuario->usuario_contrasena = md5($data->password);
            $usuario->municipio_id = $data->municipality;
            $usuario->usuario_latitud = $data->latitud;
            $usuario->usuario_longitud = $data->longitud;

            $loadImage = loadLogoImagen($fileUpload);

            $usuario->usuario_ruta_img = $loadImage;

            return $this->usuariosRepository->update($usuario);
        }

    }

    /***CARGAR IMAGEN */
    public function loadLogoImagen($fileUpload):string
    {
        $file = $fileUpload['logo'];

        if ($file->getError() === UPLOAD_ERR_OK) {

            $extension = pathinfo($file->getClientFilename() , PATHINFO_EXTENSION);
            $base = bin2hex(random_bytes(8));

            $filename = sprintf('%s.%0.8s', $basename, $extension);

            $carpeta = uniqid();

            #$path ="/home/programador/Documentos/assets/media/users/".$carpeta;
            $path ="C:/Works/Merkas/assets/media/users/".$carpeta;
            //crear carperta si no existe
            if(!is_dir($path))
            {
                mkdir($path , 0777, true);
            }
            
            //moviendo archivo
            $fileUpload->moveTo("C:/Works/Merkas/assets/media/users/".$carpeta."/".$filename);

            $pathName = "C:/Works/Merkas/assets/media/users/".$carpeta."/".$filename;
            
            return  $pathName;

        }

        return null;
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
