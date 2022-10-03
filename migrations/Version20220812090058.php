<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220812090058 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE flat_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE flat (id INT NOT NULL, owner_id INT DEFAULT NULL, address VARCHAR(255) NOT NULL, price_per_day INT NOT NULL, description VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_554AAA447E3C61F9 ON flat (owner_id)');
        $this->addSql('ALTER TABLE flat ADD CONSTRAINT FK_554AAA447E3C61F9 FOREIGN KEY (owner_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE flat_id_seq CASCADE');
        $this->addSql('ALTER TABLE flat DROP CONSTRAINT FK_554AAA447E3C61F9');
        $this->addSql('DROP TABLE flat');
    }
}
