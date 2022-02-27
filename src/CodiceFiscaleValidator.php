<?php

namespace andreag\codicefiscale;

use andreag\codicefiscale\CodiceFiscale;
use andreag\codicefiscale\CodiceFiscaleAsset;
use yii\validators\Validator;
use Yii;

class CodiceFiscaleValidator extends Validator {

    public $message;

    public $nome;

    public $cognome;

    public $data;

    public $sesso;

    public $comune;

    public $provincia;

    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message='Il codice fiscale non è valido';
        }
    }


    public function validateAttribute($model, $attribute)
    {
        $nome = $this->nome === null ? 'name' : $this->nome;
        $nomeValue = $model->$nome;

        $cognome = $this->cognome === null ? 'last_name' : $this->cognome;
        $cognomeValue = $model->$cognome;

        $data = $this->data === null ? 'birth_date' : $this->data;
        $dataValue = $model->$data;

        $sesso = $this->sesso === null ? 'gender' : $this->sesso;
        $sessoControl = $model->$sesso;
        $sessoValue = $sessoControl == 0 ? "M" : "F";

        $comune = $this->comune === null ? 'city' : $this->comune;
        $comuneValue = $model->$comune;

        $provincia = $this->provincia === null ? 'province' : $this->provincia;
        $provinciaValue = $model->$provincia;

        $calcolo=new CodiceFiscale;

        $cf=$calcolo->calcola($nomeValue, $cognomeValue, $dataValue, $sessoValue, $comuneValue, $provinciaValue);

        Yii::info("Nome: ".$nomeValue);
        Yii::info("Cogome: ".$cognomeValue);
        Yii::info("Data di nascita: ".$dataValue);
        Yii::info("Sesso: ".$sessoValue);
        Yii::info("Comune: ".$comuneValue);
        Yii::info("Provincia: ".$provinciaValue);
        Yii::warning("CF: ".$cf);
        Yii::warning("Inserted CF: ".$model->$attribute);


        if(strtoupper($cf)===strtoupper($model->$attribute)) {
            $isvalid=true;
        } else {
            $isvalid=false;
        }

        if(!$isvalid) {
            $model->addError($attribute, $this->message);
        }
    }

    public function clientValidateAttribute($model, $attribute, $view)
    {
        CodiceFiscaleAsset::register($view);
        $nome = $this->nome === null ? 'name' : $this->nome;
        $cognome = $this->cognome === null ? 'last_name' : $this->cognome;
        $data = $this->data === null ? 'birth_date' : $this->data;
        $sesso = $this->sesso === null ? 'gender' : $this->sesso;
        $comune = $this->comune === null ? 'city' : $this->comune;
        $provincia = $this->provincia === null ? 'province' : $this->provincia;
        $modelName=$this->getModelName($model);

        return <<<JS
        var nome=jQuery("#{$modelName}-$nome").val();
        var cognome=jQuery("#{$modelName}-$cognome").val();
        var data=jQuery("#{$modelName}-$data").val();
        var sesso=jQuery("#{$modelName}-$sesso").val();
        var comune=jQuery("#{$modelName}-$comune").val();
        var provincia=jQuery("#{$modelName}-$provincia").val();
        var codicefiscale=jQuery("#{$modelName}-{$attribute}").val();
        
        deferred.push($.get("/index.php?r=codicefiscale", {
            nome: nome,
            cognome: cognome,
            data: data,
            sesso: sesso,
            comune: comune,
            provincia: provincia,
            codicefiscale: codicefiscale
        }).done(function(data) {
            if ('' !== data) {
                messages.push(data);
            }
        }));
JS;
    }

    public function getModelName($model) {
        $modelClass=get_class($model);
        $exploded=explode('\\', $modelClass);
        $modelname=strtolower(end($exploded));
        return $modelname;
    }



}