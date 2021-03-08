// Tableau des numéros
tbimage=new Array(1,2,3,4,5,6,7,8,9,0)

function securi(){
    // Le input
    document.getElementById('secuid10').value=''
    // La table des numéros
    var allElements = document.getElementById('secure').getElementsByTagName('td');

    //Valeurs dans la table
    for (var i = 0; i< allElements.length; i++){

        if(tbimage.length==1){
            allElements[i].firstChild.nodeValue=tbimage[0]
        }
        else{
            // Choix du nombre du hasard et soustrait dans table
            var spl=Math.round(Math.random()*(tbimage.length-1))
            allElements[i].firstChild.nodeValue=tbimage[spl]
            tbimage.splice(spl,1)
        }
        var dd='secuid'+i+''
        allElements[i].id=dd
        allElements[i].onmouseover=function(event){parde(event)};
        allElements[i].onmouseout=finparde
    }
}

function inval(lui){
    var obja=document.getElementById('secuid10')
    obja.value=obja.value+document.getElementById(lui).firstChild.nodeValue
}

function parde(lui){
    var di=(navigator.appName.substring(0,3)=="Mic") ? event.srcElement.id : lui.currentTarget.id
    terin=setTimeout("inval('"+di+"')",500)
}

function finparde(){
    clearTimeout(terin)
}

function reset(){
    document.getElementById("secuid10").value=''
}
// Effacer un seul élément
function retour(btn) {
    input = input.slice(0, -1);
    document.getElementById('secuid10').innerHTML = input;
}