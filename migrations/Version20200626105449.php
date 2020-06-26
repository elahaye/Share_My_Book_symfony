<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200626105449 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE book (id INT AUTO_INCREMENT NOT NULL, reference_api VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, author VARCHAR(255) NOT NULL, summary LONGTEXT NOT NULL, publication_date DATE NOT NULL, total_pages INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booklist (id INT AUTO_INCREMENT NOT NULL, creator_id_id INT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_F8DE9874F05788E9 (creator_id_id), INDEX IDX_F8DE987412469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE booklist_book (booklist_id INT NOT NULL, book_id INT NOT NULL, INDEX IDX_B9142FE1ED4AFA85 (booklist_id), INDEX IDX_B9142FE116A2B381 (book_id), PRIMARY KEY(booklist_id, book_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booklist ADD CONSTRAINT FK_F8DE9874F05788E9 FOREIGN KEY (creator_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE booklist ADD CONSTRAINT FK_F8DE987412469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE booklist_book ADD CONSTRAINT FK_B9142FE1ED4AFA85 FOREIGN KEY (booklist_id) REFERENCES booklist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booklist_book ADD CONSTRAINT FK_B9142FE116A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booklist_book DROP FOREIGN KEY FK_B9142FE116A2B381');
        $this->addSql('ALTER TABLE booklist_book DROP FOREIGN KEY FK_B9142FE1ED4AFA85');
        $this->addSql('ALTER TABLE booklist DROP FOREIGN KEY FK_F8DE987412469DE2');
        $this->addSql('DROP TABLE book');
        $this->addSql('DROP TABLE booklist');
        $this->addSql('DROP TABLE booklist_book');
        $this->addSql('DROP TABLE category');
    }
}
