<?php

use yii\db\Migration;

class m180517_164119_create_english_tables extends Migration
{
    public function safeUp()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('eng_world', [
            'id' => $this->primaryKey(),
            'en' => $this->string()->notNull(),
            'ru' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createTable('eng_unswer', [
            'world_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'correct' => $this->integer()->notNull(),
            'wrong' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->addPrimaryKey('pk-unswer', 'eng_unswer', ['world_id', 'user_id']);

        $this->addForeignKey('fk-eng_unswer-world_id', 'eng_unswer', 'world_id', 'eng_world', 'id', 'CASCADE');

        $this->addForeignKey('fk-eng_unswer-user_id', 'eng_unswer', 'user_id', 'team', 'id', 'CASCADE');
    }

    public function safeDown()
    {
        $this->dropForeignKey('fk-eng_unswer-world_id', 'eng_unswer');

        $this->dropForeignKey('fk-eng_unswer-user_id', 'eng_unswer');

        $this->dropTable('eng_unswer');

        $this->dropTable('eng_world');
    }
}
