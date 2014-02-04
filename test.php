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

    
class Film{
    public $idFilm;
    function __construct( $idFilm ) {
        $this->idFilm = $idFilm;
    }
    
}

class SuccessInfoFilm extends Film{
    public $aSuccessInfoObjs;
    private $punkty;
    private $punktyKolor;
    function __construct($idFilm) {
        parent::__construct($idFilm);
    }
    /**
     * 
     * @param SuccessInfo $oSuccessInfo
     */
    
    function addSuccess( $oSuccessInfo ){
        $this->aSuccessInfoObjs[] = $oSuccessInfo;
    }
   
    
    
    public function getSuccessPoints( $oGlobal ){
        $this->punkty = 0;
        
        
        $aBonusy = array();
        $aBonusy['tested'] = 1;
        if (is_array($this->aSuccessInfoObjs) ){
            foreach ($this->aSuccessInfoObjs as $klatka_filmu => $oSuccessInfo) {
            
                if ( $oSuccessInfo->bKPOK ){
                    $this->punkty += 1;
                }    
                if ( $oSuccessInfo->bKPOK && $oSuccessInfo->bSilaWektoraKPOK){
                    $this->punkty += 0.25;
                }
            
                
                
                    if ( $oSuccessInfo->ignoreColor){
                        var_dump_spec( "FILM IGNORE MAIN COLOR: $this->idFilm", true );
                    }
                    else{
                        if (  $oSuccessInfo->bMainColorOK   ){
                            $this->punkty += 0.25;
                            $aBonusy['colorMainplus'] += 0.25;
                            if ( $oSuccessInfo->roznicaMainColorow < 66 ||  $oSuccessInfo->roznicaMainColorow >150 ){
                                $this->punkty -= 0.25;
                                $aBonusy['colorMainminus'] -= 0.25;
                            }
                        }
                    }
                
                
                
                //kolory musza sie pokrywac zeby byly w scces->acno wiec luz
                if ( count($oSuccessInfo->aColoryNo) == array_sum($oGlobal->oFPPhone->aColoryNo) ){
                    $aBonusy['colorNOplus'] += 0.1;
                    $this->punkty += 0.1;
                }
                else{
    //                var_dump( $this->idFilm );
                    $this->punkty -= 0.1;
                    $aBonusy['colorNOminus'] -= 0.1;
                }
                
                if (!$oSuccessInfo->bGrayIgnore){
                    if ( $oSuccessInfo->bGrayCwiartkaOK ){
                        $this->punkty += 0.25;
                    }
                    if ( $oSuccessInfo->bGrayCwiartkaDuzaRoznica ){
                        $this->punkty -= 0.25;
                    }
                }
                
                
            } 
        }
        var_dump_spec("Test bonusow punktowych dla filmu: $this->idFilm", true );
        var_dump_spec($aBonusy, true );
        $this->punkty = ( $this->punkty < 0 ) ? 0 : $this->punkty;

        
        return $this->punkty;
    }
}
/**
 * 
 */
class SuccessInfo{
    public $oFPFilm;
    public $oFPPhone;
    public $oGlobal;
    public $bKPOK;
    public $bSilaWektoraKPOK;
    public $bMainColorOK;
    public $aColorNo;
    
    public $ignoreColor;
    public $roznicaMainColorow;
    public $idFilm;
    
