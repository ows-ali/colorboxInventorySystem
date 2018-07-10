<?php

use yii\db\Migration;

class m180710_085244_create_table_salesman_profile extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%salesman_profile}}', [
            'salesman_id' => $this->primaryKey(),
            'salesman_name' => $this->string()->notNull(),
            'phone_number' => $this->bigInteger(),
            'address' => $this->text(),
            'joining_date' => $this->date(),
        ], $tableOptions);
        $this->execute($this->getSalesmanSql());
    }

    public function down()
    {
        $this->dropTable('{{%salesman_profile}}');
    }

    public function getSalesmanSql()
    {
        return "INSERT INTO `salesman_profile` VALUES (1, 'Salesman 1', 123456789, 'Some Address Here', '2017-08-23');
            INSERT INTO `salesman_profile` VALUES (2, 'Salesman 2', 567891011, 'Some Address 2 here', '2017-08-29');
            INSERT INTO `salesman_profile` VALUES (3, 'Salesman 3', 999999999, 'Some Address 3 here', '2017-08-30');


        ";
    }
}
