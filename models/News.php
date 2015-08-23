<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
/**
 * This is the model class for table "news".
 *
 * @property integer $id_new
 * @property string $title_new
 * @property string $content_new
 * @property string $preview_new
 * @property string $data_new
 * @property string $smallimg_new
 */
class News extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title_new', 'content_new', 'preview_new'], 'required'],
            [['content_new', 'preview_new'], 'string'],
            [['file'], 'file'],
            [['data_new'], 'safe'],
            [['title_new', 'smallimg_new'], 'string', 'max' => 255]
        ];
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_new' => 'Id новости',
            'title_new' => 'Заголовок новости',
            'content_new' => 'Основной контент новости',
            'preview_new' => 'Краткий текст новости',
            'data_new' => 'Дата',
            'file' => 'Картинка для новости',
        ];
    }
}
