<?php

declare(strict_types=1);

namespace App\Repository;

final class Aliados_merkas_rangosRepository
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

    public function checkAndGet(int $aliados_merkas_rangosId): object
    {
        $query = 'SELECT * FROM `aliados_merkas_rangos` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $aliados_merkas_rangosId);
        $statement->execute();
        $aliados_merkas_rangos = $statement->fetchObject();
        if (! $aliados_merkas_rangos) {
            throw new \Exception('Aliados_merkas_rangos not found.', 404);
        }

        return $aliados_merkas_rangos;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `aliados_merkas_rangos` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $aliados_merkas_rangos): object
    {
        $query = 'INSERT INTO `aliados_merkas_rangos` (`aliado_merkas_rango_id`, `aliado_merkas_rango_nombre`, `aliado_merkas_rango_comision`, `aliado_merkas_rango_puntos`, `aliado_merkas_rango_minimo_puntaje_asignacion`, `aliado_merkas_rango_minimo_cantidad_descuentos`) VALUES (:aliado_merkas_rango_id, :aliado_merkas_rango_nombre, :aliado_merkas_rango_comision, :aliado_merkas_rango_puntos, :aliado_merkas_rango_minimo_puntaje_asignacion, :aliado_merkas_rango_minimo_cantidad_descuentos)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('aliado_merkas_rango_id', $aliados_merkas_rangos->aliado_merkas_rango_id);
        $statement->bindParam('aliado_merkas_rango_nombre', $aliados_merkas_rangos->aliado_merkas_rango_nombre);
        $statement->bindParam('aliado_merkas_rango_comision', $aliados_merkas_rangos->aliado_merkas_rango_comision);
        $statement->bindParam('aliado_merkas_rango_puntos', $aliados_merkas_rangos->aliado_merkas_rango_puntos);
        $statement->bindParam('aliado_merkas_rango_minimo_puntaje_asignacion', $aliados_merkas_rangos->aliado_merkas_rango_minimo_puntaje_asignacion);
        $statement->bindParam('aliado_merkas_rango_minimo_cantidad_descuentos', $aliados_merkas_rangos->aliado_merkas_rango_minimo_cantidad_descuentos);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $aliados_merkas_rangos, object $data): object
    {
        if (isset($data->aliado_merkas_rango_id)) {
            $aliados_merkas_rangos->aliado_merkas_rango_id = $data->aliado_merkas_rango_id;
        }
        if (isset($data->aliado_merkas_rango_nombre)) {
            $aliados_merkas_rangos->aliado_merkas_rango_nombre = $data->aliado_merkas_rango_nombre;
        }
        if (isset($data->aliado_merkas_rango_comision)) {
            $aliados_merkas_rangos->aliado_merkas_rango_comision = $data->aliado_merkas_rango_comision;
        }
        if (isset($data->aliado_merkas_rango_puntos)) {
            $aliados_merkas_rangos->aliado_merkas_rango_puntos = $data->aliado_merkas_rango_puntos;
        }
        if (isset($data->aliado_merkas_rango_minimo_puntaje_asignacion)) {
            $aliados_merkas_rangos->aliado_merkas_rango_minimo_puntaje_asignacion = $data->aliado_merkas_rango_minimo_puntaje_asignacion;
        }
        if (isset($data->aliado_merkas_rango_minimo_cantidad_descuentos)) {
            $aliados_merkas_rangos->aliado_merkas_rango_minimo_cantidad_descuentos = $data->aliado_merkas_rango_minimo_cantidad_descuentos;
        }

        $query = 'UPDATE `aliados_merkas_rangos` SET `aliado_merkas_rango_id` = :aliado_merkas_rango_id, `aliado_merkas_rango_nombre` = :aliado_merkas_rango_nombre, `aliado_merkas_rango_comision` = :aliado_merkas_rango_comision, `aliado_merkas_rango_puntos` = :aliado_merkas_rango_puntos, `aliado_merkas_rango_minimo_puntaje_asignacion` = :aliado_merkas_rango_minimo_puntaje_asignacion, `aliado_merkas_rango_minimo_cantidad_descuentos` = :aliado_merkas_rango_minimo_cantidad_descuentos WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('aliado_merkas_rango_id', $aliados_merkas_rangos->aliado_merkas_rango_id);
        $statement->bindParam('aliado_merkas_rango_nombre', $aliados_merkas_rangos->aliado_merkas_rango_nombre);
        $statement->bindParam('aliado_merkas_rango_comision', $aliados_merkas_rangos->aliado_merkas_rango_comision);
        $statement->bindParam('aliado_merkas_rango_puntos', $aliados_merkas_rangos->aliado_merkas_rango_puntos);
        $statement->bindParam('aliado_merkas_rango_minimo_puntaje_asignacion', $aliados_merkas_rangos->aliado_merkas_rango_minimo_puntaje_asignacion);
        $statement->bindParam('aliado_merkas_rango_minimo_cantidad_descuentos', $aliados_merkas_rangos->aliado_merkas_rango_minimo_cantidad_descuentos);

        $statement->execute();

        return $this->checkAndGet((int) $aliados_merkas_rangos->id);
    }

    public function delete(int $aliados_merkas_rangosId): void
    {
        $query = 'DELETE FROM `aliados_merkas_rangos` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $aliados_merkas_rangosId);
        $statement->execute();
    }
}
