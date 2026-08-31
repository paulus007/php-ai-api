<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260831202838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE providers ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE template ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE template_part ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE template_part_property ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE template_part_property_value ADD created_at DATETIME DEFAULT NULL, ADD updated_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `providers` DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE `template` DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE `template_part` DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE `template_part_property` DROP created_at, DROP updated_at');
        $this->addSql('ALTER TABLE `template_part_property_value` DROP created_at, DROP updated_at');
    }
}
