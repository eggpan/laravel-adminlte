<?php

namespace App\Import;

use ErrorException;
use SplFileObject;

class CsvImporter
{
    public function load(string $csvFileName, string $class)
    {
        $path = storage_path('app/' . $csvFileName);
        if (! file_exists($path)) {
            throw new ErrorException("CSVファイル $path が見つかりませんでした。");
        }
        $file = new SplFileObject($path);
        $file->setFlags(
            SplFileObject::READ_CSV
            | SplFileObject::SKIP_EMPTY
            | SplFileObject::DROP_NEW_LINE
        );
        foreach ($file as $line) {
            if ($file->eof()) {
            break;
            }
            if ($file->key() === 0) {
                $headers = $line;
                continue;
            }
            $lineData = array_combine($headers, $line);
            $id = $lineData['id'];
            unset($lineData['id']);
            $class::updateOrCreate(
                ['id' => $id],
                $lineData
            );
        }
    }
}
