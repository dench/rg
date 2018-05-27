<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "eng_world".
 *
 * @property integer $id
 * @property string $en
 * @property string $ru
 *
 * @property EngUnswer[] $engUnswers
 * @property Team[] $users
 */
class EngWorld extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eng_world';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['en', 'ru'], 'required'],
            [['en', 'ru'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('block', 'ID'),
            'en' => Yii::t('block', 'En'),
            'ru' => Yii::t('block', 'Ru'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEngUnswers()
    {
        return $this->hasMany(EngUnswer::className(), ['world_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(Team::className(), ['id' => 'user_id'])->viaTable('eng_unswer', ['world_id' => 'id']);
    }
}
