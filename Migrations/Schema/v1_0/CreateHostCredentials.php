<?php

/*
 * This file is part of the WebStudioBundle project.
 *
 * (c) AmaxLab 2017 <http://www.amaxlab.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AmaxLab\Oro\WebStudioBundle\Migrations\Schema\v1_0;

use AmaxLab\Oro\WebStudioBundle\Migrations\Helper\CredentialMigrationHelper;
use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\OrderedMigrationInterface;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 */
class CreateHostCredentials implements Migration, OrderedMigrationInterface
{
    /**
     * @param Schema   $schema
     * @param QueryBag $queries
     *
     * @return void
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $table = $schema->createTable('web_studio_host_credential');

        CredentialMigrationHelper::up($table, $schema);

        $table->addColumn('host_id', 'integer', ['notnull' => true]);
        $table->addIndex(['host_id']);
        $table->addForeignKeyConstraint($schema->getTable('web_studio_host'), ['host_id'], ['id'], ['onDelete' => 'CASCADE', 'onUpdate' => null]);
    }

    /**
     * @return integer
     */
    public function getOrder()
    {
        return 73;
    }
}
