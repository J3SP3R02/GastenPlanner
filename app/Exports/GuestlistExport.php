<?php

namespace App\Exports;

use App\Models\Guest;
use App\Http\Controllers\GuestController;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GuestlistExport implements FromQuery, WithHeadings, WithColumnWidths
{
    use Exportable;

    private $id;

    public function __construct($id) {
        $this->id = $id;
    }

    //Query the fields you want the user to have
    public function query()
    {
        return Guest::select('firstname', 'lastname', 'email', 'phoneNumber', 'dietary_wishes', 'allergies')->where('guestlist_id', $this->id);
    }

    //Name the columns
    public function headings(): array
    {
        return [
            'Voornaam',
            'Achternaam',
            'Email',
            'Telefoonnummer',
            'Dieet Wensen',
            'Allergien',
        ];
    }

    //Define the width of the columns
    public function columnWidths(): array
    {
       return [
         "A" => 30,
         "B" => 30,
         "C" => 55,
         "D" => 55,
         "E" => 55,
         "F" => 55,
       ];
    }
}

