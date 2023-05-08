<?php
    const ALLOW_CROSS_ORIGIN = true;

    // TODO - Setting DB values for your local test database!!!
	// $dbhost = 'localhost';
	// $dbuser = 'root';
	// $dbpass = 'root';
    // $dbname = 'prokops';

	$dbhost = 'localhost';
	$dbuser = 'root';
	$dbpass = '';
    $dbname = 'acts238qb';

	// Here is the common words array to use when making a list
	// of keywords found for Task B.
    const COMMON_WORDS = array(
        "a",
        "an",
        "and",
        "as",
        "be",
        "but",
        "did",
        "for",
        "from",
        "have",
        "he",
        "i",
        "in",
        "it",
        "me",
        "of",
        "on",
        "one",
        "our",
        "shall",
        "she",
        "so",
        "that",
        "the",
        "them",
        "there",
        "these",
        "they",
        "this",
        "thy",
        "to",
        "unto",
        "was",
        "we",
        "were",
        "with",
        "which",
        "ye",
        "yet",
        "you",
        "your"
    );

	// Freelancer note, you are welcome to look at these functions below,
	// and add your own here, but do not change my functions without
	// permission please.
	
	// TODO add any parsing functions here...
    //-----------------------------------------------------------------------------------
    function tp_remove_punctuation($string) {
        $string = preg_replace('/\p{P}/', '', $string);
        return $string;
    }

    //-----------------------------------------------------------------------------------
    function tp_create_unique_array($string, $exclude_array) {
        $string_parts_new = array();
        $string_parts = explode(' ', strtolower($string));
        foreach ($string_parts as $string_part) {
            $string_part = trim($string_part);
            if (!in_array($string_part, $exclude_array)) {
                $string_parts_new[] = $string_part;
            }
        }
        $words = array_values(array_unique($string_parts_new));
        asort($words);
        return $words;
    }

    //-----------------------------------------------------------------------------------
    if (!function_exists('str_starts_with')) {
        function str_starts_with($str, $start) {
            return (@substr_compare($str, $start, 0, strlen($start))==0);
        }
    }

    //-----------------------------------------------------------------------------------
    // Gerard S's Functions - Freelancer @superdevGerard
    //-----------------------------------------------------------------------------------
    function getRandomVerseId() { 
        return rand(17, 100);
	} 

    //-----------------------------------------------------------------------------------
    function getRandomRefcode($iLength=5) { 
        $characters = '0123456789'; 
		$randomString = ''; 
		for ($i = 0; $i < $iLength; $i++) { 
			$index = rand(0, strlen($characters) - 1); 
			$randomString .= $characters[$index]; 
		} 
		return $randomString; 
	} 

    //-----------------------------------------------------------------------------------
    function getRandomRefpretty() { 
        $hour = rand(1, 20);
        $minute = rand(1, 40);

        // $timeString = date('g:i', mktime($hour, $minute));
        $timeString = $hour . ":" . $minute;
        return $timeString; // Output: a random t
	} 

    //-----------------------------------------------------------------------------------
    function getRandomVersetext() { 
        $sentence = '';
        $cnt = rand(4, 16);
        for ($i = 0; $i < $cnt; $i++) {
            $randomIndex = rand(0, count(COMMON_WORDS) - 1);
            if ($i == 0)
            {
                $sentence .= ucwords(COMMON_WORDS[$randomIndex]) . ' ';
            }
            else
            {
                $sentence .= COMMON_WORDS[$randomIndex] . ' ';
            }
        }

        return rtrim($sentence) . '.';
	} 

    //-----------------------------------------------------------------------------------
    function getRandomObject() { 
        $obj = array();
        $obj['verseid'] = strval(getRandomVerseId());
        $obj['refcode'] = "0440". getRandomRefcode();
        $obj['refpretty'] ="Not Acts " . getRandomRefpretty() . " KJV";
        $obj['transcode'] = "KJV";
        $obj['versetext'] = getRandomVersetext();
        $obj['uniquestartingphrase'] = "";
        $obj['uniquewordlist'] = "";
        $obj['versewordsclean'] = "";
        $obj['keywordlist'] = "";

        return $obj;
	} 

    //-----------------------------------------------------------------------------------
    function getRandomObjectArray($cnt=5) { 
        $objectArray = array();
	    
		for ($i = 0; $i < $cnt; $i++) {
            $objectArray[]=getRandomObject();
        }
		
        return $objectArray;
	} 
    
    //-----------------------------------------------------------------------------------
    function getRandomizeArrayOrder($arr) {
        $newArr = array();
        $keys = array_keys($arr);
        shuffle($keys);  // Change keys order
        foreach($keys as $key) {
          $newArr[$key] = $arr[$key];
        }
        return $newArr;
      }

    //-----------------------------------------------------------------------------------
    // Meta Data Array
    // Used to track performance statistics passed back to calling app/website
    //-----------------------------------------------------------------------------------
    $dStart = date('m/d/Y h:i:s a', time());
    $tokenData = [];
    $tokenData['received'] = $dStart;
    $metaData = [];
    $metaData['received'] = $dStart;
    $metaStartTime = microtime(true);
    $isHTTPS = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ||
               (isset($_SERVER['SERVER_PORT']) && (int) $_SERVER['SERVER_PORT'] === 443);
    if ($isHTTPS)
    {
        // SSL connection
        $metaData['ssl'] = 'True';
    } else {
        // No SSL
        $metaData['ssl'] = 'False';
    }

    //-----------------------------------------------------------------------------------
	function GetParam($sParameter, $uDefaultValue)
	{
		if (isset($_REQUEST[$sParameter])) 
		{
			return $_REQUEST[$sParameter];
		}
		else
		{
			return $uDefaultValue;
		}
	}

    //-----------------------------------------------------------------------------------
	function AllowedCharsOnly($sInput, $sSpecialChars) {
		// Get allowed characters only
		$sAllowed = preg_replace("/[^a-zA-Z" . $sSpecialChars . "]/", "", $sInput);
		// Trim outside spaces and dupe spaces
		return trim(preg_replace('/\s+/', ' ', $sAllowed));
	}	

    //-----------------------------------------------------------------------------------
    function headerCheckCrossOrigins() {
        if (ALLOW_CROSS_ORIGIN) { header("Access-Control-Allow-Origin: *"); }
        // res.header("Access-Control-Allow-Origin", "*");
        // res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept, Access-Control-Allow-Headers, Access-Control-Request-Method, Access-Control-Request-Headers, Authorization");
        // res.header('Access-Control-Allow-Methods', 'GET, PUT, POST, DELETE, PATCH, OPTIONS');
    }

    //-----------------------------------------------------------------------------------
	function FloatToStr($fInput) {
		return number_format((float)$fInput, 1, '.', '');
	}

    //-----------------------------------------------------------------------------------
	function getRandomString($iLength) { 
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
		$randomString = ''; 
		for ($i = 0; $i < $iLength; $i++) { 
			$index = rand(0, strlen($characters) - 1); 
			$randomString .= $characters[$index]; 
		} 
		return $randomString; 
	} 

    //-----------------------------------------------------------------------------------
    // cleanupHeaderForJSONOutput
    // My battle-tested and proven PHP header cleanup for rest api json!!!
    //-----------------------------------------------------------------------------------
    function cleanupHeaderForJSONOutput()
    {
        // remove any string that could create an invalid JSON
        // such as PHP Notice, Warning, logs...
        ob_clean();

        // this will clean up any previously added headers, to start clean
        header_remove();

        // Set the content type to JSON and charset
        // (charset can be set to something else)
        header("Content-Type: application/json; charset=utf-8");
        headerCheckCrossOrigins();

        // Absolutely no caching allowed!!!
        $ts = gmdate("D, d M Y H:i:s") . " GMT";
        header("Expires: $ts");
        header("Last-Modified: $ts");
        header("Pragma: no-cache");
        header("Cache-Control: no-cache, must-revalidate");
    }

    //-----------------------------------------------------------------------------------
    // returnJsonHttpResponse
    // $success : boolean
    // $data : object or array
    //-----------------------------------------------------------------------------------
    function returnJsonHttpResponse($success, $data, $returnJustRows = false)
    {
        returnJsonHttpResponseExtra($success, $data, $returnJustRows, '', null);
    }

    //-----------------------------------------------------------------------------------
    // returnJsonHttpResponseExtra
    // $success : boolean
    // $data : object or array

    //-----------------------------------------------------------------------------------
    function returnJsonHttpResponseExtra(
               $success, $data, $returnJustRows,
               $extra1Desc, $extra1Data, 
               $extra2Desc = '', $extra2Data = null,
               $extra3Desc = '', $extra3Data = null)
    {
        cleanupHeaderForJSONOutput();

        // Save performance metrics
        global $metaData;
        global $metaStartTime;
        $timeSeconds = microtime(true) - $metaStartTime;
        $metaData['elapsedtime'] = strval(round( $timeSeconds * 1000 )) . ' ms';

        // Set your HTTP response code, 2xx = SUCCESS,
        // anything else will be error, refer to HTTP documentation
        if ($success)
        {
            // Do we have content or not in $data?
            if (count($data) > 0) {
                // We have data to show!
                http_response_code(200);
                if ($returnJustRows) {
                    echo json_encode($data);
                } else {
                    $metaData['responsetype'] = 'Row Data';
                    $metaData['rowcount'] = count($data);
                    $metaData['success'] = true;
                    $theWholeEnchalada =
                        array(
                            'meta' => $metaData,
                            'data' => $data
                        );
                    // Looking at extra data sets, do we include them?
                    // Cannot use array_push with key value pairs
                    if (($extra1Desc !== '') && (!is_null($extra1Data)))
                    { $theWholeEnchalada += [$extra1Desc => $extra1Data]; }
                    if (($extra2Desc !== '') && (!is_null($extra2Data)))
                    { $theWholeEnchalada += [$extra2Desc => $extra2Data]; }
                    if (($extra3Desc !== '') && (!is_null($extra3Data)))
                    { $theWholeEnchalada += [$extra3Desc => $extra3Data]; }
                    echo json_encode($theWholeEnchalada);
                }
            }
            else
            {
                // http_response_code(204);
                // HTTP Specification says 204 must not return anything
                // echo '{"Info": {"Text":"No Content"}}';
                http_response_code(200);
                $metaData['responsetype'] = 'No Data Found';
                $metaData['rowcount'] = 0;
                $metaData['success'] = false;
                $theWholeEnchalada =
                    array(
                        'meta' => $metaData,
                        'data' => $data
                    );
                echo json_encode($theWholeEnchalada);
            }
        }
        else
        {
            $metaData['success'] = false;
            http_response_code(500);
            $theWholeEnchalada = array(
                'meta' => $metaData,
                'message' => 'Unexpected Rest Layer Error'
            );
            echo json_encode($theWholeEnchalada);
            // echo '{"Info": {"Text":"Unexpected Rest Layer Error"}}';
        }

        // making sure nothing is added
        exit();
    }

    //-----------------------------------------------------------------------------------
    // returnJsonHttpStatus
    // $success : boolean
    // $jsonMessage : Json string
    //-----------------------------------------------------------------------------------
    function returnJsonHttpStatus($success, $messageType, $messageText, $rowIDDesc = null, $rowIDValue = null)
    {
        cleanupHeaderForJSONOutput();

        // Save performance metrics
        global $metaData;
        global $metaStartTime;
        $timeSeconds = microtime(true) - $metaStartTime;
        $metaData['elapsedtime'] = strval(round( $timeSeconds * 1000 )) . ' ms';
        $metaData['responsetype'] = 'Message';

        // Set your HTTP response code, 2xx = SUCCESS,
        // anything else will be error, refer to HTTP documentation
        if ($success)
        {
            http_response_code(200);
            $metaData['success'] = true;
        }
        else
        {
            http_response_code(200);
            $metaData['success'] = false;
        }

        $metaData['message'] = $messageText;
        if (!is_null($rowIDDesc) && !is_null($rowIDValue))
        {
            $metaData[$rowIDDesc] = $rowIDValue;
        }

        // Assumes message is already encoded as a Json-compatible string
        // $theWholeEnchalada = array( 'meta' => $metaData, 'message' => '[' . $jsonMessage . ']' );
        // echo json_encode($theWholeEnchalada);
        // echo $jsonMessage;
        $theWholeEnchalada = array( 'meta' => $metaData );
        echo json_encode($theWholeEnchalada);

        // making sure nothing is added
        exit();
    }
      
    //-----------------------------------------------------------------------------------
    // generateUniqueWordsPhrases
    //
    // Freelancer Project Tasks - Now that we have multiple records
    // and an integer value for $iMinPhraseWordCount
    //
    // A - Calculate the list in original word order 
    //     without punctuation in versetext for each row.
    //     Store that result in versewordsclean for each record.
    //
    // B - Make a list of keywords found in each verse 
    //     with no duplicates or punctuation.
    //     Store that result in keywordlist for each record.
    //
    // C - Find any words in this verse text that are unique 
    //     from all these selected verses
    //     and store that list as comma-delimited 
    //     in uniquewordlist with no spaces.
    //
    // D - Find the unique starting phrase for each verse 
    //     and store that in uniquestartingphrase.
    //     So how many words in do you have to go for 
    //     these verse to be different then the others here.
    //     And if less than $iMinPhraseWordCount, 
    //     then go at least that far in in the answer.
    //
    // Note apostrophes, conjuctions and possessives
    // count as a single word in each case.
    // So "it's" is a single word. 
    // "Paul's" is 1 word and so is "wasn't".
    //
    // We want to return an array of records identical 
    // to how the example above returns $dbdata[] as JSON.
    // If you have to create a new functional array to do this, 
    // that is fine.
    //-----------------------------------------------------------------------------------
    function generateUniqueWordsPhrases($dbdata, $iMinPhraseWordCount) {
        
        $dbdata_raw = $uniquewordlist_all = $versewordsclean_all = array();
        foreach ($dbdata as $row) {
		    // Task A
		    $versewordsclean = tp_remove_punctuation($row['versetext']);
		    $row['versewordsclean'] = $versewordsclean;
			// Creating array from $versewordsclean to find unique start phrase
			$rowid = $row['verseid'];
			$versewordsclean_all[$rowid] = $versewordsclean;
			// Task B
			$uniquewordlist = tp_create_unique_array($versewordsclean, COMMON_WORDS);
			$uniquewordlist_all = array_merge($uniquewordlist_all, $uniquewordlist);
			// Creating array from $uniquewordlist_all to check unique words for each record
			$row['uniquewordlist'] = implode(',', $uniquewordlist);
			$row['keywordlist'] = implode(',', $uniquewordlist);
			$dbdata_raw[] =$row;
        }

        $uniquewordlist_all_counts = array_count_values($uniquewordlist_all);
        $versewordsclean_short = '';
		
		// Loop through all records in database to check for uniqueness and unique starting words
		foreach ($dbdata_raw as $db_id => $db) {
			// Loop through each database column
			foreach ($db as $db_column => $db_value) {
				// We will merge unique words to this array later
				$row_uniques = array();
				
				// Skip keywordlist for now, we will manipulate data later

				// Alter uniquewordlist column
				if ($db_column == 'uniquewordlist') {
					// Create array from unique word list
					$unique_words = explode(',', $db_value);
					foreach ($unique_words as $unique_word) {
						// Check if word used more than one time
						$word_count = $uniquewordlist_all_counts[$unique_word];
						// If it used only 1, means it's unique so adding to array
						if ($word_count == 1) {
							$row_uniques[] = $unique_word;
						}
					}
					
					// Create keyword list here
					$keywordlist = '';
					if (count($row_uniques) > 0) {
						$row_uniques_string = implode(',', $row_uniques);	
					}
					$dbdata[$db_id]['uniquewordlist'] = $row_uniques_string;
					$row_uniques_string = '';
				} else if ($db_column == 'uniquestartingphrase') {
					$versewordsclean = $db['versewordsclean'];
					$versewordsclean_arr = explode(' ', $versewordsclean);
					// We will create string from  versewordsclean until we find unique start string
					for ($i = $iMinPhraseWordCount; $i < count($versewordsclean_arr); $i++) {
						$versewordsclean_short = implode(' ', array_slice($versewordsclean_arr, 0, $i));
						$counto = 0;
						foreach ($versewordsclean_all as $rowid => $versewordsclean_line) {
							// We will exclude current line data obviously
							if ($rowid != $dbdata_raw[$db_id]['verseid']) {
								$versewordsclean_line_lower = strtolower($versewordsclean_line);
								$versewordsclean_short_lower = strtolower($versewordsclean_short);
								if (str_starts_with($versewordsclean_line_lower, $versewordsclean_short_lower)) {
									$counto++;
								}
							}
						}
						// If it's unique, no need to check another string - we are adding value to array
						if ($counto == 0) {
							break;	
						}
					}
					$dbdata[$db_id][$db_column] = $versewordsclean_short;
					$versewordsclean_short = '';
				} else {
					$dbdata[$db_id][$db_column] = $db_value;					
				}
			}
		}
        return $dbdata;
    }
?>