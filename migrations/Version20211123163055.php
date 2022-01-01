<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211123163055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE booking_user (booking_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_9502F4073301C60 (booking_id), INDEX IDX_9502F407A76ED395 (user_id), PRIMARY KEY(booking_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE booking_user ADD CONSTRAINT FK_9502F4073301C60 FOREIGN KEY (booking_id) REFERENCES booking (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking_user ADD CONSTRAINT FK_9502F407A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY IDX_E00CEDDE79F37AE5');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY IDX_E00CEDDEAB014612');
        $this->addSql('DROP INDEX IDX_E00CEDDEAB014612 ON booking');
        $this->addSql('DROP INDEX IDX_E00CEDDE79F37AE5 ON booking');
        $this->addSql('ALTER TABLE booking ADD patients_id INT DEFAULT NULL, ADD background_color VARCHAR(8) DEFAULT NULL, ADD jauge INT DEFAULT NULL, DROP patient_id, DROP id_user_id');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDECEC3FD2F FOREIGN KEY (patients_id) REFERENCES patient (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDECEC3FD2F ON booking (patients_id)');
        $this->addSql('ALTER TABLE consultation ADD is_confirmed TINYINT(1) DEFAULT NULL, ADD is_free TINYINT(1) DEFAULT NULL, CHANGE date date DATETIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE booking_user');
        $this->addSql('ALTER TABLE booking DROP FOREIGN KEY FK_E00CEDDECEC3FD2F');
        $this->addSql('DROP INDEX IDX_E00CEDDECEC3FD2F ON booking');
        $this->addSql('ALTER TABLE booking ADD patient_id INT DEFAULT NULL, ADD id_user_id INT DEFAULT NULL, DROP patients_id, DROP background_color, DROP jauge');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT IDX_E00CEDDE79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT IDX_E00CEDDEAB014612 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDEAB014612 ON booking (patient_id)');
        $this->addSql('CREATE INDEX IDX_E00CEDDE79F37AE5 ON booking (id_user_id)');
        $this->addSql('ALTER TABLE consultation DROP is_confirmed, DROP is_free, CHANGE date date DATE NOT NULL');
    }
}
