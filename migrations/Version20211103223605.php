<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211103223605 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add mapping category to course table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Course ADD idCategory INT NOT NULL');
        $this->addSql('ALTER TABLE Course ADD CONSTRAINT FK_11326A8F55EF339A FOREIGN KEY (idCategory) REFERENCES Category (idCategory)');
        $this->addSql('CREATE INDEX idCategory ON Course (idCategory)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE Course DROP FOREIGN KEY FK_11326A8F55EF339A');
        $this->addSql('DROP INDEX idCategory ON Course');
        $this->addSql('ALTER TABLE Course DROP idCategory');
    }
}
