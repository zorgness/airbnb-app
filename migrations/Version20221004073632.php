<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221004073632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE flat_option_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE flat_option (id INT NOT NULL, flat_id INT NOT NULL, wifi BOOLEAN DEFAULT false NOT NULL, parking BOOLEAN DEFAULT false NOT NULL, working_place BOOLEAN DEFAULT false NOT NULL, animal BOOLEAN DEFAULT false NOT NULL, kitchen BOOLEAN DEFAULT false NOT NULL, tv BOOLEAN DEFAULT false NOT NULL, aircon BOOLEAN DEFAULT false NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_45E63BA9D3331C94 ON flat_option (flat_id)');
        $this->addSql('ALTER TABLE flat_option ADD CONSTRAINT FK_45E63BA9D3331C94 FOREIGN KEY (flat_id) REFERENCES flat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flat DROP latitude');
        $this->addSql('ALTER TABLE flat DROP longitude');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE flat_option_id_seq CASCADE');
        $this->addSql('ALTER TABLE flat_option DROP CONSTRAINT FK_45E63BA9D3331C94');
        $this->addSql('DROP TABLE flat_option');
        $this->addSql('ALTER TABLE flat ADD latitude DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE flat ADD longitude DOUBLE PRECISION DEFAULT NULL');
    }
}
