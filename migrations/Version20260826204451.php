<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260826204451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `providers` (name VARCHAR(50) NOT NULL, description VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, active TINYINT DEFAULT 0 NOT NULL, rf_resident TINYINT DEFAULT 0 NOT NULL, need_proxy TINYINT DEFAULT 0 NOT NULL, id INT AUTO_INCREMENT NOT NULL, UNIQUE INDEX name_uniq_idx (name), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE `template` (name VARCHAR(255) NOT NULL, id INT AUTO_INCREMENT NOT NULL, UNIQUE INDEX UNIQ_97601F835E237E06 (name), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE `template_part` (name VARCHAR(255) NOT NULL, id INT AUTO_INCREMENT NOT NULL, template_id INT NOT NULL, INDEX IDX_9CC15AAB5DA0FB8 (template_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE `template_part_property` (name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, id INT AUTO_INCREMENT NOT NULL, template_part_id INT NOT NULL, INDEX IDX_7EBE8861F5B30D5 (template_part_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('CREATE TABLE `template_part_property_value` (`int` INT DEFAULT NULL, `float` DOUBLE PRECISION DEFAULT NULL, string VARCHAR(255) DEFAULT NULL, boolean TINYINT DEFAULT NULL, json JSON DEFAULT NULL, id INT AUTO_INCREMENT NOT NULL, template_part_property_id INT NOT NULL, INDEX IDX_43331FCF2286E011 (template_part_property_id), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
        $this->addSql('ALTER TABLE `template_part` ADD CONSTRAINT FK_9CC15AAB5DA0FB8 FOREIGN KEY (template_id) REFERENCES `template` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `template_part_property` ADD CONSTRAINT FK_7EBE8861F5B30D5 FOREIGN KEY (template_part_id) REFERENCES `template_part` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `template_part_property_value` ADD CONSTRAINT FK_43331FCF2286E011 FOREIGN KEY (template_part_property_id) REFERENCES `template_part_property` (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `template_part` DROP FOREIGN KEY FK_9CC15AAB5DA0FB8');
        $this->addSql('ALTER TABLE `template_part_property` DROP FOREIGN KEY FK_7EBE8861F5B30D5');
        $this->addSql('ALTER TABLE `template_part_property_value` DROP FOREIGN KEY FK_43331FCF2286E011');
        $this->addSql('DROP TABLE `providers`');
        $this->addSql('DROP TABLE `template`');
        $this->addSql('DROP TABLE `template_part`');
        $this->addSql('DROP TABLE `template_part_property`');
        $this->addSql('DROP TABLE `template_part_property_value`');
    }
}
