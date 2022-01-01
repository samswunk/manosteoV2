<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211122172003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBD603292');
        $this->addSql('DROP INDEX UNIQ_1ADAD7EBD603292 ON patient');
        $this->addSql('ALTER TABLE patient ADD mutuelle VARCHAR(255) DEFAULT NULL, ADD loisir VARCHAR(255) DEFAULT NULL, ADD pref_manuelle VARCHAR(1) DEFAULT NULL');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBD603292 FOREIGN KEY (envoye_par_id) REFERENCES envoye_par (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1ADAD7EBD603292 ON patient (envoye_par_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBD603292');
        $this->addSql('DROP INDEX UNIQ_1ADAD7EBD603292 ON patient');
        $this->addSql('ALTER TABLE patient DROP mutuelle, DROP loisir, DROP pref_manuelle');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBD603292 FOREIGN KEY (envoye_par_id) REFERENCES envoye_par (id) ON DELETE SET NULL');
        $this->addSql('CREATE INDEX UNIQ_1ADAD7EBD603292 ON patient (envoye_par_id)');
    }
}
