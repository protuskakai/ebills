<?php
	// Example 1 (1 week interval before current date)
	function getDaysInWeek ($weekNumber, $year, $dayStart = 1) {
		// Count from '0104' because January 4th is always in week 1
		// (according to ISO 8601).
		$time = strtotime($year . '0104 +' . ($weekNumber - 1).' weeks');
		// Get the time of the first day of the week
		$dayTime = strtotime('-' . (date('w', $time) - $dayStart) . ' days', $time);
		// Get the times of days 0 -> 6
		$dayTimes = array ();
		for ($i = 0; $i < 7; ++$i) {
			$dayTimes[] = strtotime('+' . $i . ' days', $dayTime);
		}
		// Return timestamps for mon-sun.
		return $dayTimes;
	}

	$thisweek = date('W');
	$thisyear = date('Y');
	$dayTimes = getDaysInWeek($thisweek, $thisyear);

	$date4_default = date('Y-m-d', $dayTimes[0]);
	$date5_default = date('Y-m-d', $dayTimes[(sizeof($dayTimes)-1)]);
	//----------------------------------------

	// Example 2 (30 days interval before current date)
	$GapDays = 60 * 60 *24 * 30;
	$date4_default = date("Y-m-d");
	$date5_default = date("Y-m-d",time() - $GapDays);
	//----------------------------------------
	
	$myCalendar = new tc_calendar("date4", true, false);
	$myCalendar->setIcon("calendar/images/iconCalendar.gif");
	$myCalendar->setDate(date("d", strtotime($date4_default)), date("m", strtotime($date4_default)), date("Y", strtotime($date4_default)));
	$myCalendar->setPath("calendar/");
	$myCalendar->setYearInterval(1970, 2020);
	$myCalendar->setAlignment("left", "bottom");
	$myCalendar->setDatePair("date4", "date5", $date5_default);
	$myCalendar->writeScript();

	$myCalendar = new tc_calendar("date5", true, false);
	$myCalendar->setIcon("calendar/images/iconCalendar.gif");
	$myCalendar->setDate(date("d", strtotime($date5_default)), date("m", strtotime($date5_default)), date("Y", strtotime($date5_default)));
	$myCalendar->setPath("calendar/");
	$myCalendar->setYearInterval(1970, 2020);
	$myCalendar->setAlignment("right", "bottom");
	$myCalendar->setDatePair("date4", "date5", $date4_default);
	$myCalendar->writeScript();
?>