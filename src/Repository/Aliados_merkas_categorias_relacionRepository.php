<?php

declare(strict_types=1);

namespace App\Repository;

final class Aliados_merkas_categorias_relacionRepository
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

    public function checkAndGet(int $aliados_merkas_categorias_relacionId): object
    {
        $query = 'SELECT * FROM `aliados_merkas_categorias_relacion` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $aliados_merkas_categorias_relacionId);
        $statement->execute();
        $aliados_merkas_categorias_relacion = $statement->fetchObject();
        if (! $aliados_merkas_categorias_relacion) {
            throw new \Exception('Aliados_merkas_categorias_relacion not found.', 404);
        }

        return $aliados_merkas_categorias_relacion;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `aliados_merkas_categorias_relacion` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $aliados_merkas_categorias_relacion): object
    {
        $query = 'INSERT INTO `aliados_merkas_categorias_relacion` (`aliados_merkas_categoria_relacion_id`, `aliado_merkas_categoria_id`, `aliado_merkas_id`) VALUES (:aliados_merkas_categoria_relacion_id, :aliado_merkas_categoria_id, :aliado_merkas_id)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('aliados_merkas_categoria_relacion_id', $aliados_merkas_categorias_relacion->aliados_merkas_categoria_relacion_id);
        $statement->bindParam('aliado_merkas_categoria_id', $aliados_merkas_categorias_relacion->aliado_merkas_categoria_id);
        $statement->bindParam('aliado_merkas_id', $aliados_merkas_categorias_relacion->aliado_merkas_id);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    /**creado categoriasRelacion */
    public function created_data_1($categoria_relacion)
    {
        $query = 'INSERT INTO `aliados_merkas_categorias_relacion` (`aliado_merkas_categoria_id`, `aliado_merkas_id`) VALUES (:aliado_merkas_categoria_id, :aliado_merkas_id)';
        $statement = $this->getDb()->prepare($query);
         
        $statement->bindParam('aliado_merkas_categoria_id', $categoria_relacion['categoria']);
        $statement->bindParam('aliado_merkas_id', $categoria_relacion['aliado_merkas_id']);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $aliados_merkas_categorias_relacion, object $data): object
    {
        if (isset($data->aliados_merkas_categoria_relacion_id)) {
            $aliados_merkas_categorias_relacion->aliados_merkas_categoria_relacion_id = $data->aliados_merkas_categoria_relacion_id;
        }
        if (isset($data->aliado_merkas_categoria_id)) {
            $aliados_merkas_categorias_relacion->aliado_merkas_categoria_id = $data->aliado_merkas_categoria_id;
        }
        if (isset($data->aliado_merkas_id)) {
            $aliados_merkas_categorias_relacion->aliado_merkas_id = $data->aliado_merkas_id;
        }

        $query = 'UPDATE `aliados_merkas_categorias_relacion` SET `aliados_merkas_categoria_relacion_id` = :aliados_merkas_categoria_relacion_id, `aliado_merkas_categoria_id` = :aliado_merkas_categoria_id, `aliado_merkas_id` = :aliado_merkas_id WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('aliados_merkas_categoria_relacion_id', $aliados_merkas_categorias_relacion->aliados_merkas_categoria_relacion_id);
        $statement->bindParam('aliado_merkas_categoria_id', $aliados_merkas_categorias_relacion->aliado_merkas_categoria_id);
        $statement->bindParam('aliado_merkas_id', $aliados_merkas_categorias_relacion->aliado_merkas_id);

        $statement->execute();

        return $this->checkAndGet((int) $aliados_merkas_categorias_relacion->id);
    }

    public function delete(int $aliados_merkas_categorias_relacionId): void
    {
        $query = 'DELETE FROM `aliados_merkas_categorias_relacion` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $aliados_merkas_categorias_relacionId);
        $statement->execute();
    }
}
