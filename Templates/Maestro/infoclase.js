const mysql = require('mysql');
const con = require('conexionBD.php')

con.connect((err) => {
    if (err) throw err;
    
    con.query(
    "SELECT * FROM maestro INNER JOIN maestro_grupo INNER JOIN grupo ON maestro.id_maestro=maestro_grupo.id_maestro AND maestro_grupo.crn_grupo=grupo.crn_grupo WHERE ", (err, result) => {
      if (err) throw err;
      console.log(result);
      
      // Guardar los resultados en una variable
      const consulta = result;
    });
  });

const info = document.getElementById('infoClase');
info.innerHTML="<div><h4>Clase: </h4><br>"+"<h4>Horario: </h4><br>"+"<h4>Salón: </h4></div>";

