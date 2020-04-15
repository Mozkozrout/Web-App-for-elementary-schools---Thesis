<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200225012803 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trida ADD skola_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trida ADD CONSTRAINT FK_7764D6C771B6FA82 FOREIGN KEY (skola_id) REFERENCES skola (id)');
        $this->addSql('CREATE INDEX IDX_7764D6C771B6FA82 ON trida (skola_id)');
        $this->addSql('ALTER TABLE ucitele ADD skola_id INT DEFAULT NULL, ADD prijmeni VARCHAR(255) NOT NULL, ADD dat_nar DATE NOT NULL, ADD stat VARCHAR(255) DEFAULT NULL, ADD mesto VARCHAR(255) DEFAULT NULL, ADD ulice VARCHAR(255) DEFAULT NULL, ADD cis_pop VARCHAR(25) DEFAULT NULL');
        $this->addSql('ALTER TABLE ucitele ADD CONSTRAINT FK_67AFC74671B6FA82 FOREIGN KEY (skola_id) REFERENCES skola (id)');
        $this->addSql('CREATE INDEX IDX_67AFC74671B6FA82 ON ucitele (skola_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trida DROP FOREIGN KEY FK_7764D6C771B6FA82');
        $this->addSql('DROP INDEX IDX_7764D6C771B6FA82 ON trida');
        $this->addSql('ALTER TABLE trida DROP skola_id');
        $this->addSql('ALTER TABLE ucitele DROP FOREIGN KEY FK_67AFC74671B6FA82');
        $this->addSql('DROP INDEX IDX_67AFC74671B6FA82 ON ucitele');
        $this->addSql('ALTER TABLE ucitele DROP skola_id, DROP prijmeni, DROP dat_nar, DROP stat, DROP mesto, DROP ulice, DROP cis_pop');
    }
}