    /**
     * 
     * @param int $idFilm
     * @param FrameFingerprintMarcin $oFPFilm
     * @param FrameFingerprintMarcin $oFPPhone
     * @param GlobalData $oGlobal
     * @param bool $bKPOK
     * @param bool $bMainColorOK
     * @param bool $bSilaWektoraKPOK
     */
    function __construct( $idFilm, $oFPFilm, $oFPPhone, $oGlobal, $bKPOK = false, $bMainColorOK = false, $bSilaWektoraKPOK = false ) {
//        var_dump( $idFilm);
        $this->idFilm = $idFilm;
        $this->oFPFilm = $oFPFilm;
        $this->oFPPhone = $oFPPhone;
        $this->oGlobal = $oGlobal;
        $this->bKPOK = $bKPOK;
        $this->bMainColorOK = $bMainColorOK;
        $this->bSilaWektoraKPOK = $bSilaWektoraKPOK;
        $this->roznicaMainColorow = -1;
        $this->bGrayCwiartkaOK = -1;
        $this->bGrayIgnore = false;
        $this->aColorNo = array();
        
        
        $this->bGrayCwiartkaDuzaRoznica = false;
        
        
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
    public $oFPPhone;
    
//    public $aColorNo75;
    
    public function setColors( $aColors ){
        $this->aColors = $aColors;
    }
    
    
}

class FrameFingerprintMarcin{
    public $pt;
    public $cwiartka;
    public $dlugosc;
    public $sumaKP;
    public $propDlSuma;
    public $aColory;
    public $aColoryProc;
    public $aColoryNo;
    
    public $film_id;
    public $grayVector;
    public $grayCwiartka;
    
    
    function FrameFingerprintMarcin( $cords, $cwiartka, $dlugosc, $sumaKP, $grayVector, $grayCwiartka ){
        $this->pt = $cords;
        $this->cwiartka = $cwiartka;
        $this->dlugosc = $dlugosc;
        $this->sumaKP = $sumaKP;
        $this->grayVector = $grayVector;
        $this->grayCwiartka = $grayCwiartka;
        
        $this->aColory = null;
        $this->aColoryProc = array("b"=>0, "g"=>0, "r"=>0);
        $this->aColoryNo = array("b"=>0, "g"=>0, "r"=>0);
        $this->film_id = null;
        
        if( $this->sumaKP == 0 ){
            $this->propDlSuma = 0;
        }
        else{
            $this->propDlSuma = round($this->dlugosc / $this->sumaKP, 4);
        }
        return $this;
    }
    
    function setColors( $aColory ){
        $this->aColory = $aColory;
        $sum = array_sum( $this->aColory );
//        $b =
        if ( $sum > 40 ){
            $this->aColoryProc["b"] = round( 100 * $this->aColory["b"] / $sum, 2);
            $this->aColoryProc["g"] = round( 100 * $this->aColory["g"] / $sum, 2);
            $this->aColoryProc["r"] = round( 100 * $this->aColory["r"] / $sum, 2);
        
            
            if ( $this->aColoryProc["b"] < 20 )
                $this->aColoryNo["b"] = 1;
            if ( $this->aColoryProc["g"] < 20 )
                $this->aColoryNo["g"] = 1;
            if ( $this->aColoryProc["r"] < 20 )
                $this->aColoryNo["r"] = 1;
            
        }
        
        
    }
}




//takie tam 
function var_dump_spec( $datas, $bPre ){
    if ( $_GET['verbose'] == 1){
        if ( $bPre ) echo "<pre>";
        var_dump( $datas );
        if ( $bPre ) echo "</pre>";
    }
}



function getFileJsonToArray( $filename ){
    $json = str_replace( "],]", "]]", file_get_contents($filename));
    $aResult = json_decode($json);
   
    
    
    $aReturn = array();
   // var_dump_spec($json , true);
//    $limit = 180; // 30sek 
//    $limit = 120; // 20sek 
//    $limit = 90; // 15sek 
    $limit = 20; // 10sek
//    $limit = 30; // 6sek  
//    $limit = 10; // 6sek
    
    
    $klatka = ( abs($_REQUEST['deltaT'])*5 );
    $start = intval($klatka - 15);
    $start < 0 ? $start = 0 : $start=$start;
    $koniec = intval($klatka + 5);
//    $start = intval($_REQUEST['tura']) * 18; //0:0 1:30
//    $koniec = (intval($_REQUEST['tura'])+1) * $limit; //0:50 //1:100
//    var_dump( $klatka, $start, $koniec, "<br>" );
    for ( $key=$start; $key<$koniec; $key++){
        $fp = $aResult[$key];
        $oFP = new FrameFingerprintMarcin(new Cords($fp[0][0], $fp[0][1]), $fp[1], $fp[2], $fp[3], $fp[8], $fp[9]);
        if ( $fp[4] > -1 ){
               $oFP->setColors(array("b"=>$fp[4],"g"=>$fp[5],"r"=>$fp[6]/*,"y"=>$fp[7]*/));
        }
        $aReturn[] = $oFP;
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
            $oFP = new FrameFingerprintMarcin(new Cords($fp[0][0], $fp[0][1]), $fp[1], $fp[2], $fp[3], $fp[8], $fp[9]);
//            var_dump_spec( $fp, true );
//            var_dump_spec( $oFP, true );
            
            if ( $fp[4] > -1 ){
               $oFP->setColors( array("b"=>$fp[4],"g"=>$fp[5],"r"=>$fp[6]/*,"y"=>$fp[7]*/) );
               $oGlobal->aColors = $oFP->aColory;
                $oGlobal->oFPPhone = $oFP;
            }
            
            
            
            //            if ( $idFilm == 6){
//            var_dump_spec($oGlobal->oFPPhone, true);
            //                var_dump_spec($oGlobal->oFPPhone->aColory, true);
//            var_dump("<hr>");
            //            }
            
            $aResult[] = $oFP;
        }
    }
    return $aResult;
}

