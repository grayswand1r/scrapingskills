<!DOCTYPE html>
<html>
	<head>
	</head>
	
	<body>
		<H1>Here are the current deals listed on <a href="https://deals.kinja.com/all-the-best-deals-1822529788">Kinja...</a></H1>
			<table>

<?php

// Include the DOM api for handling html
include 'phpQuery.php'; 

// Declare website to scrape
$url = 'https://deals.kinja.com/all-the-best-deals-1822529788'; 

// Initiate phpquery
$doc = phpQuery::newDocumentFile($url); 

// Set all instances of 'figcaption' to the object variable $deals
$deals = $doc['figcaption'];
	
// Declare $deals_ar as an array
$deals_ar = array(); 

// Begin for loop  
foreach ($deals as $deal) { 

	// Add the text content of each $deal to the array $deals_ar
	$deals_ar[] = $deal->textContent; 
	
	// Print each $deal on a new line
	echo '<tr><td>' . pq($deal) . '</td></tr>'; 
	
}

?>

			</table>
	</body>
</html>
