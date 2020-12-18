<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201218143617 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66FACB6020');
        $this->addSql('DROP INDEX IDX_23A0E66FACB6020 ON article');
        $this->addSql('ALTER TABLE article DROP stocks_id');
        $this->addSql('ALTER TABLE stock ADD article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B3656607294869C FOREIGN KEY (article_id) REFERENCES article (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_4B3656607294869C ON stock (article_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article ADD stocks_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66FACB6020 FOREIGN KEY (stocks_id) REFERENCES stock (id)');
        $this->addSql('CREATE INDEX IDX_23A0E66FACB6020 ON article (stocks_id)');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B3656607294869C');
        $this->addSql('DROP INDEX UNIQ_4B3656607294869C ON stock');
        $this->addSql('ALTER TABLE stock DROP article_id');
    }
}
