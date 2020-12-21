<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201221155537 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_simple ADD produit_configurable_id INT NOT NULL, ADD variation_couleur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE article_simple ADD CONSTRAINT FK_ABBCAA82A089072A FOREIGN KEY (produit_configurable_id) REFERENCES produit_configurable (id)');
        $this->addSql('ALTER TABLE article_simple ADD CONSTRAINT FK_ABBCAA823C00EC33 FOREIGN KEY (variation_couleur_id) REFERENCES variation_couleur (id)');
        $this->addSql('CREATE INDEX IDX_ABBCAA82A089072A ON article_simple (produit_configurable_id)');
        $this->addSql('CREATE INDEX IDX_ABBCAA823C00EC33 ON article_simple (variation_couleur_id)');
        $this->addSql('ALTER TABLE image ADD produit_configurable_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FA089072A FOREIGN KEY (produit_configurable_id) REFERENCES produit_configurable (id)');
        $this->addSql('CREATE INDEX IDX_C53D045FA089072A ON image (produit_configurable_id)');
        $this->addSql('ALTER TABLE produit_configurable ADD sous_type_produit_id INT NOT NULL, ADD fabricant_id INT NOT NULL');
        $this->addSql('ALTER TABLE produit_configurable ADD CONSTRAINT FK_88D8518BDE46E5B2 FOREIGN KEY (sous_type_produit_id) REFERENCES sous_type_produit (id)');
        $this->addSql('ALTER TABLE produit_configurable ADD CONSTRAINT FK_88D8518BCBAAAAB3 FOREIGN KEY (fabricant_id) REFERENCES fabricant (id)');
        $this->addSql('CREATE INDEX IDX_88D8518BDE46E5B2 ON produit_configurable (sous_type_produit_id)');
        $this->addSql('CREATE INDEX IDX_88D8518BCBAAAAB3 ON produit_configurable (fabricant_id)');
        $this->addSql('ALTER TABLE sous_type_produit ADD type_produit_id INT NOT NULL');
        $this->addSql('ALTER TABLE sous_type_produit ADD CONSTRAINT FK_BE14DBB71237A8DE FOREIGN KEY (type_produit_id) REFERENCES type_produit (id)');
        $this->addSql('CREATE INDEX IDX_BE14DBB71237A8DE ON sous_type_produit (type_produit_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article_simple DROP FOREIGN KEY FK_ABBCAA82A089072A');
        $this->addSql('ALTER TABLE article_simple DROP FOREIGN KEY FK_ABBCAA823C00EC33');
        $this->addSql('DROP INDEX IDX_ABBCAA82A089072A ON article_simple');
        $this->addSql('DROP INDEX IDX_ABBCAA823C00EC33 ON article_simple');
        $this->addSql('ALTER TABLE article_simple DROP produit_configurable_id, DROP variation_couleur_id');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FA089072A');
        $this->addSql('DROP INDEX IDX_C53D045FA089072A ON image');
        $this->addSql('ALTER TABLE image DROP produit_configurable_id');
        $this->addSql('ALTER TABLE produit_configurable DROP FOREIGN KEY FK_88D8518BDE46E5B2');
        $this->addSql('ALTER TABLE produit_configurable DROP FOREIGN KEY FK_88D8518BCBAAAAB3');
        $this->addSql('DROP INDEX IDX_88D8518BDE46E5B2 ON produit_configurable');
        $this->addSql('DROP INDEX IDX_88D8518BCBAAAAB3 ON produit_configurable');
        $this->addSql('ALTER TABLE produit_configurable DROP sous_type_produit_id, DROP fabricant_id');
        $this->addSql('ALTER TABLE sous_type_produit DROP FOREIGN KEY FK_BE14DBB71237A8DE');
        $this->addSql('DROP INDEX IDX_BE14DBB71237A8DE ON sous_type_produit');
        $this->addSql('ALTER TABLE sous_type_produit DROP type_produit_id');
    }
}
