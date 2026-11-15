<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\AccountRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Money\Money;

#[ORM\Entity(repositoryClass: AccountRepository::class)]
class Account {
    use Trait\HasIntegerId;

    public const string PROP_NAME = 'name';
    public const string PROP_BALANCE_AMOUNT = 'balanceAmount';
    public const string PROP_IS_ACTIVE = 'isActive';
    public const string PROP_IS_DEFAULT = 'isDefault';
    public const string PROP_CURRENCY = 'currency';
    public const string PROP_SORT_ORDER = 'sortOrder';

    #[ORM\Column(type: TYPES::STRING, length: 255)]
    private string $name;

    // В копейках
    #[ORM\Column(type: TYPES::INTEGER)]
    private int $balanceAmount;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isActive = true;

    #[ORM\Column(type: Types::BOOLEAN)]
    private bool $isDefault = false;

    #[ORM\ManyToOne(targetEntity: Currency::class)]
    #[ORM\JoinColumn(name: 'currency_id', referencedColumnName: 'id', nullable: false)]
    private Currency $currency;

    #[ORM\Column(type: Types::INTEGER)]
    private int $sortOrder = 0;

    public function __construct(string $name, Money $balance, Currency $currency) {
        $this->name = $name;
        $this->balanceAmount = (int) $balance->getAmount();
        $this->currency = $currency;
    }
}
