<?php

namespace common\models\shop;

use common\models\Settings;
use Yii;
use yii\db\ActiveRecord;
use yz\shoppingcart\CartPositionInterface;
use yz\shoppingcart\CartPositionTrait;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $brand_id
 * @property string $description
 * @property string $short_description
 * @property string $currency
 * @property float $price
 * @property float|null $old_price
 * @property string|null $seo_title
 * @property string|null $seo_description
 * @property int $status_id
 * @property int $category_id
 * @property int $label_id
 *
 * @property ProductTag[] $productTags
 * @property Tag[] $tags
 */
class Product extends ActiveRecord implements CartPositionInterface
{

    use CartPositionTrait;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
                'slugAttribute' => 'slug',
                'attribute' => 'name',
                // optional params
                'ensureUnique' => true,
                'replacement' => '-',
                'lowercase' => true,
                'immutable' => false,
                // If intl extension is enabled, see http://userguide.icu-project.org/transforms/general.
                'transliterateOptions' => 'Russian-Latin/BGN; Any-Latin; Latin-ASCII; NFD; [:Nonspacing Mark:] Remove; NFC;'
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'short_description', 'price', 'status_id', 'category_id'], 'required'],
            [['description', 'short_description', 'currency'], 'string'],
            [['price', 'old_price'], 'number'],
            [['status_id', 'category_id', 'label_id', 'brand_id'], 'safe'],
            [['name', 'seo_title', 'seo_description', 'slug'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'brand_id' => Yii::t('app', 'Brand'),
            'slug' => Yii::t('app', 'Slug'),
            'currency' => Yii::t('app', 'Currency'),
            'description' => Yii::t('app', 'Description'),
            'short_description' => Yii::t('app', 'Short Description'),
            'price' => Yii::t('app', 'Price'),
            'old_price' => Yii::t('app', 'Old Price'),
            'seo_title' => Yii::t('app', 'Seo Title'),
            'seo_description' => Yii::t('app', 'Seo Description'),
            'status_id' => Yii::t('app', 'Status'),
            'category_id' => Yii::t('app', 'Category'),
            'label_id' => Yii::t('app', 'Label'),
        ];
    }

    /**
     * Gets query for [[ProductTags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductTags()
    {
        return $this->hasMany(ProductTag::class, ['product_id' => 'id']);
    }


    /**
     * Gets query for [[ProductGrups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductGrups()
    {
        return $this->hasMany(ProductGrup::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Tags]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::class, ['id' => 'tag_id'])
            ->viaTable('product_tag', ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Grups]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrups()
    {
        return $this->hasMany(Grup::class, ['id' => 'grup_id'])
            ->viaTable('product_grup', ['product_id' => 'id']);
    }

    public function getTag()
    {
        return $this->hasOne(Tag::class, ['id' => 'id']);
    }

    public function getGrup()
    {
        return $this->hasOne(Grup::class, ['id' => 'id']);
    }

    public function getBrand()
    {
        return $this->hasOne(Brand::class, ['id' => 'brand_id']);
    }

    public function getProperties()
    {
        return $this->hasMany(ProductProperties::class, ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[Label]].
     *
     * @return \yii\db\ActiveQuery
     *
     */
    public function getLabel()
    {
        return $this->hasOne(Label::class, ['id' => 'label_id']);
    }

    /**
     * Gets query for [[ProductImage]].
     *
     * @return \yii\db\ActiveQuery
     *
     */
    public function getImages()
    {
        return $this->hasMany(ProductImage::class, ['product_id' => 'id']);
    }

    public function getReviews()
    {
        return $this->hasMany(Review::class, ['product_id' => 'id']);
    }

    public function getPrice()
    {
        if($this->currency === 'UAH'){
            return $this->price;
        }else{
            return floatval($this->price) * floatval(Settings::currencyRate($this->currency));
        }
    }

    public function getOldPrice()
    {
        if($this->currency === 'UAH'){
            return $this->old_price;
        }else{
            return floatval($this->old_price) * floatval(Settings::currencyRate($this->currency));
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIssetToCart($product_id)
    {
        $isset_to_cart = null;
        if (isset($_SESSION['agro_cart'])) {
            $keys = array_keys(unserialize($_SESSION['agro_cart']));

            if (in_array($product_id, $keys)) {
                $isset_to_cart = Yii::$app->cart->getPositions()[$product_id];
            }
        }
        return $isset_to_cart;
    }

    public function getSchemaImg($id)
    {
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        $images = [];
        foreach ($product->images as $image) {
            $images[] = Yii::$app->request->hostInfo . '/product/' . $image->name;
        }
        return $images;
    }

    public function getSchemaRating($id)
    {
        $reviews = Review::find()->where(['product_id' => $id])->all();
        $res = [];
        foreach ($reviews as $review) {
            $res[] = $review->rating;
        }
        if (count($res) > 0) {
            return array_sum($res)/count($res);

        }else{
            return '4.4';
        }
    }

    public function getSchemaCountReviews($id)
    {
        $reviews = Review::find()->where(['product_id' => $id])->all();
        $res = [];
        foreach ($reviews as $review) {
            $res[] = $review;
        }
        if (count($res) > 0) {
            return count($res);

        } else {
            return '28';
        }
    }

    public function getImgOne($id)
    {
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        if (isset($product->images[0])) {
            $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->name;
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    public function getImgSeo($id)
    {
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        if (isset($product->images[0])) {
            $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->large;
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    // 350 * 350
    public function getImgOneExtraExtraLarge($id)
    {
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        if (isset($product->images[0])) {
            $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->extra_extra_large;
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    // 290 * 290
    public function getImgOneExtraLarge($id)
    {
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        if (isset($product->images[0])) {
            $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->extra_large;
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    //  195 * 195
    public function getImgOneLarge($id)
    {
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        if (isset($product->images[0])) {
            $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->large;
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    // 150 * 150
    public function getImgOneMedium($id)
    {
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        if (isset($product->images[0])) {
            $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->medium;
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    // 90 * 90
    public function getImgOneSmall($id)
    {
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        if (isset($product->images[0])) {
            $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->small;
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    // 64 * 64
    public function getImgOneExtraSmal($id)
    {
        $product = Product::find()->with('images')->where(['id' => $id])->one();
        if (isset($product->images[0])) {
            $img = Yii::$app->request->hostInfo . '/product/' . $product->images[0]->extra_small;
        } else {
            $img = Yii::$app->request->hostInfo . "/images/no-image.png";
        }
        return $img;
    }

    public static function productImage($slug)
    {
        $product = Product::find()->where(['slug' => $slug])->one();
        if ($product !== null) {
            $product_image = ProductImage::find()->where(['product_id' => $product->id])->one();

            if ($product_image !== null && isset($product_image->extra_small)) {
                return $product_image->extra_small;
            } else {
                return 'no-image.png';
            }
        } else {
            return 'no-image.png';
        }
    }


    public static function productName($slug) {

        $product = Product::find()->where(['slug' => $slug])->one();

        return $product->name;
    }

    public static function productParams($id) {

        $title_param = '';
        $product_params = ProductProperties::find()->where(['product_id' => $id])->orderBy('sort ASC')->all();
        foreach ($product_params as $params){
            $title_param .= $params->properties .'<br><b>'. $params->value .'</b><br><br>';
        }
           if ($title_param == ''){
               $title_param ='-------------------------<br>
                              параметри заповнюються<br>
                              -------------------------<br>
                             ';
           }
        return $title_param;
    }

    public static function productParamsList($id) {

        $title_param = '';
        $product_params = ProductProperties::find()->where(['product_id' => $id])->orderBy('sort ASC')->all();
        foreach ($product_params as $params){
            $title_param .= '<li style="
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
">' . $params->properties . ' ' . '<b>' .  $params->value  .'</b></li>';
        }
        if ($title_param == ''){
            $title_param ='-------------------------<br>
                              параметри заповнюються<br>
                              -------------------------<br>
                             ';
        }
        return $title_param;
    }

    public function getRatingCount($id)
    {
        $product = Product::find()->with('reviews')->where(['id' => $id])->one();
        $res = '<a href="#review-form"> 0 (Не оцінювалось)</a>';
        if($product->reviews){
            $s = [];
            foreach ($product->reviews as $review) {
                $s[] = $review->rating;
            }
            $res = array_sum($s) / count($product->reviews);
            $count = count($product->reviews);
            $res = '<a href="#review-form"> ' . Yii::$app->formatter->asDecimal($res, 1) . ' (' . $count . ' оцінок)</a>';
        }
        return $res;
    }

    public function getRating($id, $w = 18, $h = 17)
    {
        $product = Product::find()->with('reviews')->where(['id' => $id])->one();
        $res = '';
        if($product->reviews) {
            $s = [];
            foreach ($product->reviews as $review) {
                $s[] = $review->rating;
            }
            $rating = round(array_sum($s) / count($product->reviews));
            $count = count($product->reviews);

            $res = '
            <div class="rating">
                                                    <div class="rating__body">';
            if ($rating != 0) {
                for ($i = 1; $i <= $rating; $i++) {
                    $res .= '<svg class="rating__star rating__star--active" width="' . $w . 'px" height="' . $h . 'px">
                                                                    <g class="rating__fill">
                                                                        <use xlink:href="/images/sprite.svg#star-normal"></use>
                                                                    </g>
                                                                    <g class="rating__stroke">
                                                                        <use xlink:href="/images/sprite.svg#star-normal-stroke"></use>
                                                                    </g>
                                                                </svg>
                                                                <div class="rating__star rating__star--only-edge rating__star--active">
                                                                <div class="rating__fill">
                                                                    <div class="fake-svg-icon"></div>
                                                                </div>
                                                                <div class="rating__stroke">
                                                                    <div class="fake-svg-icon"></div>
                                                                </div>
                                                            </div>';
                }
                if (5 - $rating != 0) {
                    for ($i = 1; $i <= 5 - $rating; $i++) {
                        $res .= '<svg class="rating__star " width="' . $w . 'px" height="' . $h . 'px">
                                                                        <g class="rating__fill">
                                                                            <use xlink:href="/images/sprite.svg#star-normal"></use>
                                                                        </g>
                                                                        <g class="rating__stroke">
                                                                            <use xlink:href="/images/sprite.svg#star-normal-stroke"></use>
                                                                        </g>
                                                                    </svg>
                                                                    <div class="rating__star rating__star--only-edge ">
                                                                        <div class="rating__fill">
                                                                            <div class="fake-svg-icon"></div>
                                                                        </div>
                                                                        <div class="rating__stroke">
                                                                            <div class="fake-svg-icon"></div>
                                                                        </div>
                                                                    </div>';
                    }
                }
            } else {
                for ($i = 1; $i <= 5; $i++) {
                    $res .= '<svg class="rating__star " width="' . $w . 'px" height="' . $h . 'px">
                                                                    <g class="rating__fill">
                                                                        <use xlink:href="/images/sprite.svg#star-normal"></use>
                                                                    </g>
                                                                    <g class="rating__stroke">
                                                                        <use xlink:href="/images/sprite.svg#star-normal-stroke"></use>
                                                                    </g>
                                                                </svg>
                                                                <div class="rating__star rating__star--only-edge ">
                                                                <div class="rating__fill">
                                                                    <div class="fake-svg-icon"></div>
                                                                </div>
                                                                <div class="rating__stroke">
                                                                    <div class="fake-svg-icon"></div>
                                                                </div>
                                                            </div>';
                }
            }
            $res .= '</div>
                                                </div>';
        }
        return $res;
    }

}
