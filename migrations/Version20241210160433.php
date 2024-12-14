<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241210160433 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription CHANGE user_id user_id INT DEFAULT NULL, CHANGE user_nom user_nom VARCHAR(255) DEFAULT NULL, CHANGE user_adresse user_adresse VARCHAR(255) DEFAULT NULL, CHANGE user_numero user_numero VARCHAR(20) DEFAULT NULL, CHANGE formation_nom formation_nom VARCHAR(255) DEFAULT NULL, CHANGE date_inscription date_inscription DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inscription CHANGE user_id user_id INT NOT NULL, CHANGE user_nom user_nom VARCHAR(255) NOT NULL, CHANGE user_adresse user_adresse VARCHAR(255) NOT NULL, CHANGE user_numero user_numero VARCHAR(20) NOT NULL, CHANGE formation_nom formation_nom VARCHAR(255) NOT NULL, CHANGE date_inscription date_inscription DATETIME NOT NULL');
    }
}
