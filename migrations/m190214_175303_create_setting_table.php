<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%setting}}`.
 */
class m190214_175303_create_setting_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%setting}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'value' => $this->integer()->notNull(),
        ]);

        Yii::$app->db->createCommand()->batchInsert('setting', ['name', 'value'], [
            ['Денежный лимит', 1000],
            ['Лимит товаров', 10],
            ['Курс обмена', 100],
        ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%setting}}');
    }
}
