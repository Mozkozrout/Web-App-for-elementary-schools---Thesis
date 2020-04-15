<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200226195434 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ucebna ADD trida_id INT NOT NULL');
        $this->addSql('ALTER TABLE ucebna ADD CONSTRAINT FK_B2DF3FD46F1C825A FOREIGN KEY (trida_id) REFERENCES trida (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B2DF3FD46F1C825A ON ucebna (trida_id)');
        $this->addSql('ALTER TABLE ucitele ADD ucebna_id INT DEFAULT NULL, ADD poznamka LONGTEXT DEFAULT NULL, ADD telefon VARCHAR(15) DEFAULT NULL, ADD email VARCHAR(50) DEFAULT NULL, CHANGE image image VARCHAR(100) NOT NULL, CHANGE dat_nar dat_nar DATE NOT NULL');
        $this->addSql('ALTER TABLE ucitele ADD CONSTRAINT FK_67AFC746A273BD17 FOREIGN KEY (ucebna_id) REFERENCES ucebna (id)');
        $this->addSql('CREATE INDEX IDX_67AFC746A273BD17 ON ucitele (ucebna_id)');
        $this->addSql('ALTER TABLE zak ADD poznamka LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ucebna DROP FOREIGN KEY FK_B2DF3FD46F1C825A');
        $this->addSql('DROP INDEX UNIQ_B2DF3FD46F1C825A ON ucebna');
        $this->addSql('ALTER TABLE ucebna DROP trida_id');
        $this->addSql('ALTER TABLE ucitele DROP FOREIGN KEY FK_67AFC746A273BD17');
        $this->addSql('DROP INDEX IDX_67AFC746A273BD17 ON ucitele');
        $this->addSql('ALTER TABLE ucitele DROP ucebna_id, DROP poznamka, DROP telefon, DROP email, CHANGE dat_nar dat_nar DATE DEFAULT NULL, CHANGE image image VARCHAR(100) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE zak DROP poznamka');
    }
}
