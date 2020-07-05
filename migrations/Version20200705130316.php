<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200705130316 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category_realty (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, activity VARCHAR(255) NOT NULL, siret VARCHAR(255) NOT NULL, phone VARCHAR(60) NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, approved_at DATETIME NOT NULL, address VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, zip VARCHAR(10) NOT NULL, is_professional TINYINT(1) NOT NULL, is_enabled TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_4FBF094F7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE currency (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, iso VARCHAR(10) NOT NULL, icon VARCHAR(10) NOT NULL, flag VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE document (id INT AUTO_INCREMENT NOT NULL, property_id INT DEFAULT NULL, type VARCHAR(30) NOT NULL, file_name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, is_approved TINYINT(1) NOT NULL, INDEX IDX_D8698A76549213EC (property_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE furniture (id INT AUTO_INCREMENT NOT NULL, realty_id INT DEFAULT NULL, type_id INT DEFAULT NULL, quantity INT NOT NULL, price DOUBLE PRECISION NOT NULL, is_enabled TINYINT(1) NOT NULL, INDEX IDX_665DDAB371C56C69 (realty_id), INDEX IDX_665DDAB3C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, realty_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, file_name VARCHAR(255) NOT NULL, url VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_6A2CA10C71C56C69 (realty_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, reservation_id INT DEFAULT NULL, reference VARCHAR(255) NOT NULL, amount DOUBLE PRECISION NOT NULL, mode VARCHAR(255) NOT NULL, payed_at DATETIME NOT NULL, transaction LONGTEXT NOT NULL, INDEX IDX_6D28840DB83297E7 (reservation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE piece (id INT AUTO_INCREMENT NOT NULL, realty_id INT DEFAULT NULL, type_id INT DEFAULT NULL, area DOUBLE PRECISION NOT NULL, quantity INT NOT NULL, INDEX IDX_44CA0B2371C56C69 (realty_id), INDEX IDX_44CA0B23C54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE property (id INT AUTO_INCREMENT NOT NULL, company_id INT DEFAULT NULL, type_id INT DEFAULT NULL, services_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, reference VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, zip VARCHAR(20) NOT NULL, lat DOUBLE PRECISION NOT NULL, lon DOUBLE PRECISION NOT NULL, image VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, build_at DATETIME NOT NULL, is_sponsored TINYINT(1) NOT NULL, is_approved TINYINT(1) NOT NULL, is_enabled TINYINT(1) NOT NULL, INDEX IDX_8BF21CDE979B1AD6 (company_id), INDEX IDX_8BF21CDEC54C8C93 (type_id), INDEX IDX_8BF21CDEAEF5A6C1 (services_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rate (id INT AUTO_INCREMENT NOT NULL, currency_from_id INT DEFAULT NULL, currency_to_id INT DEFAULT NULL, rate_value DOUBLE PRECISION NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_DFEC3F39A56723E4 (currency_from_id), INDEX IDX_DFEC3F3967D74803 (currency_to_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE realty (id INT AUTO_INCREMENT NOT NULL, property_id INT DEFAULT NULL, category_id INT DEFAULT NULL, type_id INT DEFAULT NULL, cadence_payment_id INT DEFAULT NULL, airing_id INT DEFAULT NULL, reference VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, floor VARCHAR(20) NOT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, quantity INT NOT NULL, surface DOUBLE PRECISION NOT NULL, is_available TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_627221C549213EC (property_id), INDEX IDX_627221C12469DE2 (category_id), INDEX IDX_627221CC54C8C93 (type_id), INDEX IDX_627221C4A5DE954 (cadence_payment_id), INDEX IDX_627221C2F4ABFFD (airing_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, realty_id INT DEFAULT NULL, reference VARCHAR(255) NOT NULL, baby INT NOT NULL, child INT NOT NULL, adult INT NOT NULL, arrived_at DATETIME NOT NULL, leaved_at DATETIME NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_42C849559395C3F3 (customer_id), INDEX IDX_42C8495571C56C69 (realty_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE statut (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, reservation_id INT DEFAULT NULL, type_id INT DEFAULT NULL, added_at DATETIME NOT NULL, comment VARCHAR(255) NOT NULL, INDEX IDX_E564F0BFA76ED395 (user_id), INDEX IDX_E564F0BFB83297E7 (reservation_id), INDEX IDX_E564F0BFC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_airing (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_cadence (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_furniture (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, icon VARCHAR(30) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_piece (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, icon VARCHAR(30) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_property (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_realty (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_statut (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, label_color VARCHAR(255) NOT NULL, icon VARCHAR(30) NOT NULL, step INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, gender VARCHAR(1) NOT NULL, phone VARCHAR(60) NOT NULL, birthday DATE NOT NULL, create_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, address VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, zip VARCHAR(10) NOT NULL, login VARCHAR(255) DEFAULT NULL, is_enabled TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F7E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE document ADD CONSTRAINT FK_D8698A76549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE furniture ADD CONSTRAINT FK_665DDAB371C56C69 FOREIGN KEY (realty_id) REFERENCES realty (id)');
        $this->addSql('ALTER TABLE furniture ADD CONSTRAINT FK_665DDAB3C54C8C93 FOREIGN KEY (type_id) REFERENCES type_furniture (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10C71C56C69 FOREIGN KEY (realty_id) REFERENCES realty (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840DB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE piece ADD CONSTRAINT FK_44CA0B2371C56C69 FOREIGN KEY (realty_id) REFERENCES realty (id)');
        $this->addSql('ALTER TABLE piece ADD CONSTRAINT FK_44CA0B23C54C8C93 FOREIGN KEY (type_id) REFERENCES type_piece (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDE979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEC54C8C93 FOREIGN KEY (type_id) REFERENCES type_property (id)');
        $this->addSql('ALTER TABLE property ADD CONSTRAINT FK_8BF21CDEAEF5A6C1 FOREIGN KEY (services_id) REFERENCES service (id)');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F39A56723E4 FOREIGN KEY (currency_from_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE rate ADD CONSTRAINT FK_DFEC3F3967D74803 FOREIGN KEY (currency_to_id) REFERENCES currency (id)');
        $this->addSql('ALTER TABLE realty ADD CONSTRAINT FK_627221C549213EC FOREIGN KEY (property_id) REFERENCES property (id)');
        $this->addSql('ALTER TABLE realty ADD CONSTRAINT FK_627221C12469DE2 FOREIGN KEY (category_id) REFERENCES category_realty (id)');
        $this->addSql('ALTER TABLE realty ADD CONSTRAINT FK_627221CC54C8C93 FOREIGN KEY (type_id) REFERENCES type_realty (id)');
        $this->addSql('ALTER TABLE realty ADD CONSTRAINT FK_627221C4A5DE954 FOREIGN KEY (cadence_payment_id) REFERENCES type_cadence (id)');
        $this->addSql('ALTER TABLE realty ADD CONSTRAINT FK_627221C2F4ABFFD FOREIGN KEY (airing_id) REFERENCES type_airing (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C849559395C3F3 FOREIGN KEY (customer_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495571C56C69 FOREIGN KEY (realty_id) REFERENCES realty (id)');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BFA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BFB83297E7 FOREIGN KEY (reservation_id) REFERENCES reservation (id)');
        $this->addSql('ALTER TABLE statut ADD CONSTRAINT FK_E564F0BFC54C8C93 FOREIGN KEY (type_id) REFERENCES type_statut (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE realty DROP FOREIGN KEY FK_627221C12469DE2');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDE979B1AD6');
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F39A56723E4');
        $this->addSql('ALTER TABLE rate DROP FOREIGN KEY FK_DFEC3F3967D74803');
        $this->addSql('ALTER TABLE document DROP FOREIGN KEY FK_D8698A76549213EC');
        $this->addSql('ALTER TABLE realty DROP FOREIGN KEY FK_627221C549213EC');
        $this->addSql('ALTER TABLE furniture DROP FOREIGN KEY FK_665DDAB371C56C69');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10C71C56C69');
        $this->addSql('ALTER TABLE piece DROP FOREIGN KEY FK_44CA0B2371C56C69');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495571C56C69');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840DB83297E7');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BFB83297E7');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEAEF5A6C1');
        $this->addSql('ALTER TABLE realty DROP FOREIGN KEY FK_627221C2F4ABFFD');
        $this->addSql('ALTER TABLE realty DROP FOREIGN KEY FK_627221C4A5DE954');
        $this->addSql('ALTER TABLE furniture DROP FOREIGN KEY FK_665DDAB3C54C8C93');
        $this->addSql('ALTER TABLE piece DROP FOREIGN KEY FK_44CA0B23C54C8C93');
        $this->addSql('ALTER TABLE property DROP FOREIGN KEY FK_8BF21CDEC54C8C93');
        $this->addSql('ALTER TABLE realty DROP FOREIGN KEY FK_627221CC54C8C93');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BFC54C8C93');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F7E3C61F9');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C849559395C3F3');
        $this->addSql('ALTER TABLE statut DROP FOREIGN KEY FK_E564F0BFA76ED395');
        $this->addSql('DROP TABLE category_realty');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE currency');
        $this->addSql('DROP TABLE document');
        $this->addSql('DROP TABLE furniture');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE piece');
        $this->addSql('DROP TABLE property');
        $this->addSql('DROP TABLE rate');
        $this->addSql('DROP TABLE realty');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE statut');
        $this->addSql('DROP TABLE type_airing');
        $this->addSql('DROP TABLE type_cadence');
        $this->addSql('DROP TABLE type_furniture');
        $this->addSql('DROP TABLE type_piece');
        $this->addSql('DROP TABLE type_property');
        $this->addSql('DROP TABLE type_realty');
        $this->addSql('DROP TABLE type_statut');
        $this->addSql('DROP TABLE user');
    }
}
