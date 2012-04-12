<?php

/*
 * Calico (Open-Source PHP-based Davical client).  
 * Original Code: Ryan Ross, CS Department, Drexel University 2011 (Ryan.Wayne.Ross.MCSE@gmail.com).
 * Independent Study Professor: Gay Lord Holder, CS Department, Drexel University (gholder@cs.drexel.edu).
 * 
 * 
 * 
 */

class CompositeCalendar {
		// Int TypeOfView: stores the types of view {Daily, Weekly, Monthly} that the Composite Calendar is currently set to output.
		private $_typeOfView;
		// DateTimeRange CurrentSelection: stores the currently selected range of dates by the user.
		//private $_currentSelection;
		// List<Calendar> Calendars: stores the list of Calendar objects that have been successfully authenticated for this account.
		private	$_calendars;
		
		//private $_events;
		
		// Constructor for the CompositeCalendar class.
		public function __construct($typeOfView, $calendars) {
			$this->_typeOfView = $typeOfView;
			//$this->_currentSelection = $currentSelection;
			$this->_calendars = $calendars;
		
		}
		
		public function RenderPage() {
		
		}
		
		private $_daily = 0;
		private $_weekly = 1;
		private $_monthly = 2;
		
		
		// String GenerateView(): Writes the current CompositeCalendar to the page (HTML).
		public function GenerateView() {
                    
                    //@todo: Monthly, Weekly, Daily calendar GUI components. Use tables for components + event displays. Use incrementing color counter.
					//echo "Got Here.";
					//$events = Array();
					$events = Array();
					foreach($this->_calendars as $calendar)  {
						if(is_array($calendar->GetEvents())) {
							$events = array_merge($events, $calendar->GetEvents());
						}
						
						
						
						//print_r($events);
					}
					
					if($this->_typeOfView == $this->_daily) {
							echo "Generating Daily.";
							$this->GenerateDailyView($events);
					}
					else if($this->_typeOfView == $this->_weekly) {
							echo "Generating Weekly.";
							//print_r($events);
							$this->GenerateWeeklyView($events);
					}
					else {
							echo "Generating Monthly.";
							$this->GenerateMonthlyView($events);
					}
		}
                
                private function GenerateMonthlyView($events, $date) {
						
						
						//@todo: 5 weeks at a time, with the date / day of the week.
						//@todo: "week of" -> for the left side.
						
						
                        /*
                        foreach($this->_calendars as $calendar) {
                            $events[] = $calendar->GenerateView();
                            
                        }
                        */
						
						$firstdate = date_sub(DateTime::setTimestamp($date), date_interval_create_from_date_string("2 weeks " . Helper::GetIntegerDayOfTheWeekFromTimestamp($date) . " days" ));
						$lastdate = date_add(DateTime::setTimestamp($date), date_interval_create_from_date_string("2 weeks " . (7 - Helper::GetIntegerDayOfTheWeekFromTimestamp($date)) . " days" ));
						
						$dates = Array();
						
						$date = $firstdate;
						while($date < $lastdate) {
							$dates[] = $date;
							date_add(DateTime::setTimestamp($date), date_interval_create_from_date_string("1 day" ));
						}
						
						for($i = 0; i < 35; i++) {
							switch($i % 7) {
								// Sunday
								case 0:
										break;
								// Monday
								case 1:
										break;
								// Tuesday
								case 2:
										break;
								// Wednesday
								case 3:
										break;
								// Thursday
								case 4: 
										break;
								// Friday
								case 5:
										break;
								// Saturday
								case 6:
										break;
								default:
										break;
														
							}
						
						}						
                    
                    
                        echo "<table width=\"100%\" bgcolor=\"gray\">";
                        echo "<tr><td>";
                        
                        $days = Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
                        
                        $weeks = Array();
						
						
						// Weeks may not overlap properly. Review Unix style timestamps. Need a new function -> WeekOf that grabs a week according to a given date.
                        
			echo "<table width=\"100%\" bgcolor=\"blue\">";
			echo "<tr>";
			echo "<td></td>";
                        
                        foreach($days as $day) {
                            echo "<td><b>" . $day . "</b></td>";      
                        }
			echo "</tr>";
                        
                        $times = array("12 AM", "1 AM", "2 AM", "3 AM", "4 AM", "5 AM", "6 AM", "7 AM", 
                            "8 AM", "9 AM", "10 AM", "11 AM", "12 PM", "1 PM", "2 PM", "3 PM", "4 PM", "5 PM", "6 PM", "7 PM", "8 PM", "9 PM",
                            "10 PM", "11 PM");
                        
                        
                        // Insert dates instead of times here.
                        foreach ($times as $time) {
                            echo "<tr>";
                            echo "<td>" . $time . "</td>";
                            
                            //@todo: Insert events here.
                            
                            
                            echo "</tr>";
                            
                            
                        }
                        
                     
                        
                        echo "</td></tr>";
                        echo "</table>";
	
	
			//foreach()
				/*
			while($row = mysql_fetch_array($result))
			  {
				echo "<tr>";
				echo "<td>" . $row['Username'] . "</td>";
				echo "<td>" . "<a href=\"" . $row['Feed'] . "\">" . $row['Feed'] . "</a>" . "</td>";
				echo "<td>" . file_get_contents($row['Feed']) . "</td>";
				echo "</tr>";
			  }
			*/  
			echo "</table>";
                    
                }
                
