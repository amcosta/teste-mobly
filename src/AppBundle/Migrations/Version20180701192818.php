<?php

namespace AppBundle\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180701192818 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE sale (id INT AUTO_INCREMENT NOT NULL, delivery_address_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, status_id INT DEFAULT NULL, shipping NUMERIC(10, 2) NOT NULL, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, INDEX IDX_E54BC005EBF23851 (delivery_address_id), INDEX IDX_E54BC0059395C3F3 (customer_id), INDEX IDX_E54BC0056BF700BD (status_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sale_item (id INT AUTO_INCREMENT NOT NULL, sale_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, price NUMERIC(10, 2) NOT NULL, quantity INT NOT NULL, INDEX IDX_A35551FB4A7E4868 (sale_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sale_status (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE sale ADD CONSTRAINT FK_E54BC005EBF23851 FOREIGN KEY (delivery_address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE sale ADD CONSTRAINT FK_E54BC0059395C3F3 FOREIGN KEY (customer_id) REFERENCES customer (id)');
        $this->addSql('ALTER TABLE sale ADD CONSTRAINT FK_E54BC0056BF700BD FOREIGN KEY (status_id) REFERENCES sale_status (id)');
        $this->addSql('ALTER TABLE sale_item ADD CONSTRAINT FK_A35551FB4A7E4868 FOREIGN KEY (sale_id) REFERENCES sale (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE sale_item DROP FOREIGN KEY FK_A35551FB4A7E4868');
        $this->addSql('ALTER TABLE sale DROP FOREIGN KEY FK_E54BC0056BF700BD');
        $this->addSql('DROP TABLE sale');
        $this->addSql('DROP TABLE sale_item');
        $this->addSql('DROP TABLE sale_status');
    }
}
