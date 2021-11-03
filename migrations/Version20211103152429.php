<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211103152429 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add Chapter table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Chapter (idChapter INT AUTO_INCREMENT NOT NULL, step INT NOT NULL, caption VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, starred TINYINT(1) DEFAULT \'0\' NOT NULL, active TINYINT(1) DEFAULT \'1\' NOT NULL, idCourse INT NOT NULL, INDEX idCourse (idCourse), UNIQUE INDEX step (step, idCourse), PRIMARY KEY(idChapter)) DEFAULT CHARACTER SET UTF8 COLLATE `utf8_bin` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Chapter ADD CONSTRAINT FK_363C8CB2758FC723 FOREIGN KEY (idCourse) REFERENCES Course (idCourse)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE Chapter');
    }
}
