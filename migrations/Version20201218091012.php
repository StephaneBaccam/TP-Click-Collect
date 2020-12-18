<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201218091012 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, quantite INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock_magasin (stock_id INT NOT NULL, magasin_id INT NOT NULL, INDEX IDX_4D094F84DCD6110 (stock_id), INDEX IDX_4D094F8420096AE3 (magasin_id), PRIMARY KEY(stock_id, magasin_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE stock_magasin ADD CONSTRAINT FK_4D094F84DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE stock_magasin ADD CONSTRAINT FK_4D094F8420096AE3 FOREIGN KEY (magasin_id) REFERENCES magasin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE article ADD stock_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66DCD6110 ON article (stock_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66DCD6110');
        $this->addSql('ALTER TABLE stock_magasin DROP FOREIGN KEY FK_4D094F84DCD6110');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE stock_magasin');
        $this->addSql('DROP INDEX IDX_23A0E66DCD6110 ON article');
        $this->addSql('ALTER TABLE article DROP stock_id');
    }
}
