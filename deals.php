<!DOCTYPE html>
<html>
	<head>
	</head>
	
<body>

<H1>Here are the current deals listed on <a href="https://deals.kinja.com/all-the-best-deals-1822529788">Kinja...</a></H1>

<table>

<?php

//...include the DOM api for handling html
include 'phpQuery.php'; 

//...declare website to scrape
$url = 'https://deals.kinja.com/all-the-best-deals-1822529788'; 

//...initiate phpquery
$doc = phpQuery::newDocumentFile($url); 

//...set all instances of 'figcaption' to the object variable $deals
$deals = $doc['figcaption']; 

//...declare $deals_ar as an array
$deals_ar = array(); 


//...begin for loop  
foreach ($deals as $deal) { 

	//...add the text content of each $deal to the array $deals_ar
	$deals_ar[] = $deal->textContent; 
	
	//...print each $deal on a new line
	echo '<tr><td>' . pq($deal) . '</td></tr>'; 
	
}

?>

</table>

</body>
</html>
