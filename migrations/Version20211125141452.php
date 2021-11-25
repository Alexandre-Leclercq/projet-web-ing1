<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211125141452 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Add table CourseStatus';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE CourseStatus (starred TINYINT(1) DEFAULT \'0\' NOT NULL, lastDatetime DATETIME DEFAULT NULL, idUser INT NOT NULL, idCourse INT NOT NULL, lastChapterReading INT DEFAULT NULL, INDEX idUser (idUser), INDEX idCourse (idCourse), INDEX lastChapterReading (lastChapterReading), PRIMARY KEY(idUser, idCourse)) DEFAULT CHARACTER SET UTF8 COLLATE `utf8_bin` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE CourseStatus ADD CONSTRAINT FK_70E50A6FE6E88D7 FOREIGN KEY (idUser) REFERENCES User (idUser)');
        $this->addSql('ALTER TABLE CourseStatus ADD CONSTRAINT FK_70E50A6758FC723 FOREIGN KEY (idCourse) REFERENCES Course (idCourse)');
        $this->addSql('ALTER TABLE CourseStatus ADD CONSTRAINT FK_70E50A6A2F19EB4 FOREIGN KEY (lastChapterReading) REFERENCES Chapter (idChapter)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE CourseStatus');
    }
}
