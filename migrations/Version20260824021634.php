<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260824021634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `providers` (name VARCHAR(50) NOT NULL, description VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, active TINYINT DEFAULT 0 NOT NULL, rf_resident TINYINT DEFAULT 0 NOT NULL, need_proxy TINYINT DEFAULT 0 NOT NULL, id INT AUTO_INCREMENT NOT NULL, UNIQUE INDEX name_uniq_idx (name), PRIMARY KEY (id)) DEFAULT CHARACTER SET utf8mb4');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE `providers`');
    }
}
