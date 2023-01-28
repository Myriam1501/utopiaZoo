<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230128105203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animal (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, sound VARCHAR(255) DEFAULT NULL, picture VARCHAR(50000) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bill ADD payment_id INT NOT NULL');
        $this->addSql('ALTER TABLE bill ADD CONSTRAINT FK_7A2119E34C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id)');
        $this->addSql('CREATE INDEX IDX_7A2119E34C3A3BB ON bill (payment_id)');
        $this->addSql('ALTER TABLE reservation ADD account_id INT NOT NULL, ADD payements_id INT NOT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559B6B5FBA FOREIGN KEY (account_id) REFERENCES account (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559E2B8987 FOREIGN KEY (payements_id) REFERENCES payment (id)');
        $this->addSql('CREATE INDEX IDX_42C849559B6B5FBA ON reservation (account_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_42C849559E2B8987 ON reservation (payements_id)');
        $this->addSql('ALTER TABLE ticket ADD reservation_id INT NOT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3B83297E7 ON ticket (reservation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE animal');
        $this->addSql('ALTER TABLE bill DROP FOREIGN KEY FK_7A2119E34C3A3BB');
        $this->addSql('DROP INDEX IDX_7A2119E34C3A3BB ON bill');
        $this->addSql('ALTER TABLE bill DROP payment_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559B6B5FBA');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559E2B8987');
        $this->addSql('DROP INDEX IDX_42C849559B6B5FBA ON reservation');
        $this->addSql('DROP INDEX UNIQ_42C849559E2B8987 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP account_id, DROP payements_id');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3B83297E7');
        $this->addSql('DROP INDEX IDX_97A0ADA3B83297E7 ON ticket');
        $this->addSql('ALTER TABLE ticket DROP reservation_id');
    }
}
