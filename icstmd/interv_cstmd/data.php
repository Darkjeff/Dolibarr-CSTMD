<?php
$firstpage = array(
	"logo"=> "../img/logo.jpg",
	"title"=> array("Rapport Annuel du Conseiller a la Securite","Annee	$annee",$name),
	"image"=> "../img/image_doc.jpg",
);
$footer = array(
	"date"=> "V11 janvier 2016",
	"adress"=> "CARBONNE Conseil & FormaPon - 25 Merlet - 33420 ESPIET"
);
$title = array("RAPPORT ANNUEL DU CSTMD","(CONSEILLER A LA SECURITE	POUR LE TRANSPORT DE MARCHANDISES DANGEREUSES)","Conforme a l'arrete du	02 decembre 2014 modifiant l'arrete du 29 mai 2009 dit 'arrete TMD'");

//c=> content, b=> border, l=> line(center-right-left), t=> type font(italy,bold), s=> size font
$data = array(
	array(
		array(
			"c"=>"Nom de l'entreprise :",
			"x"=>10,
			"y"=>22,
			"w"=>80,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>"12"
		),
		array(
			"c"=>$name,
			"x"=>90,
			"y"=>22,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>"12"
		)
	),
	array(
		array(
			"c"=>"Adresse du siege social de l'entreprise",
			"x"=>10,
			"y"=>30,
			"w"=>80,
			"h"=>10,
			"b"=>0,
			"l"=>"T",
			"t"=>"",
			"s"=>"12"
		),
		array(
			"c"=>utf8_decode($adresse),
			"x"=>90,
			"y"=>30,
			"w"=>0,
			"h"=>5,
			"b"=>0,
			"l"=>"t",
			"t"=>"",
			"s"=>"12"
		)
	),
	array(
		array(
			"c"=>utf8_decode("Année	concernée par le rapport"),
			"x"=>10,
			"y"=>40,
			"w"=>80,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>"12"
		),
		array(
			"c"=> $annee,
			"x"=>90,
			"y"=>40,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"C",
			"t"=>"B",
			"s"=>"12"
		)
	),
	array(
		array(
			"c"=> utf8_decode("Ce rapport a été établi par :"),
			"x"=>10,
			"y"=>48,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>"12"
		)
	),
	array(
		array(
			"c"=> utf8_decode($nom),
			"x"=>10,
			"y"=>56,
			"w"=>40,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>"12"
		),
		array(
			"c"=> utf8_decode($prenom),
			"x"=>50,
			"y"=>56,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>"12"
		)
	),
	array(
		array(
			"c"=>"Carbonne Conseil & Formation",
			"x"=>10,
			"y"=>65,
			"w"=>40,
			"h"=>5,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>"12"
		),
		array(
			"c"=> utf8_decode("Tél :	06 71 60 62	50 / 05 57 51 70 36 \n Email : fxc@carbonnetmd.fr"),
			"x"=>50,
			"y"=>65,
			"w"=>0,
			"h"=>5,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>"12"
		)
	),
	array(
		array(
			"c"=> utf8_decode("Fonction : Conseiller à la sécurité"),
			"x"=>10,
			"y"=>77,
			"w"=>80,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>"12"
		),
		array(
			"c"=>"Interne",
			"x"=>90,
			"y"=>77,
			"w"=>60,
			"h"=>8,
			"b"=>0,
			"l"=>"C",
			"t"=>"",
			"s"=>"12"
		),
		array(
			"c"=>"Externe",
			"x"=>150,
			"y"=>77,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"C",
			"t"=>"B",
			"s"=>"12"
		)
	),
	array(
		array(
			"c"=> utf8_decode("Numéro de	certificat :".$certificat),
			"x"=>90,
			"y"=>84,
			"w"=>60,
			"h"=>5,
			"b"=>0,
			"l"=>"C",
			"t"=>"",
			"s"=>"11"
		),
		array(
			"c"=>utf8_decode("Date de validité : ".$datecertif),
			"x"=>150,
			"y"=>84,
			"w"=>0,
			"h"=>5,
			"b"=>0,
			"l"=>"C",
			"t"=>"",
			"s"=>"11"
		),
		array(
			"c"=>"Mode(s) de transport",
			"x"=>90,
			"y"=>94,
			"w"=>60,
			"h"=>8,
			"b"=>0,
			"l"=>"C",
			"t"=>"",
			"s"=>"12"
		),
		array(
			"c"=>"Tous modes",
			"x"=>150,
			"y"=>94,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"C",
			"t"=>"B",
			"s"=>"11"
		),
		array(
			"c"=>utf8_decode("Et/ou	classé(s) de \nMarchandises \ndangereuses"),
			"x"=>90,
			"y"=>103,
			"w"=>60,
			"h"=>5,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>"12"
		),
		array(
			"c"=>"Toutes classes",
			"x"=>150,
			"y"=>103,
			"w"=>0,
			"h"=>5,
			"b"=>0,
			"l"=>"C",
			"t"=>"B",
			"s"=>"11"
		),
		array(
			"c"=>utf8_decode("Et/ou	géographique"),
			"x"=>90,
			"y"=>120,
			"w"=>60,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>"12"
		),
		array(
			"c"=>"S/O",
			"x"=>150,
			"y"=>120,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"C",
			"t"=>"",
			"s"=>"12"
		)
	),
	array(
		array(
			"c"=>utf8_decode("Visite(s)	effectuée(s) sur site(s) voir détail au	point 4.1 du présent (appendice)"),
			"x"=>10,
			"y"=>128,
			"w"=>80,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>"12"
		),
		array(
			"c"=>"Nombre de	visites",
			"x"=>90,
			"y"=>128,
			"w"=>60,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>"12"
		),
		array(
			"c"=>"1",
			"x"=>150,
			"y"=>128,
			"w"=>0,
			"h"=>6,
			"b"=>0,
			"l"=>"C",
			"t"=>"B",
			"s"=>"12"
		)
	),
	array(
		array(
			"c"=>utf8_decode("Identite du ou des conseillers ayant éffectue la ou les visites : \nFx	Carbonne"),
			"x"=>10,
			"y"=>140,
			"w"=>80,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>"12"
		),
		array(
			"c"=>utf8_decode("Numéro(s) de certificat(s):"),
			"x"=>90,
			"y"=>140,
			"w"=>60,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>"12"
		),
		array(
			"c"=>$certificat,
			"x"=>150,
			"y"=>140,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"C",
			"t"=>"B",
			"s"=>"12"
		),
		array(
			"c"=>utf8_decode("Date(s) de validité:"),
			"x"=>90,
			"y"=>148,
			"w"=>60,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>"12"
		),
		array(
			"c"=>$datecertif,
			"x"=>150,
			"y"=>148,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"C",
			"t"=>"B",
			"s"=>"12"
		),
		array(
			"c"=>"Signature(s) :",
			"x"=>90,
			"y"=>156,
			"w"=>60,
			"h"=>5,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>"12"
		),
		array(
			"c"=>"",
			"x"=>150,
			"y"=>156,
			"w"=>0,
			"h"=>5,
			"b"=>0,
			"l"=>"C",
			"t"=>"B",
			"s"=>"12"
		)
	),
	array(
		array(
			"c"=>utf8_decode("Rapport annuel établi le :" .$daterapport),
			"x"=>10,
			"y"=>170,
			"w"=>80,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>"12"
		),
		array(
			"c"=>utf8_decode("Transmis à l'entreprise le :"),
			"x"=>90,
			"y"=>170,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>"12"
		),
		array(
			"c"=>"A: Interlocuteur	CSTMD",
			"x"=>90,
			"y"=>178,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>"12"
		)
	),
	array(
		array(
			"c"=>utf8_decode("Signature	du conseiller à la sécurité"),
			"x"=>10,
			"y"=>186,
			"w"=>80,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>"12"
		),
		array(
			"c"=>$signuser,
			"x"=>90,
			"y"=>186,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>"12"
		)
	),
	array(
		array(
			//"c"=>utf8_decode("Le conseiller à la sécurité s'assure de la réception du présent rapport annuel et en conserve une trace par tout moyen approprié. Le présent rapport est à lire par le responsable de l'entreprise et à conserver pendant 5 ans à disposions des organismes de contrôles. Ce	rapport	est	conforme a l'arrêté du 29 mai 2009 modifié par l'arrêté du 02 decembre 2014 avec les ameliorations preconisees par l'ANCS (Association Nationale des CSTMD)"),
			"c"=>"",
			"x"=>10,
			"y"=>200,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>"12"
		)
	)
);
$page3 = array(
	
	array(utf8_decode("Le conseiller à la sécurité s'assure de la réception du présent rapport annuel et en conserve une trace par tout moyen approprié. Le présent rapport est à lire par le responsable de l'entreprise et à conserver pendant 5 ans à disposions des organismes de contrôles. Ce	rapport	est	conforme a l'arrêté du 29 mai 2009 modifié par l'arrêté du 02 decembre 2014 avec les ameliorations preconisees par l'ANCS (Association Nationale des CSTMD"),""),
	array(utf8_decode($synthrapport)," 5")
	
);

