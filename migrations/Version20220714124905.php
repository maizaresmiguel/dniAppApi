<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220714124905 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dni_destino (dni_id INT NOT NULL, destino_id INT NOT NULL, INDEX IDX_24F82784DB8B8168 (dni_id), INDEX IDX_24F82784E4360615 (destino_id), PRIMARY KEY(dni_id, destino_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dni_destino ADD CONSTRAINT FK_24F82784DB8B8168 FOREIGN KEY (dni_id) REFERENCES dni (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dni_destino ADD CONSTRAINT FK_24F82784E4360615 FOREIGN KEY (destino_id) REFERENCES destino (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE dni_destino');
    }
}
