<?php
namespace WSR\Myflat\ViewHelpers;

/**
 * This file is part of the "myflat" Extension for TYPO3 CMS.
 *
 * For the full license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */


use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;


class MultiRowCalendarViewHelper extends AbstractViewHelper {
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
    * @param array $arguments 
    * @param \Closure $renderChildrenClosure
    * @param RenderingContextInterface $renderingContext
    * @return string
    */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
		$year = (int) $arguments['year'];
		$theYear = $year;
        
		$bookings = $arguments['bookings'];
		$settings = $arguments['settings'];
		
		$startOfYear = mktime(0, 0, 0, 1, 1, $year);
        if ($settings['displayOnlyPresentAndFutureMonths']) {
			$endOfYear = mktime(0, 0, 0, 12, 31, $year + 1);
		} else {
			$endOfYear = mktime(0, 0, 0, 12, 31, $year);
		}			
	
		for ($i = 0; $i < count($bookings); $i++) {
			
			$arrival = $bookings->toArray()[$i]->getArrival()->getTimestamp();
			$departure = $bookings->toArray()[$i]->getDeparture()->getTimestamp();
			if ( ($arrival > $startOfYear && $arrival < $endOfYear) || ($departure > $startOfYear && $departure < $endOfYear)) {
				$arrivals[$i] = $arrival;
				$departures[$i] = $departure;
				
			}		
			
		}	
	
	
		if (isset($arrivals)) {
			sort($arrivals);
			sort($departures);
		}

        $lengthOfMonth = array (1 => 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);

        if (!$year)
		$theYear = date('Y', time());

//		$out = $theYear;

		$conf['calendarColumns'] = 2;
		$column = 1;
		$conf['displayMode'] = 'monthMultiRow';
		$conf['showDaysShortcuts'] = 1;
		$conf['startOfWeek'] = 'monday';
		$conf['markWeekends'] = 1; 

            if ($settings['displayOnlyPresentAndFutureMonths'] && $year == date('Y', time())) {
				$firstMonth = date('n', time());
				$numberOfYears = 2;
			} else {
				$firstMonth = 1;
				$numberOfYears = 1;
			}
            $out = '';

			for ($myYear = $year; $myYear < $year + $numberOfYears; $myYear++) {
				if ($myYear > $year) $firstMonth = 1;
				$theYear = $myYear;

                // leap year calculating....
                if ( date("L", mktime(0,0,0,1,1,$myYear)) == 1) {
                    $lengthOfMonth[2] = 29;
                }

			// month loop
            for ($m = $firstMonth; $m < 13; $m++) {
			$out .= '<table class="monthMultiRow">';
                // adding leading zero
                $mon = ($m < 10) ? '0'. $m : $m ;


                if ( $conf['displayMode'] == 'monthMultiRow' ) {
                    if ($column-1 % $conf['calendarColumns'] == 0)
                        $out.= '<tr>';
                        $out .= '<td class="monthMultiRow"><table class="tableMultiRow"><tr><td class="monthNameMultiRow" colspan="7">'.
						$settings['monthLabels'][$m - 1] . ' ' .$theYear .
//						(date("M", strtotime($theYear."-".$mon."-01"))).
						'</td></tr>';
                        if ( $conf['showDaysShortcuts'] == 1 ) {
                            // display the daynames
                            $out .= '<tr>';
                            $out .= ($conf['startOfWeek'] == 'sunday')? '<td class="dayNames">'.('Sun').'</td>':'';
                            $out .=
                            '<td class="dayNames">'. $settings['dayLabels'][0].'</td><td class="dayNames">'.$settings['dayLabels'][1].
                            '</td><td class="dayNames">'.$settings['dayLabels'][2].'</td><td class="dayNames">'.$settings['dayLabels'][3].
                            '</td><td class="dayNames">'.$settings['dayLabels'][4].'</td><td class="dayNames">'.$settings['dayLabels'][5];
                            $out .= ($conf['startOfWeek'] == 'monday')?'</td><td class="dayNames">'.$settings['dayLabels'][6].'</td></tr>':'</td></tr>';
                        }
                }

                // calculating the left spaces to get the layout right
                if ( $conf['displayMode'] != 'monthSingleRow' )
                    $out .= '<tr>';
                $wd = date('w', strtotime($theYear."-".$m."-"."1"));
                if ($conf['startOfWeek'] == 'monday') {
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
            $weekday = 0;
            $onClick = '';
            $title = '';
            $onRequestWeekend = '';
            
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
				if (is_array($arrivals ?? 0)) {
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
                        $out .= ($conf['markWeekends'])? '<td class="bookedWeekend'. $onRequestWeekend . '" '. $title.$onClick .'>' .
                                 '<div>'.$d .'</div></td>':'<td class="bookedDay'. $onRequestWeekend . '" '. $title . $onClick .'><div>'.$d.'</div></td>';
                    }
                    if ( ($booked == 1 && $start && !$end && !$startAndEnd)  ) {
                        $out .= ($conf['markWeekends'])? '<td class="bookedWeekend bookingStart'. $onRequestWeekend . '" '. $title.$onClick .'>' .
                                 '<div>'.$d .'</div></td>':'<td class="bookedDay bookingStart'. $onRequestWeekend . '" '. $title . $onClick .'><div>'.$d.'</div></td>';
                    }
					if ( $booked == 0){
						$out .= ($conf['markWeekends'])? '<td class="vacantWeekend"><div>' . $d . '</div></td>':'<td class="vacantDay"><div>'.$d.'</div></td>';
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
                        $out .= '<td class="bookedDay" . ' . $title . $onClick.'><div>' . $d . '</div></td>';
                    }
                     if ( ($booked == 1 && $start && !$end && !$startAndEnd) ) {
                        $out .= '<td class="bookedDay bookingStart' . '" '. $title . $onClick.'><div>' . $d . '</div></td>';
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

                if ($conf['startOfWeek'] == 'monday')
                if ( ( date('w', strtotime($theYear."-".$m."-".$d)) ) == 0 && $conf['displayMode'] == 'monthMultiRow') {
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
		} // year loop
		
		return $out;
	}
	 
}

?>