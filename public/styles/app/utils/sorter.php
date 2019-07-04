 <?php
 class Sorter {
     public static function classifyMinutes(  $list_wikis ){
        //List<FullWiki> sorder = new ArrayList<>();
        $sum_wikis = array();
        foreach( $list_wikis as $wiki  ){
            //to access to one data of a wiki, you must use ['field'], it's safe.
            if( strpos ( $wiki['slug'] , 'ACT_REU_' ) > -1 ){ 
                $main_content = Sorter::getContentOfAssistants( $wiki );
                $wiki['content'] = $main_content;
                array_push($sum_wikis, $wiki );
            }
        }
        return $sum_wikis;
     }
     
     private static function getContentOfAssistants($temp){
         $start = strpos ( $temp['content'], "##"); //Datos de la reunion
         if ( $start == -1 ){
             return "Acta de reunion vacia";
         }
         $word = substr( $temp['content'], $start + 2 ); //extract
         $finish = strpos ( $word, "##");
         if ( $finish == -1 ){
             return $word;
         }
         return substr( $word , 0, $finish); // Desde Datos de reunion hasta Antes de Seguimiento            
     }
}
?>