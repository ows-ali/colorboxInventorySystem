<?php

use yii\db\Migration;

class m180710_085245_create_table_user extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'username' => $this->string()->notNull(),
            'auth_key' => $this->string()->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'email' => $this->string()->notNull(),
            'role' => $this->string()->notNull()->defaultValue('user'),
            'status' => $this->smallInteger()->notNull()->defaultValue('10'),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->createIndex('created_at', '{{%user}}', 'created_at');
        $this->createIndex('role', '{{%user}}', 'role');
        $this->createIndex('status', '{{%user}}', 'status');
        $this->createIndex('username', '{{%user}}', 'username', true);


        $this->execute($this->getUsersSql());


    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }


    private function getUsersSql()
    {
        $time = time();
        $password_hash1 = Yii::$app->getSecurity()->generatePasswordHash('admin');
        $password_hash2 = Yii::$app->getSecurity()->generatePasswordHash('order_operator');
        $password_hash3 = Yii::$app->getSecurity()->generatePasswordHash('inventory_operator');

        $auth_key1 = Yii::$app->security->generateRandomString();
        $auth_key2 = Yii::$app->security->generateRandomString();
        $auth_key3 = Yii::$app->security->generateRandomString();

        return "INSERT INTO {{%user}} (`name`, `username`, `email`, `auth_key`, `password_hash`, `password_reset_token`, `role`, `status`, `created_at`, `updated_at`)
                VALUES  ('Admin', 'admin', 'admin@demo.com', '$auth_key1', '$password_hash1', '', 'admin', 1, $time, $time),
                        ('Order Operator', 'order_operator', 'admin@demo.com', '$auth_key2', '$password_hash2', '', 'user', 1, $time, $time),
                        ('Inventory Operator', 'inventory_operator', 'admin@demo.com', '$auth_key3', '$password_hash3', '', 'user', 1, $time, $time)
                
                ";
    }

}
