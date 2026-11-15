<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\CurrencyRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\UniqueConstraint(name: 'currency_name_unique', columns: ['name'])]
#[ORM\Entity(repositoryClass: CurrencyRepository::class)]
class Currency {
    use Trait\HasIntegerId;

    public const string PROP_NAME = 'name';
    public const string PROP_SHORT_NAME = 'shortName';

    #[ORM\Column(type: Types::STRING, length: 255, unique: true)]
    private string $name;

    #[ORM\Column(type: Types::STRING, length: 20)]
    private string $shortName;

    public function __construct(string $name, string $shortName) {
        $this->name = $name;
        $this->shortName = $shortName;
    }
}
