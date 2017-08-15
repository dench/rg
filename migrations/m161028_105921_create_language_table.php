<?php

use yii\db\Migration;

/**
 * Handles the creation of table `language`.
 */
class m161028_105921_create_language_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';

        $this->createTable('language', [
            'id' => $this->string(3)->notNull(),
            'name' => $this->string(31)->notNull(),
            'position' => $this->smallInteger()->defaultValue(0),
            'enabled' => $this->boolean()->notNull()->defaultValue(1)
        ], $tableOptions);

        $this->addPrimaryKey('id', 'language', 'id');

        $this->batchInsert('language', ['id', 'name', 'position'], [
            ['en', 'English', 1],
            ['de', 'Deutsch', 2],
            ['es', 'Español', 3],
            ['fr', 'Français', 4],
            ['pt', 'Português', 5],
            ['it', 'Italiano', 6],
            ['pl', 'Polski', 7],
            ['ru', 'Русский', 8],
            ['uk', 'Український', 9],
            ['zh', '中文', 10], // Китайский
            ['ja', '日本語', 11], // Японский
            ['ko', '한국어', 12], // Корейский
            ['ar', 'العربية', 13] // Арабский
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('language');
    }
}