                private function GenerateDailyView($events) {
                        
						
						// @todo: switch out week select control for day select control.
						// @todo: need only remove the unused days here from weekly view.
                        
                        foreach($this->_calendars as $calendar) {
                            //$events[] = $calendar->GenerateView();
                            
                        }
                    
                    
                        echo "<table width=\"100%\" bgcolor=\"gray\">";
                        echo "<tr><td>";
                        
                        $days = Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");
                        
			echo "<table width=\"100%\" bgcolor=\"blue\">";
			echo "<tr>";
			echo "<td></td>";
                        
                       
                        echo "<td><b>" . $day . "</b></td>";      
                        
			echo "</tr>";
                        
                        $times = array("12 AM", "1 AM", "2 AM", "3 AM", "4 AM", "5 AM", "6 AM", "7 AM", 
                            "8 AM", "9 AM", "10 AM", "11 AM", "12 PM", "1 PM", "2 PM", "3 PM", "4 PM", "5 PM", "6 PM", "7 PM", "8 PM", "9 PM",
                            "10 PM", "11 PM");
                        
                        
                        foreach ($times as $time) {
                            echo "<tr>";
                            echo "<td>" . $time . "Hello</td>";
                            
                            //foreach($days as $day) {
                            echo "<td>Count:" . count($events) . "</td>";
                                foreach($events as $event) {
                                    //echo "<td><input type=\"submit\" name = \"EVENT: " . GetUID() . "\" value=\"" . $event->GetSummary() . "\"/></td>";
                                }
                            //}
                            
                            
                            echo "</tr>";
                            
                            
                        }
                        
                     
                        
                        echo "</td></tr>";
                        echo "</table>";
	
	
			//foreach()
				/*
			while($row = mysql_fetch_array($result))
			  {
				echo "<tr>";
				echo "<td>" . $row['Username'] . "</td>";
				echo "<td>" . "<a href=\"" . $row['Feed'] . "\">" . $row['Feed'] . "</a>" . "</td>";
				echo "<td>" . file_get_contents($row['Feed']) . "</td>";
				echo "</tr>";
			  }
			*/  
			echo "</table>";
                    

                }
		
		public function GenerateWeeklyView($events) {
		
						echo "Inside Weekly.";
                        
						
						
						//print_r($events);
						//@todo: Globalize this nonsense. And better variable names.
                        $days = Array("Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday");                
                        
                        $times = array("12", "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11");
							
						//echo "<div>";	
						//echo "<div style=\"position:absolute;>";
						
						
						//echo "</div>";
						echo "<div class=\"standardButton\" style=\"position:relative;width:8%;z-index:3;\">" ;
						echo "<script language=\"javascript\" src=\"calendar\calendar.js\"></script>";
						require_once('calendar/classes/tc_calendar.php');
						 
						 $myCalendar = new tc_calendar("date5", true, false);
						  $myCalendar->setIcon("calendar/images/iconCalendar.gif");
						  $myCalendar->setDate(date('d'), date('m'), date('Y'));
						  $myCalendar->setPath("calendar/");
						  $myCalendar->setYearInterval(2000, 2050);
						  $myCalendar->dateAllow('2008-05-13', '2015-03-01');
						  $myCalendar->setDateFormat('j F Y');
						  $myCalendar->setAlignment('left', 'bottom');
						  $myCalendar->writeScript();

						echo "</div>";
						
						echo "<BR>";
						echo "<input class=\"standardButton\" style=\"background-image:url('arrow-left.png');background-repeat:no-repeat; background-position:left; position:relative; width:7%;\" type=\"submit\" value=\"Previous\" onmousedown=\"doSomething(event, value)\">";
						echo "<input class=\"standardButton\" style=\"background-image:url('arrow-right.png');background-repeat:no-repeat; background-position:right; position:relative; width:7%;\" type=\"submit\" value=\"Next\" onmousedown=\"doSomething(event, value)\">";
						//echo "<div style=\"position:absolute;>";
						
						//echo "</div>";
						//echo "</div>";
						//echo "<BR><BR><BR>";
						// Create Background for the Calendar.
						echo "<div style=\"z-index:1;width:100%;height:100%;\">";
						// Create Individual Time slices, and place them on top of the background.
						echo "";
						
						// Create Events, and place them on top of the slices.
						echo "";
						$buttonreturn = "&#13;";
						
						//
						
						echo "<div class=\"timeSlice\" style=\"width:1%\">*</div>";
						
						foreach($days as $day) {
							echo "<div class=\"timeSlice\" style=\"width:10%;text-align:center;\">" . $day . "</div>";
						
						}



						echo "<br>";
						
						foreach ($times as $time) {
							echo "<div class=\"timeSlice\" style=\"width:1%\">" . $time . "<span style=\"vertical-align: super;font-size:50%;\">AM</span></div>";
							
								//print_r($events);
							 foreach($events as $event) {
                                    //echo Helper::GetStringHourMeridiemTimestamp($event->GetStartdate());
									
									foreach($days as $day) {
										//echo $event . "<BR>";
										//echo print_r($event);
										
										if(Helper::GetStringDayOfTheWeekFromTimestamp($event->GetStartdate()) == $day) {
										   echo "<input class=\"standardButton\" type=\"submit\" name = \"EVENT: " . $event->GetUID() . "\" value=\"" . Helper::GetStringTimeNice($event->GetStartdate()) . $buttonreturn . Helper::GetStringTimeNice($event->GetEnddate()) . $buttonreturn . $event->GetSummary() . "\"/>";
										}
									}
									
                                }
							
							echo "<br>";
						}
						
						foreach ($times as $time) {
							echo "<div class=\"timeSlice\"  style=\"width:1%\">" . $time . "<span style=\"vertical-align: super;font-size:50%;\">PM</span></div>";
							
							echo "<br>";	
						}
						
							
                       /* 
                        foreach ($times as $time) {
                           
                            
                            
                            foreach($days as $day) {
                              
                                //$buttonreturn = "&#10;";
                                //echo "<td>Count:" . count($events) . "</td>";
                                foreach($events as $event) {
                                    //echo Helper::GetStringHourMeridiemTimestamp($event->GetStartdate());
									
									/*
                                    if(Helper::GetStringDayOfTheWeekFromTimestamp($event->GetStartdate()) == $day && Helper::GetStringHourMeridiemTimestamp($event->GetStartdate()) == $time) {
                                       echo "<input type=\"submit\" name = \"EVENT: " . $event->GetUID() . "\" value=\"" . Helper::GetStringTimeNice($event->GetStartdate()) . $buttonreturn . Helper::GetStringTimeNice($event->GetEnddate()) . $buttonreturn . $event->GetSummary() . "\"/>";
                                    }
									*/
                                //}
                          
                              
                            //}
                            
                            
                           
                            
                            
                        //}
						
						
                        
                     echo "</div>";
                        
                       
		
		}
		
