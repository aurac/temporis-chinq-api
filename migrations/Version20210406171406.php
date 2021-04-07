<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210406171406 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE card_type_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE rarity_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE source_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE card_type (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE rarity (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE source (id INT NOT NULL, parent_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5F8A7F73727ACA70 ON source (parent_id)');
        $this->addSql('ALTER TABLE source ADD CONSTRAINT FK_5F8A7F73727ACA70 FOREIGN KEY (parent_id) REFERENCES source (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE card ADD type_id INT NOT NULL');
        $this->addSql('ALTER TABLE card ADD rarity_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card ADD source_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3C54C8C93 FOREIGN KEY (type_id) REFERENCES card_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3F3747573 FOREIGN KEY (rarity_id) REFERENCES rarity (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3953C1C61 FOREIGN KEY (source_id) REFERENCES source (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_161498D3C54C8C93 ON card (type_id)');
        $this->addSql('CREATE INDEX IDX_161498D3F3747573 ON card (rarity_id)');
        $this->addSql('CREATE INDEX IDX_161498D3953C1C61 ON card (source_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE card DROP CONSTRAINT FK_161498D3C54C8C93');
        $this->addSql('ALTER TABLE card DROP CONSTRAINT FK_161498D3F3747573');
        $this->addSql('ALTER TABLE card DROP CONSTRAINT FK_161498D3953C1C61');
        $this->addSql('ALTER TABLE source DROP CONSTRAINT FK_5F8A7F73727ACA70');
        $this->addSql('DROP SEQUENCE card_type_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE rarity_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE source_id_seq CASCADE');
        $this->addSql('DROP TABLE card_type');
        $this->addSql('DROP TABLE rarity');
        $this->addSql('DROP TABLE source');
        $this->addSql('DROP INDEX IDX_161498D3C54C8C93');
        $this->addSql('DROP INDEX IDX_161498D3F3747573');
        $this->addSql('DROP INDEX IDX_161498D3953C1C61');
        $this->addSql('ALTER TABLE card DROP type_id');
        $this->addSql('ALTER TABLE card DROP rarity_id');
        $this->addSql('ALTER TABLE card DROP source_id');
    }
}
