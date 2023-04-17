<?php

declare(strict_types=1);

namespace App\Repository;

final class Aliados_merkas_categoriasRepository
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

    public function checkAndGet(int $aliados_merkas_categoriasId): object
    {
        $query = 'SELECT * FROM `aliados_merkas_categorias` WHERE `aliado_merkas_categoria_id` = :aliado_merkas_categoria_id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('aliado_merkas_categoria_id', $aliados_merkas_categoriasId);
        $statement->execute();
        $aliados_merkas_categorias = $statement->fetchObject();
        if (! $aliados_merkas_categorias) {
            throw new \Exception('Aliados_merkas_categorias not found.', 404);
        }

        return $aliados_merkas_categorias;
    }

    /**
     * 
     * 
     */
    public function getFindByTipo(int $tipo):array
    {
        $query = 'SELECT * FROM `aliados_merkas_categorias` WHERE `tipo`=:tipo AND `aliado_merkas_categoria_estado` = 1';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('tipo', $tipo);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `aliados_merkas_categorias` ORDER BY `aliado_merkas_categoria_id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $aliados_merkas_categorias): object
    {
        $query = 'INSERT INTO `aliados_merkas_categorias` (`aliado_merkas_categoria_id`, `tipo`, `aliado_merkas_categoria_nombre`, `aliado_merkas_categoria_fecha_registro`, `aliado_merkas_categoria_icono`, `aliado_merkas_categoria_icono_filtro`, `aliado_merkas_categoria_ruta_img`, `aliado_merkas_categoria_estado`, `aliados_merkas_color`, `aliado_merkas_categoria_pines`) VALUES (:aliado_merkas_categoria_id, :tipo, :aliado_merkas_categoria_nombre, :aliado_merkas_categoria_fecha_registro, :aliado_merkas_categoria_icono, :aliado_merkas_categoria_icono_filtro, :aliado_merkas_categoria_ruta_img, :aliado_merkas_categoria_estado, :aliados_merkas_color, :aliado_merkas_categoria_pines)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('aliado_merkas_categoria_id', $aliados_merkas_categorias->aliado_merkas_categoria_id);
        $statement->bindParam('tipo', $aliados_merkas_categorias->tipo);
        $statement->bindParam('aliado_merkas_categoria_nombre', $aliados_merkas_categorias->aliado_merkas_categoria_nombre);
        $statement->bindParam('aliado_merkas_categoria_fecha_registro', $aliados_merkas_categorias->aliado_merkas_categoria_fecha_registro);
        $statement->bindParam('aliado_merkas_categoria_icono', $aliados_merkas_categorias->aliado_merkas_categoria_icono);
        $statement->bindParam('aliado_merkas_categoria_icono_filtro', $aliados_merkas_categorias->aliado_merkas_categoria_icono_filtro);
        $statement->bindParam('aliado_merkas_categoria_ruta_img', $aliados_merkas_categorias->aliado_merkas_categoria_ruta_img);
        $statement->bindParam('aliado_merkas_categoria_estado', $aliados_merkas_categorias->aliado_merkas_categoria_estado);
        $statement->bindParam('aliados_merkas_color', $aliados_merkas_categorias->aliados_merkas_color);
        $statement->bindParam('aliado_merkas_categoria_pines', $aliados_merkas_categorias->aliado_merkas_categoria_pines);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $aliados_merkas_categorias, object $data): object
    {
        if (isset($data->aliado_merkas_categoria_id)) {
            $aliados_merkas_categorias->aliado_merkas_categoria_id = $data->aliado_merkas_categoria_id;
        }
        if (isset($data->tipo)) {
            $aliados_merkas_categorias->tipo = $data->tipo;
        }
        if (isset($data->aliado_merkas_categoria_nombre)) {
            $aliados_merkas_categorias->aliado_merkas_categoria_nombre = $data->aliado_merkas_categoria_nombre;
        }
        if (isset($data->aliado_merkas_categoria_fecha_registro)) {
            $aliados_merkas_categorias->aliado_merkas_categoria_fecha_registro = $data->aliado_merkas_categoria_fecha_registro;
        }
        if (isset($data->aliado_merkas_categoria_icono)) {
            $aliados_merkas_categorias->aliado_merkas_categoria_icono = $data->aliado_merkas_categoria_icono;
        }
        if (isset($data->aliado_merkas_categoria_icono_filtro)) {
            $aliados_merkas_categorias->aliado_merkas_categoria_icono_filtro = $data->aliado_merkas_categoria_icono_filtro;
        }
        if (isset($data->aliado_merkas_categoria_ruta_img)) {
            $aliados_merkas_categorias->aliado_merkas_categoria_ruta_img = $data->aliado_merkas_categoria_ruta_img;
        }
        if (isset($data->aliado_merkas_categoria_estado)) {
            $aliados_merkas_categorias->aliado_merkas_categoria_estado = $data->aliado_merkas_categoria_estado;
        }
        if (isset($data->aliados_merkas_color)) {
            $aliados_merkas_categorias->aliados_merkas_color = $data->aliados_merkas_color;
        }
        if (isset($data->aliado_merkas_categoria_pines)) {
            $aliados_merkas_categorias->aliado_merkas_categoria_pines = $data->aliado_merkas_categoria_pines;
        }

        $query = 'UPDATE `aliados_merkas_categorias` SET `aliado_merkas_categoria_id` = :aliado_merkas_categoria_id, `tipo` = :tipo, `aliado_merkas_categoria_nombre` = :aliado_merkas_categoria_nombre, `aliado_merkas_categoria_fecha_registro` = :aliado_merkas_categoria_fecha_registro, `aliado_merkas_categoria_icono` = :aliado_merkas_categoria_icono, `aliado_merkas_categoria_icono_filtro` = :aliado_merkas_categoria_icono_filtro, `aliado_merkas_categoria_ruta_img` = :aliado_merkas_categoria_ruta_img, `aliado_merkas_categoria_estado` = :aliado_merkas_categoria_estado, `aliados_merkas_color` = :aliados_merkas_color, `aliado_merkas_categoria_pines` = :aliado_merkas_categoria_pines WHERE `aliado_merkas_categoria_id` = :aliado_merkas_categoria_id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('aliado_merkas_categoria_id', $aliados_merkas_categorias->aliado_merkas_categoria_id);
        $statement->bindParam('tipo', $aliados_merkas_categorias->tipo);
        $statement->bindParam('aliado_merkas_categoria_nombre', $aliados_merkas_categorias->aliado_merkas_categoria_nombre);
        $statement->bindParam('aliado_merkas_categoria_fecha_registro', $aliados_merkas_categorias->aliado_merkas_categoria_fecha_registro);
        $statement->bindParam('aliado_merkas_categoria_icono', $aliados_merkas_categorias->aliado_merkas_categoria_icono);
        $statement->bindParam('aliado_merkas_categoria_icono_filtro', $aliados_merkas_categorias->aliado_merkas_categoria_icono_filtro);
        $statement->bindParam('aliado_merkas_categoria_ruta_img', $aliados_merkas_categorias->aliado_merkas_categoria_ruta_img);
        $statement->bindParam('aliado_merkas_categoria_estado', $aliados_merkas_categorias->aliado_merkas_categoria_estado);
        $statement->bindParam('aliados_merkas_color', $aliados_merkas_categorias->aliados_merkas_color);
        $statement->bindParam('aliado_merkas_categoria_pines', $aliados_merkas_categorias->aliado_merkas_categoria_pines);

        $statement->execute();

        return $this->checkAndGet((int) $aliados_merkas_categorias->aliado_merkas_categoria_id);
    }

    public function delete(int $aliados_merkas_categoriasId): void
    {
        $query = 'DELETE FROM `aliados_merkas_categorias` WHERE `aliado_merkas_categoria_id` = :aliado_merkas_categoria_id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('aliado_merkas_categoria_id', $aliados_merkas_categoriasId);
        $statement->execute();
    }
}
