<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210722095935 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE genre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE genre (id INT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, title VARCHAR(255) NOT NULL, country VARCHAR(3) NOT NULL, year VARCHAR(4) NOT NULL, original_title VARCHAR(250) DEFAULT NULL, description TEXT DEFAULT NULL, ranking SMALLINT NOT NULL, price NUMERIC(7, 2) NOT NULL, product_type VARCHAR(255) CHECK(product_type IN (\'book\', \'ebook\', \'audio-book\')) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN product.product_type IS \'(DC2Type:product_type_enum)\'');
        $this->addSql('CREATE TABLE product_genre (product_id INT NOT NULL, genre_id INT NOT NULL, PRIMARY KEY(product_id, genre_id))');
        $this->addSql('CREATE INDEX IDX_220C48A44584665A ON product_genre (product_id)');
        $this->addSql('CREATE INDEX IDX_220C48A44296D31F ON product_genre (genre_id)');
        $this->addSql('ALTER TABLE product_genre ADD CONSTRAINT FK_220C48A44584665A FOREIGN KEY (product_id) REFERENCES product (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE product_genre ADD CONSTRAINT FK_220C48A44296D31F FOREIGN KEY (genre_id) REFERENCES genre (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE product_genre DROP CONSTRAINT FK_220C48A44296D31F');
        $this->addSql('ALTER TABLE product_genre DROP CONSTRAINT FK_220C48A44584665A');
        $this->addSql('DROP SEQUENCE genre_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP TABLE genre');
        $this->addSql('DROP TABLE product');
        $this->addSql('DROP TABLE product_genre');
    }
}
