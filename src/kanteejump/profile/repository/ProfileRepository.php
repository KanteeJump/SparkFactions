<?php

declare(strict_types=1);

namespace kanteejump\profile\repository;

use kanteejump\database\ProfileDataBase;
use kanteejump\profile\model\ProfileModel;

class ProfileRepository
{
    private ProfileDataBase $db;

    public function __construct()
    {
        $this->db = new ProfileDataBase();
    }

    public function createTable(): void
    {
        $this->getDataBase()->getPDO()
            ->exec("CREATE TABLE IF NOT EXISTS profiles (
            name TEXT NOT NULL PRIMARY KEY,
            faction TEXT,
            factionRank TEXT
        )");
    }

    public function getProfile(string $name): ?ProfileModel
    {
        $stmt = $this->getDataBase()
            ->getPDO()
            ->prepare(
                "SELECT name, faction, factionRank FROM profiles WHERE name = ?"
            );
        $stmt->execute([$name]);
        $result = $stmt->fetch();

        if ($result === false) {
            return null;
        }

        return new ProfileModel(
            $name,
            $result["faction"],
            $result["factionRank"]
        );
    }

    public function saveProfile(ProfileModel $profile): void
    {
        $stmt = $this->getDataBase()
            ->getPDO()
            ->prepare(
                "INSERT INTO profiles (name, faction, factionRank) VALUES (?, ?, ?)"
            );
        $stmt->execute([
            $profile->getName(),
            $profile->getFaction(),
            $profile->getFactionRank(),
        ]);
    }

    public function updateProfile(ProfileModel $profile): void
    {
        $stmt = $this->getDataBase()
            ->getPDO()
            ->prepare(
                "UPDATE profiles SET faction = ?, factionRank = ? WHERE name = ?"
            );
        $stmt->execute([
            $profile->getFaction(),
            $profile->getFactionRank(),
            $profile->getName(),
        ]);
    }

    public function deleteProfile(string $name): void
    {
        $stmt = $this->getDataBase()
            ->getPDO()
            ->prepare("DELETE FROM profiles WHERE name = ?");
        $stmt->execute([$name]);
    }

    public function getAllProfiles(): array
    {
        $stmt = $this->getDataBase()
            ->getPDO()
            ->prepare("SELECT name, faction, factionRank FROM profiles");
        $stmt->execute();
        $result = $stmt->fetchAll();

        $profiles = [];

        foreach ($result as $row) {
            $profiles[] = new ProfileModel(
                $row["name"],
                $row["faction"],
                $row["factionRank"]
            );
        }

        return $profiles;
    }

    public function getDataBase(): ProfileDataBase
    {
        return $this->db;
    }
}
