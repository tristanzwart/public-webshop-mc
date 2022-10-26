	<style>
		html,
		body,
		main {
			width: 100%;
			height: 100%;
			margin: 0;
			overflow: hidden;
		}

		.spel {
			width: 100%;
			height: 100%;
		}

		.c_vanger {
			position: absolute;
			bottom: 10px;
			width: 100px;
			height: 10px;
			background-color: yellow;
			text-align: center;
		}

		.c_lazer {
			position: absolute;
			bottom: 10px;
			width: 20px;
			height: 50px;
			background-color: greenyellow;
		}
	</style>
	<script>
		// Vars voor schieten speler
		var pos_vanger = 0;
		var omhoog;
		var hoogte_lazer = 0;
		var pos_vanger_nieuw;
		var hoogte_lazer_nieuw;
		var timer = 900000000;
		// aantal gebruikte variabelen declareren en evt. standaard waarde geven
		var i;
		var aantal_bommen = 50;
		var bom_breedte = 30;
		var bom_hoogte = 30;
		var bom_kleur = 'red';
		var bom_ontploft_kleur = 'blue';
		var bom_interval_milliseconden = 80;
		var bom_stappen = 1;
		var time_interval_var;
		var vanger_step = 20;
		var verschuiving = 50; //screen.width / aantal_bommen; doet nog niet wat ik wil wel bijna
		var y_plaats = 5;
		var rechter_bom;
		y_start_verschil = screen.height;
		var bommen = new Array();
		// alle bommen bij langs om de 2e index van de array te declaren
		for (i = 0; i < aantal_bommen; i++) {
			bommen[i] = new Array();
		}

		function start_spel() {
			// alle bommen bij langs
			var p = 0;
			for (i = 0; i < aantal_bommen; i++) {
				// bom op willekeurige positie van linker kant laten beginnen, wel 15 px uit de kant houden
				//bommen[i]['x'] = parseInt(15+ (Math.random() * (screen.width - bom_breedte - 15)));

				//niet random spawnen
				bommen[i]['x'] = parseInt(p * (verschuiving + bom_breedte)); //waarom +15 en -15
				//als het scherm raakt aan de rechter kant reset de x (p naar 0)
				if (bommen[i]['x'] >= (screen.width - 50)) {
					p = -1;
					bommen[i]['x'] = parseInt(0 * (verschuiving + bom_breedte));
					rechter_bom = i - 1;
				}

				// bom op willekeurige positie boven het scherm laten beginnen,, dus negatief getal
				//bommen[i]['y'] = -parseInt((Math.random() * y_start_verschil) - bom_hoogte - 1);

				//Y vergroot per rij
				if (p == -1) {
					y_plaats = y_plaats + bom_hoogte + 10;
				}
				bommen[i]['y'] = y_plaats;

				bommen[i]['hit'] = 'nee';
				document.getElementById('spel').innerHTML += '<div id="bom_' + i + '" style="position:absolute;left:' + bommen[i]['x'] + 'px;top:' + bommen[i]['y'] + 'px;height: ' + bom_hoogte + 'px;width:' + bom_breedte + 'px;background-color:' + bom_kleur + '"></div>';
				p++;
			}
			// vanger in het midden zetten
			document.getElementById('vanger').style.left = parseInt((screen.width / 2) - (document.getElementById('vanger').style.width / 2)) + 'px';
			// interval starten
			time_interval_var = setInterval(drop_bom, bom_interval_milliseconden);
		}
		//Nu hieraan werken
		function drop_bom() {
			// alle bommen bij langs
			var vanger_top = document.getElementById('vanger').offsetTop;
			var vanger_left = document.getElementById('vanger').offsetLeft;
			var vanger_breedte = document.getElementById('vanger').offsetWidth;

			var lazer_top = document.getElementById('lazer').offsetTop;
			var lazer_left = document.getElementById('lazer').offsetLeft;
			var lazer_breedte = document.getElementById('lazer').offsetWidth;

			//TODO: Test detectie hit zijkant en hit is ja dan niet meenemen kan het testen door te schieten op c.vanger posietie
			if (bommen[rechter_bom]['x'] + bom_breedte >= screen.width && bommen[rechter_bom]['hit'] == 'nee') {
				//Te doen re-get rechter bom (hoeft niet)
				var p = 0;
				for (i = 0; i < aantal_bommen; i++) {
					bommen[i]['x'] = parseInt(p * (verschuiving + bom_breedte));

					//kijkt of het de meest rechtse bom is
					if (bommen[i]['x'] >= (screen.width - (bom_breedte + 20))) {
						if (bommen[rechter_bom]['hit'] == 'nee'){
							p = -1;
							bommen[i]['x'] = parseInt(0 * (verschuiving + bom_breedte));
							rechter_bom = i - 1;
						} else {
							while (i < 0){
								if (bommen[rechter_bom]['hit'] == 'nee'){
									p = -1;
									bommen[i]['x'] = parseInt(0 * (verschuiving + bom_breedte));
									rechter_bom = i - 1;
									i = aantal_bommen + 1
								} else {
									i--;
								}
							}
						}	
					}

					if (p == -1) {
						y_plaats = y_plaats + bom_hoogte + 10;
					}
					bommen[i]['y'] = y_plaats;
					p++;
				}
			} else {
				//TODO: Deze nog op de juiste plek zetten
				console.log("Fout code verbeteren hit ja of nee wertk niet!")
			}

			for (i = 0; i < aantal_bommen; i++) {

				//Eerst de x bewegen dan als zijkant beweeg naar beneden (y)
				bommen[i]['x'] = bommen[i]['x'] + bom_stappen;


				// doe aantal stappen erbij, dus hoeveel pixels hij in een ronde moet vallen
				//bommen[i]['y'] = bommen[i]['y'] + bom_stappen;

				// check of de bom de vanger raakt
				if (bommen[i]['hit'] == 'nee') {

					// check of hij nu wel is opgevangen
					if ((bommen[i]['y'] + bom_hoogte > vanger_top) && (bommen[i]['y'] < vanger_top + 10) && (bommen[i]['x'] + bom_breedte > vanger_left) && (bommen[i]['x'] < vanger_left + vanger_breedte)) {
						bommen[i]['hit'] = 'ja';
						document.getElementById('bom_' + i).style.backgroundColor = bom_ontploft_kleur;
					} else{
						if ((bommen[i]['y'] + bom_hoogte > lazer_top) && (bommen[i]['y'] < lazer_top + 10) && (bommen[i]['x'] + bom_breedte > lazer_left) && (bommen[i]['x'] < lazer_left + lazer_breedte)) {
							bommen[i]['hit'] = 'ja';
							document.getElementById('bom_' + i).style.backgroundColor = bom_ontploft_kleur;
						}
					}
				} else {
					// bom is opgevangen, vervormen, zolang hij breedte heeft FIXME:Animatie gaat de andere kant op zodra swith naar volgende rij dus of fixen of gewoon in een keer weg halen
					if (document.getElementById('bom_' + i).offsetWidth > 0) {
						document.getElementById('bom_' + i).style.height = document.getElementById('bom_' + i).offsetHeight - bom_hoogte - 1 + 'px';
						document.getElementById('bom_' + i).style.width = document.getElementById('bom_' + i).offsetWidth - 1 + 'px';
						bommen[i]['x'] = document.getElementById('bom_' + i).offsetLeft + 1;
						document.getElementById('bom_' + i).style.left = document.getElementById('bom_' + i).offsetLeft + 0.50 + 'px';
					}// else {
						// afvoeren naar onderen //TODO waarvoor is dit en heb ik het wel nogdig?
					//	bommen[i]['y'] = screen.height + 1;
						// breedte en hoogte herstellen voor volgende dropping
					//	document.getElementById('bom_' + i).style.width = bom_breedte + 'px';
					//	document.getElementById('bom_' + i).style.height = bom_hoogte + 'px';
					//	document.getElementById('bom_' + i).style.backgroundColor = bom_kleur;
					//}
				}
				// check, als onder het scherm, dan opnieuw bovenaan plaatsen //TODO fix dit stukje code zodat hit niet reset volgens mij ook niet nodig
				//if (bommen[i]['y'] > screen.height) {
				//	bommen[i]['x'] = parseInt(15 + (Math.random() * (screen.width - bom_breedte - 15)));
				//	bommen[i]['y'] = -bom_hoogte - 1;
				//	bommen[i]['hit'] = 'nee';
				//}
				document.getElementById('bom_' + i).style.top = bommen[i]['y'] + 'px';
				document.getElementById('bom_' + i).style.left = bommen[i]['x'] + 'px';
			}
		}
		//Schieten speler
		function schieten_starten(){

			pos_vanger = document.getElementById('vanger').style.left;
			// hier een interval met het spawnen van de spelers zijn lazer
			pos_vanger_nieuw = pos_vanger + 'px'
			document.getElementById('lazer').style.left = pos_vanger_nieuw;
			//Te doen: gebruik zelfde detctie systeem voor de lazer als de vanger
			// Toon de lazer
			document.getElementById('lazer').style.display = 'block';
			document.getElementById('lazer').style.bottom = '0px';
			clearInterval(omhoog);
			omhoog = setInterval(schieten_loop, 10);
		}
		
		function schieten_loop(){
			var lazer_top = document.getElementById('lazer').offsetTop;
			var lazer_left = document.getElementById('lazer').offsetLeft;
			var lazer_breedte = document.getElementById('lazer').offsetWidth;
			if (parseInt(document.getElementById('lazer').style.bottom) >= screen.height) {
				document.getElementById('lazer').style.display = 'none';
				clearInterval(omhoog);
			}else{
				//Doe opniew
				hoogte_lazer = parseInt(document.getElementById('lazer').style.bottom);
				hoogte_lazer_nieuw = hoogte_lazer + 1 + 'px';
				document.getElementById('lazer').style.bottom = hoogte_lazer_nieuw;
			}	
		}
	</script>
<body onkeydown="get_key(event)">
	<div id="spel" class="spel"></div>
	<div id="vanger" class="c_vanger" onclick="window.location.href = 'index.php?p=login';" style="left: 940px;"></div>
	<div id="lazer" class="c_lazer" style="display: none; left: 940px; bottom: 10px;"></div>
	<!--<div id="vijand" style="position: absolute; left: 10px; top: 200px; background-color: crimson; width: 50px; height: 50px;"></div>-->
	<script>
		start_spel();

		function get_key(event) {
			// set direction of first snake
			var left_old = parseInt(document.getElementById('vanger').style.left);
			var left_new;

			switch (event.keyCode) {
				case 37:
					left_new = left_old - vanger_step;
					if(left_new < 0){
						left_new = 0;
					}
					document.getElementById('vanger').style.left = left_new + 'px';
					break;
				case 39:
					left_new = left_old + vanger_step;
					if(left_new > screen.width - parseInt(document.getElementById('vanger').style.width)){
						left_new = screen.width - parseInt(document.getElementById('vanger').style.width);
					}
					document.getElementById('vanger').style.left = left_new + 'px';
					break;
				case 32:
					//Schieten
					schieten_starten();
					break;
				default:
				// doe niks	
			}
		}
	</script>
