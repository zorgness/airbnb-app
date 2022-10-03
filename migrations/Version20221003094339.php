<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221003094339 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE account_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE booking_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE flat_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_image_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE account (id INT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT \'images.png\', PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D3656A4E7927C74 ON account (email)');
        $this->addSql('CREATE TABLE booking (id INT NOT NULL, flat_id INT DEFAULT NULL, user_account_id INT DEFAULT NULL, number_people INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, accepted BOOLEAN DEFAULT false NOT NULL, rejected BOOLEAN DEFAULT false NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E00CEDDED3331C94 ON booking (flat_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE3C0C9956 ON booking (user_account_id)');
        $this->addSql('CREATE TABLE flat (id INT NOT NULL, owner_id INT DEFAULT NULL, address VARCHAR(255) NOT NULL, price_per_day INT NOT NULL, description VARCHAR(255) DEFAULT NULL, people INT NOT NULL, bathroom INT NOT NULL, room INT NOT NULL, bed INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_554AAA447E3C61F9 ON flat (owner_id)');
        $this->addSql('CREATE TABLE product_image (id INT NOT NULL, flat_id INT DEFAULT NULL, image_name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_64617F03D3331C94 ON product_image (flat_id)');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDED3331C94 FOREIGN KEY (flat_id) REFERENCES flat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDE3C0C9956 FOREIGN KEY (user_account_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE flat ADD CONSTRAINT FK_554AAA447E3C61F9 FOREIGN KEY (owner_id) REFERENCES account (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_image ADD CONSTRAINT FK_64617F03D3331C94 FOREIGN KEY (flat_id) REFERENCES flat (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE account_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE booking_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE flat_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_image_id_seq CASCADE');
        $this->addSql('ALTER TABLE booking DROP CONSTRAINT FK_E00CEDDED3331C94');
        $this->addSql('ALTER TABLE booking DROP CONSTRAINT FK_E00CEDDE3C0C9956');
        $this->addSql('ALTER TABLE flat DROP CONSTRAINT FK_554AAA447E3C61F9');
        $this->addSql('ALTER TABLE product_image DROP CONSTRAINT FK_64617F03D3331C94');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE booking');
        $this->addSql('DROP TABLE flat');
        $this->addSql('DROP TABLE product_image');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
