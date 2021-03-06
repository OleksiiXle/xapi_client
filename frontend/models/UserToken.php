<?php

namespace frontend\models;

use common\models\MainModel;
use common\models\User;
use Yii;

/**
 * This is the model class for table "user_token".
 *
 * @property int $id
 * @property int $client_id Пользователь CMS
 * @property int $api_id Пользователь API
 * @property string $provider Провайдер
 * @property string $tokenParamKey
 * @property string $tokenSecretParamKey
 * @property string $access_token
 * @property string $expires_in
 * @property string $token_type
 * @property string $scope
 * @property string $refresh_token
 * @property int $created_at
 *
 * @property User $client
 */
class UserToken extends MainModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'api_id', 'provider', 'tokenParamKey', 'tokenSecretParamKey', 'access_token', 'expires_in', 'token_type', 'refresh_token', 'created_at'], 'required'],
            [['client_id', 'api_id', 'created_at'], 'integer'],
            [['provider'], 'string', 'max' => 50],
            [['tokenParamKey', 'tokenSecretParamKey', 'access_token',  'token_type', 'scope', 'refresh_token'], 'string', 'max' => 255],
            [['client_id', 'api_id', 'provider'], 'unique', 'targetAttribute' => ['client_id', 'api_id', 'provider']],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'client_id' => Yii::t('app', 'Client ID'),
            'api_id' => Yii::t('app', 'Api ID'),
            'provider' => Yii::t('app', 'Provider'),
            'tokenParamKey' => Yii::t('app', 'Token Param Key'),
            'tokenSecretParamKey' => Yii::t('app', 'Token Secret Param Key'),
            'access_token' => Yii::t('app', 'Access Token'),
            'expires_in' => Yii::t('app', 'Expires In'),
            'token_type' => Yii::t('app', 'Token Type'),
            'scope' => Yii::t('app', 'Scope'),
            'refresh_token' => Yii::t('app', 'Refresh Token'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'client_id']);
    }
}
