document.addEventListener("DOMContentLoaded", function (event) {
    const btnConnexion = document.getElementById("submitConnexion");
    btnConnexion.addEventListener("click", seConnecter);
    
    const btnInscription = document.getElementById("submitInscription");
    btnInscription.addEventListener("click", sInscrire);
    
    
    function seConnecter(evt){
        const form = document.getElementById('formConnexion');
        form.action = "../php/connexion_compt.php";
    }
    
    function sInscrire(evt){
        const form = document.getElementById('formConnexion');
        form.action = "../php/inscription.php";
    }

});