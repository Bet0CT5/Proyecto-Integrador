<?php 

require "C:\\xampp\htdocs\php\Asistencia_QR\Proyecto-Integrador\\vendor\autoload.php";


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

function exportarAExcel($query) {

    require "conexionBD.php";
    require "Carga_variables.php";

    // Consulta SQL para obtener los datos de la tabla
    $sql = $conn->query($query);

    // Crear un nuevo archivo de Excel
    $spreadsheet = new Spreadsheet();
    $worksheet = $spreadsheet->getActiveSheet();

    // Definir los estilos
    $headerStyle = [
        'font' => [
            'bold' => true,
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => [
                'rgb' => 'CCCCCC', // Color gris en formato hexadecimal
            ],
        ],
    ];
    
    // Obtener los nombres de las columnas
    $columnNames = array();
    $columnIndex = 1;
    if ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $columnName => $value) {
            $columnNames[$columnIndex] = $columnName;

            // Establecer estilo de cabecera a las celdas
            $cell = $worksheet->getCellByColumnAndRow($columnIndex, 1);
            $cell->setValue($columnName);
            $cell->getStyle()->applyFromArray($headerStyle);

            $columnIndex++;
        }
        for ($col = 1; $col <= count($row); $col++) {
            $worksheet->setCellValueByColumnAndRow($col, 2, $row[$columnNames[$col]]);
        }
    }

    // Obtener los datos de las filas
    $row = 3;
    while ($rowArray = $sql->fetch(PDO::FETCH_NUM)) {
        for ($col = 1; $col <= count($rowArray); $col++) {
            $worksheet->setCellValueByColumnAndRow($col, $row, $rowArray[$col - 1]);
        }
        $row++;
    }

    // Guardar el archivo de Excel en una ubicación temporal
    $excelFilename = "output.xlsx";

    // Enviar el archivo para descargar
    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $excelFilename . '"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
    
    exit;
}

?>