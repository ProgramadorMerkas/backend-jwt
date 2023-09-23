<?php

declare(strict_types=1);

namespace App\Repository;

final class BancosRepository
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

    public function checkAndGet(int $bancosId): object
    {
        $query = 'SELECT * FROM `bancos` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $bancosId);
        $statement->execute();
        $bancos = $statement->fetchObject();
        if (! $bancos) {
            throw new \Exception('Bancos not found.', 404);
        }

        return $bancos;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `bancos` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $bancos): object
    {
        $query = 'INSERT INTO `bancos` (`id`, `banco_nombre`, `banco_estado`) VALUES (:id, :banco_nombre, :banco_estado)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $bancos->id);
        $statement->bindParam('banco_nombre', $bancos->banco_nombre);
        $statement->bindParam('banco_estado', $bancos->banco_estado);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $bancos, object $data): object
    {
        if (isset($data->banco_nombre)) {
            $bancos->banco_nombre = $data->banco_nombre;
        }
        if (isset($data->banco_estado)) {
            $bancos->banco_estado = $data->banco_estado;
        }

        $query = 'UPDATE `bancos` SET `banco_nombre` = :banco_nombre, `banco_estado` = :banco_estado WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $bancos->id);
        $statement->bindParam('banco_nombre', $bancos->banco_nombre);
        $statement->bindParam('banco_estado', $bancos->banco_estado);

        $statement->execute();

        return $this->checkAndGet((int) $bancos->id);
    }

    public function delete(int $bancosId): void
    {
        $query = 'DELETE FROM `bancos` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $bancosId);
        $statement->execute();
    }
}