		// Void SelectView(int TypeOfView): Selects a new view i.e. was Weekly, now is Monthly.
		public function SelectView($typeOfView) {
			$this->typeOfView = $typeOfView;
		}
		
		
		/*
		// Void AddCalendar(Calendar calendar): adds the Calendar to the list of Calendars to composite.
		public function AddCalendar($calendar) {
			//$_calendars[$calendar->ID()] = $calendar;
		}

		// @todo: fix this, as PHP is a pain in the ass. Need to get the key before I can remove it, I think.
		public function RemoveCalendar($calendar) {
			//unset($_calendars [$calendar->ID()]);
		}
		*/
		/*
		
		public function AddEvent($event) {
		
		}
		
		public function RemoveEvent($event) {
		
		}
		
		public function EditEvent($event) {
		
		} 

*/		
                
}

// Calendar class: a Data class that holds a list of feeds and information relating to this calendar.
class Calendar {
	// DateTime StartDate of this Calendar.
	private $_startdate;
	// DateTime EndDate for this Calendar.
	private $_enddate;
	// List<Feed> Feeds: stores the list of Feed objects that have been successfully authenticated for this account.
	public $_feeds;
	// String Name: the name associated with this Calendar.
	private $_name;
	// GUID id: id for this Calendar in the database.
	private $_id;
	
	public function ID() {
		return _id;
	}
	
	
	// Constructor for the Calendar class.
	public function __construct($name) {
			//$this->_typeOfView = $typeOfView;
			//$this->_currentSelection = $currentSelection;
			//$this->_feeds = $feeds;
            $this->_name = $name;
			
			//echo "Constructor -> Calendar";
			$this->GetFeeds();
		
	}
	
	
	public function GetEvents() {
		//$events = Array();
		
		//print_r($this->_feeds);
		
		
			$events = Array();
			foreach($this->_feeds as $feed) {
				if(is_array($feed->GetEvents())) {
					$events = array_merge($events, $feed->GetEvents());
				}
				
				
			}
		
	
		return $events;
	}
	
	public function GetFeeds() {
		$con_feeds = mysql_connect("localhost","root","mysql");
		if (!$con_feeds)
		  {
		  die('Could not connect: ' . mysql_error());
		  }

		mysql_select_db("calico", $con_feeds);

		$result = mysql_query("SELECT Username, Password, Feed FROM Feeds WHERE Calendar = '" . $this->_name . "'");
		//print_r($result);
		while($row = mysql_fetch_array($result)) {
			//echo $row["Feed"] . "A Row.";
			$this->_feeds[] = new Feed($row["Username"], $row["Password"], $row["Feed"], "1");
				
		}
		//echo "Inside GetFeeds()";
		mysql_close($con_feeds);
	
	}
        
        public function GetCalendarName() {
            return $this->_name;
        }
	
