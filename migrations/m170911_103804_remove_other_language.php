<?php

use yii\db\Migration;

class m170911_103804_remove_other_language extends Migration
{
    public function safeUp()
    {
        $this->delete('language', ['!=', 'id', 'en']);
    }

    public function safeDown()
    {
        echo "m170911_103804_remove_other_language cannot be reverted.\n";

        return false;
    }
}
