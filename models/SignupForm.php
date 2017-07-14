<?php
namespace app\models;

use yii\base\Model;
use app\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $name;
    public $email;
    public $password;
    public $repassword;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['name', 'trim'],
            [['name', 'password'], 'required'],
            ['name', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Это имя уже существует.'],
            ['name', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Этот email уже существует.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6, 'max' => 30],
            ['repassword', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    /**
     * Группировка свойств 
    */
    public function scenarios()
    {
        $scenarios = parent::scenarios();
        // $scenarios['short_register'] = ['name', 'email'];
        // $scenarios['short_register2'] = ['name', 'email', 'password'];

        return $scenarios;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->setPassword($this->password);
        // $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
