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
        $aProbka["colorB"] = array_slice($aBadana[7], $frame_s, $frame_e);
        $aProbka["colorG"] = array_slice($aBadana[8], $frame_s, $frame_e);
        $aProbka["colorR"] = array_slice($aBadana[9], $frame_s, $frame_e);
        
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
            . "[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,16,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,16,1,1,1,1,1,1,2,2,2,1,1,1,16,16,16,16,16,1,1,1,16,16,16,15,14,14,14,13,13,14,14,14,14,14,14,15,14,14,13,13,13,16,16,16,16,14,13,13,12,13,13,13,15,1,16,2,1],
[1384,1368,1386,1376,1381,1367,1289,1238,1158,1056,1073,1077,1097,1051,1061,1115,1065,1091,1098,1036,1060,1129,1269,1386,1533,1594,1558,1479,1368,1359,1330,1250,1106,1135,1104,995,1031,1030,987,897,862,1341,1262,1253,1205,1192,1217,1149,1177,1238,1252,1301,1239,1298,1177,1283,1422,1431,1350,1273,1252,1300,1285,1451,1461,1437,1370,1335,1345,1366,1332,1377,1297,1203,1120,1081,948,911,844,748,718,735,718,686,667,648,609,516,507,518,530,601,752,753,713,663,651,695,675,628,696,738,731,703,627,673,710,716,723,697,611,622,621,428,380,334,282,249,183,239,241,234,165,177,245,225,200,180,117,199,334,367,309,103,114,115,180,197,238,246,200,139,180,115,125,98,120,97,84,185],
[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,1,2,2,2,2,1,2,2,2,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,2,2,1,1,1,0,0,0,0,0,0,0,0,21,20,21,22,17,20,19,17,17,17,16,20,19,18,22,19,19,19,18,18,17,12],
        [57,63,63,63,63,59,59,59,58,58,58,58,58,58,58,58,57,56,53,52,50,48,47,45,43,41,37,35,34,34,34,34,34,33,33,33,34,34,32,32,37,49,49,48,48,49,49,49,49,49,48,48,47,48,49,48,48,48,48,49,50,49,50,49,48,48,47,46,46,46,45,45,44,44,45,45,44,47,49,51,50,53,53,45,49,50,53,57,57,53,52,49,48,49,48,47,45,44,43,42,41,42,43,44,44,45,45,45,45,44,43,40,37,38,41,46,51,55,57,58,61,60,59,58,62,58,55,54,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,4],
        [9,9,9,9,9,12,13,12,12,12,12,12,12,12,12,12,11,12,12,12,12,13,10,11,12,13,14,14,14,14,14,15,15,16,16,15,16,16,15,15,14,12,11,11,11,11,11,11,11,11,12,11,12,11,11,11,11,12,12,11,11,11,12,12,12,13,12,13,13,13,13,12,12,11,11,12,12,12,12,11,11,12,12,12,12,12,11,12,12,12,12,12,12,12,12,11,11,11,11,11,12,12,12,12,13,13,13,12,12,12,13,18,21,20,20,20,16,14,13,13,12,12,11,10,10,10,10,9,47,48,44,42,46,42,39,42,41,40,43,37,41,41,40,42,41,40,42,42,42,31]" 
            . "]");
    
    
    $aFilmy[1] = json_decode("[[6,6,6,6,6,6,6,7,9,10,12,14,17,25,27,29,33,34,39,34,30,30,31,31,28,30,32,32,35,36,39,37,37,35,33,30,29,28,27,26,26,26,9,10,10,9,9,9,10,10,8,6,7,9,10,10,11,12,12,19,18,18,16,12,10,7,7,7,6,6,6,6,6,7,8,7,7,9,9,10,13,19,21,23,24,27,26,24,24,24,26,31,34,35,36,37,39,40,41,42,42,42,42,39,36,34,34,35,34,34,35,37,36,36,34,33,31,30,32,33,35,35,34,33,29,24,19,14,19,26,27,29,30,29,28,26,26,27,26,29,29,29,29,35,41,40,42,42,42,41],
[4,4,4,4,4,4,4,5,7,8,10,12,15,23,25,27,31,32,36,31,27,27,28,27,25,27,28,28,31,31,34,33,32,30,29,26,25,23,23,22,22,22,9,9,9,9,8,8,9,9,7,6,6,8,8,8,9,10,10,16,15,15,13,10,6,4,4,4,4,4,4,4,4,6,7,6,6,7,8,9,12,18,20,21,23,25,24,23,22,23,25,29,32,34,34,35,38,38,39,40,40,40,39,36,33,31,31,32,31,31,32,33,33,33,31,30,28,28,29,30,32,31,31,29,26,21,15,11,15,21,22,24,25,25,23,21,20,22,21,24,25,25,25,30,35,34,36,36,36,35],
[2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,3,3,3,3,4,4,4,4,5,5,5,4,4,4,4,4,4,4,4,5,1,1,1,1,1,1,1,2,1,1,1,1,2,2,1,2,2,3,3,3,3,3,3,3,3,3,2,2,2,3,2,1,1,1,1,1,1,1,1,1,1,1,1,2,1,2,2,2,1,2,2,2,2,2,2,2,2,2,2,2,2,2,3,4,3,3,3,3,3,3,3,3,3,3,3,3,3,4,4,4,4,3,3,3,3,3,4,5,5,5,5,5,5,5,5,6,5,5,4,4,4,5,6,6,6,6,6,6],
[3,3,3,3,3,3,3,3,6,7,8,10,13,19,20,21,23,24,26,22,18,19,20,20,19,22,23,22,24,24,27,25,25,23,22,19,19,17,17,16,16,16,3,3,4,3,4,4,4,4,4,3,4,4,5,4,5,7,8,10,9,9,8,6,5,3,4,4,3,4,4,4,3,3,4,4,3,4,6,6,8,13,15,17,18,20,19,18,18,18,18,21,23,24,24,24,25,25,25,26,26,26,25,24,22,20,21,22,22,22,23,24,23,23,22,20,18,18,19,19,20,20,20,20,19,16,12,10,14,19,19,21,21,21,20,19,19,20,19,20,21,19,19,22,27,26,27,27,27,26],
[3,3,3,3,3,3,3,3,3,3,3,4,5,7,7,8,10,11,13,12,11,11,11,10,9,8,9,10,11,11,12,12,12,12,11,11,11,11,10,10,10,11,7,7,6,6,5,5,6,7,4,3,4,4,5,5,5,5,4,9,9,9,8,6,5,4,3,3,3,2,2,2,3,4,4,4,4,4,4,4,5,5,6,6,6,7,6,6,6,7,8,10,11,12,12,13,14,14,15,16,16,16,16,15,14,14,13,13,12,12,12,13,13,13,12,13,13,13,13,14,15,15,14,13,11,8,7,4,5,7,8,8,8,8,8,7,7,7,7,8,8,9,11,13,14,14,15,15,15,15],
[16,16,16,16,1,16,1,16,15,15,15,14,14,15,15,15,15,15,15,15,16,15,15,15,15,15,15,15,15,15,15,15,15,15,15,16,16,16,16,16,16,16,2,2,1,2,1,1,1,2,1,16,1,16,1,1,16,16,15,16,16,16,16,16,1,2,15,16,15,15,14,13,14,1,1,16,1,16,16,16,16,15,15,15,15,15,15,15,15,15,15,15,15,15,15,15,16,16,16,16,16,16,16,16,16,16,16,16,16,15,15,15,15,16,16,16,16,16,16,16,16,16,16,16,16,15,15,14,14,14,14,15,14,15,15,15,15,14,14,15,15,15,15,15,15,15,15,15,15,15],
[80,58,77,102,73,77,96,99,249,340,524,662,790,1093,1146,1290,1394,1420,1646,1406,1109,1219,1288,1320,1267,1379,1442,1412,1514,1498,1632,1550,1418,1431,1380,1204,1069,992,973,940,905,843,410,408,361,362,341,360,358,350,283,206,207,277,269,280,355,378,392,649,598,600,489,262,111,65,58,57,86,96,118,151,79,222,275,232,243,295,324,386,490,851,1007,1100,1230,1312,1277,1187,1112,1109,1146,1403,1515,1555,1538,1578,1680,1669,1701,1731,1752,1741,1706,1586,1451,1334,1390,1355,1333,1453,1468,1531,1501,1394,1296,1301,1203,1183,1259,1209,1277,1254,1352,1226,1137,951,565,525,848,1132,1178,1174,1227,1306,1104,981,912,1060,1030,1203,1191,1209,1136,1331,1574,1551,1619,1659,1656,1596],
[0,0,0,0,0,0,1,1,1,1,1,2,2,2,2,2,2,2,3,2,2,2,3,2,2,2,2,2,3,3,3,3,3,3,3,3,3,3,3,3,3,4,17,17,16,15,14,12,12,14,15,16,14,14,14,16,15,16,17,1,1,1,1,1,1,0,0,0,0,0,0,0,0,1,1,1,1,1,1,1,1,1,1,2,2,2,3,4,6,6,6,6,6,7,7,6,6,6,6,6,6,7,7,7,8,8,8,8,8,8,8,9,9,9,8,8,7,7,7,7,7,7,7,7,7,7,6,6,6,7,7,7,8,8,8,8,9,9,9,9,9,9,8,9,9,9,9,9,9,9],
[20,34,31,29,29,28,26,25,25,26,26,25,24,23,24,24,23,22,21,22,23,25,26,27,28,30,29,28,27,27,27,26,25,25,24,23,22,22,22,21,21,21,6,6,6,6,5,7,8,6,11,10,12,12,14,14,8,10,10,41,37,35,36,37,38,41,46,47,49,50,53,54,53,48,45,37,37,30,27,22,21,22,21,22,22,22,22,22,22,22,22,22,22,22,22,22,22,23,23,23,23,23,24,25,26,29,29,31,32,33,33,32,33,32,31,30,29,28,28,28,28,27,28,27,28,27,27,27,28,28,27,28,28,29,30,30,30,30,30,29,28,28,28,28,28,29,29,29,28,28],
[2,2,2,1,1,1,1,2,4,4,6,8,10,12,13,13,15,16,18,18,18,18,19,19,18,18,19,19,19,20,20,20,20,20,20,20,21,21,21,21,21,22,25,23,21,18,20,19,18,17,16,15,17,18,19,19,19,20,19,11,11,10,7,6,6,5,2,1,1,1,1,1,6,9,13,14,14,14,14,14,15,15,15,15,15,16,15,13,13,13,14,15,16,16,16,17,17,18,18,19,19,19,19,18,17,17,16,15,15,15,15,15,15,15,15,14,13,13,14,14,15,15,14,13,12,10,9,8,9,10,11,11,11,11,10,9,9,9,9,10,11,13,16,18,18,18,18,18,18,18]]");
    
    $aFilmy[2] = json_decode("[[8,8,8,7,7,6,4,3,2,2,2,2,2,3,3,5,6,7,10,10,7,9,11,7,4,2,2,1,1,1,1,1,1,1,1,2,3,2,2,2,1,2,2,2,2,1,1,1,2,2,2,1,1,1,1,1,2,2,2,2,9,9,9,8,8,8,9,9,10,10,10,9,7,4,3,4,4,7,8,8,8,8,8,8,9,8,8,8,8,8,8,9,9,8,3,3,3,4,9,10,9,9,10,11,9,8,8,9,10,11,13,13,15,13,10,14,17,11,3,3,4,3,3,3,3,3,2,2,3,2,2,3,3,4,4,6,6,5,5,5,6,6,6,6,6,9,8,7,6,8],
[8,7,7,7,7,6,4,2,2,2,1,2,2,2,2,4,4,5,7,8,5,7,8,5,2,2,1,1,1,0,0,1,1,1,1,2,2,2,1,2,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,8,7,7,7,7,7,8,8,8,9,8,8,6,4,3,3,4,6,7,7,8,8,8,8,8,8,8,8,8,8,8,8,8,7,3,3,3,4,8,9,8,8,9,10,8,7,7,7,9,9,11,11,11,9,6,9,9,7,2,1,2,1,1,2,1,1,1,1,1,1,1,1,2,2,2,4,3,3,3,3,3,3,4,4,3,6,5,5,4,6],
[1,1,1,1,0,0,0,0,0,0,0,1,1,1,1,2,2,2,3,3,2,2,2,2,1,1,0,0,0,0,0,0,0,0,0,0,1,0,1,0,0,1,1,1,1,1,1,1,1,1,1,1,0,1,1,0,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,1,1,1,1,1,1,1,1,1,1,1,0,0,0,1,1,1,1,1,0,1,0,1,1,1,1,1,1,1,1,1,1,1,2,2,2,2,4,4,4,5,8,5,2,2,2,2,1,1,1,2,1,1,2,1,2,2,1,2,2,3,3,2,2,2,2,3,2,3,3,3,2,2,2,2],
[5,5,5,4,4,3,2,2,1,1,1,1,1,1,1,2,3,3,5,5,3,5,6,3,1,1,1,1,1,0,0,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,1,1,4,4,4,4,4,4,5,4,5,5,5,4,4,2,2,2,3,4,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,4,2,2,2,2,5,5,5,5,6,6,4,3,4,5,7,7,8,9,9,8,5,9,12,6,2,2,3,2,2,2,2,2,2,1,2,1,1,2,2,2,2,4,3,2,2,2,2,2,3,3,3,4,4,3,3,4],
[3,3,3,3,3,3,2,1,1,1,1,1,1,2,2,3,3,4,5,5,5,5,4,4,2,1,1,0,0,0,0,0,1,1,1,1,1,1,1,1,0,0,0,0,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,5,4,4,4,5,5,5,5,5,5,5,5,4,2,1,2,1,2,3,3,3,3,3,3,3,3,3,3,3,3,4,4,4,3,1,1,1,2,4,5,4,4,4,5,5,5,4,4,4,4,4,5,6,5,4,5,5,5,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,1,3,3,2,3,3,4,3,3,3,3,5,4,4,3,4],
[16,16,16,16,16,16,16,16,15,15,16,16,1,2,2,2,2,2,1,16,3,16,16,2,3,1,15,14,14,14,15,1,2,2,2,1,1,1,15,1,13,13,12,13,12,12,12,11,5,4,4,4,16,3,4,4,4,4,4,3,1,1,1,1,1,1,1,1,1,1,1,16,16,16,15,15,15,15,15,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,15,16,16,16,16,16,16,16,1,1,16,16,15,16,16,15,15,15,16,14,13,14,12,10,13,12,12,13,12,12,12,11,11,7,10,11,13,9,13,14,16,1,3,3,3,5,1,15,15,1,1,16,16,1],
[331,334,318,296,291,236,155,99,84,65,43,60,51,79,89,96,87,100,147,179,165,170,234,161,104,62,56,48,43,26,21,18,32,43,52,57,74,64,34,43,32,76,64,58,68,40,49,13,16,26,8,7,4,3,44,58,65,83,45,78,256,239,253,244,258,289,309,291,323,351,336,304,245,150,122,146,150,235,300,304,346,323,317,328,346,342,346,360,352,318,301,320,302,262,113,117,107,139,311,344,324,330,381,403,302,265,260,263,349,339,386,421,362,238,115,293,390,103,49,36,99,113,85,98,132,103,43,65,35,39,26,32,36,12,89,113,21,38,65,63,81,81,72,47,38,96,126,97,86,131],
[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
[2,4,4,4,4,4,3,4,5,4,5,5,5,5,5,6,5,5,5,5,5,5,5,5,6,8,9,9,9,8,6,6,6,6,5,5,3,3,4,3,4,7,7,8,7,6,6,6,6,4,3,2,1,1,1,1,1,0,0,0,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,2,2,2,2,2,2,2,3,3,3,2,3,2,2,2,2,2,2,2,2,2,3,4,4,4,4,4,3,3,3,3,2,2,1,1,1,1,2,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
[4,3,3,3,3,3,3,2,2,2,3,4,6,8,9,10,11,11,10,10,8,8,7,6,5,4,4,3,2,3,4,4,3,3,3,4,5,6,6,7,7,9,9,9,9,10,9,9,9,10,9,8,8,8,8,9,9,10,9,10,6,6,6,6,6,6,6,5,5,5,5,4,4,2,2,2,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,2,3,4,5,4,4,4,3,4,4,4,4,5,6,6,7,7,8,9,8,9,10,10,9,9,10,9,11,12,14,15,12,9,9,8,6,11,12,10,11,15,15,13,12,12,15,16,16,17,16,16,13,12,12,10]
]");
   
    $aFilmy[3] = json_decode("[[0,13,13,12,12,12,11,11,11,10,10,10,10,10,10,10,9,9,9,9,8,8,7,7,8,9,9,9,8,8,7,6,6,6,6,5,6,6,6,6,7,7,7,7,6,6,6,6,5,5,5,5,5,4,9,10,10,10,10,10,10,9,9,8,8,7,7,8,7,8,11,9,8,9,9,10,10,11,10,10,10,10,11,10,9,8,7,7,7,7,6,7,7,5,5,6,6,6,7,10,11,11,12,13,14,13,13,13,13,12,11,12,11,11,11,11,10,9,9,10,10,10,10,10,10,11,11,11,11,11,10,10,10,10,10,11,11,12,12,12,12,12,12,12,13,13,13,13,14,13],
[0,9,9,8,8,8,8,8,8,7,8,7,7,7,7,7,6,6,6,6,6,6,5,5,5,7,6,5,5,5,4,3,3,3,3,3,4,4,4,4,5,5,5,5,4,4,4,4,4,4,4,4,4,3,7,7,8,8,8,9,9,8,8,7,7,7,6,6,5,5,8,6,6,6,6,7,7,7,7,7,7,7,8,7,6,5,5,5,5,4,4,4,5,3,3,4,4,4,5,7,8,8,9,9,10,9,9,9,9,9,9,9,8,9,8,8,8,8,8,8,8,8,7,7,7,8,8,7,8,8,7,7,7,6,7,7,7,8,8,9,9,9,9,9,9,9,9,9,10,10],
[0,4,4,4,4,4,4,3,3,3,3,3,3,3,3,3,3,3,2,2,2,2,2,2,2,2,3,3,4,3,3,3,3,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,1,1,1,1,1,1,2,3,3,2,1,1,1,1,1,1,1,1,2,2,2,2,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,2,3,3,2,3,2,1,2,2,2,2,2,3,3,3,4,4,4,4,4,4,4,3,3,3,3,3,3,2,2,2,2,2,2,2,2,3,3,3,3,4,4,4,3,3,3,3,3,3,4,3,4,3,3,3,3,3,4,4,4,4,4,4],
[0,8,8,7,7,7,7,7,7,7,7,7,7,7,7,7,6,6,6,6,6,6,6,6,6,7,6,6,6,6,5,5,5,4,4,4,4,4,4,4,4,4,5,4,4,4,4,4,4,4,4,4,4,3,6,7,7,7,7,7,7,6,6,5,5,5,5,6,5,6,7,6,6,6,7,8,8,8,7,7,7,7,7,7,6,6,5,5,5,5,5,6,6,4,4,4,4,3,4,6,6,6,8,8,8,8,8,8,8,8,6,6,6,6,6,6,6,5,5,6,6,6,6,6,6,6,6,6,6,6,5,5,6,6,7,7,7,8,8,8,8,8,9,8,9,9,9,9,9,9],
[0,5,5,5,5,4,4,4,4,4,4,4,3,3,3,3,3,3,2,3,2,2,2,2,2,2,2,3,3,2,2,1,1,1,1,1,2,2,2,2,2,2,2,2,2,2,2,2,2,1,1,1,2,1,3,3,3,3,3,3,3,3,3,3,3,3,2,2,2,2,3,3,2,2,2,3,3,3,3,3,3,3,3,3,3,2,2,2,2,2,1,1,2,1,1,1,2,3,3,4,4,4,5,5,5,5,5,5,5,4,5,5,5,5,5,5,4,4,4,4,4,4,4,4,4,5,5,5,5,5,5,4,4,3,3,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4],
[4,15,15,15,15,14,14,14,14,15,14,14,14,14,14,14,14,14,14,14,14,13,13,13,13,14,13,13,13,13,13,13,13,12,12,12,13,14,14,15,14,15,14,14,13,13,13,14,14,14,14,14,14,15,14,14,14,15,15,15,15,15,15,16,16,16,14,14,14,13,14,13,13,13,13,13,13,13,13,14,14,14,14,14,13,13,13,13,13,13,13,13,13,13,13,13,14,16,15,15,16,15,15,15,15,14,14,14,15,15,16,1,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,1,16,16,16,15,15,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14],
[0,268,225,219,218,269,275,312,288,278,285,307,328,320,327,282,257,265,266,224,267,298,256,252,294,360,298,256,239,229,256,262,273,227,218,173,124,102,163,152,182,163,196,192,234,242,243,226,207,229,199,192,181,142,315,368,368,390,386,411,388,370,357,288,283,250,243,289,260,260,359,303,277,306,345,382,384,376,356,290,305,320,329,292,257,245,230,246,225,245,289,371,349,186,198,237,161,103,161,204,241,228,270,273,302,312,347,333,298,309,292,298,283,286,285,275,298,304,271,284,290,254,218,195,164,180,156,110,152,136,122,145,143,250,279,276,292,351,356,376,356,371,409,377,390,426,399,428,422,426],
[0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,2,2,3,4,6,7,8,9,11,12,11,11,11,12,11,12,13,13,12,12,12,12,12,12,12,12,11,11,11,11,10,7,7,7,8,9,9,9,9,7,6,5,4,4,3,3,3,1,1,2,5,6,6,9,10,9,10,10,11,11,11,11,11,11,11,10,9,9,8,8,8,8,8,8,8,8,9,8,7,6,5,4,4,3,3,3,3,3,2,2,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,2,2,2,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,2],
[0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,1,1,3,3,3,2,3,3,3,2,1,2,2,1,1,2,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,1,1,0,1,0,0,0,1,1,1,1,1,1,1,1,0,0,0,0,2,4,7,5,4,3,2,1,2,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,3,5,5,4,4,4,4,4,4,3,3,3,3,3,4,4,3,1,1,1,1,2,3,2,2,2,4,3,2,2,2,2,1,1,2,1,2,2,2,2,2],
[0,22,25,24,24,24,25,24,24,23,22,23,22,22,22,22,22,20,20,20,19,19,18,17,16,15,14,13,12,11,10,9,7,7,7,7,7,7,7,7,7,7,7,6,6,6,5,6,6,6,6,6,6,5,6,6,6,6,7,7,7,7,8,8,9,10,14,14,13,13,12,11,11,10,9,9,9,9,8,9,8,9,9,8,8,7,7,8,8,8,7,8,7,7,6,6,6,7,9,10,11,13,13,14,14,15,15,15,15,17,19,21,21,21,22,22,22,21,22,22,22,23,22,24,23,24,23,23,23,23,23,22,22,21,20,20,20,20,20,19,19,19,19,19,19,19,19,19,19,19]
]");
    $aFilmy[4] = json_decode("[[15,14,13,13,13,14,14,13,13,14,11,10,8,8,11,12,12,11,11,11,11,9,7,7,7,6,6,6,5,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,5,5,5,5,5,6,6,5,5,5,5,5,6,5,5,5,4,4,4,4,5,5,5,5,5,4,5,2,2,2,2,4,8,9,8,8,8,8,8,8,8,8,8,8,9,8,8,9,8,8,7,7,6,6,6,5,5,5,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,6,8,8,9,9,9,10,10,9,9,9,8,8,9,9,9,8,9,8,5,4,3,3,2,2,3,2,2,3,3],
[10,10,9,8,7,8,8,7,7,8,6,5,4,3,5,6,7,7,7,6,7,6,4,5,4,4,4,4,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,3,3,3,3,2,3,3,3,3,3,3,2,2,2,2,2,2,2,2,2,2,2,0,0,0,0,1,1,1,1,1,1,1,2,2,2,2,1,1,1,1,1,1,1,1,1,1,1,3,4,3,3,3,1,1,1,1,1,1,1,1,1,1,2,1,1,1,1,4,6,7,7,7,7,7,7,6,6,7,6,6,6,7,7,6,6,6,4,2,1,1,1,1,1,1,1,1,1],
[5,5,4,5,6,6,6,5,6,6,5,5,4,5,6,6,5,5,5,4,4,3,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,2,2,2,2,2,2,2,3,3,3,2,3,3,3,3,2,3,3,3,3,3,2,2,2,2,2,2,2,3,2,2,3,2,2,2,2,3,7,7,7,7,7,7,6,6,6,6,7,7,8,7,7,7,7,6,6,6,5,4,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,1,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,1,2,2],
[9,8,8,8,8,9,9,8,9,9,7,7,5,6,9,9,9,8,7,7,7,4,3,3,3,2,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,2,2,3,2,2,2,2,2,3,3,3,3,3,2,2,2,2,2,1,2,2,2,2,3,2,1,1,1,3,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,5,4,4,4,3,3,3,3,3,3,3,2,2,2,2,2,1,1,1,1,1,1,1,1,1,2,4,5,5,5,5,5,5,5,5,5,4,3,3,3,3,3,3,2,2,2,2,2,2,1,2,2,2,2,2,2],
[6,6,5,5,5,5,5,4,5,5,4,3,3,2,3,3,3,3,4,4,4,5,4,4,4,3,3,3,3,2,2,3,3,3,3,3,3,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,3,3,3,3,3,3,3,3,3,3,2,2,2,2,3,3,3,3,3,2,2,2,0,0,1,1,1,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,3,3,3,3,2,2,2,1,1,1,1,1,1,1,1,2,1,2,2,2,2,2,2,3,3,4,4,4,5,4,4,4,5,5,5,5,6,6,6,6,5,4,2,1,1,1,1,1,1,0,1,1],
[15,15,15,14,13,13,13,13,13,14,13,13,12,12,13,13,13,13,14,14,15,1,3,3,3,3,2,2,1,7,4,5,5,6,5,5,5,5,8,8,8,8,6,6,1,5,8,10,5,5,5,5,2,4,5,5,5,5,5,4,6,11,10,7,4,5,5,5,5,4,7,8,5,11,10,11,9,9,10,9,9,9,9,9,9,9,8,8,8,9,9,9,9,9,9,9,9,8,9,8,8,16,15,15,13,11,11,11,11,10,9,10,6,6,7,5,7,7,7,8,14,16,16,16,16,16,1,16,16,16,16,1,2,2,2,2,3,3,3,3,3,10,10,11,11,11,11,12,11,11],
[335,329,253,179,208,262,264,287,246,224,234,256,212,287,421,414,406,321,224,227,178,120,97,165,113,81,62,48,33,22,21,57,51,42,38,35,48,50,30,43,37,31,37,30,1,29,21,23,23,49,33,68,42,60,61,62,79,48,40,8,22,12,21,34,26,14,81,96,127,108,55,16,26,59,123,88,78,82,155,250,261,265,261,258,257,174,182,172,195,220,263,280,262,258,261,235,200,194,216,143,27,79,78,29,51,55,40,58,33,26,44,35,33,24,19,47,23,31,33,50,135,220,229,191,191,204,237,242,210,194,206,192,201,234,234,273,274,272,250,121,21,28,48,50,73,92,84,95,88,78],
[5,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,44,45,45,44,45,45,45,45,45,45,44,44,44,44,44,44,44,45,45,45,45,45,45,45,45,45,45,45,45,45,46,46,49,48,49,8,6,9,54,61,57,56,62,59,57,54,55,51,64,83,82,83,82,93,44,44,44,44,44,44,45,44,45,44,44,44,44,45,45,45,45,45,45,44,44,44,44,44,44,44,43,43,43,43,43,43,43,43,43,43,43,43,43,44,44,44,45,46,46,46,46,46,46,46,46,46,46,46,45,46,45,45,45,45,44,44,44,44,44,44,44,45,45,45,45],
[35,35,35,34,34,34,33,34,34,34,36,37,35,34,35,36,35,35,34,33,33,29,27,25,26,30,31,32,34,37,39,39,38,38,38,39,39,41,42,42,42,42,42,42,41,38,36,34,34,33,34,34,33,36,38,40,42,9,7,5,8,8,8,12,7,6,7,4,7,6,6,7,7,5,1,1,1,0,0,36,35,35,35,34,33,36,36,36,35,35,34,34,33,33,32,32,33,33,32,32,32,30,31,31,34,38,38,39,40,42,41,40,42,41,42,43,41,41,41,40,34,30,29,28,28,28,28,28,28,27,26,26,24,23,23,27,31,34,34,35,39,42,45,45,47,47,47,46,46,47],
[2,2,2,2,2,2,2,2,2,2,2,2,1,1,2,1,2,2,2,2,2,3,3,5,5,5,4,3,3,2,1,0,0,0,0,0,0,0,1,1,1,1,1,1,1,1,1,2,2,1,1,1,1,1,1,1,1,8,10,11,10,11,10,10,6,12,12,10,9,10,11,8,10,8,4,7,7,7,0,1,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,2,2,1,1,1,1,1,1,1,1,1,1,2,2,2,2,2,1,1,1,0,0,0,0,0,0]
]");
   
    $aFilmy[5] = json_decode("[[4,3,3,3,3,56,57,59,60,61,62,62,62,62,62,63,63,64,64,64,65,65,65,65,65,65,65,66,65,65,66,66,67,67,67,67,66,67,66,67,67,66,66,66,66,67,67,66,66,66,67,67,67,68,67,67,67,61,59,58,61,63,65,66,67,67,65,61,61,61,63,64,64,63,63,63,66,68,69,69,69,68,68,68,68,64,62,62,62,63,63,65,67,68,68,3,2,3,3,3,4,3,3,4,4,4,3,3,5,4,4,2,2,3,53,53,52,52,52,52,52,52,52,52,52,52,51,51,51,51,51,50,50,50,50,50,50,50,50,49,47,45,40,33,26,22,27,31,35,48],
[2,1,1,2,2,54,55,57,58,59,60,60,60,60,60,61,61,62,62,62,63,63,62,63,63,63,63,63,63,63,64,64,64,64,65,64,64,64,64,64,64,64,64,64,64,64,64,64,64,64,65,65,65,65,65,65,65,60,57,56,59,60,63,64,65,65,62,59,58,59,60,61,61,60,60,60,63,65,66,66,66,66,66,66,65,62,60,59,60,60,61,62,65,65,66,1,1,1,1,2,2,1,2,2,2,2,1,2,2,2,2,1,1,1,50,50,50,49,49,50,50,50,50,50,50,50,49,49,49,49,49,48,48,48,48,48,48,47,48,46,45,43,38,31,24,20,25,29,33,45],
[2,1,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,2,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,2,2,2,2,2,2,2,3,3,3,3,3,3,3,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,1,1,1,2,2,2,2,2,2,2,2,2,2,4,3,2,1,1,2,3,3,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3],
[2,2,2,2,2,30,31,32,32,33,33,33,33,33,33,34,34,34,34,34,35,35,35,35,35,35,35,35,35,35,35,36,36,36,36,36,36,36,36,36,36,36,36,35,36,36,36,36,36,35,36,36,36,36,36,36,36,33,32,32,34,35,36,36,37,37,36,33,33,33,34,35,34,34,34,34,36,37,37,37,36,36,36,36,36,34,33,32,33,33,33,34,35,35,36,1,1,1,2,2,3,2,2,2,2,2,1,2,2,2,2,1,1,2,28,28,28,27,27,28,28,28,28,28,28,28,27,27,27,27,27,26,27,26,27,27,27,26,26,26,25,23,21,17,13,10,11,12,13,18],
[2,1,1,2,1,26,26,28,28,29,29,30,29,29,29,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,31,31,31,31,31,31,31,30,31,31,31,31,31,31,31,31,30,30,31,31,31,32,32,32,31,31,28,27,26,28,28,29,30,30,30,29,28,28,28,29,29,30,29,29,29,31,31,32,32,32,32,32,32,32,30,30,30,30,30,30,31,32,32,33,1,1,1,1,1,1,1,1,2,1,2,1,1,3,2,2,1,1,2,25,25,25,25,24,24,24,24,24,24,24,24,24,24,24,24,24,24,24,23,23,23,23,23,24,23,22,21,19,16,13,12,16,19,22,30],
[1,14,11,13,14,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,4,13,11,12,12,12,12,12,11,12,11,10,11,6,8,9,11,9,8,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,1,1,1,1,1,1],
[9,10,34,10,35,2118,2162,2223,2235,2298,2310,2308,2312,2313,2323,2354,2359,2383,2386,2400,2420,2400,2403,2411,2406,2417,2421,2436,2426,2417,2439,2449,2462,2461,2459,2444,2448,2459,2444,2458,2463,2448,2445,2444,2449,2453,2461,2424,2443,2444,2459,2462,2475,2483,2471,2464,2460,2310,2239,2166,2278,2333,2383,2435,2449,2447,2383,2271,2247,2273,2337,2346,2358,2322,2345,2337,2422,2487,2520,2516,2507,2505,2498,2486,2486,2384,2315,2289,2313,2316,2329,2378,2462,2477,2508,21,9,2,59,60,101,42,50,44,53,54,25,8,113,36,17,11,11,26,1889,1898,1892,1869,1863,1882,1881,1889,1892,1894,1890,1891,1859,1855,1859,1864,1859,1845,1849,1828,1853,1851,1829,1819,1822,1785,1750,1674,1512,1227,936,761,985,1153,1346,1935],
[83,82,81,78,76,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,37,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,38,59,61,63,66,66,63,60,61,58,56,55,52,52,51,50,55,68,70,64,36,36,36,36,36,36,36,36,36,36,35,36,35,35,35,35,35,35,36,35,36,36,36,36,36,36,36,36,36,36,36,37,38,38,38,39],
[1,0,0,0,0,44,44,44,44,44,44,44,44,44,44,44,44,44,44,44,44,43,44,44,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,42,42,42,42,42,42,42,42,42,42,42,42,41,41,42,41,41,41,41,42,42,42,42,42,42,42,42,42,41,42,41,41,42,42,42,42,42,42,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,48,48,48,48,48,48,48,48,48,48,48,48,48,48,48,48,48,48,48,48,48,48,48,48,48,48,48,48,48,48,47,46,45,44,44,43],
[2,4,6,8,7,3,3,3,3,3,3,3,3,3,3,3,3,3,3,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,3,3,3,3,4,4,4,4,4,4,3,3,3,3,3,3,3,3,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,21,23,21,21,21,23,26,23,24,27,28,31,31,32,32,24,13,14,18,2,2,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,2,2,2,3,3,4,4]
]");
    
    $aFilmy[6] = json_decode("[[3,3,3,3,2,2,2,2,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,2,2,2,2,2,2,2,3,3,3,3,3,2,3,3,3,3,3,3,3,3,2,3,3,3,2,2,2,2,2,2,2,2,3,3,3,3,3,3,2,2,2,2,2,3,3,3,3,3,4,4,4,4,4,5,4,4,3,4,4,3,3,4,4,4,4,3,4,4,4,4,4,3,4,4,4,3,3,3,4,4,3,3,4,4,4,4,4,4,5,4,3,3,4,4,4,4,3,3,3,4,3,3,3,3,4,4,4,3,4,3,3,3,4,4,4,3],
[2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,2,2,2,2,2,3,3,3,3,3,2,2,2,3,2,2,2,2,2,2,2,2,2,3,3,3,3,3,2,2,2,2,2,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,1,1,2,2,3,2,3,3,3,4,3,3,2,3,3,2,2,2,3,3,2,2,3,3,3,3,2,2,2,3,3,2,2,2,2,2,2,2,3,3,3,3,3,3,3,3,2,2,3,3,3,2,2,2,2,3,2,2,2,2,3,3,3,2,2,2,2,2,3,3,3,2],
[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,2,2,2,2,2,2,2,2,1,2,2,1,1,2,2,2,2,2,2,2,2,2,2,2,2,2,2,1,1,1,2,1,1,2,2,2,2,1,1,1,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
[1,1,2,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,1,1,1,1,1,2,1,1,2,2,2,2,2,2,2,2,2,1,1,1,1,2,1,1,1,2,2,2,2,2,3,3,2,2,2,2,2,2,2,2,2,3,2,2,2,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,2,3,3,3,3,2,2,3,3,3,2,2,2,2,2,2,2,2,2,2,3,2,2,2,2,2,2,2,2,3,2],
[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,16,1,1,1,1,2,2,2,2,1,2,1,1,1,1,1,2,1,1,1,1,1,2,1,1,1,1,1,1,1,1,1,2,2,2,1,1,1,1,1,2,2,2,3,2,3,6,9,9,8,8,7,8,7,7,7,7,7,8,8,7,7,8,8,7,7,8,7,7,7,8,7,7,8,8,8,8,8,7,8,7,7,7,8,8,7,7,7,7,7,7,7,7,7,7,7,7,7,7,7,6,7,7,7,7,7,8,7,7,7,7,7,6,7,7,7,6,6],
[91,97,101,97,90,91,73,84,83,77,75,83,79,76,76,76,78,77,75,72,73,76,76,74,73,76,78,82,82,78,84,87,103,91,88,88,90,95,93,94,97,97,89,90,102,96,101,101,94,100,110,107,108,105,100,99,92,102,96,87,90,93,86,88,103,93,104,115,110,119,116,114,100,85,74,64,63,47,10,31,35,63,80,69,94,95,118,151,103,75,79,83,91,80,58,69,91,104,62,58,77,99,89,89,57,63,73,95,82,50,50,63,79,82,57,70,108,120,107,100,122,144,144,121,76,76,134,133,127,96,84,89,108,117,83,72,81,67,96,106,93,85,91,96,88,40,106,106,132,97],
[0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,2,3,4,4,5,5,5,6,6,7,7,7,7,6,6,6,6,7,6,6,6,6,6,5,6,5,6,6,6,6,6,6,6,6,7,6,6,7,7,7,7,7,8,8,8,8,8,8,8,8,8,9,9,9,9,10,10,10,10,10,10,9,9,10,10,9,9,9,9,8],
[48,48,48,48,47,47,47,47,47,47,47,47,47,47,47,46,46,46,46,46,46,46,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,45,44,44,44,44,44,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,41,24,20,15,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,12,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,12,12,12,12,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,11,12,12,12,12,12,12,12,12,12,12]
]");
   
    $aFilmy[7] = json_decode("[[1,1,1,0,0,29,27,27,28,29,29,29,30,30,31,31,31,31,30,30,29,29,28,27,28,29,30,31,31,30,30,30,30,30,29,29,29,29,29,30,30,27,25,24,26,29,30,31,32,32,32,32,31,30,29,30,30,30,29,28,29,30,31,29,30,30,30,30,29,29,28,29,30,30,30,30,31,31,32,32,33,33,33,33,33,34,34,34,34,34,32,33,33,33,33,32,32,32,33,32,1,1,1,1,1,34,34,34,33,32,31,31,30,25,22,23,24,28,29,31,30,31,31,30,27,26,24,22,22,23,27,28,30,30,31,31,32,32,32,32,32,33,33,33,33,34,34,34,34,34],
[0,0,0,0,0,22,20,20,21,22,22,22,22,23,23,23,23,23,22,22,22,21,21,20,21,21,23,23,23,22,22,23,22,22,22,22,21,22,22,22,23,20,19,18,20,22,22,23,23,24,24,23,22,22,21,22,22,22,22,21,21,22,22,22,22,22,23,23,22,21,21,22,22,22,22,22,23,23,24,24,24,25,25,25,25,25,25,25,25,25,24,24,25,25,25,24,24,25,25,24,0,0,0,0,0,24,24,24,24,23,22,22,22,18,16,16,16,20,20,22,21,21,22,21,19,18,17,16,15,16,19,20,21,22,22,23,23,23,23,23,23,23,24,24,24,24,24,25,24,24],
[0,0,0,0,0,8,7,7,7,8,8,8,8,8,8,8,8,8,8,8,8,7,7,7,7,7,8,8,8,8,8,8,8,8,7,7,7,7,7,8,8,7,6,6,7,8,8,8,8,9,8,8,8,8,8,8,8,8,8,7,8,8,8,7,8,8,8,8,7,8,7,8,8,8,8,8,8,8,8,8,8,8,8,8,8,9,9,8,8,8,8,8,8,8,8,8,8,8,8,8,1,1,1,1,1,10,10,10,9,9,9,9,9,7,7,7,7,8,9,9,9,9,9,9,8,7,7,6,6,7,8,8,8,9,9,9,9,9,9,9,9,9,9,9,9,10,9,9,10,10],
[0,0,0,0,0,14,13,13,13,14,14,14,14,14,14,14,15,15,14,14,14,14,14,13,14,14,15,16,16,15,15,16,15,15,15,15,14,15,15,15,16,14,13,13,15,17,18,18,18,19,18,18,18,17,16,16,16,16,16,15,16,16,16,16,16,16,16,16,15,15,15,15,16,15,15,15,16,16,16,17,17,17,17,17,17,17,17,17,18,18,17,17,17,17,17,17,17,17,17,17,1,1,1,1,1,18,18,18,18,17,17,16,16,14,12,13,14,17,17,19,18,18,18,18,16,15,13,12,11,12,14,14,15,15,15,16,16,16,16,16,16,17,17,17,17,17,17,17,17,17],
[1,1,0,0,0,15,14,14,15,15,16,16,16,16,16,16,16,17,16,16,16,15,15,14,14,14,15,15,16,15,15,15,15,15,15,14,14,14,14,14,14,13,12,11,12,12,13,13,13,14,14,13,13,13,13,13,14,14,13,13,13,14,14,14,14,14,14,14,14,14,13,14,15,14,14,15,15,15,16,16,16,16,16,16,16,16,16,16,16,16,15,15,16,16,15,15,15,15,15,15,1,1,0,0,0,16,16,16,16,15,15,14,14,12,10,10,10,11,12,12,12,12,13,13,12,11,11,10,10,11,13,14,14,15,15,16,16,16,16,16,16,16,16,17,16,17,17,17,17,17],
[4,5,4,5,5,1,16,16,1,1,16,1,16,16,1,16,1,1,1,1,1,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,10,10,10,10,10,16,16,16,16,16,16,16,16,16,16,16,16,15,15,15,15,15,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16],
[30,31,30,29,29,748,665,653,630,660,819,725,729,795,792,737,798,763,672,720,720,710,693,685,727,791,821,835,851,755,754,762,746,753,746,803,789,738,738,819,841,700,649,615,670,741,766,780,791,801,810,804,763,734,769,780,804,761,783,748,736,743,757,747,749,758,854,774,741,730,728,748,762,749,751,760,765,783,864,804,816,827,831,829,830,837,831,834,842,919,816,817,940,929,884,864,864,874,871,873,46,47,47,47,47,714,728,724,732,699,683,667,673,564,497,520,521,719,736,797,762,784,688,678,623,605,549,516,473,436,528,643,654,592,602,617,626,630,694,685,623,638,707,728,720,714,714,724,766,721],
[3,2,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],
[56,57,55,65,64,16,15,15,15,15,15,15,15,15,15,15,15,15,15,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,14,13,13,14,14,14,14,14,14,14,14,14,13,13,13,12,13,12,12,13,12,13,13,13,13,13,13,13,13,13,12,13,13,13,13,13,14,14,14,14,14,14,14,14,14,15,15,14,15,15,15,15,15,15,15,15,15,15,15,48,50,54,59,63,15,15,15,15,15,15,15,14,14,13,13,13,12,13,13,13,13,12,12,12,12,13,13,13,13,13,13,13,13,14,14,14,14,14,14,14,14,15,15,15,15,15,15,15,15],
[19,20,20,11,19,65,65,65,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,66,15,14,13,11,8,64,64,64,64,64,64,64,64,64,64,64,64,65,64,64,64,64,64,64,64,64,64,64,64,65,65,65,65,65,64,64,64,64,64,64,64,64,64,64,64,64,64,64,64,64]
]");
  
    $aFilmy[8] = json_decode("[[31,30,29,5,6,6,5,5,6,5,5,5,5,25,24,24,23,23,23,23,22,20,20,20,20,20,20,19,19,18,18,18,17,18,18,18,18,18,19,19,19,18,15,12,11,11,13,13,13,12,13,13,14,18,18,19,21,22,23,24,24,26,27,28,27,28,29,29,28,28,27,27,26,26,26,25,24,22,22,21,20,20,19,18,19,19,20,20,20,19,20,21,21,22,22,22,22,22,22,20,22,21,21,20,20,20,21,22,22,22,23,22,23,23,23,23,23,22,22,23,24,23,23,23,21,22,21,22,21,21,22,20,20,20,20,19,19,18,18,19,19,20,22,23,22,23,24,24,23,23],
[25,25,24,2,2,2,2,2,2,2,1,1,1,20,20,19,19,18,18,19,18,16,16,15,16,15,15,14,14,14,14,13,13,13,14,13,13,13,13,14,14,13,10,8,7,8,9,10,10,9,9,10,11,15,15,16,18,19,19,20,21,23,24,24,24,25,26,26,25,24,24,24,23,23,23,21,21,19,18,17,17,17,16,15,15,15,16,16,16,15,16,17,17,18,18,18,18,18,18,16,18,17,17,16,16,16,17,18,18,18,19,18,18,18,18,19,18,18,17,18,19,19,19,18,17,17,16,17,16,17,17,15,15,15,15,14,14,13,13,13,14,15,17,17,16,17,18,18,17,16],
[5,5,5,3,4,4,3,4,4,4,3,4,4,4,4,5,5,4,5,5,4,4,4,4,4,4,4,4,4,4,5,5,5,5,5,5,5,5,5,5,5,5,5,4,4,4,4,4,4,3,3,3,3,3,3,3,3,3,3,3,3,3,3,4,4,4,4,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,4,4,3,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,5,5,4,4,4,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,6,6,6,6,6,6,6,7,6],
[15,15,15,4,4,4,4,4,4,4,4,4,4,13,13,13,12,12,12,12,12,11,10,10,10,10,9,9,9,9,8,8,8,8,8,8,9,9,10,10,10,10,9,8,7,7,8,8,8,7,7,8,8,9,10,10,11,12,12,13,13,14,14,15,14,15,15,15,15,14,14,14,13,13,13,12,12,11,10,10,10,9,9,8,9,9,9,10,10,10,10,10,11,11,11,11,11,11,11,10,11,10,10,10,11,11,11,12,12,12,12,12,12,12,12,12,11,11,11,11,12,11,11,11,11,11,11,11,11,10,10,9,9,9,9,9,9,9,9,9,10,11,12,13,13,13,14,14,13,13],
[15,15,14,1,2,1,1,1,2,2,1,1,1,12,11,11,11,10,10,11,10,10,10,10,10,10,11,10,10,10,10,10,10,10,10,10,9,9,9,9,8,7,5,4,4,4,5,5,5,5,5,5,6,9,9,9,10,10,10,11,11,12,13,13,13,14,14,14,14,14,14,13,14,13,13,13,12,11,11,11,11,11,10,10,10,10,10,10,10,10,10,11,10,10,10,11,11,11,11,10,11,11,10,10,10,9,10,10,10,10,11,10,11,11,11,11,11,11,11,12,12,12,12,12,11,11,11,11,11,11,12,11,11,11,11,10,10,10,9,9,10,10,10,10,10,10,10,10,10,10],
[1,1,1,12,11,12,12,11,11,11,11,11,11,16,16,16,16,16,16,16,16,16,16,16,16,1,1,1,1,1,1,1,1,1,1,1,1,16,16,16,16,15,15,14,14,15,15,15,15,15,16,16,16,16,16,16,16,16,16,1,16,16,1,1,16,16,16,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,16,16,16,16,16,16,16,16,1,16,16,16,16,16,1,1,1,1,1,1,1,1,1,1,16,16,16,16,1,1,1,1,1,16,16,16,16,16,16,16,16,16,16,16,16,16,16,16],
[821,796,817,174,201,187,192,194,200,165,179,185,181,663,608,606,585,547,583,569,545,488,477,459,474,471,508,464,467,435,431,413,395,400,419,399,357,343,356,392,425,428,329,264,208,185,246,274,269,211,253,274,228,388,416,499,551,592,639,657,798,786,810,816,850,876,923,861,841,835,820,868,848,809,839,804,727,593,578,551,542,579,509,486,498,483,505,491,478,459,508,501,530,509,514,550,565,576,584,524,566,567,521,492,536,549,564,590,617,573,646,621,593,582,569,637,661,569,545,682,704,701,704,602,519,535,539,523,529,551,566,508,521,478,449,427,447,422,440,373,481,470,607,646,561,595,682,698,647,623],
[0,0,0,7,12,14,12,10,8,7,5,6,9,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],
[76,76,77,27,26,25,23,24,21,23,28,36,39,81,81,81,81,82,82,83,84,84,84,83,82,82,82,83,83,83,84,84,84,83,83,83,82,82,82,81,81,81,81,80,80,80,80,80,80,81,80,81,80,81,80,80,80,80,79,79,79,79,77,77,76,76,77,77,78,78,78,79,79,79,79,80,81,80,79,78,77,78,78,78,78,78,78,79,79,79,78,78,79,78,79,78,79,79,80,81,78,77,77,77,77,76,76,76,76,76,76,76,76,76,76,76,76,76,75,75,75,74,74,75,76,77,78,78,79,80,81,81,82,83,83,84,85,85,86,85,84,83,82,82,81,81,82,82,82,82],
[8,7,7,7,6,4,5,4,4,4,3,3,5,5,5,5,5,5,5,5,5,5,5,5,5,4,4,4,4,4,4,3,4,4,4,4,4,4,4,5,5,5,5,5,5,5,5,5,4,3,3,3,4,4,4,4,4,4,5,5,5,5,6,6,6,6,6,6,6,6,6,6,6,6,6,5,5,5,5,5,5,5,5,5,5,5,5,5,5,4,4,4,4,4,4,4,4,4,4,4,5,5,4,5,5,5,5,5,5,5,6,6,6,6,6,6,6,6,6,6,6,7,7,7,6,6,6,6,6,5,5,5,5,4,4,4,3,3,3,4,4,5,5,5,5,5,5,5,5,5]
]");
    
    $aFilmy[9] = json_decode("[[6,6,5,5,5,5,5,5,5,4,5,5,5,5,5,5,4,5,5,5,4,4,4,4,5,4,4,4,5,5,5,5,6,8,8,8,8,7,6,6,6,6,6,5,5,4,4,3,3,3,3,3,4,3,4,14,11,10,10,10,9,9,8,8,8,8,8,8,8,7,5,3,3,3,3,3,3,3,4,5,5,5,5,5,5,5,6,6,5,4,5,5,5,5,5,33,33,32,32,34,34,34,33,33,32,30,28,27,24,23,23,21,21,20,18,13,11,11,12,10,10,9,10,12,11,13,13,12,13,11,12,12,10,10,8,7,8,7,8,10,8,9,8,8,9,8,10,10,9,13],
[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,2,2,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,1,1,1,0,1,1,1,1,1,1,7,5,5,4,4,3,3,3,2,2,2,2,1,1,1,1,1,1,1,1,0,0,1,1,1,2,2,2,2,2,3,3,3,2,1,2,2,2,2,2,26,26,25,25,25,25,25,25,24,23,22,21,21,18,17,16,15,15,14,12,8,7,7,7,6,6,6,6,7,6,7,7,7,7,7,7,7,5,6,5,5,5,5,6,7,5,6,5,5,5,5,6,6,6,5],
[5,5,5,4,4,4,4,4,4,3,4,4,4,4,3,3,3,3,3,3,3,3,3,3,4,3,3,3,4,4,5,5,6,7,7,8,7,6,5,5,5,5,5,4,4,3,3,3,3,3,2,3,3,3,3,7,6,6,6,6,6,6,6,6,6,6,6,7,7,6,4,2,2,3,3,3,3,3,3,4,4,3,3,3,3,3,3,3,2,2,3,3,3,3,3,7,7,7,7,9,8,9,9,9,8,8,7,6,7,6,6,6,6,6,5,5,4,4,5,4,4,4,4,5,5,6,6,5,5,5,5,5,4,4,3,2,3,2,3,4,3,3,3,4,4,3,4,4,3,8],
[4,4,3,3,3,3,3,3,3,2,3,3,3,4,3,3,3,3,3,3,3,2,3,3,3,3,3,3,3,3,3,3,3,4,4,4,4,3,3,3,3,3,3,3,3,2,2,1,1,1,1,2,2,2,3,6,4,4,3,4,3,4,3,3,3,3,4,3,3,3,2,2,2,2,2,2,2,2,3,4,4,4,4,4,4,4,4,4,3,2,4,3,3,4,4,17,16,16,16,17,17,17,17,17,16,15,14,14,13,12,12,12,12,12,11,8,7,7,7,6,6,5,5,6,5,6,6,7,6,6,6,6,5,5,5,4,4,4,5,5,4,4,4,5,5,4,5,5,5,7],
[2,2,2,2,2,2,2,2,2,2,2,2,2,2,1,2,1,1,1,2,1,2,2,2,2,2,1,2,2,2,2,2,3,4,4,4,4,3,3,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,1,8,7,7,6,6,6,5,5,5,5,5,5,5,5,4,3,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,2,3,2,1,1,1,1,1,1,16,16,16,16,17,17,17,17,17,16,15,14,13,12,11,11,10,9,8,7,4,4,4,4,4,4,4,5,6,6,7,7,5,7,6,6,6,4,5,4,3,4,3,4,5,4,5,4,4,4,4,5,5,4,6],
[9,9,9,9,9,9,9,9,10,9,9,10,10,11,11,10,12,11,11,11,12,10,10,10,10,10,10,10,10,9,9,9,8,8,9,8,8,8,8,8,9,10,10,10,10,9,9,8,8,8,8,9,9,9,11,5,5,5,6,7,7,7,8,7,8,7,8,8,8,8,8,9,10,9,9,9,9,10,10,11,11,12,11,12,12,12,13,13,12,11,12,12,12,12,12,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,16,16,16,15,14,13,14,14,14,15,14,1,1,2,1,1,13,15,15,15,1,13,14,14,15,16,15,16,1,1,1,16,15,15,14,16,15,14,10],
[211,202,176,148,130,159,127,123,128,111,91,113,172,164,135,128,135,125,139,114,87,75,107,120,148,115,117,125,142,146,176,188,210,245,239,310,299,201,195,140,170,163,184,195,153,96,98,79,92,84,80,75,72,72,98,203,191,241,220,235,211,192,180,249,251,201,217,258,277,240,112,68,77,82,99,105,113,127,158,195,186,167,154,172,156,141,110,68,123,86,150,137,139,149,135,838,846,797,795,796,844,786,782,783,751,702,723,729,591,550,541,511,466,487,470,352,259,211,263,219,91,115,80,94,94,66,64,175,141,98,96,60,93,68,94,136,144,131,127,129,91,117,84,83,115,144,100,126,141,139],
[6,5,3,1,1,1,1,1,1,1,1,1,1,1,1,0,0,1,0,1,1,0,0,0,0,0,0,0,0,0,0,1,1,1,1,1,1,1,0,0,0,0,0,0,1,0,0,1,1,0,0,0,0,0,1,0,0,0,0,0,1,1,1,1,1,1,1,1,1,1,1,2,2,1,0,0,0,1,0,0,0,0,0,0,1,1,1,1,1,1,1,1,1,0,0,22,22,22,22,22,23,23,23,23,22,23,23,22,22,22,22,22,21,21,21,20,20,21,22,22,22,23,24,24,27,28,31,31,31,32,35,37,38,39,39,40,41,42,41,41,42,41,43,45,44,41,42,43,46,1],
[20,44,48,51,53,52,54,57,64,63,64,63,53,18,16,21,23,25,28,20,29,53,60,65,49,57,51,49,51,45,46,55,54,44,48,44,45,35,29,27,21,18,12,23,12,16,24,23,11,6,13,14,15,24,27,64,66,66,68,69,69,67,66,64,62,63,64,63,66,66,67,64,63,55,45,50,53,49,65,62,61,62,67,67,68,62,56,60,69,64,59,53,55,58,59,36,36,37,38,38,38,39,39,39,40,39,39,40,40,41,40,40,39,40,41,41,43,43,43,42,41,41,41,38,37,36,35,34,33,34,35,34,30,25,26,27,24,21,17,12,9,7,6,6,6,6,6,6,6,71],
[3,3,3,3,3,2,2,1,1,0,1,1,1,1,1,1,2,1,1,1,1,0,2,3,4,5,6,6,5,4,4,4,3,3,3,3,3,3,5,5,5,4,5,4,3,3,5,5,4,3,3,3,2,2,2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,8,8,8,8,8,8,8,8,8,8,8,8,8,7,7,7,6,6,5,5,5,5,5,5,5,5,5,5,5,5,6,6,7,8,9,9,8,8,9,9,9,11,12,18,21,25,26,27,28,31,34,34,33,29,7]
]");
    
    
    $aBadanaProbka = array();
    $aBadanaProbka[0] = json_decode("["
            . "[29,29,29,29,29,29,27,26,12,15,25,24,23,24,24,24,25,12,24,29,31,35,36,17,36,35,31,32,31,29]," //kp 0 
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]," //kpT 1
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]," //2
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0]," //3
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"//4 
            . "[1,1,1,1,1,1,1,1,2,1,1,1,1,1,1,1,1,2,1,1,1,1,16,1,16,16,16,16,16,16],"
            . "[1097,1108,1124,1097,1114,1082,1044,985,493,550,923,900,844,897,930,872,907,440,891,1052,1113,1299,1447,686,1426,1390,1220,1196,1139,1038],"
            . "[5,6,6,5,6,6,6,6,6,4,5,5,5,5,5,5,5,6,5,4,5,4,4,5,4,3,4,4,3,3],"//b = 7
            . "[68,69,69,69,66,66,66,65,63,67,64,64,65,65,65,65,64,59,59,57,56,56,55,52,51,51,52,52,52,53],"//g
            . "[6,6,6,6,10,10,9,9,9,10,10,10,10,9,9,9,9,8,11,11,9,10,10,10,12,13,12,12,13,12]"//r
            . "]");
    $aBadanaProbka[1] = json_decode("["
            . "[4,3,5,5,5,4,5,7,8,9,10,13,19,18,20,21,24,28,25,15,18,23,22,20,21,22,22,24,26,26],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[2,16,1,2,1,2,16,15,15,15,15,14,15,15,15,15,15,15,15,16,15,15,15,15,15,15,15,15,15,15],"
            . "[24,45,67,83,55,58,100,173,270,358,445,579,903,875,976,972,1105,1261,1065,602,782,932,927,881,922,941,913,963,1025,1010],"
            . "[2,2,2,1,1,2,2,2,1,1,2,2,3,4,3,4,6,6,6,6,5,6,7,6,6,7,7,7,7,6],"
            . "[84,83,84,83,83,81,79,70,58,61,66,64,65,64,63,62,61,59,58,58,60,57,56,57,57,57,56,55,55,54],"
            . "[0,0,0,0,0,0,1,3,5,6,7,8,9,9,10,11,12,13,14,13,14,14,14,14,14,14,14,15,15,16]]");
    
    $aBadanaProbka[2] = json_decode("[[6,5,7,6,4,3,1,2,2,3,3,3,3,4,6,7,8,8,6,8,11,7,4,2,3,2,0,1,1,1],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[15,15,16,16,16,16,15,16,16,16,1,2,2,2,2,2,16,16,3,1,16,2,3,16,16,14,16,15,15,16],"
            . "[248,209,258,220,151,89,62,57,55,70,80,99,94,84,98,86,115,89,119,143,236,171,126,28,82,64,12,29,34,44],"
            . "[0,0,0,0,0,0,0,0,1,1,2,3,5,6,5,6,4,5,3,3,4,4,4,3,3,4,5,5,3,1],[12,6,8,9,8,10,11,13,13,11,12,10,11,15,14,14,12,12,11,10,10,11,11,11,13,20,26,32,30,26],"
            . "[9,9,9,9,9,8,8,9,10,13,14,15,15,14,15,14,14,13,12,12,11,11,9,9,8,7,5,6,6,7]"
            . "]");
    
    $aBadanaProbka[3] = json_decode("["
            . "[8,6,10,9,9,8,9,8,8,9,6,7,7,9,10,8,3,5,6,8,7,7,7,7,7,8,7,7,6,6],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[14,14,15,14,14,13,13,14,15,14,14,14,14,14,14,14,14,14,14,14,14,13,13,14,14,13,13,13,14,13],"
            . "[215,167,189,214,248,267,285,230,236,264,209,266,271,327,326,311,128,167,241,334,298,255,282,269,285,319,236,250,230,235],"
            . "[9,8,10,10,8,9,9,11,10,9,10,9,10,9,9,12,13,10,9,10,11,12,12,12,11,9,10,9,7,6],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[10,10,10,10,11,10,10,9,9,9,8,9,8,8,8,7,6,7,7,6,6,6,6,6,6,6,6,7,8,8]]");
    
    $aBadanaProbka[4] = json_decode("[[0,2,4,5,5,5,5,6,6,5,5,4,4,5,5,5,8,11,9,10,8,6,6,6,5,5,6,6,4,4],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[16,14,16,11,13,13,13,12,12,11,12,12,12,13,14,14,13,13,13,13,6,3,4,4,4,4,1,2,8,6],"
            . "[11,19,46,34,85,59,51,77,87,77,104,57,92,103,83,96,140,258,151,69,62,72,55,112,76,47,85,81,40,47],"
            . "[10,11,11,11,9,11,14,15,15,17,17,14,11,12,14,14,14,14,14,12,11,9,8,11,12,19,19,15,13,13],"
            . "[31,32,32,33,32,32,32,33,33,34,34,33,32,32,33,34,34,34,33,32,30,27,26,28,33,34,35,36,39,41],[1,1,1,1,1,1,2,2,2,1,1,1,2,2,2,2,2,2,2,2,3,4,6,7,5,4,4,3,1,1]"
            . "]");
    
    $aBadanaProbka[5] = json_decode("[[0,1,1,1,14,36,17,39,44,43,40,44,43,44,44,46,45,43,43,46,21,46,28,46,46,47,47,41,44,42],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[3,3,15,16,1,16,1,16,16,16,16,16,16,16,16,16,16,16,16,16,1,1,16,16,16,16,16,16,16,16],"
            . "[12,3,5,11,538,1330,619,1425,1620,1611,1438,1644,1515,1647,1561,1708,1618,1573,1619,1629,770,1634,1034,1643,1620,1665,1632,1417,1539,1507],"
            . "[75,75,73,71,35,35,35,35,36,36,35,35,35,35,34,35,34,35,37,36,36,35,34,35,35,35,35,35,35,34],"
            . "[0,0,0,0,38,38,40,38,39,38,38,38,38,37,37,38,38,38,38,38,37,37,39,37,37,37,37,37,37,37],[2,5,6,6,3,3,3,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4]]");
    
    $aBadanaProbka[6] = json_decode("[[1,2,2,2,2,2,2,2,2,2,2,1,1,2,2,2,2,2,2,2,2,1,1,2,1,2,2,2,2,1],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[1,1,1,2,2,2,2,2,2,2,1,1,2,1,2,1,2,1,2,1,1,1,1,16,1,1,16,16,16,1],[58,69,72,67,67,62,64,59,55,55,60,41,38,59,63,79,71,53,59,58,70,33,44,68,33,70,69,71,76,38],"
            . "[5,7,8,7,5,7,8,8,8,7,7,7,7,5,6,7,7,8,9,8,7,7,5,4,6,6,6,6,6,6],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[39,39,39,39,39,39,39,40,39,39,39,38,38,40,40,39,39,39,39,40,40,39,38,39,41,39,39,39,39,38]]");
    
    $aBadanaProbka[7] = json_decode("[[0,0,0,0,19,18,17,22,19,22,22,15,19,20,24,10,17,19,20,21,20,12,13,20,22,18,23,23,21,24],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[3,4,4,5,1,1,1,1,1,1,1,1,1,1,1,2,1,1,1,1,1,2,2,16,16,1,16,1,1,1],"
            . "[7,19,26,25,439,390,396,455,467,470,376,375,436,429,502,311,479,397,427,419,395,269,256,471,468,322,492,553,532,410],"
            . "[7,7,9,8,5,17,33,43,45,45,46,46,47,46,46,49,47,44,45,45,43,46,47,45,46,46,45,45,45,45],[17,17,27,17,4,2,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[11,14,9,16,56,51,48,45,45,45,44,44,43,43,43,42,43,45,44,44,45,43,42,44,44,43,44,44,44,44]]");
    $aBadanaProbka[8] = json_decode("[[9,20,4,4,5,4,4,4,4,4,4,4,8,9,16,17,13,17,15,14,14,14,13,13,13,12,13,13,12,6],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[16,1,12,12,12,12,12,12,12,12,11,12,1,1,16,1,16,1,1,16,16,16,1,1,1,1,1,1,1,2],"
            . "[263,684,96,143,160,116,125,112,104,89,110,105,289,311,543,553,422,531,504,458,402,463,434,421,422,423,400,350,395,217],"
            . "[2,3,33,49,49,48,63,56,55,67,55,50,2,3,2,3,3,3,3,3,3,2,2,2,2,2,1,1,1,2],"
            . "[69,69,14,12,12,10,4,8,7,4,9,12,36,65,75,73,73,74,74,76,76,76,75,74,75,75,76,76,76,75],[5,6,4,4,4,5,3,3,3,2,2,2,5,4,6,6,6,6,5,5,5,5,5,5,5,5,5,4,4,4]]");
    $aBadanaProbka[9] = json_decode("[[6,6,3,5,4,6,5,5,5,6,7,5,5,2,4,4,5,5,4,4,4,4,4,4,5,4,3,3,4,5],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],"
            . "[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0],[9,9,9,9,9,8,10,10,10,11,11,11,10,9,11,12,11,12,12,10,10,10,10,11,10,10,10,10,9,9],[218,223,104,135,123,89,144,136,95,130,200,147,88,67,133,118,163,115,99,85,104,148,134,103,134,137,116,101,126,160],"
            . "[7,5,3,3,3,3,2,2,2,3,3,3,3,2,2,1,1,1,1,1,1,1,0,0,0,1,1,1,1,1],[43,44,45,45,49,46,50,49,52,55,54,47,49,45,45,50,44,42,40,45,50,43,42,39,37,37,36,41,42,43],"
            . "[5,5,5,5,4,3,2,2,2,2,3,3,4,3,2,3,3,3,3,2,3,5,7,9,10,10,10,7,7,7]]");
    $probeFrameStart = intval($_REQUEST['fpstart']);
    $probeFramesCount = 30;
    $badanaProbka = $_REQUEST['mFilmId'];
    var_dump_spec( "PROBKA (frames: $probeFrameStart+$probeFramesCount)" );
    
    $aProbkaXXX = array();
    
