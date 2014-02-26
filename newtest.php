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
        
        
        $aBonusy = array("bKPOK"=>0,"bKPNO"=>0,"bKPCenterOK"=>0,"bKPCenterNO"=>0,
                         "bColoryNoSame"=>0,"bColoryNoDiff"=>0, "bGrayCwiartkaOK"=>0,"bGrayCwiartkaDuzaRoznica"=>0, "bSRCPblisko"=>0, "bSRC0blisko"=>0,"bSRClipa"=>0 );
        
        if (is_array($this->aSuccessInfoObjs) ){
            $aBonusy['tested'] = 1;
            
            foreach ($this->aSuccessInfoObjs as $klatka_filmu => $oSuccessInfo) {
            
//                var_dump_spec( "$this->idFilm/$klatka_filmu liczebnekratkiw kaltce podbne:". $oSuccessInfo->bSRCPblisko );
                if ( $oSuccessInfo->bSRCPblisko === true ){
                    $this->punkty += 1;
                    $aBonusy['bSRCPblisko'] += 1;
                }
                if ( $oSuccessInfo->bSRC0blisko === true ){
                    $this->punkty += 0.5;
                    $aBonusy['bSRC0blisko'] += 0.5;
                }
                
                if ( $oSuccessInfo->bSRCPblisko !== true &&  $oSuccessInfo->bSRC0blisko !== true ){
                    $this->punkty -= 1;
                    $aBonusy['bSRClipa'] -= 1;
                }
                
                
//                if ( $oSuccessInfo->bKPOK ){
//                    $this->punkty += 0.5;
//                    $aBonusy['bKPOK'] += 0.5;
//                }
//                if ( $oSuccessInfo->bKPNO ){
//                    $this->punkty -= 0.5;
//                    $aBonusy['bKPNO'] -= 0.5;
//                }
                
//                if ( $oSuccessInfo->bKPOK /*&& $oSuccessInfo->bKPCenterOK*/ ){
//                    $this->punkty += 0.5;
//                    $aBonusy['bKPOK'] += 0.5;
//                }
//                if ( $oSuccessInfo->bKPNO /*&& $oSuccessInfo->bKPCenterNO*/ ){
//                    $this->punkty -= 0.5;
//                    $aBonusy['bKPNO'] -= 0.5;
//                }
//                
                
                
                
                
//                
//                if ( $oSuccessInfo->bColoryNoSame === true ){
//                    $this->punkty += 0.25;
//                    $aBonusy['bColoryNoSame'] += 0.25;
//                }
//                
//                if ( $oSuccessInfo->bColoryNoSame === false ){
//                    $this->punkty -= 0.25;
//                    $aBonusy['bColoryNoDiff'] -= 0.25;
//                }
                
                
//                else{
//                    $aBonusy['bKPOK'] -= 0.5;
//                }
//                if ( $oSuccessInfo->bKPOK && $oSuccessInfo->bSilaWektoraKPOK){
//                    $this->punkty += 0.25;
//                }
            
                
//                
//                    if ( $oSuccessInfo->ignoreColor){
//                        var_dump_spec( "FILM IGNORE MAIN COLOR: $this->idFilm", true );
//                    }
//                    else{
//                        if (  $oSuccessInfo->bMainColorOK   ){
//                            $this->punkty += 0.25;
//                            $aBonusy['colorMainplus'] += 0.25;
//                            if ( $oSuccessInfo->roznicaMainColorow < 66 ||  $oSuccessInfo->roznicaMainColorow >150 ){
//                                $this->punkty -= 0.25;
//                                $aBonusy['colorMainminus'] -= 0.25;
//                            }
//                        }
//                    }
                
//                
//                
//                //kolory musza sie pokrywac zeby byly w scces->acno wiec luz
//                if ( count($oSuccessInfo->aColoryNo) == array_sum($oGlobal->oFPPhone->aColoryNo) ){
//                    $aBonusy['colorNOplus'] += 0.1;
//                    $this->punkty += 0.1;
//                }
//                else{
//    //                var_dump( $this->idFilm );
//                    $this->punkty -= 0.1;
//                    $aBonusy['colorNOminus'] -= 0.1;
//                }
//                var_dump_spec( "$this->idFilm testujemy GRAY?=>");
//                var_dump_spec($oSuccessInfo->bGrayIgnore);
                if (!$oSuccessInfo->bGrayIgnore){
                    
//                    var_dump_spec( "$this->idFilm !bGrayIgnore bGrayCwiartkaOK:");
//                    var_dump_spec( $oSuccessInfo->bGrayCwiartkaOK);
//                    if ( $oSuccessInfo->bGrayCwiartkaOK ){
//                        $this->punkty += 0.5;
//                        $aBonusy['bGrayCwiartkaOK'] += 0.5;
//                        var_dump_spec( "$this->idFilm +0.5");
//                    }
                    if ( $oSuccessInfo->bGrayCwiartkaDuzaRoznica ){
                        $this->punkty -= 0.5;
                        $aBonusy['bGrayCwiartkaDuzaRoznica'] -= 0.5;
                        var_dump_spec( "$this->idFilm !bGrayIgnore bGrayCwiartkaDuzaRoznica");
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
    public $bSRCPblisko;
    public $bKPOK;
    public $bKPNO;
    public $bKPCenterOK;
    public $bKPCenterNO;
    public $bSilaWektoraKPOK;
    public $bMainColorOK;
    public $aColorNo;
    public $bColoryNoSame;
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
        $this->bKPNO = -1;
        $this->bSRCPblisko = -1;
        $this->bKPCenterOK = -1;
        $this->bKPCenterNO = -1;
        $this->bMainColorOK = $bMainColorOK;
        $this->bSilaWektoraKPOK = $bSilaWektoraKPOK;
        $this->roznicaMainColorow = -1;
        $this->bGrayCwiartkaOK = -1;
        $this->bColoryNoSame = -1;
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
    
    public $ptC;
    public $cwiartkaC;
    public $dlugoscC;
    
    
    public $propDlSuma;
    public $aColory;
    public $aColoryProc;
    public $aColoryNo;
    
    public $film_id;
    public $grayVector;
    public $grayCwiartka;
    
    public $src_q;
    public $src_qp;
    
    
    function FrameFingerprintMarcin(  ){
        $this->pt = null;
        $this->cwiartka = null;
        $this->dlugosc = null;
        $this->ptC = null;
        $this->cwiartkaC = null;
        $this->dlugoscC = null;
        $this->sumaKP = null;
        $this->grayVector = null;
        $this->src_q = null;
        $this->src_qp = null;
        
        
        $this->aColory = null;
        $this->aColoryProc = array("b"=>0, "g"=>0, "r"=>0);
        $this->aColoryNo = array("b"=>0, "g"=>0, "r"=>0);
        $this->film_id = null;
        
//        if( $this->sumaKP == 0 ){
//            $this->propDlSuma = 0;
//        }
//        else{
//            $this->propDlSuma = round($this->dlugosc / $this->sumaKP, 4);
//        }
        return $this;
    }
    
    function setColors( $aColory ){
        $this->aColory = $aColory;
//        var_dump(
        $sum = array_sum( $this->aColory );
//        $b =
        if ( $sum > 1 ){
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
function var_dump_spec( $datas, $bPre=true ){
    if ( $_GET['verbose'] == 1){
        if ( $bPre ) echo "<pre>";
        var_dump( $datas );
        if ( $bPre ) echo "</pre>";
    }
}



function getFileJsonToArray( $filename ){
    $json = str_replace( "],]", "]]", file_get_contents($filename));
    $aResult = json_decode($json);
   
//    var_dump_spec($aResult);
    
    
    $aReturn = array();
    $limit = 20; // 10sek
//    $limit = 30; // 6sek  
//    $limit = 10; // 6sek
    
    
    $klatka = ( abs($_REQUEST['deltaT'])*5 );
    $start = intval($klatka - 5);
    $start < 0 ? $start = 0 : $start=$start;
    $koniec = intval($klatka + 5);
//    $start = intval($_REQUEST['tura']) * 18; //0:0 1:30
//    $koniec = (intval($_REQUEST['tura'])+1) * $limit; //0:50 //1:100
//    var_dump( $klatka, $start, $koniec, "<br>" );
    for ( $key=$start; $key<$koniec; $key++){
        $fp = $aResult[$key];
        $vfakedall = $fp[0];
        $vfakedcenter = $fp[1];
        
//        var_dump_spec( $fp );
        $oFP = new FrameFingerprintMarcin();
        $oFP->pt = new Cords($vfakedall[0][0], $vfakedall[0][1]);
        $oFP->cwiartka = $vfakedall[1];
        $oFP->dlugosc = $vfakedall[2];
        $oFP->ptC = new Cords($vfakedcenter[0][0], $vfakedcenter[0][1]);
        $oFP->cwiartkaC = $vfakedcenter[1];
        $oFP->dlugoscC = $vfakedcenter[2];
        
        $oFP->sumaKP = $fp[2];
        $oFP->grayVector = $fp[7];
        $oFP->grayCwiartka = $fp[8];
        
        $oFP->src_q = $fp[10];
        $oFP->src_qp = $fp[11];
        
        
        
        if ( $fp[4] > -1 ){
               $oFP->setColors(array("b"=>$fp[3],"g"=>$fp[4],"r"=>$fp[5]/*,"y"=>$fp[6]*/));
        }
        
//        var_dump_spec( $oFP );
        
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


    
    
   
    
    function prepareFilmsJsonBasedOnGet( $get_films_string ){
        $aServerFilms = array(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null);
        $get_films_id = json_decode($get_films_string);
        if ( count($get_films_id) == 0 ){
            #testuje wszystkie
            for ( $film_id=0; $film_id<=9; $film_id++ ){
                $filename = "files/marcin20d/$film_id.json";
//                $filename = "marcin20d/$film_id.json";
                $aServerFilms[$film_id] = getFileJsonToArray($filename);
            }
        }
        else{
            foreach ( $get_films_id AS $film_id ){
                $filename = "files/marcin20d/$film_id.json";
//                $filename = "marcin20d/$film_id.json";
                $aServerFilms[$film_id] = getFileJsonToArray($filename);
            }
        }
        
//        if ( $film_id == 1){
        
//        }
//        exit;
        
        return $aServerFilms;

    }
    
    
    function filtrFilmsForOnlyOneWithMainColor( $aServerFilms, $proguznanania = 60 ){
        $aServerFilmsTmp = array(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null);
        $aTest = array();
        foreach( $aServerFilms AS $film_id=>$aFrames ){
            
            if( count($aFrames) ){
                foreach ( $aFrames AS $frame_id=>$oFP ){
//                    if ( $film_id == 1){
//                        var_dump_spec( $oFP, true );
//                    }
                    if ( $oFP->aColoryProc["b"] > $proguznanania){
                        $aServerFilmsTmp["b"][$film_id] = $aFrames;
                        $aTest["b"][$film_id]++;
//                      break;
                    }
                    if ( $oFP->aColoryProc["g"] > $proguznanania){
                        $aServerFilmsTmp["g"][$film_id] = $aFrames;
                        $aTest["g"][$film_id]++;
//                      break;
                    }
                    if ( $oFP->aColoryProc["r"] > $proguznanania){
                        $aServerFilmsTmp["r"][$film_id] = $aFrames;
                        $aTest["r"][$film_id]++;
//                      break;
                    }
                }
            }
        }
        
        var_dump_spec( "MOVIES WITH MAIN COLORS ($proguznanania):", true );
        var_dump_spec( $aTest, true );
        return $aServerFilmsTmp;
        
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
       
        $oFilmSuccess = new SuccessInfoFilm($idFilm);
        
        
        $podobienstwoSRCPTotalZero = 0;
        $podobienstwoSRCPTotal = 0;
        if (is_array($aFilm) )
            foreach ($aFilm as $key=>$oFPFilm) {
                
                $oSuccessObj = new SuccessInfo($idFilm, $oFPFilm, $oFP, $oGlobal);
                
                
                
                
//                var_dump_spec ( "film: $idFilm ->");
//                var_dump_spec ( $oFP->src_qp );
//                var_dump_spec ( $oFPFilm->src_qp );
                $podobienstwoSRCP = 0;
                $podobienstwoSRCPCount = 0;
                $podobienstwoSRCPZero = 0;
                $podobienstwoSRCPZeroCount = 0;
                for( $q=0; $q<24; $q++){
                    $diffsrc = abs($oFPFilm->src_qp[$q] - $oFP->src_qp[$q]);
//                    $propsrc = $oFPFilm->src_qp[$q] / $oFP->src_qp[$q];
//                    if ($diffsrc <= 5 && )
                    if ( $oFPFilm->src_qp[$q] >= 10 ){
                        $podobienstwoSRCPCount++;
                        $propsrc = $oFP->src_qp[$q] / $oFPFilm->src_qp[$q] ;
                        if ( $propsrc <= 2.0 && $propsrc >= 0.5){
//                            var_dump_spec ( "MORE10 - q:$q cam:". $oFP->src_qp[$q] ." - film:".$oFPFilm->src_qp[$q] . " film-cam:$diffsrc cam/film:$propsrc " );
                            $podobienstwoSRCP++;
                            
                        }
                    }
                    else if ( $oFPFilm->src_qp[$q] >= 5 ){
                        $podobienstwoSRCPCount++;
                        $propsrc = $oFP->src_qp[$q] / $oFPFilm->src_qp[$q] ;
                        if ( $propsrc <= 2.0 && $propsrc >= 0.5){
//                            var_dump_spec ( "MORE5 - q:$q cam:". $oFP->src_qp[$q] ." - film:".$oFPFilm->src_qp[$q] . " film-cam:$diffsrc cam/film:$propsrc " );
                            $podobienstwoSRCP++;
                            
                        }
                    }
                    
                    else if ( $oFPFilm->src_qp[$q] == 0 ){
                        $podobienstwoSRCPZeroCount++;
                        if ( $diffsrc == 0 ){
//                         var_dump_spec ( "ZERO 0 - q:$q cam:". $oFP->src_qp[$q] ." - film:".$oFPFilm->src_qp[$q] . " film-cam:$diffsrc" );
                            $podobienstwoSRCPZero++;
//                            $podobienstwoSRCPTotalZero++;
                        }
                    }
                }
                if ( $podobienstwoSRCPCount ){
                    if ( $podobienstwoSRCP/$podobienstwoSRCPCount >= 0.5 ){
                        $podobienstwoSRCPTotal++;
                        $oSuccessObj->bSRCPblisko=true;
                        //
                    }
                }
                
                if ( $podobienstwoSRCPZeroCount ){
//                    var_dump_spec ( "film: $idFilm klatka Filmu: $key -> podobienstwo: $podobienstwoSRCP/$podobienstwoSRCPCount podobZero:  $podobienstwoSRCPZero/$podobienstwoSRCPZeroCount ");
                    if ( $podobienstwoSRCPZero/$podobienstwoSRCPZeroCount >= 0.5 ){
                        $podobienstwoSRCPTotalZero++;
                        $oSuccessObj->bSRC0blisko=true;
                        //
                    }
                }
                
                
                
                
//                $bSRCPblisko
                
                $qdif = abs($oFP->cwiartka - $oFPFilm->cwiartka);
                if ( $qdif <= 2 || $qdif >= 14  ){
                    $oSuccessObj->bKPOK = true;
//                    var_dump_spec( "CWIARTKA OK with film frame: $oFP->cwiartka  $oFPFilm->cwiartka => $qdif", true );
//                    var_dump_spec ( "film: $idFilm -> CWIARTKA FAKED OK $qdif = abs($oFP->cwiartka - $oFPFilm->cwiartka)", true);
                }
                else{
                    $oSuccessObj->bKPOK = false;
                }
                
                
                if ( $qdif >= 5 && $qdif <= 11  ){
                    $oSuccessObj->bKPNO = true;
//                    var_dump_spec ( "film: $idFilm -> CWIARTKA FAKED TOTALLY WRONG $qdif = abs($oFP->cwiartka - $oFPFilm->cwiartka)", true);
                    
                }
                else{
                    $oSuccessObj->bKPNO = false;
                }
                
                
                
                $qdif2 = abs($oFP->cwiartkaC - $oFPFilm->cwiartkaC);
                if ( $qdif2 <= 2 || $qdif2 >= 14  ){
                    $oSuccessObj->bKPCenterOK = true;
                    //                    var_dump_spec( "CWIARTKA OK with film frame: $oFP->cwiartka  $oFPFilm->cwiartka => $qdif", true );
//                    var_dump_spec ( "film: $idFilm -> CWIARTKA FAKED CENTER OK $qdif2 = abs($oFP->cwiartkaC - $oFPFilm->cwiartkaC)", true);
                }
                else{
                    $oSuccessObj->bKPCenterOK = false;
                }
                
                
                if ( $qdif2 >= 5 && $qdif2 <= 11  ){
                    $oSuccessObj->bKPCenterNO = true;
                    var_dump_spec ( "film: $idFilm -> CWIARTKA FAKED CENTER TOTALLY WRONG $qdif2 = abs($oFP->cwiartkaC - $oFPFilm->cwiartkaC)", true);
                    
                }
                else{
                    $oSuccessObj->bKPCenterNO = false;
                }
                
                
                
                
                
                
                
//                if ( $idFilm == 1){
//                    
//                    var_dump_spec( $oFP->cwiartka, true);
//                    var_dump_spec( $oFPFilm->cwiartka , true);
//                    var_dump_spec( $oSuccessObj->bKPOK , true);
//                    var_dump_spec( $oSuccessObj->bKPNO , true);
//                    
//                    var_dump_spec( "<hr><hr>", true);
//                }

                
                
//                if ( !(abs($oFP->propDlSuma - $oFPFilm->propDlSuma) > 0.0005) ){
//                    $oSuccessObj->bSilaWektoraKPOK = true;
//                    var_dump_spec( "SILA CWIARTKA OK with film frame: $key", true );
//                }
                
                
                //1. sprawdz roznice miedzy kolorami global
                //        $aCDifs = returnCDifArray($oGlobal->aColors);
                //1. sprawdz roznice miedzy kolorami klatka

                
                
                
                
//                
//                
//                $maxFilm = array_keys($oFPFilm->aColory, max($oFPFilm->aColory));
//                $maxFilmCDif = max(returnCDifArray($oFPFilm->aColory));
////
                
                //jezeli zdazy sie ze zarowno klatka Mob i klatka Film maja te same kolory < 20 to +1
//                var_dump_spec( $oGlobal->oFPPhone->aColoryProc, true );
//                var_dump_spec( $oFPFilm->aColoryProc, true );
                
//                if ( $oGlobal->oFPPhone->aColoryN['b'] < 15 && $oFPFilm->aColoryProc['b'] < 15 ){
//                    $oSuccessObj->aColoryNo["b"] = 1;
//                }
//                if ( $oGlobal->oFPPhone->aColoryProc['g'] < 15 && $oFPFilm->aColoryProc['g'] < 15 ){
//                    $oSuccessObj->aColoryNo["g"] = 1;
//                }
//                if ( $oGlobal->oFPPhone->aColoryProc['r'] < 15 && $oFPFilm->aColoryProc['r'] < 15 ){
//                    $oSuccessObj->aColoryNo["r"] = 1;
//                }
                
//                var_dump_spec( $oSuccessObj->aColoryNo, true );
//                echo $idFilm;
//                var_dump_spec( $oGlobal->oFPPhone->aColoryNo, true );
//                var_dump_spec( $oFPFilm->aColoryNo, true );
                
                
                if( $oGlobal->oFPPhone->aColoryNo == $oFPFilm->aColoryNo ){
                    $oSuccessObj->bColoryNoSame = true;
//                  var_dump_spec( "SAME", true );
                }
                else{
                    $oSuccessObj->bColoryNoSame = false;
                }
                
                
//                if ( $idFilm == 1){
//                    
//                    var_dump_spec( $oGlobal->oFPPhone->aColory, true );
//                    var_dump_spec( $oGlobal->oFPPhone->aColoryProc, true );
//                    var_dump_spec( $oGlobal->oFPPhone->aColoryNo, true );
//                    var_dump_spec( "<hr>", true);
//                    
//                    var_dump_spec( $oFPFilm->aColory, true );
//                    var_dump_spec( $oFPFilm->aColoryProc, true );
//                    var_dump_spec( $oFPFilm->aColoryNo, true );
//                    var_dump_spec( "<hr>", true);
//                    var_dump_spec( $oSuccessObj->bColoryNoSame , true );
//                    var_dump_spec( "<hr><hr>", true);
//                }

                
                
                
//                echo "<hr>";
                
                
                
//                $maxPhone = array_keys($oGlobal->oFPPhone->aColoryProc, max($oGlobal->aColors));
//                $maxPhoneCDif = max(returnCDifArray($oGlobal->aColors));
//
//                
//                $aCDifs = returnCDifArray($oGlobal->aColors);
//                
//                
//                
//                /*
//                 KOLORY
//                 */
//                if ( $maxPhoneCDif < 20 ){
//                    $oSuccessObj->ignoreColor = true;
//                }
//                else{
//                    $oSuccessObj->ignoreColor = false;
//                    
//                    if ( $oFPFilm->aColoryNo["b"] &&  $oGlobal->oFPPhone->aColoryNo["b"] ){
//                        $oSuccessObj->aColoryNo["b"] = 1;
//                    }
//                    
//                    
//                    if ( $oFPFilm->aColoryNo["g"] &&  $oGlobal->oFPPhone->aColoryNo["g"] ){
//                        $oSuccessObj->aColoryNo["g"] = 1;
//                    }
//                    
//                    
//                    
//                    if ( $oFPFilm->aColoryNo["r"] &&  $oGlobal->oFPPhone->aColoryNo["r"] ){
//                        $oSuccessObj->aColoryNo["r"] = 1;
//                    }
//                    
//                    if ( $idFilm ==  999){
//                        var_dump_spec( $oFPFilm->aColory, true );
//                        var_dump_spec( $oGlobal->oFPPhone->aColory, true );
//                        var_dump_spec( $oFPFilm->aColoryNo, true );
//                        var_dump_spec( $oGlobal->oFPPhone->aColoryNo, true );
//                        
//                        
//                        var_dump_spec( $oSuccessObj->aColoryNo, true );
//                        
//                        var_dump_spec( "<hr>", true );
//                    }
//                    
//                    
//                    
//                    //            var_dump("film:$idFilm=>",$oFPFilm->aColoryProc, $oFPFilm->aColoryNo ,  "<hr>");
//                    //            var_dump("global:",$oGlobal->oFPPhone->aColoryProc,$oGlobal->oFPPhone->aColoryNo,  "<hr>");
//                    
//                    
//                    
//                    //            var_dump("film:$idFilm=>$maxFilm[0]($main_film_proc) $maxPhone[0]($main_global_proc) => $color_prop", "<hr>");
//                    
//                    
//                    
//                    
//                    
//                    if ( array_sum($oFPFilm->aColory) == 0 ){
//                        $oSuccessObj->ignoreColor = true;
//                    }
//                    else{
//                        
//                        
//                        if ( $maxFilm[0] == $maxPhone[0] ){
//                            $oSuccessObj->bMainColorOK = true;
//                            $aGlobalColorsProc = array(
//                                                       "b"=>round(($oGlobal->aColors["b"] / array_sum($oGlobal->aColors)) * 100, 2),
//                                                       "g"=>round(($oGlobal->aColors["g"] / array_sum($oGlobal->aColors)) * 100, 2),
//                                                       "r"=>round(($oGlobal->aColors["r"] / array_sum($oGlobal->aColors)) * 100, 2) );
//                            
//                            
//                            $aFilmColorsProc = array(
//                                                     "b"=>round(($oFPFilm->aColory["b"] / array_sum($oFPFilm->aColory)) * 100, 2),
//                                                     "g"=>round(($oFPFilm->aColory["g"] / array_sum($oFPFilm->aColory)) * 100, 2),
//                                                     "r"=>round(($oFPFilm->aColory["r"] / array_sum($oFPFilm->aColory)) * 100, 2) );
//                            
//                            
//                            
//                            
//                            $main_global_proc = $aGlobalColorsProc[$maxPhone[0]];
//                            $main_film_proc = $aFilmColorsProc[$maxFilm[0]];
//                            $color_prop = round(($main_global_proc / $main_film_proc) * 100, 2);
//                            $oSuccessObj->roznicaMainColorow = $color_prop;
//                            
//                        }
//                    }
//                    
//                }
//                
//                
//                /* KIERUNEK GRAYA */
//                
//                //        var_dump_spec ( $oFP->grayVector, true);
//                //        if ( $idFilm == 1 ){
//        var_dump_spec ( abs($oFPFilm->grayVector[1]), true);
//                //        }
                //jezeli nei ma jasnego skierowania to olresmy
                if ( abs($oFPFilm->grayVector[0]) <= 0.02 && abs($oFPFilm->grayVector[1]) <= 0.02 ){
                    var_dump_spec ( "FIML IGNORE GRAY", true);
                     var_dump_spec ( $oFPFilm->grayVector, true);
                    $oSuccessObj->bGrayIgnore = true;
                }
                else{
                    $oSuccessObj->bGrayIgnore = false;
                    
//                    var_dump_spec ( "FIML NOT IGNORE GRAY", true);
//                    var_dump_spec ( $oFPFilm->grayVector, true);
                    
                    //ezeli film ni chce byc ignorowany to jeszcze upewnij sie ze mobile nie ignore
                    if ( abs($oFP->grayVector[0]) <= 0.02 && abs($oFP->grayVector[1]) <= 0.02 ){
//                        var_dump_spec ( "CAMERA  IGNORE GRAY", true);
//                        var_dump_spec ( $oFP->grayVector, true);
                        
                        $oSuccessObj->bGrayIgnore = true;
                    }
                    
                }
                
//                var_dump_spec (                    $oSuccessObj->bGrayIgnore, true);
                
                
                
                //
//                
//                
//                
//
                $qdifGray = abs($oFP->grayCwiartka - $oFPFilm->grayCwiartka);
                
                
                if ( $qdifGray <= 2 || $qdif >= 14  ){
//                    var_dump_spec ( "CWIARTKA SZAROSCI OK $qdifGray", true);
  
//                if (  $oFP->grayCwiartka == $oFPFilm->grayCwiartka ){
                    $oSuccessObj->bGrayCwiartkaOK = true;
                }
                else{
//                    var_dump_spec ( "film: $idFilm -> CWIARTKA SZAROSCI NOT OK $oFP->grayCwiartka - $oFPFilm->grayCwiartka = $qdifGray", true);
                    $oSuccessObj->bGrayCwiartkaOK = false;
                }
//
                
//                
//                if ( abs($oFP->grayCwiartka - $oFPFilm->grayCwiartka) <=2 ){
//                    $oSuccessObj->bGrayCwiartkaDuzaRoznica = false;
//                }
//                elseif( abs($oFP->grayCwiartka - $oFPFilm->grayCwiartka) >= 14){ //przyapdek gdy cwiartki 15,1 14,0
//                    $oSuccessObj->bGrayCwiartkaDuzaRoznica = false;
//                }
//                else{
//                    $oSuccessObj->bGrayCwiartkaDuzaRoznica = true;
//                }
//
//                
                
                $oFilmSuccess->addSuccess($oSuccessObj);     
            }//end foreach
        
        
        var_dump_spec ( "film: $idFilm lacznie -> podobienstwo: $podobienstwoSRCPTotal podobZero:  $podobienstwoSRCPTotalZero");
        
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
            if ( count($aFilm)){
                $oSuccessFilm = compareFPWithFilm($oFP, $aFilm ,$oGlobal, $key);
                $punkty = $oSuccessFilm->getSuccessPoints( $oGlobal );
                $aFilmsSuccess[$key] += $punkty;
            }
        }
        
        
        return $aFilmsSuccess;
        
    }
    
    function comapareMain( $aRecivedFP, $aServerFilms, $oGlobal ){
        
        var_dump_spec( "COMPARE MAIN BEGIN", true);
//        var_dump_spec( $aRecivedFP);
        
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
        
        var_dump_spec( "COMPARE MAIN END", true);
//        var_dump_spec( $aSumaSumarum, true);
        
        return $aSumaSumarum;
        
        
    }
    
    
    
    function comapareMainGlobalOnly( $aServerFilms, $oGlobal ){
        
        var_dump_spec( "COMPARE MAIN GLOBAL BEGIN", true);
        
        $aFPSuccess = array();
        $aSumaSumarum = array();
        $aSumaSumarumProp = array();
//        foreach ($aRecivedFP as $key=>$oFP) {
            $aFilmsSuccess = compareFPWithFilms($oGlobal->oFPPhone, $aServerFilms, $oGlobal);
            $aFPSuccess[$key] = $aFilmsSuccess;
            
            foreach ($aFilmsSuccess as $film_id => $value) {
                $aSumaSumarum[$film_id] += $value;
                
            }
//        }
        
        arsort($aSumaSumarum);
        
        var_dump_spec( "COMPARE MAIN GLOBAL END", true);
        //        var_dump_spec( $aSumaSumarum, true);
        
        return $aSumaSumarum;
        
        
    }
    
    function filtrFilmsForOnlyOneWithNearGrayVector( $aServerFilms, $cwiartka_telefon ){
        var_dump_spec( $cwiartka_telefon );
        $aServerFilmsTmp = array(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null);
        $aTest = array();
        foreach( $aServerFilms AS $film_id=>$aFrames ){
            if( count($aFrames) ){
                foreach ( $aFrames AS $frame_id=>$oFP ){
//
                    $qdifGray = abs($cwiartka_telefon - $oFP->grayCwiartka);
                    
                                  
//                    if ( $qdifGray <= 1 || $qdif >= 15  ){
////                        var_dump_spec ( "CWIARTKA SZAROSCI VERY OK $film_id", true);
////                        $aServerFilmsTmp[$film_id] = $aFrames;
//                        $aTest["SUPEROK"][$film_id]++;
//                    }
//                    if ( $qdifGray <= 2 || $qdif >= 14  ){
////                        var_dump_spec ( "CWIARTKA SZAROSCI VERY OK $film_id", true);
////                        $aServerFilmsTmp[$film_id] = $aFrames;
//                        $aTest["VERYOK"][$film_id]++;
//                    }
                    if ( $qdifGray <= 3 || $qdif >= 13  ){
//                        var_dump_spec ( "CWIARTKA SZAROSCI OK $film_id", true);
                        $aServerFilmsTmp[$film_id] = $aFrames;
                        $aTest["OK"][$film_id]++;
                        //                      break;
                    }
                   
                }
            }
        }
        
        var_dump_spec( "MOVIES WITH OK GRAY:", true );
        var_dump_spec( $aTest, true );
        return $aServerFilmsTmp;
        
    }
    
    
    function filtrFilmsForOnlyOneWithNearGraySila( $aServerFilms, $sila ){
        var_dump_spec( "filtrFilmsForOnlyOneWithNearGraySila" );
        $maxdiff_ok = $sila * 0.75;
        $maxdiff_ok = $maxdiff_ok < 5 ? 5 : $maxdiff_ok;
        var_dump_spec( "sila: $sila maxdif: $maxdiff_ok");
        $aServerFilmsTmp = array(null,null,null,null,null,null,null,null,null,null,null,null,null,null,null,null);
        $aTest = array();
        foreach( $aServerFilms AS $film_id=>$aFrames ){
            if( count($aFrames) ){
                foreach ( $aFrames AS $frame_id=>$oFP ){
                    //
                    $sila_fp = round(sqrt(pow($oFP->grayVector[0],2) + pow($oFP->grayVector[1],2)), 2);
                    $diffsilafp = abs($sila_fp - $sila);
//                    var_dump_spec("$film_id=> $diffsilafp = abs($sila_fp - $sila);");
                    if ( $diffsilafp <= $maxdiff_ok ){
                        $aServerFilmsTmp[$film_id] = $aFrames;
                        $aTest["OK"][$film_id]++;
                    }
                }
            }
        }
        var_dump_spec( "MOVIES WITH OK SILA:", true );
        var_dump_spec( $aTest, true );
        return $aServerFilmsTmp;
    }
    
    
    function changeCountToDif( &$aProbka, $src, $out ){
        $lastval = 0;
        foreach ( $aProbka[$src] AS $key=>$kpc ){
            if ( $key == 0 ){ $aProbka[$out][0] = "s";  }
            else{
                $dif = abs($kpc - $lastval);
                if ( $dif >= 2 ){
                    if ( $lastval == 0 ){
                        $aProbka[$out][$key] = -1;
                    }
                    else{
                        $difproc = abs($kpc / $lastval);
                        if ( $difproc >= 1.50 ){ $aProbka[$out][$key] = 1; }
                        elseif ( $difproc <= 0.50 ){ $aProbka[$out][$key] = -1; }
                        else { $aProbka[$out][$key] = 0; }
                    }
                }
                else{
                    $aProbka[$out][$key] = 0;
                }
            }
            $lastval = $kpc;
        }
    }
    
    function getProbka( $aBadana, $frame_s, $frame_e ){
        $aProbka = array();
        $aProbka["kp"] = array_slice($aBadana[0], $frame_s, $frame_e); 
        changeCountToDif( $aProbka, "kp", "kpDif" ); 
        $aProbka["kpT"] = array_slice($aBadana[1], $frame_s, $frame_e);
        changeCountToDif( $aProbka, "kpT", "kpTDif" );
        $aProbka["kpB"] = array_slice($aBadana[2], $frame_s, $frame_e);
        changeCountToDif( $aProbka, "kpB", "kpBDif" );
        $aProbka["kpL"] = array_slice($aBadana[3], $frame_s, $frame_e);
        changeCountToDif( $aProbka, "kpL", "kpLDif" );
        $aProbka["kpR"] = array_slice($aBadana[4], $frame_s, $frame_e);
        changeCountToDif( $aProbka, "kpR", "kpRDif" );
        $aProbka["q"] = array_slice($aBadana[5], $frame_s, $frame_e);
        $aProbka["qstr"] = array_slice($aBadana[6], $frame_s, $frame_e);
        
        return $aProbka;
    }
    //START
    
    
    
    
    
    function testFilmRanges( $aKP, $aProbka, $probeFramesCount ){
        $aKPCombination = array();
        for( $i=0; $i<count($aKP)-$probeFramesCount+1; $i++ ){
            $aSliced = array_slice( $aKP, $i, $probeFramesCount );;
            $aKPCombination[$i] = $aSliced;
        }
        
        
        $aKPCombinationDifs = array();
        $aKPCombinationDifsSum = array();
        $aKPCombinationDifsBit = array();
        $aKPCombinationDifsBitSum = array();
        foreach( $aKPCombination AS $key=>$aCombo ){
            $aDifs = array();
            $aBits = array();
            foreach( $aCombo AS $ii=>$kp ){
                $abs = abs($aProbka['kp'][$ii] - $kp);
//                           printf("\n kp: $kp - ap:". $aProbka['kp'][$ii]);
                $aDifs[] = $abs;
//                var_dump_spec( $kp );
//                var_dump_spec( $kp/2 );
                if ( $abs <= $kp/2 ){
                    $aBits[] = 1;
                }
            }
            $aKPCombinationDifs[$key] = $aDifs;
            $aKPCombinationDifsSum[$key] = array_sum($aDifs);
            $aKPCombinationDifsBit[$key] = $aBits;
            $aKPCombinationDifsBitSum[$key] = array_sum($aBits);
        }
        
        $aKPCombinationDifsBitSumMore10 = array();
        foreach( $aKPCombinationDifsBitSum AS $key=>$val){
            if ( $val >= $probeFramesCount/2 ){
                $aKPCombinationDifsBitSumMore10[] = array("s"=>$key, "e"=>$key+$probeFramesCount, "sila"=>$val);
            }
        }
        
        
//        var_dump_spec( $aKPCombinationDifs );
        //zwroc zakresy bo ja ksie zakladki robia to poszerzamy tablice
        $aTMP = array();
        
        foreach( $aKPCombinationDifsBitSumMore10 AS $key=>$aA){
            for( $i=$aA['s']; $i<=$aA['e']; $i++ ){
                $aTMP[] = $i;
            }
        }
        
        $aTMP = array_unique($aTMP);
        
        $aRanges = array();
        $lastNum = -666;
        $count = -1;
        foreach( $aTMP AS $key=>$frameNum){
            if ( $lastNum == $frameNum - 1 ){
                $aRanges[$count]["k"] = $frameNum;
            }
            else{
                $count++;
                $aRanges[$count] = array("s"=>$frameNum, "k"=>$frameNum );
            }
            $lastNum = $frameNum;
        }
        
        var_dump_spec($aRanges);
        
    }
  
    
    //T/B
    function testFilmRanges2( $bKP, $aProbka, $probeFramesCount, $filmid ){
        $aKPCombination = array();
        
        $aT = $bKP[1];
        $aB = $bKP[2];
        
        
        
        for( $i=0; $i<count($aT)-$probeFramesCount+1; $i++ ){
            $aSlicedT = array_slice( $aT, $i, $probeFramesCount );
            $aSlicedB = array_slice( $aB, $i, $probeFramesCount );
            $aKPCombination[$i]["t"] = $aSlicedT;
            $aKPCombination[$i]["b"] = $aSlicedB;
        }
        
//        var_dump_spec( $aKPCombination );
//        exit;
        
        $aKPCombinationDifs = array();
        $aKPCombinationDifsSum = array();
        $aKPCombinationDifsBit = array();
        $aKPCombinationDifsBitSum = array();
        for ( $f=0; $f<count($aKPCombination); $f++){
            $aComboT = $aKPCombination[$f]['t'];
            $aComboB = $aKPCombination[$f]['b'];
//        foreach( $aKPCombination AS $key=>$aCombo ){
            $aDifs = array();
            $aBits = array();
            
//            var_dump_spec( $aComboT );
//            var_dump_spec( $aComboB );
            foreach( $aComboT AS $ii=>$kp ){
                //0=>1
                $aComboT[$ii] = $aComboT[$ii] == 0 ? 1 : $aComboT[$ii];
                $aComboB[$ii] = $aComboB[$ii] == 0 ? 1 : $aComboB[$ii];
                $aProbka['kpT'][$ii] = $aProbka['kpT'][$ii] == 0 ? 1 : $aProbka['kpT'][$ii];
                $aProbka['kpB'][$ii] = $aProbka['kpB'][$ii] == 0 ? 1 : $aProbka['kpB'][$ii];
                
                $prop = $aComboT[$ii] / $aComboB[$ii];
                $propC = $aProbka['kpT'][$ii] / $aProbka['kpB'][$ii];
//                if ( $filmid == 1 ){
//                    var_dump_spec( $filmid ."(".$f . ")=>" . $prop . " ??? " . $propC );
//                }
                
                if ( $prop >= 5 && $propC >= 5 ){
//                    var_dump_spec(">5>5");
                    $aBits[] = 1;
                }
                else if ( $prop > 5  ){
                    $dif = abs( $prop - $propC );
                    $maxdif = $prop/2;
                    if ( $dif <= $maxdif ){
                        $aBits[] = 1;
                    }
//                                     if ( $filmid == 1 ) { var_dump_spec($filmid ."(".$f . ")=>$prop / $propC => dif: $dif ?? $maxdif"); }
                }
                else if ( $prop <= 5 && $prop > 2 ){
                    $dif = abs( $prop - $propC );
                    $maxdif = $prop/2;
                    if ( $dif <= $maxdif ){
                        $aBits[] = 1;
                    }
//                    if ( $filmid == 1 ) { var_dump_spec($filmid ."(".$f . ")=>$prop / $propC => dif: $dif ?? $maxdif"); }
                }
                else if ( $prop <= 2 && $prop > 1.5 ){
                    $dif = abs( $prop - $propC );
                    $maxdif = $prop/2;
                    if ( $dif <= $maxdif ){
                        $aBits[] = 1;
                    }
//                    if ( $filmid == 0 ) { var_dump_spec($filmid ."(".$f . ")=>$prop / $propC => dif: $dif ?? $maxdif"); }
//                                        if ( $filmid == 1 ) { var_dump_spec($filmid ."(".$f . ")=>$prop / $propC => dif: $dif ?? $maxdif"); }
                }
                else{
//                    if ( $filmid == 1 ) { var_dump_spec($filmid ."(".$f . ")=>$prop / $propC => dif: $dif ?? $maxdif"); }
                }
                
//                else{
                
//                }
//
//                if ( ($prop >= 3 && $prop < 5) && ($propC >= 3 && $propC < 5) ){
//                    if ( $filmid == 1 ) { var_dump_spec($filmid ."(".$f . ")=>(3,5)"); }
//                    $aBits[] = 1;
//                }
//                if ( ($prop >= 1 && $prop < 3) && ($propC >= 1 && $propC < 3) ){
//                    if ( $filmid == 1 ) { var_dump_spec($filmid ."(".$f . ")=>(1,3)"); }
//                    $aBits[] = 1;
//                }
//                
//                $abs = abs($aProbka['kp'][$ii] - $kp);
//                //                           printf("\n kp: $kp - ap:". $aProbka['kp'][$ii]);
//                $aDifs[] = $abs;
//                //                var_dump_spec( $kp );
//                //                var_dump_spec( $kp/2 );
//                if ( $abs <= $kp/2 ){
//                    $aBits[] = 1;
//                }
            }
            $aKPCombinationDifs[$f] = $aDifs;
            $aKPCombinationDifsSum[$f] = array_sum($aDifs);
            $aKPCombinationDifsBit[$f] = $aBits;
            $aKPCombinationDifsBitSum[$f] = array_sum($aBits);
        }
        
        if ( $filmid == 1 ){
//            var_dump_spec($aKPCombinationDifsBitSum);
        }
        
        $aKPCombinationDifsBitSumMore10 = array();
        foreach( $aKPCombinationDifsBitSum AS $key=>$val){
            if ( $val >= $probeFramesCount/2 ){
                $aKPCombinationDifsBitSumMore10[] = array("s"=>$key, "e"=>$key+$probeFramesCount, "sila"=>$val);
            }
        }
        
        
        //        var_dump_spec( $aKPCombinationDifs );
        //zwroc zakresy bo ja ksie zakladki robia to poszerzamy tablice
        $aTMP = array();
        
        foreach( $aKPCombinationDifsBitSumMore10 AS $key=>$aA){
            for( $i=$aA['s']; $i<=$aA['e']; $i++ ){
                $aTMP[] = $i;
            }
        }
        
        $aTMP = array_unique($aTMP);
        
        $aRanges = array();
        $lastNum = -666;
        $count = -1;
        foreach( $aTMP AS $key=>$frameNum){
            if ( $lastNum == $frameNum - 1 ){
                $aRanges[$count]["k"] = $frameNum;
            }
            else{
                $count++;
                $aRanges[$count] = array("s"=>$frameNum, "k"=>$frameNum );
            }
            $lastNum = $frameNum;
        }
        
        return $aRanges;
    }

    
    
    
    function getCorrectRangesCombos( $aCombosFilm, $danezprobki, $probeFramesCount, $delta = 0 ){
        $aRangesCorrectCombos = array();  
        for ( $set=0; $set<count($aCombosFilm); $set++){
            $aCombo = $aCombosFilm[$set];
            $aBits = array();
            $sum = array_sum($aCombo);
            $probsum = array_sum($danezprobki);
            foreach( $aCombo AS $ii=>$kp ){
                if ( $kp == $danezprobki[$ii]){
                    $aBits[$ii] = 1;
                }
            }
            
            if ( array_sum( $aBits ) >= $probeFramesCount - $delta  ){
                $aRangesCorrectCombos[$set] = 1;
//                $aRangesCorrectCombos[] = array("s"=>$set, "k"=>$set+$probeFramesCount );
            }
        }
        return $aRangesCorrectCombos;
    }
    
    
    
    $time0 = time();
//    var_dump_spec
    
    
    #STEP 1
    # preapre oGlobaldatas contain mobile FP Data
    $aDatas = $_REQUEST['datas'];
    
    $aFilmy = array();
    $aFilmy[0] = json_decode("["
            . "[35,35,35,35,35,35,33,32,30,28,28,28,28,27,28,29,28,28,29,29,31,34,38,39,41,41,40,39,37,37,36,33,31,31,30,28,27,29,28,25,23,38,37,35,34,33,34,34,35,36,37,38,37,36,35,35,36,37,37,35,33,34,34,37,37,39,39,38,38,39,38,37,35,32,31,29,27,24,24,22,21,21,20,20,19,17,16,16,15,15,16,18,20,21,20,19,18,19,18,15,17,19,20,20,20,20,19,20,20,20,19,19,20,16,13,11,9,8,8,8,8,8,8,8,8,9,9,8,8,11,14,15,14,14,12,11,13,10,10,9,10,10,8,9,9,9,10,10,11,18],"
            . "[34,34,34,34,34,34,32,31,29,26,27,27,27,26,27,28,27,27,28,28,30,32,36,38,40,40,39,37,35,36,34,32,29,29,29,27,26,28,27,23,22,38,36,35,33,32,33,33,34,36,36,37,36,35,34,34,36,36,36,34,33,34,33,36,37,38,38,37,38,38,38,37,34,32,31,29,26,24,23,20,20,19,19,19,18,16,15,15,14,14,15,17,19,20,19,18,18,18,17,14,16,18,18,18,18,18,18,19,18,18,17,17,18,13,11,9,7,6,5,6,5,5,6,5,6,6,6,6,5,7,8,8,7,8,7,7,8,6,6,5,5,5,5,5,5,5,6,6,6,10],"
            . "[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,1,1,1,1,2,2,2,2,2,1,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,2,2,2,2,1,2,1,2,2,2,2,3,3,2,2,2,2,2,3,3,3,3,2,3,3,2,3,4,6,7,7,7,5,4,5,4,4,4,5,4,3,4,4,4,4,4,4,8],"
            . "[17,17,17,17,17,17,16,15,14,12,12,13,13,12,13,13,13,14,14,13,14,15,18,20,21,22,22,21,20,19,19,17,16,16,16,15,14,15,15,12,12,17,17,17,16,16,16,16,16,17,18,18,17,17,16,16,17,17,18,16,16,16,16,17,18,18,19,18,18,18,18,17,16,15,15,14,13,11,12,10,10,10,9,9,9,8,7,7,8,8,8,9,10,10,9,9,9,9,8,5,6,8,9,10,11,11,11,12,12,11,10,10,11,9,7,6,6,6,5,5,5,6,5,6,6,6,6,5,5,7,9,9,8,8,6,6,7,6,6,6,6,6,5,5,5,5,5,5,5,9],"
            . "[18,18,18,18,18,18,17,17,16,15,15,15,15,15,15,16,15,15,15,16,17,19,20,20,20,19,18,17,17,18,17,16,15,15,14,13,13,14,13,12,11,21,20,19,17,17,18,18,19,19,20,20,19,19,19,19,19,19,19,18,17,18,18,20,20,21,20,20,20,21,20,20,19,17,17,15,14,13,12,11,11,11,11,11,11,9,9,8,8,7,8,8,10,11,10,10,10,10,10,10,11,11,11,10,10,9,8,8,8,9,10,10,9,7,6,4,3,2,2,3,3,3,3,3,3,3,3,3,4,4,6,6,6,6,6,5,6,5,3,3,4,4,3,4,4,4,5,5,5,9],"
            . "[16,15,15,15,15,14,14,14,1,1,1,1,16,16,16,16,1,15,16,1,16,16,16,16,16,16,16,16,16,16,16,16,16,15,16,16,16,16,16,16,16,1,1,1,1,16,1,1,1,1,1,16,1,1,1,1,1,1,1,1,1,1,1,1,1,1,16,16,16,16,1,16,16,16,1,1,1,1,1,1,1,2,2,2,2,3,3,3,16,13,14,14,14,14,15,15,16,16,1,1,1,16,16,15,15,15,15,15,15,16,15,15,16,16,15,14,14,13,16,2,14,14,15,11,14,12,13,14,16,14,12,12,12,11,6,11,13,14,10,10,11,10,9,9,9,8,7,6,7,3],"
            . "[48,49,49,62,62,59,51,44,26,36,33,42,32,40,46,40,33,53,54,111,141,194,244,294,305,319,328,311,285,281,261,241,230,243,231,218,202,223,198,181,175,247,236,216,204,195,195,207,212,226,227,226,224,216,214,221,229,238,244,226,225,224,230,260,270,272,271,270,259,258,261,262,251,232,233,198,175,174,169,127,116,127,117,76,57,42,35,21,27,47,70,106,154,176,172,170,175,174,181,183,252,294,287,308,312,306,317,338,374,401,377,370,364,193,139,104,65,29,15,29,41,87,27,37,54,51,41,26,24,39,135,174,139,96,34,11,53,32,51,72,97,77,61,38,59,77,86,86,87,79],"
            . "[57,63,63,63,63,59,59,59,58,58,58,58,58,58,58,58,57,56,53,52,50,48,47,45,43,41,37,35,34,34,34,34,34,33,33,33,34,34,32,32,37,49,49,48,48,49,49,49,49,49,48,48,47,48,49,48,48,48,48,49,50,49,50,49,48,48,47,46,46,46,45,45,44,44,45,45,44,47,49,51,50,53,53,45,49,50,53,57,57,53,52,49,48,49,48,47,45,44,43,42,41,42,43,44,44,45,45,45,45,44,43,40,37,38,41,46,51,55,57,58,61,60,59,58,62,58,55,54,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,4]"
            . "]");
//    2,0,0,0,0,0,0,0,0,0,0,0,0,75,77,73,75,75,75,77,76,74,68,67,64,63,62,63,65,65,65,65,69,65,67,67,66,65,68,64,64,]
    
    $aFilmy[1] = json_decode("[[6,6,6,6,6,6,6,7,9,10,12,14,17,25,27,29,33,34,39,34,30,30,31,31,28,30,32,32,35,36,39,37,37,35,33,30,29,28,27,26,26,26,9,10,10,9,9,9,10,10,8,6,7,9,10,10,11,12,12,19,18,18,16,12,10,7,7,7,6,6,6,6,6,7,8,7,7,9,9,10,13,19,21,23,24,27,26,24,24,24,26,31,34,35,36,37,39,40,41,42,42,42,42,39,36,34,34,35,34,34,35,37,36,36,34,33,31,30,32,33,35,35,34,33,29,24,19,14,19,26,27,29,30,29,28,26,26,27,26,29,29,29,29,35,41,40,42,42,42,41],
[4,4,4,4,4,4,4,5,7,8,10,12,15,23,25,27,31,32,36,31,27,27,28,27,25,27,28,28,31,31,34,33,32,30,29,26,25,23,23,22,22,22,9,9,9,9,8,8,9,9,7,6,6,8,8,8,9,10,10,16,15,15,13,10,6,4,4,4,4,4,4,4,4,6,7,6,6,7,8,9,12,18,20,21,23,25,24,23,22,23,25,29,32,34,34,35,38,38,39,40,40,40,39,36,33,31,31,32,31,31,32,33,33,33,31,30,28,28,29,30,32,31,31,29,26,21,15,11,15,21,22,24,25,25,23,21,20,22,21,24,25,25,25,30,35,34,36,36,36,35],
[2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,3,3,3,3,4,4,4,4,5,5,5,4,4,4,4,4,4,4,4,5,1,1,1,1,1,1,1,2,1,1,1,1,2,2,1,2,2,3,3,3,3,3,3,3,3,3,2,2,2,3,2,1,1,1,1,1,1,1,1,1,1,1,1,2,1,2,2,2,1,2,2,2,2,2,2,2,2,2,2,2,2,2,3,4,3,3,3,3,3,3,3,3,3,3,3,3,3,4,4,4,4,3,3,3,3,3,4,5,5,5,5,5,5,5,5,6,5,5,4,4,4,5,6,6,6,6,6,6],
[3,3,3,3,3,3,3,3,6,7,8,10,13,19,20,21,23,24,26,22,18,19,20,20,19,22,23,22,24,24,27,25,25,23,22,19,19,17,17,16,16,16,3,3,4,3,4,4,4,4,4,3,4,4,5,4,5,7,8,10,9,9,8,6,5,3,4,4,3,4,4,4,3,3,4,4,3,4,6,6,8,13,15,17,18,20,19,18,18,18,18,21,23,24,24,24,25,25,25,26,26,26,25,24,22,20,21,22,22,22,23,24,23,23,22,20,18,18,19,19,20,20,20,20,19,16,12,10,14,19,19,21,21,21,20,19,19,20,19,20,21,19,19,22,27,26,27,27,27,26],
[3,3,3,3,3,3,3,3,3,3,3,4,5,7,7,8,10,11,13,12,11,11,11,10,9,8,9,10,11,11,12,12,12,12,11,11,11,11,10,10,10,11,7,7,6,6,5,5,6,7,4,3,4,4,5,5,5,5,4,9,9,9,8,6,5,4,3,3,3,2,2,2,3,4,4,4,4,4,4,4,5,5,6,6,6,7,6,6,6,7,8,10,11,12,12,13,14,14,15,16,16,16,16,15,14,14,13,13,12,12,12,13,13,13,12,13,13,13,13,14,15,15,14,13,11,8,7,4,5,7,8,8,8,8,8,7,7,7,7,8,8,9,11,13,14,14,15,15,15,15],
[6,6,5,6,6,5,3,3,1,1,4,5,2,14,14,14,14,14,14,14,14,14,14,14,14,13,13,13,13,13,13,13,13,13,12,12,12,11,10,11,11,10,2,2,2,2,1,2,16,2,16,1,1,16,1,2,1,15,14,6,9,9,9,10,8,7,9,8,8,11,11,12,11,6,6,7,9,11,11,10,9,11,6,14,13,13,13,13,13,13,13,13,13,14,14,14,15,15,15,15,16,16,15,15,15,14,14,15,15,15,15,15,15,16,15,16,16,16,16,16,16,16,1,1,15,14,12,12,11,12,13,12,12,12,12,11,9,9,9,9,10,11,11,14,14,14,14,14,14,14],
[74,74,77,33,18,27,32,15,17,7,61,43,16,74,122,138,174,145,196,127,65,94,90,51,114,234,233,173,220,241,210,178,140,109,73,103,100,65,57,62,50,58,107,118,82,87,104,86,99,90,73,41,68,109,118,87,155,97,169,33,22,36,33,35,48,46,49,40,49,63,91,102,49,6,5,6,5,18,36,28,28,29,5,1,52,97,118,110,132,170,175,260,317,311,276,285,302,297,313,335,350,355,327,324,305,256,288,313,328,354,360,386,369,345,290,278,255,240,246,241,259,244,198,183,119,78,92,109,136,220,150,132,151,119,85,99,61,69,60,56,77,54,59,145,316,316,229,226,309,297],
[20,34,31,29,29,28,26,25,25,26,26,25,24,23,24,24,23,22,21,22,23,25,26,27,28,30,29,28,27,27,27,26,25,25,24,23,22,22,22,21,21,21,6,6,6,6,5,7,8,6,11,10,12,12,14,14,8,10,10,41,37,35,36,37,38,41,46,47,49,50,53,54,53,48,45,37,37,30,27,22,21,22,21,22,22,22,22,22,22,22,22,22,22,22,22,22,22,23,23,23,23,23,24,25,26,29,29,31,32,33,33,32,33,32,31,30,29,28,28,28,28,27,28,27,28,27,27,27,28,28,27,28,28,29,30,30,30,30,30,29,28,28,28,28,28,29,29,29,28,28]
]");
    
    $aFilmy[2] = json_decode("[[8,8,8,7,7,6,4,3,2,2,2,2,2,3,3,5,6,7,10,10,7,9,11,7,4,2,2,1,1,1,1,1,1,1,1,2,3,2,2,2,1,2,2,2,2,1,1,1,2,2,2,1,1,1,1,1,2,2,2,2,9,9,9,8,8,8,9,9,10,10,10,9,7,4,3,4,4,7,8,8,8,8,8,8,9,8,8,8,8,8,8,9,9,8,3,3,3,4,9,10,9,9,10,11,9,8,8,9,10,11,13,13,15,13,10,14,17,11,3,3,4,3,3,3,3,3,2,2,3,2,2,3,3,4,4,6,6,5,5,5,6,6,6,6,6,9,8,7,6,8],
[8,7,7,7,7,6,4,2,2,2,1,2,2,2,2,4,4,5,7,8,5,7,8,5,2,2,1,1,1,0,0,1,1,1,1,2,2,2,1,2,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,8,7,7,7,7,7,8,8,8,9,8,8,6,4,3,3,4,6,7,7,8,8,8,8,8,8,8,8,8,8,8,8,8,7,3,3,3,4,8,9,8,8,9,10,8,7,7,7,9,9,11,11,11,9,6,9,9,7,2,1,2,1,1,2,1,1,1,1,1,1,1,1,2,2,2,4,3,3,3,3,3,3,4,4,3,6,5,5,4,6],
[1,1,1,1,0,0,0,0,0,0,0,1,1,1,1,2,2,2,3,3,2,2,2,2,1,1,0,0,0,0,0,0,0,0,0,0,1,0,1,0,0,1,1,1,1,1,1,1,1,1,1,1,0,1,1,0,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,1,1,1,1,1,1,1,1,1,1,1,0,0,0,1,1,1,1,1,0,1,0,1,1,1,1,1,1,1,1,1,1,1,2,2,2,2,4,4,4,5,8,5,2,2,2,2,1,1,1,2,1,1,2,1,2,2,1,2,2,3,3,2,2,2,2,3,2,3,3,3,2,2,2,2],
[5,5,5,4,4,3,2,2,1,1,1,1,1,1,1,2,3,3,5,5,3,5,6,3,1,1,1,1,1,0,0,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,1,1,4,4,4,4,4,4,5,4,5,5,5,4,4,2,2,2,3,4,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,4,2,2,2,2,5,5,5,5,6,6,4,3,4,5,7,7,8,9,9,8,5,9,12,6,2,2,3,2,2,2,2,2,2,1,2,1,1,2,2,2,2,4,3,2,2,2,2,2,3,3,3,4,4,3,3,4],
[3,3,3,3,3,3,2,1,1,1,1,1,1,2,2,3,3,4,5,5,5,5,4,4,2,1,1,0,0,0,0,0,1,1,1,1,1,1,1,1,0,0,0,0,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,5,4,4,4,5,5,5,5,5,5,5,5,4,2,1,2,1,2,3,3,3,3,3,3,3,3,3,3,3,3,4,4,4,3,1,1,1,2,4,5,4,4,4,5,5,5,4,4,4,4,4,5,6,5,4,5,5,5,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,1,3,3,2,3,3,4,3,3,3,3,5,4,4,3,4],
[16,16,16,16,1,1,1,16,15,15,16,16,1,1,2,1,16,16,16,16,3,16,15,16,4,2,15,15,13,14,16,1,16,2,3,2,16,14,13,13,13,13,12,12,12,13,12,13,2,2,1,1,14,14,4,4,4,4,4,2,14,14,14,16,1,1,15,16,16,1,1,16,1,16,1,15,16,16,16,16,16,16,16,1,1,1,1,1,1,2,2,1,1,16,16,15,16,1,1,1,1,16,15,16,16,1,15,14,14,14,14,14,14,14,14,13,12,7,11,11,12,12,12,13,12,12,13,12,12,7,12,12,14,13,13,14,14,2,3,3,2,3,15,16,14,1,16,1,1,3],
[85,93,81,84,84,74,70,49,51,46,35,55,56,62,69,88,77,112,206,227,148,202,270,78,46,13,22,19,25,12,5,8,10,13,20,26,32,31,47,39,19,43,30,31,50,33,36,19,5,13,7,4,16,17,28,33,50,55,38,29,132,129,127,99,94,93,122,98,75,117,93,79,53,32,16,37,68,89,108,108,113,116,107,98,97,99,101,105,107,117,118,121,125,103,53,70,46,72,124,130,104,88,97,107,74,43,57,135,243,266,349,368,357,152,65,75,249,80,64,52,75,80,69,95,85,71,44,53,19,34,21,31,24,34,62,77,66,55,58,81,84,69,23,49,56,94,62,32,16,43]]");
   
    $aFilmy[3] = json_decode("[[0,13,13,12,12,12,11,11,11,10,10,10,10,10,10,10,9,9,9,9,8,8,7,7,8,9,9,9,8,8,7,6,6,6,6,5,6,6,6,6,7,7,7,7,6,6,6,6,5,5,5,5,5,4,9,10,10,10,10,10,10,9,9,8,8,7,7,8,7,8,11,9,8,9,9,10,10,11,10,10,10,10,11,10,9,8,7,7,7,7,6,7,7,5,5,6,6,6,7,10,11,11,12,13,14,13,13,13,13,12,11,12,11,11,11,11,10,9,9,10,10,10,10,10,10,11,11,11,11,11,10,10,10,10,10,11,11,12,12,12,12,12,12,12,13,13,13,13,14,13],
[0,9,9,8,8,8,8,8,8,7,8,7,7,7,7,7,6,6,6,6,6,6,5,5,5,7,6,5,5,5,4,3,3,3,3,3,4,4,4,4,5,5,5,5,4,4,4,4,4,4,4,4,4,3,7,7,8,8,8,9,9,8,8,7,7,7,6,6,5,5,8,6,6,6,6,7,7,7,7,7,7,7,8,7,6,5,5,5,5,4,4,4,5,3,3,4,4,4,5,7,8,8,9,9,10,9,9,9,9,9,9,9,8,9,8,8,8,8,8,8,8,8,7,7,7,8,8,7,8,8,7,7,7,6,7,7,7,8,8,9,9,9,9,9,9,9,9,9,10,10],
[0,4,4,4,4,4,4,3,3,3,3,3,3,3,3,3,3,3,2,2,2,2,2,2,2,2,3,3,4,3,3,3,3,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,1,1,1,1,1,1,2,3,3,2,1,1,1,1,1,1,1,1,2,2,2,2,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,2,3,3,2,3,2,1,2,2,2,2,2,3,3,3,4,4,4,4,4,4,4,3,3,3,3,3,3,2,2,2,2,2,2,2,2,3,3,3,3,4,4,4,3,3,3,3,3,3,4,3,4,3,3,3,3,3,4,4,4,4,4,4],
[0,8,8,7,7,7,7,7,7,7,7,7,7,7,7,7,6,6,6,6,6,6,6,6,6,7,6,6,6,6,5,5,5,4,4,4,4,4,4,4,4,4,5,4,4,4,4,4,4,4,4,4,4,3,6,7,7,7,7,7,7,6,6,5,5,5,5,6,5,6,7,6,6,6,7,8,8,8,7,7,7,7,7,7,6,6,5,5,5,5,5,6,6,4,4,4,4,3,4,6,6,6,8,8,8,8,8,8,8,8,6,6,6,6,6,6,6,5,5,6,6,6,6,6,6,6,6,6,6,6,5,5,6,6,7,7,7,8,8,8,8,8,9,8,9,9,9,9,9,9],
[0,5,5,5,5,4,4,4,4,4,4,4,3,3,3,3,3,3,2,3,2,2,2,2,2,2,2,3,3,2,2,1,1,1,1,1,2,2,2,2,2,2,2,2,2,2,2,2,2,1,1,1,2,1,3,3,3,3,3,3,3,3,3,3,3,3,2,2,2,2,3,3,2,2,2,3,3,3,3,3,3,3,3,3,3,2,2,2,2,2,1,1,2,1,1,1,2,3,3,4,4,4,5,5,5,5,5,5,5,4,5,5,5,5,5,5,4,4,4,4,4,4,4,4,4,5,5,5,5,5,5,4,4,3,3,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4],
[4,2,2,2,2,2,16,1,16,14,1,1,16,14,14,14,14,14,13,13,13,13,13,13,14,14,13,13,12,12,12,12,12,12,12,12,11,11,12,12,12,13,13,13,13,13,14,16,14,13,16,1,1,16,14,14,14,14,16,16,16,16,15,16,15,16,14,14,14,14,14,13,13,13,13,13,13,13,14,14,16,16,16,16,1,13,13,14,11,13,12,12,13,13,13,13,14,4,1,1,16,15,14,14,14,14,14,14,14,14,2,2,2,2,2,2,2,2,2,1,1,2,2,3,3,2,1,1,2,2,2,1,15,13,13,13,13,14,13,14,14,13,13,13,13,13,13,13,13,13],
[0,150,202,189,183,170,88,113,110,101,116,113,107,107,110,118,180,178,236,200,208,206,193,194,166,217,150,111,81,83,117,107,104,111,107,107,69,81,91,66,34,58,66,50,42,64,68,62,62,102,85,72,70,60,119,140,129,149,149,160,156,152,156,138,112,95,162,158,158,134,209,195,200,202,210,223,211,210,94,68,77,96,91,78,67,68,60,55,62,133,160,212,164,64,73,118,78,50,62,63,128,148,165,174,192,177,172,148,172,200,197,196,181,182,180,173,173,147,146,154,153,149,143,142,138,150,159,151,91,92,85,75,99,162,170,248,269,257,301,285,293,332,352,345,354,377,369,371,398,398]]");
    $aFilmy[4] = json_decode("[[15,14,13,13,13,14,14,13,13,14,11,10,8,8,11,12,12,11,11,11,11,9,7,7,7,6,6,6,5,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,5,5,5,5,5,6,6,5,5,5,5,5,6,5,5,5,4,4,4,4,5,5,5,5,5,4,5,2,2,2,2,4,8,9,8,8,8,8,8,8,8,8,8,8,9,8,8,9,8,8,7,7,6,6,6,5,5,5,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,6,8,8,9,9,9,10,10,9,9,9,8,8,9,9,9,8,9,8,5,4,3,3,2,2,3,2,2,3,3],
[10,10,9,8,7,8,8,7,7,8,6,5,4,3,5,6,7,7,7,6,7,6,4,5,4,4,4,4,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,3,3,3,3,2,3,3,3,3,3,3,2,2,2,2,2,2,2,2,2,2,2,0,0,0,0,1,1,1,1,1,1,1,2,2,2,2,1,1,1,1,1,1,1,1,1,1,1,3,4,3,3,3,1,1,1,1,1,1,1,1,1,1,2,1,1,1,1,4,6,7,7,7,7,7,7,6,6,7,6,6,6,7,7,6,6,6,4,2,1,1,1,1,1,1,1,1,1],
[5,5,4,5,6,6,6,5,6,6,5,5,4,5,6,6,5,5,5,4,4,3,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,2,2,2,2,2,2,2,3,3,3,2,3,3,3,3,2,3,3,3,3,3,2,2,2,2,2,2,2,3,2,2,3,2,2,2,2,3,7,7,7,7,7,7,6,6,6,6,7,7,8,7,7,7,7,6,6,6,5,4,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,1,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,1,2,2],
[9,8,8,8,8,9,9,8,9,9,7,7,5,6,9,9,9,8,7,7,7,4,3,3,3,2,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,2,2,3,2,2,2,2,2,3,3,3,3,3,2,2,2,2,2,1,2,2,2,2,3,2,1,1,1,3,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,5,4,4,4,3,3,3,3,3,3,3,2,2,2,2,2,1,1,1,1,1,1,1,1,1,2,4,5,5,5,5,5,5,5,5,5,4,3,3,3,3,3,3,2,2,2,2,2,2,1,2,2,2,2,2,2],
[6,6,5,5,5,5,5,4,5,5,4,3,3,2,3,3,3,3,4,4,4,5,4,4,4,3,3,3,3,2,2,3,3,3,3,3,3,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,3,3,3,3,3,3,3,3,3,3,2,2,2,2,3,3,3,3,3,2,2,2,0,0,1,1,1,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,3,3,3,3,2,2,2,1,1,1,1,1,1,1,1,2,1,2,2,2,2,2,2,3,3,4,4,4,5,4,4,4,5,5,5,5,6,6,6,6,5,4,2,1,1,1,1,1,1,0,1,1],
[13,13,13,12,12,12,12,12,12,12,12,13,12,12,12,12,12,12,11,12,11,5,5,4,3,3,2,4,4,7,9,5,4,4,4,4,5,5,6,6,5,6,5,5,5,4,6,2,3,2,1,3,3,4,4,4,4,3,1,1,5,15,14,5,2,1,4,5,4,4,6,4,4,10,11,12,12,10,11,9,9,9,9,9,9,9,9,9,8,8,8,8,8,8,9,9,9,9,9,10,4,1,16,15,11,14,14,14,2,4,5,4,2,1,1,3,3,3,3,3,16,16,16,16,16,16,16,16,16,1,1,1,1,2,2,3,3,3,3,2,15,14,14,15,13,12,12,12,13,13],
[252,241,219,190,261,306,293,265,190,215,205,256,191,243,323,314,287,252,173,171,105,95,115,99,88,51,13,20,11,13,9,49,43,40,44,39,64,59,39,58,67,74,66,44,53,48,14,13,27,43,22,49,56,60,59,60,76,39,31,41,28,31,17,20,4,17,67,85,113,105,53,9,43,35,60,34,18,9,82,166,169,160,155,152,156,144,124,103,98,114,191,198,185,182,214,210,199,187,176,132,78,119,97,30,12,38,29,26,16,25,25,21,30,21,16,57,44,47,45,13,101,139,145,144,144,147,155,143,122,113,118,103,104,151,179,214,213,191,159,97,26,15,16,15,29,48,36,40,61,40]]");
    $aFilmy[5] = json_decode("[[4,3,3,3,3,56,57,59,60,61,62,62,62,62,62,63,63,64,64,64,65,65,65,65,65,65,65,66,65,65,66,66,67,67,67,67,66,67,66,67,67,66,66,66,66,67,67,66,66,66,67,67,67,68,67,67,67,61,59,58,61,63,65,66,67,67,65,61,61,61,63,64,64,63,63,63,66,68,69,69,69,68,68,68,68,64,62,62,62,63,63,65,67,68,68,3,2,3,3,3,4,3,3,4,4,4,3,3,5,4,4,2,2,3,53,53,52,52,52,52,52,52,52,52,52,52,51,51,51,51,51,50,50,50,50,50,50,50,50,49,47,45,40,33,26,22,27,31,35,48],
[2,1,1,2,2,54,55,57,58,59,60,60,60,60,60,61,61,62,62,62,63,63,62,63,63,63,63,63,63,63,64,64,64,64,65,64,64,64,64,64,64,64,64,64,64,64,64,64,64,64,65,65,65,65,65,65,65,60,57,56,59,60,63,64,65,65,62,59,58,59,60,61,61,60,60,60,63,65,66,66,66,66,66,66,65,62,60,59,60,60,61,62,65,65,66,1,1,1,1,2,2,1,2,2,2,2,1,2,2,2,2,1,1,1,50,50,50,49,49,50,50,50,50,50,50,50,49,49,49,49,49,48,48,48,48,48,48,47,48,46,45,43,38,31,24,20,25,29,33,45],
[2,1,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,2,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,2,2,2,2,2,2,2,3,3,3,3,3,3,3,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,1,1,1,2,2,2,2,2,2,2,2,2,2,4,3,2,1,1,2,3,3,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3],
[2,2,2,2,2,30,31,32,32,33,33,33,33,33,33,34,34,34,34,34,35,35,35,35,35,35,35,35,35,35,35,36,36,36,36,36,36,36,36,36,36,36,36,35,36,36,36,36,36,35,36,36,36,36,36,36,36,33,32,32,34,35,36,36,37,37,36,33,33,33,34,35,34,34,34,34,36,37,37,37,36,36,36,36,36,34,33,32,33,33,33,34,35,35,36,1,1,1,2,2,3,2,2,2,2,2,1,2,2,2,2,1,1,2,28,28,28,27,27,28,28,28,28,28,28,28,27,27,27,27,27,26,27,26,27,27,27,26,26,26,25,23,21,17,13,10,11,12,13,18],
[2,1,1,2,1,26,26,28,28,29,29,30,29,29,29,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,31,31,31,31,31,31,31,30,31,31,31,31,31,31,31,31,30,30,31,31,31,32,32,32,31,31,28,27,26,28,28,29,30,30,30,29,28,28,28,29,29,30,29,29,29,31,31,32,32,32,32,32,32,32,30,30,30,30,30,30,31,32,32,33,1,1,1,1,1,1,1,1,2,1,2,1,1,3,2,2,1,1,2,25,25,25,25,24,24,24,24,24,24,24,24,24,24,24,24,24,24,24,23,23,23,23,23,24,23,22,21,19,16,13,12,16,19,22,30],
[1,16,12,13,13,16,16,1,1,1,1,1,16,16,16,16,16,16,1,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,1,16,16,16,16,16,16,16,11,15,3,11,12,11,11,12,10,10,11,9,9,8,8,10,11,12,12,2,2,2,1,1,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,1,2,2,2,1,2],
[20,14,15,22,35,146,160,147,147,152,161,160,190,191,200,206,210,200,158,206,220,219,208,218,218,210,214,215,220,217,218,225,227,231,235,237,229,232,230,236,230,228,231,233,233,242,206,232,233,235,240,247,240,252,255,248,252,179,155,161,186,202,237,249,261,259,236,202,195,180,187,191,188,192,180,188,227,245,251,257,257,259,258,253,249,212,210,191,198,208,217,230,246,243,246,2,7,7,33,46,46,31,30,38,38,36,20,13,34,23,17,2,7,19,135,133,131,149,159,191,193,197,190,194,192,191,178,177,175,175,178,131,136,166,173,176,170,165,170,157,137,108,90,72,62,72,107,119,133,209]]");
    $aFilmy[6] = json_decode("[[3,3,3,3,2,2,2,2,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,2,2,2,2,2,2,2,3,3,3,3,3,2,3,3,3,3,3,3,3,3,2,3,3,3,2,2,2,2,2,2,2,2,3,3,3,3,3,3,2,2,2,2,2,3,3,3,3,3,4,4,4,4,4,5,4,4,3,4,4,3,3,4,4,4,4,3,4,4,4,4,4,3,4,4,4,3,3,3,4,4,3,3,4,4,4,4,4,4,5,4,3,3,4,4,4,4,3,3,3,4,3,3,3,3,4,4,4,3,4,3,3,3,4,4,4,3],
[2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,2,2,2,2,2,3,3,3,3,3,2,2,2,3,2,2,2,2,2,2,2,2,2,3,3,3,3,3,2,2,2,2,2,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,1,1,2,2,3,2,3,3,3,4,3,3,2,3,3,2,2,2,3,3,2,2,3,3,3,3,2,2,2,3,3,2,2,2,2,2,2,2,3,3,3,3,3,3,3,3,2,2,3,3,3,2,2,2,2,3,2,2,2,2,3,3,3,2,2,2,2,2,3,3,3,2],
[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,2,2,2,2,2,2,2,2,1,2,2,1,1,2,2,2,2,2,2,2,2,2,2,2,2,2,2,1,1,1,2,1,1,2,2,2,2,1,1,1,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
[1,1,2,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,1,1,1,1,1,2,1,1,2,2,2,2,2,2,2,2,2,1,1,1,1,2,1,1,1,2,2,2,2,2,3,3,2,2,2,2,2,2,2,2,2,3,2,2,2,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,2,3,3,3,3,2,2,3,3,3,2,2,2,2,2,2,2,2,2,2,3,2,2,2,2,2,2,2,2,3,2],
[6,6,5,5,4,4,5,5,5,6,6,4,4,4,4,5,4,5,2,14,16,14,14,1,16,14,15,14,14,14,14,14,14,14,14,14,14,14,14,14,15,2,2,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,3,3,3,3,3,3,2,2,16,2,5,6,6,6,6,6,7,7,6,6,6,6,6,6,6,6,6,6,6,5,6,6,6,6,5,6,6,6,6,6,6,6,6,6,6,6,7,7,6,6,7,7,7,6,6,6,7,7,7,7,6,6,6,6,6,6,6,6,7,6,6,6,6,6,6,6,6,7,6,5],
[9,8,7,8,9,7,6,6,6,4,4,4,2,6,7,8,6,5,2,1,1,2,2,2,2,3,2,2,3,3,7,10,13,10,7,3,3,2,1,3,3,3,8,17,26,22,22,25,25,26,29,17,20,22,28,25,22,22,17,19,21,27,18,14,21,25,26,23,23,26,26,24,22,21,18,19,20,24,15,6,14,39,72,42,84,80,92,116,84,43,67,75,77,71,40,44,87,100,48,41,55,98,61,88,44,42,46,82,51,29,30,33,51,58,33,42,88,94,89,81,98,111,116,100,73,78,96,109,106,77,77,78,79,87,72,64,54,46,73,91,84,76,89,72,74,27,98,80,95,68]]");
    $aFilmy[7] = json_decode("[[1,1,1,0,0,29,27,27,28,29,29,29,30,30,31,31,31,31,30,30,29,29,28,27,28,29,30,31,31,30,30,30,30,30,29,29,29,29,29,30,30,27,25,24,26,29,30,31,32,32,32,32,31,30,29,30,30,30,29,28,29,30,31,29,30,30,30,30,29,29,28,29,30,30,30,30,31,31,32,32,33,33,33,33,33,34,34,34,34,34,32,33,33,33,33,32,32,32,33,32,1,1,1,1,1,34,34,34,33,32,31,31,30,25,22,23,24,28,29,31,30,31,31,30,27,26,24,22,22,23,27,28,30,30,31,31,32,32,32,32,32,33,33,33,33,34,34,34,34,34],
[0,0,0,0,0,22,20,20,21,22,22,22,22,23,23,23,23,23,22,22,22,21,21,20,21,21,23,23,23,22,22,23,22,22,22,22,21,22,22,22,23,20,19,18,20,22,22,23,23,24,24,23,22,22,21,22,22,22,22,21,21,22,22,22,22,22,23,23,22,21,21,22,22,22,22,22,23,23,24,24,24,25,25,25,25,25,25,25,25,25,24,24,25,25,25,24,24,25,25,24,0,0,0,0,0,24,24,24,24,23,22,22,22,18,16,16,16,20,20,22,21,21,22,21,19,18,17,16,15,16,19,20,21,22,22,23,23,23,23,23,23,23,24,24,24,24,24,25,24,24],
[0,0,0,0,0,8,7,7,7,8,8,8,8,8,8,8,8,8,8,8,8,7,7,7,7,7,8,8,8,8,8,8,8,8,7,7,7,7,7,8,8,7,6,6,7,8,8,8,8,9,8,8,8,8,8,8,8,8,8,7,8,8,8,7,8,8,8,8,7,8,7,8,8,8,8,8,8,8,8,8,8,8,8,8,8,9,9,8,8,8,8,8,8,8,8,8,8,8,8,8,1,1,1,1,1,10,10,10,9,9,9,9,9,7,7,7,7,8,9,9,9,9,9,9,8,7,7,6,6,7,8,8,8,9,9,9,9,9,9,9,9,9,9,9,9,10,9,9,10,10],
[0,0,0,0,0,14,13,13,13,14,14,14,14,14,14,14,15,15,14,14,14,14,14,13,14,14,15,16,16,15,15,16,15,15,15,15,14,15,15,15,16,14,13,13,15,17,18,18,18,19,18,18,18,17,16,16,16,16,16,15,16,16,16,16,16,16,16,16,15,15,15,15,16,15,15,15,16,16,16,17,17,17,17,17,17,17,17,17,18,18,17,17,17,17,17,17,17,17,17,17,1,1,1,1,1,18,18,18,18,17,17,16,16,14,12,13,14,17,17,19,18,18,18,18,16,15,13,12,11,12,14,14,15,15,15,16,16,16,16,16,16,17,17,17,17,17,17,17,17,17],
[1,1,0,0,0,15,14,14,15,15,16,16,16,16,16,16,16,17,16,16,16,15,15,14,14,14,15,15,16,15,15,15,15,15,15,14,14,14,14,14,14,13,12,11,12,12,13,13,13,14,14,13,13,13,13,13,14,14,13,13,13,14,14,14,14,14,14,14,14,14,13,14,15,14,14,15,15,15,16,16,16,16,16,16,16,16,16,16,16,16,15,15,16,16,15,15,15,15,15,15,1,1,0,0,0,16,16,16,16,15,15,14,14,12,10,10,10,11,12,12,12,12,13,13,12,11,11,10,10,11,13,14,14,15,15,16,16,16,16,16,16,16,16,17,16,17,17,17,17,17],
[3,3,3,4,4,1,1,1,3,2,2,2,1,1,2,2,2,2,2,2,2,2,1,1,1,16,1,1,1,16,16,1,16,1,1,1,16,16,1,1,16,16,15,15,14,15,15,15,15,15,16,14,14,14,14,14,15,15,15,15,15,15,15,14,15,15,15,15,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,15,15,15,15,15,15,15,15,15,15,15,15,15,15,12,15,3,6,4,1,16,1,1,16,15,15,15,14,14,14,13,13,14,14,13,13,14,14,14,14,14,14,15,16,1,1,1,1,1,1,1,1,1,1,2,1,1,2,2,2,1,1,1,1],
[0,0,2,0,0,92,80,77,78,79,85,87,89,89,89,88,91,92,87,82,73,63,58,42,47,56,52,54,56,60,59,49,57,47,45,44,46,47,53,58,57,43,42,55,74,76,77,81,83,80,84,89,80,76,71,72,67,67,59,56,61,60,59,56,58,60,60,59,37,33,46,50,50,48,48,45,50,51,54,57,57,61,81,82,84,85,85,86,93,93,89,92,93,99,99,99,98,97,102,99,2,2,1,1,0,74,63,74,74,57,50,49,49,45,49,69,82,106,101,110,115,117,97,89,71,55,48,40,26,40,53,55,59,62,65,65,67,65,63,64,83,65,84,92,94,95,97,97,97,98]]");
  
    $aFilmy[8] = json_decode("[[31,30,29,5,6,6,5,5,6,5,5,5,5,25,24,24,23,23,23,23,22,20,20,20,20,20,20,19,19,18,18,18,17,18,18,18,18,18,19,19,19,18,15,12,11,11,13,13,13,12,13,13,14,18,18,19,21,22,23,24,24,26,27,28,27,28,29,29,28,28,27,27,26,26,26,25,24,22,22,21,20,20,19,18,19,19,20,20,20,19,20,21,21,22,22,22,22,22,22,20,22,21,21,20,20,20,21,22,22,22,23,22,23,23,23,23,23,22,22,23,24,23,23,23,21,22,21,22,21,21,22,20,20,20,20,19,19,18,18,19,19,20,22,23,22,23,24,24,23,23],
[25,25,24,2,2,2,2,2,2,2,1,1,1,20,20,19,19,18,18,19,18,16,16,15,16,15,15,14,14,14,14,13,13,13,14,13,13,13,13,14,14,13,10,8,7,8,9,10,10,9,9,10,11,15,15,16,18,19,19,20,21,23,24,24,24,25,26,26,25,24,24,24,23,23,23,21,21,19,18,17,17,17,16,15,15,15,16,16,16,15,16,17,17,18,18,18,18,18,18,16,18,17,17,16,16,16,17,18,18,18,19,18,18,18,18,19,18,18,17,18,19,19,19,18,17,17,16,17,16,17,17,15,15,15,15,14,14,13,13,13,14,15,17,17,16,17,18,18,17,16],
[5,5,5,3,4,4,3,4,4,4,3,4,4,4,4,5,5,4,5,5,4,4,4,4,4,4,4,4,4,4,5,5,5,5,5,5,5,5,5,5,5,5,5,4,4,4,4,4,4,3,3,3,3,3,3,3,3,3,3,3,3,3,3,4,4,4,4,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,4,4,3,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,5,5,4,4,4,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,6,6,6,6,6,6,6,7,6],
[15,15,15,4,4,4,4,4,4,4,4,4,4,13,13,13,12,12,12,12,12,11,10,10,10,10,9,9,9,9,8,8,8,8,8,8,9,9,10,10,10,10,9,8,7,7,8,8,8,7,7,8,8,9,10,10,11,12,12,13,13,14,14,15,14,15,15,15,15,14,14,14,13,13,13,12,12,11,10,10,10,9,9,8,9,9,9,10,10,10,10,10,11,11,11,11,11,11,11,10,11,10,10,10,11,11,11,12,12,12,12,12,12,12,12,12,11,11,11,11,12,11,11,11,11,11,11,11,11,10,10,9,9,9,9,9,9,9,9,9,10,11,12,13,13,13,14,14,13,13],
[15,15,14,1,2,1,1,1,2,2,1,1,1,12,11,11,11,10,10,11,10,10,10,10,10,10,11,10,10,10,10,10,10,10,10,10,9,9,9,9,8,7,5,4,4,4,5,5,5,5,5,5,6,9,9,9,10,10,10,11,11,12,13,13,13,14,14,14,14,14,14,13,14,13,13,13,12,11,11,11,11,11,10,10,10,10,10,10,10,10,10,11,10,10,10,11,11,11,11,10,11,11,10,10,10,9,10,10,10,10,11,10,11,11,11,11,11,11,11,12,12,12,12,12,11,11,11,11,11,11,12,11,11,11,11,10,10,10,9,9,10,10,10,10,10,10,10,10,10,10],
[1,1,1,13,12,13,13,12,11,10,11,11,12,1,1,2,1,1,2,1,1,1,1,1,1,16,2,1,3,3,3,3,4,4,3,3,13,14,13,13,13,16,14,13,14,15,16,2,3,1,15,15,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,1,1,16,16,16,15,15,1,2,3,1,15,14,13,13,15,16,16,16,14,14,14,14,14,14,13,16,16,16,16,16,16,1,1,16,1,1,1,1,1,1,1,1,1,1,1,1,2,2,2,2,2,4,2,4,4,4,4,4,5,6,5,5,5,5,4,4,6,14,14,14,14,14,14,14,6],
[224,220,226,36,63,58,46,46,44,34,33,36,48,148,131,130,122,117,115,112,84,95,83,66,64,43,76,41,40,23,5,46,48,44,26,10,40,40,64,64,59,47,73,48,37,37,27,49,66,38,50,79,74,107,107,113,119,127,136,140,157,159,164,184,190,195,201,200,198,185,185,184,175,164,176,147,124,93,94,82,69,35,35,39,34,21,22,27,34,20,44,34,36,46,72,78,78,89,91,95,134,140,143,159,167,185,181,189,194,188,194,187,188,197,201,215,211,203,197,196,200,181,178,176,176,179,164,117,124,91,87,58,51,62,65,67,78,93,91,36,58,16,51,77,67,90,103,105,15,11]]");
    
    $aFilmy[9] = json_decode("[[6,6,5,5,5,5,5,5,5,4,5,5,5,5,5,5,4,5,5,5,4,4,4,4,5,4,4,4,5,5,5,5,6,8,8,8,8,7,6,6,6,6,6,5,5,4,4,3,3,3,3,3,4,3,4,14,11,10,10,10,9,9,8,8,8,8,8,8,8,7,5,3,3,3,3,3,3,3,4,5,5,5,5,5,5,5,6,6,5,4,5,5,5,5,5,33,33,32,32,34,34,34,33,33,32,30,28,27,24,23,23,21,21,20,18,13,11,11,12,10,10,9,10,12,11,13,13,12,13,11,12,12,10,10,8,7,8,7,8,10,8,9,8,8,9,8,10,10,9,13],
[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,2,2,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,1,1,1,0,1,1,1,1,1,1,7,5,5,4,4,3,3,3,2,2,2,2,1,1,1,1,1,1,1,1,0,0,1,1,1,2,2,2,2,2,3,3,3,2,1,2,2,2,2,2,26,26,25,25,25,25,25,25,24,23,22,21,21,18,17,16,15,15,14,12,8,7,7,7,6,6,6,6,7,6,7,7,7,7,7,7,7,5,6,5,5,5,5,6,7,5,6,5,5,5,5,6,6,6,5],
[5,5,5,4,4,4,4,4,4,3,4,4,4,4,3,3,3,3,3,3,3,3,3,3,4,3,3,3,4,4,5,5,6,7,7,8,7,6,5,5,5,5,5,4,4,3,3,3,3,3,2,3,3,3,3,7,6,6,6,6,6,6,6,6,6,6,6,7,7,6,4,2,2,3,3,3,3,3,3,4,4,3,3,3,3,3,3,3,2,2,3,3,3,3,3,7,7,7,7,9,8,9,9,9,8,8,7,6,7,6,6,6,6,6,5,5,4,4,5,4,4,4,4,5,5,6,6,5,5,5,5,5,4,4,3,2,3,2,3,4,3,3,3,4,4,3,4,4,3,8],
[4,4,3,3,3,3,3,3,3,2,3,3,3,4,3,3,3,3,3,3,3,2,3,3,3,3,3,3,3,3,3,3,3,4,4,4,4,3,3,3,3,3,3,3,3,2,2,1,1,1,1,2,2,2,3,6,4,4,3,4,3,4,3,3,3,3,4,3,3,3,2,2,2,2,2,2,2,2,3,4,4,4,4,4,4,4,4,4,3,2,4,3,3,4,4,17,16,16,16,17,17,17,17,17,16,15,14,14,13,12,12,12,12,12,11,8,7,7,7,6,6,5,5,6,5,6,6,7,6,6,6,6,5,5,5,4,4,4,5,5,4,4,4,5,5,4,5,5,5,7],
[2,2,2,2,2,2,2,2,2,2,2,2,2,2,1,2,1,1,1,2,1,2,2,2,2,2,1,2,2,2,2,2,3,4,4,4,4,3,3,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,1,8,7,7,6,6,6,5,5,5,5,5,5,5,5,4,3,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,2,3,2,1,1,1,1,1,1,16,16,16,16,17,17,17,17,17,16,15,14,13,12,11,11,10,9,8,7,4,4,4,4,4,4,4,5,6,6,7,7,5,7,6,6,6,4,5,4,3,4,3,4,5,4,5,4,4,4,4,5,5,4,6],
[12,12,13,13,14,4,14,11,12,13,11,14,12,12,13,13,13,13,15,15,16,16,14,13,13,13,13,13,13,12,12,12,11,9,8,6,6,6,5,5,7,10,10,9,5,4,4,3,3,4,3,1,1,16,14,6,6,5,6,7,6,6,6,7,8,8,9,9,8,8,8,15,5,13,11,14,9,12,12,12,12,13,13,13,13,14,14,14,14,15,13,13,13,13,13,6,6,6,6,6,6,6,6,6,6,6,12,10,10,9,10,10,11,11,11,11,11,9,10,10,7,6,5,5,5,6,7,6,5,5,5,5,5,5,5,5,5,4,4,4,5,5,5,4,5,4,2,3,3,16],
[71,60,53,41,15,13,6,46,45,26,13,31,36,34,30,30,25,22,41,50,57,33,41,73,64,70,63,58,37,26,27,23,15,15,20,69,30,52,68,39,36,17,43,28,22,39,35,39,31,45,33,30,25,33,66,96,106,150,153,133,109,39,25,62,102,58,100,91,82,83,34,16,4,15,6,2,20,60,52,57,69,90,110,124,127,76,82,107,72,16,77,71,70,93,81,18,111,111,29,110,105,126,65,50,35,72,68,119,114,66,112,109,131,139,136,88,62,31,80,62,73,61,135,161,159,152,133,133,172,141,105,119,72,97,82,75,88,37,51,72,94,126,91,49,26,33,21,36,52,41]]");
    
    
    $aBadanaProbka = array();
    $aBadanaProbka[0] = json_decode("[[35,38,40,40,37,32,35,26,28,29,26,32,32,34,38,43,55,51,60,40,54,51,53,49,52,51,41,43,43,42,42,37,41,41,39,42,42,46,44,47,44,43,45,45,46,47,44,41,35,33,36,27,35,42,45,48,45,44,43,52,38,44,54,53,57,61,59,60,47,67,63,72,70,68,68,72,33,59,45,46,45,46,46,49,46,44,50,42,42,35,36,43,33,32,38,38,26,40,41,45],"
            . "[30,33,35,36,33,30,32,25,27,29,25,28,28,28,32,38,48,43,50,37,47,45,48,42,45,45,37,41,41,41,41,36,41,39,38,40,40,44,43,45,43,42,43,44,44,46,42,39,34,32,33,24,32,35,34,36,34,36,33,39,26,32,32,26,29,28,27,29,25,36,39,44,42,38,37,39,18,41,27,30,30,29,30,32,30,24,29,23,22,21,21,26,18,21,23,22,15,25,26,24],"
            . "[5,5,4,4,4,1,3,1,1,0,1,4,4,6,6,5,7,9,10,4,7,6,5,7,7,6,4,2,2,1,1,1,1,1,1,1,2,1,1,2,2,2,2,1,2,2,1,2,2,1,3,3,3,7,10,12,11,8,10,13,12,12,22,27,28,34,31,31,21,31,24,28,28,31,31,33,15,18,18,16,15,16,16,17,17,20,21,19,19,14,15,17,16,12,15,15,10,15,15,21],"
            . "[14,16,16,16,17,15,16,12,13,14,11,14,15,13,15,18,26,25,29,20,27,25,25,21,22,24,20,21,20,18,18,16,18,19,17,17,19,22,21,21,19,19,20,19,20,20,18,16,15,16,17,13,18,21,20,19,17,19,19,24,16,21,22,24,30,30,20,22,18,29,29,32,27,21,24,41,12,24,17,17,17,18,17,16,14,16,20,17,16,17,14,20,18,13,18,21,15,22,23,20],"
            . "[21,22,24,24,20,17,18,14,15,15,15,18,17,21,23,25,29,26,31,20,27,26,28,28,30,28,21,22,24,24,24,21,23,22,22,24,23,24,23,26,25,25,25,25,26,27,25,24,21,17,19,14,17,21,25,29,28,25,24,28,21,23,32,29,27,32,38,38,28,38,34,39,43,47,44,31,21,35,28,29,28,27,30,33,32,28,30,25,26,18,22,23,16,19,20,17,11,18,19,25],"
            . "[1,1,1,1,16,1,16,1,1,1,1,1,1,1,1,2,2,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,16,1,1,1,16,1,1,1,1,2,1,1,1,3,1,1,2,16,15,14,6,5,5,5,5,5,1,3,4,4,4,4,14,3,4,2,4,3,4,3],"
            . "[326,280,323,317,132,145,125,70,78,66,61,201,136,341,449,514,507,529,604,414,458,452,468,503,532,443,354,455,414,383,392,358,457,457,423,484,501,525,451,524,474,337,371,430,413,423,409,342,249,248,295,146,253,388,487,383,285,300,424,497,403,474,673,371,612,440,1035,1150,1067,505,641,642,1736,1403,1618,1635,146,465,20,421,360,404,161,318,326,73,504,194,447,187,416,248,150,217,137,221,106,226,369,334]"
            . "]");
    $aBadanaProbka[1] = json_decode("[[11,11,15,11,22,34,32,38,44,46,51,53,56,56,54,50,51,53,42,58,58,59,59,60,60,55,50,50,37,9,11,13,13,16,18,19,26,27,17,29,33,30,40,15,15,12,9,8,12,12,10,7,6,7,10,19,22,16,25,34,46,44,46,46,45,46,45,36,47,49,51,51,52,51,51,50,47,46,42,39,39,40,41,39,41,40,40,42,43,43,43,41,34,36,36,38,43,46,47,47],[6,6,10,7,15,23,26,31,36,39,43,45,48,45,43,40,40,40,33,43,43,45,44,45,46,43,39,39,28,4,9,10,10,13,16,16,19,21,14,26,29,26,34,11,12,9,5,3,5,5,4,4,2,3,8,15,15,13,23,31,41,38,40,40,38,38,37,30,38,37,38,39,40,38,38,37,35,35,31,28,28,29,29,28,29,29,29,31,32,32,32,33,28,28,28,29,31,33,34,34],[5,5,5,4,8,10,7,7,7,7,7,8,8,11,10,10,11,13,9,15,15,14,15,15,14,12,11,11,9,5,2,3,3,2,2,3,7,6,2,3,3,4,6,4,3,4,5,5,7,8,6,3,4,4,2,4,8,4,2,4,5,6,6,6,7,8,7,7,9,12,12,12,13,13,13,13,13,12,10,11,11,12,11,12,12,10,11,12,11,11,11,8,6,8,8,9,12,13,12,13],[3,4,7,5,10,16,14,17,20,22,25,25,27,24,24,23,22,23,17,24,24,24,26,28,28,25,23,22,15,4,4,7,4,9,7,8,11,9,7,12,15,12,19,6,6,5,3,2,4,4,6,4,1,2,4,7,7,6,10,14,18,16,17,17,17,18,17,14,19,20,21,20,19,18,17,18,17,18,14,13,13,13,13,12,13,14,14,15,14,15,15,15,12,11,10,11,13,13,14,14],[8,7,8,6,12,18,19,21,23,24,26,28,29,32,30,27,29,30,25,34,34,34,34,33,31,30,27,28,23,6,7,5,9,7,11,11,15,17,10,17,18,18,21,10,9,7,6,6,8,8,4,3,5,5,6,12,15,10,15,20,28,28,29,29,28,28,27,22,28,29,30,32,33,34,34,32,30,29,28,26,26,27,28,27,28,26,26,28,29,28,27,26,22,25,26,28,31,33,33,33],[8,8,9,13,9,6,7,8,11,7,10,11,12,12,11,13,12,12,11,12,11,13,13,12,11,13,11,11,11,14,18,12,9,12,18,16,14,11,12,14,14,14,14,7,7,6,5,10,8,7,8,7,7,7,11,12,10,10,11,11,11,10,12,10,9,11,11,9,12,12,12,14,14,10,5,13,13,14,13,9,10,8,9,14,16,12,11,11,10,12,13,14,15,13,10,12,10,12,12,11]]");
    
    
    
    $probeFrameStart = intval($_REQUEST['fpstart']);
    $probeFramesCount = intval($_REQUEST['fpcount']);
    var_dump_spec( "PROBKA (frames: $probeFrameStart+$probeFramesCount)" );
    $aProbka = getProbka( $aBadanaProbka[0], $probeFrameStart, $probeFramesCount );
    var_dump( count($aFilmy[0]),count($aFilmy[1]),count($aFilmy[2]),count($aFilmy[3]),count($aFilmy[4]),count($aFilmy[5]),count($aFilmy[6]),count($aFilmy[7]),count($aFilmy[8]),count($aFilmy[9]) );
    
    
    $aFilmyAsset = array();
        
    $sumaKlatekWybranych = 0;
    for( $filmid=0; $filmid<=9; $filmid++ ){
        
        $aFilmAsset = array();
        $aKP = $aFilmy[$filmid];
        $aFilmAsset["kp"] = array_slice($aFilmy[$filmid][0], $frame_s, $frame_e); 
        changeCountToDif( $aFilmAsset, "kp", "kpDif" ); 
        $aFilmAsset["kpT"] = array_slice($aFilmy[$filmid][1], $frame_s, $frame_e);
        changeCountToDif( $aFilmAsset, "kpT", "kpTDif" );
        $aFilmAsset["kpB"] = array_slice($aFilmy[$filmid][2], $frame_s, $frame_e);
        changeCountToDif( $aFilmAsset, "kpB", "kpBDif" );
        $aFilmAsset["kpL"] = array_slice($aFilmy[$filmid][3], $frame_s, $frame_e);
        changeCountToDif( $aFilmAsset, "kpL", "kpLDif" );
        $aFilmAsset["kpR"] = array_slice($aFilmy[$filmid][4], $frame_s, $frame_e);
        changeCountToDif( $aFilmAsset, "kpR", "kpRDif" );
        $aFilmAsset["q"] = array_slice($aFilmy[$filmid][5], $frame_s, $frame_e);
        $aFilmAsset["qstr"] = array_slice($aFilmy[$filmid][6], $frame_s, $frame_e);
        
       
      $aKPCombination = array();
        for( $i=0; $i<100-$probeFramesCount+1; $i++ ){
            $aSliced = array_slice( $aFilmAsset["kp"], $i, $probeFramesCount );
            $aFilmAsset['combos']["kpCombo"][] = $aSliced;
            $aSliced = array_slice( $aFilmAsset["kpDif"], $i, $probeFramesCount );
            $aFilmAsset['combos']["kpComboDif"][] = $aSliced;
            
            $aSliced = array_slice( $aFilmAsset["kpT"], $i, $probeFramesCount );
            $aFilmAsset['combos']["kpTCombo"][] = $aSliced;
            $aSliced = array_slice( $aFilmAsset["kpTDif"], $i, $probeFramesCount );
            $aFilmAsset['combos']["kpTComboDif"][] = $aSliced;
            
            $aSliced = array_slice( $aFilmAsset["kpB"], $i, $probeFramesCount );
            $aFilmAsset['combos']["kpBCombo"][] = $aSliced;
            $aSliced = array_slice( $aFilmAsset["kpBDif"], $i, $probeFramesCount );
            $aFilmAsset['combos']["kpBComboDif"][] = $aSliced;
            
            $aSliced = array_slice( $aFilmAsset["kpL"], $i, $probeFramesCount );
            $aFilmAsset['combos']["kpLCombo"][] = $aSliced;
            $aSliced = array_slice( $aFilmAsset["kpLDif"], $i, $probeFramesCount );
            $aFilmAsset['combos']["kpLComboDif"][] = $aSliced;
            
            $aSliced = array_slice( $aFilmAsset["kpR"], $i, $probeFramesCount );
            $aFilmAsset['combos']["kpRCombo"][] = $aSliced;
            $aSliced = array_slice( $aFilmAsset["kpRDif"], $i, $probeFramesCount );
            $aFilmAsset['combos']["kpRComboDif"][] = $aSliced;
            
            $aSliced = array_slice( $aFilmAsset["q"], $i, $probeFramesCount );
            $aFilmAsset['combos']["q"][] = $aSliced;
            $aSliced = array_slice( $aFilmAsset["qstr"], $i, $probeFramesCount );
            $aFilmAsset['combos']["qstr"][] = $aSliced;
        }
        
        $aFilmyAsset[] = $aFilmAsset;
    }
    
    $sumaKlatekWybranych = 0;
    var_dump_spec( "Dane Filmow gotowe" );
//    var_dump_spec( $aProbka["q"] );
    for ( $filmid=0; $filmid<=9; $filmid++){
        var_dump_spec( "PROBKA film $filmid: " );
        $aCombos = $aFilmyAsset[$filmid]["combos"];
//        var_dump_spec($aFilmyAsset[$filmid]["kpDif"]);
//        var_dump_spec($aCombos["q"]);
        
        $aX = getCorrectRangesQ($aCombos, $aProbka, $probeFramesCount, 1);
        var_dump_spec( count($aX) );
        $sumaKlatekWybranych += count($aX);
        foreach ($aX as $key => $value) {
            echo "$key,";
        }
        
        
        
//        $bX = getCorrectRangesQSTR($aCombos, $aProbka, $probeFramesCount, 1);
//        var_dump_spec( count($bX) );
////        $sumaKlatekWybranych += count($bX);
//        foreach ($bX as $key => $value) {
//            echo "$key,";
//        }
        
//        $aRangesCorrectCombos = getCorrectRangesCombos( $aCombos["kpComboDif"], $aProbka["kpDif"], $probeFramesCount, 1);
//        $aRangesCorrectCombosT = getCorrectRangesCombos( $aCombos["kpTComboDif"], $aProbka["kpTDif"], $probeFramesCount, 1);
//        $aRangesCorrectCombosB = getCorrectRangesCombos( $aCombos["kpBComboDif"], $aProbka["kpBDif"], $probeFramesCount, 1);
//        $aRangesCorrectCombosL = getCorrectRangesCombos( $aCombos["kpLComboDif"], $aProbka["kpLDif"], $probeFramesCount, 1);
//        $aRangesCorrectCombosR = getCorrectRangesCombos( $aCombos["kpRComboDif"], $aProbka["kpRDif"], $probeFramesCount, 1);
//        
//        $aTB = array_intersect_key($aRangesCorrectCombosT, $aRangesCorrectCombosB);
//        $aLR = array_intersect_key($aRangesCorrectCombosL, $aRangesCorrectCombosR);
//        $aTBLR = array_intersect_key($aTB, $aLR);
//        $aAll = array_intersect_key($aTBLR, $aRangesCorrectCombos);
//        
//        var_dump_spec("PROBKA film $filmid:   " . count($aRangesCorrectCombos) . "
//            . ". count($aRangesCorrectCombosT) . " " . count($aRangesCorrectCombosB) . 
//                " " . count($aRangesCorrectCombosL) . " " . count($aRangesCorrectCombosR) . 
//                " => " . count($aAll ) );
//
//        var_dump_spec( $aAll[$probeFrameStart] );
//        
//        var_dump_spec("<hr>");
    }
    
        
     
    $sumaWszystkich = $filmid * 100;
    $prop = round(($sumaKlatekWybranych / $sumaWszystkich) * 100, 2);
    var_dump_spec("suma wybranych: $sumaKlatekWybranych suma wszystkich: $sumaWszystkich => $prop%");
    
    
    
    exit;
    
    
//    var_dump_spec( $aHitCountsProp, true );
    
    echo json_encode( $aHitCountsProp, JSON_FORCE_OBJECT );
    
    
    
    
     function getCorrectRangesQSTR( $aCombosFilm, $danezprobki, $probeFramesCount, $delta = 0 ){
        $aRangesCorrectCombos = array();  
        for ( $set=0; $set<count($aCombosFilm['qstr']); $set++){
            $aCombo = $aCombosFilm['qstr'][$set];
            $aBits = array();
            
            foreach( $aCombo AS $ii=>$qstr ){
               
                $ileKP = $danezprobki['kp'][$ii];
                $ileKPFilm = $aCombosFilm['kpCombo'][$set][$ii];
                
                $ileKPFilm = $ileKPFilm == 0 ? 1 : $ileKPFilm;
                $qstr = $qstr == 0 ? 1 : $qstr;
                
                $proporcjeKP = $ileKP / $ileKPFilm;
                $proporcjeSTR = $danezprobki['qstr'][$ii] / $qstr;
                
//                var_dump_spec( "a:$set: $ii:  " . $proporcjeKP );
//                var_dump_spec( "b:$set: $ii:  " . $proporcjeSTR );
                
                $propprop = $proporcjeKP / $proporcjeSTR;
                
                if ( $propprop < 3 && $propprop > 0.5 ){
//                    
                    $aBits[$ii] = 1;
                }
                else{
//                    var_dump_spec( "c:$set: $ii:  " . $propprop );
//                    var_dump_spec( "c:$set: $ii: " . $qstr . " ??? " . $danezprobki['qstr'][$ii] . " => " . $qdifstr . "==> " . $qstrprop );
                }
                
//                
//                $qdifstr = abs( $qstr - $danezprobki['qstr'][$ii] );
//                if ( $qdifstr <= 10 ){
//                    $aBits[$ii] = 1;
//                }
//                else{
//                    $qstr = $qstr == 0 ? 1 : $qstr;
//                    $qstrprop = $qdifstr / $qstr;
//                
//                    
////                    var_dump_spec( "$set: $ii: " . $qstr . " ??? " . $danezprobki['qstr'][$ii] . " => " . $qdifstr . "==> " . $qstrprop );
//                    
//                }
                
//                    var_dump_spec( $aCombosFilm['qstr'][$set][$ii] . " ??? " . $danezprobki['qstr'][$ii] . " => " . $difstr );
                 
            }
            
//            var_dump_spec("$set:" . array_sum( $aBits ) );
            if ( array_sum( $aBits ) >= $probeFramesCount - $delta  ){
                $aRangesCorrectCombos[$set] = 1;
            }
        }
        return $aRangesCorrectCombos;
    }
    
    
     function getCorrectRangesQ( $aCombosFilm, $danezprobki, $probeFramesCount, $delta = 0 ){
        $aRangesCorrectCombos = array();  
        for ( $set=0; $set<count($aCombosFilm['q']); $set++){
            $aCombo = $aCombosFilm['q'][$set];
            $aBits = array();
            foreach( $aCombo AS $ii=>$kp ){
                
                
                
                
                $qdiff = abs( $kp - $danezprobki['q'][$ii] );
                if ( $qdiff <= 3 || $qdiff >= 13  ){
                    $aBits[$ii] = 1;
                }
                else{
                    if ( $danezprobki['qstr'][$ii] < 100 ){
                        $difstr = abs($aCombosFilm['qstr'][$set][$ii] - $danezprobki['qstr'][$ii]);
                        if ( $difstr < 50 ){
                            $aBits[$ii] = 1;
                        }
//                        var_dump_spec( $aCombosFilm['qstr'][$set][$ii] . " ??? " . $danezprobki['qstr'][$ii] . " => " . $difstr );  
                    }
//                    var_dump_spec( $aCombosFilm['qstr'][$set][$ii] . " ??? " . $danezprobki['qstr'][$ii] . " => " . $difstr );
                    
                }
            }
            
            if ( array_sum( $aBits ) >= $probeFramesCount - $delta  ){
                $aRangesCorrectCombos[$set] = 1;
            }
        }
        return $aRangesCorrectCombos;
    }
    
    
    
    
    
    
    
    
    
    
    
