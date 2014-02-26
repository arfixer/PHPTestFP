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
    
    
    
    
    function getProbka( $aBadana, $frame_s, $frame_e ){
        $aProbka = array();
        $aProbka["kp"] = array_slice($aBadana[0], $frame_s, $frame_e);
        $aProbka["kpT"] = array_slice($aBadana[1], $frame_s, $frame_e);
        $aProbka["kpB"] = array_slice($aBadana[2], $frame_s, $frame_e);
        $aProbka["kpL"] = array_slice($aBadana[3], $frame_s, $frame_e);
        $aProbka["kpR"] = array_slice($aBadana[4], $frame_s, $frame_e);
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

    
    
    
    
    
    
    $time0 = time();
//    var_dump_spec
    
    
    #STEP 1
    # preapre oGlobaldatas contain mobile FP Data
    $aDatas = $_REQUEST['datas'];
    $aMobileFrames = array();
    $aInfoFilm0 = json_decode("[[35,35,35,35,35,35,33,32,30,28,28,28,28,27,28,29,28,28,29,29,31,34,38,39,41,41,40,39,37,37,36,33,31,31,30,28,27,29,28,24,23,38,37,35,34,33,34,34,35,36,37,38,37,36,35,35,36,36,37,34,33,34,34,37,37,39,39,38,38,39,38,37,35,32,31,29,27,24,24,22,21,21,20,20,19,17,16,16,15,15,16,18,20,21,20,19,18,19,18,15,17,19,20,20,20,20,19,20,19,20,19,19,20,16,13,11,9,8,8,8,8,8,8,8,8,9,9,8,8,11,14,15,14,14,12,11,13,10,10,9,10,10,8,9,9,9,10,10,11,18],[34,34,34,34,34,34,32,31,29,26,27,27,27,26,27,28,27,27,28,28,30,32,36,38,40,40,39,37,35,35,34,32,29,29,28,27,26,28,27,23,22,38,36,35,33,32,33,33,34,36,36,37,36,35,34,34,36,36,36,34,33,34,33,36,37,38,38,37,38,38,38,37,34,32,31,28,26,24,23,20,20,19,19,19,18,16,15,15,14,14,15,17,19,20,19,18,18,18,17,14,16,18,18,18,18,18,18,18,18,18,17,17,18,13,11,9,7,6,5,6,5,5,6,5,6,6,6,6,5,7,8,8,7,8,7,7,8,6,6,5,5,5,5,5,5,5,6,6,6,10],[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,1,1,1,1,2,2,2,2,2,1,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,2,2,2,2,1,2,1,2,2,2,2,3,3,2,2,2,2,2,3,3,3,3,2,3,3,2,3,4,6,6,7,6,5,4,5,4,4,4,5,4,3,4,4,4,4,4,4,8],[17,17,17,17,17,17,16,15,14,12,12,13,13,12,13,13,13,14,14,13,14,15,18,20,21,22,22,21,20,19,19,17,16,16,16,15,14,15,15,12,12,17,17,17,16,16,16,16,16,17,18,18,17,17,16,16,17,17,18,16,16,16,16,17,18,18,19,18,18,18,18,17,16,15,15,14,13,11,12,10,10,10,9,9,9,8,7,7,8,8,8,9,10,10,9,9,8,9,8,5,6,8,9,10,10,11,11,12,12,11,9,10,11,9,7,6,6,6,5,5,5,6,5,6,6,6,6,5,5,7,8,9,8,8,6,6,7,6,6,6,6,6,5,5,5,5,5,5,5,9],[18,18,18,18,18,18,17,17,16,15,15,15,15,15,15,16,15,15,15,16,17,19,20,20,20,19,18,17,17,18,17,16,15,15,14,13,13,14,13,12,11,21,20,19,17,17,18,18,18,19,20,20,19,19,19,18,19,19,19,18,17,18,18,20,20,21,20,20,20,21,20,20,19,17,17,15,14,13,12,11,11,11,11,11,11,9,9,8,8,7,8,8,10,11,10,10,10,10,10,10,11,11,11,10,10,9,8,8,8,9,10,10,9,7,6,4,3,2,2,3,3,3,3,3,3,3,3,3,4,4,6,6,6,6,6,5,6,5,3,3,4,4,3,4,4,4,5,5,5,9]]");
    
    $aInfoFilm1 = json_decode("[[6,6,6,6,6,6,6,7,9,10,12,14,17,25,27,29,33,34,39,34,30,30,31,31,28,30,32,32,35,35,39,37,37,35,33,30,29,28,27,26,26,26,9,10,10,9,9,9,10,10,8,6,7,9,10,10,11,12,12,19,18,18,16,12,10,7,7,7,6,6,6,6,6,7,8,7,7,9,9,10,13,19,21,23,24,27,26,24,24,24,26,31,34,35,36,37,39,40,41,42,42,42,42,39,36,34,34,35,34,34,35,37,36,36,34,33,31,30,33,33,35,34,34,32,29,24,19,14,19,26,27,29,30,29,28,26,26,27,26,29,29,29,29,35,41,40,42,42,42,41],[4,4,4,4,4,4,4,5,7,8,10,12,15,23,25,27,31,32,36,31,27,27,28,27,25,27,28,28,31,31,34,33,32,30,29,26,25,23,23,22,22,22,9,9,9,9,8,8,9,9,7,6,6,8,8,8,9,10,10,16,15,15,13,10,6,4,4,4,4,4,4,4,4,6,7,6,6,7,8,9,12,18,20,21,23,25,24,23,22,23,25,29,32,34,34,35,37,37,39,40,40,40,39,36,33,31,31,32,31,31,32,33,33,33,31,30,28,28,29,30,32,31,31,29,26,21,15,11,15,21,22,24,25,25,23,21,20,22,21,24,25,25,25,30,35,34,36,36,36,35],[2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,3,3,3,3,4,4,4,4,5,5,5,4,4,4,4,4,4,4,4,5,1,1,1,1,1,1,1,2,1,1,1,1,2,2,1,2,2,3,3,3,3,3,3,3,3,3,2,2,2,3,2,1,1,1,1,1,1,1,1,1,1,1,1,2,1,2,2,2,1,2,2,2,2,2,2,2,2,2,2,2,2,2,3,4,3,3,3,3,3,3,3,3,3,3,3,3,3,4,4,4,4,3,3,3,3,3,4,5,5,5,5,5,5,5,5,5,5,5,4,4,4,5,6,6,6,6,6,6],[3,3,3,3,3,3,3,3,6,7,8,10,13,19,20,21,23,24,26,22,18,19,20,20,19,22,23,22,24,24,27,25,25,23,22,19,19,17,17,16,16,16,3,3,4,3,4,4,4,4,4,3,4,4,5,4,5,7,8,10,9,9,8,6,5,3,4,4,3,4,4,4,3,3,4,4,3,4,6,6,8,13,15,17,18,20,19,18,18,18,18,21,23,24,24,24,25,25,25,26,26,26,25,24,22,20,21,22,22,22,23,24,23,23,22,20,18,18,19,20,20,20,20,20,19,16,12,10,14,19,19,21,21,21,20,19,19,20,19,20,21,19,19,22,26,26,27,27,27,26],[3,3,3,3,3,3,3,3,3,3,3,4,5,7,7,8,10,11,13,12,11,11,11,10,9,8,9,10,11,11,12,12,12,12,11,11,11,11,10,10,10,11,7,7,6,6,5,5,6,7,4,3,4,4,5,5,5,5,4,9,9,9,8,6,5,4,3,3,3,2,2,2,3,4,4,4,4,4,4,4,5,5,6,6,6,7,6,6,6,7,8,10,11,12,12,13,14,14,15,16,16,16,16,15,14,14,13,13,12,12,12,13,13,13,12,13,13,13,13,14,15,15,14,13,11,8,7,4,5,7,8,8,8,8,8,7,7,7,7,8,8,9,11,13,14,14,15,15,15,15]]");
    
    $aInfoFilm2 = json_decode("[[8,8,8,7,7,6,4,3,2,2,2,2,2,3,3,5,6,7,10,10,7,9,11,7,4,2,2,1,1,1,1,1,1,1,1,2,3,2,2,2,1,2,2,2,2,1,1,1,2,2,2,1,1,1,1,1,2,2,2,2,9,9,9,8,8,8,9,9,10,10,10,9,7,4,3,4,4,7,8,8,8,8,8,8,9,8,8,8,8,8,8,9,9,8,3,3,3,4,9,10,9,9,10,11,9,8,8,9,10,11,13,13,15,13,10,14,17,11,3,3,4,3,3,3,3,3,2,2,3,2,2,3,3,4,4,6,6,5,5,5,6,6,6,6,6,9,8,7,6,8],[8,7,7,7,7,6,4,2,2,2,1,2,2,2,2,4,4,5,7,7,5,7,8,5,2,2,1,1,1,0,0,1,1,1,1,2,2,2,1,2,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,8,7,7,7,7,7,8,8,8,9,8,8,6,4,3,3,4,6,7,7,8,8,8,8,8,8,8,8,8,8,8,8,8,7,3,3,3,4,8,9,8,8,9,10,8,7,7,7,9,9,11,11,11,9,6,9,9,7,2,1,2,1,1,2,1,1,1,1,1,1,1,1,2,2,2,4,3,3,3,3,3,3,4,4,3,6,5,5,4,6],[1,1,1,1,0,0,0,0,0,0,0,1,1,1,1,2,2,2,3,3,2,2,2,2,1,1,0,0,0,0,0,0,0,0,0,0,1,0,1,0,0,1,1,1,1,1,1,1,1,1,1,1,0,1,0,0,1,1,1,0,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,1,1,1,1,0,1,0,1,1,1,1,1,1,1,1,1,1,1,2,2,2,2,4,4,4,5,8,5,2,2,2,2,1,1,1,2,1,1,2,1,2,2,1,2,2,3,3,2,2,2,2,3,2,3,3,3,2,2,2,2],[5,5,5,4,4,3,2,2,1,1,1,1,1,1,1,2,3,3,5,5,3,5,6,3,1,1,1,1,1,0,0,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,1,1,4,4,4,4,4,4,5,4,5,5,5,4,4,2,2,2,3,4,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,4,2,2,2,2,5,5,5,5,6,6,4,3,4,5,7,7,8,9,9,8,5,9,12,6,2,2,3,2,2,2,2,2,1,1,2,1,1,2,2,2,2,4,3,2,2,2,2,2,3,3,3,4,3,3,3,4],[3,3,3,3,3,3,2,1,1,1,1,1,1,2,2,3,3,4,5,5,5,5,4,4,2,1,1,0,0,0,0,0,1,1,1,1,1,1,1,1,0,0,0,0,0,0,0,1,1,1,1,1,1,1,1,1,1,1,1,1,5,4,4,4,5,5,5,5,5,5,5,5,4,2,1,2,1,2,3,3,3,3,3,3,3,3,3,3,3,3,4,4,4,3,1,1,1,2,4,4,4,4,4,5,5,5,4,4,4,4,4,5,5,5,4,5,5,5,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,1,3,3,2,3,3,4,3,3,3,3,5,4,4,3,4]]");
    
    
    $aInfoFilm3 = json_decode("[[0,13,13,12,12,12,11,11,11,10,10,10,10,10,10,10,9,9,9,9,8,8,7,7,8,9,9,9,8,8,7,6,6,6,6,5,6,6,6,6,7,7,7,7,6,6,6,6,5,5,5,5,5,4,9,10,10,10,10,10,10,9,9,8,8,7,7,8,7,8,10,9,8,9,9,10,10,11,10,10,10,10,11,10,9,8,7,7,7,7,6,7,7,5,5,6,6,6,7,10,11,10,12,13,14,13,13,13,13,12,11,12,11,11,11,10,10,9,9,10,10,10,10,10,10,11,11,11,11,11,10,10,10,10,10,11,11,11,12,12,12,12,12,12,13,13,13,13,14,14],[0,9,9,8,8,8,8,8,8,7,7,7,7,7,7,7,6,6,6,6,6,6,5,5,5,7,6,5,5,5,4,3,3,3,3,3,4,4,4,4,5,5,5,5,4,4,4,4,4,4,4,4,4,3,7,7,8,8,8,9,9,8,8,7,7,7,6,6,5,5,8,6,6,6,6,7,7,7,7,7,7,7,8,7,6,5,5,5,5,4,4,4,5,3,3,4,4,4,5,7,8,8,9,9,10,9,9,9,9,9,9,9,8,9,8,8,8,7,8,8,8,8,7,7,7,8,8,7,8,7,7,6,7,6,7,7,8,8,8,9,9,9,9,9,9,9,9,9,10,10],[0,4,4,4,4,4,4,3,3,3,3,3,3,3,3,3,3,3,2,3,2,2,2,2,2,2,3,3,4,3,3,3,3,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,1,1,1,1,1,1,2,2,3,2,1,1,1,1,1,1,1,1,2,2,2,2,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,2,3,3,2,3,2,1,2,2,2,2,2,3,3,3,4,4,4,4,4,4,4,3,3,3,3,3,3,2,2,2,2,2,2,2,2,3,3,3,3,4,4,4,3,3,3,3,3,3,4,3,4,3,3,3,3,3,4,4,4,4,4,4],[0,8,8,7,7,7,7,7,7,7,7,7,7,7,7,6,6,6,6,6,6,6,6,6,6,7,6,6,6,6,5,5,5,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,3,6,7,7,7,6,7,7,6,6,5,5,4,5,6,5,6,7,6,6,6,7,8,8,8,7,7,7,7,7,7,6,6,5,5,5,5,5,6,6,4,4,4,4,3,4,6,6,6,8,7,8,8,8,8,8,8,6,6,6,6,6,6,6,5,5,6,6,6,6,6,6,6,6,6,6,6,5,5,6,6,7,7,7,8,8,8,8,8,9,8,9,9,9,9,9,9],[0,5,5,5,5,4,4,4,4,4,4,4,3,3,3,3,3,3,2,3,2,2,2,2,2,2,2,3,3,2,2,1,1,1,1,1,2,2,2,2,2,2,2,2,2,2,2,2,2,1,1,1,2,1,3,3,3,3,3,3,3,3,3,3,3,3,2,2,2,2,3,3,2,2,2,3,3,3,3,3,3,3,3,3,3,2,2,2,2,2,1,1,2,1,1,1,2,3,3,4,4,4,5,5,5,5,5,5,5,4,5,5,5,5,5,5,4,4,4,4,4,4,4,4,4,5,5,5,5,5,5,4,4,3,3,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4]]");
                              
    $aInfoFilm4 = json_decode("[[15,14,13,13,13,14,14,13,13,14,11,10,8,8,11,12,12,11,11,11,11,9,7,7,7,6,6,6,5,4,4,4,4,4,4,4,4,4,4,5,4,4,4,4,4,4,4,5,5,5,5,5,6,6,5,5,5,5,5,6,5,5,5,4,4,4,4,4,5,5,5,5,4,5,2,2,2,2,4,8,9,8,8,8,8,8,8,8,8,8,8,9,8,8,9,8,8,7,7,6,6,6,5,5,5,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,6,8,8,9,9,9,10,10,9,9,9,8,8,9,9,9,8,8,8,5,4,3,3,2,2,3,2,2,3,3],[10,10,9,8,7,8,8,7,7,8,6,6,4,3,5,6,7,7,7,6,7,6,4,5,4,4,4,4,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,3,3,3,3,2,3,3,3,3,3,3,2,2,2,2,2,2,2,2,2,2,2,0,0,0,0,1,1,1,1,1,1,1,2,2,2,2,1,1,1,1,1,1,1,1,1,1,1,3,4,3,3,3,1,1,1,1,1,1,1,1,1,1,2,1,1,1,1,4,6,7,7,7,7,7,7,6,6,7,6,6,6,7,7,6,6,6,4,2,1,1,1,1,1,1,1,1,1],[5,5,4,5,6,6,6,5,6,6,5,5,4,5,6,6,5,5,5,4,4,3,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,2,2,2,2,2,2,2,3,3,3,2,3,3,3,3,2,3,3,3,3,3,2,2,2,2,2,2,2,3,2,2,3,2,2,2,2,3,7,7,7,7,7,7,6,6,6,6,7,7,8,7,7,7,7,6,6,6,5,4,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,1,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,1,2,2],[9,8,8,8,8,9,9,8,9,9,7,7,5,6,9,9,9,8,7,7,7,4,3,3,3,2,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,2,2,3,2,2,2,2,2,3,3,3,3,3,2,2,2,2,2,1,2,2,2,2,3,2,1,1,1,3,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,3,3,3,3,3,3,3,2,2,2,2,2,1,1,1,1,1,1,1,1,1,2,4,5,5,5,5,5,5,5,5,5,4,3,3,3,3,3,3,2,2,2,2,2,2,1,2,2,2,2,2,2],[6,6,5,5,5,5,5,4,5,5,4,3,3,2,3,3,3,3,4,4,4,5,4,4,4,3,3,3,3,2,2,3,3,2,3,2,3,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,3,3,3,3,3,3,3,3,3,3,2,2,2,2,3,3,3,3,3,2,2,2,0,0,1,1,1,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,3,3,3,3,2,2,2,1,1,1,1,1,1,1,1,2,1,2,2,2,2,2,2,3,3,4,4,4,5,4,4,4,5,5,5,5,5,6,6,6,5,3,2,1,1,1,1,1,1,0,1,1]]");
    
    $aInfoFilm5 = json_decode("[[4,3,3,3,3,56,57,59,60,61,62,62,62,62,62,63,63,64,64,64,65,65,64,65,65,65,65,66,65,65,66,66,67,67,67,67,66,67,66,67,67,66,66,66,66,67,67,66,66,66,67,67,67,68,67,67,67,61,59,58,61,63,65,66,67,67,65,61,60,61,63,64,64,63,63,63,66,68,69,69,68,68,68,68,68,64,62,62,62,63,63,65,67,68,68,3,2,3,3,3,4,3,3,4,4,4,3,3,5,4,4,2,2,3,53,53,52,52,52,52,52,52,52,52,52,52,51,51,51,51,51,50,50,50,50,50,50,50,50,49,47,45,40,33,26,22,27,31,35,48],[2,1,1,2,2,54,55,57,58,59,60,60,60,60,60,61,61,62,62,62,63,63,62,63,63,63,63,63,63,63,64,64,64,64,64,64,64,64,64,64,64,64,64,64,64,64,64,64,64,64,65,65,65,65,65,65,65,59,57,56,59,60,62,64,65,65,62,59,58,59,60,61,61,60,60,60,63,65,66,66,66,66,66,65,65,62,60,59,60,60,61,62,65,65,66,1,1,1,1,2,2,1,2,2,2,2,1,1,2,2,2,1,1,1,50,50,50,49,49,50,50,50,50,50,50,50,49,49,49,49,49,48,48,48,48,48,48,47,48,46,45,43,38,31,24,20,25,29,33,45],[2,1,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,2,2,2,2,2,2,2,2,2,2,2,2,2,3,3,3,2,2,2,2,2,2,2,3,3,3,3,3,3,3,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,1,1,1,2,2,2,2,2,2,2,2,2,2,4,3,2,1,1,2,3,3,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3],[2,2,2,2,2,30,31,32,32,33,33,33,33,33,33,34,34,34,34,34,35,35,35,35,35,35,35,35,35,35,35,36,36,36,36,36,36,36,36,36,36,36,36,36,36,36,36,35,36,35,36,36,36,36,36,36,36,33,32,32,34,35,36,36,37,37,35,33,33,33,34,35,34,34,34,34,36,37,37,37,36,36,36,36,36,34,33,32,33,33,33,34,35,35,36,1,1,1,2,2,3,2,2,2,2,2,1,2,2,2,2,1,1,2,28,28,28,27,27,27,27,28,28,28,28,28,27,27,27,27,27,26,27,26,27,27,27,26,26,26,25,23,21,17,13,10,11,12,13,18],[2,1,1,2,1,26,26,28,28,29,29,30,29,29,29,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,30,31,31,31,31,31,31,31,30,31,31,31,31,31,31,31,31,30,30,31,31,31,32,32,32,31,31,28,27,26,28,28,29,30,30,30,29,28,28,28,29,29,30,29,29,29,31,31,32,32,32,32,32,32,32,30,30,30,30,30,30,31,32,32,33,1,1,1,1,1,1,1,1,2,1,2,1,1,3,2,2,1,1,2,25,25,25,25,24,24,24,24,24,24,24,24,24,24,24,24,24,24,24,23,23,23,23,23,24,23,22,21,19,16,13,12,16,19,22,30]]");
    
    $aInfoFilm6 = json_decode("[[3,3,3,3,2,2,2,2,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,2,2,2,2,2,2,2,3,3,3,3,3,2,3,3,3,3,3,3,3,3,2,3,3,3,2,2,2,2,2,2,2,2,3,3,3,3,3,3,2,2,2,2,2,3,3,3,3,3,4,4,4,4,4,5,4,4,3,4,4,3,3,4,4,4,4,3,4,4,4,4,4,3,4,4,4,3,3,3,4,4,3,3,4,4,4,4,4,4,4,4,3,3,4,4,4,4,3,3,3,4,3,3,3,3,4,4,4,3,4,3,3,3,4,4,4,3],[2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,2,2,2,2,2,3,3,3,3,3,2,2,2,3,2,2,2,2,2,2,2,2,2,3,3,3,3,3,2,2,2,2,2,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],[0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,1,1,2,2,3,2,3,3,3,4,3,3,2,3,3,2,2,2,3,3,2,2,3,3,3,3,2,2,2,3,3,2,2,2,2,2,2,2,3,3,3,3,3,3,3,3,2,2,3,3,3,2,2,2,2,3,2,2,2,2,3,3,3,2,2,2,2,2,2,3,3,2],[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,2,2,2,2,2,2,2,2,1,2,2,1,1,2,2,2,2,2,2,2,2,2,2,2,2,2,2,1,1,1,2,1,1,2,2,2,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1],[1,1,2,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,1,1,1,1,1,1,1,1,2,1,2,2,2,2,2,2,2,1,1,1,1,2,1,1,1,2,2,2,2,2,3,3,2,2,2,2,2,2,2,2,2,3,2,2,2,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,3,2,3,3,3,3,2,2,3,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,2,3,2]]");
    
    $aInfoFilm7 = json_decode("[[1,1,0,0,0,29,27,27,28,29,29,29,30,30,31,31,31,31,30,30,29,29,28,27,28,29,30,31,31,30,30,30,30,30,29,29,29,29,29,30,30,27,25,24,26,29,30,31,32,32,32,32,31,30,29,29,30,30,29,28,29,30,31,29,29,30,30,30,29,29,28,29,30,30,30,30,31,31,32,32,33,33,33,33,33,34,34,34,33,34,32,32,33,32,32,32,32,32,32,32,1,1,1,1,1,34,34,34,33,32,31,31,30,25,22,23,24,28,29,31,30,31,31,30,27,26,24,22,22,23,27,28,30,30,31,31,32,32,32,32,32,33,33,33,33,34,34,34,34,34],[0,0,0,0,0,22,20,20,21,22,22,22,22,22,23,23,23,23,22,22,22,21,21,20,21,21,23,23,23,22,22,23,22,22,22,22,21,22,22,22,23,20,19,18,20,22,22,23,23,24,24,23,22,22,21,22,22,22,22,21,21,22,22,22,22,22,23,23,22,21,21,22,22,22,22,22,23,23,24,24,24,25,25,25,25,25,25,25,25,25,24,24,25,25,25,24,24,24,24,24,0,0,0,0,0,24,24,24,24,23,22,22,22,18,16,16,16,20,20,22,21,21,22,21,19,18,17,16,15,16,19,20,21,22,22,23,23,23,23,23,23,23,24,24,24,24,24,24,24,24],[0,0,0,0,0,8,7,7,7,8,8,8,8,8,8,8,8,8,8,8,8,7,7,7,7,7,8,8,8,8,8,8,8,8,7,7,7,7,7,8,8,7,6,6,7,8,8,8,8,9,8,8,8,8,8,8,8,8,8,7,8,8,8,7,8,8,8,8,7,8,7,8,8,8,8,8,8,8,8,8,8,8,8,8,8,9,9,8,8,8,8,8,8,8,8,8,8,8,8,8,1,1,1,1,1,10,10,10,9,9,9,9,9,7,7,7,7,8,9,9,9,9,9,9,8,7,7,6,6,7,8,8,8,9,9,9,9,9,9,9,9,9,9,9,9,10,9,9,10,10],[0,0,0,0,0,14,13,13,13,14,14,14,14,14,14,14,15,15,14,14,14,14,14,13,14,14,15,16,16,15,15,16,15,15,15,15,14,15,15,15,16,14,13,13,15,17,17,18,18,19,18,18,17,17,16,16,16,16,16,15,16,16,16,16,16,16,16,16,15,15,15,15,16,15,15,15,16,16,16,17,17,17,17,17,17,17,17,17,18,18,17,17,17,17,17,17,17,17,17,17,1,1,1,1,1,18,18,18,18,17,17,16,16,14,12,13,14,17,17,19,18,18,18,17,16,15,13,12,11,12,14,14,15,15,15,16,16,16,16,16,16,17,17,17,17,17,17,17,17,17],[1,1,0,0,0,15,14,14,15,15,15,16,16,16,16,16,16,17,16,16,16,15,15,14,14,14,15,15,16,15,15,15,15,15,15,14,14,14,14,14,14,13,12,11,12,12,13,13,13,14,14,13,13,13,13,13,14,14,13,13,13,14,14,14,14,14,14,14,14,14,13,14,15,14,14,15,15,15,16,16,16,16,16,16,16,16,16,16,16,16,15,15,16,16,15,15,15,15,15,15,1,1,0,0,0,16,16,16,16,15,15,14,14,12,10,10,10,11,12,12,12,12,13,13,12,11,11,10,10,11,13,14,14,15,15,16,16,16,16,16,16,16,16,16,16,17,17,17,17,17]]");
                              
    $aInfoFilm8 = json_decode("[[31,30,29,5,6,6,5,5,6,5,5,5,5,24,24,24,23,23,23,23,22,20,20,20,20,20,20,19,19,18,18,18,17,18,18,18,18,18,19,19,19,18,15,12,11,11,13,13,13,12,13,13,14,18,18,19,21,22,22,24,24,26,27,28,27,28,29,29,28,28,27,27,26,26,26,24,24,22,22,21,20,20,19,18,19,19,20,20,20,19,20,21,21,21,22,22,22,22,22,20,22,21,20,20,20,20,21,22,22,22,23,22,23,23,23,23,23,22,22,23,24,23,23,23,21,22,21,22,21,21,22,20,20,20,20,19,19,18,18,19,19,20,22,23,22,23,24,24,23,23],[25,25,24,2,2,2,2,2,2,2,1,1,1,20,20,19,19,18,18,19,18,16,16,15,16,15,15,14,14,14,14,13,13,13,14,13,13,13,13,14,14,13,10,8,7,8,9,10,10,9,9,10,11,15,15,16,18,19,19,20,21,23,24,24,24,24,26,26,25,24,24,24,23,23,23,21,21,19,18,17,17,17,16,15,15,15,16,16,16,15,16,17,17,18,18,18,18,18,18,16,18,17,17,16,16,16,17,18,18,18,19,18,18,18,18,19,18,18,17,18,19,19,19,18,17,17,16,17,16,17,17,15,15,15,15,14,14,13,13,13,14,15,17,17,16,17,18,18,17,16],[5,5,5,3,4,4,4,4,4,4,3,4,4,4,4,5,5,4,5,5,4,4,4,4,4,4,4,4,4,4,5,5,5,5,5,5,5,5,5,5,5,5,5,4,4,4,4,4,4,3,3,3,3,3,3,3,3,3,3,3,3,3,3,4,4,4,4,3,3,3,3,3,3,3,3,3,3,3,3,3,3,3,4,4,3,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,4,5,5,4,4,4,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,5,6,6,6,6,6,6,6,7,6],[15,15,15,4,4,4,4,4,4,4,4,4,4,13,13,13,12,12,12,12,12,11,10,10,10,10,9,9,9,9,8,8,8,8,8,8,9,9,10,10,10,10,9,8,7,7,8,8,8,7,7,8,8,9,10,10,11,12,12,13,13,14,14,15,14,15,15,15,15,14,14,14,13,13,13,12,12,11,10,10,10,9,9,8,9,9,9,10,10,10,10,10,11,11,11,11,11,11,11,10,11,10,10,10,11,11,11,12,12,12,12,12,12,12,12,12,11,11,11,11,12,11,11,11,11,11,11,11,11,10,10,9,9,9,9,9,9,9,9,9,10,11,12,13,13,13,14,14,13,13],[15,15,14,1,2,1,1,1,2,2,1,1,1,12,11,11,11,10,10,11,10,10,10,10,10,10,11,10,10,10,10,10,10,10,10,10,9,9,9,9,8,7,5,4,4,4,5,5,5,5,5,5,6,9,9,9,10,10,10,11,11,12,13,13,13,14,14,14,14,14,14,13,14,13,13,13,12,11,11,11,11,11,10,10,10,10,10,10,10,10,10,11,10,10,10,11,11,11,11,10,11,11,10,10,10,9,10,10,10,10,11,10,11,11,11,11,11,11,11,12,12,12,12,11,11,11,11,11,11,11,12,11,11,11,11,10,10,10,9,9,10,10,10,10,10,10,10,10,10,10]]");
    $aInfoFilm9 = json_decode("[[6,6,5,5,5,5,5,5,5,4,5,5,5,5,5,5,4,5,5,5,4,4,4,4,5,4,4,4,5,5,5,5,6,8,8,8,8,7,6,6,6,6,5,5,5,4,4,3,3,3,3,3,4,3,4,14,11,10,10,10,9,9,8,8,8,8,8,8,8,7,5,3,3,3,3,3,3,3,4,5,5,5,5,5,5,5,6,6,5,4,5,5,5,5,5,33,33,32,32,34,34,34,33,33,32,30,28,27,24,23,23,21,21,20,18,13,11,11,12,10,10,9,10,12,11,13,13,12,13,11,12,12,10,10,8,7,8,7,8,10,8,9,8,8,9,8,10,10,9,13],[1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,2,2,2,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,1,1,1,1,0,1,1,1,1,1,1,7,5,5,4,4,3,3,3,2,2,2,2,1,1,1,1,1,1,1,1,0,0,1,1,1,2,2,2,2,2,3,3,3,2,1,2,2,2,2,2,26,26,25,25,25,25,25,25,24,23,22,21,21,18,17,16,15,15,14,12,8,7,7,7,6,6,6,6,7,6,7,7,7,7,7,7,7,5,6,5,5,5,5,6,7,5,6,5,5,5,5,6,6,6,5],[5,5,5,4,4,4,4,4,4,3,4,4,4,4,3,3,3,3,3,3,3,3,3,3,4,3,3,3,4,4,5,5,6,7,7,8,7,6,5,5,5,5,5,4,4,3,3,3,3,3,2,3,3,3,3,7,6,6,6,6,6,6,6,6,6,6,6,7,7,6,4,2,2,3,3,3,3,3,3,4,4,3,3,3,3,3,3,3,2,2,3,3,3,3,3,7,7,7,7,9,8,9,9,9,8,8,7,7,7,6,6,6,6,6,5,5,4,4,5,4,4,4,4,5,5,6,6,5,5,5,5,5,4,4,3,2,3,2,3,4,3,3,3,4,4,3,4,4,3,8],[4,4,3,3,3,3,3,3,3,2,3,3,3,4,3,3,3,3,3,3,3,2,3,3,3,3,3,3,3,3,3,3,3,4,4,4,4,3,3,3,3,3,3,3,3,2,2,1,1,1,1,2,2,2,3,6,4,4,3,4,3,4,3,3,3,3,3,3,3,3,2,2,2,2,2,2,2,2,3,4,4,4,4,4,4,4,4,4,3,2,4,3,3,4,4,17,16,16,16,17,17,17,17,17,16,15,14,14,13,12,12,12,12,12,11,8,7,7,7,6,6,5,5,6,5,6,6,7,6,6,6,6,5,5,5,4,4,4,5,5,4,4,4,5,5,4,5,5,5,7],[2,2,2,2,2,2,2,2,2,2,2,2,1,2,1,2,1,1,1,2,1,2,2,2,2,2,1,2,2,2,2,2,3,4,4,4,4,3,3,3,3,2,2,2,2,2,2,2,2,2,2,2,2,2,1,8,7,7,6,6,6,5,5,5,5,5,5,5,5,4,3,1,1,1,1,1,1,1,1,1,1,1,1,1,1,2,2,3,2,1,1,1,1,1,1,16,16,16,16,17,17,17,17,17,16,15,14,13,12,11,11,10,9,8,7,4,4,4,4,4,4,4,5,6,6,7,7,5,7,6,6,6,4,5,4,3,4,3,4,5,4,5,4,4,4,4,5,5,4,6]]");
    
    $aFilmy = array();
    $aFilmy[] = $aInfoFilm0;
    $aFilmy[] = $aInfoFilm1;
    $aFilmy[] = $aInfoFilm2;
    $aFilmy[] = $aInfoFilm3;
    $aFilmy[] = $aInfoFilm4;
    $aFilmy[] = $aInfoFilm5;
    $aFilmy[] = $aInfoFilm6;
    $aFilmy[] = $aInfoFilm7;
    $aFilmy[] = $aInfoFilm8;
    $aFilmy[] = $aInfoFilm9;
    
    
    $aBadanaProbka[0] = json_decode("[[37,38,36,31,33,33,29,32,29,25,27,15,21,29,37,41,47,50,55,53,54,53,51,52,52,50,53,46,44,44,45,45,43,45,46,42,45,38,42,43,42,43,39,41,41,40,44,44,43,41,43,37,37,38,29,41,45,45,51,53,54,49,50,36,55,53,53,52,57,54,63,66,65,69,68,72,71,68,69,74,65,34,51,44,46,41,39,39,42,33,40,42,43,42,35,36,36,38,32,34],[33,33,31,28,29,29,27,31,27,24,26,15,19,24,31,34,40,43,45,45,47,47,45,45,45,43,46,41,42,43,43,42,41,43,43,40,43,36,40,41,40,42,37,40,40,39,42,43,42,40,41,36,36,36,26,37,38,37,40,42,42,39,40,26,41,38,34,30,31,26,29,32,33,37,36,44,42,37,38,40,33,18,33,27,27,26,25,24,26,19,24,22,22,23,22,21,21,23,16,19],[4,5,5,3,4,3,2,1,1,1,1,1,2,5,6,7,7,7,10,8,7,6,6,6,6,6,7,4,2,1,2,2,1,2,2,2,2,1,2,2,2,2,1,1,2,1,2,1,2,1,1,1,1,2,2,3,6,8,11,11,12,10,10,10,14,15,18,22,26,28,34,34,32,32,32,28,29,31,32,34,32,16,18,18,19,15,15,15,17,14,15,21,21,19,13,15,15,15,16,14],[15,15,14,12,14,15,13,15,13,12,11,7,10,12,14,16,19,23,25,24,24,27,25,25,23,19,22,20,19,18,19,18,18,20,21,19,20,16,19,21,20,21,17,17,18,18,19,20,19,18,18,16,18,19,14,21,23,23,21,24,24,22,26,17,26,26,23,22,28,30,26,27,29,34,36,40,36,27,26,32,33,11,21,16,16,13,14,12,14,9,12,17,17,19,15,16,15,18,18,14],[23,23,22,18,19,18,16,17,15,13,15,9,11,17,22,25,28,27,30,29,29,26,26,26,28,30,31,26,25,26,26,26,24,25,25,23,25,22,23,22,21,22,22,24,23,23,25,24,24,24,25,22,19,19,15,20,21,22,29,30,30,27,24,19,29,27,30,30,29,24,37,39,36,35,32,32,35,41,43,42,32,23,31,28,30,28,25,27,29,24,28,26,26,23,20,20,22,20,14,19],[8,9,11,12,13,11,8,8,11,11,10,13,11,15,15,17,14,14,15,17,13,16,13,13,17,15,18,17,22,15,17,15,12,13,13,13,10,9,15,14,10,14,12,13,13,18,9,11,11,14,14,13,15,15,14,15,13,13,15,15,12,13,12,16,13,14,15,15,13,13,16,13,12,10,10,10,11,16,9,13,14,13,15,14,13,10,12,11,10,14,8,32,33,29,27,25,26,27,32,27]]");
    
    $aBadanaProbka[1] = json_decode("[[11,11,15,11,22,34,32,38,44,46,51,53,56,56,54,50,51,53,42,58,58,59,59,60,60,55,50,50,37,9,11,13,13,16,18,19,26,27,17,29,33,30,40,15,15,12,9,8,12,12,10,7,6,7,10,19,22,16,25,34,46,44,46,46,45,46,45,36,47,49,51,51,52,51,51,50,47,46,42,39,39,40,41,39,41,40,40,42,43,43,43,41,34,36,36,38,43,46,47,47],[6,6,10,7,15,23,26,31,36,39,43,45,48,45,43,40,40,40,33,43,43,45,44,45,46,43,39,39,28,4,9,10,10,13,16,16,19,21,14,26,29,26,34,11,12,9,5,3,5,5,4,4,2,3,8,15,15,13,23,31,41,38,40,40,38,38,37,30,38,37,38,39,40,38,38,37,35,35,31,28,28,29,29,28,29,29,29,31,32,32,32,33,28,28,28,29,31,33,34,34],[5,5,5,4,8,10,7,7,7,7,7,8,8,11,10,10,11,13,9,15,15,14,15,15,14,12,11,11,9,5,2,3,3,2,2,3,7,6,2,3,3,4,6,4,3,4,5,5,7,8,6,3,4,4,2,4,8,4,2,4,5,6,6,6,7,8,7,7,9,12,12,12,13,13,13,13,13,12,10,11,11,12,11,12,12,10,11,12,11,11,11,8,6,8,8,9,12,13,12,13],[3,4,7,5,10,16,14,17,20,22,25,25,27,24,24,23,22,23,17,24,24,24,26,28,28,25,23,22,15,4,4,7,4,9,7,8,11,9,7,12,15,12,19,6,6,5,3,2,4,4,6,4,1,2,4,7,7,6,10,14,18,16,17,17,17,18,17,14,19,20,21,20,19,18,17,18,17,18,14,13,13,13,13,12,13,14,14,15,14,15,15,15,12,11,10,11,13,13,14,14],[8,7,8,6,12,18,19,21,23,24,26,28,29,32,30,27,29,30,25,34,34,34,34,33,31,30,27,28,23,6,7,5,9,7,11,11,15,17,10,17,18,18,21,10,9,7,6,6,8,8,4,3,5,5,6,12,15,10,15,20,28,28,29,29,28,28,27,22,28,29,30,32,33,34,34,32,30,29,28,26,26,27,28,27,28,26,26,28,29,28,27,26,22,25,26,28,31,33,33,33],[8,8,9,13,9,6,7,8,11,7,10,11,12,12,11,13,12,12,11,12,11,13,13,12,11,13,11,11,11,14,18,12,9,12,18,16,14,11,12,14,14,14,14,7,7,6,5,10,8,7,8,7,7,7,11,12,10,10,11,11,11,10,12,10,9,11,11,9,12,12,12,14,14,10,5,13,13,14,13,9,10,8,9,14,16,12,11,11,10,12,13,14,15,13,10,12,10,12,12,11]]");
    
//    var_dump_spec( $aBadanaProbka );
    $probeFrameStart = intval($_REQUEST['fpstart']);
    $probeFramesCount = 12;
//    var_dump_spec( "PROBKA (frames: $probeFrameStart-$probeFramesCount)" );
    $aProbka = getProbka( $aBadanaProbka[1], $probeFrameStart, $probeFramesCount );
//    var_dump_spec( $aProbka );
    
    $sumaKlatekWybranych = 0;
    for( $filmid=0; $filmid<=9; $filmid++ ){
        var_dump_spec( "PROBKA film $filmid: " );
//        testFilmRanges( $aFilmy[$filmid][0], $aProbka, $probeFramesCount );
        $aRanges = testFilmRanges2( $aFilmy[$filmid], $aProbka, $probeFramesCount, $filmid );
    
        var_dump_spec($aRanges);
        foreach( $aRanges AS $aA ){
                $sumaKlatekWybranych += ($aA['k'] - $aA['s']);
        }
    }
    
    $sumaWszystkich = $filmid * 150;
    $prop = round(($sumaKlatekWybranych / $sumaWszystkich) * 100, 2);
    var_dump_spec("suma wybranych: $sumaKlatekWybranych suma wszystkich: $sumaWszystkich => $prop%");
    
    
    
    exit;
    foreach ( $aDatas AS $m_frame_id=>$sString){
        
        $aInfo = json_decode($sString);
        
//        var_dump_spec( $sString );
//        var_dump_spec( $aInfo );
        $vfakedall = $aInfo[0];
        $vfakedcenter = $aInfo[1];
        
//        $oFP = new FrameFingerprintMarcin( $aInfo[0], $aInfo[1], $aInfo[2], $aInfo[3], $aInfo[8], $aInfo[9] );
//        $oFP->setColors( array("b"=>$aInfo[4],"g"=>$aInfo[5],"r"=>$aInfo[6]));
//        
        $oFP = new FrameFingerprintMarcin();
        $oFP->pt = new Cords($vfakedall[0][0], $vfakedall[0][1]);
        $oFP->cwiartka = $vfakedall[1];
        $oFP->dlugosc = $vfakedall[2];
        $oFP->ptC = new Cords($vfakedcenter[0][0], $vfakedcenter[0][1]);
        $oFP->cwiartkaC = $vfakedcenter[1];
        $oFP->dlugoscC = $vfakedcenter[2];
//
        $oFP->sumaKP = $aInfo[2];
        $oFP->grayVector = $aInfo[7];
        $oFP->grayCwiartka = $aInfo[8];
//
        $oFP->src_q = $aInfo[9];
        $oFP->src_qp = $aInfo[10];
        
//
        
        if ( $aInfo[4] > -1 ){
            $oFP->setColors(array("b"=>$aInfo[3],"g"=>$aInfo[4],"r"=>$aInfo[5]/*,"y"=>$fp[6]*/));
        }
        

        
        $aMobileFrames[$m_frame_id] = $oFP;
    }

    //DO AVG FRAME
    $avrage = array('cwiartka' => 0,'grayCwiartka' => 0, 'grayVector'=>array(0,0), 'cwiartkaC'=>0); #prevent notice
    $i = count($aMobileFrames);  #UPDATE
    foreach($aMobileFrames as $fr)
    {
        var_dump_spec( $fr->grayCwiartka, true );
        $avrage['cwiartka'] += $fr->cwiartka;
        $avrage['cwiartkaC'] += $fr->cwiartkaC;
        $avrage['grayCwiartka'] += $fr->grayCwiartka;
        $avrage['grayVector'][0] += $fr->grayVector[0];
        $avrage['grayVector'][1] += $fr->grayVector[1];
    }
    # UPDATE : check zero value before using division .
    $avrage['cwiartka'] = ($avrage['cwiartka']?round($avrage['cwiartka']/$i):0);   #round value
    $avrage['cwiartkaC'] = ($avrage['cwiartkaC']?round($avrage['cwiartkaC']/$i):0);   #round value
    $avrage['grayCwiartka'] = ($avrage['grayCwiartka']?round($avrage['grayCwiartka']/$i):0);
    $avrage['grayVector'][0] = ($avrage['grayVector'][0]?round($avrage['grayVector'][0]/$i, 2):0);
    $avrage['grayVector'][1] = ($avrage['grayVector'][1]?round($avrage['grayVector'][1]/$i, 2):0);
    
    var_dump_spec( $avrage, true );
    
    
    #STEP 2
    # save to $oGLobal LastFrame Kolors
    $oGlobal = new GlobalData();
    $oGlobal->oFPPhone = $aMobileFrames[count($aMobileFrames)-1];
    $oGlobal->oFPPhone->pt = null;
    $oGlobal->oFPPhone->sumaKP = null;
    $oGlobal->oFPPhone->propDlSuma = null;
    $oGlobal->oFPPhone->dlugosc = null;
    $oGlobal->oFPPhone->grayVector = array( $avrage['grayVector'][0], $avrage['grayVector'][1] );
    $oGlobal->oFPPhone->cwiartka = $avrage['cwiartka'];
    $oGlobal->oFPPhone->grayCwiartka = $avrage['grayCwiartka'];
//    var_dump_spec($oGlobal->oFPPhone,true);
    
    #STEP 3
    # based on GET preapre films fingerproints.
    $aServerFilms = prepareFilmsJsonBasedOnGet( $_REQUEST['films'] );
    $aServerFilmsOld = $aServerFilms;
    $countFilmsBasedOnLink = 0;
    foreach($aServerFilms AS $Film){
        if ( count($Film)){
            $countFilmsBasedOnLink++;
        }
    }
    
    
//    
////    $countFilmsBasedOnLink = count($aServerFilms);
    #STEP 4 - jezeli tlefon m dominuajcy bardzo kolor to testuj dalerj tylko filmy posisdajace klatk iz dom kolorem

        var_dump_spec( "FILTRATING CDF: ON", true);
        var_dump_spec( $oGlobal->oFPPhone->aColoryProc, true);
        $aServerFilmsByMainColor = filtrFilmsForOnlyOneWithMainColor( $aServerFilms, 40 );
    
    
//    var_dump_spec("xxx:");
//    var_dump_spec ($oGlobal->oFPPhone->aColoryProc);
    
    if ( $oGlobal->oFPPhone->aColoryProc["b"] > 60 ){
        var_dump_spec( "FILTRATING CDF: MOBILE MAIN COLOR BLUE: TRUE", true);
        $aServerFilms = $aServerFilmsByMainColor["b"];
        
    }
    elseif ( $oGlobal->oFPPhone->aColoryProc["g"] > 60 ){
        var_dump_spec( "FILTRATING CDF: MOBILE MAIN COLOR GREEN: TRUE", true);
        $aServerFilms = $aServerFilmsByMainColor["g"];
    }
    elseif ( $oGlobal->oFPPhone->aColoryProc["r"] > 60 ){
        var_dump_spec( "FILTRATING CDF: MOBILE MAIN COLOR RED: TRUE", true);
        $aServerFilms = $aServerFilmsByMainColor["r"];
    }
    
    
//    || $oGlobal->oFPPhone->aColoryProc["g"] > 60 || $oGlobal->oFPPhone->aColoryProc["r"] > 60){
//            var_dump_spec( "FILTRATING CDF: MOBILE MAIN COLOR: TRUE", true);
//            # mobile ma main color to teraz odfiltrujmy filmy
//
//            
//            if ( $oGlobal->oFPPhone->aColoryProc["b"] > 60 ){
//                $aServerFilms = $aServerFilmsByMainColor["b"];
//            }
//            if ( $oGlobal->oFPPhone->aColoryProc["g"] > 60 ){
//                $aServerFilms = $aServerFilmsByMainColor["g"];
//            }
//            if ( $oGlobal->oFPPhone->aColoryProc["r"] > 60 ){
//                $aServerFilms = $aServerFilmsByMainColor["r"];
//            }
//            
//        }
        else{
            var_dump_spec( "FILTRATING CDF: MOBILE MAIN COLOR: FALSE", true);
        }

    
    if ( count($aServerFilms) == 0 ){ //jak przedobrzymy
        $aServerFilms = $aServerFilmsOld;
    }
    
    #STEPX
//    przelec po filmach i zostaw tylko te ze zgodnym wektorem +- 3 cwiartki gray
//    var_dump_spec( "STEP X: odwalamy filmy ze zlymiy skeirowaniami szarosci" );
//    $aServerFilms = filtrFilmsForOnlyOneWithNearGrayVector( $aServerFilms, $oGlobal->oFPPhone->grayCwiartka  );
//    
//    $sila = round(sqrt(pow($oGlobal->oFPPhone->grayVector[0],2) + pow($oGlobal->oFPPhone->grayVector[1],2)), 2);
////    var_dump_spec( $oGlobal->oFPPhone->grayVector );
//    $aServerFilms = filtrFilmsForOnlyOneWithNearGraySila( $aServerFilms, $sila );
////    var_dump_spec( $aServerFilms );
//    if ( count($aServerFilms) == 0 ){ //jak przedobrzymy
//        $aServerFilms = $aServerFilmsOld;
//    }
    
//    #STEP CWIARTKI ?
//    var_dump_spec( "WYDUPIaMY CIWARTKI?" );
//    foreach( $aServerFilms AS $key=>$filmKlatki ){
//        var_dump_spec( "<hr>FILM: $key" );
//        foreach( $filmKlatki AS $frameid=>$klatka ){
//            var_dump_spec( "<hr>Klatka: $$frameid" );
//            var_dump_spec( $klatka->src_qp );
//            var_dump_spec( $klatka->src_qp );
//        }
//    }
//    
    
    
    
    #STEP 5 - give points 1.0 for FAST KP Quatter ok
    $aHitCounts = comapareMain( $aMobileFrames, $aServerFilms, $oGlobal );
    
    
    
    
//    $aHitCounts = comapareMainGlobalOnly( $aServerFilms, $oGlobal );
    
    
    
    
    
    
$suma = array_sum($aHitCounts);
    $aHitCountsProp = array();
    $suma = array_sum($aHitCounts);
    $minavg = (1/ $countFilmsBasedOnLink);
    $minavg *= 0.5;
    if ( $minavg < 0.1 ){$minavg = 0.1; }
    
    if ( $suma > 0 ){
        //do wykluczania wynikow wykorzystujemy ilsoc filmow badanych
        var_dump_spec( 1/ $countFilmsBasedOnLink );
        foreach ($aHitCounts as $film_id => $punkty){
            $avg = round($punkty / $suma, 5);
            
            if ( $avg > $minavg )
                $aHitCountsProp[$film_id] = $avg;
        }
    }
    
    
    
//    var_dump_spec( $aHitCountsProp, true );
    
    echo json_encode( $aHitCountsProp, JSON_FORCE_OBJECT );
    
    
    
    
    
    
    
    
    
    
    
    
    
    