	// List<Event> GenerateView(): Gets all the events the CompositeCalendar object will need, based off of the information provided.
	public function GenerateView() {
	}
		
	// Void SelectView(int TypeOfView): Selects a new view i.e. was Weekly, now is Monthly.
	public function SelectView($typeOfView) {
		$this->typeOfView = $typeOfView;
	}
	
	/*
	public function AddEvent($event) {
		
	}
		
	public function RemoveEvent($event) {
		
	}
		
	public function EditEvent($event) {
		
	}
	
	*/

}

class Feed {
	// String Username: stores the username for the feed.
	private $_username;
	// String Password: stores the password for the feed.
	private $_password;
	// String URL: stores the URL for the feed.
	private $_url;
	// GUID id: id for this Feed in the database.
	private $_uid;
	// List<Event> Events: Events associated with this feed.
	private $_events;
        private $_server;
        
        public $Create = 0;
        public $Update = 1;
        public $Delete = 2;
        
        
        
        
        // strlen() for content-length.
        public function CreateHeaders($type, $event) {
            echo "Creating Headers<BR>";
            // Going to need the following headers no matter what.
            // Basically, they are copied from the requests that SunBird sends to the server,
            // so we know they work, and are good. 
            // I wouldn't recommend editing them unless you know what you are doing, and have backups.
            // Getting these required some voodoo, using an untrusted SSL cert, and a proxy built specifically for debugging.
            // Fiddler was the proxy, in case you want to try your hand at the art.
            $headers = array("User-Agent" => "Calico",
            "Accept" => "text/xml",
            "Host" => $this->_server,
            "Pragma" => "no-cache",
            "Cache-Control" => "no-cache",
            "Accept-Language" => "en-us,en;q=0.5",
            "Accept-Encoding" => "gzip,deflate",
            "Accept-Charset" => "utf-8,*;q=0.1",
            "Keep-Alive" => "300",
            "Connection" => "keep-alive"
            );                 
            
            // Going to need this if it's a Create request (creating a new event).
            if($type == $this->Create) {
                $headers["If-None-Match"] = "*";           
            }
             
            // Going to need this for an Update request (editing an existing event).
            // It tells the server to check if the 'etag' we are giving it is the latest version, and to perform the update if it matches.
            // An 'etag' is essentially for versioning, so you are sure you are editing the latest version of an event.
            if($type == $this->Update) {      
                $headers["If-Match"] = $event->GetETag();
            }   
             
           $headers["Content-type"] = "text/calendar";
            echo "Finished Headers<BR>";       
            return $headers;
        }
        
        
        public function CreateBody($type, $event) {
            echo "Entering Body<BR>";
            
            $body = "BEGIN:VCALENDAR\r\n";
            $body .= "PRODID:-//Mozilla.org/NONSGML Mozilla Calendar V1.1//EN\r\n";
            $body .= "VERSION:2.0\r\n"; 
            
            // The VTimezone section is supposedly thrown out by Davical. #Daviccal, irc.oftc.net
            $body .= "BEGIN:VTIMEZONE\r\n";
            $body .= "TZID:America/New_York\r\n";
            $body .= "X-LIC-LOCATION:America/New_York\r\n";
            $body .= "BEGIN:DAYLIGHT\r\n";
            $body .= "TZOFFSETFROM:-0500\r\n";
            $body .= "TZOFFSETTO:-0400\r\n";
            $body .= "TZNAME:EDT\r\n";
            $body .= "DTSTART:19700308T020000\r\n";
            $body .= "RRULE:FREQ=YEARLY;BYDAY=2SU;BYMONTH=3\r\n";
            $body .= "END:DAYLIGHT\r\n";     
            $body .= "BEGIN:STANDARD\r\n";
            $body .= "TZOFFSETFROM:-0400\r\n";
            $body .= "TZOFFSETTO:-0500\r\n";
            $body .= "TZNAME:EST\r\n";
            $body .= "DTSTART:19701101T020000\r\n";
            $body .= "RRULE:FREQ=YEARLY;BYDAY=1SU;BYMONTH=11\r\n";
            $body .= "END:STANDARD\r\n";           
            $body .= "END:VTIMEZONE\r\n"; 
            
            $body .= $event->ToVEvent(); 
            
            $body .= "END:VCALENDAR";
            
            
            
            echo "Exiting Body<BR>";
            
            return $body;
        }

	// Constructor for the Feed class.
	public function __construct($username, $password, $url, $id) {
			$this->_username = $username;
			$this->_password = $password;
			$this->_url = $url;
			$this->_id = $id;
                        
                        $urlinfo = parse_url($url);
                        $this->_server = $urlinfo["host"];
                        
	}
        
        
        
        //@todo: XML parsing of response to get eTag and other stuff.
        
        public function ParseResponse($httpresponse, $type) {
            $xml = new SimpleXMLElement($httpresponse);
            
           $responsesnodes = $xml->xpath("multistatus/response");
           
           $etags = array ();
           foreach($responsesnodes as $responsenode) {
               $hrefnode = $responsenode->xpath("href");
               
               $etagnode = $responsenode->xpath("propstat/prop/getetag");
               
               $etags[$hrefnode[0]] = $etagnode[0];
               
               
           }
            
        }
        
