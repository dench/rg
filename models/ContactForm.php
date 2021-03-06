<?php

namespace app\models;

use himiklab\yii2\recaptcha\ReCaptchaValidator;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $reCaptcha;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            [['reCaptcha'], ReCaptchaValidator::className(), 'uncheckedMessage' => Yii::t('app','Please confirm that you are not a bot.')],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'reCaptcha' => Yii::t('app', 'Verification'),
            'name' => Yii::t('app','Your name'),
            'email' => Yii::t('app','Your E-mail'),
            'body' => Yii::t('app','Text'),
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @return bool whether the model passes validation
     */
    public function contact()
    {
        if ($this->validate()) {
            Yii::$app->mailer->compose()
                ->setTo(Yii::$app->params['adminEmail'])
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setReplyTo([$this->email => $this->name])
                ->setSubject(Yii::$app->name . ' - ' . Yii::t('app', 'Contact us'))
                ->setTextBody($this->body)
                ->send();

            return true;
        }
        return false;
    }
}
