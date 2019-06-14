<?php

namespace app\models;

class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    
    public static function tableName()
    {
        return 'usuarios';
    }
    
    public function rules()
    {
        return [
        ];
    }
    
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['usuario' => $username]);
    }
    

     /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    
    /*public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }*/
    
    
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
    
     /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return null;
    }
    
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }
    
}
