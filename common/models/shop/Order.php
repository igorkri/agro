<?php

namespace common\models\shop;

use common\models\OrderPayMent;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int|null $created_at Дата створення
 * @property int|null $updated_at Дата оновлення
 * @property int|null $order_status_id Статус
 * @property int|null $order_pay_ment_id Статус оплати
 * @property string|null $fio ПІБ
 * @property string|null $phone Телефон
 * @property string|null $city Город
 * @property string|null $note Примітка
 *
 * @property OrderItem[] $orderItems
 * @property OrderStatus $orderStatus
 * @property OrderPayMent $orderPayMent
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'phone', 'city'], 'required'],
            [['created_at', 'updated_at', 'order_status_id', 'order_pay_ment_id'], 'integer'],
            [['fio', 'phone', 'city'], 'string', 'max' => 255],
            [['note'], 'string'],
            [['order_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderStatus::class, 'targetAttribute' => ['order_status_id' => 'id']],
            [['order_pay_ment_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderPayMent::class, 'targetAttribute' => ['order_pay_ment_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Дата створення',
            'updated_at' => 'Дата оновлення',
            'order_status_id' => 'Статус',
            'order_pay_ment_id' => 'Статус оплати',
            'fio' => 'ПІБ',
            'phone' => 'Телефон',
            'city' => 'Місто',
            'note' => 'Дані для відправки (коментар)',
        ];
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id']);
    }

    /**
     * Gets query for [[OrderStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderStatus()
    {
        return $this->hasOne(OrderStatus::class, ['id' => 'order_status_id']);
    }

    public function getOrderPayMent()
    {
        return $this->hasOne(OrderPayMent::class, ['id' => 'order_pay_ment_id']);
    }

    public function getTotalSumm($order_id){
        $order = Order::find()->with('orderItems')->where(['id' => $order_id])->one();
        $total_res = [];
        foreach ($order->orderItems as $orderItem){
            $total_res[] = $orderItem->price * $orderItem->quantity;
        }
        return array_sum($total_res);
    }

    public function getTotalQty($order_id){
        $order = Order::find()->with('orderItems')->where(['id' => $order_id])->one();
        $total_res = [];
        foreach ($order->orderItems as $orderItem){
            $total_res[] = $orderItem->quantity;
        }
        return array_sum($total_res);
    }

    public function getPayMent($order_id){
        $order = Order::find()->with('orderPayMent')->where(['id' => $order_id])->one();
        $status = '<span class="badge badge-sa-dark me-2">Не відомо</span>';
        if($order->order_pay_ment_id != null){
            switch ($order->order_pay_ment_id) {
                case 1:
                    $status = '<span class="badge badge-sa-danger me-2">'. $order->orderPayMent->name .'</span>';
                    break;
                case 2:
                    $status = '<span class="badge badge-sa-warning me-2">'. $order->orderPayMent->name .'</span>';
                    break;
                case 3:
                    $status = '<span class="badge badge-sa-success me-2">'. $order->orderPayMent->name .'</span>';
                    break;
                default;
                    $status = '<span class="badge badge-sa-info me-2">'. $order->orderPayMent->name .'</span>';
                    break;
            }
        }
        return $status;
    }

    public function getExecutionStatus($order_id){
        $order = Order::find()->with('orderStatus')->where(['id' => $order_id])->one();
        $status = '<span class="badge badge-sa-primary me-2"> Новий <i class="fas fa-exclamation"> </i> <i class="fas fa-exclamation"> </i> <i class="fas fa-exclamation"> </i></span>';
        if($order->order_status_id != null){
            switch ($order->order_status_id) {
                case 1:
                    $status = '<span class="badge badge-sa-danger me-2">'. $order->orderStatus->name .'</span>';
                    break;
                case 2:
                    $status = '<span class="badge badge-sa-warning me-2">'. $order->orderStatus->name .'</span>';
                    break;
                case 3:
                    $status = '<span class="badge badge-sa-success me-2">'. $order->orderStatus->name .'</span>';
                    break;
                default;
                    $status = '<span class="badge badge-sa-info me-2">'. $order->orderStatus->name .'</span>';
                    break;
            }
        }
        return $status;
    }

    public function getOrderIncomeTotal($order_id){
        $order = Order::find()->with('orderItems')->where(['id' => $order_id])->one();
        $total_res = [];
        foreach ($order->orderItems as $orderItem){
            $total_res[] = intval($orderItem->price * $orderItem->quantity);
        }
        return array_sum($total_res);
    }

    public static function orderNews(){

        $orders = Order::find()->all();
        $total_res = [];
        foreach ($orders as $order){
            if ($order->order_status_id == null)
            $total_res[] = $order;
        }
        return count($total_res);
    }
}
