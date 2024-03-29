<?php

declare(strict_types=1);

namespace App\Service;

use App\Exception\Aliados_merkasException;
use App\Repository\Aliados_merkasRepository;
use App\Repository\UsuariosRepository;
use App\Repository\DesarrolladoresRepository;
use App\Repository\Aliados_merkas_categorias_relacionRepository;
use App\Repository\Aliados_merkas_sucursalesRepository;
use App\Repository\Aliados_merkas_rangosRepository;
use app\Repository\SettingsRepository;

final class Aliados_merkasService
{
    private Aliados_merkasRepository $aliados_merkasRepository; 

    private UsuariosRepository $usuariosRepository;

    private DesarrolladoresRepository $desarrolladoresRepository;

    private Aliados_merkas_categorias_relacionRepository $categoria_relacionRepository;

    private Aliados_merkas_sucursalesRepository  $sucursalesRepository;

    private Aliados_merkas_rangosRepository $rangosRepository;

    private SettingsRepository $settingsRepository;

    public function __construct(Aliados_merkasRepository $aliados_merkasRepository  , 
    UsuariosRepository $usuariosRepository , 
    DesarrolladoresRepository $desarrolladoresRepository,
    Aliados_merkas_categorias_relacionRepository $categoria_relacionRepository ,
    Aliados_merkas_sucursalesRepository $sucursalesRepository,
    Aliados_merkas_rangosRepository $rangosRepository,
    SettingsRepository $settingsRepository
    )
    {
        $this->aliados_merkasRepository = $aliados_merkasRepository;
        
        $this->usuariosRepository = $usuariosRepository;

        $this->desarrolladoresRepository = $desarrolladoresRepository;

        $this->categoria_relacionRepository = $categoria_relacionRepository;

        $this->sucursalesRepository = $sucursalesRepository;

        $this->rangosRepository = $rangosRepository;

        $this->settingsRepository  = $settingsRepository;
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

    /**validar si existe el nit */
    public function validateNit($data)
    {
        
       return  $this->aliados_merkasRepository->findByNit((string) $data->nit);


    }

    public function create(array $input , object $usuario_created): int
    {
        $aliados_merkas = json_decode((string) json_encode($input), false);
        //print_r($aliados_merkas);

        //validar si ya existe
        if($this->validateNit($aliados_merkas))
        {
            $this->usuariosRepository->delete($usuario_created->usuario_id);
              throw new Aliados_merkasException('El nit usado ya existe', 400);
              //elimine el user creado;
            
        }
        //agregar campo desarrollador_id , aliado_merkas_id_padre
        $aliados_merkas->desarrollador_id = 0;

        $aliados_merkas->aliado_merkas_id_padre = 0;

        //validar si existe el valor
        if($aliados_merkas->referido == "0")
        { //echo "entro aca";
            //echo "sigguio aca";
            //buscar el referido con el codigo q8i67yz865
            $usuario = $this->usuariosRepository->find_by_usuario_codigo((string) "q8i67yz865");

            $desarrollador = $this->desarrolladoresRepository->find_by_usuario_id($usuario->usuario_id);
             
            $aliados_merkas->desarrollador_id = $desarrollador->desarrollador_id;
            
        }else{
            //echo "entra aca";
            $usuario = $this->usuariosRepository->find_by_usuario_codigo((string) $aliados_merkas->referido);

            if(!$usuario)
            {
                //si el código no retorna un usuario entonces se asigna a merkas global
                $usuario = $this->usuariosRepository->find_by_usuario_codigo((string) "q8i67yz865");

                $desarrollador = $this->desarrolladoresRepository->find_by_usuario_id($usuario->usuario_id);
             
                $aliados_merkas->desarrollador_id = $desarrollador->desarrollador_id;
            
            }else{
                 //dado el caso que si retorne se valida si es comercio o desarrollador
                 if(($usuario->usuario_rol_principal == "DESARROLLADOR MASTER") || ($usuario->usuario_rol_principal == "DESARROLLADOR SENIOR"))
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

        //buscar rangue efective 
        $rangeEfectivo = $this->rangosRepository->checkAndGet((int)$aliados_merkas->effective);

        $rangeCredito = $this->rangosRepository->checkAndGet((int)$aliados_merkas->credit);

        $aliados_merkas->effective = $rangeEfectivo->aliado_merkas_rango_comision;

        $aliados_merkas->credit = $rangeCredito->aliado_merkas_rango_comision;

        $aliados_merkas->aliado_merkas_rango_id = $rangeEfectivo->aliado_merkas_rango_id;

        $aliados_merkas->usuario_id = $usuario_created->usuario_id;

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

        //$aliado = new \stdClass();

        $aliados_merkas->aliado_merkas_instagram = $data->instagram;
        $aliados_merkas->aliado_merkas_facebook = $data->facebook;
        $aliados_merkas->aliado_merkas_youtube = $data->youtube;
        $aliados_merkas->aliado_merkas_twitter = $data->twitter;
        $aliados_merkas->aliado_merkas_website = $data->website;
        $aliados_merkas->municipio_id = $data->municipality;
       

        $this->aliados_merkasRepository->update($aliados_merkas);
        //crear la sucursal
        $sucursal = new \stdClass();
        //print_r($aliados_merkas);
        $sucursal->aliado_merkas_id = $aliados_merkasId;
        $sucursal->aliado_merkas_sucursal_fecha_registro = date("Y-m-d");
        $sucursal->aliado_merkas_sucursal_principal = 1;
        $sucursal->aliado_merkas_sucursal_correo = $data->mailForConsumers; 
        $sucursal->aliado_merkas_sucursal_direccion = (string) $data->address; //direccion sucursal
        $sucursal->aliado_merkas_sucursal_whatssap = $data->wpp;
        $sucursal->municipio_id =  $data->municipality;
        $sucursal->aliado_merkas_sucursal_latitud = (string) $data->latitud;
        $sucursal->aliado_merkas_sucursal_longitud = (string)  $data->longitud;
        $sucursal->aliado_merkas_sucursal_telefono = $data->phone;   
        $sucursal->aliado_merkas_sucursal_domicilio =  (int) $data->delivery; //domicilios
        $schudelesSerializable = serialize($data->schedules);
        $sucursal->aliado_merkas_sucursal_string_horarios =  $schudelesSerializable; 
        return $this->sucursalesRepository->create($sucursal);
 
    }

    public function delete(int $aliados_merkasId): void
    {
        $this->checkAndGet($aliados_merkasId);
        $this->aliados_merkasRepository->delete($aliados_merkasId);
    }


    /***almacenar la imagen de portada del aliado merkas */

    public function updatePortada(int $aliado_merkas_id , $file):object
    {
        try{
            //consultar el aliado recibido
        $aliado_merkas = $this->checkAndGet($aliado_merkas_id);
        $carpeta = uniqid();
        //$path =  "/home/programador/Documentos/assets/media/users/".$carpeta;
        $settings = $this->settingsRepository->findByActive(  "ruta_merkas");
         
        $path = $settings->settings_valor."assets/media/users/".$carpeta;
        
         //validamos que la carpeta este creda
        if(!is_dir($path))
        {
            mkdir($path , 0777, true); //creamos la carpeta
        }
        $extension = pathinfo($file->getClientFilename() , PATHINFO_EXTENSION);

        $basename = bin2hex(random_bytes(8));

        $filename = sprintf('%s.%0.8s', $basename, $extension);
        ///home/merkas/public_html/merkasbusiness/assets/media/users
        $file->moveTo($path."/".$filename);
        //$file->moveTo("/home/programador/Documentos/assets/media/users/".$carpeta."/".$filename);
        //actualizar en base de datos
        $aliado_merkas->aliado_merkas_ruta_img_portada = "assets/media/users/".$filename;

        
       // $this->
        return $this->aliados_merkasRepository->update($aliado_merkas);
        }catch(Exception $e)
        {
            throw new \Exception($e->getMessage(), 500);
        }
    }


    public function updateAliado(array $input , int $id):object
    {
        $aliado = $this->checkAndGet($id);   

        $data = json_decode((string) json_encode($input), false);

        //buscar rangue efective 

        $rangeEfectivo = $this->rangosRepository->checkAndGet((int)$data->effective);

        $rangeCredito = $this->rangosRepository->checkAndGet((int)$data->credit);

        $aliado->aliado_merkas_rango_efectivo = $rangeEfectivo->aliado_merkas_rango_comision;

        $aliado->aliado_merkas_rango_credito = $rangeCredito->aliado_merkas_rango_comision;

        $aliado->aliado_merkas_rango_id = $rangeEfectivo->aliado_merkas_rango_id;
 
        $aliado->aliado_merkas_nit =   $data->nit ;
        $aliado->aliado_merkas_dv =  $data->dv ; 
        $aliado->aliado_merkas_nombre =  $data->registeredName ;
        $aliado->aliado_merkas_regimen_contributivo =   $data->typeOfTaxpayer;
        $aliado->aliado_merkas_tipo =  $data->typeOfTrade;
        $aliado->aliado_merkas_rep_legal_nombre =  $data->nameLegal;
        $aliado->aliado_merkas_rep_legal_apellido =  $data->surnamesLegal;  

        return $this->aliados_merkasRepository->update($aliado);
    }

    /***findBy nit */
    public function getNit(string $nit)
    {  
        
        $nitf = $this->aliados_merkasRepository->findByNit($nit);

        if($nitf)
        {
            return true;
        }

        return false;
    }

}
