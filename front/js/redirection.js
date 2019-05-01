function Connexion(){
	connect = document.getElementById('submitConnexion');
	form= document.getElementById('formConnexion');
	
	
	if(connect.value="Connexion"){
		form.action="connexion_compt.php";
	}
	
}

function Inscription(){
	connect = document.getElementById('submitConnexion');
	form= document.getElementById('formConnexion');
	
	
	if(connect.value="Inscription"){
		form.action="inscription.php";
	}
	
}