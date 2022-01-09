# yii2-codicefiscale-validator
------

Install the module on the main yii2 app

```
cd /path/to/yii2/instalation

composer require andreag/yii2-codicefiscale-validator

```


Load the module in yii2

Edit the file `backend/config/main.php`

add in the modules section:

```
'modules' => [
    'codicefiscale' => [
        'class' => 'andreag\codicefiscale\Module',
    ],
],
```

Import the db in sql/geografia.sql

Usage:
In the rules of your model add:

```
['codice_fiscale', 'andreag\codicefiscale\CodiceFiscaleValidator', 'nome'=>'nome', 'cognome'=>"cognome", 'data'=>'data_nascita', "sesso"=>"sesso", 'comune'=>"luogo_nascita", 'provincia'=>"provincia_nascita"]
```

________
Based on the developments by Michele Brodoloni