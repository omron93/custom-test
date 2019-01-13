# custom-test

Nástroj pro vytváření si vlastních testových otázek. 
Autor: Filip Skalický
Email: xskali@fit.vutbr.cz
Licence: MIT

Plugins:
- Owl carousel
- object-fit-images


## tlačítka

#### předchozí
```html
<a href="#" class="customPrevBtn">Předchozí</a>
```
#### další
```html
<a href="#" class="customNextBtn">Další</a>
```
#### start
```html
<a href="#" class="customNextBtn start">Start</a>
```
#### odeslat
```html
<input id="submit" type="button" name="submit" value="Odeslat" />
```

- důležité jsou třídy customPrevBtn a customNextBtn. Nemusí to být přímo odkaz ale jakýkoli prvek s touto třídou. Ale odkaz doporučuju. 
- pomocí css si to normálně můžeš nastylovat jak chceš. klidně využít bootstrap. Měl by tam být nalinkovaný.
- když klikneš na element s třídou "start" tak se spustí počítadlo času
- když jsou obě třídy naráz tak posune na další slide a spustí počítadlo ;)



## obsah testu

- vlastní obsah je v custom/custom.htm
- jde o části html kodu 
- jednotlivé slidy jsou oddělené "++++\n"
- když hned na další řádek dám "<!-- uvodni -->" tak přesun na další slide může být pouze pomocí kliknutí na tlačítko na slidu, NE pomocí kláves
    - když je místo "<!-- uvodni -->" text "<!-- uvodni konecny -->" tak se jedná o poslední slide a automaticky se pokusí odeslat test, jinak musím kliknout na odeslat sám


### jednotlivé otázky

- otázka se skládá z libovolného obsahu (obrázek, text, video, ... ). Např.
```html
<img class="contain" src="//satyr.io/650x65:44/3" alt="">
```
- pro výběr možností je potřeba vložit
```html
<div class="form-group">
    <label class="radio-inline"><input type="radio" name="ot3" value="1">Option 1</label>
    <label class="radio-inline"><input type="radio" name="ot3" value="2">Option 2</label>
    <label class="radio-inline"><input type="radio" name="ot3" value="3">Option 3</label>
</div>
<div class="form-group">
    <input class="ot-time" type="text" name="time">
</div>
```   
 - u <label> atribut "name" mají odpovědi u jedné otázky stené ale pro každou otázku musí být name jiné
 - atribut "value" je hodnota která se uloží do databáze
 - text "Option X" je to co se zobrazí v testu
 
- ten element "time" je povinný a slouží k uložení času odpovědi
```html
<div class="form-group">
    <input class="ot-time" type="text" name="time">
</div>
```


## databáze

- sql script pro přípravu DB je v "sql/init.sql"
- připojení k DB je v souboru "connect.php"


## vlastní css

- buď do "style/own.css"
- nebo se vytvořit vlastní soubor a nalinkovat ho v "head" v index.php


## mapování kláves

- vše je v js/script-own.js
```js
$('html').bind('keydown', function(e) {
    
};
```

## odpovědi z DB
- v "odpovědi.php"
- připojí se do DB, vypíše tabulku
- je možné upravit aby to vypisovalo co je potřeba
