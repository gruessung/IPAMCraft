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
use App\Repository\AssetRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AssetRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'asset:item']),
        new GetCollection(normalizationContext: ['groups' => 'asset:list']),
        new Put(normalizationContext: ['groups' => 'asset:item']),
        new Delete(normalizationContext: ['groups' => 'asset:item']),
        new Post(normalizationContext: ['groups' => 'asset:item']),
    ],
    order: ['id' => 'ASC'],
    paginationEnabled: false,
)]
#[ApiFilter(SearchFilter::class, properties: ['host.id' => 'partial', 'label_no' => 'partial'])]
class Asset
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['asset:list', 'asset:item', 'host:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['asset:list', 'asset:item'])]
    private ?string $label_no = null;

    #[ORM\Column(length: 255)]
    #[Groups(['asset:list', 'asset:item'])]
    private ?string $name = null;

    #[ORM\OneToOne(mappedBy: 'asset', cascade: ['persist', 'remove'])]
    #[Groups(['asset:item'])]
    private ?Host $host = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabelNo(): ?string
    {
        return $this->label_no;
    }

    public function setLabelNo(string $label_no): static
    {
        $this->label_no = $label_no;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;
        return $this;
    }

    public function getHost(): ?Host
    {
        return $this->host;
    }

    public function setHost(?Host $host): static
    {
        // set the owning side of the relation if necessary
        if ($host !== null && $host->getAsset() !== $this) {
            $host->setAsset($this);
        }
        $this->host = $host;
        return $this;
    }
}
