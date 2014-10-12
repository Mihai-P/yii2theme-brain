<?php
namespace theme\widgets\ImageButton;

use yii\base\Model;

/**
 * Password reset request form
 */
class ImageButtonModel extends Model
{
    public $image;
    public $link;
    public $alt;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['image', 'filter', 'filter' => 'trim'],
            ['image', 'required'],
            [['link', 'alt'], 'safe'],
        ];
    }
}
