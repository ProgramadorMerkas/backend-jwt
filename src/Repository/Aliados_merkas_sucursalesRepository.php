<?php

declare(strict_types=1);

namespace App\Repository;

final class Aliados_merkas_sucursalesRepository
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

    public function checkAndGet(int $aliados_merkas_sucursalesId): object
    {
        $query = 'SELECT * FROM `aliados_merkas_sucursales` WHERE `aliado_merkas_sucursal_id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $aliados_merkas_sucursalesId);
        $statement->execute();
        $aliados_merkas_sucursales = $statement->fetchObject();
        if (! $aliados_merkas_sucursales) {
            throw new \Exception('Aliados_merkas_sucursales not found.', 404);
        }

        return $aliados_merkas_sucursales;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `aliados_merkas_sucursales` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $aliados_merkas_sucursales): object
    {
        $query = 'INSERT INTO `aliados_merkas_sucursales` ( `aliado_merkas_id`, 
        `aliado_merkas_sucursal_fecha_registro`, 
        `aliado_merkas_sucursal_principal`, 
        `aliado_merkas_sucursal_correo`, 
        `aliado_merkas_sucursal_direccion`, 
        `municipio_id`, 
        `aliado_merkas_sucursal_latitud`,
        `aliado_merkas_sucursal_longitud`, 
        `aliado_merkas_sucursal_telefono`, 
        `aliado_merkas_sucursal_whatssap`, 
        `aliado_merkas_sucursal_domicilio` , `aliado_merkas_sucursal_string_horarios`) VALUES (:aliado_merkas_id, 
        :aliado_merkas_sucursal_fecha_registro, :aliado_merkas_sucursal_principal, 
        :aliado_merkas_sucursal_correo, :aliado_merkas_sucursal_direccion, :municipio_id,
         :aliado_merkas_sucursal_latitud, :aliado_merkas_sucursal_longitud,            
         :aliado_merkas_sucursal_telefono, :aliado_merkas_sucursal_whatssap, :aliado_merkas_sucursal_domicilio , :aliado_merkas_sucursal_string_horarios)';
        $statement = $this->getDb()->prepare($query); 
        $statement->bindParam('aliado_merkas_id', $aliados_merkas_sucursales->aliado_merkas_id);
        $statement->bindParam('aliado_merkas_sucursal_fecha_registro', $aliados_merkas_sucursales->aliado_merkas_sucursal_fecha_registro);
        $statement->bindParam('aliado_merkas_sucursal_principal', $aliados_merkas_sucursales->aliado_merkas_sucursal_principal);
        $statement->bindParam('aliado_merkas_sucursal_correo', $aliados_merkas_sucursales->aliado_merkas_sucursal_correo);
        $statement->bindParam('aliado_merkas_sucursal_direccion', $aliados_merkas_sucursales->aliado_merkas_sucursal_direccion);
        $statement->bindParam('municipio_id', $aliados_merkas_sucursales->municipio_id);
        $statement->bindParam('aliado_merkas_sucursal_latitud', $aliados_merkas_sucursales->aliado_merkas_sucursal_latitud);
        $statement->bindParam('aliado_merkas_sucursal_longitud', $aliados_merkas_sucursales->aliado_merkas_sucursal_longitud);
        $statement->bindParam('aliado_merkas_sucursal_telefono', $aliados_merkas_sucursales->aliado_merkas_sucursal_telefono);
        $statement->bindParam('aliado_merkas_sucursal_whatssap', $aliados_merkas_sucursales->aliado_merkas_sucursal_whatssap);
        $statement->bindParam('aliado_merkas_sucursal_domicilio', $aliados_merkas_sucursales->aliado_merkas_sucursal_domicilio);
        $statement->bindParam('aliado_merkas_sucursal_string_horarios' , $aliados_merkas_sucursales->aliado_merkas_sucursal_string_horarios);
        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $aliados_merkas_sucursales ): object
    {
        /*if (isset($data->aliado_merkas_sucursal_id)) {
            $aliados_merkas_sucursales->aliado_merkas_sucursal_id = $data->aliado_merkas_sucursal_id;
        }
        if (isset($data->aliado_merkas_id)) {
            $aliados_merkas_sucursales->aliado_merkas_id = $data->aliado_merkas_id;
        }
        if (isset($data->aliado_merkas_sucursal_fecha_registro)) {
            $aliados_merkas_sucursales->aliado_merkas_sucursal_fecha_registro = $data->aliado_merkas_sucursal_fecha_registro;
        }
        if (isset($data->aliado_merkas_sucursal_principal)) {
            $aliados_merkas_sucursales->aliado_merkas_sucursal_principal = $data->aliado_merkas_sucursal_principal;
        }
        if (isset($data->aliado_merkas_sucursal_correo)) {
            $aliados_merkas_sucursales->aliado_merkas_sucursal_correo = $data->aliado_merkas_sucursal_correo;
        }
        if (isset($data->aliado_merkas_sucursal_direccion)) {
            $aliados_merkas_sucursales->aliado_merkas_sucursal_direccion = $data->aliado_merkas_sucursal_direccion;
        }
        if (isset($data->municipio_id)) {
            $aliados_merkas_sucursales->municipio_id = $data->municipio_id;
        }
        if (isset($data->aliado_merkas_sucursal_latitud)) {
            $aliados_merkas_sucursales->aliado_merkas_sucursal_latitud = $data->aliado_merkas_sucursal_latitud;
        }
        if (isset($data->aliado_merkas_sucursal_longitud)) {
            $aliados_merkas_sucursales->aliado_merkas_sucursal_longitud = $data->aliado_merkas_sucursal_longitud;
        }
        if (isset($data->aliado_merkas_sucursal_horario_lunes_inicio)) {
            $aliados_merkas_sucursales->aliado_merkas_sucursal_horario_lunes_inicio = $data->aliado_merkas_sucursal_horario_lunes_inicio;
        }
        if (isset($data->aliado_merkas_sucursal_horario_lunes_fin)) {
            $aliados_merkas_sucursales->aliado_merkas_sucursal_horario_lunes_fin = $data->aliado_merkas_sucursal_horario_lunes_fin;
        }
        if (isset($data->aliado_merkas_sucursal_horario_sabado_inicio)) {
            $aliados_merkas_sucursales->aliado_merkas_sucursal_horario_sabado_inicio = $data->aliado_merkas_sucursal_horario_sabado_inicio;
        }
        if (isset($data->aliado_merkas_sucursal_horario_sabado_fin)) {
            $aliados_merkas_sucursales->aliado_merkas_sucursal_horario_sabado_fin = $data->aliado_merkas_sucursal_horario_sabado_fin;
        }
        if (isset($data->aliado_merkas_sucursal_horario_festivos_inicio)) {
            $aliados_merkas_sucursales->aliado_merkas_sucursal_horario_festivos_inicio = $data->aliado_merkas_sucursal_horario_festivos_inicio;
        }
        if (isset($data->aliado_merkas_sucursal_horario_festivos_fin)) {
            $aliados_merkas_sucursales->aliado_merkas_sucursal_horario_festivos_fin = $data->aliado_merkas_sucursal_horario_festivos_fin;
        }
        if (isset($data->aliado_merkas_sucursal_telefono)) {
            $aliados_merkas_sucursales->aliado_merkas_sucursal_telefono = $data->aliado_merkas_sucursal_telefono;
        }
        if (isset($data->aliado_merkas_sucursal_whatssap)) {
            $aliados_merkas_sucursales->aliado_merkas_sucursal_whatssap = $data->aliado_merkas_sucursal_whatssap;
        }
        if (isset($data->aliado_merkas_sucursal_domicilio)) {
            $aliados_merkas_sucursales->aliado_merkas_sucursal_domicilio = $data->aliado_merkas_sucursal_domicilio;
        }*/

        $query = 'UPDATE `aliados_merkas_sucursales` 
        SET  `aliado_merkas_id` = :aliado_merkas_id, 
        `aliado_merkas_sucursal_fecha_registro` = :aliado_merkas_sucursal_fecha_registro, 
        `aliado_merkas_sucursal_principal` = :aliado_merkas_sucursal_principal, 
        `aliado_merkas_sucursal_correo` = :aliado_merkas_sucursal_correo, 
        `aliado_merkas_sucursal_direccion` = :aliado_merkas_sucursal_direccion, 
        `municipio_id` = :municipio_id, 
        `aliado_merkas_sucursal_latitud` = :aliado_merkas_sucursal_latitud,
         `aliado_merkas_sucursal_longitud` = :aliado_merkas_sucursal_longitud, 
         `aliado_merkas_sucursal_horario_lunes_inicio` = :aliado_merkas_sucursal_horario_lunes_inicio,
          `aliado_merkas_sucursal_horario_lunes_fin` = :aliado_merkas_sucursal_horario_lunes_fin,
           `aliado_merkas_sucursal_horario_sabado_inicio` = :aliado_merkas_sucursal_horario_sabado_inicio, 
           `aliado_merkas_sucursal_horario_sabado_fin` = :aliado_merkas_sucursal_horario_sabado_fin, 
           `aliado_merkas_sucursal_horario_festivos_inicio` = :aliado_merkas_sucursal_horario_festivos_inicio,
            `aliado_merkas_sucursal_horario_festivos_fin` = :aliado_merkas_sucursal_horario_festivos_fin, 
            `aliado_merkas_sucursal_telefono` = :aliado_merkas_sucursal_telefono, 
            `aliado_merkas_sucursal_whatssap` = :aliado_merkas_sucursal_whatssap, 
            `aliado_merkas_sucursal_domicilio` = :aliado_merkas_sucursal_domicilio ,
            `aliado_merkas_sucursal_string_horarios` = :aliado_merkas_sucursal_string_horarios
            WHERE `aliado_merkas_sucursal_id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $aliados_merkas_sucursales->aliado_merkas_sucursal_id);
        $statement->bindParam('aliado_merkas_id', $aliados_merkas_sucursales->aliado_merkas_id);
        $statement->bindParam('aliado_merkas_sucursal_fecha_registro', $aliados_merkas_sucursales->aliado_merkas_sucursal_fecha_registro);
        $statement->bindParam('aliado_merkas_sucursal_principal', $aliados_merkas_sucursales->aliado_merkas_sucursal_principal);
        $statement->bindParam('aliado_merkas_sucursal_correo', $aliados_merkas_sucursales->aliado_merkas_sucursal_correo);
        $statement->bindParam('aliado_merkas_sucursal_direccion', $aliados_merkas_sucursales->aliado_merkas_sucursal_direccion);
        $statement->bindParam('municipio_id', $aliados_merkas_sucursales->municipio_id);
        $statement->bindParam('aliado_merkas_sucursal_latitud', $aliados_merkas_sucursales->aliado_merkas_sucursal_latitud);
        $statement->bindParam('aliado_merkas_sucursal_longitud', $aliados_merkas_sucursales->aliado_merkas_sucursal_longitud);
        $statement->bindParam('aliado_merkas_sucursal_horario_lunes_inicio', $aliados_merkas_sucursales->aliado_merkas_sucursal_horario_lunes_inicio);
        $statement->bindParam('aliado_merkas_sucursal_horario_lunes_fin', $aliados_merkas_sucursales->aliado_merkas_sucursal_horario_lunes_fin);
        $statement->bindParam('aliado_merkas_sucursal_horario_sabado_inicio', $aliados_merkas_sucursales->aliado_merkas_sucursal_horario_sabado_inicio);
        $statement->bindParam('aliado_merkas_sucursal_horario_sabado_fin', $aliados_merkas_sucursales->aliado_merkas_sucursal_horario_sabado_fin);
        $statement->bindParam('aliado_merkas_sucursal_horario_festivos_inicio', $aliados_merkas_sucursales->aliado_merkas_sucursal_horario_festivos_inicio);
        $statement->bindParam('aliado_merkas_sucursal_horario_festivos_fin', $aliados_merkas_sucursales->aliado_merkas_sucursal_horario_festivos_fin);
        $statement->bindParam('aliado_merkas_sucursal_telefono', $aliados_merkas_sucursales->aliado_merkas_sucursal_telefono);
        $statement->bindParam('aliado_merkas_sucursal_whatssap', $aliados_merkas_sucursales->aliado_merkas_sucursal_whatssap);
        $statement->bindParam('aliado_merkas_sucursal_domicilio', $aliados_merkas_sucursales->aliado_merkas_sucursal_domicilio);
        $statement->bindParam('aliado_merkas_sucursal_string_horarios' , $aliados_merkas_sucursales->aliado_merkas_sucursal_string_horarios);

        $statement->execute();

        return $this->checkAndGet((int) $aliados_merkas_sucursales->aliado_merkas_sucursal_id);
    }

    public function delete(int $aliados_merkas_sucursalesId): void
    {
        $query = 'DELETE FROM `aliados_merkas_sucursales` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $aliados_merkas_sucursalesId);
        $statement->execute();
    }
}
