<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211103151120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add Course table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Course (idCourse INT AUTO_INCREMENT NOT NULL, idUser INT NOT NULL, caption VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, filelink VARCHAR(255) DEFAULT NULL, starred TINYINT(1) DEFAULT \'0\' NOT NULL, active TINYINT(1) DEFAULT \'1\' NOT NULL, PRIMARY KEY(idCourse)) DEFAULT CHARACTER SET UTF8 COLLATE `utf8_bin` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE Course');
    }
}
