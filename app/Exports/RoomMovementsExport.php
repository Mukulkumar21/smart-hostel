<?php

namespace App\Exports;

use App\Models\RoomMovement;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RoomMovementsExport implements FromCollection, WithHeadings
{
    protected $roomId;

    public function __construct($roomId)
    {
        $this->roomId = $roomId;
    }

    public function collection()
    {
        return RoomMovement::with('student')
            ->where('room_id', $this->roomId)
            ->orderByDesc('moved_at')
            ->get()
            ->map(function ($move) {
                return [
                    $move->student->name,
                    $move->movement_type,
                    $move->moved_at,
                    $move->reason ?? '-',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Student Name',
            'Movement Type',
            'Date & Time',
            'Reason',
        ];
    }
}
