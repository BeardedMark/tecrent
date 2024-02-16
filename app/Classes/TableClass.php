<?php

namespace App\Classes;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;

class TableClass
{
    private $table;
    private $columns;
    private $data;
    private $relatedTables;
    private $referenceTables;

    public function __construct($tableName)
    {
        $this->setTable($tableName);
        $this->setColumns($tableName);
        $this->setData($tableName);

        // dd($this->relatedTables, $this->referenceTables);
    }
    public function getTable()
    {
        return $this->table;
    }

    public function getComment()
    {
        return $this->table->TABLE_COMMENT;
    }

    public function getName()
    {
        return $this->table->TABLE_NAME;
    }

    public function getColumns()
    {
        return $this->columns;
    }

    public function setRelations()
    {
        $columns = $this->getColumns();
        $tableName = $this->getName();
        $data = $this->data;

        // Колонки с упоминаниями
        $columnsTables = DB::table('information_schema.columns')
            ->where('table_schema', env('DB_DATABASE'))
            ->where(function ($query) use ($tableName) {
                $query->orWhere('column_name', 'like', '%' . Str::singular($tableName) . '_id%');
            })
            ->distinct()
            ->pluck('table_name');


        // Таблицы от колонок
        $relatedTables = [];
        foreach ($columnsTables as $table) {
            $tables = DB::table('information_schema.tables')
                ->where('table_schema', env('DB_DATABASE'))
                ->where(function ($query) use ($table) {
                    $query->orWhere('table_name', 'not like', '%' . Str::plural($table) . '%');
                    $query->orWhere('table_name', 'not like', '%' . Str::singular($table) . '%');
                })
                ->first();

            $relatedTables[] = $tables;
        }



        $tables = DB::table('information_schema.tables')
            ->where('table_schema', env('DB_DATABASE'))
            ->where(function ($query) use ($tableName) {
                $query->orWhere('table_name', 'like', '%' . Str::plural($tableName) . '%');
                $query->orWhere('table_name', 'like', '%' . Str::singular($tableName) . '%');
            })
            ->where('table_name', '!=', $tableName)
            ->get();

        foreach ($tables as $key => $value) {
            $result = str_replace([Str::singular($tableName) . '_', '_' . Str::singular($tableName), Str::plural($tableName) . '_', '_' . Str::plural($tableName)], '',  Str::plural($value->TABLE_NAME));
            $table = DB::table('information_schema.tables')
                ->where('table_schema', env('DB_DATABASE'))
                ->where('table_name', $result)
                ->first();

            $tables[$key] = $table;
        }

        foreach ($relatedTables as $table) {
            $newColumn = new \stdClass();

            $newColumn->COLUMN_NAME = $table->TABLE_NAME;
            $newColumn->COLUMN_COMMENT = $table->TABLE_COMMENT;
            $newColumn->DATA_TYPE = 'array';
            $newColumn->IS_NULLABLE = 'YES';

            $columns[] = $newColumn;
        }


        // Присвоение данных относительно колокок
        foreach ($data as $key => $row) {
            foreach ($columns as $column) {
                $columnName = $column->COLUMN_NAME;
                $dataType = $column->DATA_TYPE;
                if ($dataType === 'array') {
                    $relatedData = DB::table($columnName)
                        ->where(function ($query) use ($tableName, $row) {
                            $query->orWhere(Str::singular($tableName) . '_id', $row->id);
                        })
                        ->pluck('id');

                    $this->data[$key]->$columnName = $relatedData;
                }
            }
        }
    }

    public function getData()
    {
        return $this->data;
    }

    public function getItem($id)
    {
        $item = DB::table($this->getName())->find($id);

        // foreach ($this->columns as $column) {
        //     $columnName = $column->COLUMN_NAME;

        //     if (Str::endsWith($columnName, '_id')) {
        //         $relatedTable = Str::plural(Str::beforeLast($columnName, '_id'));

        //         $relatedValue = DB::table($relatedTable)
        //             ->where('id', $item->$columnName)
        //             ->value('name');

        //         $item->$columnName = $relatedValue;
        //     }
        // }

        return $item;
    }

    // 

    private function setTable($tableName)
    {
        $this->table = DB::table('information_schema.tables')
            ->where('table_schema', env('DB_DATABASE'))
            ->where('table_name', $tableName)
            ->first();

        // $this->setRelatedTables();
        // $this->setReferenceTables();
    }

