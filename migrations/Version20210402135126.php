<?php
/**
 * Version20210402135126.php
 *
 * @author Aurélien ADAM <aurelienadam96@gmail.com>
 * Date: 02/04/2021
 *
 * @version 1.0
 */

namespace DoctrineMigrations;


use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20210402135126 extends AbstractMigration
{
    public function getDescription() : string
    {
        return 'Insert data into recipe_level table';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO public.recipe_level VALUES (1, 2)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (2, 3)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (3, 4)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (4, 5)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (5, 6)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (6, 7)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (7, 8)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (8, 9)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (9, 10)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (10, 11)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (11, 12)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (12, 13)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (13, 14)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (14, 15)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (15, 16)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (16, 17)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (17, 18)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (18, 19)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (19, 20)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (20, 21)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (21, 22)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (22, 23)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (23, 24)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (24, 25)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (25, 26)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (26, 27)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (27, 28)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (28, 29)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (29, 30)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (30, 31)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (31, 32)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (32, 33)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (33, 34)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (34, 35)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (35, 36)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (36, 37)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (37, 38)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (38, 39)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (39, 40)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (40, 41)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (41, 42)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (42, 43)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (43, 44)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (44, 45)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (45, 46)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (46, 47)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (47, 48)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (48, 49)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (49, 50)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (50, 51)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (51, 52)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (52, 53)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (53, 54)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (54, 55)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (55, 56)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (56, 57)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (57, 58)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (58, 59)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (59, 60)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (60, 61)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (61, 62)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (62, 63)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (63, 64)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (64, 65)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (65, 66)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (66, 67)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (67, 68)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (68, 69)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (69, 70)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (70, 71)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (71, 72)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (72, 73)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (73, 74)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (74, 75)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (75, 76)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (76, 77)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (77, 78)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (78, 79)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (79, 80)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (80, 81)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (81, 82)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (82, 83)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (83, 84)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (84, 85)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (85, 86)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (86, 87)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (87, 88)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (88, 89)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (89, 90)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (90, 91)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (91, 92)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (92, 93)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (93, 94)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (94, 95)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (95, 96)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (96, 97)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (97, 98)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (98, 99)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (99, 100)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (100, 101)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (101, 102)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (102, 103)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (103, 104)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (104, 105)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (105, 106)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (106, 107)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (107, 108)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (108, 109)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (109, 110)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (110, 111)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (111, 112)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (112, 113)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (113, 114)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (114, 115)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (115, 116)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (116, 117)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (117, 118)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (118, 119)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (119, 120)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (120, 121)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (121, 122)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (122, 123)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (123, 124)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (124, 125)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (125, 126)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (126, 127)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (127, 128)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (128, 129)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (129, 130)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (130, 131)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (131, 132)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (132, 133)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (133, 134)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (134, 135)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (135, 136)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (136, 137)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (137, 138)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (138, 139)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (139, 140)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (140, 141)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (141, 142)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (142, 143)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (143, 144)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (144, 145)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (145, 146)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (146, 147)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (147, 148)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (148, 149)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (149, 150)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (150, 151)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (151, 152)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (152, 153)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (153, 154)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (154, 155)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (155, 156)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (156, 157)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (157, 158)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (158, 159)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (159, 160)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (160, 161)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (161, 162)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (162, 163)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (163, 164)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (164, 165)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (165, 166)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (166, 167)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (167, 168)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (168, 169)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (169, 170)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (170, 171)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (171, 172)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (172, 173)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (173, 174)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (174, 175)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (175, 176)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (176, 177)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (177, 178)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (178, 179)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (179, 180)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (180, 181)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (181, 182)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (182, 183)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (183, 184)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (184, 185)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (185, 186)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (186, 187)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (187, 188)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (188, 189)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (189, 190)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (190, 191)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (191, 192)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (192, 193)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (193, 194)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (194, 195)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (195, 196)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (196, 197)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (197, 198)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (198, 199)");
        $this->addSql("INSERT INTO public.recipe_level VALUES (199, 200)");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('TRUNCATE public.recipe_level');
    }
}
