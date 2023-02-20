<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230219225413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE programme (id INT AUTO_INCREMENT NOT NULL, titre_programme VARCHAR(255) NOT NULL, date_deb DATETIME DEFAULT NULL, date_fin DATETIME DEFAULT NULL, description_programme VARCHAR(255) DEFAULT NULL, age_minim_prog INT DEFAULT NULL, picture_deco_path VARCHAR(255) DEFAULT NULL, timer_programmer VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD reset_token VARCHAR(100) NOT NULL, CHANGE Id id INT AUTO_INCREMENT NOT NULL, CHANGE email email VARCHAR(180) NOT NULL, CHANGE first_name first_name VARCHAR(255) NOT NULL, CHANGE name name VARCHAR(255) NOT NULL, CHANGE address address VARCHAR(255) DEFAULT NULL, CHANGE date_inscription date_inscription DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE password password VARCHAR(255) NOT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE programme');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user DROP reset_token, CHANGE id Id INT AUTO_INCREMENT NOT NULL COMMENT \'id\', CHANGE email email VARCHAR(200) NOT NULL COMMENT \'email\', CHANGE first_name first_name VARCHAR(100) NOT NULL COMMENT \'first_name\', CHANGE name name VARCHAR(100) NOT NULL COMMENT \'name\', CHANGE address address TEXT NOT NULL COMMENT \'address\', CHANGE date_inscription date_inscription DATETIME NOT NULL COMMENT \'date_inscription\', CHANGE roles roles TEXT NOT NULL COMMENT \'roles\', CHANGE password password TEXT NOT NULL COMMENT \'password\'');
    }
}