function returnCDifArray( $colors ){
    $aCDifs["bg"] = $colors["b"] - $colors["g"];
        $aCDifs["br"] = $colors["b"] - $colors["r"];
        $aCDifs["rb"] = $colors["r"] - $colors["b"];
        $aCDifs["rg"] = $colors["r"] - $colors["g"];
        $aCDifs["gb"] = $colors["g"] - $colors["b"];
        $aCDifs["gr"] = $colors["g"] - $colors["r"];
        return $aCDifs;
}

/**
 * 
 * @param FrameFingerprintMarcin $oFP
 * @param type $aFilm
 * @param GlobalData $oGlboal
 * @return SuccessInfoFilm
 */
function compareFPWithFilm($oFP, $aFilm, $oGlobal, $idFilm ){
    $aFilmSuccess = array(); 
 //   var_dump( $aFilm );
    /**
     * 
     */
//    $aFilmSuccessObj = array();
    $oFilmSuccess = new SuccessInfoFilm($idFilm);
    if (is_array($aFilm) )
    foreach ($aFilm as $key=>$oFPFilm) {
//        var_dump ( $oFPFilm );
        $oSuccessObj = new SuccessInfo($idFilm, $oFPFilm, $oFP, $oGlobal);
        $klatka_ok = 0;
        if ( abs($oFP->cwiartka - $oFPFilm->cwiartka) <= 0 ){
            $klatka_ok += 1;
            $oSuccessObj->bKPOK = true;
//            echo "+";
        }
        
        if ( !(abs($oFP->propDlSuma - $oFPFilm->propDlSuma) > 0.0005) ){
                $oSuccessObj->bSilaWektoraKPOK = true;
        }
                
           
        //1. sprawdz roznice miedzy kolorami global
//        $aCDifs = returnCDifArray($oGlobal->aColors);
        //1. sprawdz roznice miedzy kolorami klatka
        
        
        
        $maxFilm = array_keys($oFPFilm->aColory, max($oFPFilm->aColory));
        $maxFilmCDif = max(returnCDifArray($oFPFilm->aColory));
        
        
        $maxPhone = array_keys($oGlobal->aColors, max($oGlobal->aColors));
        $maxPhoneCDif = max(returnCDifArray($oGlobal->aColors));
        
        
        $aCDifs = returnCDifArray($oGlobal->aColors);
        
        
        
        /*
         KOLORY
         */
        if ( $maxPhoneCDif < 20 ){
            $oSuccessObj->ignoreColor = true;
        }
        else{
            $oSuccessObj->ignoreColor = false;
            
            if ( $oFPFilm->aColoryNo["b"] &&  $oGlobal->oFPPhone->aColoryNo["b"] ){
                $oSuccessObj->aColoryNo["b"] = 1;
            }
            
            
            if ( $oFPFilm->aColoryNo["g"] &&  $oGlobal->oFPPhone->aColoryNo["g"] ){
                $oSuccessObj->aColoryNo["g"] = 1;
            }
            
            
            
            if ( $oFPFilm->aColoryNo["r"] &&  $oGlobal->oFPPhone->aColoryNo["r"] ){
                $oSuccessObj->aColoryNo["r"] = 1;
            }
            
            if ( $idFilm ==  999){
                var_dump_spec( $oFPFilm->aColory, true );
                var_dump_spec( $oGlobal->oFPPhone->aColory, true );
                var_dump_spec( $oFPFilm->aColoryNo, true );
                var_dump_spec( $oGlobal->oFPPhone->aColoryNo, true );
                
                
                var_dump_spec( $oSuccessObj->aColoryNo, true );
                
                var_dump_spec( "<hr>", true );
            }
            

            
//            var_dump("film:$idFilm=>",$oFPFilm->aColoryProc, $oFPFilm->aColoryNo ,  "<hr>");
//            var_dump("global:",$oGlobal->oFPPhone->aColoryProc,$oGlobal->oFPPhone->aColoryNo,  "<hr>");
            
            
            
//            var_dump("film:$idFilm=>$maxFilm[0]($main_film_proc) $maxPhone[0]($main_global_proc) => $color_prop", "<hr>");
            
            
        

            
            if ( array_sum($oFPFilm->aColory) == 0 ){
                    $oSuccessObj->ignoreColor = true;
            }
            else{
                
                
                if ( $maxFilm[0] == $maxPhone[0] ){
                    $oSuccessObj->bMainColorOK = true;
                    $aGlobalColorsProc = array(
                                               "b"=>round(($oGlobal->aColors["b"] / array_sum($oGlobal->aColors)) * 100, 2),
                                               "g"=>round(($oGlobal->aColors["g"] / array_sum($oGlobal->aColors)) * 100, 2),
                                               "r"=>round(($oGlobal->aColors["r"] / array_sum($oGlobal->aColors)) * 100, 2) );
                    
                    
                    $aFilmColorsProc = array(
                                             "b"=>round(($oFPFilm->aColory["b"] / array_sum($oFPFilm->aColory)) * 100, 2),
                                             "g"=>round(($oFPFilm->aColory["g"] / array_sum($oFPFilm->aColory)) * 100, 2),
                                             "r"=>round(($oFPFilm->aColory["r"] / array_sum($oFPFilm->aColory)) * 100, 2) );
                    
                    
                    
                    
                    $main_global_proc = $aGlobalColorsProc[$maxPhone[0]];
                    $main_film_proc = $aFilmColorsProc[$maxFilm[0]];
                    $color_prop = round(($main_global_proc / $main_film_proc) * 100, 2);
                    $oSuccessObj->roznicaMainColorow = $color_prop;
                    
                }
            }
            
        }
        
        
        /* KIERUNEK GRAYA */
        
//        var_dump_spec ( $oFP->grayVector, true);
//        if ( $idFilm == 1 ){
//        var_dump_spec ( abs($oFPFilm->grayVector[0]), true);
//        }
        //jezeli nei ma jasnego skierowania to olresmy
        if ( abs($oFPFilm->grayVector[0]) <= 0.1 && abs($oFPFilm->grayVector[2]) <= 0.1 ){
           $oSuccessObj->bGrayIgnore = true;
        }
        else{
            $oSuccessObj->bGrayIgnore = false;
        }
        
        
        
        
        
        if (  $oFP->grayCwiartka == $oFPFilm->grayCwiartka ){
            $oSuccessObj->bGrayCwiartkaOK = true;
        }
        else{
            $oSuccessObj->bGrayCwiartkaOK = false;
        }
        
        if ( abs($oFP->grayCwiartka - $oFPFilm->grayCwiartka) <=2 ){
            $oSuccessObj->bGrayCwiartkaDuzaRoznica = false;
        }
        elseif( abs($oFP->grayCwiartka - $oFPFilm->grayCwiartka) >= 14){ //przyapdek gdy cwiartki 15,1 14,0
            $oSuccessObj->bGrayCwiartkaDuzaRoznica = false;
        }
        else{
            $oSuccessObj->bGrayCwiartkaDuzaRoznica = true;
        }
        
        
                
        $oFilmSuccess->addSuccess($oSuccessObj);     
    }//end foreach
    
//    var_dump_spec($aFilmSuccessObj, true);
    return $oFilmSuccess;
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
        $oSuccessFilm = compareFPWithFilm($oFP, $aFilm ,$oGlobal, $key);
        $punkty = $oSuccessFilm->getSuccessPoints( $oGlobal );
        $aFilmsSuccess[$key] += $punkty;
    }

    
    return $aFilmsSuccess;
        
}

