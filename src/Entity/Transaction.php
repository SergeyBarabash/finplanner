<?php

declare(strict_types=1);

namespace App\Entity;

use App\Doctrine\Type\TransactionTypeDbType;
use App\Enum\TransactionType;
use App\Repository\TransactionRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Money\Money;

#[ORM\Entity(repositoryClass: TransactionRepository::class)]
class Transaction {
    use Trait\HasIntegerId;

    public const string PROP_NAME = 'name';
    public const string PROP_TYPE = 'type';
    public const string PROP_CATEGORY = 'category';
    public const string PROP_EXECUTION_DATE = 'executionDate';
    public const string PROP_SUM_AMOUNT = 'sum_amount';
    public const string PROP_ACCOUNT = 'account';
    public const string PROP_DESCRIPTION = 'description';

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $name;

    #[ORM\Column(type: TransactionTypeDbType::NAME, enumType: TransactionType::class)]
    private TransactionType $type;

    #[ORM\ManyToOne(targetEntity: Category::class)]
    #[ORM\JoinColumn(name: 'category_id', referencedColumnName: 'id', nullable: false)]
    private Category $category;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private DateTimeImmutable $executionDate;

    #[ORM\Column(type: Types::INTEGER)]
    private int $sumAmount;

    #[ORM\ManyToOne(targetEntity: Account::class)]
    #[ORM\JoinColumn(name: 'account_id', referencedColumnName: 'id', nullable: false)]
    private Account $account;

    #[ORM\Column(type: Types::STRING, length: 255, nullable: true)]
    private ?string $description = null;

    public function __construct(
        string $name,
        Account $account,
        Money $sum,
        TransactionType $type,
        Category $category,
        DateTimeImmutable $executionDate,
    ) {
        $this->name = $name;
        $this->account = $account;
        $this->sumAmount = (int) $sum->getAmount();
        $this->type = $type;
        $this->category = $category;
        $this->executionDate = $executionDate;
    }
}
