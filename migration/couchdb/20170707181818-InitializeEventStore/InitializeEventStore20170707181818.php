<?php

namespace Dlx\Testing\Migration\CouchDb;

use Daikon\CouchDb\Migration\CouchDbMigrationTrait;
use Daikon\Dbal\Migration\MigrationInterface;

final class InitializeEventStore20170707181818 implements MigrationInterface
{
    use CouchDbMigrationTrait;

    public function getDescription(string $direction = self::MIGRATE_UP): string
    {
        return $direction === self::MIGRATE_UP
            ? 'Create the CouchDb database for the Dlx-Testing context.'
            : 'Delete the CouchDb database for the Dlx-Testing context.';
    }

    public function isReversible(): bool
    {
        return true;
    }

    private function up(): void
    {
        $this->createDatabase($this->getDatabaseName());
    }

    private function down(): void
    {
        $this->deleteDatabase($this->getDatabaseName());
    }
}
