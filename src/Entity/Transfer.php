<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\TransferRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransferRepository::class)]
class Transfer {
    use Trait\HasIntegerId;

    public const string PROP_NAME = 'name';
    public const string PROP_TRANSACTION_FROM = 'transactionFrom';
    public const string PROP_TRANSACTION_TO = 'transactionTo';

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $name;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private Transaction $transactionFrom;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private Transaction $transactionTo;

    public function __construct(string $name, Transaction $transactionFrom, Transaction $transactionTo) {
        $this->name = $name;
        $this->transactionFrom = $transactionFrom;
        $this->transactionTo = $transactionTo;
    }
}
