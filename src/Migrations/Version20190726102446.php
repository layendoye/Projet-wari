<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190726102446 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE transaction (id INT AUTO_INCREMENT NOT NULL, user_emetteur_id INT NOT NULL, user_recepteur_id INT DEFAULT NULL, client_emetteur VARCHAR(255) NOT NULL, telephone_emetteur VARCHAR(255) NOT NULL, nci_emetteur VARCHAR(255) NOT NULL, date_envoi DATETIME NOT NULL, code VARCHAR(255) NOT NULL, montant BIGINT NOT NULL, frais BIGINT NOT NULL, client_recepteur VARCHAR(255) NOT NULL, telephone_recepteur VARCHAR(255) NOT NULL, nci_recepteur VARCHAR(255) DEFAULT NULL, date_reception DATETIME DEFAULT NULL, commission_emetteur BIGINT DEFAULT NULL, commission_recepteur BIGINT DEFAULT NULL, commission_wari BIGINT DEFAULT NULL, taxes_etat BIGINT DEFAULT NULL, INDEX IDX_723705D1D0F2E719 (user_emetteur_id), INDEX IDX_723705D1BB85042F (user_recepteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE depot (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT NOT NULL, caissier_id INT NOT NULL, date DATETIME NOT NULL, montant BIGINT NOT NULL, INDEX IDX_47948BBCA4AEAFEA (entreprise_id), INDEX IDX_47948BBCB514973B (caissier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entreprise (id INT AUTO_INCREMENT NOT NULL, numero_compte VARCHAR(255) NOT NULL, raison_sociale VARCHAR(255) NOT NULL, ninea VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, solde BIGINT NOT NULL, status VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D19FA609731415A (numero_compte), UNIQUE INDEX UNIQ_D19FA60C678AEBE (ninea), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE profil (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, entreprise_id INT NOT NULL, profil_id INT NOT NULL, username VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, telephone INT NOT NULL, nci VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1D1C63B3F85E0677 (username), UNIQUE INDEX UNIQ_1D1C63B3E7927C74 (email), UNIQUE INDEX UNIQ_1D1C63B3450FF010 (telephone), UNIQUE INDEX UNIQ_1D1C63B3C7B6DEA0 (nci), INDEX IDX_1D1C63B3A4AEAFEA (entreprise_id), INDEX IDX_1D1C63B3275ED078 (profil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1D0F2E719 FOREIGN KEY (user_emetteur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE transaction ADD CONSTRAINT FK_723705D1BB85042F FOREIGN KEY (user_recepteur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE depot ADD CONSTRAINT FK_47948BBCA4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE depot ADD CONSTRAINT FK_47948BBCB514973B FOREIGN KEY (caissier_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3A4AEAFEA FOREIGN KEY (entreprise_id) REFERENCES entreprise (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE depot DROP FOREIGN KEY FK_47948BBCA4AEAFEA');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3A4AEAFEA');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3275ED078');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1D0F2E719');
        $this->addSql('ALTER TABLE transaction DROP FOREIGN KEY FK_723705D1BB85042F');
        $this->addSql('ALTER TABLE depot DROP FOREIGN KEY FK_47948BBCB514973B');
        $this->addSql('DROP TABLE transaction');
        $this->addSql('DROP TABLE depot');
        $this->addSql('DROP TABLE entreprise');
        $this->addSql('DROP TABLE profil');
        $this->addSql('DROP TABLE utilisateur');
    }
}
