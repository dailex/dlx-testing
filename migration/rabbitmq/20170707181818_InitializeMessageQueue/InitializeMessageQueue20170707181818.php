<?php

namespace Dlx\Testing\Migration\RabbitMq;

use Daikon\Dbal\Migration\MigrationInterface;
use Daikon\RabbitMq3\Migration\RabbitMq3MigrationTrait;

final class InitializeMessageQueue20170707181818 implements MigrationInterface
{
    use RabbitMq3MigrationTrait;

    public function getDescription(string $direction = self::MIGRATE_UP): string
    {
        return $direction === self::MIGRATE_UP
            ? 'Create a RabbitMQ message pipeline for the Dlx-Testing context.'
            : 'Delete the RabbitMQ message pipeline for the Dlx-Testing context.';
    }

    public function isReversible(): bool
    {
        return true;
    }

    private function up(): void
    {
        $this->createMigrationList('dlx.testing.migration_list');
        $this->createMessagePipeline('dlx.testing.messages');
    }

    private function down(): void
    {
        $this->deleteMessagePipeline('dlx.testing.messages');
        $this->deleteExchange('dlx.testing.migration_list');
    }
}
