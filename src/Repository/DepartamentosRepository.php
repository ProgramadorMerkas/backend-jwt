<?php

declare(strict_types=1);

namespace App\Repository;

final class DepartamentosRepository
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

    public function checkAndGet(int $departamentosId): object
    {
        $query = 'SELECT * FROM `departamentos` WHERE `departamento_id` = :departamento_id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('departamento_id', $departamentosId);
        $statement->execute();
        $departamentos = $statement->fetchObject();
        if (! $departamentos) {
            throw new \Exception('Departamentos not found.', 404);
        }

        return $departamentos;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `departamentos` ORDER BY `departamento_id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $departamentos): object
    {
        $query = 'INSERT INTO `departamentos` (`departamento_id`, `departamento_nombre`, `departamento_codigo`) VALUES (:departamento_id, :departamento_nombre, :departamento_codigo)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('departamento_id', $departamentos->departamento_id);
        $statement->bindParam('departamento_nombre', $departamentos->departamento_nombre);
        $statement->bindParam('departamento_codigo', $departamentos->departamento_codigo);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $departamentos, object $data): object
    {
        if (isset($data->departamento_id)) {
            $departamentos->departamento_id = $data->departamento_id;
        }
        if (isset($data->departamento_nombre)) {
            $departamentos->departamento_nombre = $data->departamento_nombre;
        }
        if (isset($data->departamento_codigo)) {
            $departamentos->departamento_codigo = $data->departamento_codigo;
        }

        $query = 'UPDATE `departamentos` SET `departamento_id` = :departamento_id, `departamento_nombre` = :departamento_nombre, `departamento_codigo` = :departamento_codigo WHERE `departamento_id` = :departamento_id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('departamento_id', $departamentos->departamento_id);
        $statement->bindParam('departamento_nombre', $departamentos->departamento_nombre);
        $statement->bindParam('departamento_codigo', $departamentos->departamento_codigo);

        $statement->execute();

        return $this->checkAndGet((int) $departamentos->departamento_id);
    }

    public function delete(int $departamentosId): void
    {
        $query = 'DELETE FROM `departamentos` WHERE `departamento_id` = :departamento_id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('departamento_id', $departamentosId);
        $statement->execute();
    }
}
