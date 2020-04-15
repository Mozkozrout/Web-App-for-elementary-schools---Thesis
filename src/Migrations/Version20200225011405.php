<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */

final class Version20200225011405 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cas (id INT AUTO_INCREMENT NOT NULL, den_id INT NOT NULL, predmet_id INT NOT NULL, ucitel_id INT NOT NULL, trida_id INT NOT NULL, ucebna_id INT NOT NULL, cas TIME NOT NULL, INDEX IDX_3AD60B318C88C0 (den_id), INDEX IDX_3AD60BB4810FC4 (predmet_id), INDEX IDX_3AD60B35E6DF29 (ucitel_id), INDEX IDX_3AD60B6F1C825A (trida_id), INDEX IDX_3AD60BA273BD17 (ucebna_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE den (id INT AUTO_INCREMENT NOT NULL, den VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE predmet (id INT AUTO_INCREMENT NOT NULL, skola_id INT DEFAULT NULL, nazev VARCHAR(255) NOT NULL, zkratka VARCHAR(255) NOT NULL, INDEX IDX_DD95494271B6FA82 (skola_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skola (id INT AUTO_INCREMENT NOT NULL, nazev VARCHAR(255) NOT NULL, stat VARCHAR(255) NOT NULL, mesto VARCHAR(255) NOT NULL, ulice VARCHAR(255) NOT NULL, cis_pop VARCHAR(25) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ucebna (id INT AUTO_INCREMENT NOT NULL, skola_id INT DEFAULT NULL, nazev VARCHAR(255) NOT NULL, patro SMALLINT DEFAULT NULL, INDEX IDX_B2DF3FD471B6FA82 (skola_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE zak (id INT AUTO_INCREMENT NOT NULL, trida_id INT NOT NULL, skola_id INT DEFAULT NULL, jmeno VARCHAR(255) NOT NULL, prijmeni VARCHAR(255) NOT NULL, dat_nar DATE NOT NULL, image VARCHAR(100) DEFAULT NULL, stat VARCHAR(255) DEFAULT NULL, mesto VARCHAR(255) DEFAULT NULL, ulice VARCHAR(255) DEFAULT NULL, cis_pop VARCHAR(25) DEFAULT NULL, INDEX IDX_A1D6A26F1C825A (trida_id), INDEX IDX_A1D6A271B6FA82 (skola_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cas ADD CONSTRAINT FK_3AD60B318C88C0 FOREIGN KEY (den_id) REFERENCES den (id)');
        $this->addSql('ALTER TABLE cas ADD CONSTRAINT FK_3AD60BB4810FC4 FOREIGN KEY (predmet_id) REFERENCES predmet (id)');
        $this->addSql('ALTER TABLE cas ADD CONSTRAINT FK_3AD60B35E6DF29 FOREIGN KEY (ucitel_id) REFERENCES ucitele (id)');
        $this->addSql('ALTER TABLE cas ADD CONSTRAINT FK_3AD60B6F1C825A FOREIGN KEY (trida_id) REFERENCES trida (id)');
        $this->addSql('ALTER TABLE cas ADD CONSTRAINT FK_3AD60BA273BD17 FOREIGN KEY (ucebna_id) REFERENCES ucebna (id)');
        $this->addSql('ALTER TABLE predmet ADD CONSTRAINT FK_DD95494271B6FA82 FOREIGN KEY (skola_id) REFERENCES skola (id)');
        $this->addSql('ALTER TABLE ucebna ADD CONSTRAINT FK_B2DF3FD471B6FA82 FOREIGN KEY (skola_id) REFERENCES skola (id)');
        $this->addSql('ALTER TABLE zak ADD CONSTRAINT FK_A1D6A26F1C825A FOREIGN KEY (trida_id) REFERENCES trida (id)');
        $this->addSql('ALTER TABLE zak ADD CONSTRAINT FK_A1D6A271B6FA82 FOREIGN KEY (skola_id) REFERENCES skola (id)');
        $this->addSql('ALTER TABLE ucitele DROP INDEX IDX_67AFC7466F1C825A, ADD UNIQUE INDEX UNIQ_67AFC7466F1C825A (trida_id)');
        $this->addSql('ALTER TABLE ucitele ADD skola_id INT DEFAULT NULL, ADD prijmeni VARCHAR(255) NOT NULL, ADD dat_nar DATE NOT NULL, ADD stat VARCHAR(255) DEFAULT NULL, ADD mesto VARCHAR(255) DEFAULT NULL, ADD ulice VARCHAR(255) DEFAULT NULL, ADD cis_pop VARCHAR(25) DEFAULT NULL');
        $this->addSql('ALTER TABLE ucitele ADD CONSTRAINT FK_67AFC74671B6FA82 FOREIGN KEY (skola_id) REFERENCES skola (id)');
        $this->addSql('CREATE INDEX IDX_67AFC74671B6FA82 ON ucitele (skola_id)');
        $this->addSql('ALTER TABLE trida ADD skola_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE trida ADD CONSTRAINT FK_7764D6C771B6FA82 FOREIGN KEY (skola_id) REFERENCES skola (id)');
        $this->addSql('CREATE INDEX IDX_7764D6C771B6FA82 ON trida (skola_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE cas DROP FOREIGN KEY FK_3AD60B318C88C0');
        $this->addSql('ALTER TABLE cas DROP FOREIGN KEY FK_3AD60BB4810FC4');
        $this->addSql('ALTER TABLE ucitele DROP FOREIGN KEY FK_67AFC74671B6FA82');
        $this->addSql('ALTER TABLE predmet DROP FOREIGN KEY FK_DD95494271B6FA82');
        $this->addSql('ALTER TABLE trida DROP FOREIGN KEY FK_7764D6C771B6FA82');
        $this->addSql('ALTER TABLE ucebna DROP FOREIGN KEY FK_B2DF3FD471B6FA82');
        $this->addSql('ALTER TABLE zak DROP FOREIGN KEY FK_A1D6A271B6FA82');
        $this->addSql('ALTER TABLE cas DROP FOREIGN KEY FK_3AD60BA273BD17');
        $this->addSql('DROP TABLE cas');
        $this->addSql('DROP TABLE den');
        $this->addSql('DROP TABLE predmet');
        $this->addSql('DROP TABLE skola');
        $this->addSql('DROP TABLE ucebna');
        $this->addSql('DROP TABLE zak');
        $this->addSql('DROP INDEX IDX_7764D6C771B6FA82 ON trida');
        $this->addSql('ALTER TABLE trida DROP skola_id');
        $this->addSql('ALTER TABLE ucitele DROP INDEX UNIQ_67AFC7466F1C825A, ADD INDEX IDX_67AFC7466F1C825A (trida_id)');
        $this->addSql('DROP INDEX IDX_67AFC74671B6FA82 ON ucitele');
        $this->addSql('ALTER TABLE ucitele DROP skola_id, DROP prijmeni, DROP dat_nar, DROP stat, DROP mesto, DROP ulice, DROP cis_pop');
    }
}

