<?php

class DataWriter
{
        public static function writeWikisJson($json_string){
                //$arr_clientes = array('nombre'=> 'Jose', 'edad'=> '20', 'genero'=> 'masculino', 'email'=> 'correodejose@dominio.com', 'localidad'=> 'Madrid', 'telefono'=> '91000000');

                //Creamos el JSON
                //json_encode, receive as input a json array and return a string
                //$json_string = json_encode($array_data); //it's not necesary
                $file = '../temp/wikis.json';
                file_put_contents($file, $json_string);
                return true;
   
        }

        /*
        $arr_clientes = array('nombre'=> 'Jose', 'edad'=> '20', 'genero'=> 'masculino',
                'email'=> 'correodejose@dominio.com', 'localidad'=> 'Madrid', 'telefono'=> '91000000');

        echo $arr_clientes."<br>";


        //Creamos el JSON
        $json_string = json_encode($arr_clientes);
        $file = 'clientes.json';
        file_put_contents($file, $json_string);
        echo "<h1>Bien, se guardo</h1>";
        */

}

?>