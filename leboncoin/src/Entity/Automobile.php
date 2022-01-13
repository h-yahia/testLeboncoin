<?php

namespace App\Entity;

use App\Repository\AutomobileRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AutomobileRepository::class)
 */
class Automobile extends Ad
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $brand;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $model;

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function serialize(): array {
        $res = parent::serialize();
        $res['brand'] = $this->getBrand();
        $res['model'] = $this->getModel();
        return $res;
    }
}
