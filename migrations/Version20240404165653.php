<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240404165653 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE player (id INT AUTO_INCREMENT NOT NULL, club_id_id INT DEFAULT NULL, national_id_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, date_naissance VARCHAR(255) NOT NULL, nationalite VARCHAR(255) NOT NULL, parcours LONGTEXT NOT NULL, nombre_but INT NOT NULL, UNIQUE INDEX UNIQ_98197A65DF2AB4E5 (club_id_id), UNIQUE INDEX UNIQ_98197A65E9E9E294 (national_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65DF2AB4E5 FOREIGN KEY (club_id_id) REFERENCES club (id)');
        $this->addSql('ALTER TABLE player ADD CONSTRAINT FK_98197A65E9E9E294 FOREIGN KEY (national_id_id) REFERENCES national (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65DF2AB4E5');
        $this->addSql('ALTER TABLE player DROP FOREIGN KEY FK_98197A65E9E9E294');
        $this->addSql('DROP TABLE player');
    }
}