        // I loving refer to this function as "3 hours." I'll let you contemplate why.
        public function Propfind() {
            
            $data = "";
            $fp = fsockopen("127.0.0.1", 8888, $errno, $errstr);
            //$fp = fsockopen("ssl://" . $this->_server, 443, $errno, $errstr);
            if (!$fp) {
                echo "$errstr ($errno)<br />\n";
            } 
            else {                                                          
                $out = "PROPFIND " . $this->_url . " HTTP/1.1\r\n";
                $out .= "Host: " . $this->_server . "\r\n";
                $out .= "User-Agent: Calico\r\n";
                $out .= "Accept: text/xml\r\n";
                $out .= "Accept-Language: en-us,en;q=0.5\r\n";
                $out .= "Accept-Encoding: gzip,deflate\r\n";
                $out .= "Accept-Charset: utf-8,*;q=0.1\r\n";
                $out .= "Keep-Alive: 300\r\n";
                $out .= "Connection: keep-alive\r\n";
                $out .= "Content-Type: text/xml; charset=utf-8\r\n";
                $out .= "Depth: 2\r\n";
                $out .= "Authorization: Basic " . Base64UsernamePassword() . "\r\n";
                $out .= "Pragma: no-cache\r\n";
                $out .= "Cache-Control: no-cache\r\n";
                $out .= "Connection: Close\r\n\r\n";
                
                fwrite($fp, $out);
                while (!feof($fp)) {
                    $data .= fgets($fp);
                }
                fclose($fp);
                
                $xml = substr($data, strpos($data, "<?xml version=\"1.0\" encoding=\"utf-8\" ?>"), strlen($data));
                
                return $xml;
            }                     
        }
		
		
		public function Report() {
            
            $data = "";
            $fp = fsockopen("127.0.0.1", 8888, $errno, $errstr);
            //$fp = fsockopen("ssl://" . $this->_server, 443, $errno, $errstr);
            if (!$fp) {
                echo "$errstr ($errno)<br />\n";
            } 
            else {                                                          
                $out = "REPORT " . $this->_url . " HTTP/1.1\r\n";
                $out .= "Host: " . $this->_server . "\r\n";
                $out .= "User-Agent: Calico\r\n";
                $out .= "Accept: text/xml\r\n";
                $out .= "Accept-Language: en-us,en;q=0.5\r\n";
                $out .= "Accept-Encoding: gzip,deflate\r\n";
                $out .= "Accept-Charset: utf-8,*;q=0.1\r\n";
                $out .= "Keep-Alive: 300\r\n";
                $out .= "Connection: keep-alive\r\n";
                $out .= "Content-Type: text/xml; charset=utf-8\r\n";
                $out .= "Depth: 1\r\n";
                $out .= "Authorization: Basic " . Base64UsernamePassword() . "\r\n";
                $out .= "Pragma: no-cache\r\n";
                $out .= "Cache-Control: no-cache\r\n";
				$out .= "\r\n"
				// @todo: Need to make this part work. Will need to restructure the classes, as we will be getting some information in a different order than we expected.
				$out .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
				$out .= "<calendar-multiget xmlns:D=\"DAV:\" xmlns=\"urn:ietf:params:xml:ns:caldav\">";
				$out .= "<D:prop>";
				$out .= "<D:getetag/>";
				$out .= "<calendar-data/>";
				$out .= "</D:prop>";
				$out .= "<D:href>" . $url . "</D:href>";
				$out .= "</calendar-multiget>";
				
				
				
				
				
                $out .= "Connection: Close\r\n\r\n";
				
				
                
                fwrite($fp, $out);
                while (!feof($fp)) {
                    $data .= fgets($fp);
                }
                fclose($fp);
                
                $xml = substr($data, strpos($data, "<?xml version=\"1.0\" encoding=\"utf-8\" ?>"), strlen($data));
                
                return $xml;
            }                     
        }
        
        
        public function Delete($event) {
        
            $data = "";        
            $fp = fsockopen("127.0.0.1", 8888, $errno, $errstr);
            //$fp = fsockopen("ssl://" . $this->_server, 443, $errno, $errstr);
            if (!$fp) {
                echo "$errstr ($errno)<br />\n";
            } 
            else { 
            
                $out = "DELETE " . $url . $event->GetUID() + ".ics" . " HTTP/1.1\r\n";
                $out .= "Host: " . $this->_server . "\r\n";
                $out .= "User-Agent: Calico\r\n" ;
                $out .= "Accept: text/xml\r\n";
                $out .= "Accept-Language: en-us,en;q=0.5\r\n";
                $out .= "Accept-Encoding: gzip,deflate\r\n";
                $out .= "Accept-Charset: utf-8,*;q=0.1\r\n";
                $out .= "Keep-Alive: 300\r\n";
                $out .= "Connection: keep-alive\r\n";
                $out .= "If-Match: \"" . $event->_etag . "\"\r\n";
                $out .= "Authorization: Basic " . Base64UsernamePassword() . "\r\n";
                $out .= "Pragma: no-cache\r\n";
                $out .= "Cache-Control: no-cache\r\n";
                $out .= "Connection: Close\r\n\r\n";

                fwrite($fp, $out);
                while (!feof($fp)) {
                    $data .= fgets($fp);
                }
                fclose($fp);         
            }
        }
        
