<?php

declare(strict_types=1);

namespace GardenManager\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250828143553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add test DB';
    }

    public function up(Schema $schema): void
    {
        $table = $schema->createTable('test');

        $table->addColumn('id', 'integer');
    }

    public function down(Schema $schema): void
    {
        $schema->dropTable('test');
    }
}
