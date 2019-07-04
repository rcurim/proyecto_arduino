<?php

include_once '../utils/sorter.php';
include_once '../utils/write.php';
include_once '../utils/member.php';

$selected_member = $_GET['member'];

if( is_file("../temp/wikis.json") == false ){
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://gitlab.com/api/v4/projects/12434105/wikis?with_content=true",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "Accept: */*",
            "Cache-Control: no-cache",
            "Connection: keep-alive",
            "Host: gitlab.com",
            "PRIVATE-TOKEN: bQGeotLmasDAyEv5ndz1",
            "Postman-Token: c1f959ba-1abd-4998-8cd1-b89099af60f0,ca4f7d1c-b3a0-4b8e-9e99-e03f19eff6cb",
            "User-Agent: PostmanRuntime/7.13.0",
            "accept-encoding: gzip, deflate",
            "cache-control: no-cache"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "<div class='alert alert-danger'>Error, no se pudo accesar a GitLab.org. ".$err." </div>";
        return;
    } else {
        $result = DataWriter::writeWikisJson( $response );
        if ($result == false || empty($result)) {
            echo "<div class='alert alert-danger'>Error al crear archivo de respaldo. </div>";
            return;
        }
    }
}

//Leemos el JSON
$wikis_string = file_get_contents("../temp/wikis.json");
//json_decode receive as input a string and return a json value (arrays, etc) 
$wikis_json = json_decode($wikis_string, true);
$wikis_json = Sorter::classifyMinutes( $wikis_json );

require_once '../view/wiki_table.php';
?>