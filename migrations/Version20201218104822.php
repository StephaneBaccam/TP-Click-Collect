<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201218104822 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66DCD6110');
        $this->addSql('DROP INDEX IDX_23A0E66DCD6110 ON article');
        $this->addSql('ALTER TABLE article CHANGE stock_id stocks_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66FACB6020 FOREIGN KEY (stocks_id) REFERENCES stock (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66FACB6020 ON article (stocks_id)');
        $this->addSql('ALTER TABLE stock ADD magasins_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660DE52078D FOREIGN KEY (magasins_id) REFERENCES magasin (id)');
        $this->addSql('CREATE INDEX IDX_4B365660DE52078D ON stock (magasins_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66FACB6020');
        $this->addSql('DROP INDEX IDX_23A0E66FACB6020 ON article');
        $this->addSql('ALTER TABLE article CHANGE stocks_id stock_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66DCD6110 FOREIGN KEY (stock_id) REFERENCES stock (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66DCD6110 ON article (stock_id)');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660DE52078D');
        $this->addSql('DROP INDEX IDX_4B365660DE52078D ON stock');
        $this->addSql('ALTER TABLE stock DROP magasins_id');
    }
}
