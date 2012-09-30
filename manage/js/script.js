// JavaScript Document
function copyDescription()
	{
		var str=document.getElementById('description').value;
		document.getElementById('social_body_text').value = str;
	}

//this function render a sefurl from a string (titleof the post)
function sefurlize(){

	var title = document.getElementById('title').value;//alert(title); 
	// Clean up the title		
	var url = title
		.toLowerCase() // change everything to lowercase
		.replace(/^\s+|\s+$/g, "") // trim leading and trailing spaces		
		.replace(/[_|'|\s]+/g, "-") // change all spaces and underscores to a hyphen, should apply quote treatment
		.replace(/[גהג]/g,"a")  //french ungreedy function
		.replace(/[יךטכ]/g,"e")  //french ungreedy function
		.replace(/[מן]/g,"i")  //french ungreedy function
		.replace(/[פצ]/g,"o")  //french ungreedy function
		.replace(/[ûüש]/g,"u")  //french ungreedy function
		.replace(/[ח]/g,"c")  //french ungreedy function


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

