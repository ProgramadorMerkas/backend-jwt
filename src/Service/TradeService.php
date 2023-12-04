<?php

declare(strict_types=1);

namespace App\Service;

use App\Service\UsuariosService;
use App\Service\Aliados_merkasService;
use App\Repository\Aliados_merkasRepository;
use App\Repository\UsuariosRepository;
use App\Repository\DesarrolladoresRepository;
use App\Repository\Aliados_merkas_categorias_relacionRepository;
use App\Repository\Aliados_merkas_sucursalesRepository;
use App\Repository\Aliados_merkas_rangosRepository;
use app\Repository\SettingsRepository;

final class TradeService
{
    private Aliados_merkasRepository $aliados_merkasRepository; 

    private UsuariosRepository $usuariosRepository;

    private DesarrolladoresRepository $desarrolladoresRepository;

    private Aliados_merkas_categorias_relacionRepository $categoria_relacionRepository;

    private Aliados_merkas_sucursalesRepository  $sucursalesRepository;

    private Aliados_merkas_rangosRepository $rangosRepository;

    private SettingsRepository $settingsRepository;

    private UsuariosService $userService;

    private Aliados_merkasService $aliadoService;

    public function __construct(Aliados_merkasRepository $aliados_merkasRepository  , 
    UsuariosRepository $usuariosRepository , 
    DesarrolladoresRepository $desarrolladoresRepository,
    Aliados_merkas_categorias_relacionRepository $categoria_relacionRepository ,
    Aliados_merkas_sucursalesRepository $sucursalesRepository,
    Aliados_merkas_rangosRepository $rangosRepository,
    SettingsRepository $settingsRepository,
    UsuariosService $userService , Aliados_merkasService $aliadoService
    )
    {
        $this->aliados_merkasRepository = $aliados_merkasRepository;
        
        $this->usuariosRepository = $usuariosRepository;

        $this->desarrolladoresRepository = $desarrolladoresRepository;

        $this->categoria_relacionRepository = $categoria_relacionRepository;

        $this->sucursalesRepository = $sucursalesRepository;

        $this->rangosRepository = $rangosRepository;

        $this->settingsRepository  = $settingsRepository;

        $this->userService = $userService;

        $this->aliadoService = $aliadoService;
    }

    /***"typeOfTrade": "1",
    "category": 401,
    "effective": "11",
    "credit": "6",
    "typeOfTaxpayer": "PERSONA NATURAL",
    "registeredName": "Kodier",
    "nit": "123",
    "dv": "4",
    "nameLegal": "Andrés",
    "surnamesLegal": "Palacio Molina",
    "mail": "kodier.dev.andres@gmail.com",
    "password": "123456",
    "referido": "159" */
    public function create(array $input)
    {
        
            $trade = json_decode((string) json_encode($input), false);
        
        //consultar rangos y usar para creditos efecctive effective , credit
        $efective = $this->rangosRepository->checkAndGet((int) $trade->effective);
        $credi = $this->rangosRepository->checkAndGet((int) $trade->credit);
        //
        //vaidar si el registro de referido es diferente de 0
        $desarrollador = new \stdclass();
        if($trade->referido == "0")
        { 
            
            $desarrollador->desarrollador_id = 3;
            $desarrollador->usuario_id = 4;

        }else{

            $usuario = $this->desarrolladoresRepository->findByCodeUsuario($trade->referido);
            
            if(!empty((array)$usuario))
            {    
                $desarrollador->desarrollador_id = $usuario->desarrollador_id;
                $desarrollador->usuario_id = $usuario->usuario_id;
            }else{
                $desarrollador->desarrollador_id = 3;

                $desarrollador->usuario_id = 4;
            }
        }
        
        //crear usuario -> 
        $usuario_created = $this->userService->createUser($trade , $desarrollador);        
        //crear aliado merkas
        $aliado = $this->aliadoService->create((array) $input , (object) $usuario_created);

   
}

}