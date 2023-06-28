<?php


namespace frontend\models;


use Yii;
use yii\base\Model;
use yii\web\UploadedFile;


class EmployeeUploadForm extends Model
{
    public $imageFile;
    public $newImageName;
    public $oldImageName;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function getFolder()
    {
        return Yii::getAlias('@frontend') . '/web/images/employee/';
    }

    public function setNewImageName()
    {
        $this->newImageName = Yii::$app->security->generateRandomString() . '.' . $this->imageFile->extension;
    }

    public function saveImage($id)
    {
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');
        if (!$this->validate()) {
            return false;
        }
        $employee = Employee::findOne($id);
        $this->setNewImageName();
        if ($this->upload()) {
            $this->oldImageName = $employee->image;
            $employee->image = $this->newImageName;
            if ($employee->save()) {
                FileSystem::deleteFile($this->getFolder() . $this->oldImageName);
                return true;
            }
            FileSystem::deleteFile($this->getFolder() . $this->newImageName);
            return false;
        }
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs($this->getFolder() . $this->newImageName);
            return true;
        } else {
            return false;
        }
    }

    public function delete($id)
    {
        $employee = Employee::findOne($id);
        $this->oldImageName = $employee->image;
        $employee->image = NULL;
        if ($employee->save()) {
            FileSystem::deleteFile($this->getFolder() . $this->oldImageName);
            return true;
        }
        FileSystem::deleteFile($this->getFolder() . $this->newImageName);
        return false;
    }
}