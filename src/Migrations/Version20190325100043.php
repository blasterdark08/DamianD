<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190325100043 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_957A6479C05FB297 (confirmation_token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE truck CHANGE kenteken kenteken VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE logboek CHANGE datum datum DATE NOT NULL');
        $this->addSql('ALTER TABLE logboek ADD CONSTRAINT FK_13847B9AA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE logboek ADD CONSTRAINT FK_13847B9A85C0B3BE FOREIGN KEY (chauffeur_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE logboek ADD CONSTRAINT FK_13847B9AC6957CCE FOREIGN KEY (truck_id) REFERENCES truck (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE logboek DROP FOREIGN KEY FK_13847B9AA76ED395');
        $this->addSql('ALTER TABLE logboek DROP FOREIGN KEY FK_13847B9A85C0B3BE');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('ALTER TABLE logboek DROP FOREIGN KEY FK_13847B9AC6957CCE');
        $this->addSql('ALTER TABLE logboek CHANGE datum datum DATETIME NOT NULL');
        $this->addSql('ALTER TABLE truck CHANGE kenteken kenteken INT NOT NULL');
    }
}
