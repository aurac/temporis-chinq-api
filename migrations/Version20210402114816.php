<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210402114816 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE recipe_level_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE recipe_level (id INT NOT NULL, level INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE recipe_level_card (recipe_level_id INT NOT NULL, card_id INT NOT NULL, PRIMARY KEY(recipe_level_id, card_id))');
        $this->addSql('CREATE INDEX IDX_364FE5A12921EE39 ON recipe_level_card (recipe_level_id)');
        $this->addSql('CREATE INDEX IDX_364FE5A14ACC9A20 ON recipe_level_card (card_id)');
        $this->addSql('ALTER TABLE recipe_level_card ADD CONSTRAINT FK_364FE5A12921EE39 FOREIGN KEY (recipe_level_id) REFERENCES recipe_level (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_level_card ADD CONSTRAINT FK_364FE5A14ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE recipe_level_card DROP CONSTRAINT FK_364FE5A12921EE39');
        $this->addSql('DROP SEQUENCE recipe_level_id_seq CASCADE');
        $this->addSql('DROP TABLE recipe_level');
        $this->addSql('DROP TABLE recipe_level_card');
    }
}
