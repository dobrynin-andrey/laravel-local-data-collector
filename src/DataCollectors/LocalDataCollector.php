<?php

namespace  RonasIT\Support\DataCollectors;


use Illuminate\Contracts\Filesystem\FileNotFoundException;
use RonasIT\Support\DataCollectors\Exceptions\CannotFindTemporaryFileException;
use RonasIT\Support\AutoDoc\Interfaces\DataCollectorInterface;
use RonasIT\Support\DataCollectors\Exceptions\MissedProductionFilePathException;

class LocalDataCollector implements DataCollectorInterface
{
    public $prodFilePath;
    public $tempFilePath;

    public function __construct()
    {
        $this->prodFilePath = config('local-data-collector.production_path');
        $this->tempFilePath = config('local-data-collector.temporary_path');

        if (empty($this->tempFilePath)) {
            throw new CannotFindTemporaryFileException();
        }

        if (empty($this->prodFilePath)) {
            throw new MissedProductionFilePathException();
        }
    }

    public function saveTmpData($tempData) {
        $data = json_encode($tempData);

        file_put_contents($this->tempFilePath, $data);
    }

    public function getTmpData() {
        if (file_exists($this->tempFilePath)) {
            $content = file_get_contents($this->tempFilePath);

            return json_decode($content, true);
        }

        return null;
    }

    public function saveData(){
        $tempData = $this->getTmpData();

        $content = json_encode($tempData);

        file_put_contents($this->prodFilePath, $content);

        unlink($this->tempFilePath);
    }

    public function getDocumentation() {
        if (!file_exists($this->prodFilePath)) {
            throw new FileNotFoundException();
        }

        $fileContent = file_get_contents($this->prodFilePath);

        return json_decode($fileContent);
    }
}
