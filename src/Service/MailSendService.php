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

        $body = $partes[0]." ".$usuarios->usuario_nombre_completo.$partes[1];

        /*$cabeceras = 'MIME-Version: 1.0'. "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $cabeceras .= 'From: Puntos Merkas<gerencia@merkas.co>'. "\r\n";

        //envio
        $subject = 'Registro exitoso Aliado Comercial';
        $msm    = $body;
        $msm    = wordwrap($msm , 70);

        if(!mail($usuarios->usuario_correo , $subject , $msm , $cabeceras))
        {
            throw new \Exception("Error enviando el correo" , 400);
        }*/
        $curl = curl_init();

        $jayParsedAry = [
            "from" => [
                  "email" => "no-reply@merkas.co", 
                  "name" => "Puntos Merkas" 
               ], 
            "to" => [
                     [
                        "email" => $usuarios->usuario_correo, 
                        "name" => $usuarios->usuario_nombre_completo 
                     ] 
                  ], 
            "subject" => "Registro Exitoso", 
            "html_part" => $body, 
            "text_part" => "", 
            "text_part_auto" => false, 
            "headers" => [
                           "X-CustomHeader" => "Header value" 
                        ], 
            "smtp_tags" => [
                              "string" 
                           ] 
         ]; 

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://merkas.ipzmarketing.com/api/v1/send_emails",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($jayParsedAry),
            CURLOPT_HTTPHEADER => array(
              "content-type: application/json",
              "x-auth-token: P_8czBc5b4Leznavv_VfeYCSAsmy8VxnsuUthMnq"
            ),
          ));
          
          $response = curl_exec($curl);
          $err = curl_error($curl);
          
          curl_close($curl);
          
          if ($err) {
            throw new \Exception('Error enviando correo', 400);
          } else {
            
            return $usuarios;
          }





    }
}