<?php			 $DocFil= '../_base/_BASE_readme.txt';	 	$DocVer='5.0.0';		 $DocRev='2017-02-00'; ?>
//	Oversig over planlagt filsystem, med ReadOnly/ReadWrite adgang angivet.
//						 ___   _   _    ___  _	       
//						/ __| /_\ | |  |   \| |   ___ 
//						\__ \/ _ \| |__| |) | |__/ -_)
//						|___/_/ \_|____|___/|_|  \___)
//						                               
//
// 2016.08.00 ev - EV-soft
//

:	Systemets root installations mappe. Navnet kan være vilkårligt.
RO: \\saldi-e\										[index.html, frasescann.php, favicon.ico, favicon-32x32.png, _ROOT_readme.txt]

:	Denne mappe er basis for programafvikling. (Svarer til den tidligere: ..\index)
RO:	..\_base\											[_BASE_readme.txt]

:	Mapperne for Saldi's hovedgrupper har fået prefix:
RO:	..\_finans\										[*.php]
RO:	..\_debitor\          				[*.php]
RO:	..\_kreditor\         				[*.php]
RO:	..\_lager\            				[*.php]
RO:	..\_produktion\       				[*.php]
RO:	..\_systemdata\       				[*.php]

:	Mappe hvor aktuelle tilretningsfiler befinder sig:
RW:	..\_config\										[connect.php, Sprog_DB.csv]
RW:	..\_config\css\								[user.css]
RW:	..\_config\images\						[logo.jpg]
RW:	..\_config\backup\						[*.sdat]
RW:						\backup\regnskab_n\	(regnskabers individuelle filer)
RW:	..\_config\_exchange\					[*.fodg, *.odg, *.ods] (export/import: *.csv *.tab)
RW:	..\_config\_temp\							[Logfiler, hjælpefiler og andre midlertidige filer]
RW:						\_temp\regnskab_n\	(regnskabers midlertidige individuelle filer)

: Mappe hvor brugerens datafiler findes:
RW:	..\_userlib\backup\           (_userlib erstatter logolib)
RW:						 \regnskab_n\	      (individuelle filer pr. regnskab)
RW:						 \bilag\	          [*.pdf]

:	Systemes øvrige basale byggeklodser:
RO:	..\_assets\css\               [*.css]
RO:	..\_assets\js\                [*.js]
RO:	..\_assets\icons\             [*.icon/png]
RO:	..\_assets\images\            [*.png/jpg]

Der er benyttet upper/lower case i filnavne, for at lette læsbarheden.
I LINUX er det vigtigt at navnet er eksakt, som i programkoden.
Undgå fildublet-navne, ved at veksle mellem upper/lower case, da det
medfører konflikter, når filerne befinder sig i Windows-miljø.
F.eks. Readme.txt, readme.txt

