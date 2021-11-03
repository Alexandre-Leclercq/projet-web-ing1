<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211103225012 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add Log table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Log (dateLog DATETIME NOT NULL COMMENT \'(DC2Type:datetimekey)\', idUser INT NOT NULL, idChapter INT NOT NULL, INDEX idUser (idUser), INDEX idChapter (idChapter), PRIMARY KEY(idUser, idChapter, dateLog)) DEFAULT CHARACTER SET UTF8 COLLATE `utf8_bin` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE Log ADD CONSTRAINT FK_B7722E25FE6E88D7 FOREIGN KEY (idUser) REFERENCES User (idUser)');
        $this->addSql('ALTER TABLE Log ADD CONSTRAINT FK_B7722E25E938DEDC FOREIGN KEY (idChapter) REFERENCES Chapter (idChapter)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE Log');
    }
}
