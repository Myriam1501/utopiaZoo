<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230126224512 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, address VARCHAR(255) DEFAULT NULL, passeword INT NOT NULL, email_login VARCHAR(255) NOT NULL, date_inscription DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE bill (id INT AUTO_INCREMENT NOT NULL, payment_id INT NOT NULL, bill_number INT NOT NULL, total_amount DOUBLE PRECISION NOT NULL, INDEX IDX_7A2119E34C3A3BB (payment_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, bank_number INT NOT NULL, date_expires DATE NOT NULL, security_code INT NOT NULL, payment_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, account_id INT NOT NULL, payements_id INT NOT NULL, name_reserve VARCHAR(255) NOT NULL, first_name_reserve VARCHAR(255) NOT NULL, date DATE NOT NULL, time TIME NOT NULL, ticket_quantity INT NOT NULL, INDEX IDX_42C849559B6B5FBA (account_id), UNIQUE INDEX UNIQ_42C849559E2B8987 (payements_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket (id INT AUTO_INCREMENT NOT NULL, reservation_id INT NOT NULL, type VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_97A0ADA3B83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bill ADD CONSTRAINT FK_7A2119E34C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559E2B8987 FOREIGN KEY (payements_id) REFERENCES payment (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bill DROP FOREIGN KEY FK_7A2119E34C3A3BB');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559B6B5FBA');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559E2B8987');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3B83297E7');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE bill');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE ticket');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
