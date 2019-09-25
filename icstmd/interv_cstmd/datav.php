<?php
$firstpage = array(
	"logo"=> "../../../../documents/mycompany/logos/" .$logo,
	"title"=> array("Rapport de visite","En date du	$daterapport",$name, $test ),
	"image"=> "../img/image_doc.jpg",
);
$footer = array(
	"date"=> "V12 $now ",
	"adress"=>" $myname - $myadress -  $myzip $mytown "
);
$title = array("RAPPORT DE VISITE");

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
			"h"=>3,
			"b"=>0,
			"l"=>"t",
			"t"=>"",
			"s"=>"10"
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
			"c"=> utf8_decode($nomuser),
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
			"c"=> utf8_decode($prenomuser),
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
    /*
		array(
			"c"=>$myname,
			"x"=>10,
			"y"=>65,
			"w"=>40,
			"h"=>5,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>"12"
		),
        */
		array(
			"c"=> utf8_decode("Tél :	$teluser  \n Email : $mailuser "),
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
			"c"=> utf8_decode("Fonction : $posteuser "),
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
			"c"=> utf8_decode("Numéro de certificat : $certificat"),
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
			"c"=>utf8_decode("Date de validité : $datecertif "),
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
			"c"=>"$modeuser",
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
			"c"=>"$classuser",
			"x"=>150,
			"y"=>103,
			"w"=>0,
			"h"=>5,
			"b"=>0,
			"l"=>"C",
			"t"=>"B",
			"s"=>"11"
		),
		
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
		
		
		
		
		
	),
	array(
		
	),
	array(
		array(
			"c"=>"",
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
			"c"=>"",
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
        "c"=>"",
      //  "c"=>utf8_decode("Signature"),
	//		"c"=>utf8_decode("Le conseiller à la sécurité s'assure de la récep;on du présent rapport annuel et en conserve une trace par tout moyen approprié. Le présent rapport est à lire par le responsable de l'entreprise et à conserver pendant 5 ans à disposions des organismes de contrôles. Ce	rapport	est	conforme a l'arrêté du 29 mai 2009 modifié par l'arrêté du 02 decembre 2014 avec les ameliorations preconisees par l'ANCS (Association Nationale des CSTMD)"),
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
	array("1.Presentation et organisation de l'entreprise pour les actvites liees aux transports de marchandises dangereuses",""),
	array("1.1. Gestion administrative	et operationnelle des activites liees au transport",""),
	array("1.2. Place du conseiller a la securite dans l organisation",""),
	array("2. Releve des activites de l'annee ecoulee",""),
	array("2.2.	Marchandises dangereuses a haut	risque",""),
	array("2.3 Dispositions relatives aux parcs de stationnement selon le 2.3.2 de l annexe 1 du present arrete",""),
	array("4 Bilan des interventions realisees au titre des activites liees au transport de marchandises dangereuses ",""),
	
);

$page4 = array(
	array('c'=>utf8_decode("1. 1. Organisation de l'entreprise pour les activités liées au transport de marchandises dangereuses"), 'h'=>8, 's'=>12, 't'=>"B" ,'ln'=>"" ),
	array('c'=>utf8_decode("1.1. Gestion administrative et opérationnelle des activités liées au transport"), 'h'=>8, 's'=>12, 't'=>"" ,'ln'=>"" ),
	array('c'=>utf8_decode("1.1.1 Activité de l'entreprise"), 'h'=>8, 's'=>12, 't'=>"B" ,'ln'=>"" ),
	array('c'=>$activiteclient, 'h'=>8, 's'=>10, 't'=>"" ,'ln'=>"" ),
	array('c'=>utf8_decode("1.1.2 Organisation et équipements"), 'h'=>8, 's'=>12, 't'=>"B" ,'ln'=>"" ),
	array('c'=>utf8_decode($orgaclient), 'h'=>8, 's'=>10, 't'=>"" ,'ln'=>"" ),
	array('c'=>utf8_decode("1.2. Place du conseiller à la sécurité dans l'organisation"), 'h'=>8, 's'=>12, 't'=>"B" ,'ln'=>"" ),
	array('c'=>utf8_decode("1.2.1 Interlocuteur du Conseiller à la sécurité ou Organigramme"), 'h'=>8, 's'=>12, 't'=>"B" ,'ln'=>"" ),
	array('c'=>utf8_decode("L'entreprise dispose d'un conseiller à la sécurité externe toutes classes en relation avec"), 'h'=>8, 's'=>10, 't'=>"" ,'ln'=>"" ),
	array('c'=>utf8_decode($prenomuser), 'h'=>8, 's'=>10, 't'=>"" ,'ln'=>"" ),
	array('c'=>utf8_decode($modeuser), 'h'=>8, 's'=>10, 't'=>"" ,'ln'=>"" ),
	array('c'=>utf8_decode($classuser), 'h'=>8, 's'=>10, 't'=>"" ,'ln'=>"" ),
	array('c'=>utf8_decode("Ce conseiller à la sécurité est lié par un contrat et déclaré auprès de la DREAL"), 'h'=>8, 's'=>10, 't'=>"" ,'ln'=>"" ),
	array('c'=>utf8_decode($drealnom), 'h'=>8, 's'=>10, 't'=>"" ,'ln'=>"" ),
	array('c'=>utf8_decode($drealaddress), 'h'=>8, 's'=>10, 't'=>"" ,'ln'=>"" ),
	array('c'=>utf8_decode($drealcpville), 'h'=>8, 's'=>10, 't'=>"" ,'ln'=>"" ),
	array('c'=>utf8_decode("1.2.2 Organisation par rapport à la sûreté"), 'h'=>8, 's'=>12, 't'=>"" ,'ln'=>"" ),
	array('c'=>utf8_decode($suretehrtxt), 'h'=>8, 's'=>10, 't'=>"" ,'ln'=>"" ),
	);

	
/// page 5
$pages = array(
	//pages
	array(
		array(
			'c'=>"2.2 Marchandises dangereuses a haut risque",
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
		
		//Start table 1 page 7
		array(
			'c'=>utf8_decode("L'entreprise est-elle concernée par les marchandises reprises dans le tableau du 1.10.3.1.2 ?"),
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
			'c'=>$suretehroui,
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
			'c'=>$suretehrnon,
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
			'c'=>utf8_decode("L'entreprise est-elle concernée par les marchandises reprises dans le tableau du 1.10.3.1.3 ?"),
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
			'c'=>"NON",
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
			'c'=>"OUI",
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
			'c'=>utf8_decode("Si oui, activité (s) concernée (s)"),
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
			'c'=>"Emballeur",
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
			'c'=>"Remplisseur",
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
			'c'=>utf8_decode("Expéditeur"),
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
			'c'=>"Chargeur",
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
			'c'=>"Destinataire",
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
			'c'=>"Transporteur",
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
			'c'=>utf8_decode("Déchargeur"),
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
			'c'=>"",
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
			'c'=>utf8_decode("Autre (à préciser)"),
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
			'c'=>utf8_decode("Préciser, le cas échéant, les marchandises dangereuses et/ou classes de danger concernées, et en cas de pluralité, le(s) site(s) concerné(s):"),
			"x"=>10,
			"y"=>155,
			"w"=>0,
			"h"=>10,
			"b"=>1,
			"l"=>"L",
			"t"=>"",
			"s"=>8,
			"m"=>0
		),
		array(
			'c'=>utf8_decode("L'entreprise est elle soumise au plan de sûreté prévu au 1.10.3.2 ?"),
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
			'c'=>"OUI",
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
			'c'=>"NON",
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
			'c'=>utf8_decode("Si oui est-il établi"),
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
			'c'=>"OUI",
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
			'c'=>"NON",
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
			'c'=>utf8_decode("Le cas échéant pour les matières radioactives, les dispositions du 1.10.5 sont-elles respectées"),
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
			'c'=>"NA",
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
			
	),
	
	////// page 6
	
	array(
		
		
		array(
			'c'=>utf8_decode("2.3 Dispositions relatives aux parcs de stationnement selon le 2.3.2 de l'annexe 1 du présent arrêté L'entreprise dispose-t-elle de parcs de stationnement soumis aux exigences du 2.3.2 ?"),
			"x"=>10,
			"y"=>10,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>12,
			"m"=>1
		),
		array(
			'c'=>utf8_decode("Si oui, nombre de parc de stationnement :"),
			"x"=>10,
			"y"=>30,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>12,
			"m"=>1
		),
		
		
		
		array(
			'c'=>utf8_decode("3 Déclarations, rapports, résumé et bilan des différents évènements et/ou accidents"),
			"x"=>10,
			"y"=>40,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>14,
			"m"=>1
		),
		array(
			'c'=>utf8_decode("Rappel : En application des acticles 6 et 7 de l'arrêté TMD, tout accident répondant au 1.8.3.6 doit faire l'objet d'un rapport d'accident, par les conseillers à la sécurité concernés, accompagné d'une analyse des causes et de recommandations écrites visant à éviter le renouvellement de tels accidents"),
			"x"=>10,
			"y"=>60,
			"w"=>0,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>10,
			"m"=>1
		),
		array(
			'c'=>utf8_decode("Lorsque ces accidents ont répondu aux critères de déclaration d'évènements selon le chapitre 1.8.5.3, le rapport d'accident doit être transmis aux autorités concernées, dans un délai d'un mois"),
			"x"=>10,
			"y"=>90,
			"w"=>0,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>10,
			"m"=>1
		),
		array(
			'c'=>utf8_decode("Les accidents répondant aux critères de déclaration d'évènements impliquant des matières dangereuses selon le chapitre 1.8.5.3 sont résumés dans les tableaux ci-dessous"),
			"x"=>10,
			"y"=>110,
			"w"=>0,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>10,
			"m"=>1
		),
		array(
			'c'=>utf8_decode("R = route, F = Fer, N = Fluvial"),
			"x"=>10,
			"y"=>130,
			"w"=>0,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>10,
			"m"=>1
		),
		array(
			'c'=>utf8_decode("C = chargement, D= déchargement, T = transport, E = emballage, Tb = transbordement"),
			"x"=>10,
			"y"=>140,
			"w"=>0,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>10,
			"m"=>1
		),
		array(
			'c'=>utf8_decode("En cas de perte de la ou les marchandise(s) dangereuse(s)"),
			"x"=>10,
			"y"=>150,
			"w"=>0,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>10,
			"m"=>1
		),
		array(
			'c'=>utf8_decode("Critère 1 : dommages corporels"),
			"x"=>10,
			"y"=>160,
			"w"=>0,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>10,
			"m"=>1
		),
		array(
			'c'=>utf8_decode("Critère 2 : perte de marchandise dangereuse"),
			"x"=>10,
			"y"=>170,
			"w"=>0,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>10,
			"m"=>1
		),
		array(
			'c'=>utf8_decode("Critère 3 : dommages matériels ou à l'environnement,"),
			"x"=>10,
			"y"=>180,
			"w"=>0,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>10,
			"m"=>1
		),
		array(
			'c'=>utf8_decode("Critère 4 : intervention des autorités."),
			"x"=>10,
			"y"=>190,
			"w"=>0,
			"h"=>6,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>10,
			"m"=>1
		),
	),
		
	
	///////// Page 7
	
	
	
	
	
	array(
		
		array(
			'c'=>utf8_decode("3.1 Evènements soumis à déclaration au titre de l'article 7 du présent arrêté (accidents déclarés)"),
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
			'c'=>"Lieu",
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
			'c'=>"Mode",
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
			'c'=>utf8_decode("Opération"),
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
			'c'=>"ONU",
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
			'c'=>"Classe",
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
			'c'=>"GE",
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
			'c'=>utf8_decode("Désignation"),
			"x"=>160,
			"y"=>40,
			"w"=>20,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>9,
			"m"=>0
		),
		array(
			'c'=>utf8_decode("Critères"),
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
			'c'=>utf8_decode("Aucun évènement déclaré cette année"),
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
			'c'=>utf8_decode("3.2 Accidents soumis à la rédaction d'un rapport d'accident au titre du 4 de l'article 6 du présent arrêté"),
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
			'c'=>"Lieu",
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
			'c'=>"Mode",
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
			'c'=>utf8_decode("Opération"),
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
			'c'=>"ONU",
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
			'c'=>"Classe",
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
			'c'=>"GE",
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
			'c'=>utf8_decode("Désignation"),
			"x"=>160,
			"y"=>100,
			"w"=>20,
			"h"=>10,
			"b"=>1,
			"l"=>"C",
			"t"=>"B",
			"s"=>9,
			"m"=>0
		),
		array(
			'c'=>utf8_decode("Critères"),
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
			'c'=>utf8_decode("Aucun accident cette année"),
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
			'c'=>utf8_decode("3.3 Evènements relatifs au transport de marchandises dangereuses de la classe 7"),
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
			'c'=>utf8_decode("Nombre d'évènements significatifs :"),
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
			'c'=>utf8_decode("Nombre d'évènements intéressants (EIT)(*):"),
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
			'c'=>utf8_decode("Aucun accident déclaré cette année"),
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
			'c'=>utf8_decode("(*) EIT : Ecarts aux exigences réglementaires qui n'entraînent pas de dégradation des fonctions de sûreté et dont les incidences sont faibles. Ces EIT sont alors classés hors échelle sur l'échelle INES et ne nécessitent pas de compte rendu d'évènement significatif"),
			"x"=>10,
			"y"=>180,
			"w"=>0,
			"h"=>8,
			"b"=>1,
			"l"=>"L",
			"t"=>"",
			"s"=>7,
			"m"=>1
		),
	),
	
	
	///// Page 8
	array(
		array(
			'c'=>utf8_decode("4 Bilan des interventions réalisées au titre des activités liées au transport de marchandises dangereuses "),
			"x"=>10,
			"y"=>10,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"B",
			"s"=>14,
			"m"=>1
		),
		array(
			'c'=>utf8_decode("4.1 Tableau de synthèse des visites et interventions réalisées par le conseiller à la sécurité"),
			"x"=>10,
			"y"=>30,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>10,
			"m"=>1
		),
		array(
			'c'=>utf8_decode("4.2 Rappel des autres travaux ou audits réalisés pouvant avoir une incidence sur les activités liées au transport de marchandises dangereuses"),
			"x"=>10,
			"y"=>100,
			"w"=>0,
			"h"=>8,
			"b"=>0,
			"l"=>"L",
			"t"=>"",
			"s"=>10,
			"m"=>1
		),
		
			
		
		
	),
	
	
);