//    $aProbka = getProbka( $aBadanaProbka[$badanaProbka], $probeFrameStart, $probeFramesCount );
    
    $aProbkaXXX[0] = getProbka( $aBadanaProbka[0], $probeFrameStart, $probeFramesCount );
    $aProbkaXXX[1] = getProbka( $aBadanaProbka[1], $probeFrameStart, $probeFramesCount );
    $aProbkaXXX[2] = getProbka( $aBadanaProbka[2], $probeFrameStart, $probeFramesCount );
    $aProbkaXXX[3] = getProbka( $aBadanaProbka[3], $probeFrameStart, $probeFramesCount );
    $aProbkaXXX[4] = getProbka( $aBadanaProbka[4], $probeFrameStart, $probeFramesCount );
    $aProbkaXXX[5] = getProbka( $aBadanaProbka[5], $probeFrameStart, $probeFramesCount );
    $aProbkaXXX[6] = getProbka( $aBadanaProbka[6], $probeFrameStart, $probeFramesCount );
    $aProbkaXXX[7] = getProbka( $aBadanaProbka[7], $probeFrameStart, $probeFramesCount );
    $aProbkaXXX[8] = getProbka( $aBadanaProbka[8], $probeFrameStart, $probeFramesCount );
    $aProbkaXXX[9] = getProbka( $aBadanaProbka[9], $probeFrameStart, $probeFramesCount );
    
    
    var_dump( count($aFilmy[0]),count($aFilmy[1]),count($aFilmy[2]),count($aFilmy[3]),count($aFilmy[4]),count($aFilmy[5]),count($aFilmy[6]),count($aFilmy[7]),count($aFilmy[8]),count($aFilmy[9]) );
    var_dump( "<hr>", count($aBadanaProbka[0]),count($aBadanaProbka[1]),count($aBadanaProbka[2]),count($aBadanaProbka[3]),count($aBadanaProbka[4]),count($aBadanaProbka[5]),count($aBadanaProbka[6]),count($aBadanaProbka[7]),count($aBadanaProbka[8]),count($aBadanaProbka[9]) );
    
    
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
        $aFilmAsset["colorB"] = array_slice($aFilmy[$filmid][7], $frame_s, $frame_e);
        $aFilmAsset["colorG"] = array_slice($aFilmy[$filmid][8], $frame_s, $frame_e);
        $aFilmAsset["colorR"] = array_slice($aFilmy[$filmid][9], $frame_s, $frame_e);
        
       
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
            $aSliced = array_slice( $aFilmAsset["colorB"], $i, $probeFramesCount );
            $aFilmAsset['combos']["colorB"][] = $aSliced;
            $aSliced = array_slice( $aFilmAsset["colorG"], $i, $probeFramesCount );
            $aFilmAsset['combos']["colorG"][] = $aSliced;
            $aSliced = array_slice( $aFilmAsset["colorR"], $i, $probeFramesCount );
            $aFilmAsset['combos']["colorR"][] = $aSliced;
        }
        
        $aFilmyAsset[] = $aFilmAsset;
    }
    
    $sumaKlatekWybranych = 0;
    var_dump_spec( "Dane Filmow gotowe<hr/><hr/>" );
    
    $aZgodneSety = array();
    for ( $p=0; $p<=9; $p++ ){
    var_dump_spec( ":<hr/>Badana Probka $p:<hr/>" );
        $aZgodneSety = testFilmyProbka( $aProbkaXXX[$p], $aFilmyAsset, $probeFramesCount );
        var_dump_spec( $aZgodneSety );
    }
    
    
    
    
    
