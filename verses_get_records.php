<?php
    require_once('verses_config.php');
	$dblink = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if ($dblink->connect_errno) {
		printf("Failed to connect to database");
		exit();
	}

	$iFetchCount = intval(GetParam('fetchcount', 5));
	if ($iFetchCount < 0) 	{ $iFetchCount = 0; }
	if ($iFetchCount > 10) 	{ $iFetchCount = 10; }
	
	if ($iFetchCount > 0)
	{ $sFetchLimit = " LIMIT " . $iFetchCount;	}
	else
	{ $sFetchLimit = ""; }
	$metaData['fetchlimit'] = $iFetchCount;

	$iMinPhraseWordCount = intval(GetParam('minphrasewordcount', 3));
	if ($iMinPhraseWordCount < 1) 	{ $iMinPhraseWordCount = 1; }
	if ($iMinPhraseWordCount > 6) 	{ $iMinPhraseWordCount = 6; }
	$metaData['minphrasewordcount'] = $iMinPhraseWordCount;
	$metaData['commonwordlist'] = implode(',', COMMON_WORDS);

	$iTestRows = intval(GetParam('testrows', 0));
	$iBonusCount = intval(GetParam('bonuscount', 4));

	print_r("asdf");
	
	$sql = 
		"SELECT " . 
		"BV.verseid, BV.refcode, BV.refpretty, BV.transcode, BV.versetext, " .
		"'' AS uniquestartingphrase, " .
		"'' AS uniquewordlist, " .
		"'' AS versewordsclean, " .
		"'' AS keywordlist " .
		"FROM bibleverses BV " .
		"WHERE (istest = " . $iTestRows . ") " . 
		"ORDER BY RAND() " . $sFetchLimit;
		//"ORDER BY verseid ASC LIMIT 99";

	// Fetch rows from test table
	$result = $dblink->query($sql);
	if (!$result) { echo "Database Query Error: " . $dblink -> error; } else {
		$db_data = array();
		while ( $row = $result->fetch_assoc())  {
			$db_rows[] = array_map("utf8_encode", $row);
		}

		/* This works fine, but no random rows added...
		// $db_rows = array_merge($db_rows, getRandomObjectArray($iBonusCount));
		// $db_rows = getRandomizeArrayOrder($db_rows);
		$db_rows = generateUniqueWordsPhrases($db_rows, $iMinPhraseWordCount);
		*/

		/* This works fine, but no unique phrases and words added.
		$db_rows = array_merge($db_rows, getRandomObjectArray($iBonusCount));
		$db_rows = getRandomizeArrayOrder($db_rows);
		// $db_rows = generateUniqueWordsPhrases($db_rows, $iMinPhraseWordCount);
		*/

		// This does not work, and this is my goal!
		$db_rows = array_merge($db_rows, getRandomObjectArray($iBonusCount));
		$db_rows = getRandomizeArrayOrder($db_rows);
		print_r("asdf");
		$db_rows = generateUniqueWordsPhrases($db_rows, $iMinPhraseWordCount);
					
		returnJsonHttpResponse(true, $db_rows);
	}
	$dblink = nil;
	
?>