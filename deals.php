<!DOCTYPE html>
<html>
	<head>
	</head>
	
<body>

<?php
include 'phpQuery.php';

$url = 'https://deals.kinja.com/all-the-best-deals-1822529788';
$doc = phpQuery::newDocumentFile($url);
$deals = $doc['figcaption'];

foreach ($deals as $deal) {
	echo pq($deal) . '<br>';
}

?>

</body>
</html>