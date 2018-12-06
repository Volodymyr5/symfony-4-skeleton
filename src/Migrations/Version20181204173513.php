<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181204173513 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64968CEAEEE');
        $this->addSql('DROP INDEX UNIQ_8D93D64968CEAEEE ON user');
        $this->addSql('ALTER TABLE user CHANGE presonal_data_id personal_data_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B4D2A817 FOREIGN KEY (personal_data_id) REFERENCES user_personal_data (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649B4D2A817 ON user (personal_data_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B4D2A817');
        $this->addSql('DROP INDEX UNIQ_8D93D649B4D2A817 ON user');
        $this->addSql('ALTER TABLE user CHANGE personal_data_id presonal_data_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64968CEAEEE FOREIGN KEY (presonal_data_id) REFERENCES user_personal_data (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D64968CEAEEE ON user (presonal_data_id)');
    }
}
