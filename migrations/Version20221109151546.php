<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221109151546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE problem_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE problem (id INT NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE problem_problem (problem_source INT NOT NULL, problem_target INT NOT NULL, PRIMARY KEY(problem_source, problem_target))');
        $this->addSql('CREATE INDEX IDX_31C50CBB1E160D3C ON problem_problem (problem_source)');
        $this->addSql('CREATE INDEX IDX_31C50CBB7F35DB3 ON problem_problem (problem_target)');
        $this->addSql('ALTER TABLE problem_problem ADD CONSTRAINT FK_31C50CBB1E160D3C FOREIGN KEY (problem_source) REFERENCES problem (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE problem_problem ADD CONSTRAINT FK_31C50CBB7F35DB3 FOREIGN KEY (problem_target) REFERENCES problem (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE problem_id_seq CASCADE');
        $this->addSql('ALTER TABLE problem_problem DROP CONSTRAINT FK_31C50CBB1E160D3C');
        $this->addSql('ALTER TABLE problem_problem DROP CONSTRAINT FK_31C50CBB7F35DB3');
        $this->addSql('DROP TABLE problem');
        $this->addSql('DROP TABLE problem_problem');
    }
}
