<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\HostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Ip;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Mapping\ClassMetadata;

#[ORM\Entity(repositoryClass: HostRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'host:item']),
        new GetCollection(normalizationContext: ['groups' => 'host:list']),
        new Put(normalizationContext: ['groups' => 'host:item']),
        new Delete(normalizationContext: ['groups' => 'host:item']),
        new Post(normalizationContext: ['groups' => 'host:item']),
    ],
    order: ['id' => 'ASC'],
    paginationEnabled: false,
)]
#[ApiFilter(SearchFilter::class, properties: ['asset' => 'exact'])]
class Host
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['host:list', 'host:item', 'asset:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true, unique: true)]
    #[Groups(['host:list', 'host:item'])]
    private ?string $mac = null;

    #[ORM\Column(length: 255, unique: true)]
    #[Groups(['host:list', 'host:item'])]
    private ?string $ip = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['host:list', 'host:item'])]
    private ?string $name = null;

    #[ORM\Column(type: 'text', nullable: true)]
    #[Groups(['host:list', 'host:item'])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(['host:list', 'host:item'])]
    private ?bool $is_static = null;

    #[ORM\OneToOne(inversedBy: 'host', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['host:list', 'host:item'])]
    private ?Asset $asset = null;

    #[ORM\ManyToOne(targetEntity: HostType::class)]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['host:list', 'host:item'])]
    private ?HostType $type = null;

    public function getType(): ?HostType
    {
        return $this->type;
    }

    public function setType(?HostType $type): void
    {
        $this->type = $type;
    } // Prüfe, ob hier die korrekte Klasse referenziert ist.

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

    public function getAsset(): ?Asset
    {
        return $this->asset;
    }

    public function setAsset(?Asset $asset): static
    {
        $this->asset = $asset;
        return $this;
    }
}
