<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240404174536 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, club_id INT NOT NULL, national_id INT NOT NULL, nom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, nationalite VARCHAR(255) NOT NULL, parcours LONGTEXT NOT NULL, nombre_but INT NOT NULL, UNIQUE INDEX UNIQ_98197A6561190A32 (club_id), UNIQUE INDEX UNIQ_98197A6536491297 (national_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A6561190A32 FOREIGN KEY (club_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A6536491297 FOREIGN KEY (national_id) REFERENCES national (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A6561190A32');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A6536491297');
        $this->addSql('DROP TABLE player');
    }
}