    private function setRelatedTables()
    {
        $tables = DB::table('information_schema.tables')
            ->where('table_schema', env('DB_DATABASE'))
            ->where(function ($query) {
                $query->orWhere('table_name', 'like', '%' . Str::plural($this->getName()) . '%');
                $query->orWhere('table_name', 'like', '%' . Str::singular($this->getName()) . '%');
            })
            ->where('table_name', '!=', $this->getName())
            ->get();

        foreach ($tables as $key => $value) {
            $result = str_replace([Str::singular($this->getName()) . '_', '_' . Str::singular($this->getName()), Str::plural($this->getName()) . '_', '_' . Str::plural($this->getName())], '',  Str::plural($value->TABLE_NAME));
            $table = DB::table('information_schema.tables')
                ->where('table_schema', env('DB_DATABASE'))
                ->where('table_name', $result)
                ->first();

            $this->relatedTables[] = $table;
        }
    }

    private function setReferenceTables()
    {
        $columnsTables = DB::table('information_schema.columns')
            ->where('table_schema', env('DB_DATABASE'))
            ->where(function ($query) {
                $query->orWhere('column_name', 'like', '%' . Str::singular($this->getName()) . '_id%');
            })
            ->distinct()
            ->pluck('table_name');

        // dd($columnsTables);

        foreach ($columnsTables as $table) {
            $referenceTable = DB::table('information_schema.tables')
                ->where('table_schema', env('DB_DATABASE'))
                ->where(function ($query) use ($table) {
                    $query->orWhere('table_name', 'not like', '%' . Str::plural($table) . '%');
                    $query->orWhere('table_name', 'not like', '%' . Str::singular($table) . '%');
                })

                ->where('table_name', $table)
                ->first();

            $this->referenceTables[] = $referenceTable;
        }
    }

    // 

    private function setColumns($tableName)
    {
        $this->columns = DB::table('information_schema.columns')
            ->where('table_schema', env('DB_DATABASE'))
            ->where('table_name', $tableName)
            ->get();


        foreach ($this->columns as $column) {
            if (in_array($column->DATA_TYPE, ['datetype', 'timestamp']))
                $column->HTML_TYPE = 'datetime-local';

            if (in_array($column->DATA_TYPE, ['tinyint', 'boolean']))
                $column->HTML_TYPE = 'checkbox';

            if (in_array($column->DATA_TYPE, ['int', 'bigint']))
                $column->HTML_TYPE = 'number';
            else
                $column->HTML_TYPE = 'varchar';
        }

        foreach ($this->columns as $column) {
            if (Str::endsWith($column->COLUMN_NAME, '_id')) {
                $relatedTable = Str::plural(Str::beforeLast($column->COLUMN_NAME, '_id'));
                if (Schema::hasTable($relatedTable)) {
                    $relatedData = DB::table($relatedTable)->get();

                    $resultObjects = [];

                    foreach ($relatedData as $data) {
                        $resultObject = new \stdClass();

                        $resultObject->id = isset($data->id) ? $data->id : null;
                    
                        $fields = [];
                        foreach ($data as $key => $value) {
                            if (!in_array($key, ['created_at', 'updated_at', 'deleted_at'])) {
                                $trimmedValue = mb_substr($value, 0, 20);
                                $fields[] = $trimmedValue . (mb_strlen($value) > 20 ? '...' : '');
                            }
                        }
                    
                        $resultObject->name = implode(', ', array_filter($fields));
                    
                        $resultObjects[] = $resultObject;
                    }
                    $column->DATA = $resultObjects;
                }
            }
        }

        foreach ($this->columns as $key => $column) {
            if (in_array($column->COLUMN_NAME, ['id', 'created_at', 'updated_at', 'deleted_at'])) {
                unset($this->columns[$key]);
            }
        }
    }

    private function setData($tableName)
    {
        $this->data = DB::table($tableName)->get();

        // Замена id на name в колонках
        foreach ($this->data as $key => $row) {
            foreach ($this->columns as $column) {
                $columnName = $column->COLUMN_NAME;

                if (Str::endsWith($columnName, '_id')) {
                    $relatedTable = Str::plural(Str::beforeLast($columnName, '_id'));

                    $relatedValue = DB::table($relatedTable)
                        ->where('id', $row->$columnName)
                        ->value('name');

                    $this->data[$key]->$columnName = $relatedValue ?? $relatedValue;
                }
            }
        }
    }
}
