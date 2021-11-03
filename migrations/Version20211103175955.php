<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211103175955 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add User table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE User (idUser INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, password VARCHAR(255) NOT NULL, firstName VARCHAR(255) NOT NULL, lastName VARCHAR(255) NOT NULL, token VARCHAR(255) DEFAULT NULL, pictureFilelink VARCHAR(255) DEFAULT NULL, dateLog DATETIME DEFAULT NULL, active TINYINT(1) DEFAULT \'1\' NOT NULL, idRole INT NOT NULL, INDEX idRole (idRole), UNIQUE INDEX email (email), PRIMARY KEY(idUser)) DEFAULT CHARACTER SET UTF8 COLLATE `utf8_bin` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE User ADD CONSTRAINT FK_2DA179772494D4F4 FOREIGN KEY (idRole) REFERENCES Role (idRole)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE User');
    }
}
