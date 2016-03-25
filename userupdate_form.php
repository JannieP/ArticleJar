<?php
  session_start();
  session_register("UserIsOK_session");
  include('db/db.php');
  include('session.php');

  extract($GLOBALS);

  $_SESSION['Header']=6;
  $_SESSION['UserTab']=2;
  
  if ($_SESSION['UserIsOK'])
  {
  	$vemail = $_SESSION['luemail'];

    $vsql="select * from users where upper(user_email)=";
    $vsql=$vsql."'".strtoupper($vemail)."' ";
    
    if( !($result = $db->sql_query($vsql)) )
    {
        $vmessage="User Data Retrieval Failed";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
    }

    $row = $db->sql_fetchrow($result);
    $afrow = $db->sql_affectedrows();
    if($afrow>0)
    {
      $upwd=$row["user_password"];
      $ufname=$row["user_firstname"];
      $ulname=$row["user_lastname"];
      $ucountry=$row["user_country"];
      $uurl=$row["user_weburl"];
      $uheard=$row["user_howheard"];
      $uadsense=$row["user_adsense_pub_id"];
	  $uchannel=$row['user_adsense_channel'];
    
    }
    else
    {
        $vmessage="User Data Retrieval Failed";
        $_SESSION['Message']="".$vmessage;
        header('Location: message.php');
    }

  	
  } 
  else
  {
  	$vLogedinas="You are NOT Logged on";
    $_SESSION['Message']="".$vLogedinas;
    header('Location: message.php');
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">@import "css/aj.css";</style>
<script language="javascript">
function select_value_set(SelectName,Value)
{
   //alert ("TEST");
   //eval ('SelectObject = document.'+SelectName+';');
   for (index=0;index<document.getElementById(SelectName).length;index++)
   {
   		if(document.getElementById(SelectName)[index].value==Value)
		{
			document.getElementById(SelectName).selectedIndex = index;
		}
   }
}
</script>
<title>ArticleJar.com - Update</title>
</head>
<body onload="select_value_set('country','<?php echo $ucountry ?>'); select_value_set('how','<?php echo $uheard; ?>');">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4"><?php include ('header.php') ?><?php include ('usertabs.php') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="18">&nbsp;</td>
    <td width="144">&nbsp;</td>
    <td width="570">
	<form id="register1" name="register" method="post" action="update.php?voperation=update">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="3%">&nbsp;</td>
          <td width="21%">Email Address: </td>
          <td width="73%"><?php echo $vemail; ?><input type="hidden" name="emailaddress" value="<?php echo $vemail; ?>" /> </td>
          <td width="3%">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Password:</td>
          <td><input type="password" name="password" size="20" value=""></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Confirm Password:</td>
          <td><input type="password" name="confirmpassword" size="20" value=""></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>First Name: </td>
          <td><input type="text" name="firstname" size="50" value="<?php echo $ufname; ?>"></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Last Name </td>
          <td><input type="text" name="lastname" size="50" value="<?php echo $ulname; ?>"></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Country</td>
          <td>
            <select name="country" id="country" size="1" >
              <option>Afghanistan</option>
              <option>&Aring;land Islands</option>
              <option>Albania</option>
              <option>Algeria</option>
              <option>American Samoa</option>
              <option>Andorra</option>
              <option>Angola</option>
              <option>Anguilla</option>
              <option>Antarctica</option>
              <option>Antigua and Barbuda</option>
              <option>Argentina</option>
              <option>Armenia</option>
              <option>Aruba</option>
              <option>Australia</option>
              <option>Austria</option>
              <option>Azerbaijan</option>
              <option>Bahamas</option>
              <option>Bahrain</option>
              <option>Bangladesh</option>
              <option>Barbados</option>
              <option>Belarus</option>
              <option>Belgium</option>
              <option>Belize</option>
              <option>Benin</option>
              <option>Bermuda</option>
              <option>Bhutan</option>
              <option>Bolivia</option>
              <option>Bosnia and Herzegovina</option>
              <option>Botswana</option>
              <option>Bouvet Island</option>
              <option>Brazil</option>
              <option>British Indian Ocean territory</option>
              <option>Brunei Darussalam</option>
              <option>Bulgaria</option>
              <option>Burkina Faso</option>
              <option>Burundi</option>
              <option>Cambodia</option>
              <option>Cameroon</option>
              <option>Canada</option>
              <option>Cape Verde</option>
              <option>Cayman Islands</option>
              <option>Central African Republic</option>
              <option>Chad</option>
              <option>Chile</option>
              <option>China</option>
              <option>Christmas Island</option>
              <option>Cocos (Keeling) Islands</option>
              <option>Colombia</option>
              <option>Comoros</option>
              <option>Congo</option>
              <option>Congo, Democratic Republic</option>
              <option>Cook Islands</option>
              <option>Costa Rica</option>
              <option>C&ocirc;te d'Ivoire (Ivory Coast)</option>
              <option>Croatia (Hrvatska)</option>
              <option>Cuba</option>
              <option>Cyprus</option>
              <option>Czech Republic</option>
              <option>Denmark</option>
              <option>Djibouti</option>
              <option>Dominica</option>
              <option>Dominican Republic</option>
              <option>East Timor</option>
              <option>Ecuador</option>
              <option>Egypt</option>
              <option>El Salvador</option>
              <option>Equatorial Guinea</option>
              <option>Eritrea</option>
              <option>Estonia</option>
              <option>Ethiopia</option>
              <option>Falkland Islands</option>
              <option>Faroe Islands</option>
              <option>Fiji</option>
              <option>Finland</option>
              <option>France</option>
              <option>French Guiana</option>
              <option>French Polynesia</option>
              <option>French Southern Territories</option>
              <option>Gabon</option>
              <option>Gambia</option>
              <option>Georgia</option>
              <option>Germany</option>
              <option>Ghana</option>
              <option>Gibraltar</option>
              <option>Greece</option>
              <option>Greenland</option>
              <option>Grenada</option>
              <option>Guadeloupe</option>
              <option>Guam</option>
              <option>Guatemala</option>
              <option>Guinea</option>
              <option>Guinea-Bissau</option>
              <option>Guyana</option>
              <option>Haiti</option>
              <option>Heard and McDonald Islands</option>
              <option>Honduras</option>
              <option>Hong Kong</option>
              <option>Hungary</option>
              <option>Iceland</option>
              <option>India</option>
              <option>Indonesia</option>
              <option>Iran</option>
              <option>Iraq</option>
              <option>Ireland</option>
              <option>Israel</option>
              <option>Italy</option>
              <option>Jamaica</option>
              <option>Japan</option>
              <option>Jordan</option>
              <option>Kazakhstan</option>
              <option>Kenya</option>
              <option>Kiribati</option>
              <option>Korea (north)</option>
              <option>Korea (south)</option>
              <option>Kuwait</option>
              <option>Kyrgyzstan</option>
              <option>Lao People's Democratic Republic</option>
              <option>Latvia</option>
              <option>Lebanon</option>
              <option>Lesotho</option>
              <option>Liberia</option>
              <option>Libyan Arab Jamahiriya</option>
              <option>Liechtenstein</option>
              <option>Lithuania</option>
              <option>Luxembourg</option>
              <option>Macao</option>
              <option>Macedonia, Former Yugoslav Republic Of</option>
              <option>Madagascar</option>
              <option>Malawi</option>
              <option>Malaysia</option>
              <option>Maldives</option>
              <option>Mali</option>
              <option>Malta</option>
              <option>Marshall Islands</option>
              <option>Martinique</option>
              <option>Mauritania</option>
              <option>Mauritius</option>
              <option>Mayotte</option>
              <option>Mexico</option>
              <option>Micronesia</option>
              <option>Moldova</option>
              <option>Monaco</option>
              <option>Mongolia</option>
              <option>Montenegro</option>
              <option>Montserrat</option>
              <option>Morocco</option>
              <option>Mozambique</option>
              <option>Myanmar</option>
              <option>Namibia</option>
              <option>Nauru</option>
              <option>Nepal</option>
              <option>Netherlands</option>
              <option>Netherlands Antilles</option>
              <option>New Caledonia</option>
              <option>New Zealand</option>
              <option>Nicaragua</option>
              <option>Niger</option>
              <option>Nigeria</option>
              <option>Niue</option>
              <option>Norfolk Island</option>
              <option>Northern Mariana Islands</option>
              <option>Norway</option>
              <option>Oman</option>
              <option>Pakistan</option>
              <option>Palau</option>
              <option>Palestinian Territories</option>
              <option>Panama</option>
              <option>Papua New Guinea</option>
              <option>Paraguay</option>
              <option>Peru</option>
              <option>Philippines</option>
              <option>Pitcairn</option>
              <option>Poland</option>
              <option>Portugal</option>
              <option>Puerto Rico</option>
              <option>Qatar</option>
              <option>R&eacute;union</option>
              <option>Romania</option>
              <option>Russian Federation</option>
              <option>Rwanda</option>
              <option>Saint Helena</option>
              <option>Saint Kitts and Nevis</option>
              <option>Saint Lucia</option>
              <option>Saint Pierre and Miquelon</option>
              <option>Saint Vincent and the Grenadines</option>
              <option>Samoa</option>
              <option>San Marino</option>
              <option>Sao Tome and Principe</option>
              <option>Saudi Arabia</option>
              <option>Senegal</option>
              <option>Serbia</option>
              <option>Seychelles</option>
              <option>Sierra Leone</option>
              <option>Singapore</option>
              <option>Slovakia</option>
              <option>Slovenia</option>
              <option>Solomon Islands</option>
              <option>Somalia</option>
              <option>South Africa</option>
              <option>South Georgia and the South Sandwich Islands</option>
              <option>Spain</option>
              <option>Sri Lanka</option>
              <option>Sudan</option>
              <option>Suriname</option>
              <option>Svalbard and Jan Mayen Islands</option>
              <option>Swaziland</option>
              <option>Sweden</option>
              <option>Switzerland</option>
              <option>Syria</option>
              <option>Taiwan</option>
              <option>Tajikistan</option>
              <option>Tanzania</option>
              <option>Thailand</option>
              <option>Togo</option>
              <option>Tokelau</option>
              <option>Tonga</option>
              <option>Trinidad and Tobago</option>
              <option>Tunisia</option>
              <option>Turkey</option>
              <option>Turkmenistan</option>
              <option>Turks and Caicos Islands</option>
              <option>Tuvalu</option>
              <option>Uganda</option>
              <option>Ukraine</option>
              <option>United Arab Emirates</option>
              <option>United Kingdom</option>
              <option>United States of America</option>
              <option>Uruguay</option>
              <option>Uzbekistan</option>
              <option>Vanuatu</option>
              <option>Vatican City</option>
              <option>Venezuela</option>
              <option>Vietnam</option>
              <option>Virgin Islands (British)</option>
              <option>Virgin Islands (US)</option>
              <option>Wallis and Futuna Islands</option>
              <option>Western Sahara</option>
              <option>Yemen</option>
              <option>Zaire</option>
              <option>Zambia</option>
              <option>Zimbabwe</option>
            </select> 
			
	       </td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>Web Url </td>
          <td><input type="text" name="url" size="50" value="<?php echo $uurl; ?>"></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><p>Adsense<br />
            Publisher ID:</p>
            </td>
          <td><input type="text" name="adsense_id" size="50" value="<?php echo $uadsense; ?>"/></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><p>Adsense<br />
            Channel:</p>
            </td>
          <td><input type="text" name="adsense_channel" size="50" value="<?php echo $uchannel; ?>"/></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>How did you hear about Us?</td>
          <td>            
		    <select name="how" id="how" size="1">
              <option>Search Engin</option>
              <option>A Friend</option>
              <option>Website</option>
            </select>		  </td>
          <td>&nbsp;</td>
        </tr>
		<tr>
		<td>&nbsp;</td>
		<td>
			<input type="submit" name="submit_register" value="Update" />	    </td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		</tr>
      </table>

	  </form></td>
    <td width="18">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body>
</html>