<?php
$rows = $dbh->query("SELECT upper(lastname) AS lastname,upper(firstname) AS firstname,email FROM tbl_account_individual WHERE (profession IS NULL OR country IS NULL OR industry IS NULL)")->fetchAll(PDO::FETCH_ASSOC);

foreach ($rows as $key => $member) {
		$email = $member['email'];
}
?>