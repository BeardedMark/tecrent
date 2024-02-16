<?php

namespace App\Excel;

use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class UniversalImport implements ToCollection
{
    // Название таблицы в базе данных
    private $tableName;

    // Список столбцов таблицы
    private $tableColumns;

    // Флаг для очистки идентификатора (id)
    private $clearId = false;

    // Конструктор класса
    public function __construct($tableName, $clearId)
    {
        $this->tableName = $tableName;
        $this->tableColumns = DB::getSchemaBuilder()->getColumnListing($tableName);
        $this->clearId = $clearId;
    }

    // Метод обработки коллекции данных
    public function collection(Collection $rows)
    {
        // Получение модели для указанной таблицы
        $model = DB::table($this->tableName);

        // Извлечение заголовочной строки (названия столбцов)
        $headerRow = $rows->shift();
        $columnNames = $headerRow->toArray();

        // Массив для хранения данных, подлежащих вставке в базу данных
        $dataToInsert = [];

        // Перебор строк коллекции
        foreach ($rows as $row) {
            $data = [];

            // Перебор значений в строке
            foreach ($columnNames as $index => $columnName) {
                // Проверка, что название столбца не пустое и присутствует в таблице
                if ($columnName && in_array($columnName, $this->tableColumns)) {
                    // Запись значения в соответствующий столбец
                    $data[$columnName] = $row[$index];
                }
            }

            // foreach ($uniqueColumns as $column) {
            //     if ($model->where($column, '=', $data[$column])) {

            //         $count = 1;
            //         while ($model->where($column, '=', $data[$column] . '(' . $count . ')')->exists()) {
            //             $count++;
            //         }

            //         $data[$column] = $data[$column] . '(' . $count . ')';
            //     }
            // }

            // Очистка идентификатора, если установлен соответствующий флаг и запись с таким id уже существует
            if ($this->clearId && $model->find($data['id'])) {
                $data['id'] = null;
            }

            // Добавление данных в массив для вставки
            $dataToInsert[] = $data;
        }

        // Вставка данных в базу данных
        $model->insert($dataToInsert);
    }
}
