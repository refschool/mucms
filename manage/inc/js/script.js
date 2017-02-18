// JavaScript Document
function copyDescription()
	{
		var str=document.getElementById('description').value;
		document.getElementById('social_body_text').value = str;
	}

//this function render a sefurl from a string (titleof the post)
function sefurlize(){
//http://www2.craven.fr/blojsom/blog/default/Work/Programming/2007/07/04/Tableau-des-accents-pour-JavaScript-et-HTML.html
	var title = document.getElementById('title').value;
	// Clean up the title		
	titre = title.toString();
	var url = titre
		.toLowerCase() // change everything to lowercase
		.replace(/^\s+|\s+$/g, "") // trim leading and trailing spaces		
		.replace(/[_|'|\s]+/g, "-") // change all spaces and underscores to a hyphen, should apply quote treatment
		.replace(/\340|\342|\344/g,"a")  //french ungreedy function
		.replace(/\351|\350|\353/g,"e")  //french ungreedy function
		.replace(/\356|\357/g,"i")  //french ungreedy function
		.replace(/\364|\366/g,"o")  //french ungreedy function
		.replace(/\371|\373|\374/g,"u")  //french ungreedy function
		.replace(/\347/g,"c")  //french ungreedy function
		.replace(/[^a-z0-9-]+/g, "") // remove all non-alphanumeric characters except the hyphen
		.replace(/[-]+/g, "-") // replace multiple instances of the hyphen with a single instance
		.replace(/^-+|-+$/g, "") // trim leading and trailing hyphens				
		; 
		document.getElementById('thisurl').value = url+'/';
}

function setImageSize() {
	var newImg = new Image();
	newImg.src = document.getElementById('image_url').value;
	var height = newImg.height;
	var width = newImg.width;
	document.getElementById('width').value = width;
	document.getElementById('height').value = height;	

}

//metadata
function toggleMeta(){
	if($('#metadata').css('display') == 'block')
		//{$('#metadata').css('display','none')} 
		{$('#metadata').slideUp('slow')} 
	else 
		//{$('#metadata').css('display','block')}
		{$('#metadata').slideDown('slow')}
}

