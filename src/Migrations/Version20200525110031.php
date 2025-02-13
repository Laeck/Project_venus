<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200525110031 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exposition ADD artiste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE exposition ADD CONSTRAINT FK_BC31FD1321D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('CREATE INDEX IDX_BC31FD1321D25844 ON exposition (artiste_id)');
        $this->addSql('ALTER TABLE oeuvres ADD artiste_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE oeuvres ADD CONSTRAINT FK_413EEE3E21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id)');
        $this->addSql('CREATE INDEX IDX_413EEE3E21D25844 ON oeuvres (artiste_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE exposition DROP FOREIGN KEY FK_BC31FD1321D25844');
        $this->addSql('DROP INDEX IDX_BC31FD1321D25844 ON exposition');
        $this->addSql('ALTER TABLE exposition DROP artiste_id');
        $this->addSql('ALTER TABLE oeuvres DROP FOREIGN KEY FK_413EEE3E21D25844');
        $this->addSql('DROP INDEX IDX_413EEE3E21D25844 ON oeuvres');
        $this->addSql('ALTER TABLE oeuvres DROP artiste_id');
    }
}
