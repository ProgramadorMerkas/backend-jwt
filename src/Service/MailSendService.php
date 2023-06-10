<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\SettingsRepository;

final class MailSendService
{
    private SettingsRepository $settingsRepository;

    public function __construct(SettingsRepository $settingsRepository)
    {   
        $this->settingsRepository = $settingsRepository;

    }

    public function sendMailNuevoAliadoMerkas(object $usuarios)
    {
        $html = $this->settingsRepository->findByActive("email");

        //var_dump($html);
        //partimos la información 
        $partes = explode("@" , $html->settings_valor);

        $body = $partes[0]." ".$usuarios->usuario_nombre_completo." </br>".$partes[1];

        $cabeceras = 'MIME-Version: 1.0'. '\r\n';
        $cabeceras .= 'Content-type: text/html; charset=UTF-8' .'\r\n';
        $cabeceras .= 'From: Puntos Merkas<gerencia@merkas.co>'.'\r\n';

        //envio
        $subject = 'Registro exitoso Aliado Comercial';
        $msm    = $body;
        $msm    = wordwrap($msm , 70);

        if(!mail($usuarios->usuario_correo , $subject , $msm , $cabeceras))
        {
            throw new \Exception("Error enviando el correo" , 400);
        }



    }
}