<?php
//fingerp
class Cords{
    public $x;
    public $y;
            
    function Cords( $x, $y ){
        $this->x = $x;
        $this->y = $y;
        return $this;
    }
    
    
     
}


class FrameFingerprint{
    public $cy;
    public $cr;
    public $cb;
    public $cg;
    
    static function initWithColors($cr, $cg, $cb, $cy ) {
        $res = new FrameFingerprint();
        $res->cr = $cr;
        $res->cg = $cg;
        $res->cb = $cb;
        $res->cy = $cy;
        return $res;
    }  
}

class FrameFingerprintMarcin{
    public $pt;
    public $cwiartka;
    public $dlugosc;
    public $sumaKP;
    public $propDlSuma;
    
    function FrameFingerprintMarcin( $cords, $cwiartka, $dlugosc, $sumaKP ){
        $this->pt = $cords;
        $this->cwiartka = $cwiartka;
        $this->dlugosc = $dlugosc;
        $this->sumaKP = $sumaKP;
        if( $this->sumaKP == 0 ){
            $this->propDlSuma = 0;
        }
        else{
            $this->propDlSuma = round($this->dlugosc / $this->sumaKP, 4);
        }
        return $this;
    }
    
}




//takie tam 
function var_dump_spec( $datas, $bPre ){
	if ( $bPre ) echo "<pre>";
	var_dump( $datas );
	if ( $bPre ) echo "</pre>";
}

function getFileJsonToArray( $filename ){
    $json = str_replace( "],]", "]]", file_get_contents($filename));
    $aResult = json_decode($json);

    $aReturn = array();
   // var_dump_spec($json , true);
    $limit = 180; // 30sek 
//    $limit = 120; // 20sek 
    $limit = 90; // 15sek 
//    $limit = 80; // 13sek 
    
    foreach( $aResult AS $key=>$fp ){
        $aReturn[] = new FrameFingerprintMarcin(new Cords($fp[0][0], $fp[0][1]), $fp[1], $fp[2], $fp[3]);
        if ( $key > $limit ){ break; }
    }
    return $aReturn;
}

function convertRecivedDatas( $aRecivedDatas ){
    $aResult = array();
    foreach( $aRecivedDatas AS $fp_json ){
        $fp = json_decode($fp_json );
        if ( count($fp) ){
            
            $oFP = new FrameFingerprintMarcin(new Cords($fp[0][0], $fp[0][1]), $fp[1], $fp[2], $fp[3]);
            
            $aResult[] = $oFP;
        }
    }
    return $aResult;
}

/**
 * 
 * @param FrameFingerprintMarcin $oFP
 * @param type $aFilm
 * @return array
 */
function compareFPWithFilm($oFP, $aFilm ){
    $aFilmSuccess = array(); 
 //   var_dump( $aFilm );
    /**
     * 
     */
    foreach ($aFilm as $key=>$oFPFilm) {
        
        $klatka_ok = 0;
           if ( abs($oFP->cwiartka - $oFPFilm->cwiartka) <= 0 )
           {
            $klatka_ok += 1;
           
           }
           
          if ( $klatka_ok > 0 )  {
            
            
            if ( abs($oFP->propDlSuma - $oFPFilm->propDlSuma) > 0.0005 ){
//                   $sklatka_ok += 1;
//                   $aFilmSuccess[] = $key;
                  //  var_dump( $oFPFilm->dlugosc, $oFPFilm->sumaKP, $oFP->propDlSuma, $oFP->dlugosc, $oFP->sumaKP, $oFP->propDlSuma, abs($oFP->propDlSuma - $oFPFilm->propDlSuma),"<hr>" );
            }
            else{
                $aFilmSuccess[] = $key;
            }
                
          }
//          
    }//end foreach
    
//    var_dump_spec($aFilmSuccess, true);
    return $aFilmSuccess;
}

function compareFPWithFilms( $oFP, $aServerFilms ){ 
    $aFilmsSuccess = array();
    
    foreach ($aServerFilms as $key=>$aFilm) {
        $tmp = compareFPWithFilm($oFP, $aFilm);
        if ( count($tmp) ){
         $aFilmsSuccess[$key] = $tmp;
        }
    }
    
    return $aFilmsSuccess;
        
}

