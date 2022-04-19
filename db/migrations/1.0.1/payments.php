<?php

use Phalcon\Db\Column;
use Phalcon\Db\Exception;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Migrations\Mvc\Model\Migration;

/**
 * Class PaymentsMigration_101
 */
class PaymentsMigration_101 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     * @throws Exception
     */
    public function morph(): void
    {
        $this->morphTable('payments', [
            'columns' => [
                new Column(
                    'id',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 1,
                        'first' => true
                    ]
                ),
                new Column(
                    'hashCode',
                    [
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 150,
                        'after' => 'id'
                    ]
                ),
                new Column(
                    'status',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'hashCode'
                    ]
                ),
                new Column(
                    'active',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'default' => "1",
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'status'
                    ]
                ),
                new Column(
                    'paymentMethodID',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'active'
                    ]
                ),
                new Column(
                    'paymentTypeID',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'paymentMethodID'
                    ]
                ),
                new Column(
                    'orderID',
                    [
                        'type' => Column::TYPE_INTEGER,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'paymentTypeID'
                    ]
                ),
                new Column(
                    'createdAt',
                    [
                        'type' => Column::TYPE_TIMESTAMP,
                        'default' => "CURRENT_TIMESTAMP",
                        'notNull' => true,
                        'after' => 'orderID'
                    ]
                ),
                new Column(
                    'modifiedAt',
                    [
                        'type' => Column::TYPE_TIMESTAMP,
                        'default' => "CURRENT_TIMESTAMP",
                        'notNull' => true,
                        'after' => 'createdAt'
                    ]
                ),
            ],
            'indexes' => [
                new Index('PRIMARY', ['id'], 'PRIMARY'),
                new Index('fk_payments_payment_method_id_idx', ['paymentMethodID'], ''),
                new Index('fk_payments_payment_type_id_idx', ['paymentTypeID'], ''),
                new Index('fk_payments_order_id_idx', ['orderID'], ''),
            ],
            'references' => [
                new Reference(
                    'fk_payments_orders_id',
                    [
                        'referencedSchema' => 'cms_phalcon',
                        'referencedTable' => 'orders',
                        'columns' => ['orderID'],
                        'referencedColumns' => ['id'],
                        'onUpdate' => 'NO ACTION',
                        'onDelete' => 'NO ACTION'
                    ]
                ),
                new Reference(
                    'fk_payments_payment_method_id',
                    [
                        'referencedSchema' => 'cms_phalcon',
                        'referencedTable' => 'payment_method',
                        'columns' => ['paymentMethodID'],
                        'referencedColumns' => ['id'],
                        'onUpdate' => 'NO ACTION',
                        'onDelete' => 'NO ACTION'
                    ]
                ),
                new Reference(
                    'fk_payments_payment_type_id',
                    [
                        'referencedSchema' => 'cms_phalcon',
                        'referencedTable' => 'payment_type',
                        'columns' => ['paymentTypeID'],
                        'referencedColumns' => ['id'],
                        'onUpdate' => 'NO ACTION',
                        'onDelete' => 'NO ACTION'
                    ]
                ),
            ],
            'options' => [
                'TABLE_TYPE' => 'BASE TABLE',
                'AUTO_INCREMENT' => '12',
                'ENGINE' => 'InnoDB',
                'TABLE_COLLATION' => 'utf8mb4_0900_ai_ci',
            ],
        ]);
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up(): void
    {
    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down(): void
    {
    }
}
