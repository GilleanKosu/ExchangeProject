<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190226095418 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE servicio ADD ciudad_servicio_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE servicio ADD CONSTRAINT FK_CB86F22A9E424EC2 FOREIGN KEY (ciudad_servicio_id) REFERENCES ciudad (id)');
        $this->addSql('CREATE INDEX IDX_CB86F22A9E424EC2 ON servicio (ciudad_servicio_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE servicio DROP FOREIGN KEY FK_CB86F22A9E424EC2');
        $this->addSql('DROP INDEX IDX_CB86F22A9E424EC2 ON servicio');
        $this->addSql('ALTER TABLE servicio DROP ciudad_servicio_id');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
