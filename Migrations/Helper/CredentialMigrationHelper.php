<?php

/*
 * This file is part of the WebStudioBundle project.
 *
 * (c) AmaxLab 2017 <http://www.amaxlab.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AmaxLab\Oro\WebStudioBundle\Migrations\Helper;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\Table;

/**
 * @author Egor Zyuskin <ezyuskin@amaxlab.ru>
 */
class CredentialMigrationHelper
{
    /**
     * @param Table  $table
     * @param Schema $schema
     */
    public static function up(Table $table, Schema $schema)
    {
        $table->addColumn('id', 'integer', ['autoincrement' => true]);
        $table->addColumn('username', 'string', ['length' => 255, 'notnull' => false]);
        $table->addColumn('password', 'string', ['length' => 255, 'notnull' => false]);
        $table->addColumn('comment', 'text', ['notnull' => false]);
        $table->addColumn('expired_at', 'date', ['notnull' => false]);
        $table->addColumn('business_unit_owner_id', 'integer', ['notnull' => false]);
        $table->addColumn('organization_id', 'integer', ['notnull' => false]);
        $table->addColumn('created_at', 'datetime');
        $table->addColumn('updated_at', 'datetime');

        $table->addIndex(['business_unit_owner_id']);
        $table->addIndex(['organization_id']);

        $table->addForeignKeyConstraint($schema->getTable('oro_business_unit'), ['business_unit_owner_id'], ['id'], ['onDelete' => 'SET NULL', 'onUpdate' => null]);
        $table->addForeignKeyConstraint($schema->getTable('oro_organization'), ['organization_id'], ['id'], ['onDelete' => 'SET NULL', 'onUpdate' => null]);

        $table->setPrimaryKey(['id']);
    }
}