function comapareMain( $aRecivedFP, $aServerFilms, $oGlobal ){
    $aFPSuccess = array();
    $aSumaSumarum = array();
    $aSumaSumarumProp = array();
    foreach ($aRecivedFP as $key=>$oFP) {
        $aFilmsSuccess = compareFPWithFilms($oFP, $aServerFilms, $oGlobal);
        $aFPSuccess[$key] = $aFilmsSuccess;
        
        foreach ($aFilmsSuccess as $film_id => $value) {
            $aSumaSumarum[$film_id] += $value;
            
        }
    }
    
    arsort($aSumaSumarum);
    
}
    
    
   
    
    function prepareFilmsJsonBasedOnGet( $get_films_string ){
        $aServerFilms = array(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null);
        $get_films_id = json_decode($get_films_string);
        var_dump_spec( $get_films_id, true );
        if ( count(get_films_id) == 0 ){
            #testuje wszystkie
            for ( $film_id=0; $film_id<=9; $num++ ){
                $filename = "marcin20d/$film_id.json";
                $aServerFilms[$film_id] = getFileJsonToArray($filename);
            }
        }
        else{
            foreach ( $get_films_id AS $film_id ){
                $filename = "marcin20d/$film_id.json";
                $aServerFilms[$film_id] = getFileJsonToArray($filename);
            }
        }
        
        return $aServerFilms;

    }
    
    
    
    //START
    
    
    $time0 = time();
    
    
    #STEP 1
    # based on GET preapre films fingerproints.
    $aServerFilms = prepareFilmsJsonBasedOnGet( $_REQUEST['films'] );
    
    #STEP 2
    # preapre oGlobaldatas contain mobile FP Data
    $aDatas = $_REQUEST['datas'];
    $aMobileFrames = array();
    foreach ( $aDatas AS $m_frame_id=>$sString){
        $aInfo = json_decode($sString);
        $oFP = new FrameFingerprintMarcin( $aInfo[0], $aInfo[1], $aInfo[2], $aInfo[3], $aInfo[8], $aInfo[9] );
        $oFP->setColors( array("b"=>$aInfo[4],"g"=>$aInfo[5],"r"=>$aInfo[6]));
        $aMobileFrames[$m_frame_id] = $oFP;
    }
    
    #STEP 3
    # save to $oGLobal LastFrame Kolors
    $oGlobal = new GlobalData();
    $oGlobal->oFPPhone = $aMobileFrames[count($aMobileFrames)-1];

    
    
    
    
//$suma = array_sum($aHitCounts);
//   $aHitCountsProp = array();
//
    
//    //old one
//    foreach ($aSumaSumarum as $film_id => $punkty) {
//        $sum = array_sum($aSumaSumarum);
//        if ( $sum > 0 ){
//            $prop = round($punkty / $sum,3);
//        }
//        if ( $prop >= 0.1 ){
//            $aSumaSumarumProp[$film_id] = $prop