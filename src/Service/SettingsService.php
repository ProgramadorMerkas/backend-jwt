<?php

declare(strict_types=1);

namespace App\Service;

use App\Repository\SettingsRepository;

final class SettingsService
{
    private SettingsRepository $settingsRepository;

    public function __construct(SettingsRepository $settingsRepository)
    {
        $this->settingsRepository = $settingsRepository;
    }

    public function checkAndGet(int $settingsId): object
    {
        return $this->settingsRepository->checkAndGet($settingsId);
    }

    public function getAll(): array
    {
        return $this->settingsRepository->getAll();
    }

    public function getOne(int $settingsId): object
    {
        return $this->checkAndGet($settingsId);
    }

    public function create(array $input): object
    {
        $settings = json_decode((string) json_encode($input), false);

        return $this->settingsRepository->create($settings);
    }

    public function update(array $input, int $settingsId): object
    {
        $settings = $this->checkAndGet($settingsId);
        $data = json_decode((string) json_encode($input), false);

        return $this->settingsRepository->update($settings, $data);
    }

    public function delete(int $settingsId): void
    {
        $this->checkAndGet($settingsId);
        $this->settingsRepository->delete($settingsId);
    }
}
