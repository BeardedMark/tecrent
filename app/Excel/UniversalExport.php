<?php

namespace App\Excel;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class UniversalExport implements FromCollection, WithHeadings
{
    use Exportable;

    private $data;
    private $tableName;

    public function __construct($data, $tableName)
    {
        $this->data = $data;
        $this->tableName = $tableName;
    }

    public function collection()
    {
        return $this->data;
    }

    public function headings(): array
    {
        $columns = DB::getSchemaBuilder()->getColumnListing($this->tableName);
        return $columns;
    }
}