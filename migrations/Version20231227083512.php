<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231227083512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE host ADD COLUMN is_static BOOLEAN DEFAULT 0 NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__host AS SELECT id, type_id, mac, ip, name, asset_id, description FROM host');
        $this->addSql('DROP TABLE host');
        $this->addSql('CREATE TABLE host (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER NOT NULL, mac VARCHAR(255) DEFAULT NULL, ip VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, asset_id VARCHAR(255) DEFAULT NULL, description CLOB DEFAULT NULL, CONSTRAINT FK_CF2713FDC54C8C93 FOREIGN KEY (type_id) REFERENCES host_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO host (id, type_id, mac, ip, name, asset_id, description) SELECT id, type_id, mac, ip, name, asset_id, description FROM __temp__host');
        $this->addSql('DROP TABLE __temp__host');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CF2713FDC54C8C93 ON host (type_id)');
    }
}
