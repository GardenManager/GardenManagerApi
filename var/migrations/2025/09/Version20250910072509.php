<?php

declare(strict_types=1);

namespace GardenManager\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250910072509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Added the very first schema for basic plant definition';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE plant (id BINARY(16) NOT NULL, local_name VARCHAR(64) NOT NULL, genus VARCHAR(32) DEFAULT NULL, epithet VARCHAR(32) DEFAULT NULL, is_hybrid TINYINT(1) NOT NULL, cultivar VARCHAR(64) DEFAULT NULL, lifecycle VARCHAR(16) NOT NULL, created_at DATETIME(6) NOT NULL, updated_at DATETIME(6) DEFAULT NULL, deleted_at DATETIME(6) DEFAULT NULL, PRIMARY KEY (id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE plant');
    }
}
