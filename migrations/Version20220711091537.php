<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220711091537 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE app_cart (id INT AUTO_INCREMENT NOT NULL, customer_id INT DEFAULT NULL, date_time DATETIME NOT NULL, UNIQUE INDEX UNIQ_E8DAD179395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_customer (cart_id INT NOT NULL, customer_id INT NOT NULL, INDEX IDX_1FA6C1621AD5CDBF (cart_id), INDEX IDX_1FA6C1629395C3F3 (customer_id), PRIMARY KEY(cart_id, customer_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_customer (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(100) NOT NULL, phoneNumber VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE app_product (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(100) NOT NULL, title VARCHAR(100) NOT NULL, price VARCHAR(200) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE app_cart ADD CONSTRAINT FK_E8DAD179395C3F3 FOREIGN KEY (customer_id) REFERENCES app_customer (id)');
        $this->addSql('ALTER TABLE cart_customer ADD CONSTRAINT FK_1FA6C1621AD5CDBF FOREIGN KEY (cart_id) REFERENCES app_cart (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_customer ADD CONSTRAINT FK_1FA6C1629395C3F3 FOREIGN KEY (customer_id) REFERENCES app_customer (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_customer DROP FOREIGN KEY FK_1FA6C1621AD5CDBF');
        $this->addSql('ALTER TABLE app_cart DROP FOREIGN KEY FK_E8DAD179395C3F3');
        $this->addSql('ALTER TABLE cart_customer DROP FOREIGN KEY FK_1FA6C1629395C3F3');
        $this->addSql('DROP TABLE app_cart');
        $this->addSql('DROP TABLE cart_customer');
        $this->addSql('DROP TABLE app_customer');
        $this->addSql('DROP TABLE app_product');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
