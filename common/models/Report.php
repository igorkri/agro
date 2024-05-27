<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "report".
 *
 * @property int $id
 * @property string|null $platform
 * @property string|null $number_order
 * @property string|null $date_order
 * @property string|null $date_delivery
 * @property string|null $number_order_1c
 * @property string|null $date_payment
 * @property int|null $price_delivery
 * @property string|null $type_payment
 * @property string|null $fio
 * @property string|null $tel_number
 * @property string|null $address
 * @property string|null $comments
 * @property string|null $delivery_service
 * @property string|null $ttn
 * @property int|null $order_status_id
 * @property int|null $order_pay_ment_id
 */
class Report extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'report';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_status_id', 'order_pay_ment_id'], 'string', 'max' => 20],
            [['price_delivery'], 'number'],
            [['platform', 'number_order', 'date_order', 'date_delivery', 'number_order_1c', 'date_payment', 'type_payment', 'delivery_service'], 'string', 'max' => 50],
            [['fio', 'address', 'comments'], 'string', 'max' => 255],
            [['tel_number'], 'string', 'max' => 20],
            [['ttn'], 'string', 'max' => 100],
            ['tel_number', 'match', 'pattern' => '/^\+38\(\d{3}\)\d{3} \d{4}$/', 'message' => 'Номер не корректный.'],
        ];
    }

    /**
     * Gets query for [[ReportItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReportItems()
    {
        return $this->hasMany(ReportItem::class, ['order_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'platform' => Yii::t('app', 'Platform'),
            'number_order' => Yii::t('app', 'Number Order'),
            'date_order' => Yii::t('app', 'Date Order'),
            'date_delivery' => Yii::t('app', 'Date Delivery'),
            'number_order_1c' => Yii::t('app', 'Number Order 1c'),
            'date_payment' => Yii::t('app', 'Date Payment'),
            'price_delivery' => Yii::t('app', 'Price Delivery'),
            'type_payment' => Yii::t('app', 'Type Payment'),
            'fio' => Yii::t('app', 'Fio'),
            'tel_number' => Yii::t('app', 'Tel Number'),
            'address' => Yii::t('app', 'Address'),
            'comments' => Yii::t('app', 'Comments'),
            'delivery_service' => Yii::t('app', 'Delivery Service'),
            'ttn' => Yii::t('app', 'Ttn'),
            'order_status_id' => Yii::t('app', 'Order Status ID'),
            'order_pay_ment_id' => Yii::t('app', 'Order Pay Ment ID'),
        ];
    }

    public function getTotalSumm($report_id)
    {
        $order = Report::find()->with('reportItems')->where(['id' => $report_id])->one();
        if ($order->order_status_id != 'Повернення') {
            $total_res = [];
            foreach ($order->reportItems as $orderItem) {
                $total_res[] = $orderItem->price * $orderItem->quantity;
            }
            return array_sum($total_res);
        } else {
            if ($order->price_delivery) {
                return $order->price_delivery;
            } else {
                return 0;
            }
        }
    }

    public function getCountOrders($phone)
    {
        if ($phone) {
            return Report::find()->where(['tel_number' => $phone])->count();
        }
        return 1;
    }

    public function getExecutionStatus($order_status)
    {
        switch ($order_status) {

            case 'Доставляється':
                $status = '<span class="badge me-2" style="background-color: rgba(249,115,4,0.84)">' . $order_status . '</span>';
                break;
            case 'Відміна':
                $status = '<span class="badge badge-sa-secondary me-2">' . $order_status . '</span>';
                break;
            case 'Повернення':
                $status = '<span class="badge badge-sa-danger me-2">' . $order_status . '</span>';
                break;
            case 'Комплектується':
                $status = '<span class="badge badge-sa-warning me-2">' . $order_status . '</span>';
                break;
            case 'Одержано':
                $status = '<span class="badge badge-sa-success me-2">' . $order_status . '</span>';
                break;
            case 'Очікується':
                $status = '<span class="badge badge-sa-info me-2">' . $order_status . '</span>';
                break;
            default;
                $status = '<span class="badge badge-sa-dark me-2">' . 'Відсутній' . '</span>';
                break;
        }

        return $status;
    }

    public function getPayMentStatus($order_status): string
    {
        switch ($order_status) {

            case 'Не оплачено':
                $status = '<span class="badge badge-sa-danger me-2">' . $order_status . '</span>';
                break;
            case 'Оплачено':
                $status = '<span class="badge badge-sa-success me-2">' . $order_status . '</span>';
                break;
            default;
                $status = '<span class="badge badge-sa-dark me-2">' . 'Відсутній' . '</span>';
                break;
        }

        return $status;
    }

    public function getPackage($id)
    {
        $query = ReportItem::find()->select('package')->where(['order_id' => $id]);
        $packages = $query->column();

        $uniquePackages = array_unique($packages);
        $count = count($uniquePackages);

        if ($count === 1) {
            return $uniquePackages[0] == 'BIG' ? 'Фермерська' : 'Дрібна';
        } else {
            return 'Фермерська + Дрібна';
        }
    }
}
