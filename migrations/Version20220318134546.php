<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220318134546 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_CBE5A33160BB6FE6');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, auteur_id, name, pages, price, description, image FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, auteur_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, pages INTEGER NOT NULL, price DOUBLE PRECISION NOT NULL, description CLOB NOT NULL, image VARCHAR(255) NOT NULL, CONSTRAINT FK_CBE5A33160BB6FE6 FOREIGN KEY (auteur_id) REFERENCES auteur (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO book (id, auteur_id, name, pages, price, description, image) SELECT id, auteur_id, name, pages, price, description, image FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
        $this->addSql('CREATE INDEX IDX_CBE5A33160BB6FE6 ON book (auteur_id)');
        $this->addSql('DROP INDEX IDX_5BD3C07216A2B381');
        $this->addSql('DROP INDEX IDX_5BD3C072BCF5E72D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book_categorie AS SELECT book_id, categorie_id FROM book_categorie');
        $this->addSql('DROP TABLE book_categorie');
        $this->addSql('CREATE TABLE book_categorie (book_id INTEGER NOT NULL, categorie_id INTEGER NOT NULL, PRIMARY KEY(book_id, categorie_id), CONSTRAINT FK_5BD3C07216A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5BD3C072BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO book_categorie (book_id, categorie_id) SELECT book_id, categorie_id FROM __temp__book_categorie');
        $this->addSql('DROP TABLE __temp__book_categorie');
        $this->addSql('CREATE INDEX IDX_5BD3C07216A2B381 ON book_categorie (book_id)');
        $this->addSql('CREATE INDEX IDX_5BD3C072BCF5E72D ON book_categorie (categorie_id)');
        $this->addSql('DROP INDEX IDX_24CC0DF2F347EFB');
        $this->addSql('CREATE TEMPORARY TABLE __temp__panier AS SELECT id, produit_id, quantite, acheter FROM panier');
        $this->addSql('DROP TABLE panier');
        $this->addSql('CREATE TABLE panier (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, produit_id INTEGER DEFAULT NULL, user_id INTEGER DEFAULT NULL, quantite INTEGER NOT NULL, acheter BOOLEAN NOT NULL, CONSTRAINT FK_24CC0DF2F347EFB FOREIGN KEY (produit_id) REFERENCES book (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_24CC0DF2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO panier (id, produit_id, quantite, acheter) SELECT id, produit_id, quantite, acheter FROM __temp__panier');
        $this->addSql('DROP TABLE __temp__panier');
        $this->addSql('CREATE INDEX IDX_24CC0DF2F347EFB ON panier (produit_id)');
        $this->addSql('CREATE INDEX IDX_24CC0DF2A76ED395 ON panier (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_CBE5A33160BB6FE6');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book AS SELECT id, auteur_id, name, pages, price, description, image FROM book');
        $this->addSql('DROP TABLE book');
        $this->addSql('CREATE TABLE book (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, auteur_id INTEGER NOT NULL, name VARCHAR(255) NOT NULL, pages INTEGER NOT NULL, price DOUBLE PRECISION NOT NULL, description CLOB NOT NULL, image VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO book (id, auteur_id, name, pages, price, description, image) SELECT id, auteur_id, name, pages, price, description, image FROM __temp__book');
        $this->addSql('DROP TABLE __temp__book');
        $this->addSql('CREATE INDEX IDX_CBE5A33160BB6FE6 ON book (auteur_id)');
        $this->addSql('DROP INDEX IDX_5BD3C07216A2B381');
        $this->addSql('DROP INDEX IDX_5BD3C072BCF5E72D');
        $this->addSql('CREATE TEMPORARY TABLE __temp__book_categorie AS SELECT book_id, categorie_id FROM book_categorie');
        $this->addSql('DROP TABLE book_categorie');
        $this->addSql('CREATE TABLE book_categorie (book_id INTEGER NOT NULL, categorie_id INTEGER NOT NULL, PRIMARY KEY(book_id, categorie_id))');
        $this->addSql('INSERT INTO book_categorie (book_id, categorie_id) SELECT book_id, categorie_id FROM __temp__book_categorie');
        $this->addSql('DROP TABLE __temp__book_categorie');
        $this->addSql('CREATE INDEX IDX_5BD3C07216A2B381 ON book_categorie (book_id)');
        $this->addSql('CREATE INDEX IDX_5BD3C072BCF5E72D ON book_categorie (categorie_id)');
        $this->addSql('DROP INDEX IDX_24CC0DF2F347EFB');
        $this->addSql('DROP INDEX IDX_24CC0DF2A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__panier AS SELECT id, produit_id, quantite, acheter FROM panier');
        $this->addSql('DROP TABLE panier');
        $this->addSql('CREATE TABLE panier (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, produit_id INTEGER DEFAULT NULL, quantite INTEGER NOT NULL, acheter BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO panier (id, produit_id, quantite, acheter) SELECT id, produit_id, quantite, acheter FROM __temp__panier');
        $this->addSql('DROP TABLE __temp__panier');
        $this->addSql('CREATE INDEX IDX_24CC0DF2F347EFB ON panier (produit_id)');
    }
}
