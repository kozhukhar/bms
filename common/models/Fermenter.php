<?php
/**
 * Created by PhpStorm.
 * User: mitron
 * Date: 2025-08-23
 * Time: 14:36
 */

namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Fermenter model
 *
 * @property integer $id
 * @property string $name
 * @property integer $maxvolume
 * @property integer $status
 */
class Fermenter extends Model
{
    public $id;
    public $name;
    public $maxvolume;
    public $status;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }
}