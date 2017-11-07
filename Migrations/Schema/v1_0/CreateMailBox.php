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

use Doctrine\DBAL\Schema\Schema;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\OrderedMigrationInterface;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 */
class CreateMailBox implements Migration, OrderedMigrationInterface
{
    /**
     * @param Schema   $schema
     * @param QueryBag $queries
     *
     * @return void
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        $table = $schema->createTable('web_studio_mail_box');

        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('name', 'string', ['length' => 255, 'notnull' => true]);
        $table->addColumn('password', 'string', ['length' => 255, 'notnull' => true]);
        $table->addColumn('domain_id', 'integer', ['notnull' => true]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime');
        $table->addColumn('updated_at', 'datetime');

        $table->addIndex(['domain_id']);
        $table->addIndex(['business_unit_owner_id']);
        $table->addIndex(['organization_id']);

        $table->addForeignKeyConstraint($schema->getTable('web_studio_domain'), ['domain_id'], ['id'], ['onDelete' => 'restrict', 'onUpdate' => null]);
        $table->addForeignKeyConstraint($schema->getTable('oro_business_unit'), ['business_unit_owner_id'], ['id'], ['onDelete' => 'SET NULL', 'onUpdate' => null]);
        $table->addForeignKeyConstraint($schema->getTable('oro_organization'), ['organization_id'], ['id'], ['onDelete' => 'SET NULL', 'onUpdate' => null]);

        $table->setPrimaryKey(['id']);
    }

    /**
     * @return integer
     */
    public function getOrder()
    {
        return 40;
    }
}
