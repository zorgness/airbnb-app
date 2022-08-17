<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220817182912 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking ALTER flat_id DROP NOT NULL');
        $this->addSql('ALTER TABLE booking ALTER user_account_id DROP NOT NULL');
        $this->addSql('ALTER TABLE booking ALTER start_date TYPE DATE');
        $this->addSql('ALTER TABLE booking ALTER end_date TYPE DATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE booking ALTER flat_id SET NOT NULL');
        $this->addSql('ALTER TABLE booking ALTER user_account_id SET NOT NULL');
        $this->addSql('ALTER TABLE booking ALTER start_date TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
        $this->addSql('ALTER TABLE booking ALTER end_date TYPE TIMESTAMP(0) WITHOUT TIME ZONE');
    }
}
