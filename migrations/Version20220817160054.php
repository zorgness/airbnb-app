<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220817160054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE product_image_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE product_image (id INT NOT NULL, flat_id INT DEFAULT NULL, image_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_64617F03D3331C94 ON product_image (flat_id)');
        $this->addSql('ALTER TABLE product_image ADD CONSTRAINT FK_64617F03D3331C94 FOREIGN KEY (flat_id) REFERENCES flat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE product_image_id_seq CASCADE');
        $this->addSql('ALTER TABLE product_image DROP CONSTRAINT FK_64617F03D3331C94');
        $this->addSql('DROP TABLE product_image');
    }
}
