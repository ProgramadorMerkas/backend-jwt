<?php

declare(strict_types=1);

namespace App\Repository;

final class MunicipiosRepository
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

    public function checkAndGet(int $municipiosId): object
    {
        $query = 'SELECT * FROM `municipios` WHERE `municipio_id` = :municipio_id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('municipio_id', $municipiosId);
        $statement->execute();
        $municipios = $statement->fetchObject();
        if (! $municipios) {
            throw new \Exception('Municipios not found.', 404);
        }

        return $municipios;
    }
    public function find_by_id_departamento(int $departamentoId):array
    {
        //var_dump($departamentoId);
        $query = 'SELECT * FROM `municipios` WHERE `departamento_id` = :departamentoId';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam(':departamentoId' , $departamentoId);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `municipios` ORDER BY `municipio_id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $municipios): object
    {
        $query = 'INSERT INTO `municipios` (`municipio_id`, `departamento_id`, `municipio_codigo`, `municipio_nombre`) VALUES (:municipio_id, :departamento_id, :municipio_codigo, :municipio_nombre)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('municipio_id', $municipios->municipio_id);
        $statement->bindParam('departamento_id', $municipios->departamento_id);
        $statement->bindParam('municipio_codigo', $municipios->municipio_codigo);
        $statement->bindParam('municipio_nombre', $municipios->municipio_nombre);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $municipios, object $data): object
    {
        if (isset($data->municipio_id)) {
            $municipios->municipio_id = $data->municipio_id;
        }
        if (isset($data->departamento_id)) {
            $municipios->departamento_id = $data->departamento_id;
        }
        if (isset($data->municipio_codigo)) {
            $municipios->municipio_codigo = $data->municipio_codigo;
        }
        if (isset($data->municipio_nombre)) {
            $municipios->municipio_nombre = $data->municipio_nombre;
        }

        $query = 'UPDATE `municipios` SET `municipio_id` = :municipio_id, `departamento_id` = :departamento_id, `municipio_codigo` = :municipio_codigo, `municipio_nombre` = :municipio_nombre WHERE `municipio_id` = :municipio_id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('municipio_id', $municipios->municipio_id);
        $statement->bindParam('departamento_id', $municipios->departamento_id);
        $statement->bindParam('municipio_codigo', $municipios->municipio_codigo);
        $statement->bindParam('municipio_nombre', $municipios->municipio_nombre);

        $statement->execute();

        return $this->checkAndGet((int) $municipios->municipio_id);
    }

    public function delete(int $municipiosId): void
    {
        $query = 'DELETE FROM `municipios` WHERE `municipio_id` = :municipio_id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('municipio_id', $municipiosId);
        $statement->execute();
    }
}
