<?php

declare(strict_types=1);

namespace Yiisoft\Db\Mssql\Tests\Provider;

use Yiisoft\Db\Tests\Provider\AbstractQuoterProvider;

final class QuoterProvider extends AbstractQuoterProvider
{
    /**
     * @return string[][]
     */
    public function columnNames(): array
    {
        $columnNames = parent::columnNames();

        $columnNames[] = ['[column]', '[column]'];

        return $columnNames;
    }

    /**
     * @return string[][]
     */
    public function simpleTableNames(): array
    {
        return [
            ['test', 'test', ],
            ['te`st', 'te`st', ],
            ['te\'st', 'te\'st', ],
            ['te"st', 'te"st', ],
            ['current-table-name', 'current-table-name', ],
            ['[current-table-name]', 'current-table-name', ],
        ];
    }

    public function tableNameParts(): array
    {
        return [
            ['', ''],
            ['[]', ''],
            ['animal', 'animal'],
            ['dbo.animal', 'animal', 'dbo'],
            ['[dbo].[animal]', 'animal', 'dbo'],
            ['[other].[animal2]', 'animal2', 'other'],
            ['other.[animal2]', 'animal2', 'other'],
            ['other.animal2', 'animal2', 'other'],
            ['catalog.other.animal2', 'animal2', 'other', 'catalog'],
            ['server.catalog.other.animal2', 'animal2', 'other', 'catalog', 'server'],
            ['unknown_part.server.catalog.other.animal2', 'animal2', 'other', 'catalog', 'server'],
            ['[[dbo]].[[animal]]', 'animal', 'dbo'],
            ['[[other]].[[animal2]]', 'animal2', 'other'],
        ];
    }
}
