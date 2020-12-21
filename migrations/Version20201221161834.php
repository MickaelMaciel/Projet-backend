<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201221161834 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_simple CHANGE article_simple_prix_achat article_simple_prix_achat INT NOT NULL, CHANGE article_simple_prix_vente article_simple_prix_vente INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_simple CHANGE article_simple_prix_achat article_simple_prix_achat DOUBLE PRECISION NOT NULL, CHANGE article_simple_prix_vente article_simple_prix_vente DOUBLE PRECISION NOT NULL');
    }
}
