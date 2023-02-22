<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222194046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY reservation_FK');
        $this->addSql('ALTER TABLE reservation ADD tickets_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495587234BE8 FOREIGN KEY (tickets_id_id) REFERENCES ticket (id)');
        $this->addSql('CREATE INDEX IDX_42C8495587234BE8 ON reservation (tickets_id_id)');
        $this->addSql('ALTER TABLE ticket ADD reservation_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3B83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3B83297E7 ON ticket (reservation_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495587234BE8');
        $this->addSql('DROP INDEX IDX_42C8495587234BE8 ON reservation');
        $this->addSql('ALTER TABLE reservation DROP tickets_id_id');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT reservation_FK FOREIGN KEY (id) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3B83297E7');
        $this->addSql('DROP INDEX IDX_97A0ADA3B83297E7 ON ticket');
        $this->addSql('ALTER TABLE ticket DROP reservation_id');
    }
}
