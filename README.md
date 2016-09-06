# SALDI-e
Moderniseret udgave af SALDI: <i>Responsive, CSS-baseret, PHP7-klar, blok-struktureret, øget sikkerhed og med sprogvalg.</i>

Målsætningen med denne udvikling er:
<ol type="1">
<li>  Forbedret modul-opbygget Code-design, så vedligeholdelse/udvikling bliver nemmere.
<li>  Fjernelse af inaktiv kode.
<li>  Hastigheds forøgelse, med fokus på repeterende rutiner.
<li>  Indførelse af Responsivt design, med mere moderne/fleksibelt layout.
<li>  CSS-design, så central ændring af udseende gøres mulig.
<li>  Udnyttelse af HTML5 forbedringer (f.eks. validering af input).
<li>  Al output til skærm baseres på et nyt bibliotek: out_base.php
<li>  Sprogvalg for program-fladen, med halv-automatisk vedligeholdelse.
<li>  Forøge sikkerheden omkring password. Opbevaring og styrkemåler.
<li>  Sikre kompatibilitet med PHP7. udgår:{func:Split(), func:ereg_*(), ext:mysql_*}<br> 
     Mere her: [ http://php.net/manual/en/migration70.php ]<br> 
     Og her: [ https://www.digitalocean.com/company/blog/getting-ready-for-php-7/ ]
<li>  Indførelse af WYSIWYG formular-design.
<li>  Layout af source-code forbedres, så strukturen forstås hurtigere, og sjuskefejl afsløres.
<li>  Bedre program-dokumentation ved øget anvendelse af kommentarer.
<li>  Anvende prefix på funktionsnavne, så det afspejler kildefilen. (htm_*, out_*,...)
<li>  Afskaffe alle:  PRINT "xxx" - Benyt/opret rutiner i out_*.php
<li>  Afskaffe Layout-styring med tabeller, som er forældet metode.
<li>  Afskaffe afhængighed af: PDFTK som sjældent er installeret.
<li>  Ændre: BODY onLoad=javascript:alert() til CSS/jquery: msg_Dialog
<li>  Separere branche-funktionalitet, fra de almene regnskabs funktioner (samles i separate "add-on filer").
</ol>
Det er jo en meget omfattende målsætning, og betyder i praksis, en omskrivning af næsten al kode.<br>
Derfor er det velkomment, at nogle der kan forstå den nuværende kode, (ftp://saldi.dk/saldi/seneste/) vil deltage i projektet.<br>
<br>
<b>Note: This is af danish project, and most source-code is in danish language.</b>

En live demo af SALDI-e (-euro) kan du se her: http://ev-soft.dk/saldi-e/_base/page_LayoutModuler.php?sprog=da
