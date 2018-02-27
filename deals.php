<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
		table {
			margin: auto;
			font-family: "Lucida Sans Unicode", "Lucida Grande", "Segoe Ui";
			font-size: 12px;
		}

		table td {
			transition: all .5s;
		}
		
		/* Table */
		.data-table {
			border-collapse: collapse;
			font-size: 14px;
			min-width: 537px;
		}

		.data-table th, 
		.data-table td {
			border: 1px solid #e1edff;
			padding: 7px 17px;
		}
		.data-table caption {
			margin: 7px;
		}

		/* Table Header */
		.data-table thead th {
			background-color: #508abb;
			color: #FFFFFF;
			border-color: #6ea1cc !important;
			text-transform: uppercase;
		}

		/* Table Body */
		.data-table tbody td {
			color: #353535;
		}
		.data-table tbody td:first-child,
		.data-table tbody td:nth-child(4),
		.data-table tbody td:last-child {
			text-align: right;
		}

		.data-table tbody tr:nth-child(odd) td {
			background-color: #f4fbff;
		}
		.data-table tbody tr:hover td {
			background-color: #ffffa2;
			border-color: #ffff0f;
		}

		/* Table Footer */
		.data-table tfoot th {
			background-color: #e5f5ff;
			text-align: right;
		}
		.data-table tfoot th:first-child {
			text-align: left;
		}
		.data-table tbody td:empty
		{
			background-color: #ffcccc;
		}
	</style>
	</head>
	
	<body>
		<H1>Here are the current and past deals listed on <a href="https://deals.kinja.com/tag/daily-deals">Kinja...</a></H1><hr>

<?php
// Include the DOM api for handling html
include 'phpQuery.php'; 

// Declare website to scrape
$url = 'https://deals.kinja.com/tag/daily-deals'; 

// Initiate phpquery
$doc = phpQuery::newDocumentFile($url); 

// Set all instances of 'figcaption' to the object variable $deals
$gettoday = $doc['.js_entry-link'];

foreach ($gettoday as $today) {
	$today_ar[] = pq($today)->attr('href');

}

// Reset $url to today's daily deals
$url = $today_ar[0]; 
$doc = phpQuery::newDocumentFile($url); 
$deals = $doc['figcaption'];


// Begin for loop  
foreach ($deals as $deal) { 

	// Add the text content of each $deal to the array $deals_ar
	$deals_ar[] = $deal->textContent; 
	
	//this finds the urls for each figcaption deal
	$deals_ar[$deal->textContent][url] = pq($deal)->find('a')->attr('href');
	
	//this should hopefully find the price for each figcaption deal
	if (strpos($deal->textContent, "$") !== false) { 
		$ex = explode('$', $deal->textContent);
		$exx = explode(' ', $ex[1]);
		$deals_ar[$deal->textContent][price] = $exx[0];
} else {
	$deals_ar[$deal->textContent][price] = "unavailable";
}
			
	// Print each $deal on a new line
	//echo '<tr><td>' . pq($deal) . '</td></tr>'; 

}


// Add span deals to $deals_ar
$deals_span = $doc['span.video-embed__caption'];
foreach ($deals_span as $deal) { 
	$deals_ar[] = $deal->textContent; 
	$deals_ar[$deal->textContent][url] = pq($deal)->find('a')->attr('href');
	
	if (strpos($deal->textContent, "$") !== false) { 
		$ex = explode('$', $deal->textContent);
		$exx = explode(' ', $ex[1]);
		$deals_ar[$deal->textContent][price] = '$'.$exx[0];
} else {
	$deals_ar[$deal->textContent][price] = "unavailable";
}
	
	// Print each $deal on a new line
	//echo '<tr><td>' . pq($deal) . '</td></tr>'; 

}




include_once('connect.php');

foreach ($deals_ar as $k => $v) {
	if (is_array($v) == false){
		$query = "INSERT INTO `deals`(`item`, `link`, `deal_price`, `description`) VALUES ('".$v."','".$deals_ar[$v]["url"]."','".$deals_ar[$v]["price"]."','')";
			if (!mysqli_query($link,$query)){
			//echo("Error description: " . mysqli_error($link));
			}
		}
	}



include_once('connect.php');

$sql_deals = "SELECT * FROM `deals` ORDER BY DATE(date) DESC, `deal_price` DESC";
$query = mysqli_query($link, $sql_deals);

if (!$query) {
	die ('SQL Error: ' . mysqli_error($link));
}

?>
	<table class="data-table">
		<thead>
			<tr>
				<th>NO</th>
				<th>ITEM</th>
				<th>DEAL PRICE</th>
				<th>DATE</th>
			</tr>
		</thead>
		<tbody>
		
		
		<?php
		$no 	= 1;
		while ($row = mysqli_fetch_array($query))
		{
			echo '<tr>
					<td>'.$no.'</td>
					<td><a href="'.$row['link'].'">'.$row['item'].'</a></td>';
					if ($row['deal_price'] == 0){
						echo '<td>--</td>';
					} else {
						echo '<td>$'.$row['deal_price'].'</td>';
					}
					echo '<td>'. date('F d, Y', strtotime($row['date'])) . '</td>
				</tr>';
			$no++;
		}?>
		</tbody>
	</table>
	</body>
</html>
