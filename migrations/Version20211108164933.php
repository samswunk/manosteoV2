<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211108164933 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE confrere (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, telephone_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(100) DEFAULT NULL, profession VARCHAR(100) DEFAULT NULL, UNIQUE INDEX UNIQ_CDCF47854DE7DC5C (adresse_id), UNIQUE INDEX UNIQ_CDCF4785FE649A29 (telephone_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE courrier (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, confrere_id INT DEFAULT NULL, osteo_id INT DEFAULT NULL, objet VARCHAR(50) DEFAULT NULL, message LONGTEXT NOT NULL, date DATE NOT NULL, UNIQUE INDEX UNIQ_BEF47CAA6B899279 (patient_id), UNIQUE INDEX UNIQ_BEF47CAA355C1A75 (confrere_id), INDEX IDX_BEF47CAA8A4DEB55 (osteo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE param (id INT AUTO_INCREMENT NOT NULL, osteo_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, tarif NUMERIC(5, 2) NOT NULL, devise VARCHAR(4) NOT NULL, fond_ok TINYINT(1) DEFAULT NULL, fond_link VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_A4FA7C898A4DEB55 (osteo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE confrere ADD CONSTRAINT FK_CDCF47854DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE confrere ADD CONSTRAINT FK_CDCF4785FE649A29 FOREIGN KEY (telephone_id) REFERENCES telephone (id)');
        $this->addSql('ALTER TABLE courrier ADD CONSTRAINT FK_BEF47CAA6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE courrier ADD CONSTRAINT FK_BEF47CAA355C1A75 FOREIGN KEY (confrere_id) REFERENCES confrere (id)');
        $this->addSql('ALTER TABLE courrier ADD CONSTRAINT FK_BEF47CAA8A4DEB55 FOREIGN KEY (osteo_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE param ADD CONSTRAINT FK_A4FA7C898A4DEB55 FOREIGN KEY (osteo_id) REFERENCES `user` (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE courrier DROP FOREIGN KEY FK_BEF47CAA355C1A75');
        $this->addSql('DROP TABLE confrere');
        $this->addSql('DROP TABLE courrier');
        $this->addSql('DROP TABLE param');
    }
}
