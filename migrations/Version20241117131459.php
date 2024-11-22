<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241117131459 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__host AS SELECT id, type_id, asset_id, mac, ip, name, description, is_static FROM host');
        $this->addSql('DROP TABLE host');
        $this->addSql('CREATE TABLE host (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER NOT NULL, asset_id INTEGER DEFAULT NULL, mac VARCHAR(255) DEFAULT NULL, ip VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, description CLOB DEFAULT NULL, is_static BOOLEAN NOT NULL, CONSTRAINT FK_CF2713FDC54C8C93 FOREIGN KEY (type_id) REFERENCES host_type (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_CF2713FD5DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO host (id, type_id, asset_id, mac, ip, name, description, is_static) SELECT id, type_id, asset_id, mac, ip, name, description, is_static FROM __temp__host');
        $this->addSql('DROP TABLE __temp__host');
        $this->addSql('CREATE INDEX IDX_CF2713FDC54C8C93 ON host (type_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CF2713FD1713EB65 ON host (mac)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CF2713FDA5E3B32D ON host (ip)');
        $this->addSql('CREATE INDEX IDX_CF2713FD5DA1941 ON host (asset_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__host AS SELECT id, type_id, asset_id, mac, ip, name, description, is_static FROM host');
        $this->addSql('DROP TABLE host');
        $this->addSql('CREATE TABLE host (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, type_id INTEGER NOT NULL, asset_id INTEGER DEFAULT NULL, mac VARCHAR(255) DEFAULT NULL, ip VARCHAR(255) NOT NULL, name VARCHAR(255) DEFAULT NULL, description CLOB DEFAULT NULL, is_static BOOLEAN NOT NULL, CONSTRAINT FK_CF2713FDC54C8C93 FOREIGN KEY (type_id) REFERENCES host_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_CF2713FD5DA1941 FOREIGN KEY (asset_id) REFERENCES asset (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO host (id, type_id, asset_id, mac, ip, name, description, is_static) SELECT id, type_id, asset_id, mac, ip, name, description, is_static FROM __temp__host');
        $this->addSql('DROP TABLE __temp__host');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CF2713FD1713EB65 ON host (mac)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CF2713FDA5E3B32D ON host (ip)');
        $this->addSql('CREATE INDEX IDX_CF2713FDC54C8C93 ON host (type_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_CF2713FD5DA1941 ON host (asset_id)');
    }
}
