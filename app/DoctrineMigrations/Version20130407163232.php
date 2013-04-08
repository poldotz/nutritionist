<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration,
    Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20130407163232 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE Category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(250) NOT NULL, UNIQUE INDEX UNIQ_FF3A7B975E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE FoodNutrient (id INT AUTO_INCREMENT NOT NULL, food_id INT DEFAULT NULL, nutrient_id INT DEFAULT NULL, food_nutrient NUMERIC(2, 2) NOT NULL, INDEX IDX_7306A8B1BA8E87C4 (food_id), INDEX IDX_7306A8B127373320 (nutrient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Nutrient (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_50E04E0C5E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE Food (id INT AUTO_INCREMENT NOT NULL, category_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_740A86C95E237E06 (name), INDEX IDX_740A86C912469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE FoodNutrient ADD CONSTRAINT FK_7306A8B1BA8E87C4 FOREIGN KEY (food_id) REFERENCES Food (id)");
        $this->addSql("ALTER TABLE FoodNutrient ADD CONSTRAINT FK_7306A8B127373320 FOREIGN KEY (nutrient_id) REFERENCES Nutrient (id)");
        $this->addSql("ALTER TABLE Food ADD CONSTRAINT FK_740A86C912469DE2 FOREIGN KEY (category_id) REFERENCES Category (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE Food DROP FOREIGN KEY FK_740A86C912469DE2");
        $this->addSql("ALTER TABLE FoodNutrient DROP FOREIGN KEY FK_7306A8B127373320");
        $this->addSql("ALTER TABLE FoodNutrient DROP FOREIGN KEY FK_7306A8B1BA8E87C4");
        $this->addSql("DROP TABLE Category");
        $this->addSql("DROP TABLE FoodNutrient");
        $this->addSql("DROP TABLE Nutrient");
        $this->addSql("DROP TABLE Food");
    }
}
