<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222131143 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559B6B5FBA');
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, sound VARCHAR(255) DEFAULT NULL, picture VARCHAR(2000) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE animale_game (id INT AUTO_INCREMENT NOT NULL, img1 VARCHAR(50) NOT NULL, img2 VARCHAR(50) NOT NULL, img3 VARCHAR(50) NOT NULL, img4 VARCHAR(50) NOT NULL, img5 VARCHAR(50) NOT NULL, img6 VARCHAR(50) NOT NULL, img7 VARCHAR(50) NOT NULL, img8 VARCHAR(50) NOT NULL, img9 VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE upload_ticket (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, first_name VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) DEFAULT NULL, reset_token VARCHAR(100) DEFAULT NULL, date_inscription DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', roles JSON NOT NULL, password VARCHAR(255) NOT NULL, check_email TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bill DROP FOREIGN KEY FK_7A2119E34C3A3BB');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE bill');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559E2B8987');
        $this->addSql('DROP INDEX IDX_42C849559B6B5FBA ON reservation');
        $this->addSql('DROP INDEX UNIQ_42C849559E2B8987 ON reservation');
        $this->addSql('ALTER TABLE reservation ADD user_id INT DEFAULT NULL, DROP account_id, DROP payements_id, DROP name_reserve, DROP first_name_reserve, DROP time, DROP ticket_quantity');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C84955A76ED395 ON reservation (user_id)');
        $this->addSql('ALTER TABLE ticket ADD program_id INT DEFAULT NULL, ADD qte_normal INT NOT NULL, ADD qte_reduce INT DEFAULT NULL, DROP type, DROP price, CHANGE reservation_id reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA33EB8070A FOREIGN KEY (program_id) REFERENCES program (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA33EB8070A ON ticket (program_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, first_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, address VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, passeword INT NOT NULL, email_login VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_inscription DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE bill (id INT AUTO_INCREMENT NOT NULL, payment_id INT NOT NULL, bill_number INT NOT NULL, total_amount DOUBLE PRECISION NOT NULL, INDEX IDX_7A2119E34C3A3BB (payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE bill ADD CONSTRAINT FK_7A2119E34C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('DROP TABLE animal');
        $this->addSql('DROP TABLE animale_game');
        $this->addSql('DROP TABLE upload_ticket');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX UNIQ_42C84955A76ED395 ON reservation');
        $this->addSql('ALTER TABLE reservation ADD account_id INT NOT NULL, ADD payements_id INT NOT NULL, ADD name_reserve VARCHAR(255) NOT NULL, ADD first_name_reserve VARCHAR(255) NOT NULL, ADD time TIME NOT NULL, ADD ticket_quantity INT NOT NULL, DROP user_id');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559E2B8987 FOREIGN KEY (payements_id) REFERENCES payment (id)');
        $this->addSql('CREATE INDEX IDX_42C849559B6B5FBA ON reservation (account_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C849559E2B8987 ON reservation (payements_id)');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA33EB8070A');
        $this->addSql('DROP INDEX IDX_97A0ADA33EB8070A ON ticket');
        $this->addSql('ALTER TABLE ticket ADD type VARCHAR(255) NOT NULL, ADD price DOUBLE PRECISION NOT NULL, DROP program_id, DROP qte_normal, DROP qte_reduce, CHANGE reservation_id reservation_id INT NOT NULL');
    }
}
