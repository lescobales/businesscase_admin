<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230701182102 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, ligne1 VARCHAR(255) NOT NULL, ligne2 VARCHAR(255) DEFAULT NULL, ligne3 VARCHAR(255) DEFAULT NULL, post_code VARCHAR(10) NOT NULL, town VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, representation VARCHAR(255) NOT NULL, INDEX IDX_64C19C112469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course_eth (id INT AUTO_INCREMENT NOT NULL, course_eur DOUBLE PRECISION NOT NULL, date_course DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, nft_id INT DEFAULT NULL, designation VARCHAR(255) NOT NULL, INDEX IDX_1F1B251EE813668D (nft_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nft (id INT AUTO_INCREMENT NOT NULL, type_nft_id INT DEFAULT NULL, category_id INT DEFAULT NULL, user_id INT DEFAULT NULL, token VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, representation VARCHAR(255) NOT NULL, initial_price DOUBLE PRECISION NOT NULL, quantity INT DEFAULT NULL, INDEX IDX_D9C7463CCBC40DB5 (type_nft_id), INDEX IDX_D9C7463C12469DE2 (category_id), INDEX IDX_D9C7463CA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pre_order (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, is_purchase TINYINT(1) NOT NULL, amount DOUBLE PRECISION NOT NULL, date_pre_order DATETIME NOT NULL, date_purchase DATETIME NOT NULL, INDEX IDX_EF82FC73A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pre_order_item (pre_order_id INT NOT NULL, item_id INT NOT NULL, INDEX IDX_BAB46C88B495F6B (pre_order_id), INDEX IDX_BAB46C8126F525E (item_id), PRIMARY KEY(pre_order_id, item_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_nft (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE value (id INT AUTO_INCREMENT NOT NULL, nft_id INT DEFAULT NULL, amount DOUBLE PRECISION NOT NULL, date_value DATETIME NOT NULL, INDEX IDX_1D775834E813668D (nft_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visit (id INT AUTO_INCREMENT NOT NULL, nft_id INT DEFAULT NULL, user_id INT DEFAULT NULL, date_visit DATETIME NOT NULL, INDEX IDX_437EE939E813668D (nft_id), INDEX IDX_437EE939A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C112469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EE813668D FOREIGN KEY (nft_id) REFERENCES nft (id)');
        $this->addSql('ALTER TABLE nft ADD CONSTRAINT FK_D9C7463CCBC40DB5 FOREIGN KEY (type_nft_id) REFERENCES type_nft (id)');
        $this->addSql('ALTER TABLE nft ADD CONSTRAINT FK_D9C7463C12469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE nft ADD CONSTRAINT FK_D9C7463CA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pre_order ADD CONSTRAINT FK_EF82FC73A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE pre_order_item ADD CONSTRAINT FK_BAB46C88B495F6B FOREIGN KEY (pre_order_id) REFERENCES pre_order (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pre_order_item ADD CONSTRAINT FK_BAB46C8126F525E FOREIGN KEY (item_id) REFERENCES item (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE value ADD CONSTRAINT FK_1D775834E813668D FOREIGN KEY (nft_id) REFERENCES nft (id)');
        $this->addSql('ALTER TABLE visit ADD CONSTRAINT FK_437EE939E813668D FOREIGN KEY (nft_id) REFERENCES nft (id)');
        $this->addSql('ALTER TABLE visit ADD CONSTRAINT FK_437EE939A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C112469DE2');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EE813668D');
        $this->addSql('ALTER TABLE nft DROP FOREIGN KEY FK_D9C7463CCBC40DB5');
        $this->addSql('ALTER TABLE nft DROP FOREIGN KEY FK_D9C7463C12469DE2');
        $this->addSql('ALTER TABLE nft DROP FOREIGN KEY FK_D9C7463CA76ED395');
        $this->addSql('ALTER TABLE pre_order DROP FOREIGN KEY FK_EF82FC73A76ED395');
        $this->addSql('ALTER TABLE pre_order_item DROP FOREIGN KEY FK_BAB46C88B495F6B');
        $this->addSql('ALTER TABLE pre_order_item DROP FOREIGN KEY FK_BAB46C8126F525E');
        $this->addSql('ALTER TABLE value DROP FOREIGN KEY FK_1D775834E813668D');
        $this->addSql('ALTER TABLE visit DROP FOREIGN KEY FK_437EE939E813668D');
        $this->addSql('ALTER TABLE visit DROP FOREIGN KEY FK_437EE939A76ED395');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE course_eth');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE nft');
        $this->addSql('DROP TABLE pre_order');
        $this->addSql('DROP TABLE pre_order_item');
        $this->addSql('DROP TABLE type_nft');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE value');
        $this->addSql('DROP TABLE visit');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
