<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230318141315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quizz MODIFY idQuizz INT NOT NULL');
        $this->addSql('ALTER TABLE quizz DROP FOREIGN KEY quizz_FK');
        $this->addSql('DROP INDEX quizz_FK ON quizz');
        $this->addSql('DROP INDEX `primary` ON quizz');
        $this->addSql('ALTER TABLE quizz DROP idQuizz, CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE quizz ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quizz MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX `PRIMARY` ON quizz');
        $this->addSql('ALTER TABLE quizz ADD idQuizz INT AUTO_INCREMENT NOT NULL, CHANGE id id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quizz ADD CONSTRAINT quizz_FK FOREIGN KEY (id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX quizz_FK ON quizz (id)');
        $this->addSql('ALTER TABLE quizz ADD PRIMARY KEY (idQuizz)');
    }
}
