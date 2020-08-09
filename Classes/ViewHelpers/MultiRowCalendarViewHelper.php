<?php
namespace WSR\Myflat\ViewHelpers;

class MultiRowCalendarViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {
	/**
	* Arguments Initialization
	*/
	public function initializeArguments() {
		$this->registerArgument('year', 'int', 'The year', TRUE);
		$this->registerArgument('bookings', 'mixed', 'The booking date', TRUE);
		$this->registerArgument('settings', 'mixed', 'The settings', TRUE);
	}



    /**
    * Returns the multirow calendar
    *
    * @return string
    */
    public function render() {

	$year = (int) $this->arguments['year'];
	$theYear = $year;

		$bookings = $this->arguments['bookings'];
		$this->settings = $this->arguments['settings'];
		
//$out = 'Her we are in the viewhelper for multirow calendar!';
		$startOfYear = mktime(0, 0, 0, 1, 1, $year);
		$endOfYear = mktime(0, 0, 0, 12, 31, $year);
	
		for ($i = 0; $i < count($bookings); $i++) {
			
			$arrival = $bookings->toArray()[$i]->getArrival()->getTimestamp();
			$departure = $bookings->toArray()[$i]->getDeparture()->getTimestamp();
			if ( ($arrival > $startOfYear && $arrival < $endOfYear) || ($departure > $startOfYear && $departure < $endOfYear)) {
				$arrivals[$i] = $arrival;
				$departures[$i] = $departure;
				
			}		
			
		}	
	
	
		if ($arrivals) {
			sort($arrivals);
			sort($departures);
		}


        $lengthOfMonth = array (1 => 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

        if (!$year)
		$theYear = date('Y', time());

        // leap year calculating....
        if ( date("L", mktime(0,0,0,1,1,$theYear)) == 1) {
            $lengthOfMonth[2] = 29;
        }

//		$out = $theYear;

		$this->conf['calendarColumns'] = 2;
		$column = 1;
		$this->conf['displayMode'] = 'monthMultiRow';
		$this->conf['showDaysShortcuts'] = 1;
		$this->conf['startOfWeek'] = 'monday';
		$this->conf['markWeekends'] = 1; 

            // month loop
            for ($m = 1; $m < 13; $m++) {
			$out .= '<table class="monthMultiRow">';
                // adding leading zero
                $mon = ($m < 10) ? '0'. $m : $m ;

                if ( $this->conf['displayMode'] == 'monthMultiRow' ) {
                    if ($column-1 % $this->conf['calendarColumns'] == 0)
                        $out.= '<tr>';
                        $out .= '<td class="monthMultiRow"><table class="tableMultiRow"><tr><td class="monthNameMultiRow" colspan="7">'.
						$this->settings['monthLabels'][$m - 1] .
//						(date("M", strtotime($theYear."-".$mon."-01"))).
						'</td></tr>';
                        if ( $this->conf['showDaysShortcuts'] == 1 ) {
                            // display the daynames
                            $out .= '<tr>';
                            $out .= ($this->conf['startOfWeek'] == 'sunday')? '<td class="dayNames">'.('Sun').'</td>':'';
                            $out .=
                            '<td class="dayNames">'. $this->settings['dayLabels'][0].'</td><td class="dayNames">'.$this->settings['dayLabels'][1].
                            '</td><td class="dayNames">'.$this->settings['dayLabels'][2].'</td><td class="dayNames">'.$this->settings['dayLabels'][3].
                            '</td><td class="dayNames">'.$this->settings['dayLabels'][4].'</td><td class="dayNames">'.$this->settings['dayLabels'][5];
                            $out .= ($this->conf['startOfWeek'] == 'monday')?'</td><td class="dayNames">'.$this->settings['dayLabels'][6].'</td></tr>':'</td></tr>';
                        }
                }

                // calculating the left spaces to get the layout right
                if ( $this->conf['displayMode'] != 'monthSingleRow' )
                    $out .= '<tr>';
                $wd = date('w', strtotime($theYear."-".$m."-"."1"));
                if ($this->conf['startOfWeek'] == 'monday') {
                    $wd = ($wd == 0)? 7 : $wd;
                    if ($wd != 1 ) {
                        for ( $s = 1; $s <  $wd ; $s++){
                               $out .= '<td class="noDay">&nbsp;</td>';
                            }
                    }
                }
                else { // sunday
                    for ( $s = 0; $s <  $wd ; $s++){
                           $out .= '<td class="noDay">&nbsp;</td>';
                         }
                }

            // day loop
            for ($d=1; $d <= $lengthOfMonth[$m]; $d++){
                if (date("w", strtotime($theYear."-".$mon."-".$d))== 0 || date("w", strtotime($theYear."-".$mon."-".$d))== 6 ){
                    $weekend = 1;
                }
                else $weekend =0;

                // adding leading zero
                $day = ($d < 10) ? '0'. $d : $d ;

				$booked = 0;

$end = 0;
$startAndEnd = 0;
				if (is_array($arrivals)) {
					for ($i = 0; $i < count($arrivals); $i++) {
						if (mktime(0,0,0,$mon,$day,$theYear) >= $arrivals[$i] &&
							mktime(0,0,0,$mon,$day,$theYear) <= $departures[$i]) {
							$booked = 1;
							if ( (mktime(0,0,0,$mon,$day,$theYear) <= $arrivals[$i]  && mktime(23, 59, 59, $mon,$day,$theYear) >= $arrivals[$i] )) {
								$start = 1;
							}
							else $start = 0;	
	
							if ( (mktime(0,0,0,$mon,$day,$theYear) <= $departures[$i] && (mktime(23, 59, 59,$mon,$day,$theYear) >= $departures[$i] ))) {
									$end = 1;
							}
							else $end = 0;	
							// now check for startAndEnd
							if ($end && $i < (count($arrivals) - 1)) {
	
								if ( (mktime(0,0,0,$mon,$day,$theYear) <= $arrivals[$i + 1] && (mktime(23, 59, 59,$mon,$day,$theYear) >= $arrivals[$i + 1] ))) {
									$startAndEnd = 1;
								} else {
									$startAndEnd = 0;
								}
							}
							
						}
	
					}
				}

/*
				for ($i = 0; $i < count($departures); $i++) {
					if (mktime(0,0,0,$mon,$day,$theYear) >= $departures[$i])
						$booked = 0;
				}
*/				


                // display the day with correct class
                if ( $weekend == 1){
                    if ( ($booked == 1 && !$start && !$end)  ) {
                        $out .= ($this->conf['markWeekends'])? '<td class="bookedWeekend'. $onRequestWeekend . '" '. $title.$onClick .'>' .
                                 '<div>'.$d .'</div></td>':'<td class="bookedDay'. $onRequestWeekend . '" '. $title . $onClick .'><div>'.$d.'</div></td>';
                    }
                    if ( ($booked == 1 && $start && !$end && !$startAndEnd)  ) {
                        $out .= ($this->conf['markWeekends'])? '<td class="bookedWeekend bookingStart'. $onRequestWeekend . '" '. $title.$onClick .'>' .
                                 '<div>'.$d .'</div></td>':'<td class="bookedDay bookingStart'. $onRequestWeekend . '" '. $title . $onClick .'><div>'.$d.'</div></td>';
                    }
					if ( $booked == 0){
						$out .= ($this->conf['markWeekends'])? '<td class="vacantWeekend"><div>' . $d . '</div></td>':'<td class="vacantDay"><div>'.$d.'</div></td>';
					}
                    if ( $booked == 1 && $end == 1 && !$startAndEnd ){
                        $out .= '<td class="bookingEnd"><div>' . $d . '</div></td>';
                    }
                    if ( $booked == 1 && $startAndEnd){
                        $out .= '<td class="bookingStartAndEnd"><div>' . $d . '</div></td>';
                    }
                }
                if ( $weekend == 0 ) {
                     if ( ($booked == 1 && !$start &&  !$end) ) {
                        $out .= '<td class="bookedDay' . $onRequest .'" '.$title . $onClick.'><div>' . $d . '</div></td>';
                    }
                     if ( ($booked == 1 && $start && !$end && !$startAndEnd) ) {
                        $out .= '<td class="bookedDay bookingStart' . $onRequest .'" '.$title . $onClick.'><div>' . $d . '</div></td>';
                    }

                    if ( $booked == 0){
                        $out .= '<td class="vacantDay"><div>' . $d . '</div></td>';
                    }

                    if ( $booked == 1 && $start == 0 && $end == 1 && !$startAndEnd){
                        $out .= '<td class="bookingEnd"><div>' . $d . '</div></td>';
                    }

                    if ( $booked == 1 && $startAndEnd){
                        $out .= '<td class="bookingStartAndEnd"><div>' . $d . '</div></td>';
                    }


                }



                if ($this->conf['startOfWeek'] == 'monday')
                if ( ( date('w', strtotime($theYear."-".$m."-".$d)) ) == 0 && $this->conf['displayMode'] == 'monthMultiRow') {
                    $out .= "</tr><tr>";
					$weekday = 0;
                }
				$weekday++;




            } //($d=1; $d <= $lengthOfMonth[$m]; $d++) day-loop

			for ($wd = 0; $wd < 8 - $weekday; $wd++) {
				$out .= '<td></td>';
			}


			$out .= '</table></table>';
		
		}
//			$out .= '</table>';
//		$out .= '</table>';
		
		return $out;
	}
	 
}

?>