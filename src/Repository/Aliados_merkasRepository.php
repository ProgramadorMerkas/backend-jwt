<?php

declare(strict_types=1);

namespace App\Repository;

use App\Exception\Aliados_merkasException;

final class Aliados_merkasRepository
{
    private \PDO $database;

    public function __construct(\PDO $database)
    {
        $this->database = $database;
    }

    public function getDb(): \PDO
    {
        return $this->database;
    }

    public function checkAndGet(int $aliados_merkasId): object
    {
        $query = 'SELECT * FROM `aliados_merkas` WHERE `aliado_merkas_id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $aliados_merkasId);
        $statement->execute();
        $aliados_merkas = $statement->fetchObject();
        if (! $aliados_merkas) {
            throw new Aliados_merkasException('Aliados_merkas not found.', 404);
        }

        return $aliados_merkas;
    }

    public function find_by_usuario_id(int $usuario_id):object
    {
        $query = 'SELECT * FROM `aliados_merkas` WHERE `usuario_id` = :usuario_id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam(':usuario_id', $aliausuario_id);
        $statement->execute();
        $aliados_merkas = $statement->fetchObject();
        if (! $aliados_merkas) {
            throw new Aliados_merkasException('Aliados_merkas not found.', 404);
        }

        return $aliados_merkas;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `aliados_merkas` ORDER BY `aliado_merkas_id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $aliados_merkas): object
    {
        $query = 'INSERT INTO `aliados_merkas` 
        (`aliado_merkas_id`, `usuario_id`, `desarrollador_id`, `aliado_merkas_id_padre`, `aliado_merkas_rango_id`, 
        `aliado_merkas_rango_efectivo`, `aliado_merkas_rango_credito`, `aliado_merkas_fecha_registro`, `aliado_merkas_nit`, 
        `aliado_merkas_dv`, `aliado_merkas_estado`, `aliado_merkas_nombre`, `aliado_merkas_descripcion`, `aliado_merkas_website`, 
        `aliado_merkas_facebook`, `aliado_merkas_twitter`, `aliado_merkas_youtube`, `aliado_merkas_instagram`, 
        `aliado_merkas_regimen_contributivo`, `aliado_merkas_tipo`, `aliado_merkas_rep_legal_nombre`,
         `aliado_merkas_rep_legal_apellido`, `aliado_merkas_rep_legal_genero`, `aliado_merkas_rep_legal_tipo_documento`, 
         `aliado_merkas_rep_legal_numero_documento`, `aliado_merkas_rep_legal_correo`, `aliado_merkas_rep_legal_telefono`,
          `aliado_merkas_rep_legal_cargo`, `aliado_merkas_rep_legal_direccion`, `municipio_id`, `aliado_merkas_ruta_img_portada`) 
          VALUES ( :usuario_id, :desarrollador_id, :aliado_merkas_id_padre, :aliado_merkas_rango_id, :aliado_merkas_rango_efectivo, 
          :aliado_merkas_rango_credito, :aliado_merkas_fecha_registro, :aliado_merkas_nit, :aliado_merkas_dv, :aliado_merkas_estado, 
          :aliado_merkas_nombre, :aliado_merkas_descripcion, :aliado_merkas_website, :aliado_merkas_facebook, :aliado_merkas_twitter, 
          :aliado_merkas_youtube, :aliado_merkas_instagram, :aliado_merkas_regimen_contributivo, :aliado_merkas_tipo, 
          :aliado_merkas_rep_legal_nombre, :aliado_merkas_rep_legal_apellido, :aliado_merkas_rep_legal_genero, 
          :aliado_merkas_rep_legal_tipo_documento, :aliado_merkas_rep_legal_numero_documento, :aliado_merkas_rep_legal_correo, 
          :aliado_merkas_rep_legal_telefono, :aliado_merkas_rep_legal_cargo, :aliado_merkas_rep_legal_direccion, :municipio_id, 
          :aliado_merkas_ruta_img_portada)';
        $statement = $this->getDb()->prepare($query); 
        $statement->bindParam('usuario_id', $aliados_merkas->usuario_id);
        $statement->bindParam('desarrollador_id', $aliados_merkas->desarrollador_id);
        $statement->bindParam('aliado_merkas_id_padre', $aliados_merkas->aliado_merkas_id_padre);
        $statement->bindParam('aliado_merkas_rango_id', $aliados_merkas->aliado_merkas_rango_id);
        $statement->bindParam('aliado_merkas_rango_efectivo', $aliados_merkas->aliado_merkas_rango_efectivo);
        $statement->bindParam('aliado_merkas_rango_credito', $aliados_merkas->aliado_merkas_rango_credito);
        $statement->bindParam('aliado_merkas_fecha_registro', $aliados_merkas->aliado_merkas_fecha_registro);
        $statement->bindParam('aliado_merkas_nit', $aliados_merkas->aliado_merkas_nit);
        $statement->bindParam('aliado_merkas_dv', $aliados_merkas->aliado_merkas_dv);
        $statement->bindParam('aliado_merkas_estado', $aliados_merkas->aliado_merkas_estado);
        $statement->bindParam('aliado_merkas_nombre', $aliados_merkas->aliado_merkas_nombre);
        $statement->bindParam('aliado_merkas_descripcion', $aliados_merkas->aliado_merkas_descripcion);
        $statement->bindParam('aliado_merkas_website', $aliados_merkas->aliado_merkas_website);
        $statement->bindParam('aliado_merkas_facebook', $aliados_merkas->aliado_merkas_facebook);
        $statement->bindParam('aliado_merkas_twitter', $aliados_merkas->aliado_merkas_twitter);
        $statement->bindParam('aliado_merkas_youtube', $aliados_merkas->aliado_merkas_youtube);
        $statement->bindParam('aliado_merkas_instagram', $aliados_merkas->aliado_merkas_instagram);
        $statement->bindParam('aliado_merkas_regimen_contributivo', $aliados_merkas->aliado_merkas_regimen_contributivo);
        $statement->bindParam('aliado_merkas_tipo', $aliados_merkas->aliado_merkas_tipo);
        $statement->bindParam('aliado_merkas_rep_legal_nombre', $aliados_merkas->aliado_merkas_rep_legal_nombre);
        $statement->bindParam('aliado_merkas_rep_legal_apellido', $aliados_merkas->aliado_merkas_rep_legal_apellido);
        $statement->bindParam('aliado_merkas_rep_legal_genero', $aliados_merkas->aliado_merkas_rep_legal_genero);
        $statement->bindParam('aliado_merkas_rep_legal_tipo_documento', $aliados_merkas->aliado_merkas_rep_legal_tipo_documento);
        $statement->bindParam('aliado_merkas_rep_legal_numero_documento', $aliados_merkas->aliado_merkas_rep_legal_numero_documento);
        $statement->bindParam('aliado_merkas_rep_legal_correo', $aliados_merkas->aliado_merkas_rep_legal_correo);
        $statement->bindParam('aliado_merkas_rep_legal_telefono', $aliados_merkas->aliado_merkas_rep_legal_telefono);
        $statement->bindParam('aliado_merkas_rep_legal_cargo', $aliados_merkas->aliado_merkas_rep_legal_cargo);
        $statement->bindParam('aliado_merkas_rep_legal_direccion', $aliados_merkas->aliado_merkas_rep_legal_direccion);
        $statement->bindParam('municipio_id', $aliados_merkas->municipio_id);
        $statement->bindParam('aliado_merkas_ruta_img_portada', $aliados_merkas->aliado_merkas_ruta_img_portada);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    //Edwin egue
    public function create_data_1(object $aliados_merkas): object
    {   
        $query = 'INSERT INTO `aliados_merkas` 
        (
        `usuario_id`,
        `desarrollador_id`,
        `aliado_merkas_id_padre`, 
        `aliado_merkas_rango_efectivo`, 
        `aliado_merkas_rango_credito`, 
        `aliado_merkas_fecha_registro`, 
        `aliado_merkas_nit`, 
        `aliado_merkas_dv`, 
        `aliado_merkas_estado`, 
        `aliado_merkas_nombre`, 
        `aliado_merkas_regimen_contributivo`, 
        `aliado_merkas_tipo`, 
        `aliado_merkas_rep_legal_nombre`, 
        `aliado_merkas_rep_legal_apellido`)
        VALUES ( 
            :usuario_id, 
            :desarrollador_id,
            :aliado_merkas_id_padre,
            :aliado_merkas_rango_efectivo,             
            :aliado_merkas_rango_credito, 
            :aliado_merkas_fecha_registro, 
            :aliado_merkas_nit, 
            :aliado_merkas_dv, 
            :aliado_merkas_estado, 
            :aliado_merkas_nombre,  
            :aliado_merkas_regimen_contributivo, 
            :aliado_merkas_tipo, 
            :aliado_merkas_rep_legal_nombre, 
            :aliado_merkas_rep_legal_apellido)';

        $statement = $this->getDb()->prepare($query); 
        $cero = 0;
        $date = date("Y-m-d");
        $statement->bindParam(':usuario_id' , $cero);
        $statement->bindParam(':aliado_merkas_rango_efectivo' , $aliados_merkas->effective);
        $statement->bindParam(':aliado_merkas_rango_credito' , $aliados_merkas->credit);
        $statement->bindParam(':aliado_merkas_fecha_registro' , $date);
        $statement->bindParam(':aliado_merkas_nit' , $aliados_merkas->nit);
        $statement->bindParam(':aliado_merkas_dv' , $aliados_merkas->dv);
        $statement->bindParam(':aliado_merkas_estado' , $cero);
        $statement->bindParam(':aliado_merkas_nombre' , $aliados_merkas->registeredName);
        $statement->bindParam(':aliado_merkas_regimen_contributivo' , $aliados_merkas->typeOfTaxpayer);
        $statement->bindParam(':aliado_merkas_tipo' , $aliados_merkas->typeOfTrade);
        $statement->bindParam(':aliado_merkas_rep_legal_nombre' , $aliados_merkas->nameLegal);
        $statement->bindParam(':aliado_merkas_rep_legal_apellido' , $aliados_merkas->surnamesLegal);
        $statement->bindParam(':desarrollador_id' , $aliados_merkas->desarrollador_id);
        $statement->bindParam(':aliado_merkas_id_padre' , $aliados_merkas->aliado_merkas_id_padre);


        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
      

}

    public function update(object $aliados_merkas, object $data): object
    {
        if (isset($data->aliado_merkas_id)) {
            $aliados_merkas->aliado_merkas_id = $data->aliado_merkas_id;
        }
        if (isset($data->usuario_id)) {
            $aliados_merkas->usuario_id = $data->usuario_id;
        }
        if (isset($data->desarrollador_id)) {
            $aliados_merkas->desarrollador_id = $data->desarrollador_id;
        }
        if (isset($data->aliado_merkas_id_padre)) {
            $aliados_merkas->aliado_merkas_id_padre = $data->aliado_merkas_id_padre;
        }
        if (isset($data->aliado_merkas_rango_id)) {
            $aliados_merkas->aliado_merkas_rango_id = $data->aliado_merkas_rango_id;
        }
        if (isset($data->aliado_merkas_rango_efectivo)) {
            $aliados_merkas->aliado_merkas_rango_efectivo = $data->aliado_merkas_rango_efectivo;
        }
        if (isset($data->aliado_merkas_rango_credito)) {
            $aliados_merkas->aliado_merkas_rango_credito = $data->aliado_merkas_rango_credito;
        }
        if (isset($data->aliado_merkas_fecha_registro)) {
            $aliados_merkas->aliado_merkas_fecha_registro = $data->aliado_merkas_fecha_registro;
        }
        if (isset($data->aliado_merkas_nit)) {
            $aliados_merkas->aliado_merkas_nit = $data->aliado_merkas_nit;
        }
        if (isset($data->aliado_merkas_dv)) {
            $aliados_merkas->aliado_merkas_dv = $data->aliado_merkas_dv;
        }
        if (isset($data->aliado_merkas_estado)) {
            $aliados_merkas->aliado_merkas_estado = $data->aliado_merkas_estado;
        }
        if (isset($data->aliado_merkas_nombre)) {
            $aliados_merkas->aliado_merkas_nombre = $data->aliado_merkas_nombre;
        }
        if (isset($data->aliado_merkas_descripcion)) {
            $aliados_merkas->aliado_merkas_descripcion = $data->aliado_merkas_descripcion;
        }
        if (isset($data->aliado_merkas_website)) {
            $aliados_merkas->aliado_merkas_website = $data->aliado_merkas_website;
        }
        if (isset($data->aliado_merkas_facebook)) {
            $aliados_merkas->aliado_merkas_facebook = $data->aliado_merkas_facebook;
        }
        if (isset($data->aliado_merkas_twitter)) {
            $aliados_merkas->aliado_merkas_twitter = $data->aliado_merkas_twitter;
        }
        if (isset($data->aliado_merkas_youtube)) {
            $aliados_merkas->aliado_merkas_youtube = $data->aliado_merkas_youtube;
        }
        if (isset($data->aliado_merkas_instagram)) {
            $aliados_merkas->aliado_merkas_instagram = $data->aliado_merkas_instagram;
        }
        if (isset($data->aliado_merkas_regimen_contributivo)) {
            $aliados_merkas->aliado_merkas_regimen_contributivo = $data->aliado_merkas_regimen_contributivo;
        }
        if (isset($data->aliado_merkas_tipo)) {
            $aliados_merkas->aliado_merkas_tipo = $data->aliado_merkas_tipo;
        }
        if (isset($data->aliado_merkas_rep_legal_nombre)) {
            $aliados_merkas->aliado_merkas_rep_legal_nombre = $data->aliado_merkas_rep_legal_nombre;
        }
        if (isset($data->aliado_merkas_rep_legal_apellido)) {
            $aliados_merkas->aliado_merkas_rep_legal_apellido = $data->aliado_merkas_rep_legal_apellido;
        }
        if (isset($data->aliado_merkas_rep_legal_genero)) {
            $aliados_merkas->aliado_merkas_rep_legal_genero = $data->aliado_merkas_rep_legal_genero;
        }
        if (isset($data->aliado_merkas_rep_legal_tipo_documento)) {
            $aliados_merkas->aliado_merkas_rep_legal_tipo_documento = $data->aliado_merkas_rep_legal_tipo_documento;
        }
        if (isset($data->aliado_merkas_rep_legal_numero_documento)) {
            $aliados_merkas->aliado_merkas_rep_legal_numero_documento = $data->aliado_merkas_rep_legal_numero_documento;
        }
        if (isset($data->aliado_merkas_rep_legal_correo)) {
            $aliados_merkas->aliado_merkas_rep_legal_correo = $data->aliado_merkas_rep_legal_correo;
        }
        if (isset($data->aliado_merkas_rep_legal_telefono)) {
            $aliados_merkas->aliado_merkas_rep_legal_telefono = $data->aliado_merkas_rep_legal_telefono;
        }
        if (isset($data->aliado_merkas_rep_legal_cargo)) {
            $aliados_merkas->aliado_merkas_rep_legal_cargo = $data->aliado_merkas_rep_legal_cargo;
        }
        if (isset($data->aliado_merkas_rep_legal_direccion)) {
            $aliados_merkas->aliado_merkas_rep_legal_direccion = $data->aliado_merkas_rep_legal_direccion;
        }
        if (isset($data->municipio_id)) {
            $aliados_merkas->municipio_id = $data->municipio_id;
        }
        if (isset($data->aliado_merkas_ruta_img_portada)) {
            $aliados_merkas->aliado_merkas_ruta_img_portada = $data->aliado_merkas_ruta_img_portada;
        }

        $query = 'UPDATE `aliados_merkas` SET   `usuario_id` = :usuario_id, `desarrollador_id` = :desarrollador_id, `aliado_merkas_id_padre` = :aliado_merkas_id_padre, `aliado_merkas_rango_id` = :aliado_merkas_rango_id, `aliado_merkas_rango_efectivo` = :aliado_merkas_rango_efectivo, `aliado_merkas_rango_credito` = :aliado_merkas_rango_credito, `aliado_merkas_fecha_registro` = :aliado_merkas_fecha_registro, `aliado_merkas_nit` = :aliado_merkas_nit, `aliado_merkas_dv` = :aliado_merkas_dv, `aliado_merkas_estado` = :aliado_merkas_estado, `aliado_merkas_nombre` = :aliado_merkas_nombre, `aliado_merkas_descripcion` = :aliado_merkas_descripcion, `aliado_merkas_website` = :aliado_merkas_website, `aliado_merkas_facebook` = :aliado_merkas_facebook, `aliado_merkas_twitter` = :aliado_merkas_twitter, `aliado_merkas_youtube` = :aliado_merkas_youtube, `aliado_merkas_instagram` = :aliado_merkas_instagram, `aliado_merkas_regimen_contributivo` = :aliado_merkas_regimen_contributivo, `aliado_merkas_tipo` = :aliado_merkas_tipo, `aliado_merkas_rep_legal_nombre` = :aliado_merkas_rep_legal_nombre, `aliado_merkas_rep_legal_apellido` = :aliado_merkas_rep_legal_apellido, `aliado_merkas_rep_legal_genero` = :aliado_merkas_rep_legal_genero, `aliado_merkas_rep_legal_tipo_documento` = :aliado_merkas_rep_legal_tipo_documento, `aliado_merkas_rep_legal_numero_documento` = :aliado_merkas_rep_legal_numero_documento, `aliado_merkas_rep_legal_correo` = :aliado_merkas_rep_legal_correo, `aliado_merkas_rep_legal_telefono` = :aliado_merkas_rep_legal_telefono, `aliado_merkas_rep_legal_cargo` = :aliado_merkas_rep_legal_cargo, `aliado_merkas_rep_legal_direccion` = :aliado_merkas_rep_legal_direccion, `municipio_id` = :municipio_id, `aliado_merkas_ruta_img_portada` = :aliado_merkas_ruta_img_portada WHERE `aliado_merkas_id` = :id';
        $statement = $this->getDb()->prepare($query); 
        $statement->bindParam('usuario_id', $aliados_merkas->usuario_id);
        $statement->bindParam('desarrollador_id', $aliados_merkas->desarrollador_id);
        $statement->bindParam('aliado_merkas_id_padre', $aliados_merkas->aliado_merkas_id_padre);
        $statement->bindParam('aliado_merkas_rango_id', $aliados_merkas->aliado_merkas_rango_id);
        $statement->bindParam('aliado_merkas_rango_efectivo', $aliados_merkas->aliado_merkas_rango_efectivo);
        $statement->bindParam('aliado_merkas_rango_credito', $aliados_merkas->aliado_merkas_rango_credito);
        $statement->bindParam('aliado_merkas_fecha_registro', $aliados_merkas->aliado_merkas_fecha_registro);
        $statement->bindParam('aliado_merkas_nit', $aliados_merkas->aliado_merkas_nit);
        $statement->bindParam('aliado_merkas_dv', $aliados_merkas->aliado_merkas_dv);
        $statement->bindParam('aliado_merkas_estado', $aliados_merkas->aliado_merkas_estado);
        $statement->bindParam('aliado_merkas_nombre', $aliados_merkas->aliado_merkas_nombre);
        $statement->bindParam('aliado_merkas_descripcion', $aliados_merkas->aliado_merkas_descripcion);
        $statement->bindParam('aliado_merkas_website', $aliados_merkas->aliado_merkas_website);
        $statement->bindParam('aliado_merkas_facebook', $aliados_merkas->aliado_merkas_facebook);
        $statement->bindParam('aliado_merkas_twitter', $aliados_merkas->aliado_merkas_twitter);
        $statement->bindParam('aliado_merkas_youtube', $aliados_merkas->aliado_merkas_youtube);
        $statement->bindParam('aliado_merkas_instagram', $aliados_merkas->aliado_merkas_instagram);
        $statement->bindParam('aliado_merkas_regimen_contributivo', $aliados_merkas->aliado_merkas_regimen_contributivo);
        $statement->bindParam('aliado_merkas_tipo', $aliados_merkas->aliado_merkas_tipo);
        $statement->bindParam('aliado_merkas_rep_legal_nombre', $aliados_merkas->aliado_merkas_rep_legal_nombre);
        $statement->bindParam('aliado_merkas_rep_legal_apellido', $aliados_merkas->aliado_merkas_rep_legal_apellido);
        $statement->bindParam('aliado_merkas_rep_legal_genero', $aliados_merkas->aliado_merkas_rep_legal_genero);
        $statement->bindParam('aliado_merkas_rep_legal_tipo_documento', $aliados_merkas->aliado_merkas_rep_legal_tipo_documento);
        $statement->bindParam('aliado_merkas_rep_legal_numero_documento', $aliados_merkas->aliado_merkas_rep_legal_numero_documento);
        $statement->bindParam('aliado_merkas_rep_legal_correo', $aliados_merkas->aliado_merkas_rep_legal_correo);
        $statement->bindParam('aliado_merkas_rep_legal_telefono', $aliados_merkas->aliado_merkas_rep_legal_telefono);
        $statement->bindParam('aliado_merkas_rep_legal_cargo', $aliados_merkas->aliado_merkas_rep_legal_cargo);
        $statement->bindParam('aliado_merkas_rep_legal_direccion', $aliados_merkas->aliado_merkas_rep_legal_direccion);
        $statement->bindParam('municipio_id', $aliados_merkas->municipio_id);
        $statement->bindParam('aliado_merkas_ruta_img_portada', $aliados_merkas->aliado_merkas_ruta_img_portada);

        $statement->execute();

        return $this->checkAndGet((int) $aliados_merkas->id);
    }

    public function delete(int $aliados_merkasId): void
    {
        $query = 'DELETE FROM `aliados_merkas` WHERE `aliado_merkas_id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $aliados_merkasId);
        $statement->execute();
    }
}
