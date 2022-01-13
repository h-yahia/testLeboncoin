<?php

namespace App\Entity;

use App\Repository\RealEstateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RealEstateRepository::class)
 */
class RealEstate extends Ad
{
}
