<?php

use yii\db\Migration;

class m180710_085244_create_table_notification extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%notification}}', [
            'id' => $this->primaryKey(),
            'message' => $this->string(),
            'type' => $this->integer(),
            'status' => $this->integer(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp(),
        ], $tableOptions);

        $this->execute($this->getNotificationSql());
  
    }

    public function down()
    {
        $this->dropTable('{{%notification}}');
    }

    public function getNotificationSql()
    {
        return "INSERT INTO `notification` VALUES (1, 'Shade T White is less than 100', 1, 1, '2018-01-14 10:56:57', '2018-06-17 13:36:49') ,
          (2, 'Shade Red is less than 100', 1, 1, '2018-01-14 10:57:39', '2018-06-17 13:36:27') ,
          (3, 'Shade T White is less than 50', 1, 1, '2018-01-14 11:00:49', '2018-06-17 13:36:41') ,
          (20, 'Shade D Purple is less than 50', 1, 1, '2018-01-14 16:03:11', '2018-06-17 13:35:37') ,
          (21, 'Shade D Purple is less than 50', 1, 1, '2018-01-16 01:34:46', NULL) ,
          (22, 'Shade Orange is less than 50', 1, 1, '2018-01-16 01:34:55', '2018-06-17 13:35:39') ,
          (23, 'Shade P Green is less than 50', 1, 1, '2018-01-16 01:35:08', NULL) ,
          (24, 'Shade Black is less than 100', 1, 1, '2018-01-16 01:35:42', '2018-06-17 13:35:40') ,
          (25, 'Shade Black is less than 100', 1, 1, '2018-01-20 00:57:22', NULL) ;

          ";

    }
}
