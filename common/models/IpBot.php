<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ip_bot".
 *
 * @property int $id
 * @property string|null $ip
 * @property string|null $isp
 * @property int|null $blocking
 * @property string|null $comment
 */
class IpBot extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ip_bot';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['blocking'], 'integer'],
            [['ip'], 'string', 'max' => 20],
            [['isp', 'comment'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'Ip',
            'isp' => 'Isp',
            'blocking' => 'Blocking',
            'comment' => 'Comment',
        ];
    }
}
