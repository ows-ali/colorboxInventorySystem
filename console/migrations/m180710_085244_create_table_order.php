<?php

use yii\db\Migration;

class m180710_085244_create_table_order extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%order}}', [
            'order_id' => $this->primaryKey()->unsigned(),
            'customer_id' => $this->integer()->unsigned(),
            'salesman_id' => $this->integer()->unsigned(),
            'order_date' => $this->date(),
            'status' => $this->string()->defaultValue('Pending'),
            'created_at' => $this->dateTime(),
            'approved_at' => $this->dateTime(),
            'delivered_at' => $this->dateTime(),
            'cancelled_at' => $this->dateTime(),
        ], $tableOptions);
        $this->execute($this->getOrderSql());
    }

    public function down()
    {
        $this->dropTable('{{%order}}');
    }

    public function getOrderSql()
    {
        return "INSERT INTO `order` VALUES (1, 3, 1, '2017-08-17', 'Approved', '2017-08-09 05:41:56', NULL, NULL, NULL),
         (2, 3, 1, '2017-08-26', 'Pending', '2017-08-09 05:48:14', NULL, NULL, NULL),
         (3, 3, 1, '2017-08-29', 'Pending', '2017-08-09 05:51:57', NULL, NULL, NULL),
         (4, 3, 1, '2017-10-25', 'Pending', '2017-08-13 22:36:25', NULL, NULL, NULL),
         (5, 3, 1, '2017-09-22', 'Approved', '2017-09-15 05:49:19', NULL, NULL, NULL),
         (6, 3, 1, '2017-10-25', 'Approved', '2017-09-15 06:31:37', NULL, NULL, NULL),
         (7, 3, 1, '2017-10-25', 'Pending', '2017-10-31 04:00:00', NULL, NULL, NULL),
         (8, 3, 1, '2017-10-25', 'Pending', '2017-10-31 04:40:24', NULL, NULL, NULL),
         (9, 3, 1, '2017-10-25', 'Pending', '2017-10-31 04:42:55', NULL, NULL, NULL),
         (10, 2, 1, '2017-10-08', 'Pending', '2017-10-31 05:09:51', NULL, NULL, NULL),
         (11, 2, 1, '2017-10-25', 'Approved', '2017-10-19 05:33:39', NULL, NULL, NULL),
         (12, 3, 1, '2017-10-25', 'Pending', '2018-01-08 04:48:24', NULL, NULL, NULL),
         (13, 3, 1, '2017-10-25', 'Pending', '2018-01-16 04:29:11', NULL, NULL, NULL),
         (14, 2, 1, '2018-01-31', 'Approved', '2018-01-20 03:36:54', NULL, NULL, NULL),
         (15, 3, 1, '2018-01-24', 'Pending', '2018-01-20 03:47:00', NULL, NULL, NULL),
         (16, 3, 1, '2017-10-25', 'Pending', '2018-01-20 03:49:55', NULL, NULL, NULL),
         (17, 3, 1, '2018-01-25', 'Approved', '2018-01-20 03:51:40', NULL, NULL, NULL),
         (18, 3, 1, '2018-01-24', 'Pending', '2018-01-20 03:57:22', NULL, NULL, NULL)";
    }
}
