<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211125141710 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'remove Log table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE Log');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Log (idUser INT NOT NULL, idChapter INT NOT NULL, dateLog DATETIME NOT NULL COMMENT \'(DC2Type:datetimekey)\', INDEX idChapter (idChapter), INDEX idUser (idUser), PRIMARY KEY(idUser, idChapter, dateLog)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE Log ADD CONSTRAINT FK_B7722E25E938DEDC FOREIGN KEY (idChapter) REFERENCES Chapter (idChapter)');
        $this->addSql('ALTER TABLE Log ADD CONSTRAINT FK_B7722E25FE6E88D7 FOREIGN KEY (idUser) REFERENCES User (idUser)');
    }
}
