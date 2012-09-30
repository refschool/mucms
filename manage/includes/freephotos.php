<?php
$freephoto = array( 
0 => 'http://www.everystockphoto.com/',
1 => 'http://www.sxc.hu/',
2 => 'http://www.imageafter.com/',
3 => 'http://www.photogen.com/',
4 => 'http://www.freedigitalphotos.net/',
5 => 'http://www.photolib.noaa.gov/',
6 => 'http://www.burningwell.org/',
7 => 'http://backgroundsarchive.com/',
8 => 'http://pdphoto.org/',
9 => 'http://www.public-domain-photos.com/',
10 => 'http://www.unclesamsphotos.com/',
11 => 'http://www.freefoto.com/index.jsp',
12 => 'http://www.dexhaus.com/v2/',
13 => 'http://www.kavewall.com/stock/',
14 => 'http://www.adigitaldreamer.com/gallery/index.php',
15 => 'http://www.stockvault.net/',
16 => 'http://www.freephotosbank.com/',
17 => 'http://www.freedigitalphotos.net/',
18 => 'http://www.cepolina.com/freephoto/',
19 => 'http://www.turbophoto.com/Free-Stock-Images/',
20 => 'http://www.freestockimages.net/',
21 => 'http://stockart.deviantart.com/',
22 => 'http://www.unprofound.com/',
23 => 'http://www.vintagepixels.com/',
24 => 'http://www.openstockphotography.org/',
25 => 'http://www.imageafter.com/',
26 => 'http://www.fontplay.com/freephotos/',
27 => 'http://www.everystockphoto.com/',
28 => 'http://www.photocase.com/en/',
29 => 'http://www.flickr.com/creativecommons/',
30 => 'http://www.graphicsarena.com/',
31 => 'http://www.pixelperfectdigital.com/free_stock_photos/',
32 => 'http://freerangestock.com/',
33 => 'http://www.animationfactory.com/en/',
34 => 'http://www.fotogenika.net/modifica/igallery.asp',
35 => 'http://www.woophy.com/map/index.php',
36 => 'http://www.mayang.com/textures/',
37 => 'http://www.fromoldbooks.org/',
38 => 'http://www.texturewarehouse.com/gallery/index.php',
39 => 'http://freestockphotos.com/',
40 => 'http://majesticimagery.com/',
41 => 'http://www.burningwell.org/',
42 => 'http://www.designpacks.com/',
43 => 'http://www.zurb.com/zurbphotos/',
44 => 'http://amazingtextures.com/textures/index.php',
45 => 'http://amazingtextures.com/textures/index.php',
46 => 'http://www.diwiesign.com/index.php?page=stockphotos',
47 => 'http://tofz.org/index.php',
48 => 'http://www.lightmatter.net/gallery/',
49 => 'http://www.insectimages.org/',
50 => 'http://www.afflict.net/',
51 => 'http://www.artfavor.com/',
52 => 'http://www.freeimages.co.uk/',
53 => 'http://www.creatingonline.com/stock_photos/',
54 => 'http://www.geekphilosopher.com/MainPage/photos.htm',
55 => 'http://www.creativity103.com/',
56 => 'http://www.photoshopsupport.com/resources/stock-photos.html',
57 => 'http://www.freemediagoo.com/',
58 => 'http://www.uneimageauhasard.com/',
);

$govphoto = array (
0 => 'http://www.army.mil/',
1 => 'http://www.nasa.gov/',
2 => 'http://www.whitehouse.gov/',
3 => 'http://www.loc.gov/',
4 => 'http://www.gpo.gov/',
5 => 'http://www.ed.gov/',
6 => 'http://www.noaa.gov/',
7 => 'http://www.energy.gov/',
8 => 'http://www.epa.gov/',
9 => 'http://www.fs.fed.us/',
10 => 'http://www.faa.gov/',
);

$searchenginephoto = array (
google => 'http://images.google.com',
yahoo => 'http://fr.images.search.yahoo.com/images',
live => 'http://www.live.com/?scope=images',
exalead => 'http://www.exalead.fr/image/?js=1&amp;images_per_page=21',
);

?>

<div>
<?php
foreach($searchenginephoto as $engine => $url){

echo '<a href="'.$url.'">'.$engine.'</a><br />';

}

?>

</div>