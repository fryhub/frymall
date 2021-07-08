define(function(require, exports, module) {
	var $ = require("jquery");
	
	function Location() {
		this.items	= {
		'0':{1:'Pilipinas'},
		'0,1':{2:'Albay',34:'Batangas',69:'Benguet',84:'Bulacan',109:'Cagayan',139:'Camarines Norte',152:'Camarines Sur',190:'Catanduanes',202:'Cavite',226:'Cebu',280:'Davao Del Norte',292:'Davao Del Sur',309:'Eastern Samar',333:'Iloilo',378:'Isabela',416:'La Union',437:'Laguna',468:'Lanao Del Norte',492:'Leyte',536:'Metro Manila',567:'Misamis Occidental',585:'Misamis Oriental',612:'Negros Occidental',645:'Negros Oriental',671:'Northern Samar',696:'Nueva Ecija',729:'Nueva Vizcaya',745:'Oriental Mindoro',761:'Pampanga',784:'Pangasinan',833:'Quezon',865:'Rizal',880:'Southern Leyte',900:'Tarlac',919:'Western Samar',946:'Zambales',961:'Zamboanga del Norte',989:'Zamboanga del Sur',1017:'Zamboanga Sibugay',1034:'Surigao Del Sur',1054:'Compostela Valley',1066:'TawiTawi',1078:'Agusan Del Sur'},
		'0,1,2':{3:'Bacacay',4:'Camalig',5:'Daraga',6:'Guinobatan',7:'Jovellar',8:'Legazpi City',9:'Libon',10:'Ligao City',11:'Malilipot',12:'Malinao',13:'Manito',14:'Oas',15:'Pio Duran',16:'Polangui',17:'Rapu-Rapu',18:'Santo Domingo',19:'Tabaco City',20:'Tiwi'},
		'0,1,21':{22:'Abucay',23:'Bagac',24:'Balanga City',25:'Dinalupihan',26:'Hermosa',27:'Limay',28:'Mariveles',29:'Morong',30:'Orani',31:'Orion',32:'Pilar',33:'Samal'},
		'0,1,34':{35:'Agoncillo',36:'Alitagtag',37:'Balayan',38:'Balete',39:'Batangas City',40:'Bauan',41:'Calaca',42:'Calatagan',43:'Cuenca',44:'Ibaan',45:'Laurel',46:'Lemery',47:'Lian',48:'Lipa City',49:'Lobo',50:'Mabini',51:'Malvar',52:'Mataasnakahoy',53:'Nasugbu',54:'Padre Garcia',55:'Rosario',56:'San Jose',57:'San Juan',58:'San Luis',59:'San Nicolas',60:'San Pascual',61:'Santa Teresita',62:'Santo Tomas',63:'Taal',64:'Talisay',65:'Tanauan City',66:'Taysan',67:'Tingloy',68:'Tuy'},
		'0,1,69':{70:'Atok',71:'Baguio City',72:'Bakun',73:'Bokod',74:'Buguias',75:'Itogon',76:'Kabayan',77:'Kapangan',78:'Kibungan',79:'La Trinidad',80:'Mankayan',81:'Sablan',82:'Tuba',83:'Tublay'},
		'0,1,84':{85:'Angat',86:'Balagtas',87:'Baliuag',88:'Bocaue',89:'Bulacan',90:'Bustos',91:'Calumpit',92:'Dona Remedios Trinidad',93:'Guiguinto',94:'Hagonoy',95:'Malolos City',96:'Marilao',97:'Meycauayan City',98:'Norzagaray',99:'Obando',100:'Pandi',101:'Paombong',102:'Plaridel',103:'Pulilan',104:'San Ildefonso',105:'San Jose Del Monte City',106:'San Miguel',107:'San Rafael',108:'Santa Maria'},
		'0,1,109':{110:'Abulug',111:'Alcala',112:'Allacapan',113:'Amulung',114:'Aparri',115:'Baggao',116:'Ballesteros',117:'Buguey',118:'Calayan',119:'Camalaniugan',120:'Claveria',121:'Enrile',122:'Gattaran',123:'Gonzaga',124:'Iguig',125:'Lal-Lo',126:'Lasam',127:'Pamplona',128:'Penablanca',129:'Piat',130:'Rizal',131:'Sanchez-Mira',132:'Santa Ana',133:'Santa Praxedes',134:'Santa Teresita',135:'Santo Nino',136:'Solana',137:'Tuao',138:'Tuguegarao City'},
		'0,1,139':{140:'Basud',141:'Capalonga',142:'Daet',143:'Jose Panganiban',144:'Labo',145:'Mercedes',146:'Paracale',147:'San Lorenzo Ruiz',148:'San Vicente',149:'Santa Elena',150:'Talisay',151:'Vinzons'},
		'0,1,152':{153:'Baao',154:'Balatan',155:'Bato',156:'Bombon',157:'Buhi',158:'Bula',159:'Cabusao',160:'Calabanga',161:'Camaligan',162:'Canaman',163:'Caramoan',164:'Del Gallego',165:'Gainza',166:'Garchitorena',167:'Goa',168:'Iriga City',169:'Lagonoy',170:'Libmanan',171:'Lupi',172:'Magarao',173:'Milaor',174:'Minalabac',175:'Nabua',176:'Naga City',177:'Ocampo',178:'Pamplona',179:'Pasacao',180:'Pili',181:'Presentacion',182:'Ragay',183:'Sagnay',184:'San Fernando',185:'San Jose',186:'Sipocot',187:'Siruma',188:'Tigaon',189:'Tinambac'},
		'0,1,190':{191:'Baras',192:'Bato',193:'Bayamanoc',194:'Caramoran',195:'Gigmoto',196:'Panaan',197:'Panganiban',198:'San Andres',199:'San Miguel',200:'Viga',201:'Virac'},
		'0,1,202':{203:'Alfonso',204:'Amadeo',205:'Bacoor',206:'Carmona',207:'Cavite City',208:'Dasmarinas City',209:'Gen. Mariano Alvarez',210:'General Emilio Aguinaldo',211:'General Trias',212:'Imus',213:'Indang',214:'Kawit',215:'Magallanes',216:'Maragondon',217:'Mendez',218:'Naic',219:'Noveleta',220:'Rosario',221:'Silang',222:'Tagaytay City',223:'Tanza',224:'Ternate',225:'Trece Martires City'},
		'0,1,226':{227:'Alcantara',228:'Alcoy',229:'Alegria',230:'Aloguinsan',231:'Argao',232:'Asturias',233:'Badian',234:'Balamban',235:'Bantayan',236:'Barili',237:'Bogo City',238:'Boljoon',239:'Borbon',240:'Carcar City',241:'Carmen',242:'Catmon',243:'Cebu City',244:'Compostela',245:'Consolacion',246:'Cordoba',247:'Daanbantayan',248:'Dalaguete',249:'Danao City',250:'Dumanjug',251:'Ginatilan',252:'Lapu-Lapu City',253:'Liloan',254:'Madridejos',255:'Malabuyoc',256:'Mandaue City',257:'Medellin',258:'Minglanilla',259:'Moalboal',260:'Naga City',261:'Oslob',262:'Pilar',263:'Pinamungahan',264:'Poro',265:'Ronda',266:'Samboan',267:'San Fernando',268:'San Francisco',269:'San Remigio',270:'Santa Fe',271:'Santander',272:'Sibonga',273:'Sogod',274:'Tabogon',275:'Tabuelan',276:'Talisay City',277:'Toledo City',278:'Tuburan',279:'Tudela'},
		'0,1,280':{281:'Asuncion',282:'Braulio E. Dujali',283:'Carmen',284:'Island Garden City Of Samal',285:'Kapalong',286:'New Corella',287:'Panabo City',288:'San Isidro',289:'Santo Tomas',290:'Tagum City',291:'Talaingod'},
		'0,1,292':{293:'Bansalan',294:'Davao City',295:'Digos City',296:'Don Marcelino',297:'Hagonoy',298:'Jose Abad Santos',299:'Kiblawan',300:'Magsaysay',301:'Malalag',302:'Malita',303:'Matanao',304:'Padada',305:'Santa Cruz',306:'Santa Maria',307:'Sarangani',308:'Sulop'},
		'0,1,309':{310:'Arteche',311:'Balangiga',312:'Balangkayan',313:'BORONGAN',314:'Can-avid',315:'Dolores',316:'General Macarthur',317:'Giporlos',318:'Guiuan',319:'Hernani',320:'Jipapad',321:'Lawaan',322:'Llorente',323:'Maslog',324:'Maydolong',325:'Mercedes',326:'Oras',327:'Quinapondan',328:'Salcedo',329:'San Julian',330:'San Policarpo',331:'Sulat',332:'Taft'},
		'0,1,333':{334:'Ajuy',335:'Alimodian',336:'Anilao',337:'Badiangan',338:'Balasan',339:'Banate',340:'Barotac Nuevo',341:'Barotac Viejo',342:'Batad',343:'Bingawan',344:'Cabatuan',345:'Calinog',346:'Carles',347:'Concepcion',348:'Dingle',349:'Duenas',350:'Dumangas',351:'Estancia',352:'Guimbal',353:'Igbaras',354:'Iloilo City',355:'Janiuay',356:'Lambunao',357:'Leganes',358:'Lemery',359:'Leon',360:'Maasin',361:'Miagao',362:'Mina',363:'New Lucena',364:'Oton',365:'Passi City',366:'Pavia',367:'Pototan',368:'San Dionisio',369:'San Enrique',370:'San Joaquin',371:'San Miguel',372:'San Rafael',373:'Santa Barbara',374:'Sara',375:'Tigbauan',376:'Tubungan',377:'Zarraga'},
		'0,1,378':{379:'Alicia',380:'Angadanan',381:'Aurora',382:'Benito Soliven',383:'Burgos',384:'Cabagan',385:'Cabatuan',386:'Cauayan City',387:'Cordon',388:'Delfin Albano',389:'Dinapigue',390:'Divilacan',391:'Echague',392:'Gamu',393:'Ilagan',394:'Jones',395:'Luna',396:'Maconacon',397:'Mallig',398:'Naguilian',399:'Palanan',400:'Quezon',401:'Quirino',402:'Ramon',403:'Reina Mercedes',404:'Roxas',405:'San Agustin',406:'San Guillermo',407:'San Isidro',408:'San Manuel',409:'San Mariano',410:'San Mateo',411:'San Pablo',412:'Santa Maria',413:'Santiago City',414:'Santo Tomas',415:'Tumauini'},
		'0,1,416':{417:'Agoo',418:'Aringay',419:'Bacnotan',420:'Bagulin',421:'Balaoan',422:'Bangar',423:'Bauang',424:'Burgos',425:'Caba',426:'Luna',427:'Naguilian',428:'Pugo',429:'Rosario',430:'San Fernando City',431:'San Gabriel',432:'San Juan',433:'Santo Tomas',434:'Santol',435:'Sudipen',436:'Tubao'},
		'0,1,437':{438:'Alaminos',439:'Bay',440:'Binan City',441:'Cabuyao',442:'Calamba City',443:'Calauan',444:'Cavinti',445:'Famy',446:'Kalayaan',447:'Liliw',448:'Los Banos',449:'Luisiana',450:'Lumban',451:'Mabitac',452:'Magdalena',453:'Majayjay',454:'Nagcarlan',455:'Paete',456:'Pagsanjan',457:'Pakil',458:'Pangil',459:'Pila',460:'Rizal',461:'San Pablo City',462:'San Pedro',463:'Santa Cruz',464:'Santa Maria',465:'Santa Rosa City',466:'Siniloan',467:'Victoria'},
		'0,1,468':{469:'Bacolod',470:'Baloi',471:'Baroy',472:'Iligan City',473:'Kapatagan',474:'Kauswagan',475:'Kolambugan',476:'Lala',477:'Linamon',478:'Magsaysay',479:'Maigo',480:'Matungao',481:'Munai',482:'Nunungan',483:'Pantao Ragat',484:'Pantar',485:'Poona Piagapo',486:'Salvador',487:'Sapad',488:'Sultan Naga Dimaporo',489:'Tagoloan',490:'Tangcal',491:'Tubod'},
		'0,1,492':{493:'Abuyog',494:'Alangalang',495:'Albuera',496:'Babatngon',497:'Barugo',498:'Bato',499:'Baybay City',500:'Burauen',501:'Calubian',502:'Capoocan',503:'Carigara',504:'Dagami',505:'Dulag',506:'Hilongos',507:'Hindang',508:'Inopacan',509:'Isabel',510:'Jaro',511:'Javier',512:'Julita',513:'Kananga',514:'La Paz',515:'Leyte',516:'Macarthur',517:'Mahaplag',518:'Matag-Ob',519:'Matalom',520:'Mayorga',521:'Merida',522:'Ormoc City',523:'Palo',524:'Palompon',525:'Pastrana',526:'San Isidro',527:'San Miguel',528:'Santa Fe',529:'Tabango',530:'Tabontabon',531:'Tacloban City',532:'Tanauan',533:'Tolosa',534:'Tunga',535:'Villaba'},
		'0,1,536':{537:'Binondo',538:'Caloocan City',539:'Ermita',540:'Intramuros',541:'Las Pinas City',542:'Makati City',543:'Malabon City',544:'Malate',545:'Mandaluyong City',546:'Marikina City',547:'Muntinlupa City',548:'Navotas City',549:'Paco',550:'Pandacan',551:'Paranaque City',552:'Pasay City',553:'Pasig City',554:'Pateros',555:'Port Area',556:'Quezon City',557:'Quiapo',558:'Sampaloc',559:'San Juan City',560:'San Miguel',561:'San Nicolas',562:'Santa Ana',563:'Santa Cruz',564:'Taguig City',565:'Tondo I / Ii',566:'Valenzuela City'},
		'0,1,567':{568:'Aloran',569:'Baliangao',570:'Bonifacio',571:'Calamba',572:'Clarin',573:'Concepcion',574:'Don Victoriano Chiongbian',575:'Jimenez',576:'Lopez Jaena',577:'Oroquieta',578:'Ozamiz',579:'Panaon',580:'Plaridel',581:'Sapang Dalaga',582:'Sinacaban',583:'Tangub',584:'Tudela'},
		'0,1,585':{586:'Alubijid',587:'Balingasag',588:'Balingoan',589:'Binuangan',590:'Cagayan De Oro City',591:'Claveria',592:'El Salvador City',593:'Gingoog City',594:'Gitagum',595:'Initao',596:'Jasaan',597:'Kinoguitan',598:'Lagonglong',599:'Laguindingan',600:'Libertad',601:'Lugait',602:'Magsaysay',603:'Manticao',604:'Medina',605:'Naawan',606:'Opol',607:'Salay',608:'Sugbongcogon',609:'Tagoloan',610:'Talisayan',611:'Villanueva'},
		'0,1,612':{613:'Bacolod City',614:'Bago City',615:'Binalbagan',616:'Cadiz City',617:'Calatrava',618:'Candoni',619:'Cauayan',620:'Enrique B. Magalona',621:'Escalante City',622:'Himamaylan City',623:'Hinigaran',624:'Hinoba-an',625:'Ilog',626:'Isabela',627:'Kabankalan City',628:'La Carlota City',629:'La Castellana',630:'Manapla',631:'Moises Padilla',632:'Murcia',633:'Pontevedra',634:'Pulupandan',635:'Sagay City',636:'Salvador Benedicto',637:'San Carlos City',638:'San Enrique',639:'Silay City',640:'Sipalay City',641:'Talisay City',642:'Toboso',643:'Valladolid',644:'Victorias City'},
		'0,1,645':{646:'Amlan',647:'Ayungon',648:'Bacong',649:'Bais City',650:'Basay',651:'Bayawan City',652:'Bindoy',653:'Canlaon City',654:'Dauin',655:'Dumaguete City',656:'Guihulngan',657:'Jimalalud',658:'La Libertad',659:'Mabinay',660:'Manjuyod',661:'Pamplona',662:'San Jose',663:'Santa Catalina',664:'Siaton',665:'Sibulan',666:'Tanjay',667:'Tayasan',668:'Valencia',669:'Vallehermoso',670:'Zamboanguita'},
		'0,1,671':{672:'Allen',673:'Biri',674:'Bobon',675:'Capul',676:'Catarman',677:'Catubig',678:'Gamay',679:'Laoang',680:'Lapinig',681:'Las Navas',682:'Lavezares',683:'Lope De Vega',684:'Mapanas',685:'Mondragon',686:'Palapag',687:'Pambujan',688:'Rosario',689:'San Antonio',690:'San Isidro',691:'San Jose',692:'San Roque',693:'San Vicente',694:'Silvino Lobos',695:'Victoria'},
		'0,1,696':{697:'Aliaga',698:'Bongabon',699:'Cabanatuan City',700:'Cabiao',701:'Carranglan',702:'Cuyapo',703:'Gabaldon',704:'Gapan City',705:'General Mamerto Natividad',706:'General Tinio',707:'Guimba',708:'Jaen',709:'Laur',710:'Licab',711:'Llanera',712:'Lupao',713:'Nampicuan',714:'Palayan City',715:'Pantabangan',716:'Penaranda',717:'Quezon',718:'Rizal',719:'San Antonio',720:'San Isidro',721:'San Jose City',722:'San Leonardo',723:'Santa Rosa',724:'Santo Domingo',725:'Science City Of Munoz',726:'Talavera',727:'Talugtug',728:'Zaragoza'},
		'0,1,729':{730:'Alfonso Castaneda',731:'Ambaguio',732:'Aritao',733:'Bagabag',734:'Bambang',735:'Bayombong',736:'Diadi',737:'Dupax Del Norte',738:'Dupax Del Sur',739:'Kasiba',740:'Kayapa',741:'Quezon',742:'Santa Fe',743:'Solano',744:'Villaverde'},
		'0,1,745':{746:'Baco',747:'Bansud',748:'Bongabong',749:'Bulalacao',750:'Calapan City',751:'Gloria',752:'Mansalay',753:'Naujan',754:'Pinamalayan',755:'Pola',756:'Puerto Galera',757:'Roxas',758:'San Teodoro',759:'Socorro',760:'Victoria'},
		'0,1,761':{762:'Angeles City',763:'Apalit',764:'Arayat',765:'Bacolor',766:'Candaba',767:'Floridablanca',768:'Guagua',769:'Lubao',770:'Mabalacat',771:'Macabebe',772:'Magalang',773:'Masantol',774:'Mexico',775:'Minalin',776:'Porac',777:'San Fernando City',778:'San Luis',779:'San Simon',780:'Santa Ana',781:'Santa Rita',782:'Santo Tomas',783:'Sasmuan'},
		'0,1,784':{785:'Agno',786:'Aguilar',787:'Alaminos City',788:'Alcala',789:'Anda',790:'Asingan',791:'Balungao',792:'Bani',793:'Basista',794:'Bautista',795:'Bayambang',796:'Binalonan',797:'Binmaley',798:'Bolinao',799:'Bugallon',800:'Burgos',801:'Calasiao',802:'Dagupan City',803:'Dasol',804:'Infanta',805:'Labrador',806:'Laoac',807:'Lingayen',808:'Mabini',809:'Malasiqui',810:'Manaoag',811:'Mangaldan',812:'Mangatarem',813:'Mapandan',814:'Natividad',815:'Pozorrubio',816:'Rosales',817:'San Carlos City',818:'San Fabian',819:'San Jacinto',820:'San Manuel',821:'San Nicolas',822:'San Quintin',823:'Santa Barbara',824:'Santa Maria',825:'Santo Tomas',826:'Sison',827:'Sual',828:'Tayug',829:'Umingan',830:'Urbiztondo',831:'Urdaneta City',832:'Villasis'},
		'0,1,833':{834:'Atimonan',835:'Candelaria',836:'Dolores',837:'Infanta',838:'Lucban',839:'Lucena City',840:'Mauban',841:'Pagbilao',842:'Real',843:'Sampaloc',844:'San Antonio',845:'Sariaya',846:'Tayabas City',847:'Tiaong',848:'General Nakar',849:'Buenavista',850:'Calauag',851:'Catanauan',852:'General Luna',853:'Guinayangan',854:'Gumaca',855:'Lopez',856:'Macalelon',857:'Mulanay',858:'Pitogo',859:'Plaridel',860:'San Andres',861:'San Francisco',862:'San Narciso',863:'Tagkawayan',864:'Unisan'},
		'0,1,865':{866:'Angono',867:'Antipolo City',868:'Baras',869:'Binangonan',870:'Cainta',871:'Cardona',872:'Jala-Jala',873:'Morong',874:'Pililla',875:'Rodriguez',876:'San Mateo',877:'Tanay',878:'Taytay',879:'Teresa'},
		'0,1,880':{881:'Anahawan',882:'Bontoc',883:'Hinunangan',884:'Hinundayan',885:'Libagon',886:'Liloan',887:'Limasawa',888:'Maasin City',889:'Macrohon',890:'Malitbog',891:'Padre Burgos',892:'Pintuyan',893:'Saint Bernard',894:'San Francisco',895:'San Juan',896:'San Ricardo',897:'Silago',898:'Sogod',899:'Tomas Oppus'},
		'0,1,900':{901:'Anao',902:'Bamban',903:'Camiling',904:'Capas',905:'Concepcion',906:'Gerona',907:'La Paz',908:'Mayantoc',909:'Moncada',910:'Paniqui',911:'Pura',912:'Ramos',913:'San Clemente',914:'San Jose',915:'San Manuel',916:'Santa Ignacia',917:'Tarlac City',918:'Victoria'},
		'0,1,919':{920:'Almagro',921:'Basey',922:'Calbayog City',923:'Calbiga',924:'Catbalogan City',925:'Daram',926:'Gandara',927:'Hinabangan',928:'Jiabong',929:'Marabut',930:'Matuguinao',931:'Motiong',932:'Pagsanghan',933:'Paranas',934:'Pinabacdao',935:'San Jorge',936:'San Jose De Buan',937:'San Sebastian',938:'Santa Margarita',939:'Santa Rita',940:'Santo Nino',941:'Tagapul-An',942:'Talalora',943:'Tarangnan',944:'Villareal',945:'Zumarraga'},
		'0,1,947':{947:'Botolan',948:'Cabangan',949:'Candelaria',950:'Castillejos',951:'Iba',952:'Masinloc',953:'Olongapo City',954:'Palauig',955:'San Antonio',956:'San Felipe',957:'San Marcelino',958:'San Narciso',959:'Santa Cruz',960:'Subic'},
		'0,1,961':{962:'Bacungan (Leon T. Postigo)',963:'Baliguian',964:'Dapitan City',965:'Dipolog City',966:'Godod',967:'Gutalac',968:'Jose Dalman (Ponot)',969:'Kalawit',970:'katipunan',971:'La Libertad',972:'Labason',973:'Liloy',974:'Manukan',975:'Mutia',976:'Pinan (New Pinan)',977:'Polanco',978:'Pres. Manuel A. Roxas',979:'Rizal',980:'Salug',981:'Sergio Osmena Sr.',982:'Siayan',983:'Sibuco',984:'Sibutad',985:'Sindangan',986:'Siocon',987:'Sirawai',988:'Tampilisan'},
		'0,1,989':{990:'Aurora',991:'Bayog',992:'Dimataling',993:'Dinas',994:'Dumalinao',995:'Dumingag',996:'Josefina',997:'Kumalarang',998:'Labangan',999:'Lakewood',1000:'Lapuyan',1001:'Mahayag',1002:'Margosatubig',1003:'Midsalip',1004:'Molave',1005:'Pagadian City',1006:'Pitogo',1007:'Ramon Magsaysay (Liargo)',1008:'San Miguel',1009:'San Pablo',1010:'Sominot (Don Mariano Marcos)',1011:'Tabina',1012:'Tambulig',1013:'Tigbao',1014:'Tukuran',1015:'Vincenzo A. Sagun',1016:'Zamboanga City'},
		'0,1,1017':{1018:'Alicia',1019:'Buug',1020:'Diplahan',1021:'Imelda',1022:'Ipil',1023:'Kabasalan',1024:'Mabuhay',1025:'Malangas',1026:'Naga',1027:'Olutanga',1028:'Payao',1029:'Roseller Lim',1030:'Siay',1031:'Talusan',1032:'Titay',1033:'Tungawan'},
		'0,1,1034':{1035:'Barobo',1036:'Bayabas',1037:'Bislig City',1038:'Cagwait',1039:'Cantilan',1040:'Carmen',1041:'Carrascal',1042:'Cortes',1043:'Hinatuan',1044:'Lanuza',1045:'Lianga',1046:'Lingig',1047:'Madrid',1048:'Marihatag',1049:'San Agustin',1050:'San Miguel',1051:'Tagbina',1052:'Tago',1053:'Tandag City'},
		'0,1,1054':{1055:'Compostela',1056:'Laak',1057:'Mabini',1058:'Maco',1059:'Maragusan',1060:'Mawab',1061:'Monkayo',1062:'Montevista',1063:'Nabunturan',1064:'New Bataan',1065:'Pantukan'},
		'0,1,1066':{1067:'Bongao',1068:'Languyan',1069:'Mapun',1070:'Panglima Sugala',1071:'Sapa-Sapa',1072:'Sibutu',1073:'Simunul',1074:'Sitangkai',1075:'South Ubian',1076:'Tandubas',1077:'Turtle Islands'},
		'0,1,1078':{1079:'Bayugan City',1080:'Bunawan',1081:'Esperanza',1082:'La Paz',1083:'Loreto',1084:'Prosperidad',1085:'Rosario',1086:'San Francisco',1087:'San Luis',1088:'Santa Josefa',1089:'Sibagat',1090:'Talacogon',1091:'Trento',1092:'Veruela'}
		};
	}

	Location.prototype.find	= function(id) {
		if(typeof(this.items[id]) == "undefined")
			return false;
		return this.items[id];
	}

	Location.prototype.fillOption	= function(el_id , loc_id , selected_id) {
		var el	= $('#'+el_id); 
		var json	= this.find(loc_id); 
		if (json) {
			var index	= 1;
			var selected_index	= 0;
			$.each(json , function(k , v) {
				var option	= '<option value="'+k+'|'+v+'">'+v+'</option>';
				el.append(option);
				
				if (k == selected_id) {
					selected_index	= index;
				}
				
				index++;
			})
		}
	}
	function showLocation(province , city ,town) {
		
		var loc	= new Location();
		var title	= ['--Country--' , '--Province--' , '--City--'];
		$.each(title , function(k , v) {
			title[k]	= '<option value="">'+v+'</option>';
		})
		
		var pid = $('#province'),cid = $('#city'),aid = $('#area');
		pid.append(title[0]);
		cid.append(title[1]);
		aid.append(title[2]);
		
		pid.change(function() {
			cid.empty();
			cid.append(title[1]);
			
			var provinceVal = pid.val().split('|');
			loc.fillOption('city' , '0,'+provinceVal[0]);
			cid.change()
		})
		
		cid.change(function() {
			aid.empty();
			aid.append(title[2]);
			
			var provinceVal = pid.val().split('|');
			var cityVal = cid.val().split('|');
			loc.fillOption('area' , '0,' + provinceVal[0] + ',' + cityVal[0]);
		})
		

		if (province) {
			var provinceArr = province.split('|');province = provinceArr[0];
			loc.fillOption('province' , '0' , province);
			
			if (city) {
				var cityArr = city.split('|');city = cityArr[0];
				loc.fillOption('city' , '0,'+province , city);
				
				if (town) {
					var townArr = town.split('|');town = townArr[0];
					loc.fillOption('area' , '0,'+province+','+city , town);
				}
			}
			
		} else {
			loc.fillOption('province' , '0');
		}
			
	}
	$(function(){ showLocation(); })

});