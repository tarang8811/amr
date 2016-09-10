<?php
require_once("auth.php");
include "query.php";


if (isset($_GET["print"])) {
	$id = $_GET["selected_id"];
	$passenger_name = $_GET["name"];
	updateTableWithId("passenger_data", $id, ["name"], [$passenger_name]);

	$flight_date = searchWithoutCondition("passenger_data", [], 'id', $id);
	$flight_data = $flight_date['result'][0];
	$name = $flight_date['result'][0]['name'];

	$modified_name_array = array();
	array_push($modified_name_array, $name);

}else{
	$number_of_passenger = $_GET['number_of_passenger'];

$name = $_GET['name'];
$flight_data = $_GET['flight_data'];


$modified_name_array = array();
for ($i = 0; $i < count($name); $i++) { 
	$params = array();
	if (strlen($name[$i]) > 0) {
		array_push($modified_name_array, $name[$i]);
		$params = [ "name" => $name[$i],
					"flight_name" => $flight_data["flight_name"],
					"flight_number" => $flight_data["flight_number"],
					"origin" => $flight_data["origin"],
					"destination" => $flight_data["destination"],
					"price" => $flight_data["price"],
					"time" => $flight_data["time"],
					"time_arr" => $flight_data["time_arr"],
					"PNR" => $flight_data["PNR"],
					"booked_by" => $member_name,
				  ];
		if (!isset($_GET['updated'])) {
			insert("passenger_data",$params);
		}
		
	}
}

$updated_number_of_passenger = (int)$number_of_passenger - count($modified_name_array);

	if ($updated_number_of_passenger  == 0) {
	echo deleteColumnWithId("flight_data", $flight_data["id"]);
	}else{
	/*echo*/ updateColumnWithId("flight_data", $flight_data["id"], "number_of_passenger", $updated_number_of_passenger);
	}
}





?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<script language="JavaScript" type="text/javascript" src="JSLib/Utils.js"></script>

<script language="JavaScript" src="prototype.js" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript">
function ClosePop()
{            
    window.close();
}
</script>

<script language="JavaScript" type="text/javascript">
<!--

/* The actual print function */

function prePrint()
{
    document.getElementById('Print').style.display="none";
    document.getElementById('Print1').style.display="none";
    document.getElementById('home').style.display="none";
   // document.getElementById('worldspanPrint').style.display="none";
	window.print();
	setTimeout('showAllButtons()',500);
	
	
}


function showAllButtons()
{
    document.getElementById('Print').style.display="block";
	document.getElementById('Print1').style.display="block";
	document.getElementById('home').style.display="block";
}

</script>
<html xmlns="http://www.w3.org/1999/xhtml">
<head id="Head1"><title>
	E Ticket
</title>    
    <script src="ash.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/print.css" /></head>
<body>
    <form name="form1">

<div>

	<input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="8DAC0812" />
