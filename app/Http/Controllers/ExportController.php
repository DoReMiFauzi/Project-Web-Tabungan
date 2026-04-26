<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use App\Models\TabunganModel;

class ExportController extends Controller
{
    public function export(){
        $data = TabunganModel::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Nominal');
        $sheet->setCellValue('C1', 'Tipe');
        $sheet->setCellValue('D1', 'Tanggal');

        $row = 2;

        foreach ($data as $item){
            $sheet->setCellValue('A'. $row, $item->id);
            $sheet->setCellValue('B'. $row, $item->nominal);
            $sheet->setCellValue('C'. $row, $item->tipe);
            $sheet->setCellValue('D'. $row, $item->tanggal);

            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'Laporan.Xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $filename);

        $writer->save($temp_file);

        return response()->download($temp_file, $filename)->deleteFileAfterSend(true);
    }
}
