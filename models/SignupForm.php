<?php


namespace app\models;


use phpDocumentor\Reflection\Types\This;
use Yii;
use yii\base\Model;



class SignupForm extends Model
{
    public $name;
    public $email;
    public $password;

    public function rules()
    {
        return[
        [['name','email','password'],'required'],
        [['name'],'string'],
        [['email'],'email'],
        [['email'],'unique', 'targetClass'=>'app\models\User','targetAttribute'=>'email'],
        [['password'],'string', 'max' => 10],
            ];
    }

    public function signup()
    {

        if ($this->validate())
        {
            $hash = Yii::$app->getSecurity()->generatePasswordHash($this->password);
            $this->password = $hash;

            $user = new User();
            $user->attributes = $this->attributes;
            return $user->create();
        }
    }


}