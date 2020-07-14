<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200713225711 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BFC54C8C93');
        $this->addSql('CREATE TABLE status (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, reservation_id INT DEFAULT NULL, type_id INT DEFAULT NULL, added_at DATETIME NOT NULL, comment VARCHAR(255) NOT NULL, INDEX IDX_7B00651CA76ED395 (user_id), INDEX IDX_7B00651CB83297E7 (reservation_id), INDEX IDX_7B00651CC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_document (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_status (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, label_color VARCHAR(255) NOT NULL, icon VARCHAR(30) NOT NULL, step INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE status ADD CONSTRAINT FK_7B00651CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE status ADD CONSTRAINT FK_7B00651CB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE status ADD CONSTRAINT FK_7B00651CC54C8C93 FOREIGN KEY (type_id) REFERENCES type_status (id)');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE type_statut');
        $this->addSql('ALTER TABLE document ADD category_id INT DEFAULT NULL, DROP type, DROP description');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A7612469DE2 FOREIGN KEY (category_id) REFERENCES type_document (id)');
        $this->addSql('CREATE INDEX IDX_D8698A7612469DE2 ON document (category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A7612469DE2');
        $this->addSql('ALTER TABLE status DROP FOREIGN KEY FK_7B00651CC54C8C93');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, reservation_id INT DEFAULT NULL, type_id INT DEFAULT NULL, added_at DATETIME NOT NULL, comment VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_E564F0BFC54C8C93 (type_id), INDEX IDX_E564F0BFA76ED395 (user_id), INDEX IDX_E564F0BFB83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type_statut (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, label_color VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, icon VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, step INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BFB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BFC54C8C93 FOREIGN KEY (type_id) REFERENCES type_statut (id)');
        $this->addSql('DROP TABLE status');
        $this->addSql('DROP TABLE type_document');
        $this->addSql('DROP TABLE type_status');
        $this->addSql('DROP INDEX IDX_D8698A7612469DE2 ON document');
        $this->addSql('ALTER TABLE document ADD type VARCHAR(30) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP category_id');
    }
}