$page4 = array(
	array('c'=>utf8_decode("1. 1. Organisation de l'entreprise pour les activités liées au transport de marchandises dangereuses"), 'h'=>8, 's'=>12, 't'=>"B" ,'ln'=>"" ),
	array('c'=>utf8_decode("1.1. Gestion administrative et opérationnelle des activités liées au transport"), 'h'=>8, 's'=>10, 't'=>"" ,'ln'=>"" ),
	array('c'=>utf8_decode("1.1.1 Activité de l'entreprise"), 'h'=>8, 's'=>12, 't'=>"B" ,'ln'=>"" ),
	array('c'=>utf8_decode($activiteclient), 'h'=>8, 's'=>12, 't'=>"B" ,'ln'=>"" ),
	array('c'=>utf8_decode("1.1.2 Organisation et équipements"), 'h'=>8, 's'=>16, 't'=>"B" ,'ln'=>"" ),
	array('c'=>utf8_decode($orgaclient), 'h'=>8, 's'=>12, 't'=>"B" ,'ln'=>"" ),
	array('c'=>utf8_decode("1.2. Place du conseiller à la sécurité dans l’organisation"), 'h'=>8, 's'=>12, 't'=>"B" ,'ln'=>"" ),
	array('c'=>utf8_decode("1.2.1 Interlocuteur du Conseiller à la sécurité ou Organigramme"), 'h'=>8, 's'=>12, 't'=>"B" ,'ln'=>"" ),
	array('c'=>utf8_decode("L’entreprise dispose d’un conseiller à la sécurité externe toutes classes en relation avec"), 'h'=>8, 's'=>12, 't'=>"" ,'ln'=>"" ),
	array('c'=>utf8_decode($prenomuser), 'h'=>8, 's'=>12, 't'=>"B" ,'ln'=>"" ),
	array('c'=>utf8_decode($modeuser), 'h'=>8, 's'=>12, 't'=>"B" ,'ln'=>"" ),
	array('c'=>utf8_decode($classuser), 'h'=>8, 's'=>12, 't'=>"B" ,'ln'=>"" ),
);

