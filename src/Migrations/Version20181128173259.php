<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181128173259 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_personal_data ADD fb_id VARCHAR(255) DEFAULT NULL, ADD fb_firstname VARCHAR(255) DEFAULT NULL, ADD fb_lastname VARCHAR(255) DEFAULT NULL, ADD fb_email VARCHAR(255) DEFAULT NULL, ADD fb_hometown VARCHAR(255) DEFAULT NULL, ADD fb_image LONGBLOB DEFAULT NULL, ADD fb_cover_photo LONGBLOB DEFAULT NULL, ADD fb_gender VARCHAR(64) DEFAULT NULL, ADD fb_locale VARCHAR(64) DEFAULT NULL, ADD fb_profile_link VARCHAR(1024) DEFAULT NULL, ADD fb_timezone INT DEFAULT NULL, ADD fb_min_age INT DEFAULT NULL, ADD fb_max_age INT DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user_personal_data DROP fb_id, DROP fb_firstname, DROP fb_lastname, DROP fb_email, DROP fb_hometown, DROP fb_image, DROP fb_cover_photo, DROP fb_gender, DROP fb_locale, DROP fb_profile_link, DROP fb_timezone, DROP fb_min_age, DROP fb_max_age');
    }
}
