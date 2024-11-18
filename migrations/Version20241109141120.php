<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241109141120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE asset (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label_no VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE asset_property (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, asset_id_id INTEGER NOT NULL, property_id_id INTEGER NOT NULL, value VARCHAR(255) NOT NULL, CONSTRAINT FK_999065EEA1FB010 FOREIGN KEY (asset_id_id) REFERENCES asset (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_999065EB9575F5A FOREIGN KEY (property_id_id) REFERENCES asset_property_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_999065EEA1FB010 ON asset_property (asset_id_id)');
        $this->addSql('CREATE INDEX IDX_999065EB9575F5A ON asset_property (property_id_id)');
        $this->addSql('CREATE TABLE asset_property_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE asset');
        $this->addSql('DROP TABLE asset_property');
        $this->addSql('DROP TABLE asset_property_type');
    }
}
