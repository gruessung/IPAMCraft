<?php

namespace App\Entity;

use App\Repository\HostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use JJG\Ping;
use Symfony\Component\Validator\Constraints\Ip;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

#[ORM\Entity(repositoryClass: HostRepository::class)]
class Host
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true, unique: true)]
    private ?string $mac = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $ip = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'hosts', cascade: ['persist'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?HostType $type = null;

    #[ORM\Column(length: 255, nullable: true, unique: true)]
    private ?string $asset_id = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $is_static = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMac(): ?string
    {
        return $this->mac;
    }

    public function setMac(?string $mac): static
    {
        $this->mac = $mac;

        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): static
    {
        $this->ip = $ip;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getType(): ?HostType
    {
        return $this->type;
    }

    public function setType(HostType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getAssetId(): ?string
    {
        return $this->asset_id;
    }

    public function setAssetId(?string $asset_id): static
    {
        $this->asset_id = $asset_id;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isIsStatic(): ?bool
    {
        return $this->is_static;
    }

    public function setIsStatic(bool $is_static): static
    {
        $this->is_static = $is_static;

        return $this;
    }

    public static function loadValidatorMetadata(ClassMetadata $metadata): void
    {
        $metadata->addPropertyConstraint('ip', new Ip());
        $metadata->addPropertyConstraint('name', new NotBlank());
    }

}
