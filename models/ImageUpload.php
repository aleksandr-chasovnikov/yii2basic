<?php

namespace app\models;

use Yii;
use yii\base\Model;
/**
 *
 */
class ImageUpload extends Model
{
	public $image;

	/**
	 * Правила валидации
	 */
	public function rules()
	{
		return [
			[['image'], 'required'],
			[['image'], 'file', 'extensions' => 'jpg,png'],
		];
	}

	/**
	 * Сохраняет изображение под новым именем, а старое удаляет
	 */
    public function uploadFile($file, $currentImage)
    {
    	$this->image = $file;

    	if ( $this->validate() ) {

            //Имя старой картинки для удаления
            $currentImage = Yii::getAlias('@web') . 'uploads/' . $currentImage;
    
            //удалить старое изображение
            $this->deleteCurrentImage($currentImage);
    
            //Генерируем имя для файла
            $filename = strtolower( md5( uniqid($file->baseName)) . '.' . $file->extension);
    
            //Загружаем под новым именем
            $file->saveAs( Yii::getAlias('@web') . 'uploads/' . $filename);
    
            return $filename;
        }
    }

    /**
     * Удаление изображения
     */
    public function deleteCurrentImage($image)
    {
    	if ( is_file($image) )  {

	    	unlink($image);
    	}

    }
}
    