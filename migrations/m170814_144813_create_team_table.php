<?php

use yii\db\Migration;

/**
 * Handles the creation of table `team`.
 */
class m170814_144813_create_team_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('team', [
            'id' => $this->primaryKey(),
            'image_id' => $this->integer(),
            'position' => $this->integer()->notNull()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(1),
        ], $tableOptions);

        $this->createTable('team_lang', [
            'team_id' => $this->integer()->notNull(),
            'lang_id' => $this->string(3)->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->string(),
        ], $tableOptions);

        $this->addForeignKey('fk-team-image_id', 'team', 'image_id', 'image', 'id', 'CASCADE');

        $this->addPrimaryKey('pk_team_lang', 'team_lang', ['team_id', 'lang_id']);

        $this->addForeignKey('fk-team_lang-team_id', 'team_lang', 'team_id', 'team', 'id', 'CASCADE');

        $this->addForeignKey('fk-team_lang-lang_id', 'team_lang', 'lang_id', 'language', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-team_lang-lang_id', 'team_lang');

        $this->dropForeignKey('fk-team_lang-team_id', 'team_lang');

        $this->dropPrimaryKey('pk_team_lang', 'team_lang');

        $this->dropForeignKey('fk-team-image_id', 'team');

        $this->dropTable('team_lang');

        $this->dropTable('team');
    }
}
