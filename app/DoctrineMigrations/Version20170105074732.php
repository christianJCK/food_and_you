<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170105074732 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE baptem_has_user ADD baptem_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE baptem_has_user ADD CONSTRAINT FK_AC9DB6A7F5984994 FOREIGN KEY (baptem_id) REFERENCES baptem (id)');
        $this->addSql('CREATE INDEX IDX_AC9DB6A7F5984994 ON baptem_has_user (baptem_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE baptem_has_user DROP FOREIGN KEY FK_AC9DB6A7F5984994');
        $this->addSql('DROP INDEX IDX_AC9DB6A7F5984994 ON baptem_has_user');
        $this->addSql('ALTER TABLE baptem_has_user DROP baptem_id');
    }
}