</div>
        
        
        <table id="container" cellspacing="0" cellpadding="10">
            
            <tr>
                  
                    <td class="fleft padding-top-10" style="width:80%;">
                        <input id="Print" onclick="prePrint()" type="button" value="Print Ticket" />
                    </td> 

                    <td class="fleft padding-top-10" style="width:100%;">
                        <a id="home" href="index.php">Home<a/>
                    </td> 
            </tr>
		<tr>
			<td>
				<table id="header" cellspacing="0" cellpadding="0">
					    <tr valign="top">
						<td class="width_230">
							<div id="agency" class="fleft">
							
								  <span style="font-size:15px ; font-weight:bold">A M R Tours & Travels</span> 
							</div>
						</td>
						<td class="width_330">
							<div id="ticket_desc">
								<h1>
								    
								    E - Ticket
								    
								</h1> 
								
								<h3>PNR :&nbsp;<?php echo $flight_data['PNR'];?>
                                        
                            </h3> 
                            
                            <h4 style="font-size : 130%">Issued Date : <?php echo date('l, jS F Y');?></h4>			  
							</div>
						</td>
						<td class="width_230" rowspan="2">
							<div id="address">
							     
							   
							     <span>Panjabi Para Siliguri</span>
								<span></span>
								<span>Siliguri 734001</span>
								
								<span> Phone : 9832302122</span>
								
								
							</div>
						</td>
					</tr>
						<tr>
					    <td colspan="2">
					        <table width="400px" style="font-size:13px; margin-left:0px;" cellpadding="3" cellspacing="2" border="0">
					            <tr>
					                <td colspan="2" style="font-weight:bold; font-size:16px;">
					               
                                      
                                       
					                </td>
					            </tr>
					            <tr>
					                <td style="font-size:15px; font-weight:bold;">Passenger Name</td>
					            </tr>
					           
					           <?php 

					           		foreach ($modified_name_array as $name) {
					           			echo '<tr>
					                			<td>' . $name . '</td>
					             
					                
					            				</tr>';
					           		}

					           ?>
					            
					        </table>
					      </td>
					 </tr>
					
					
			   </table>
			</td>
		</tr>
		<!-- Ticket details table begins -->	
			
			<tr>
			
				<td>
				<table class="fleft width_666" border="0" cellspacing="0" cellpadding="0" style="width:100%;">
					<tr>
						<td>
							<table class="flight_desc" border="0" cellspacing="0" cellpadding="0" style="width:100%;" >
								<tr>
									<td class="width_163"><div class="flight_day"><?php 
									echo date("D, jS M Y", strtotime($flight_data['date']));
									?></div></td>
									<td class="width_324"><div class="flight_name"><?php echo $flight_data['flight_name'] . " " . $flight_data['flight_number'];?></div></td>
									<td class="width_163">
									<div class="flight_ref">
									    
								     </div>
                                                                                    
                                        <div class="flight_ref">
                                            Status : Confirmed
                                        </div>                                        
								     </td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table class="width_630" border="0" cellspacing="0" cellpadding="5" style="width:10%;">
								<tr>
									<td class="width_50"><div class="from">From:</div></td>
									<td class="width_460">
										<div class="departure_stn">
											<?php echo $flight_data['origin']; ?>
											</span>
										</div>
									</td>
									<td class="width_120"><div class="departure_time">Dep: <?php echo $flight_data['time']; ?></div></td>
								</tr>
								
								<tr>
									<td class="width_50"><div class="to">To:</div></td>
									<td class="width_460">
										<div class="arrival_stn">
											<?php echo $flight_data['destination']; ?>
											</span>
										</div>
									</td>
									<td class="width_120"><div class="arrival_time">Arr: <?php echo $flight_data['time_arr']; ?></div></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table class="flight_profile" border="0" cellspacing="0" cellpadding="0" style="width:100%; padding:5px;">
								<tr>
									<td class="width_50"><span>
									PN Class</span></td>
									<td class="width_80">
									
									    <span>
									        0:55 Hours Flight
									    </span>
									
									</td>
									<td class="width_60">
									    <span>
									        
                                                    Non stop
                                                
									    </span>
									</td>
									<td class="width_90">
									
                                                    
                                                           <span>
                                                           Baggage: 15 Kg
                                                           </span>
                                                                                                            
                                                           <span>
                                                           Excess Baggage: 0 Kg
                                                           </span>
                                                                                                     
									</td>
									
									<td class="width_90">
								                                                
                                              
                                                                <span>Meal: 0 Platter
                                                            
                                                                </span>                                               
                                               
                                               
									</td>	
									<td class="width_90">
									
                                                  </span>                                               
                                               
                                     
									</td>									
																		
									<td class="width_50">
									<span>
									
									</span>
									</td>									
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table class="partition"><tr><td></td></tr></table>
						</td>
					</tr>
					<tr>
	
			    
			</tr>
				</table>
				</td>
			</tr>
			
	               
               
             
   
   
   
     
	
		
		<tr>
			<td>
				<table class="special_note">
					<tr>
						<td class="note" width="250" >
							<h4>
								<b style="padding:0px;">
								    
								        This is an electronic ticket. Please carry a positive identification for check in.
							        
                                  </b>
							</h4>
						</td>
                        
						   <td class="width_240">
							<table class="total_amount" border="0" cellspacing="0" cellpadding="0">

								
								<tr>
									<td class=""><span>Total Air Fare:</span></td>
									
									    <td class="width_120"><span>Rs. <?php echo $flight_data['price']; ?></span></td>
									
								</tr>
								
							</table>
							
						</td>
						
					</tr>
				</table>
			</td>
		</tr>
		
		<script type="text/javascript">ticketId='17514831'</script>
            
            <tr>
                <td>
                    <div style="margin-top: 4px">
                    </div>
                </td>
            </tr>
            		
		<tr>
			<td class="fleft">
				<div id="footer" style="width:100%;">
				
				<div id="showad" style="text-align:center">
                
 			   

               
                 
               
                </div>
                  
                  
           
				    <p style="margin-top:2px; text-align:justify;">
					    Carriage and other services provided by the carrier are subject to conditions of carriage which hereby incorporated by reference. These conditions may be obtained from the issuing carrier. If the passenger's journey involves an ultimate destination or stop in a country other than country of departure the Warsaw convention may be applicable and the convention governs and in most cases limits the liability of carriers for death or personal injury and in respect of loss of or damage to baggage.
				    </p>
				    
		           		 
				    <p style="width:100%; color:red; padding:3px 0px; font-weight:bold; ">
				    
				    
				    </p>			
				<div id="showTBOAd">
                      
                      </div>
			    </div>
			</td>
		</tr>      
                    
		<tr>
           <td class="fleft" style="width:100%;border-top:solid 1px #000;">
                <input class="fleft button-width margin-top-5 margin-left-15 padding-left-20" id="Print1" onclick="prePrint()" type="button" value="Print Ticket" />
                 
 <span id="Errordiv" style="margin-top:10px; margin-left:5px;color:Red;display:none"></span>
           </td>                                
        </tr>        
		
	</table>
	<span id="LowerEmailSpan" class="fleft" style="background: none repeat scroll 0 0 #FFFFED;display: block;margin-left: 15px;width: 190px;">                       
        </span>
        <div id="emailBlock" class="width-200" style="border: 1px solid;padding-left: 15px;display:none;">
                        <div class="fleft border-y width-200" style="position:absolute; left:340px; top:180px;">
                            <div class="fright text-right padding-5 width-190 light-gray-back">
                                <img alt="Close" onclick="HideEmailDiv()" src="Images/close.gif" /></div>
                          
                        </div>
                    </div>
                    
          <span id="SendSMSSpan" class="fleft" style="margin-left: 15px;">                       
        </span>                 
     
     
     
    </form>
    
   
</body>
</html>
