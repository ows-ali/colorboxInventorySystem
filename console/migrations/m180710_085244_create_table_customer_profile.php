<?php

use yii\db\Migration;

class m180710_085244_create_table_customer_profile extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%customer_profile}}', [
            'customer_id' => $this->primaryKey()->unsigned(),
            'customer_name' => $this->string(),
            'address' => $this->text(),
            'phone_number1' => $this->bigInteger()->unsigned(),
            'phone_number2' => $this->bigInteger(),
            'phone_number3' => $this->bigInteger(),
            'customer_type' => $this->string(),
            'description' => $this->text(),
            'status' => $this->string()->defaultValue('1'),
            'created_at' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
        ], $tableOptions);
        $this->execute($this->getCustomersSql());
    }

    public function down()
    {
        $this->dropTable('{{%customer_profile}}');
    }

    public function getCustomersSql()
    {
        return "INSERT INTO `customer_profile` VALUES (1, 'Customer Name', 'My address here', 211111111, NULL, NULL, 'shop', 'Some dummy description', '1', '2017-08-09 02:34:39'),
             (2, 'Second Customer', 'Some address here', 987654321, NULL, NULL, 'company', 'Random description', '1', '2017-08-15 21:31:41')";
    }

}
