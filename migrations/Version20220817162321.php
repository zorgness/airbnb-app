<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220817162321 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE flat ADD people INT NOT NULL');
        $this->addSql('ALTER TABLE flat ADD bathroom INT NOT NULL');
        $this->addSql('ALTER TABLE flat ADD room INT NOT NULL');
        $this->addSql('ALTER TABLE flat ADD bed INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE flat DROP people');
        $this->addSql('ALTER TABLE flat DROP bathroom');
        $this->addSql('ALTER TABLE flat DROP room');
        $this->addSql('ALTER TABLE flat DROP bed');
    }
}
