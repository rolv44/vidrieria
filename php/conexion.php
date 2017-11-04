<?php 

class conexion {

    function conectar(){
    	return mysqli_connect("vidrieria-yashimitsu.com","vidrieri_admin","admin1234","vidrieri_ferreteria");
    }
}

 ?>