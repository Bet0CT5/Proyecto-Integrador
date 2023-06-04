<?php 

require "C:\\xampp\htdocs\php\Asistencia_QR\Proyecto-Integrador\\vendor\autoload.php";


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function exportarAExcel($query) {

    require "conexionBD.php";
    require "Carga_variables.php";

    // Consulta SQL para obtener los datos de la tabla
    $sql = $conn->query($query);

    // Crear un nuevo archivo de Excel
    $spreadsheet = new Spreadsheet();
    $worksheet = $spreadsheet->getActiveSheet();
    
    // Obtener los nombres de las columnas
    $columnNames = array();
    $columnIndex = 1;
    if ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
        foreach ($row as $columnName => $value) {
            $columnNames[$columnIndex] = $columnName;
            $worksheet->setCellValueByColumnAndRow($columnIndex, 1, $columnName);
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

    // Guardar el archivo de Excel
    $excelFilename = 'output.xlsx';
    $writer = new Xlsx($spreadsheet);
    $writer->save($excelFilename);
    
    // Cerrar la conexion previamente realizada
    $sql = null;

    $mensaje = "Los datos se han exportado exitosamente a $excelFilename";
    echo "<script>alert('$mensaje')</script>";
}
