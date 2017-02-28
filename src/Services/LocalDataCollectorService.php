<?php

namespace  RonasIT\Support\LocalDataCollector\Services;


use Illuminate\Contracts\Filesystem\FileNotFoundException;
use RonasIT\Support\LocalDataCollector\Exceptions\CannotFindTemporaryFileException;

class LocalDataCollectorService
{
    protected $filePath;

    public function __construct()
    {
        $this->filePath = config('local-data-collector.production_path');

        if (empty($this->filePath)) {
            throw new CannotFindTemporaryFileException();
        }
    }

    public function saveData($tempData){
        rename($tempData, $this->filePath);
    }

    public function getFileContent() {
        if (!file_exists($this->filePath)) {
            throw new FileNotFoundException();
        }

        $fileContent = file_get_contents($this->filePath);

        return json_decode($fileContent);
    }
}
