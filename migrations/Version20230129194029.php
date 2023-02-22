<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230129194029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE animale_game (id INT AUTO_INCREMENT NOT NULL, img1 VARCHAR(50) NOT NULL, img2 VARCHAR(50) NOT NULL, img3 VARCHAR(50) NOT NULL, img4 VARCHAR(50) NOT NULL, img5 VARCHAR(50) NOT NULL, img6 VARCHAR(50) NOT NULL, img7 VARCHAR(50) NOT NULL, img8 VARCHAR(50) NOT NULL, img9 VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
       // $this->addSql('ALTER TABLE animal CHANGE picture picture VARCHAR(2000) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE animale_game');
      //  $this->addSql('ALTER TABLE animal CHANGE picture picture VARCHAR(5000) DEFAULT NULL');
    }
}
