<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Student::with('room')->get()->map(function ($s) {
            return [
                'Name'   => $s->name,
                'Email'  => $s->email,
                'Room'   => $s->room?->room_number ?? '-',
                'Status' => $s->isCurrentlyOut() ? 'OUT' : 'IN',
            ];
        });
    }

    public function headings(): array
    {
        return ['Name', 'Email', 'Room', 'Status'];
    }
}