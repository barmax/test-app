<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%gift}}`.
 */
class m190214_135740_create_gift_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%gift}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'min_value' => $this->integer()->notNull()->defaultValue(1),
            'max_value' => $this->integer()->notNull(),
        ]);

        Yii::$app->db->createCommand()->batchInsert('gift', ['name', 'min_value', 'max_value'], [
            ['Деньги', 1, 100],
            ['Товар', 1, 1],
            ['Баллы', 1, 100],
        ])->execute();
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%gift}}');
    }
}
