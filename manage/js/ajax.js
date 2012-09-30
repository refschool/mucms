//http://gael-donat.developpez.com/web/intro-ajax/
/*
attributes:
readyState  	:le code d'�tat passe successivement de 0 � 4 qui signifie "pr�t".
status 			:200 est ok
404 si la page n'est pas trouv�e.
responseText 	:contient les donn�es charg�es dans une cha�ne de caract�res.
responseXml 	:contient les donn�es charg�es sous forme xml, les m�thodes de DOM servent � les extraire.
onreadystatechange 	:propri�t� activ�e par un �v�nement de changement d'�tat. On lui assigne une fonction.

method:
open(mode, url, boolean)  	mode: type de requ�te, GET ou POST
url: l'endroit ou trouver les donn�es, un fichier avec son chemin sur le disque.
boolean: true (asynchrone) / false (synchrone).
en option on peut ajouter un login et un mot de passe.

send("chaine") 	:null pour une commande GET.

*/

//show the form to edit a category


//preview a post in BO
function ajax(postid)
{
var id = postid;
var domain = document.domain;
var xhr=null;

    //FF
    if (window.XMLHttpRequest) { 
        xhr = new XMLHttpRequest();
    }
	//IE
    else if (window.ActiveXObject) 
    {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    //on d�finit l'appel de la fonction au retour serveur
    xhr.onreadystatechange = function() { show(xhr); };
    
    //on appelle le fichier response.php
    //xhr.open("GET", "http://"+ domain +"/manage/includes/response.php?postid=" + id, true);
	xhr.open("GET", "includes/response.php?postid=" + id, true);
 	xhr.overrideMimeType("text/html; charset=ISO-8859-1");
	xhr.send(null);
}

//this function reads the returned result

function show(xhr)
{
	document.getElementById("preview").innerHTML=(xhr.responseText);
}

//this function will call remote script browserresponse.php
function updatelist(cat)
{
var category = cat;
var domain = document.domain;
var xhr=null;

    //FF
    if (window.XMLHttpRequest) { 
        xhr = new XMLHttpRequest();
    }
	//IE
    else if (window.ActiveXObject) 
    {
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    //on d�finit l'appel de la fonction au retour serveur
    xhr.onreadystatechange = function() { showCategoryListing(xhr); };
    
    //on appelle le fichier response.php
    //xhr.open("GET", "http://"+ domain +"/blog/manage/includes/browserresponse.php?cat=" + category, true);
	xhr.open("GET", "includes/browserresponse.php?cat=" + category, true);
	
	xhr.overrideMimeType("text/html; charset=ISO-8859-1");
    xhr.send(null);
}

function showCategoryListing(xhr)
{
	document.getElementById("listing").innerHTML=(xhr.responseText);
}