//    for ( $filmid=0; $filmid<=9; $filmid++){
//        $aCombos = $aFilmyAsset[$filmid]["combos"];
//        
//  
//        
        
//        $aX = getCorrectRangesQ($aCombos, $aProbka, $probeFramesCount, 1);
//        var_dump_spec( count($aX) );
//        $sumaKlatekWybranych += count($aX);
//        foreach ($aX as $key => $value) {
//            echo "$key,";
//        }
        
        
        
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
//    }
    
        
     
    
    
    
    exit;
    
    
//    var_dump_spec( $aHitCountsProp, true );
    
    echo json_encode( $aHitCountsProp, JSON_FORCE_OBJECT );
    
    
    function przetestujColory( $aProbka, $aFilmyAsset, $probeFramesCount ){
        $aZgodnosci = array();
        for ( $filmid=0; $filmid<=9; $filmid++){
            
            $aCombos = $aFilmyAsset[$filmid]["combos"];

            $aB = getCorrectRangesG($aCombos, $aProbka, $probeFramesCount, 10, 20, "colorB", $filmid);
            $aG = getCorrectRangesG($aCombos, $aProbka, $probeFramesCount, 10, 20, "colorG", $filmid);
            $aR = getCorrectRangesG($aCombos, $aProbka, $probeFramesCount, 10, 20, "colorR", $filmid);

            $aGR = array_intersect_key($aG, $aR);
            $aAll = $aGR;
//            $aAll = array_intersect_key($aBG, $aR);
//            foreach ($aAll as $key => $value) {
//                echo "$key,";
//            }

            $sumaKlatekWybranych += count($aAll);
            if ( count($aAll) ){
            var_dump_spec("PROBKA film $filmid:   B:" . count($aB) . "  G:". count($aG) . "  R:" . count($aR) . 
                    " => ALL:" . count($aAll ) );
            }

            $aZgodnosci[$filmid] = $aAll;
        }
        
        $sumaWszystkich = $filmid * 100;
        $prop = round((($sumaKlatekWybranych+30) / $sumaWszystkich) * 100, 2);
//        var_dump_spec("suma wybranych: $sumaKlatekWybranych suma wszystkich: $sumaWszystkich => $prop%");
        return $aZgodnosci;
    }
    
    function testFilmyProbka( $aProbka, $aFilmyAsset, $probeFramesCount ){
        $aZgodneKolory = przetestujColory($aProbka, $aFilmyAsset, $probeFramesCount);
        $aZgodneQ = przetestujQ($aProbka, $aFilmyAsset, $probeFramesCount);
    
        
        for ( $filmid=0; $filmid<=9; $filmid++ ){
            $aX = array_intersect_key($aZgodneKolory[$filmid], $aZgodneQ[$filmid]);
            if( count($aX) ){
                var_dump_spec("<hr>ZGODNOSC KOLOR + Q dl filmu: $filmid:" . count($aX) );
                foreach ($aX as $key => $value) {
                echo "$key,";
            }
            }
//            var_dump_spec($aX);
        }
//        var_dump_spec( $aZgodneKolory );
//        var_dump_spec( $aZgodneQ );
        
//        return $aAll;
    }
    
    
    function przetestujQ( $aProbka, $aFilmyAsset, $probeFramesCount ){
        $aZgodnosci = array();
        for ( $filmid=0; $filmid<=9; $filmid++){
            
            $aCombos = $aFilmyAsset[$filmid]["combos"];
            $aX = getCorrectRangesQ($aCombos, $aProbka, $probeFramesCount, 5, $filmid);
            if (count($aX) > 0 ){ var_dump_spec( "filmid: $filmid => ". count($aX) ); };
            $sumaKlatekWybranych += count($aX);
//            foreach ($aX as $key => $value) {
//                echo "$key,";
//            }
            $aZgodnosci[$filmid] = $aX;
        }
        return $aZgodnosci;
    }
    
    
    
     function getCorrectRangesQ( $aCombosFilm, $danezprobki, $probeFramesCount, $delta = 0, $filmid ){
        $aRangesCorrectCombos = array();  
        for ( $set=0; $set<count($aCombosFilm['q']); $set++){
            $aCombo = $aCombosFilm['q'][$set];
            $aBits = array();
            foreach( $aCombo AS $ii=>$kp ){
                
                
                
                
                $qdiff = abs( $kp - $danezprobki['q'][$ii] );
                if ( $qdiff <= 2 || $qdiff >= 14  ){
                    $aBits[$ii] = 1;
                }
                else{
                    if ( $aCombosFilm['qstr'][$set][$ii] < 100 ){
//                        if( $filmid == 4 ){
                            $difstr = abs($aCombosFilm['qstr'][$set][$ii] - $danezprobki['qstr'][$ii]);
                            if ( $difstr < 50 ){
                                $aBits[$ii] = 1;
                            }
//                            var_dump_spec( "filmid: $filmid => " . $aCombosFilm['qstr'][$set][$ii] . " ??? " . $danezprobki['qstr'][$ii] . " => " . $difstr );
//                        }
                    }
//                    
//                        
//                        if ( $difstr < 50 ){
//                            $aBits[$ii] = 1;
//                        }
////                        var_dump_spec( $aCombosFilm['qstr'][$set][$ii] . " ??? " . $danezprobki['qstr'][$ii] . " => " . $difstr );  
//                    }
//                    var_dump_spec( $aCombosFilm['qstr'][$set][$ii] . " ??? " . $danezprobki['qstr'][$ii] . " => " . $difstr );
                    
                }
            }
            
            if ( array_sum( $aBits ) >= $probeFramesCount - $delta  ){
                $aRangesCorrectCombos[$set] = 1;
            }
        }
        return $aRangesCorrectCombos;
    }
    
    
    
    
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
    
    
    
    
     function getCorrectRangesG( $aCombosFilm, $danezprobki, $probeFramesCount, $deltaBit = 0, $deltaColor = 10, $colorKey = "colorG", $filmid = 66 ){
//         var_dump_spec( $colorKey );
        $aRangesCorrectCombos = array();  
        for ( $set=0; $set<count($aCombosFilm[$colorKey]); $set++){
            $aCombo = $aCombosFilm[$colorKey][$set];
            $aBits = array();
            foreach( $aCombo AS $ii=>$val ){
//                $cdiff = abs( $val - $danezprobki[$colorKey][$ii] );
                if ( $colorKey == "colorB" && $filmid == 7 ){
//                        var_dump_spec( "set:$set ii:$ii " . $val . " ??? " . $danezprobki[$colorKey][$ii] . " => " . $cdiff . "($maxdifs2)" );
                }
                    
                    
                if ( $val >= 20 && $danezprobki[$colorKey][$ii] >= 30 ){
                    $aBits[$ii] = 1;
                }
                
                if ( $val < 20 && $danezprobki[$colorKey][$ii] < 30 ){
                    $aBits[$ii] = 1;
                }
                
//                if ( $cdiff <= $deltaColor ){
//                    $aBits[$ii] = 1;
//                }
//                else{
//                    $maxdifs2 = $danezprobki[$colorKey][$ii] / 2;
//                    if ( $cdiff <= $maxdifs2 ){
//                        $aBits[$ii] = 1;
//                    }
////                    $danezprobki[$colorKey][$ii] = $danezprobki[$colorKey][$ii] == 0 ? 1 : $danezprobki[$colorKey][$ii];
////                    $prop = $cdiff / $danezprobki[$colorKey][$ii];
//                    else{
//                    if ( $colorKey == "colorB" && $aBits[$ii]==0 )
//                        var_dump_spec( "set:$set ii:$ii " . $val . " ??? " . $danezprobki[$colorKey][$ii] . " => " . $cdiff . "($maxdifs2)" );
//                    }
//                }
            }
//            
//        var_dump_spec("set: $set => " . array_sum( $aBits ) );
            if ( $colorKey == "colorB" && $filmid == 7 ){
//                        var_dump_spec("set: $set => " . array_sum( $aBits ) );
            }
            if ( array_sum( $aBits ) >= $probeFramesCount - $deltaBit  ){
                $aRangesCorrectCombos[$set] = 1;
            }
        }
        if ( $colorKey == "colorB" && $filmid == 7 ){
//                        var_dump_spec($aRangesCorrectCombos );
            }
        return $aRangesCorrectCombos;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
