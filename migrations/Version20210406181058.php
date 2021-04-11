<?php
/**
 * Version20210406181058.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 06/04/2021
 *
 * @version 1.0
 */

namespace DoctrineMigrations;


use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210406181058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Insert data into card_type, rarity, source tables';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO public.card_type VALUES (1, 'Coeur')");
        $this->addSql("INSERT INTO public.card_type VALUES (2, 'Carreau')");
        $this->addSql("INSERT INTO public.card_type VALUES (3, 'Trèfle')");
        $this->addSql("INSERT INTO public.card_type VALUES (4, 'Pique')");
        $this->addSql("INSERT INTO public.card_type VALUES (5, 'Bonus')");
        $this->addSql("INSERT INTO public.card_type VALUES (6, 'Fragment')");
        $this->addSql('SELECT setval(\'card_type_id_seq\', (SELECT MAX(id) from card_type));');

        $this->addSql("INSERT INTO public.rarity VALUES (1, 'Classique')");
        $this->addSql("INSERT INTO public.rarity VALUES (2, 'Rare')");
        $this->addSql("INSERT INTO public.rarity VALUES (3, 'Inconnu')");
        $this->addSql('SELECT setval(\'rarity_id_seq\', (SELECT MAX(id) from rarity));');

        $this->addSql("INSERT INTO public.source VALUES (1, NULL, 'Alchimiste')");
        $this->addSql("INSERT INTO public.source VALUES (2, NULL, 'Bûcheron')");
        $this->addSql("INSERT INTO public.source VALUES (3, NULL, 'Chasseur')");
        $this->addSql("INSERT INTO public.source VALUES (4, NULL, 'Mineur')");
        $this->addSql("INSERT INTO public.source VALUES (5, NULL, 'Paysan')");
        $this->addSql("INSERT INTO public.source VALUES (6, NULL, 'Pêcheur')");
        $this->addSql("INSERT INTO public.source VALUES (7, NULL, 'Bijoutier')");
        $this->addSql("INSERT INTO public.source VALUES (8, NULL, 'Bricoleur')");
        $this->addSql("INSERT INTO public.source VALUES (9, NULL, 'Cordonnier')");
        $this->addSql("INSERT INTO public.source VALUES (10, NULL, 'Façonneur')");
        $this->addSql("INSERT INTO public.source VALUES (11, NULL, 'Forgeron')");
        $this->addSql("INSERT INTO public.source VALUES (12, NULL, 'Sculpteur')");
        $this->addSql("INSERT INTO public.source VALUES (13, NULL, 'Tailleur')");
        $this->addSql("INSERT INTO public.source VALUES (14, NULL, 'Monstres')");
        $this->addSql("INSERT INTO public.source VALUES (15, NULL, 'Boss')");
        $this->addSql("INSERT INTO public.source VALUES (16, 14, 'Alhyène')");
        $this->addSql("INSERT INTO public.source VALUES (17, 14, 'Berger porkass')");
        $this->addSql("INSERT INTO public.source VALUES (18, 14, 'Troollaraj')");
        $this->addSql("INSERT INTO public.source VALUES (19, 14, 'Timansot')");
        $this->addSql("INSERT INTO public.source VALUES (20, 14, 'Ecumouth')");
        $this->addSql("INSERT INTO public.source VALUES (21, 14, 'Funespadon')");
        $this->addSql("INSERT INTO public.source VALUES (22, 14, 'Bwork Élémental d''Air')");
        $this->addSql("INSERT INTO public.source VALUES (23, 14, 'Craqueleur')");
        $this->addSql("INSERT INTO public.source VALUES (24, 14, 'Pikdoa')");
        $this->addSql("INSERT INTO public.source VALUES (25, 14, 'Fantôme Egerie')");
        $this->addSql("INSERT INTO public.source VALUES (26, 14, 'Caïgule')");
        $this->addSql("INSERT INTO public.source VALUES (27, 14, 'Fléaunide')");
        $this->addSql("INSERT INTO public.source VALUES (28, 14, 'Trukikol')");
        $this->addSql("INSERT INTO public.source VALUES (29, 14, 'Tiwabbit kiafin')");
        $this->addSql("INSERT INTO public.source VALUES (30, 14, 'Wobot kiafin')");
        $this->addSql("INSERT INTO public.source VALUES (31, 14, 'Kaskargo')");
        $this->addSql("INSERT INTO public.source VALUES (32, 14, 'Kido')");
        $this->addSql("INSERT INTO public.source VALUES (33, 14, 'Rouquette')");
        $this->addSql("INSERT INTO public.source VALUES (34, 14, 'Madura')");
        $this->addSql("INSERT INTO public.source VALUES (35, 14, 'Pampactus')");
        $this->addSql("INSERT INTO public.source VALUES (36, 14, 'Boufton blanc')");
        $this->addSql("INSERT INTO public.source VALUES (37, 14, 'Champa bleu')");
        $this->addSql("INSERT INTO public.source VALUES (38, 14, 'Tofu')");
        $this->addSql("INSERT INTO public.source VALUES (39, 14, 'Ikargn')");
        $this->addSql("INSERT INTO public.source VALUES (40, 14, 'Mimikado')");
        $this->addSql("INSERT INTO public.source VALUES (41, 14, 'Halbardent')");
        $this->addSql("INSERT INTO public.source VALUES (42, 14, 'Pikoleur')");
        $this->addSql("INSERT INTO public.source VALUES (43, 14, 'Rilur')");
        $this->addSql("INSERT INTO public.source VALUES (44, 14, 'Grenufar')");
        $this->addSql("INSERT INTO public.source VALUES (45, 14, 'Robionicle')");
        $this->addSql("INSERT INTO public.source VALUES (46, 14, 'Dopeul Osamodas')");
        $this->addSql("INSERT INTO public.source VALUES (47, 14, 'Mécanofoux')");
        $this->addSql("INSERT INTO public.source VALUES (48, 14, 'Vatenbière')");
        $this->addSql("INSERT INTO public.source VALUES (49, 14, 'Gloursaya')");
        $this->addSql("INSERT INTO public.source VALUES (50, 14, '(Ou Abrakne Sombre Irascible car ils ont la même apparence)')");
        $this->addSql("INSERT INTO public.source VALUES (51, 14, 'Néfileuse')");
        $this->addSql("INSERT INTO public.source VALUES (52, 14, 'Crâmbo')");
        $this->addSql("INSERT INTO public.source VALUES (53, 14, 'Dragoeuf Ardoise')");
        $this->addSql("INSERT INTO public.source VALUES (54, 14, 'Scarafeuille Bleu')");
        $this->addSql("INSERT INTO public.source VALUES (55, 14, 'Germinion')");
        $this->addSql("INSERT INTO public.source VALUES (56, 14, 'Crustorail Kouraçao')");
        $this->addSql("INSERT INTO public.source VALUES (57, 14, 'Disciple Zoth')");
        $this->addSql("INSERT INTO public.source VALUES (58, 14, 'Kraméléhon')");
        $this->addSql("INSERT INTO public.source VALUES (59, 14, 'Jiangshi-Nobi')");
        $this->addSql("INSERT INTO public.source VALUES (60, 14, 'Lichangoro')");
        $this->addSql("INSERT INTO public.source VALUES (61, 14, 'Imetsu')");
        $this->addSql("INSERT INTO public.source VALUES (62, 14, 'Pupuce')");
        $this->addSql("INSERT INTO public.source VALUES (63, 14, 'Trantroa')");
        $this->addSql("INSERT INTO public.source VALUES (64, 14, 'Puceronde')");
        $this->addSql("INSERT INTO public.source VALUES (65, 14, 'Panterreur')");
        $this->addSql("INSERT INTO public.source VALUES (66, 14, 'Phorrêveur')");
        $this->addSql("INSERT INTO public.source VALUES (67, 14, 'Farfacette')");
        $this->addSql("INSERT INTO public.source VALUES (68, 14, 'Moumoule')");
        $this->addSql("INSERT INTO public.source VALUES (69, 14, 'Gambaf')");
        $this->addSql("INSERT INTO public.source VALUES (70, 14, 'N''yalg')");
        $this->addSql("INSERT INTO public.source VALUES (71, 14, 'Milirat Strubien')");
        $this->addSql("INSERT INTO public.source VALUES (72, 14, 'Dragodinde')");
        $this->addSql("INSERT INTO public.source VALUES (73, 14, 'Maître Koalak')");
        $this->addSql("INSERT INTO public.source VALUES (74, 14, 'Biblop Indigo')");
        $this->addSql("INSERT INTO public.source VALUES (75, 14, 'Mégabwork')");
        $this->addSql("INSERT INTO public.source VALUES (76, 14, 'Corbac')");
        $this->addSql("INSERT INTO public.source VALUES (77, 14, 'Boufmouth')");
        $this->addSql("INSERT INTO public.source VALUES (78, 14, 'Ectorche')");
        $this->addSql("INSERT INTO public.source VALUES (79, 14, 'Empaillé')");
        $this->addSql("INSERT INTO public.source VALUES (80, 14, 'Dramanite')");
        $this->addSql("INSERT INTO public.source VALUES (81, 14, 'Nocturlabe')");
        $this->addSql("INSERT INTO public.source VALUES (82, 14, 'Gelée Menthe')");
        $this->addSql("INSERT INTO public.source VALUES (83, 14, 'Bwork')");
        $this->addSql("INSERT INTO public.source VALUES (84, 14, 'Skentu')");
        $this->addSql("INSERT INTO public.source VALUES (85, 14, 'Tortue Verte')");
        $this->addSql("INSERT INTO public.source VALUES (86, 14, 'Wabbit Vampire')");
        $this->addSql("INSERT INTO public.source VALUES (87, 14, 'Bourbassingue')");
        $this->addSql("INSERT INTO public.source VALUES (88, 14, 'Akakwa')");
        $this->addSql("INSERT INTO public.source VALUES (89, 14, 'Scordion Bleu')");
        $this->addSql("INSERT INTO public.source VALUES (90, 14, 'Cycloporth')");
        $this->addSql("INSERT INTO public.source VALUES (91, 14, 'Terristocrate')");
        $this->addSql("INSERT INTO public.source VALUES (92, 14, 'Paspartou')");
        $this->addSql("INSERT INTO public.source VALUES (93, 14, 'Milimaître')");
        $this->addSql("INSERT INTO public.source VALUES (94, 14, 'Chasquatch')");
        $this->addSql("INSERT INTO public.source VALUES (95, 14, 'Rhinoféroce')");
        $this->addSql("INSERT INTO public.source VALUES (96, 14, 'Kérigoule')");
        $this->addSql("INSERT INTO public.source VALUES (97, 14, 'Graboule')");
        $this->addSql("INSERT INTO public.source VALUES (98, 14, 'Scorbute')");
        $this->addSql("INSERT INTO public.source VALUES (99, 14, 'Scélérat Strubien')");
        $this->addSql("INSERT INTO public.source VALUES (100, 14, 'Rat Bajoie')");
        $this->addSql("INSERT INTO public.source VALUES (101, 14, 'Rat de Marais')");
        $this->addSql("INSERT INTO public.source VALUES (102, 14, 'Pyrasite')");
        $this->addSql("INSERT INTO public.source VALUES (103, 14, 'Koalak Immature')");
        $this->addSql("INSERT INTO public.source VALUES (104, 14, 'Larve Verte')");
        $this->addSql("INSERT INTO public.source VALUES (105, 14, 'Tournesol Sauvage')");
        $this->addSql("INSERT INTO public.source VALUES (106, 14, 'Champ Champ')");
        $this->addSql("INSERT INTO public.source VALUES (107, 14, 'Pichon Vert')");
        $this->addSql("INSERT INTO public.source VALUES (108, 14, 'Araknosé')");
        $this->addSql("INSERT INTO public.source VALUES (109, 14, 'Piou rouge')");
        $this->addSql("INSERT INTO public.source VALUES (110, 14, 'boufton nuageux')");
        $this->addSql("INSERT INTO public.source VALUES (111, 14, 'Chafer éclaireur')");
        $this->addSql("INSERT INTO public.source VALUES (112, 14, 'Tigrimas')");
        $this->addSql("INSERT INTO public.source VALUES (113, 14, 'Feu vif')");
        $this->addSql("INSERT INTO public.source VALUES (114, 14, 'Petit gloot')");
        $this->addSql("INSERT INTO public.source VALUES (115, 14, 'Rose vaporeuse')");
        $this->addSql("INSERT INTO public.source VALUES (116, 14, 'Bourdard')");
        $this->addSql("INSERT INTO public.source VALUES (117, 14, 'Gliglicerin')");
        $this->addSql("INSERT INTO public.source VALUES (118, 14, 'Maitre bolet')");
        $this->addSql("INSERT INTO public.source VALUES (119, 14, 'Truchon')");
        $this->addSql("INSERT INTO public.source VALUES (120, 14, 'Drosérale')");
        $this->addSql("INSERT INTO public.source VALUES (121, 14, 'Karkanik')");
        $this->addSql("INSERT INTO public.source VALUES (122, 14, 'Yokai givrefoux')");
        $this->addSql("INSERT INTO public.source VALUES (123, 14, 'Bactérib')");
        $this->addSql("INSERT INTO public.source VALUES (124, 14, 'Gelikan')");
        $this->addSql("INSERT INTO public.source VALUES (125, 14, 'Gobus')");
        $this->addSql("INSERT INTO public.source VALUES (126, 14, 'Fleuro')");
        $this->addSql("INSERT INTO public.source VALUES (127, 14, 'Atomistique')");
        $this->addSql("INSERT INTO public.source VALUES (128, 14, 'Fantomalamère')");
        $this->addSql("INSERT INTO public.source VALUES (129, 14, 'Ecurouille')");
        $this->addSql("INSERT INTO public.source VALUES (130, 14, 'Dragnarok')");
        $this->addSql("INSERT INTO public.source VALUES (131, 14, 'Dragoss charbon')");
        $this->addSql("INSERT INTO public.source VALUES (132, 14, 'Cochon de lait')");
        $this->addSql("INSERT INTO public.source VALUES (133, 14, 'Kwak de terre')");
        $this->addSql("INSERT INTO public.source VALUES (134, 14, 'Chafer')");
        $this->addSql("INSERT INTO public.source VALUES (135, 14, 'Garglyphe')");
        $this->addSql("INSERT INTO public.source VALUES (136, 14, 'Boulardin')");
        $this->addSql("INSERT INTO public.source VALUES (137, 14, 'Kanniboul Jav')");
        $this->addSql("INSERT INTO public.source VALUES (138, 14, 'Boomba')");
        $this->addSql("INSERT INTO public.source VALUES (139, 14, 'Floribonde')");
        $this->addSql("INSERT INTO public.source VALUES (140, 14, 'Flib')");
        $this->addSql("INSERT INTO public.source VALUES (141, 14, 'Voleur tanuki')");
        $this->addSql("INSERT INTO public.source VALUES (142, 14, 'Mabram')");
        $this->addSql("INSERT INTO public.source VALUES (143, 14, 'Chakanoubis')");
        $this->addSql("INSERT INTO public.source VALUES (144, 14, 'Tofu dodu')");
        $this->addSql("INSERT INTO public.source VALUES (145, 14, 'Roi joueur')");
        $this->addSql("INSERT INTO public.source VALUES (146, 14, 'Champmane')");
        $this->addSql("INSERT INTO public.source VALUES (147, 14, 'Mulou')");
        $this->addSql("INSERT INTO public.source VALUES (148, 14, 'Mineur sombre')");
        $this->addSql("INSERT INTO public.source VALUES (149, NULL, 'Inconnu')");
        $this->addSql('SELECT setval(\'source_id_seq\', (SELECT MAX(id) from source));');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('TRUNCATE public.card_type CASCADE');
        $this->addSql('TRUNCATE public.rarity CASCADE');
        $this->addSql('TRUNCATE public.source CASCADE');
        $this->addSql('ALTER SEQUENCE card_type_id_seq RESTART WITH 1');
        $this->addSql('ALTER SEQUENCE rarity_id_seq RESTART WITH 1');
        $this->addSql('ALTER SEQUENCE source_id_seq RESTART WITH 1');
    }
}
