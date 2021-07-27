<?php
			switch ($i) {
			    case 0:
				//echo "i equals 0 - only db id - no tally";
				break;
			    case 1:
				$continent_tally = $continent_tally+1;
				$td[$i] = "<td>Cont.<br> $continent_tally</td>";
				break;
			    case 2:
				$country_tally = $country_tally+1;
				$td[$i] =  "<td>Coun.<br>$country_tally</td>";
				break;
			case 3:
				$state_tally = $state_tally+1;
				$td[$i] =  "<td>State.<br>$state_tally</td>";
				break;
			case 4:
				if($thisLinksRegionalInfo[$i] != 0){
				$district1_tally = $district1_tally+1;
								$td[$i] =  "<td>Dist.1<br>$district1_tally</td>";
				}
				else
				{
				$td[$i] =  "<td>&nbsp;</td>";
				}
				break;
			case 5:
				$city_tally = $city_tally+1;
				$td[$i] =  "<td>City<br>$city_tally</td>";
				break;
			case 6:
				if($thisLinksRegionalInfo[$i] != 0){
				$district2_tally =$district2_tally+1;
								$td[$i] =  "<td>Dist.2<br>$district2_tally</td>";
				}
				else
				{
				$td[$i] =  "<td>&nbsp;</td>";
				}
				break;
			case 7:
				//echo "i equals 7 - link id - no tally";
				break;
			
			case 8:
				//echo "i equals 8 - agent_ID - no tally";
				break;
			}
?>
