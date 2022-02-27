<?php


namespace andreag\codicefiscale\controllers;
use andreag\codicefiscale\CodiceFiscale;
use yii\web\Controller;
use Yii;

class DefaultController extends Controller
{
    function actionIndex($nome, $cognome, $data, $sesso, $comune, $provincia, $codicefiscale) {
        $nomeValue = $nome;
        $cognomeValue = $cognome;
        $dataValue = $data;

        $sessoControl = $sesso;
        $sessoValue = $sessoControl == "M" ? "M" : "F";


        $comuneValue = $comune;

        $provinciaValue = $provincia;

        $calcolo=new CodiceFiscale;

        $cf=$calcolo->calcola($nomeValue, $cognomeValue, $dataValue, $sessoValue, $comuneValue, $provinciaValue);

        Yii::info("Nome: ".$nomeValue);
        Yii::info("Cogome: ".$cognomeValue);
        Yii::info("Data di nascita: ".$dataValue);
        Yii::info("Sesso: ".$sessoValue);
        Yii::info("Comune: ".$comuneValue);
        Yii::info("Provincia: ".$provinciaValue);
        Yii::warning("CF: ".$cf);
        Yii::warning("Inserted CF: ".$codicefiscale);


        if(strtoupper($cf)===strtoupper($codicefiscale)) {
            $isvalid=true;

        } else {
            $isvalid=false;
        }
        //$isvalid=true;


        if(!$isvalid) {
            return "Il codice fiscale non è valido";
        }


    }
}