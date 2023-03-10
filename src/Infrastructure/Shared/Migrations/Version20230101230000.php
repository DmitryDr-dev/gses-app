<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

class Version20230101230000 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql(
            sql: 'CREATE TABLE user 
            (
                id INT UNSIGNED AUTO_INCREMENT NOT NULL, 
                first_name VARCHAR(255) NOT NULL, 
                last_name VARCHAR(255) NOT NULL, 
                email VARCHAR(255) NOT NULL, 
                UNIQUE INDEX email_itn_un (email), 
                PRIMARY KEY(id)
            ) 
                DEFAULT CHARACTER SET utf8mb4 
                COLLATE `utf8mb4_unicode_ci` 
                ENGINE = InnoDB'
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql(sql: 'DROP TABLE user');
    }
}
