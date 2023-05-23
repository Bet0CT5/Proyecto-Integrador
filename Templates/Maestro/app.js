const contenedorQR = document.getElementById('contenedorQR');

new QRCode(contenedorQR, 'http://192.168.0.14:8080/php/Toma_Asistencia_QR_V2/phps/EscaneoQR.php');
