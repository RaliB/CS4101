<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211009122918 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_4BC6D58B8D349FAE');
        $this->addSql('DROP INDEX IDX_4BC6D58B54177093');
        $this->addSql('CREATE TEMPORARY TABLE __temp__indisponibilite_room AS SELECT indisponibilite_id, room_id FROM indisponibilite_room');
        $this->addSql('DROP TABLE indisponibilite_room');
        $this->addSql('CREATE TABLE indisponibilite_room (indisponibilite_id INTEGER NOT NULL, room_id INTEGER NOT NULL, PRIMARY KEY(indisponibilite_id, room_id), CONSTRAINT FK_4BC6D58B8D349FAE FOREIGN KEY (indisponibilite_id) REFERENCES indisponibilite (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_4BC6D58B54177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO indisponibilite_room (indisponibilite_id, room_id) SELECT indisponibilite_id, room_id FROM __temp__indisponibilite_room');
        $this->addSql('DROP TABLE __temp__indisponibilite_room');
        $this->addSql('CREATE INDEX IDX_4BC6D58B8D349FAE ON indisponibilite_room (indisponibilite_id)');
        $this->addSql('CREATE INDEX IDX_4BC6D58B54177093 ON indisponibilite_room (room_id)');
        $this->addSql('DROP INDEX IDX_42C8495554177093');
        $this->addSql('DROP INDEX IDX_42C8495519EB6921');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reservation AS SELECT id, room_id, client_id, arrivee, depart, confirmation FROM reservation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('CREATE TABLE reservation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, room_id INTEGER NOT NULL, client_id INTEGER DEFAULT NULL, arrivee DATE NOT NULL, depart DATE NOT NULL, confirmation BOOLEAN NOT NULL, CONSTRAINT FK_42C8495554177093 FOREIGN KEY (room_id) REFERENCES room (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_42C8495519EB6921 FOREIGN KEY (client_id) REFERENCES client (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO reservation (id, room_id, client_id, arrivee, depart, confirmation) SELECT id, room_id, client_id, arrivee, depart, confirmation FROM __temp__reservation');
        $this->addSql('DROP TABLE __temp__reservation');
        $this->addSql('CREATE INDEX IDX_42C8495554177093 ON reservation (room_id)');
        $this->addSql('CREATE INDEX IDX_42C8495519EB6921 ON reservation (client_id)');
        $this->addSql('DROP INDEX IDX_729F519B7E3C61F9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__room AS SELECT id, owner_id, summary, description, capacity, superficy, price, address FROM room');
        $this->addSql('DROP TABLE room');
        $this->addSql('CREATE TABLE room (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER NOT NULL, summary CLOB DEFAULT NULL COLLATE BINARY, description CLOB NOT NULL COLLATE BINARY, capacity INTEGER NOT NULL, superficy DOUBLE PRECISION NOT NULL, price DOUBLE PRECISION NOT NULL, address CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_729F519B7E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO room (id, owner_id, summary, description, capacity, superficy, price, address) SELECT id, owner_id, summary, description, capacity, superficy, price, address FROM __temp__room');
        $this->addSql('DROP TABLE __temp__room');
        $this->addSql('CREATE INDEX IDX_729F519B7E3C61F9 ON room (owner_id)');
        $this->addSql('DROP INDEX IDX_4E2C37B798260155');
        $this->addSql('DROP INDEX IDX_4E2C37B754177093');
        $this->addSql('CREATE TEMPORARY TABLE __temp__room_region AS SELECT room_id, region_id FROM room_region');
        $this->addSql('DROP TABLE room_region');
        $this->addSql('CREATE TABLE room_region (room_id INTEGER NOT NULL, region_id INTEGER NOT NULL, PRIMARY KEY(room_id, region_id), CONSTRAINT FK_4E2C37B754177093 FOREIGN KEY (room_id) REFERENCES room (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_4E2C37B798260155 FOREIGN KEY (region_id) REFERENCES region (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO room_region (room_id, region_id) SELECT room_id, region_id FROM __temp__room_region');
        $this->addSql('DROP TABLE __temp__room_region');
        $this->addSql('CREATE INDEX IDX_4E2C37B798260155 ON room_region (region_id)');
        $this->addSql('CREATE INDEX IDX_4E2C37B754177093 ON room_region (room_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_4BC6D58B8D349FAE');
        $this->addSql('DROP INDEX IDX_4BC6D58B54177093');
        $this->addSql('CREATE TEMPORARY TABLE __temp__indisponibilite_room AS SELECT indisponibilite_id, room_id FROM indisponibilite_room');
        $this->addSql('DROP TABLE indisponibilite_room');
        $this->addSql('CREATE TABLE indisponibilite_room (indisponibilite_id INTEGER NOT NULL, room_id INTEGER NOT NULL, PRIMARY KEY(indisponibilite_id, room_id))');
        $this->addSql('INSERT INTO indisponibilite_room (indisponibilite_id, room_id) SELECT indisponibilite_id, room_id FROM __temp__indisponibilite_room');
        $this->addSql('DROP TABLE __temp__indisponibilite_room');
        $this->addSql('CREATE INDEX IDX_4BC6D58B8D349FAE ON indisponibilite_room (indisponibilite_id)');
        $this->addSql('CREATE INDEX IDX_4BC6D58B54177093 ON indisponibilite_room (room_id)');
        $this->addSql('DROP INDEX IDX_42C8495554177093');
        $this->addSql('DROP INDEX IDX_42C8495519EB6921');
        $this->addSql('CREATE TEMPORARY TABLE __temp__reservation AS SELECT id, room_id, client_id, arrivee, depart, confirmation FROM reservation');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('CREATE TABLE reservation (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, room_id INTEGER NOT NULL, client_id INTEGER DEFAULT NULL, arrivee DATE NOT NULL, depart DATE NOT NULL, confirmation BOOLEAN NOT NULL)');
        $this->addSql('INSERT INTO reservation (id, room_id, client_id, arrivee, depart, confirmation) SELECT id, room_id, client_id, arrivee, depart, confirmation FROM __temp__reservation');
        $this->addSql('DROP TABLE __temp__reservation');
        $this->addSql('CREATE INDEX IDX_42C8495554177093 ON reservation (room_id)');
        $this->addSql('CREATE INDEX IDX_42C8495519EB6921 ON reservation (client_id)');
        $this->addSql('DROP INDEX IDX_729F519B7E3C61F9');
        $this->addSql('CREATE TEMPORARY TABLE __temp__room AS SELECT id, owner_id, summary, description, capacity, superficy, price, address FROM room');
        $this->addSql('DROP TABLE room');
        $this->addSql('CREATE TABLE room (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, owner_id INTEGER NOT NULL, summary CLOB DEFAULT NULL, description CLOB NOT NULL, capacity INTEGER NOT NULL, superficy DOUBLE PRECISION NOT NULL, price DOUBLE PRECISION NOT NULL, address CLOB NOT NULL)');
        $this->addSql('INSERT INTO room (id, owner_id, summary, description, capacity, superficy, price, address) SELECT id, owner_id, summary, description, capacity, superficy, price, address FROM __temp__room');
        $this->addSql('DROP TABLE __temp__room');
        $this->addSql('CREATE INDEX IDX_729F519B7E3C61F9 ON room (owner_id)');
        $this->addSql('DROP INDEX IDX_4E2C37B754177093');
        $this->addSql('DROP INDEX IDX_4E2C37B798260155');
        $this->addSql('CREATE TEMPORARY TABLE __temp__room_region AS SELECT room_id, region_id FROM room_region');
        $this->addSql('DROP TABLE room_region');
        $this->addSql('CREATE TABLE room_region (room_id INTEGER NOT NULL, region_id INTEGER NOT NULL, PRIMARY KEY(room_id, region_id))');
        $this->addSql('INSERT INTO room_region (room_id, region_id) SELECT room_id, region_id FROM __temp__room_region');
        $this->addSql('DROP TABLE __temp__room_region');
        $this->addSql('CREATE INDEX IDX_4E2C37B754177093 ON room_region (room_id)');
        $this->addSql('CREATE INDEX IDX_4E2C37B798260155 ON room_region (region_id)');
    }
}
