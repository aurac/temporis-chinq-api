<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210410183219 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe ADD created_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137B03A8386 FOREIGN KEY (created_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_DA88B137B03A8386 ON recipe (created_by_id)');
        $this->addSql('ALTER TABLE recipe_level ADD updated_by_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE recipe_level ADD CONSTRAINT FK_8CF9180C896DBBDE FOREIGN KEY (updated_by_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_8CF9180C896DBBDE ON recipe_level (updated_by_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE recipe DROP CONSTRAINT FK_DA88B137B03A8386');
        $this->addSql('DROP INDEX IDX_DA88B137B03A8386');
        $this->addSql('ALTER TABLE recipe DROP created_by_id');
        $this->addSql('ALTER TABLE recipe_level DROP CONSTRAINT FK_8CF9180C896DBBDE');
        $this->addSql('DROP INDEX IDX_8CF9180C896DBBDE');
        $this->addSql('ALTER TABLE recipe_level DROP updated_by_id');
    }
}
