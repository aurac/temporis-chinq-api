<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210406230651 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE card DROP CONSTRAINT fk_161498d33da5256d');
        $this->addSql('DROP INDEX idx_161498d33da5256d');
        $this->addSql('ALTER TABLE card ADD image_svg_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card RENAME COLUMN image_id TO image_png_id');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3C0EE81E FOREIGN KEY (image_png_id) REFERENCES media_object (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT FK_161498D3DA0A46F3 FOREIGN KEY (image_svg_id) REFERENCES media_object (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_161498D3C0EE81E ON card (image_png_id)');
        $this->addSql('CREATE INDEX IDX_161498D3DA0A46F3 ON card (image_svg_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE card DROP CONSTRAINT FK_161498D3C0EE81E');
        $this->addSql('ALTER TABLE card DROP CONSTRAINT FK_161498D3DA0A46F3');
        $this->addSql('DROP INDEX IDX_161498D3C0EE81E');
        $this->addSql('DROP INDEX IDX_161498D3DA0A46F3');
        $this->addSql('ALTER TABLE card ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE card DROP image_png_id');
        $this->addSql('ALTER TABLE card DROP image_svg_id');
        $this->addSql('ALTER TABLE card ADD CONSTRAINT fk_161498d33da5256d FOREIGN KEY (image_id) REFERENCES media_object (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_161498d33da5256d ON card (image_id)');
    }
}
