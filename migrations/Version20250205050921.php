<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250205050921 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE breed (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, pet_type_id INTEGER NOT NULL, name VARCHAR(50) NOT NULL, is_dangerous_animal BOOLEAN NOT NULL, CONSTRAINT FK_F8AF884FDB020C75 FOREIGN KEY (pet_type_id) REFERENCES pet_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_F8AF884FDB020C75 ON breed (pet_type_id)');
        $this->addSql('CREATE TABLE pet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, pet_type_id INTEGER NOT NULL, breed_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, date_of_birth VARCHAR(255) NOT NULL, gender VARCHAR(10) NOT NULL, CONSTRAINT FK_E4529B85DB020C75 FOREIGN KEY (pet_type_id) REFERENCES pet_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_E4529B85A8B4A30F FOREIGN KEY (breed_id) REFERENCES breed (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_E4529B85DB020C75 ON pet (pet_type_id)');
        $this->addSql('CREATE INDEX IDX_E4529B85A8B4A30F ON pet (breed_id)');
        $this->addSql('CREATE TABLE pet_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(50) DEFAULT NULL)');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE breed');
        $this->addSql('DROP TABLE pet');
        $this->addSql('DROP TABLE pet_type');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
