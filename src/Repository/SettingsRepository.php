<?php

declare(strict_types=1);

namespace App\Repository;

final class SettingsRepository
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

    public function checkAndGet(int $settingsId): object
    {
        $query = 'SELECT * FROM `settings` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $settingsId);
        $statement->execute();
        $settings = $statement->fetchObject();
        if (! $settings) {
            throw new \Exception('Settings not found.', 404);
        }

        return $settings;
    }

    /** */
    public function findByActive($tipo):object
    {

        $query = 'SELECT * FROM `settings`  WHERE `settings_tipo` = :tipo AND `settings_estado` = "activo" LIMIT 0,1';

        $statement = $this->getDb()->prepare($query);

        $statement->bindParam('tipo', $tipo); 
        $statement->execute();

        $settings = $statement->fetchObject();

        if (! $settings) {

            throw new \Exception('Settings not found.', 404);
        }

        return $settings;
    }

    public function getAll(): array
    {
        $query = 'SELECT * FROM `settings` ORDER BY `id`';
        $statement = $this->getDb()->prepare($query);
        $statement->execute();

        return (array) $statement->fetchAll();
    }

    public function create(object $settings): object
    {
        $query = 'INSERT INTO `settings` (`settings_id`, `settings_tipo`, `settings_valor`, `settings_estado`) VALUES (:settings_id, :settings_tipo, :settings_valor, :settings_estado)';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('settings_id', $settings->settings_id);
        $statement->bindParam('settings_tipo', $settings->settings_tipo);
        $statement->bindParam('settings_valor', $settings->settings_valor);
        $statement->bindParam('settings_estado', $settings->settings_estado);

        $statement->execute();

        return $this->checkAndGet((int) $this->getDb()->lastInsertId());
    }

    public function update(object $settings, object $data): object
    {
        if (isset($data->settings_id)) {
            $settings->settings_id = $data->settings_id;
        }
        if (isset($data->settings_tipo)) {
            $settings->settings_tipo = $data->settings_tipo;
        }
        if (isset($data->settings_valor)) {
            $settings->settings_valor = $data->settings_valor;
        }
        if (isset($data->settings_estado)) {
            $settings->settings_estado = $data->settings_estado;
        }

        $query = 'UPDATE `settings` SET `settings_id` = :settings_id, `settings_tipo` = :settings_tipo, `settings_valor` = :settings_valor, `settings_estado` = :settings_estado WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('settings_id', $settings->settings_id);
        $statement->bindParam('settings_tipo', $settings->settings_tipo);
        $statement->bindParam('settings_valor', $settings->settings_valor);
        $statement->bindParam('settings_estado', $settings->settings_estado);

        $statement->execute();

        return $this->checkAndGet((int) $settings->id);
    }

    public function delete(int $settingsId): void
    {
        $query = 'DELETE FROM `settings` WHERE `id` = :id';
        $statement = $this->getDb()->prepare($query);
        $statement->bindParam('id', $settingsId);
        $statement->execute();
    }
}
