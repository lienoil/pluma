<?php

namespace Pluma\Support\Repository\Traits;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;
use PhpOffice\PhpSpreadsheet\Writer\Pdf\Dompdf;

trait ExportToSpreadsheetTrait
{
    /**
     * Export to spreadsheet format.
     *
     * @param mixed $resource
     * @param array $data
     * @return void
     */
    public function buildSpreadsheet($resource, $data)
    {
        //
    }

    /**
     * Export to spreadsheet format.
     *
     * @return mixed
     */
    public function toSpreadsheet()
    {
        $spreadsheet = $this->buildSpreadsheet($this->resource, $this->exportables);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$this->exportables['filename'].'.xlsx"');
        header('Cache-Control: max-age=0');
        header('Content-Type: application/octet-stream');
        header('Content-Description: File Transfer');
        header('Content-Transfer-Encoding: Binary');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
    }
}
