<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200309165315 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE historie (id INT AUTO_INCREMENT NOT NULL, zak_id INT DEFAULT NULL, rok SMALLINT NOT NULL, UNIQUE INDEX UNIQ_44314A63CA0EBDD9 (zak_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE historie_trida (historie_id INT NOT NULL, trida_id INT NOT NULL, INDEX IDX_5E7BBD9F779817B8 (historie_id), INDEX IDX_5E7BBD9F6F1C825A (trida_id), PRIMARY KEY(historie_id, trida_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE historie ADD CONSTRAINT FK_44314A63CA0EBDD9 FOREIGN KEY (zak_id) REFERENCES zak (id)');
        $this->addSql('ALTER TABLE historie_trida ADD CONSTRAINT FK_5E7BBD9F779817B8 FOREIGN KEY (historie_id) REFERENCES historie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE historie_trida ADD CONSTRAINT FK_5E7BBD9F6F1C825A FOREIGN KEY (trida_id) REFERENCES trida (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE historie_trida DROP FOREIGN KEY FK_5E7BBD9F779817B8');
        $this->addSql('DROP TABLE historie');
        $this->addSql('DROP TABLE historie_trida');
    }
}
