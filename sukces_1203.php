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

class GlobalData{
    public $aColors;
}

class FrameFingerprintMarcin{
    public $pt;
    public $cwiartka;
    public $dlugosc;
    public $sumaKP;
    public $propDlSuma;
    public $aColory;
    public $film_id;
    
    function FrameFingerprintMarcin( $cords, $cwiartka, $dlugosc, $sumaKP ){
        $this->pt = $cords;
        $this->cwiartka = $cwiartka;
        $this->dlugosc = $dlugosc;
        $this->sumaKP = $sumaKP;
        $this->aColory = null;
        $this->film_id = null;
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
        $oFP = new FrameFingerprintMarcin(new Cords($fp[0][0], $fp[0][1]), $fp[1], $fp[2], $fp[3]);
        if ( $fp[4] > -1 ){
               $oFP->aColory = array("b"=>$fp[4],"g"=>$fp[5],"r"=>$fp[6],"y"=>$fp[7]);
//              $aColory = $oFP->aColory;
        } 
            
        $aReturn[] = $oFP;
        if ( $key > $limit ){ break; }
    }
    
    return $aReturn;
}

/**
 * 
 * @param type $aRecivedDatas
 * @param GlobalData $oGlobal
 * @return \FrameFingerprintMarcin
 */
function convertRecivedDatas( $aRecivedDatas, $oGlobal ){
    $aResult = array();
    foreach( $aRecivedDatas AS $fp_json ){
        $fp = json_decode($fp_json );
        if ( count($fp) ){
            
            $oFP = new FrameFingerprintMarcin(new Cords($fp[0][0], $fp[0][1]), $fp[1], $fp[2], $fp[3]);
            if ( $fp[4] > -1 ){
               $oFP->aColory = array("b"=>$fp[4],"g"=>$fp[5],"r"=>$fp[6],"y"=>$fp[7]);
//               var_dump( $oFP );
               $oGlobal->aColors = $oFP->aColory;
    
            }
            
            
            $aResult[] = $oFP;
        }
    }
    return $aResult;
}

/**
 * 
 * @param FrameFingerprintMarcin $oFP
 * @param type $aFilm
 * @param GlobalData $oGlboal
 * @return array
 */
function compareFPWithFilm($oFP, $aFilm, $oGlobal ){
    $aFilmSuccess = array(); 
 //   var_dump( $aFilm );
    /**
     * 
     */
    
    foreach ($aFilm as $key=>$oFPFilm) {
        
        $klatka_ok = 0;
        
//        if ( !is_null($oFPFilm->aColory) ){
//               $maxFilm = array_keys($oFPFilm->aColory, max($oFPFilm->aColory));
//               $maxPhone = array_keys($oGlobal->aColors, max($oGlobal->aColors));
//               if ( $maxFilm[0] == $maxPhone[0] ){
//                   $klatka_ok += 1;
//               }
//        }       
        
    
//           if ( $klatka_ok == 1 ){ 
                if ( abs($oFP->cwiartka - $oFPFilm->cwiartka) <= 0 )
                {
                 $klatka_ok += 1;
                }
//           }
           
                
          if ( $klatka_ok > 0 )  {
//            var_dump( $klatka_ok );
            
            if ( !(abs($oFP->propDlSuma - $oFPFilm->propDlSuma) > 0.0005) ){
                
                $maxFilm = array_keys($oFPFilm->aColory, max($oFPFilm->aColory));
                $maxPhone = array_keys($oGlobal->aColors, max($oGlobal->aColors));
                if ( $maxFilm[0] == $maxPhone[0] ){
//                    echo "+";
                    $aFilmSuccess[] = $key;
                    $aFilmSuccess[] = $key;
                    
                }
                else{
                    $aFilmSuccess[] = $key;
//                    echo "-";
                }
//                for( $z=0; $z<$klatka_ok; $z++ ){
//                    $aFilmSuccess[] = $key;
//                }
                
            }
           
          }
          
//          
    }//end foreach
    
//    var_dump_spec($aFilmSuccess, true);
    return $aFilmSuccess;
}
/**
 * 
 * @param type $oFP
 * @param type $aServerFilms
 * @param GlobalData $oGlobal
 * @return type
 */
function compareFPWithFilms( $oFP, $aServerFilms, $oGlobal ){ 
    $aFilmsSuccess = array();
    
    foreach ($aServerFilms as $key=>$aFilm) {
        $tmp = compareFPWithFilm($oFP, $aFilm ,$oGlobal);
        if ( count($tmp) ){
         $aFilmsSuccess[$key] = $tmp;
        }
    }
    
    return $aFilmsSuccess;
        
}

function comapareMain( $aRecivedFP, $aServerFilms, $oGlobal ){
    
    $aFPSuccess = array();
    $aFPSuccessMerged = array();
    
    
    foreach ($aRecivedFP as $key=>$oFP) {
        $tmp = compareFPWithFilms($oFP, $aServerFilms, $oGlobal);
        
        if ( count($tmp) ){
            $aFPSuccess[$key] = $tmp;
            
            foreach ( $tmp AS $film_id=>$aFrames){
                
                if ( is_array($aFPSuccessMerged[$film_id]) ){
                    $aFPSuccessMerged[$film_id] = array_merge($aFPSuccessMerged[$film_id], $aFrames );
                }
                else{
                    $aFPSuccessMerged[$film_id] =  $aFrames ;
                }
                
                asort($aFPSuccessMerged[$film_id]);
            }
            
           
        }
        
    }
    
    
 
    $aHitCounts = array();
    $aHitCountsAvg = array();
    

    
    foreach ($aFPSuccessMerged as $film_id => $aFrames) {
        $aHitCounts[$film_id] = count($aFrames);
    
    
    
    
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
    
   
//     arsort($aHitCountsAvg);
//   $sumaAvg = array_sum($aHitCountsAvg);
//   $aHitCountsPropAvg = array();
//   foreach ($aHitCountsAvg as $film_id => $hitsnum) {
//        $aHitCountsPropAvg[$film_id] = round($hitsnum / $sumaAvg,3);
//   }
//    
    
    
   
    
//    
    
    return $aHitCountsProp;
    
//    $aReturn
}


$time0 = time();
$aServerFilms = array();

$oGlobal = new GlobalData();
//1. create server finger prnts
for ( $num=0; $num<=9; $num++ ){
    $filename = "files/marcin20d/$num.json";
    $aServerFilms[] = getFileJsonToArray($filename);
}




//2. create sended fp
$aRecivedData = $_REQUEST['datas'];
$aRecivedFPColection = convertRecivedDatas($aRecivedData, $oGlobal);


$aHitCountsProp = comapareMain($aRecivedFPColection, $aServerFilms, $oGlobal);

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
