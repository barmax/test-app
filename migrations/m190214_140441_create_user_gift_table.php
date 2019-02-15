<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_gift}}`.
 */
class m190214_140441_create_user_gift_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_gift}}', [
            'user_id' => $this->integer()->notNull(),
            'gift_id' => $this->integer()->notNull(),
            'gift_value' => $this->integer()->notNull(),
            'timestamp' => $this->timestamp(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_gift}}');
    }
}
