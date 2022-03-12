<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220312151224 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE panier (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL)');
        $this->addSql('ALTER TABLE book ADD COLUMN description CLOB NOT NULL');
        $this->addSql('ALTER TABLE book ADD COLUMN image VARCHAR(255) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_8D93D64986CC499D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, pseudo, roles, password FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, panier_id INTEGER NOT NULL, pseudo VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL, CONSTRAINT FK_8D93D649F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user (id, pseudo, roles, password) SELECT id, pseudo, roles, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64986CC499D ON user (pseudo)');
        $this->addSql('CREATE INDEX IDX_8D93D649F77D927C ON user (panier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE panier');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, name, pages, price FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, pages INTEGER NOT NULL, price DOUBLE PRECISION NOT NULL)');
        $this->addSql('INSERT INTO book (id, name, pages, price) SELECT id, name, pages, price FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
        $this->addSql('DROP INDEX UNIQ_8D93D64986CC499D');
        $this->addSql('DROP INDEX IDX_8D93D649F77D927C');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user AS SELECT id, pseudo, roles, password FROM user');
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, pseudo VARCHAR(180) NOT NULL, roles CLOB NOT NULL --(DC2Type:json)
        , password VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO user (id, pseudo, roles, password) SELECT id, pseudo, roles, password FROM __temp__user');
        $this->addSql('DROP TABLE __temp__user');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64986CC499D ON user (pseudo)');
    }
}