        private function Base64UsernamePassword() {
            return base64_encode($this->_username . ":" . $this->_password);
            
        }
        
        public function GetNewUniqueID() {
            $isnew = true;
            $newid = uniqid("", true);
            do {
                foreach ($this->_events as $event) {
                    if($event->GetUID() == $newid) {
                        $isnew = false;
                        $newid = str_replace(".", "", uniqid("", true));
                        
                    }

                }
            } while($isnew == false);
            
            return $newid;
        }
        
        
        public function Put($type, $event) {
            $request = null;
            
            echo "Inside Put.<BR>";
            if($type == $this->Create) {
                
                $event->SetUID($this->GetNewUniqueID());
                $request = new Http_Request2($this->_url . $event->GetUID() . ".ics", HTTP_Request2::METHOD_PUT);
                echo "Going with a Create.<BR>";
            }
            else {
                $request = new Http_Request2($this->url . $event->GetUID() . ".ics", HTTP_Request2::METHOD_PUT);
                echo "Going with a Update.<BR>";
            }
            echo "Working on authentication.<BR>";
            
            $request->setAuth($this->_username, $this->_password, HTTP_Request2::AUTH_BASIC);
            $request->setConfig(array(
               "ssl_verify_peer"=>false, 
               "ssl_verify_host"=>false,
               "follow_redirects"=>true,
                "proxy_host"=>"127.0.0.1",
                "proxy_port"=>8888
            ));
            
            $request->setHeader($this->CreateHeaders($type, $event));
            $request->setBody($this->CreateBody($type, $event));
            echo $request->getBody();
            echo $request->getHeaders();
            echo "Sending.<BR>";
            try {
                $response = $request->send();
                echo "Result: " . $response->getBody();
            }
            catch (HTTP_Request2_Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }

        }
        
        public function GetEvents() {
            //$this->_events = array ();
            
            $datatable = $this->GetDataTableFeed();
            
            $begin = $this->FindEventBeginInDatatable($datatable);
            $end = $this->FindEventEndInDatatable($datatable);
            
            if(count($begin) == count($end)) {
                for($i = 0; $i < count($begin); $i++) {
                    $this->_events[] = new Event($this->GetEventArray($begin[$i], $end[$i], $datatable));
                    
                
                }
                
            }
            
            return $this->_events;
            
        }
        
        public function GetEventArray($begin, $end, $datatable) {
            $eventarray = array (); 
            for($i = $begin; $i < $end + 1; $i++) {
                $row = $datatable[$i];
                
                //echo $row[0] . "=>" . $row[1] . "<BR>";
                $eventarray[$row[0]] = $row[1];   
            }
            //echo "<BR>";
            //echo print_r($eventarray);
            
            return $eventarray;
            
        }
        
        public function FindEventBeginInDatatable($datatable) {
            
            $begin = array ();
            for($i = 0; $i < count($datatable); $i++) {
                if($datatable[$i][0] == "BEGIN" && $datatable[$i][1] == "VEVENT") {
                    $begin[] = $i;
                }
                
                
            }
            
            return $begin;
            
        }
        
        
        public function FindEventEndInDatatable($datatable) {
            
            $end = array ();
            for($i = 0; $i < count($datatable); $i++) {
                if($datatable[$i][0] == "END" && $datatable[$i][1] == "VEVENT") {
                    $end[] = $i;
                }
                
                
            }
            
            return $end;
            
        }
     
	
	// Ryan's magical parser. Having tried a number of other methods, I am going with something slightly less than clever here.
	public function GetDataTableFeed() {
                $request = new Http_Request2($this->_url, HTTP_Request2::METHOD_GET);
                $request->setAuth($this->_username, $this->_password, HTTP_Request2::AUTH_BASIC);
                $request->setConfig(array(
                   "ssl_verify_peer"=>false, 
                   "ssl_verify_host"=>false,
                   "follow_redirects"=>true,
                    "proxy_host"=>"localhost",
                    "proxy_port"=>8888
                ));
                $data = "";
                
                try {
                    $response = $request->send();
                    $data = $response->getBody();
                }
                catch (HTTP_Request2_Exception $e) {
                    echo 'Error: ' . $e->getMessage();
                }
                
                
                
		//$data = file_get_contents($this->_url, false, $context);
                //echo $this->_url;
                //echo "Echoing Data:" + $data;
                $datatable = array();
                
		// Go through the feed, line by line. We might be able to do better, but parsing this file is proving somewhat insane.
                
                $i = 0;
                
                $data = str_replace("\r\n ", "", $data);
                $data = str_replace("\\n", "\n", $data);
                $data = str_replace("\\N", "\n", $data);
                $data = str_replace("\,", ",", $data);
                $data = str_replace("\\\"", "\"", $data);
                $data = str_replace("\;", ";", $data);
                $data = str_replace("\\\\", "\\", $data);
                //$data = stripslashes($data);
                
                
                //echo "<TABLE>";
		foreach(preg_split("/\r\n/", $data) as $line){
                        //echo $line . "<BR>";
                        $colon = strpos($line, ":");
                        $semicolon = strrpos($line, ";");                   
                        
                        $index = $colon;        
                        
                        if($semicolon != null && $semicolon < $colon) {
                            
                           $index = $semicolon;
                           
                        }
                   
                        if($index != null) {
                            //echo  "<TR><TD>" . $i . "</TD><TD>Key: " . substr($line, 0, $index) . "</TD><TD>Value:" . substr($line, $index + 1, strlen($line)) . "</TD></TR>";
                            //echo "<TR><TD>" . $line . "</TD></TR>";
                            $i = $i + 1;
                            $datarow = array (substr($line, 0, $index), substr($line, $index + 1, strlen($line)));
                            $datatable[] = $datarow;
                        }
                    
			
                }
                //echo "</TABLE>";
                //print_r($datatable);
                return $datatable;
                
	}
	
