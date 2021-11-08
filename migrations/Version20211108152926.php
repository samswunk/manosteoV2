<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211108152926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        
        $this->addSql('CREATE TABLE accouchement (id INT AUTO_INCREMENT NOT NULL, difficultes TINYINT(1) DEFAULT NULL, conditions TINYINT(1) DEFAULT NULL, peridurale TINYINT(1) DEFAULT NULL, episiotomie TINYINT(1) DEFAULT NULL, instrumentalisation TINYINT(1) DEFAULT NULL, presentation TINYINT(1) DEFAULT NULL, remarques VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, adresse1 VARCHAR(255) DEFAULT NULL, adresse2 VARCHAR(255) DEFAULT NULL, code_postal VARCHAR(6) DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude NUMERIC(16, 6) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        $this->addSql('CREATE TABLE antecedent (id INT AUTO_INCREMENT NOT NULL, orl VARCHAR(255) DEFAULT NULL, neuro VARCHAR(255) DEFAULT NULL, vr VARCHAR(255) DEFAULT NULL, allergie VARCHAR(255) DEFAULT NULL, cardio VARCHAR(255) DEFAULT NULL, digest VARCHAR(255) DEFAULT NULL, uro VARCHAR(255) DEFAULT NULL, gyneco VARCHAR(255) DEFAULT NULL, sommeil VARCHAR(255) DEFAULT NULL, grossesse VARCHAR(255) DEFAULT NULL, vaccin VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultation (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, user_id INT DEFAULT NULL, facture_id INT DEFAULT NULL, date DATE NOT NULL, motif VARCHAR(255) NOT NULL, test VARCHAR(255) DEFAULT NULL, traitement VARCHAR(255) NOT NULL, domicile TINYINT(1) DEFAULT NULL, INDEX IDX_964685A66B899279 (patient_id), INDEX IDX_964685A6A76ED395 (user_id), UNIQUE INDEX UNIQ_964685A67F2DEE08 (facture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE envoye_par (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE facture (id INT AUTO_INCREMENT NOT NULL, tarif NUMERIC(5, 2) NOT NULL, paiement TINYINT(1) DEFAULT NULL, numero_cheque VARCHAR(35) DEFAULT NULL, regler TINYINT(1) DEFAULT NULL, date DATE NOT NULL, numero INT NOT NULL, impression TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, telephone_id INT DEFAULT NULL, antecedent_id INT DEFAULT NULL, accouchement_id INT DEFAULT NULL, pediatrie_id INT DEFAULT NULL, traumato_id INT DEFAULT NULL, envoye_par_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(100) DEFAULT NULL, sexe INT DEFAULT NULL, profession VARCHAR(255) DEFAULT NULL, secu VARCHAR(100) DEFAULT NULL, date_naissance DATE DEFAULT NULL, remarques VARCHAR(255) DEFAULT NULL, INDEX IDX_1ADAD7EB4DE7DC5C (adresse_id), UNIQUE INDEX UNIQ_1ADAD7EBFE649A29 (telephone_id), UNIQUE INDEX UNIQ_1ADAD7EBE53D136E (antecedent_id), UNIQUE INDEX UNIQ_1ADAD7EB1647EF5F (accouchement_id), UNIQUE INDEX UNIQ_1ADAD7EB158618EC (pediatrie_id), UNIQUE INDEX UNIQ_1ADAD7EBA7B68389 (traumato_id), UNIQUE INDEX UNIQ_1ADAD7EBD603292 (envoye_par_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        $this->addSql('CREATE TABLE pediatrie (id INT AUTO_INCREMENT NOT NULL, taille INT DEFAULT NULL, poids NUMERIC(5, 1) DEFAULT NULL, pc INT NOT NULL, apgar1 INT DEFAULT NULL, apgar5 INT DEFAULT NULL, apgar10 INT DEFAULT NULL, allaitement TINYINT(1) DEFAULT NULL, temps_allaitement VARCHAR(50) DEFAULT NULL, remarques VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE telephone (id INT AUTO_INCREMENT NOT NULL, mobile VARCHAR(15) DEFAULT NULL, telephone VARCHAR(15) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE traumato (id INT AUTO_INCREMENT NOT NULL, fractures VARCHAR(255) DEFAULT NULL, entorses VARCHAR(255) DEFAULT NULL, accidents VARCHAR(255) DEFAULT NULL, operations VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(100) DEFAULT NULL, telephone VARCHAR(20) DEFAULT NULL, mobile VARCHAR(20) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, siret VARCHAR(255) DEFAULT NULL, adeli VARCHAR(255) DEFAULT NULL, ape VARCHAR(255) DEFAULT NULL, retroced DOUBLE PRECISION DEFAULT NULL, gestion_agree TINYINT(1) DEFAULT NULL, herit INT DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A66B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A67F2DEE08 FOREIGN KEY (facture_id) REFERENCES facture (id)');
        
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBFE649A29 FOREIGN KEY (telephone_id) REFERENCES telephone (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBE53D136E FOREIGN KEY (antecedent_id) REFERENCES antecedent (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB1647EF5F FOREIGN KEY (accouchement_id) REFERENCES accouchement (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB158618EC FOREIGN KEY (pediatrie_id) REFERENCES pediatrie (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBA7B68389 FOREIGN KEY (traumato_id) REFERENCES traumato (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBD603292 FOREIGN KEY (envoye_par_id) REFERENCES envoye_par (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EB1647EF5F');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EB4DE7DC5C');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBE53D136E');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBD603292');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A67F2DEE08');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A66B899279');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EB158618EC');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBFE649A29');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBA7B68389');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A6A76ED395');
        $this->addSql('DROP TABLE accouchement');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE antecedent');
        $this->addSql('DROP TABLE consultation');
        $this->addSql('DROP TABLE envoye_par');
        $this->addSql('DROP TABLE facture');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE pediatrie');
        $this->addSql('DROP TABLE telephone');
        $this->addSql('DROP TABLE traumato');
        $this->addSql('DROP TABLE `user`');
    }
}
