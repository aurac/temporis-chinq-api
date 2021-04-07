<?php

declare(strict_types=1);

namespace DoctrineMigrations;


use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20210401221253 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Insert types and sub types into database';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('INSERT INTO public.type VALUES (1, \'Equipement\')');
        $this->addSql('INSERT INTO public.type VALUES (2, \'Consommable\')');
        $this->addSql('INSERT INTO public.type VALUES (3, \'Ressource\')');
        $this->addSql('SELECT setval(\'type_id_seq\', (SELECT MAX(id) from type));');

        $this->addSql('INSERT INTO public.sub_type VALUES (1, 2, \'Bière\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (2, 2, \'Boisson\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (3, 2, \'Bourse de Kamas\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (4, 2, \'Boîte de fragments\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (5, 2, \'Coffre\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (6, 2, \'Conteneur\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (7, 2, \'Friandise\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (8, 2, \'Fée d\'\'artifice\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (9, 2, \'Mimibiote\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (10, 2, \'Mots de haïku\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (11, 2, \'Objet d\'\'élevage\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (12, 2, \'Objet utilisable\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (13, 2, \'Pain\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (14, 2, \'Parchemin d\'\'attitude\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (15, 2, \'Parchemin d\'\'expérience\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (16, 2, \'Parchemin d\'\'ornement\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (17, 2, \'Parchemin d\'\'émoticônes\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (18, 2, \'Parchemin de caractéristique\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (19, 2, \'Parchemin de recherche\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (20, 2, \'Parchemin de sortilège\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (21, 2, \'Parchemin de titre\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (22, 2, \'Pierre magique\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (23, 2, \'Poisson comestible\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (24, 2, \'Popoche de Havre-Sac\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (25, 2, \'Potion\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (26, 2, \'Potion d\'\'attitude\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (27, 2, \'Potion d\'\'oubli Percepteur\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (28, 2, \'Potion de conquête\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (29, 2, \'Potion de familier\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (30, 2, \'Potion de montilier\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (31, 2, \'Potion de monture\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (32, 2, \'Potion de téléportation\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (33, 2, \'Viande comestible \')');
        $this->addSql('INSERT INTO public.sub_type VALUES (34, 1, \'Arc\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (35, 1, \'Baguette\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (36, 1, \'Bâton\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (37, 1, \'Dague\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (38, 1, \'Faux\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (39, 1, \'Hache\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (40, 1, \'Marteau\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (41, 1, \'Outil\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (42, 1, \'Pelle\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (43, 1, \'Pierre d\'\'âme\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (44, 1, \'Pioche\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (45, 1, \'Épée\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (46, 1, \'Amulette\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (47, 1, \'Anneau\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (48, 1, \'Bottes\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (49, 1, \'Bouclier\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (50, 1, \'Cape\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (51, 1, \'Ceinture\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (52, 1, \'Chapeau\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (53, 1, \'Dofus\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (54, 1, \'Objet vivant\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (55, 1, \'Sac à dos\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (56, 1, \'Trophée\')');
        $this->addSql('INSERT INTO public.sub_type VALUES (57, 3, \'Idole\')');
        $this->addSql('SELECT setval(\'sub_type_id_seq\', (SELECT MAX(id) from sub_type));');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('TRUNCATE public.sub_type CASCADE');
        $this->addSql('TRUNCATE public.type CASCADE');
    }
}