	public function AddEvent($event) {
            echo "Got to Add Event<BR>";
            echo "Got to Add Event 2<BR>";
            $this->Put($this->Create, $event);
            echo "Leaving Add Event<BR>";
	}
		
	public function RemoveEvent($event) {	
            $this->Put($this->Delete, $event);
	}
		
	public function EditEvent($event) {
            $this->Put($this->Update, $event);
	}

}

class Helper {
    
                // Takes a Timestamp, and returns an Integer.
                static public function GetIntegerDayOfTheWeekFromTimestamp($timestamp) {
                    $dw = date("w", $timestamp);   
                    return $dw;
                }
                
                static public function GetIntegerDayOfTheYear($timestamp) {
                    $dy = date("z", $timestamp);    
                    return $dy;
                }
                
                static public function GetIntegerMinutesFromTimestamp($timestamp) {
                    $mins = date("i", $timestamp);   
                    return $mins;
                }
                
                static public function GetIntegerHoursFromTimestamp($timestamp) {
                    $hours = date("G", $timestamp);   
                    return $hours;
                }
                
                static public function GetIntegerSecondsFromTimestamp($timestamp) {
                    $secs = date("i", $timestamp);   
                    return $secs;
                }
                
                // Rakes a Timestamp, and returns a String.
                static public function GetStringDayOfTheWeekFromTimestamp($timestamp) {
                    $dw = date("l", $timestamp);         
                    return $dw;                                        
                }
                
                static public function GetStringMonthFromTimestamp($timestamp) {
                    $m = date("F", $timestamp);         
                    return $m; 
                    
                }
                
                static public function GetStringHourMeridiemTimestamp($timestamp) {
                    $hm = date("g A", $timestamp);         
                    return $hm; 
                    
                }
                
                static public function GetStringTimeNice($timestamp) {
                    $hm = date("g:i a", $timestamp);         
                    return $hm; 
                    
                }
                
                static public function GetIntegerMonthFromTimestamp($timestamp) {
                    $m = date("n", $timestamp);         
                    return $m; 
                    
                }
                
                static public function GetIntegerDaysInMonthFromTimestamp($timestamp) {
                    $day = date("t", $timestamp);         
                    return $day; 
                    
                }
                
                static public function GetUTCFormattedStringFromTimestamp($timestamp) {                  
                    return gmdate("Ymd\THis\Z", $timestamp);
                }
                
                static public function GetFormattedStringFromTimestamp($timestamp) {                  
                    return date("Ymd\THis", $timestamp);
                }
                
                static public function GetUTCTimestampFromTimestamp($timestamp) {
                    $datetime = new DateTime();
                    $datetime->setTimestamp($timestamp); 
                    
                    return $datetime->getTimestamp();
                }
                
                static public function GetTimestampFromUTCTimestampAndTimezone($timestamp, $timezone) {
                    $datetime = new DateTime();
                    $datetime->setTimestamp($timestamp);
                    $datetime->setTimezone(new DateTimeZone($timezone));
                    
                    return $datetime->getTimestamp();
                }
                                              
                
                

}

class Event {
        private $_creationdate;
        private $_lastmodified;      
	// String Description: stores the description associated with this event.
        private $_description;
	private $_summary;
	// UID ID: stores the unique id associated with this event. 
	private $_uid;
	// DateTime StartDate: stores the start date of this event.
	private $_startdate;
	// DateTime EndDate: stores the end date of this event.
        private $_dtstamp;
        
        private $_timezone;
	private $_enddate;
	
