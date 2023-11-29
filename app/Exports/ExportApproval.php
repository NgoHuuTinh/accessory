<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportApproval implements FromArray,  WithHeadings
{

    protected $header;
    protected $data;

    public function __construct(array $header, array $data)
    {
        $this->header = $header;
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }

    public function headings(): array
    {
        return $this->header;
    }
}
