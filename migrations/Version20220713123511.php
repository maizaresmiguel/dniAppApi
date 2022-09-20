<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220713123511 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE destino (id INT AUTO_INCREMENT NOT NULL, oficina INT NOT NULL, nombre VARCHAR(50) NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, fecha_movimiento DATE NOT NULL, usuario VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dni (id INT AUTO_INCREMENT NOT NULL, id_tramite INT NOT NULL, apellido VARCHAR(50) NOT NULL, nombre VARCHAR(50) NOT NULL, sexo VARCHAR(1) NOT NULL, dni INT NOT NULL, fecha_nacimiento DATE NOT NULL, fecha_tramite DATE NOT NULL, codigo INT NOT NULL, fecha_alta DATETIME NOT NULL, usuario VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE destino');
        $this->addSql('DROP TABLE dni');
    }
}
