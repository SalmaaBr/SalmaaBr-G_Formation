<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241129215705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD is_banned TINYINT(1) DEFAULT NULL, ADD is_approved TINYINT(1) DEFAULT NULL, ADD roles JSON NOT NULL COMMENT \'(DC2Type:json)\', ADD phone VARCHAR(10) DEFAULT NULL, ADD photoproile VARCHAR(255) DEFAULT NULL, ADD sexe VARCHAR(255) DEFAULT NULL, ADD birthdate DATE DEFAULT NULL, ADD photodeprofile VARCHAR(255) DEFAULT NULL, ADD dateofbirth DATE DEFAULT NULL, CHANGE id id INT NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user DROP is_banned, DROP is_approved, DROP roles, DROP phone, DROP photoproile, DROP sexe, DROP birthdate, DROP photodeprofile, DROP dateofbirth, CHANGE id id INT AUTO_INCREMENT NOT NULL');
    }
}
