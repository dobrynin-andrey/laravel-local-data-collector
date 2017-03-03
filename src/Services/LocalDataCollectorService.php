<?php

namespace  RonasIT\Support\LocalDataCollector\Services;


use Illuminate\Contracts\Filesystem\FileNotFoundException;
use RonasIT\Support\LocalDataCollector\Exceptions\CannotFindTemporaryFileException;
use RonasIT\Support\AutoDoc\Interfaces\DataCollectorInterface;

class LocalDataCollectorService implements DataCollectorInterface
{
    protected $filePath;
    protected $tempFilePath;

    public function __construct()
    {
        $this->filePath = config('local-data-collector.production_path');
        $this->tempFilePath = config('local-data-collector.temporary_path');

        if (empty($this->tempFilePath)) {
            throw new CannotFindTemporaryFileException();
        }

        if (empty($this->filePath)) {
            throw new MissedProductionFilePathException();
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
