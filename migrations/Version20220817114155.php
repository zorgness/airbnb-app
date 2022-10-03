<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220817114153 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE product_image_id_seq CASCADE');
        $this->addSql('ALTER TABLE product_image DROP CONSTRAINT fk_64617f03d3331c94');
        $this->addSql('DROP TABLE product_image');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE product_image_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE product_image (id INT NOT NULL, flat_id INT DEFAULT NULL, image_name VARCHAR(255) NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_64617f03d3331c94 ON product_image (flat_id)');
        $this->addSql('ALTER TABLE product_image ADD CONSTRAINT fk_64617f03d3331c94 FOREIGN KEY (flat_id) REFERENCES flat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }
}
