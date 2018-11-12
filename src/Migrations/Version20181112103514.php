<?php declare(strict_types=1);

namespace Nugato\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181112103514 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nucms_taxon ADD image INT DEFAULT NULL');
        $this->addSql('ALTER TABLE nucms_taxon ADD CONSTRAINT FK_EA58EE27C53D045F FOREIGN KEY (image) REFERENCES nucms_file (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_EA58EE27C53D045F ON nucms_taxon (image)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE nucms_taxon DROP FOREIGN KEY FK_EA58EE27C53D045F');
        $this->addSql('DROP INDEX IDX_EA58EE27C53D045F ON nucms_taxon');
        $this->addSql('ALTER TABLE nucms_taxon DROP image');
    }
}