$pages = array(
	//pages
	array(
		//info
		array(
			"c"=>"2	Organisation par rapport a la	surete",
			"x"=>10,
			"y"=>22,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>20,
			"m"=>1
		),
		array(
			"c"=>"2.1 Organisation par rapport a la	surete",
			"x"=>10,
			"y"=>40,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>16,
			"m"=>1
		),
		array(
			"c"=>"2.2.1 Organisation par rapport a la	surete",
			"x"=>10,
			"y"=>60,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>14,
			"m"=>1
		),
		// start table 1 page 5
		array(
			"c"=>"Class (1)",
			"x"=>15,
			"y"=>75,
			"w"=>35,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"Class (1)",
			"x"=>50,
			"y"=>75,
			"w"=>35,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"Class (1)",
			"x"=>85,
			"y"=>75,
			"w"=>55,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"Class (1)",
			"x"=>140,
			"y"=>75,
			"w"=>55,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"N/A: L'entreprise n'emballe pas de MD.",
			"x"=>15,
			"y"=>85,
			"w"=>180,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"N/A: L'entreprise n'emballe pas de MDL'entreprise n'emballe pas de MDL'entreprise n'emballe pas de MDL'entreprise n'emballe pas de MDL'entreprise n'emballe pas de MDL'entreprise n'emballe pas de MD.",
			"x"=>15,
			"y"=>95,
			"w"=>180,
			"h"=>6,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>1
		),
		// End table 1 page 5
		array(
			"c"=>"2.1.2	Marchandises dangereuses chargees ou remplies",
			"x"=>10,
			"y"=>135,
			"w"=>180,
			"h"=>10,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>12,
			"m"=>1
		),
		//start table 2 page 5
		array(
			"c"=>"Classe(1)",
			"x"=>15,
			"y"=>150,
			"w"=>35,
			"h"=>20,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"Classe(2)",
			"x"=>50,
			"y"=>150,
			"w"=>35,
			"h"=>20,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"Classe(3)",
			"x"=>85,
			"y"=>150,
			"w"=>50,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"(1)",
			"x"=>85,
			"y"=>160,
			"w"=>16,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"(2)",
			"x"=>101,
			"y"=>160,
			"w"=>16,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"(3)",
			"x"=>117,
			"y"=>160,
			"w"=>18,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"Classe(3)",
			"x"=>135,
			"y"=>150,
			"w"=>50,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"(1)",
			"x"=>135,
			"y"=>160,
			"w"=>16,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"(2)",
			"x"=>151,
			"y"=>160,
			"w"=>16,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"(3)",
			"x"=>167,
			"y"=>160,
			"w"=>18,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"N/A",
			"x"=>15,
			"y"=>170,
			"w"=>170,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"N/A",
			"x"=>15,
			"y"=>180,
			"w"=>170,
			"h"=>6,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>1
		),
		// End table 2 page 5
		array(
			"c"=>"2.1.3	Marchandises dangereuses chargees ou remplies",
			"x"=>10,
			"y"=>230,
			"w"=>0,
			"h"=>10,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>12,
			"m"=>1
		),
		array(
			"c"=>"2.1.3.1 Marchandises dangereuses chargees ou remplies",
			"x"=>10,
			"y"=>242,
			"w"=>0,
			"h"=>10,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>11,
			"m"=>1
		),
	),
	array(
		//info page 6
		// Start table 1 page 6
		array(
			"c"=>"Classe(1)",
			"x"=>10,
			"y"=>20,
			"w"=>30,
			"h"=>20,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"Classe(2)",
			"x"=>40,
			"y"=>20,
			"w"=>30,
			"h"=>20,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"Classe(3)",
			"x"=>70,
			"y"=>20,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"Classe(3)",
			"x"=>70,
			"y"=>30,
			"w"=>40,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"Classe(3)",
			"x"=>110,
			"y"=>30,
			"w"=>40,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"Classe(3)",
			"x"=>150,
			"y"=>30,
			"w"=>50,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"0",
			"x"=>10,
			"y"=>40,
			"w"=>30,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"0",
			"x"=>40,
			"y"=>40,
			"w"=>30,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"0",
			"x"=>70,
			"y"=>40,
			"w"=>40,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"0",
			"x"=>110,
			"y"=>40,
			"w"=>40,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"0",
			"x"=>150,
			"y"=>40,
			"w"=>50,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"0",
			"x"=>10,
			"y"=>50,
			"w"=>30,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"0",
			"x"=>40,
			"y"=>50,
			"w"=>30,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"0",
			"x"=>70,
			"y"=>50,
			"w"=>40,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"0",
			"x"=>110,
			"y"=>50,
			"w"=>40,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"0",
			"x"=>150,
			"y"=>50,
			"w"=>50,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"ndiquer les quantites	de marchandises concernees.ndiquer les quantites de marchandises concernees.ndiquer les quantites de marchandises concernees.",
			"x"=>10,
			"y"=>60,
			"w"=>0,
			"h"=>6,
			"b"=>1,
			"l"=>"L",
			"t"=>"",
			"s"=>12,
			"m"=>1
		),
		// END table 1 page 6
		array(
			'c'=>"2.1.3.2 Presentation et organisation de l'entreprise pour les activites liees aux transports de marchandises dangereuses",
			"x"=>10,
			"y"=>100,
			"w"=>0,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>11,
			"m"=>1
		),
		// END table 2 page 6
		array(
			'c'=>"Classe (1)",
			"x"=>10,
			"y"=>115,
			"w"=>30,
			"h"=>20,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Classe (2)",
			"x"=>40,
			"y"=>115,
			"w"=>30,
			"h"=>20,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Classe (3)",
			"x"=>70,
			"y"=>115,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"1",
			"x"=>70,
			"y"=>125,
			"w"=>65,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"2",
			"x"=>135,
			"y"=>125,
			"w"=>65,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"N/A",
			"x"=>10,
			"y"=>135,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>" N/A N/A N/AN/A N/A N/AN/A N/A N/AN/A N/A N/AN/A N/A N/AN/A N/A N/AN/A N/A N/AN/A N/A N/AN/A N/A N/AN/A N/A N/AN/A N/A N/A",
			"x"=>10,
			"y"=>145,
			"w"=>0,
			"h"=>6,
			"b"=>1,
			"l"=>"L",
			"t"=>"",
			"s"=>10,
			"m"=>1
		),
		// END table 2 page 6
		array(
			'c'=>"2.1.3.2 Presentation et organisation de l'entreprise pour les activites liees aux transports de marchandises dangereuses",
			"x"=>10,
			"y"=>190,
			"w"=>0,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>11,
			"m"=>1
		),
		// END table 3 page 6
		
		array(
			'c'=>"Classe (1)",
			"x"=>10,
			"y"=>205,
			"w"=>30,
			"h"=>20,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Classe (2)",
			"x"=>40,
			"y"=>205,
			"w"=>30,
			"h"=>20,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Classe (3)",
			"x"=>70,
			"y"=>205,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"1",
			"x"=>70,
			"y"=>215,
			"w"=>65,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"2",
			"x"=>135,
			"y"=>215,
			"w"=>65,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"N/A",
			"x"=>10,
			"y"=>225,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>" N/A N/A N/AN/A N/A N/AN/A N/A N/AN/A N/A N/AN/A N/A N/AN/A N/A N/AN/A N/A N/AN/A N/A N/AN/A N/A N/AN/A N/A N/AN/A N/A N/A",
			"x"=>10,
			"y"=>235,
			"w"=>0,
			"h"=>6,
			"b"=>1,
			"l"=>"L",
			"t"=>"",
			"s"=>10,
			"m"=>1
		),
		// END table 3 page 6
	),
	array(
		//info page 7
		array(
			'c'=>"2.1.3.2 Presentation et organisation de l'entreprise pour les activites liees aux transports de marchandises dangereuses",
			"x"=>10,
			"y"=>27,
			"w"=>0,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>11,
			"m"=>1
		),
		// Start table 1 page 7
		array(
			"c"=>"Classe(1)",
			"x"=>10,
			"y"=>40,
			"w"=>30,
			"h"=>20,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"Classe(2)",
			"x"=>40,
			"y"=>40,
			"w"=>30,
			"h"=>20,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"Classe(3)",
			"x"=>70,
			"y"=>40,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"Classe(3)",
			"x"=>70,
			"y"=>50,
			"w"=>40,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"Classe(3)",
			"x"=>110,
			"y"=>50,
			"w"=>40,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"Classe(3)",
			"x"=>150,
			"y"=>50,
			"w"=>50,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"N/A",
			"x"=>10,
			"y"=>60,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			"c"=>"ndiquer les quantites	de marchandises concernees.ndiquer les quantites de marchandises concernees.ndiquer les quantites de marchandises concernees.",
			"x"=>10,
			"y"=>70,
			"w"=>0,
			"h"=>6,
			"b"=>1,
			"l"=>"L",
			"t"=>"",
			"s"=>12,
			"m"=>1
		),
		// END table 1 page 7
		array(
			'c'=>"2.1.4 Autres operations",
			"x"=>10,
			"y"=>120,
			"w"=>0,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>14,
			"m"=>1
		),
		array(
			'c'=>"N/A",
			"x"=>10,
			"y"=>130,
			"w"=>0,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
	),
	array(
		//info page 8
		array(
			'c'=>"2.2 Marchandises dangereuses a haut	risqueMarchandises dangereuses a haut	risque",
			"x"=>10,
			"y"=>30,
			"w"=>0,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>16,
			"m"=>1
		),
		//Start table 1 page 8
		array(
			'c'=>"class 0",
			"x"=>10,
			"y"=>45,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"L",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>10,
			"y"=>55,
			"w"=>95,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>105,
			"y"=>55,
			"w"=>95,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>10,
			"y"=>65,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"L",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>10,
			"y"=>75,
			"w"=>95,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>105,
			"y"=>75,
			"w"=>95,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>10,
			"y"=>85,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"L",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>10,
			"y"=>95,
			"w"=>47,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>57,
			"y"=>95,
			"w"=>48,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>105,
			"y"=>95,
			"w"=>47,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>152,
			"y"=>95,
			"w"=>48,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>10,
			"y"=>105,
			"w"=>47,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>57,
			"y"=>105,
			"w"=>48,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>105,
			"y"=>105,
			"w"=>47,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>152,
			"y"=>105,
			"w"=>48,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>10,
			"y"=>115,
			"w"=>47,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>57,
			"y"=>115,
			"w"=>48,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>105,
			"y"=>115,
			"w"=>47,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>152,
			"y"=>115,
			"w"=>48,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>10,
			"y"=>125,
			"w"=>47,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>57,
			"y"=>125,
			"w"=>48,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>105,
			"y"=>125,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>10,
			"y"=>135,
			"w"=>95,
			"h"=>20,
			"b"=>1,
			"l"=>"L",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>105,
			"y"=>135,
			"w"=>0,
			"h"=>20,
			"b"=>1,
			"l"=>"L",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>10,
			"y"=>155,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"L",
			"t"=>"",
			"s"=>10,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>10,
			"y"=>165,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"L",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>10,
			"y"=>175,
			"w"=>95,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>105,
			"y"=>175,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>10,
			"y"=>185,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"L",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>10,
			"y"=>195,
			"w"=>95,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>105,
			"y"=>195,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>10,
			"y"=>205,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"L",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>10,
			"y"=>215,
			"w"=>95,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"class 0",
			"x"=>105,
			"y"=>215,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		//END table 1 page 8
	),
	array(
		//info page 9
		array(
			'c'=>"3 Marchandises dangereuses a haut risqueMarchandises dangereuses a haut	risque",
			"x"=>10,
			"y"=>40,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>20,
			"m"=>1
		),
		array(
			'c'=>"Marchandises dangereuses a haut risqueMarchandises dangereuses a haut	risqueMarchandises dangereuses a haut risqueMarchandises dangereuses a haut	risqueMarchandises dangereuses a haut risqueMarchandises dangereuses a haut	risque",
			"x"=>10,
			"y"=>60,
			"w"=>0,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>12,
			"m"=>1
		),
	),
	array(
		//info page 9
		array(
			'c'=>"3.1 Marchandises dangereuses a haut risqueMarchandises dangereuses a haut	risque",
			"x"=>10,
			"y"=>20,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>16,
			"m"=>1
		),
		array(
			'c'=>"Date",
			"x"=>10,
			"y"=>40,
			"w"=>20,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Date",
			"x"=>30,
			"y"=>40,
			"w"=>20,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Date",
			"x"=>50,
			"y"=>40,
			"w"=>20,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Date",
			"x"=>70,
			"y"=>40,
			"w"=>30,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Date",
			"x"=>100,
			"y"=>40,
			"w"=>20,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Date",
			"x"=>120,
			"y"=>40,
			"w"=>20,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Date",
			"x"=>140,
			"y"=>40,
			"w"=>20,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Date",
			"x"=>160,
			"y"=>40,
			"w"=>20,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Date",
			"x"=>180,
			"y"=>40,
			"w"=>20,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Aucun evenement declare cese annee",
			"x"=>10,
			"y"=>50,
			"w"=>0,
			"h"=>8,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>1
		),
		array(
			'c'=>"3.2 Marchandises dangereuses a haut risqueMarchandises dangereuses a haut	risque",
			"x"=>10,
			"y"=>80,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>16,
			"m"=>1
		),
		array(
			'c'=>"Date",
			"x"=>10,
			"y"=>100,
			"w"=>20,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Date",
			"x"=>30,
			"y"=>100,
			"w"=>20,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Date",
			"x"=>50,
			"y"=>100,
			"w"=>20,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Date",
			"x"=>70,
			"y"=>100,
			"w"=>30,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Date",
			"x"=>100,
			"y"=>100,
			"w"=>20,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Date",
			"x"=>120,
			"y"=>100,
			"w"=>20,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Date",
			"x"=>140,
			"y"=>100,
			"w"=>20,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Date",
			"x"=>160,
			"y"=>100,
			"w"=>20,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Date",
			"x"=>180,
			"y"=>100,
			"w"=>20,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"Aucun evenement declare cese annee",
			"x"=>10,
			"y"=>110,
			"w"=>0,
			"h"=>8,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>1
		),
		array(
			'c'=>"3.3 Marchandises dangereuses a haut risqueMarchandises dangereuses a haut	risque",
			"x"=>10,
			"y"=>140,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>16,
			"m"=>1
		),
		array(
			'c'=>"date",
			"x"=>10,
			"y"=>160,
			"w"=>95,
			"h"=>10,
			"b"=>1,
			"l"=>"L",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"date",
			"x"=>105,
			"y"=>160,
			"w"=>95,
			"h"=>10,
			"b"=>1,
			"l"=>"L",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"date",
			"x"=>10,
			"y"=>170,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"",
			"s"=>12,
			"m"=>0
		),
		array(
			'c'=>"date",
			"x"=>10,
			"y"=>180,
			"w"=>0,
			"h"=>8,
			"b"=>1,
			"l"=>"L",
			"t"=>"",
			"s"=>12,
			"m"=>1
		),
	),
);