function comapareMain( $aRecivedFP, $aServerFilms ){
    
    $aFPSuccess = array();
    $aFPSuccessMerged = array();
    
    
    foreach ($aRecivedFP as $key=>$oFP) {
        //var_dump("<hr><hr>Testujemy: ", $oFP );
        $tmp = compareFPWithFilms($oFP, $aServerFilms);
        
        if ( count($tmp) ){
            $aFPSuccess[$key] = $tmp;
//            $aFPSuccessMerged = array_merge( )
//            $aMerged = array_merge($aMerged, $tmp);
//            var_dump_spec( $tmp, true );
            foreach ( $tmp AS $film_id=>$aFrames){
                
                if ( is_array($aFPSuccessMerged[$film_id]) ){
                    $aFPSuccessMerged[$film_id] = array_merge($aFPSuccessMerged[$film_id], $aFrames );
                }
                else{
                    $aFPSuccessMerged[$film_id] =  $aFrames ;
                }
                
                asort($aFPSuccessMerged[$film_id]);
            }
//            fore
//           $aFPSuccessMerged = array_merge_recursive($aFPSuccessMerged, $tmp);
//            var_dump("$key<hr>");
           
        }
        
//        if ( $key==1 ){
//            break;
//        }
        
    }
    
//    var_dump("<hr><hr><hr>");
//    var_dump_spec($aFPSuccessMerged, true);
//    var_dump("<hr><hr><hr>");
//    var_dump_spec($aFPSuccess, true);
 
    $aHitCounts = array();
    $aHitCountsAvg = array();
    
//    var_dump_spec($aFPSuccessMerged, true);

    
    foreach ($aFPSuccessMerged as $film_id => $aFrames) {
        $aHitCounts[$film_id] = count($aFrames);
    
    
    
    //test filmu 8 //90008->
//    $aFilmTest = $aFPSuccessMerged[7];
//    var_dump(array_avg($aFilmTest), max($aFilmTest) );
    //wywalamy wszystko +-50 przy 5fps powinno byc -10 +10
//    $avg = array_avg($aFrames);
//    $min = $avg - 50;
//    $max = $avg + 50;
//    foreach ($aFrames as $key => $value) {
//        if ( ( $value < $min ) || ( $value > $max ) ){
////            var_Dump( $value );
////            unset( $aFilmTest[$key] );
//        }
//        else{
//            $aHitCountsAvg[$film_id]++;
//        }
//    }
//    var_dump_spec( count($aFPSuccessMerged[7]), true);
//    var_dump_spec( count($aFilmTest), true);
    
}



    arsort($aHitCounts);
//var_dump_spec( $aHitCounts, true);

$suma = array_sum($aHitCounts);
   $aHitCountsProp = array();
   
   foreach ($aHitCounts as $film_id => $hitsnum) {
       $prop = round($hitsnum / $suma,3);
       if ( $prop > 0.1 ){
        $aHitCountsProp[$film_id] = $prop;
       }
   }
    
 
    return $aHitCountsProp;
    
//    $aReturn
}


$time0 = time();
$aServerFilms = array();

//1. create server finger prnts
for ( $num=0; $num<=9; $num++ ){
    $filename = "files/marcin20c/$num.json";
    $aServerFilms[] = getFileJsonToArray($filename);
}



//var_dump("<br>klatka:$key:", $aServerFilms );
//var_dump_spec( $aServerFilms, true);

//2. create sended fp
$aRecivedData = $_REQUEST['datas'];
$aRecivedFPColection = convertRecivedDatas($aRecivedData);

//3. sprawdz czy wykluczyc wiersz
if ( true ){
//sprawdz gdzie prowadzi Q wektor jezeli 15,16,1,2 to wywal gorna linie i przelicz q ponownie
}


$aHitCountsProp = comapareMain($aRecivedFPColection, $aServerFilms);

//var_dump_spec( $aHitCountsProp, true);


//$aHitCountsProp[99] = 0.0;
//json_enc

// json_encode ( $myarray, JSON_FORCE_OBJECT );
 
$json_return = json_encode($aHitCountsProp, JSON_FORCE_OBJECT );
//json_e
echo $json_return;

$time1 = time();
$dt01 = $time1 - $time0;


//var_dump( "time01:", $time0, $time1, $dt01 );


function array_avg($array) {
    return array_sum($array) / count($array);
}
