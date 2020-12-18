<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201218134801 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD magasins_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66DE52078D FOREIGN KEY (magasins_id) REFERENCES magasin (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66DE52078D ON article (magasins_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66DE52078D');
        $this->addSql('DROP INDEX IDX_23A0E66DE52078D ON article');
        $this->addSql('ALTER TABLE article DROP magasins_id');
    }
}
