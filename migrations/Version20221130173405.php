<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130173405 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE userlist ADD todo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE userlist DROP todolist');
        $this->addSql('ALTER TABLE userlist DROP created_at');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE userlist ADD todolist TEXT NOT NULL');
        $this->addSql('ALTER TABLE userlist ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE userlist DROP todo');
        $this->addSql('COMMENT ON COLUMN userlist.todolist IS \'(DC2Type:array)\'');
    }
}
