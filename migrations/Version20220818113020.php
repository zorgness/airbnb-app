<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220818113020 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
       $this->addSql('CREATE TABLE booking (id INT NOT NULL, flat_id INT DEFAULT NULL, user_account_id INT DEFAULT NULL, number_people INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, accepted BOOLEAN DEFAULT false NOT NULL, rejected BOOLEAN DEFAULT false NOT NULL, PRIMARY KEY(id))');
       $this->addSql('CREATE INDEX IDX_E00CEDDED3331C94 ON booking (flat_id)');
       $this->addSql('CREATE INDEX IDX_E00CEDDE3C0C9956 ON booking (user_account_id)');
       $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDED3331C94 FOREIGN KEY (flat_id) REFERENCES flat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
       $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE3C0C9956 FOREIGN KEY (user_account_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE booking DROP CONSTRAINT FK_E00CEDDED3331C94');
        $this->addSql('ALTER TABLE booking DROP CONSTRAINT FK_E00CEDDE3C0C9956');
        $this->addSql('DROP TABLE booking');
    }
}
