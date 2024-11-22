<?php

namespace App\Entity;

use App\Repository\AssetPropertyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssetPropertyRepository::class)]
class AssetProperty
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'assetProperties')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Asset $asset_id = null;

    #[ORM\Column(length: 255)]
    private ?string $value = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?AssetPropertyType $property_id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAssetId(): ?Asset
    {
        return $this->asset_id;
    }

    public function setAssetId(?Asset $asset_id): static
    {
        $this->asset_id = $asset_id;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getPropertyId(): ?AssetPropertyType
    {
        return $this->property_id;
    }

    public function setPropertyId(?AssetPropertyType $property_id): static
    {
        $this->property_id = $property_id;

        return $this;
    }
}
