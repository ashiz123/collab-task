<?php

namespace utils;

require 'vendor/autoload.php';
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class FileUpload {
    private $file;
    private $imageManager;
    private $uploadDir;

    public function __construct($file)
    {
        $this->file = $file;
        $this->imageManager =  new ImageManager(new Driver());
        $this->uploadDir = 'public/uploads/';

        //ensure the directory exist otherwise create it.
        if(!is_dir($this->uploadDir)){
            mkdir($this->uploadDir, 0755, true);
        }

    }

    //validate type and size
    public function validate(){
        $validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
        $maxSize = 2 * 1024 * 1024;

        if(!in_array($this->file['type'], $validTypes)){
            return 'Invalid type format';
        }

        if($this->file['size'] > $maxSize){
            return 'File size exceeds than 2 MB limit';
        }
        
        return true;

    }


    // file naming and upload to directory
    public function upload($resizeWidth = 280, $resizeHeight = 300){

        
        $validateResult = $this->validate();
        if($validateResult!== true){
            return $validateResult;
        }

        $tempPath = $this->file['tmp_name'];
        $filename = uniqid('img_'). '.' . pathinfo($this->file['name'], PATHINFO_EXTENSION);
        $image = $this->imageManager->read($tempPath)->resize($resizeWidth, $resizeHeight);
        $image->save($this->uploadDir . $filename);

        return $filename;
   }

}