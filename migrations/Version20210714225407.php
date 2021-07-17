<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210714225407 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointment (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_doctor_id INTEGER NOT NULL, id_patient_id INTEGER NOT NULL, start_time TIME NOT NULL --(DC2Type:time_immutable)
        , end_time TIME NOT NULL --(DC2Type:time_immutable)
        , appointment_day DATE NOT NULL --(DC2Type:date_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_FE38F8447C14730 ON appointment (id_doctor_id)');
        $this->addSql('CREATE INDEX IDX_FE38F844CE0312AE ON appointment (id_patient_id)');
        $this->addSql('CREATE TABLE department (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, department_name VARCHAR(100) NOT NULL)');
        $this->addSql('CREATE TABLE doctor (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, id_department_id INTEGER NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(50) NOT NULL, phone VARCHAR(20) NOT NULL, email VARCHAR(80) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_1FC0F36A10A824BA ON doctor (id_department_id)');
        $this->addSql('CREATE TABLE patient (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, patient_name VARCHAR(100) NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(50) NOT NULL, address VARCHAR(100) NOT NULL, phone VARCHAR(20) DEFAULT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE appointment');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE doctor');
        $this->addSql('DROP TABLE patient');
    }
}
