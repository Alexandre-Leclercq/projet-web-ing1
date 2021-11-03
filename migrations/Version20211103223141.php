<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211103223141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add Category table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE Category (idCategory INT AUTO_INCREMENT NOT NULL, caption VARCHAR(255) NOT NULL, active TINYINT(1) DEFAULT \'1\' NOT NULL, PRIMARY KEY(idCategory)) DEFAULT CHARACTER SET UTF8 COLLATE `utf8_bin` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE Category');
    }
}
