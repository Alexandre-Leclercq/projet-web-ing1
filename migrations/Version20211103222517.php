<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211103222517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add user mapping to course table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Course ADD CONSTRAINT FK_11326A8FFE6E88D7 FOREIGN KEY (idUser) REFERENCES User (idUser)');
        $this->addSql('CREATE INDEX idUser ON Course (idUser)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Course DROP FOREIGN KEY FK_11326A8FFE6E88D7');
        $this->addSql('DROP INDEX idUser ON Course');
    }
}
