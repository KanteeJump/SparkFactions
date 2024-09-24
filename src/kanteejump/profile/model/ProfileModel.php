<?php

declare(strict_types=1);

namespace kanteejump\profile\model;

class ProfileModel
{
    public string $name;
    public ?string $faction;
    public ?string $factionRank;

    public function __construct(
        string $name,
        ?string $faction = null,
        ?string $factionRank = null
    ) {
        $this->name = $name;
        $this->faction = $faction;
        $this->factionRank = $factionRank;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setFaction(?string $faction): void
    {
        $this->faction = $faction;
    }

    public function getFaction(): ?string
    {
        return $this->faction;
    }

    public function setFactionRank(?string $factionRank): void
    {
        $this->factionRank = $factionRank;
    }

    public function getFactionRank(): ?string
    {
        return $this->factionRank;
    }

    public function toArray(): array
    {
        return [
            "name" => $this->getName(),
            "faction" => $this->getFaction(),
            "factionRank" => $this->getFactionRank(),
        ];
    }
}
