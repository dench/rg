<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "eng_unswer".
 *
 * @property integer $world_id
 * @property integer $user_id
 * @property integer $correct
 * @property integer $wrong
 *
 * @property Team $user
 * @property EngWorld $world
 */
class EngUnswer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'eng_unswer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['world_id', 'user_id', 'correct', 'wrong'], 'required'],
            [['world_id', 'user_id', 'correct', 'wrong'], 'integer'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Team::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['world_id'], 'exist', 'skipOnError' => true, 'targetClass' => EngWorld::className(), 'targetAttribute' => ['world_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'world_id' => Yii::t('block', 'World ID'),
            'user_id' => Yii::t('block', 'User ID'),
            'correct' => Yii::t('block', 'Correct'),
            'wrong' => Yii::t('block', 'Wrong'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Team::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorld()
    {
        return $this->hasOne(EngWorld::className(), ['id' => 'world_id']);
    }
}
