<?php

declare(strict_types=1);

namespace App\Entity;

use App\Doctrine\Type\TransactionTypeDbType;
use App\Enum\TransactionType;
use App\Repository\CategoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category {
    use Trait\HasIntegerId;

    public const string PROP_NAME = 'name';
    public const string PROP_TYPE = 'type';
    public const string PROP_SORT_ORDER = 'sortOrder';
    public const string PROP_PARENT = 'parent';

    #[ORM\Column(type: Types::STRING, length: 255)]
    private string $name;

    #[ORM\Column(type: TransactionTypeDbType::NAME, enumType: TransactionType::class)]
    private TransactionType $type;

    #[ORM\Column(type: Types::INTEGER)]
    private int $sortOrder = 0;

    #[ORM\ManyToOne(targetEntity: self::class)]
    #[ORM\JoinColumn(name: 'parent_id', referencedColumnName: 'id', nullable: true)]
    private ?self $parent = null;

    public function __construct(string $name, TransactionType $type) {
        $this->name = $name;
        $this->type = $type;
    }
}
