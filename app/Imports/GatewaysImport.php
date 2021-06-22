<?php

namespace App\Imports;

use App\Models\Gateway;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithLimit;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;

class GatewaysImport implements ToModel, WithBatchInserts, WithHeadingRow, WithChunkReading, WithLimit, WithValidation
{
    use Importable;

    public function chunkSize(): int
    {
        return 1001;
    }

    public function limit(): int
    {
        return 1000;
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function model(array $row)
    {
        return new Gateway($row);
    }

    public function rules(): array
    {
        return [
                'serial_number' => 'required|unique:gateways,serial_number',
                'description' => 'nullable',
        ];
    }
}
