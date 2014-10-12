<?php
/**
 * @copyright Copyright (c) 2013 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace theme\widgets\ImageButton;

use yii\web\AssetBundle;

/**
 * EditableAddressAsset
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\editable
 */
class ImageButtonAsset extends AssetBundle
{
    public $sourcePath = '@theme/widgets/ImageButton/assets/';

    public $css = [
        'imagebutton.css'
    ];

    public $js = [
        'imagebutton.js'
    ];
}