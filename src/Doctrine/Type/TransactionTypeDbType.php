<?php

declare(strict_types=1);

namespace App\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

final class TransactionTypeDbType extends Type {
    public const string NAME = 'transaction_type';

    public function getSQLDeclaration(array $column, AbstractPlatform $platform): string {
        return self::NAME;
    }
}
