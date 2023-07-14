<?php

namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Rename node names in neos_contentrepository_domain_model_nodedata
 */
class Version20161125125004 extends AbstractMigration
{
    /**
     * @param Schema $schema
     * @return void
     */
    public function up(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on "postgresql".');

        $schemaManager = $this->connection->getSchemaManager();
        $hasTables = $schemaManager->tablesExist(['neos_contentrepository_domain_model_nodedata']);
        if ($hasTables) {
            $this->addSql("UPDATE neos_contentrepository_domain_model_nodedata SET nodetype=REPLACE(nodetype, 'TYPO3.Neos.NodeTypes:', 'Neos.NodeTypes:')");
        }
    }

    /**
     * @param Schema $schema
     * @return void
     */
    public function down(Schema $schema): void
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on "postgresql".');

        $schemaManager = $this->connection->getSchemaManager();
        $hasTables = $schemaManager->tablesExist(['neos_contentrepository_domain_model_nodedata']);
        if ($hasTables) {
            $this->addSql("UPDATE neos_contentrepository_domain_model_nodedata SET nodetype=REPLACE(nodetype, 'Neos.NodeTypes:', 'TYPO3.Neos.NodeTypes:')");
        }
    }
}
