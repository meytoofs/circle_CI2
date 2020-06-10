<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200609081538 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, confirm_password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, idea_proposition_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, creation_date DATETIME NOT NULL, UNIQUE INDEX UNIQ_729F519B95D547BA (idea_proposition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note_history (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, idea_proposition_id INT DEFAULT NULL, score INT NOT NULL, INDEX IDX_A61CB4D1A76ED395 (user_id), INDEX IDX_A61CB4D195D547BA (idea_proposition_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE idea_proposition (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, total_score INT NOT NULL, date DATETIME NOT NULL, featured_image VARCHAR(255) NOT NULL, INDEX IDX_F97DBDD1A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, room_id INT DEFAULT NULL, content LONGTEXT NOT NULL, published DATETIME NOT NULL, INDEX IDX_B6BD307FA76ED395 (user_id), INDEX IDX_B6BD307F54177093 (room_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B95D547BA FOREIGN KEY (idea_proposition_id) REFERENCES idea_proposition (id)');
        $this->addSql('ALTER TABLE note_history ADD CONSTRAINT FK_A61CB4D1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE note_history ADD CONSTRAINT FK_A61CB4D195D547BA FOREIGN KEY (idea_proposition_id) REFERENCES idea_proposition (id)');
        $this->addSql('ALTER TABLE idea_proposition ADD CONSTRAINT FK_F97DBDD1A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F54177093 FOREIGN KEY (room_id) REFERENCES room (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE note_history DROP FOREIGN KEY FK_A61CB4D1A76ED395');
        $this->addSql('ALTER TABLE idea_proposition DROP FOREIGN KEY FK_F97DBDD1A76ED395');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307FA76ED395');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F54177093');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B95D547BA');
        $this->addSql('ALTER TABLE note_history DROP FOREIGN KEY FK_A61CB4D195D547BA');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE note_history');
        $this->addSql('DROP TABLE idea_proposition');
        $this->addSql('DROP TABLE message');
    }
}
