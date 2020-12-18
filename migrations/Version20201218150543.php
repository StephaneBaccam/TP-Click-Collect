<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201218150543 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66DE52078D');
        $this->addSql('DROP INDEX IDX_23A0E66DE52078D ON article');
        $this->addSql('ALTER TABLE article DROP magasins_id');
        $this->addSql('ALTER TABLE stock DROP INDEX UNIQ_4B3656607294869C, ADD INDEX IDX_4B3656607294869C (article_id)');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660DE52078D');
        $this->addSql('DROP INDEX IDX_4B365660DE52078D ON stock');
        $this->addSql('ALTER TABLE stock CHANGE magasins_id magasin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B36566020096AE3 FOREIGN KEY (magasin_id) REFERENCES magasin (id)');
        $this->addSql('CREATE INDEX IDX_4B36566020096AE3 ON stock (magasin_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD magasins_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66DE52078D FOREIGN KEY (magasins_id) REFERENCES magasin (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66DE52078D ON article (magasins_id)');
        $this->addSql('ALTER TABLE stock DROP INDEX IDX_4B3656607294869C, ADD UNIQUE INDEX UNIQ_4B3656607294869C (article_id)');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B36566020096AE3');
        $this->addSql('DROP INDEX IDX_4B36566020096AE3 ON stock');
        $this->addSql('ALTER TABLE stock CHANGE magasin_id magasins_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660DE52078D FOREIGN KEY (magasins_id) REFERENCES magasin (id)');
        $this->addSql('CREATE INDEX IDX_4B365660DE52078D ON stock (magasins_id)');
    }
}
