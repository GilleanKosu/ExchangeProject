<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190227163814 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE mensajes (id INT AUTO_INCREMENT NOT NULL, remitente VARCHAR(255) DEFAULT NULL, contenido VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mensajes_user (mensajes_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_A11900E94481E9A2 (mensajes_id), INDEX IDX_A11900E9A76ED395 (user_id), PRIMARY KEY(mensajes_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE mensajes_user ADD CONSTRAINT FK_A11900E94481E9A2 FOREIGN KEY (mensajes_id) REFERENCES mensajes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mensajes_user ADD CONSTRAINT FK_A11900E9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE mensajes_user DROP FOREIGN KEY FK_A11900E94481E9A2');
        $this->addSql('DROP TABLE mensajes');
        $this->addSql('DROP TABLE mensajes_user');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
