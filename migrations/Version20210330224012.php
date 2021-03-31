<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210330224012 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE recipe_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE recipe (id INT NOT NULL, item_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DA88B137126F525E ON recipe (item_id)');
        $this->addSql('CREATE TABLE recipe_card (recipe_id INT NOT NULL, card_id INT NOT NULL, PRIMARY KEY(recipe_id, card_id))');
        $this->addSql('CREATE INDEX IDX_690FC20C59D8A214 ON recipe_card (recipe_id)');
        $this->addSql('CREATE INDEX IDX_690FC20C4ACC9A20 ON recipe_card (card_id)');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137126F525E FOREIGN KEY (item_id) REFERENCES item (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_card ADD CONSTRAINT FK_690FC20C59D8A214 FOREIGN KEY (recipe_id) REFERENCES recipe (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE recipe_card ADD CONSTRAINT FK_690FC20C4ACC9A20 FOREIGN KEY (card_id) REFERENCES card (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE recipe_card DROP CONSTRAINT FK_690FC20C59D8A214');
        $this->addSql('DROP SEQUENCE recipe_id_seq CASCADE');
        $this->addSql('DROP TABLE recipe');
        $this->addSql('DROP TABLE recipe_card');
    }
}
