<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $lastname;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name','lastname', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
			'name'=>'Nombre:',
			'lastname'=>'Apellido:',
			'email'=>'Correo Electrónico:',
			'subject'=>'Asunto:',
			'body'=>'Mensaje del correo:',
            'verifyCode' => 'Código de verificación',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param string $email the target email address
     * @return bool whether the model passes validation
     */
    public function contact($email)
    {
        if ($this->validate()) {
			$xbody='Nombre: '.$this->name.' '.$this->lastname;
			$xbody.="\n";
			$xbody.="Correo: ".$this->email;
			$xbody.="\n";
			$xbody.="Mensaje: ".$this->body;
            Yii::$app->mailer->compose()
                ->setTo($email)
                ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
                ->setReplyTo([$this->email => $this->name.' '.$this->lastname])
                ->setSubject($this->subject)
                ->setTextBody($xbody)
                ->send();

            return true;
        }
        return false;
    }
}
