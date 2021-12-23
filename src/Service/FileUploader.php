<?php

namespace App\Services;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    /**
     * @var string
     */
    private $targetDirectory;

    /**
     * @var SluggerInterface
     */
    private $slugger;

    public function __construct($targetDirectory, SluggerInterface $slugger)
    {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
    }

    public function uploadFile(UploadedFile $file)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileName = uniqid().'_'.$this->slugger->slug($originalFilename).'.'.$file->getClientOriginalExtension();
        try {
            $file->move(
                $this->targetDirectory,
                $fileName
            );
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
            }
        return $fileName;
    }
}