	private $_rrule;
        private $_etag;
        private $_location;
	
        
        // LOL. No multiple constructors for you in PHP.
	public function __construct($array = null) {
               if($array == null) {
                   
                   return;
                   
               }
                  if(array_key_exists("CREATED", $array)) { 
                    $this->_creationdate = strtotime($array["CREATED"]);
                    //echo "Created:" . $array["CREATED"];
                  }
                  
                  if(array_key_exists("LAST-MODIFIED", $array)) {
                    $this->_lastmodified = strtotime($array["LAST-MODIFIED"]);
                  }
                  if(array_key_exists("DTSTAMP", $array)) {
                    $this->_dtstamp = strtotime($array["DTSTAMP"]);
                  }
                  if(array_key_exists("SUMMARY", $array)) {
                    $this->_summary = $array["SUMMARY"];
                  }
                  
                  if(array_key_exists("DTSTART", $array)) {
                      $dateinfo = $array["DTSTART"];
                      $colon = strpos($dateinfo, ":");                 
                      $equalsign = strpos($dateinfo, "=");
                      $this->_startdate = strtotime(substr($dateinfo, $colon + 1, strlen($dateinfo)));
                      
                      //echo "Colon:" . $colon . "<BR>";
                      $this->_timezone = substr($dateinfo, $equalsign + 1, $colon - $equalsign - 1);
                  }
                  
                  if(array_key_exists("DTEND", $array)) {   
                    $dateinfo = $array["DTEND"];
                    $colon = strpos($dateinfo, ":");
                    $equalsign = strpos($dateinfo, "=");
                    $this->_enddate = strtotime(substr($dateinfo, $colon + 1, strlen($dateinfo)));
                  }
                  
                  if(array_key_exists("UID", $array)) {
                    $this->_uid = $array["UID"];
                  }
                  
                  if(array_key_exists("RRULE", $array)) {
                    $this->_rrule = $array["RRULE"];
                  }
                  
                  if(array_key_exists("LOCATION", $array)) {
                    $this->_location = $array["LOCATION"];
                  }
                  
                  
               
		
	}

    // Create an Event from an array filled with values.
    public function FromArray() {
    }
        
        public function SetCreationdate($timestamp) {
            $this->_creationdate = $timestamp;
        }
        
        public function SetLastModified($timestamp) {
            $this->_lastmodified = $timestamp;
        }
        
        public function SetDatestamp($timestamp) {
            $this->_dtstamp = $timestamp;
        }
        
        public function SetUID($id) {
            $this->_uid = $id;
        }
        
        public function GetUID() {
            
            return $this->_uid;
        }
        
        public function GetETag() {
            return $this->_etag;
        }
        
        public function SetETag($etag) {
            $this->_etag = $etag;
        }
        
        public function SetSummary($str) {
            $this->_summary = $str;
        }
        
        public function GetSummary() {
            return $this->_summary;
        }
        
        public function SetDescription($str) {
            $this->_description = $str;
        }
        
        public function SetStartdate($timestamp) {
            $this->_startdate = $timestamp;
            
        }
        
        public function GetStartdate() {
            return $this->_startdate;
            
        }
        
        public function SetEnddate($timestamp) {
            $this->_enddate = $timestamp;
            
        }
        
        public function GetEnddate() {
            return $this->_enddate;
            
        }
        
        public function SetTimeZone($timezone) {
            $this->_timezone = $timezone;
        }
        
        public function GetLocation() {
            return $this->_location;
        }
        
        public function SetLocation($loc) {
            $this->location = $loc;
        }
        
        public function GetRRule() {
            return $this->_rrule;
        }
        
        public function SetRRule($rule) {
            $this->_rrule = $rule;
        }
        
        
       
        // Like a ToString() function, but formats it as a VEVENT.
       public function ToVEvent() {
            
            $vevent = "BEGIN:VEVENT\r\n";
            $vevent .= "CREATED:" . Helper::GetUTCFormattedStringFromTimestamp($this->_creationdate) . "\r\n";
            $vevent .= "LAST-MODIFIED:" . Helper::GetUTCFormattedStringFromTimestamp($this->_lastmodified) . "\r\n";
            $vevent .= "DTSTAMP:" . Helper::GetUTCFormattedStringFromTimestamp($this->_dtstamp) . "\r\n";
            echo "Going in:" . $this->_dtstamp . "<BR>";
            $vevent .= "UID:" . $this->_uid . "\r\n";
            $vevent .= "SUMMARY:" . $this->_summary . "\r\n";
            if($this->_rrule != null && $this->_rrule != "") {
                $vevent .= "RRULE:" . $this->_rrule . "\r\n";
            }
            
            $vevent .= "DTSTART;TZID=" . $this->_timezone . ":" . Helper::GetFormattedStringFromTimestamp($this->_startdate) . "\r\n";
            $vevent .= "DTEND;TZID=" . $this->_timezone . ":" . Helper::GetFormattedStringFromTimestamp($this->_enddate) . "\r\n";
            echo "Verify: " . $this->_enddate . "<BR>";
            
            if($this->_location != null && $this->_location != "") {
                $vevent .= "LOCATION:" . $this->_location . "\r\n";
            }
            if($this->_description != null && $this->_description != "") {
                $vevent .= "DESCRIPTION:" . $this->_description . "\r\n";
            }
            $vevent .= "END:VEVENT\r\n";
            
           
           
           return $vevent;             
       }
}

?>