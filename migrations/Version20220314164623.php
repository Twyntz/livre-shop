<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220314164623 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book_categorie (book_id INTEGER DEFAULT NULL, categorie_id INTEGER DEFAULT NULL, PRIMARY KEY(book_id, categorie_id))');
        $this->addSql('CREATE INDEX IDX_5BD3C07216A2B381 ON book_categorie (book_id)');
        $this->addSql('CREATE INDEX IDX_5BD3C072BCF5E72D ON book_categorie (categorie_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, name, pages, price, description, image FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, auteur_id INTEGER DEFAULT NULL, name VARCHAR(255) NOT NULL, pages INTEGER NOT NULL, price DOUBLE PRECISION NOT NULL, description CLOB NOT NULL, image VARCHAR(255) NOT NULL, CONSTRAINT FK_CBE5A33160BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO book (id, name, pages, price, description, image) SELECT id, name, pages, price, description, image FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
        $this->addSql('CREATE INDEX IDX_CBE5A33160BB6FE6 ON book (auteur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE book_categorie');
        $this->addSql('DROP INDEX IDX_CBE5A33160BB6FE6');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, name, pages, price, description, image FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, pages INTEGER NOT NULL, price DOUBLE PRECISION NOT NULL, description CLOB NOT NULL, image VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO book (id, name, pages, price, description, image) SELECT id, name, pages, price, description, image FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
    }
}
