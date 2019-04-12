"use strict";
document.addEventListener("DOMContentLoaded", initialiser);

function initialiser(evt) {
    var classerPar = document.querySelector("#debut_liste");
    classerPar.addEventListener("click", displayList);
}

function displayList(evt){
    document.querySelector("#hidden").classList.toggle("showList");
}