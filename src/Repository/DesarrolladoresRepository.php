<?php

declare(strict_types=1);

namespace App\Repository;

final class DesarrolladoresRepository
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

    public function checkAndGet(int $desarrolladoresId): object
    {
        $query = 'SELECT * FROM `desarrolladores` WHERE `desarrollador_id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $desarrolladoresId);
        $statement->execute();
        $desarrolladores = $statement->fetchObject();
        if (! $desarrolladores) {
            throw new \Exception('Desarrolladores not found.', 404);
        }

        return $desarrolladores;
    }

    public function findByCodeUsuario(string $code)
    {
        $query ='select des.desarrollador_id , usuarios.usuario_id from usuarios 
        inner join desarrolladores des on des.usuario_id = usuarios.usuario_id
        where usuarios.usuario_codigo = :code';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('code'  , $code);
        $statement->execute();
        $desarrolladores = $statement->fetchObject();

        return $desarrolladores;
    }

    public function find_by_usuario_id(int $usuario_id):object
    {
        $query = 'SELECT * FROM `desarrolladores` WHERE usuario_id = :user LIMIT 0,1';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam(':user', $usuario_id);
        $statement->execute();
        $desarrolladores = $statement->fetchObject();
        if (! $desarrolladores) {
            throw new \Exception('Desarrolladores not found.', 404);
        }

        return $desarrolladores;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `desarrolladores` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $desarrolladores): object
    {
        $query = 'INSERT INTO `desarrolladores` (`desarrollador_id`, `usuario_id`, `desarrollador_fecha_registro`, `desarrollador_fecha_nacimiento`, `desarrollador_estado`, `desarrollador_categoria`, `desarrollador_id_padre`) VALUES (:desarrollador_id, :usuario_id, :desarrollador_fecha_registro, :desarrollador_fecha_nacimiento, :desarrollador_estado, :desarrollador_categoria, :desarrollador_id_padre)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('desarrollador_id', $desarrolladores->desarrollador_id);
        $statement->bindParam('usuario_id', $desarrolladores->usuario_id);
        $statement->bindParam('desarrollador_fecha_registro', $desarrolladores->desarrollador_fecha_registro);
        $statement->bindParam('desarrollador_fecha_nacimiento', $desarrolladores->desarrollador_fecha_nacimiento);
        $statement->bindParam('desarrollador_estado', $desarrolladores->desarrollador_estado);
        $statement->bindParam('desarrollador_categoria', $desarrolladores->desarrollador_categoria);
        $statement->bindParam('desarrollador_id_padre', $desarrolladores->desarrollador_id_padre);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $desarrolladores, object $data): object
    {
        if (isset($data->desarrollador_id)) {
            $desarrolladores->desarrollador_id = $data->desarrollador_id;
        }
        if (isset($data->usuario_id)) {
            $desarrolladores->usuario_id = $data->usuario_id;
        }
        if (isset($data->desarrollador_fecha_registro)) {
            $desarrolladores->desarrollador_fecha_registro = $data->desarrollador_fecha_registro;
        }
        if (isset($data->desarrollador_fecha_nacimiento)) {
            $desarrolladores->desarrollador_fecha_nacimiento = $data->desarrollador_fecha_nacimiento;
        }
        if (isset($data->desarrollador_estado)) {
            $desarrolladores->desarrollador_estado = $data->desarrollador_estado;
        }
        if (isset($data->desarrollador_categoria)) {
            $desarrolladores->desarrollador_categoria = $data->desarrollador_categoria;
        }
        if (isset($data->desarrollador_id_padre)) {
            $desarrolladores->desarrollador_id_padre = $data->desarrollador_id_padre;
        }

        $query = 'UPDATE `desarrolladores` SET `desarrollador_id` = :desarrollador_id, `usuario_id` = :usuario_id, `desarrollador_fecha_registro` = :desarrollador_fecha_registro, `desarrollador_fecha_nacimiento` = :desarrollador_fecha_nacimiento, `desarrollador_estado` = :desarrollador_estado, `desarrollador_categoria` = :desarrollador_categoria, `desarrollador_id_padre` = :desarrollador_id_padre WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('desarrollador_id', $desarrolladores->desarrollador_id);
        $statement->bindParam('usuario_id', $desarrolladores->usuario_id);
        $statement->bindParam('desarrollador_fecha_registro', $desarrolladores->desarrollador_fecha_registro);
        $statement->bindParam('desarrollador_fecha_nacimiento', $desarrolladores->desarrollador_fecha_nacimiento);
        $statement->bindParam('desarrollador_estado', $desarrolladores->desarrollador_estado);
        $statement->bindParam('desarrollador_categoria', $desarrolladores->desarrollador_categoria);
        $statement->bindParam('desarrollador_id_padre', $desarrolladores->desarrollador_id_padre);

        $statement->execute();

        return $this->checkAndGet((int) $desarrolladores->id);
    }

    public function delete(int $desarrolladoresId): void
    {
        $query = 'DELETE FROM `desarrolladores` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $desarrolladoresId);
        $statement->execute();
    }
}
