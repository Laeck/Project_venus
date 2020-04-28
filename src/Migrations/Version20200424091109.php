<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200424091109 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE carousel (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE carousel_image (carousel_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_AABDD99C1CE5B98 (carousel_id), INDEX IDX_AABDD993DA5256D (image_id), PRIMARY KEY(carousel_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE carousel_image ADD CONSTRAINT FK_AABDD99C1CE5B98 FOREIGN KEY (carousel_id) REFERENCES carousel (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE carousel_image ADD CONSTRAINT FK_AABDD993DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE carousel_image DROP FOREIGN KEY FK_AABDD99C1CE5B98');
        $this->addSql('DROP TABLE carousel');
        $this->addSql('DROP TABLE carousel_image');
    }
}
