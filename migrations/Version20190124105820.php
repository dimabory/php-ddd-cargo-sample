<?php

declare(strict_types=1);

namespace Codeliner\CargoBackend\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20190124105820 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE cargo (tracking_id CHAR(36) NOT NULL COMMENT \'(DC2Type:cargo_tracking_id)\', origin VARCHAR(255) NOT NULL, route_origin VARCHAR(255) DEFAULT NULL, route_destination VARCHAR(255) DEFAULT NULL, itinerary_legs LONGTEXT DEFAULT NULL, PRIMARY KEY(tracking_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE cargo');
    }
}
