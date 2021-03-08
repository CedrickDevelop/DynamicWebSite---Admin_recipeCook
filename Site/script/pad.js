let input ="";

// Afficher la valeur des numéro écris
function showValue(btn) {
    input += btn.value;
    document.getElementById('output').innerHTML = input;
}

// Effacer l'ensemble de l'ecriture
function reset(btn) {
    document.getElementById('output').innerHTML = " ";
    input = "";
}
// Effacer un seul élément
function rem1(btn) {
    input = input.slice(0, -1);
    document.getElementById('output').innerHTML = input;
}

var formValid = document.getElementById('soumission');
formValid.addEventListener('click', validation);

function validation(){
    document.getElementById('output').innerHTML = $_POST['password'];
}