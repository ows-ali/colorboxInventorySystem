<?php

use yii\db\Migration;

class m180710_085244_create_table_orderprocess extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%orderprocess}}', [
            'orderprocess_id' => $this->primaryKey()->unsigned(),
            'orderprocess' => $this->string(),
            'nextprocess_id' => $this->integer()->unsigned(),
            'status' => $this->string()->defaultValue('1'),
            'created_at' => $this->dateTime(),
        ], $tableOptions);
        $this->execute($this->getOrderProcessSql());
    }

    public function down()
    {
        $this->dropTable('{{%orderprocess}}');
    }

    public function getOrderProcessSql()
    {
        return "INSERT INTO `orderprocess` VALUES (1, 'Pending', 2, '1', NULL);
            INSERT INTO `orderprocess` VALUES (2, 'Approved', 3, '1', NULL);
            INSERT INTO `orderprocess` VALUES (3, 'Sent', NULL, '1', NULL);
            INSERT INTO `orderprocess` VALUES (4, 'Cancel', NULL, '1', NULL);
            ";
    }
}
