<?php

declare(strict_types=1);

namespace App\Service;

 

final class GeneratorCodeUsuariosService
{

    public function __construct()
    {

    } 

    public function generate():string
    {
        $key = '';
        
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDFGHIJKMNOPQRSTVWXYZ';
        
        $max = strlen($pattern)-1;
        
        for($i=0;$i < 10;$i++) $key .= $pattern[mt_rand(0,$max)];
        
        return $key;
    }
}

?>