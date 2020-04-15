<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200309030806 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE vybrane_predmety (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE trida ADD vybrane_predmety_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trida ADD CONSTRAINT FK_7764D6C76F283DC5 FOREIGN KEY (vybrane_predmety_id) REFERENCES vybrane_predmety (id)');
        $this->addSql('CREATE INDEX IDX_7764D6C76F283DC5 ON trida (vybrane_predmety_id)');
        $this->addSql('ALTER TABLE predmet ADD vybrane_predmety_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE predmet ADD CONSTRAINT FK_DD9549426F283DC5 FOREIGN KEY (vybrane_predmety_id) REFERENCES vybrane_predmety (id)');
        $this->addSql('CREATE INDEX IDX_DD9549426F283DC5 ON predmet (vybrane_predmety_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE trida DROP FOREIGN KEY FK_7764D6C76F283DC5');
        $this->addSql('ALTER TABLE predmet DROP FOREIGN KEY FK_DD9549426F283DC5');
        $this->addSql('DROP TABLE vybrane_predmety');
        $this->addSql('DROP INDEX IDX_DD9549426F283DC5 ON predmet');
        $this->addSql('ALTER TABLE predmet DROP vybrane_predmety_id');
        $this->addSql('DROP INDEX IDX_7764D6C76F283DC5 ON trida');
        $this->addSql('ALTER TABLE trida DROP vybrane_predmety_id');
    }
}
