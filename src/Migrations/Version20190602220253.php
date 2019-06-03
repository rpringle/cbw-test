<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190602220253 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE phone_numbers (id INT AUTO_INCREMENT NOT NULL, contact_id INT DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, country_code VARCHAR(255) DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, active INT DEFAULT NULL, primary_contact INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('DROP TABLE phoneNumbers');
        $this->addSql('ALTER TABLE accounts CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE active active INT NOT NULL');
        $this->addSql('ALTER TABLE contacts ADD first_name VARCHAR(255) DEFAULT NULL, ADD last_name VARCHAR(255) DEFAULT NULL, ADD account_owner INT DEFAULT NULL, DROP firstName, DROP lastName, DROP accountOwner, CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE address1 address1 VARCHAR(255) DEFAULT NULL, CHANGE address2 address2 VARCHAR(255) DEFAULT NULL, CHANGE city city VARCHAR(255) DEFAULT NULL, CHANGE state state VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE active active INT DEFAULT NULL, CHANGE accountid account_id INT DEFAULT NULL, CHANGE postalcode postal_code VARCHAR(5) DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE phoneNumbers (id INT UNSIGNED AUTO_INCREMENT NOT NULL, contactId INT DEFAULT NULL, phoneNumber VARCHAR(256) DEFAULT NULL COLLATE utf8_general_ci, countryCode VARCHAR(256) DEFAULT NULL COLLATE utf8_general_ci, type VARCHAR(256) DEFAULT NULL COLLATE utf8_general_ci, active TINYINT(1) DEFAULT NULL, primaryContact TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE phone_numbers');
        $this->addSql('ALTER TABLE accounts CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE active active TINYINT(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE contacts ADD accountId INT DEFAULT NULL, ADD firstName VARCHAR(256) DEFAULT NULL COLLATE utf8_general_ci, ADD lastName VARCHAR(256) DEFAULT NULL COLLATE utf8_general_ci, ADD accountOwner TINYINT(1) DEFAULT NULL, DROP account_id, DROP first_name, DROP last_name, DROP account_owner, CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE address1 address1 VARCHAR(256) DEFAULT \'\' COLLATE utf8_general_ci, CHANGE address2 address2 VARCHAR(256) DEFAULT NULL COLLATE utf8_general_ci, CHANGE city city VARCHAR(256) DEFAULT NULL COLLATE utf8_general_ci, CHANGE state state VARCHAR(2) DEFAULT NULL COLLATE utf8_general_ci, CHANGE email email VARCHAR(256) DEFAULT NULL COLLATE utf8_general_ci, CHANGE active active TINYINT(1) DEFAULT NULL, CHANGE postal_code postalCode VARCHAR(5) DEFAULT NULL COLLATE utf8_general_ci');
    }
}
