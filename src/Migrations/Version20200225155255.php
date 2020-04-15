<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200225155255 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE znamka (id INT AUTO_INCREMENT NOT NULL, zak_id INT NOT NULL, predmet_id INT NOT NULL, ucitel_id INT NOT NULL, hodnota SMALLINT DEFAULT NULL, poznamka VARCHAR(255) DEFAULT NULL, INDEX IDX_42506D9FCA0EBDD9 (zak_id), INDEX IDX_42506D9FB4810FC4 (predmet_id), INDEX IDX_42506D9F35E6DF29 (ucitel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE znamka ADD CONSTRAINT FK_42506D9FCA0EBDD9 FOREIGN KEY (zak_id) REFERENCES zak (id)');
        $this->addSql('ALTER TABLE znamka ADD CONSTRAINT FK_42506D9FB4810FC4 FOREIGN KEY (predmet_id) REFERENCES predmet (id)');
        $this->addSql('ALTER TABLE znamka ADD CONSTRAINT FK_42506D9F35E6DF29 FOREIGN KEY (ucitel_id) REFERENCES ucitele (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE znamka');
    }
}
