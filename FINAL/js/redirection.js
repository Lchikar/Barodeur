document.addEventListener("DOMContentLoaded", function (event) {
    const btnConnexion = document.getElementById("submitConnexion");
    btnConnexion.addEventListener("click", seConnecter);

    const btnInscription = document.getElementById("submitInscription");
    btnInscription.addEventListener("click", sInscrire);


    function seConnecter(evt) {
        const form = document.getElementById('formConnexion');
        form.action = "../php/connexion_compt.php";
    }

    function sInscrire(evt) {
        const form = document.getElementById('formConnexion');
        form.action = "../php/inscription.php";
    }

});

function redir_Prix() {
    console.log("Trier par prix");
    document.location.href = "page_principale.php?type=prix";
}

function redir_Ambiance() {
    console.log("Trier par ambiance");
    document.location.href = "page_principale.php?type=ambiance";
}

function redir_Note() {
    console.log("Trier par note générale sanns e");
    document.location.href = "page_principale.php?type=general";
}

function redir_Distance() {
    console.log("Trier par distance");
    document.location.href = "page_principale.php?type=distance";
}
    
function redir_Ajout(){
    console.log("ajout bar php");
    document.location.href= "ajouter_bar.php";
}