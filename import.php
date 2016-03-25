<?php
  session_start();
  session_register("UserIsOK_session");
  include('db/db.php');
  extract($GLOBALS);
  if ($_SESSION['UserIsOK'])
  {
    if ($_SESSION['UserIsAdmin'])
	{
	$vLogedinas="You are logged in as:".$_SESSION['luser']."[ADMIN]";
	}
	else
	{
  	$vLogedinas="You are logged in as:".$_SESSION['luser'];
	}
  } 
  else
  {
  	$vLogedinas="You are NOT Logged on";
  }

  $vdumpfolder="dump";
  $sPath=$DOCUMENT_ROOT."./".$vdumpfolder;
  $vCode='';
  $vsCode='';

//$vloadfile=$vimagefolder."/load.txt";

function Loadall($spPath,$spCatagory)
{
  extract($GLOBALS);

  $dir = $spPath;
//    $_SESSION['Message']="".$sPath;
//    header('Location: message.php');
  //$uploadsDirVar=$sPath; //replace(sPath,"\\","\\\\")
  // $oFS is of type "Scripting.FileSystemObject"
  //$oDefSite=$sPath;

  if (is_dir($dir)) {
     echo $dir;
	if ($dh = opendir($dir)) {
		while (($file = readdir($dh)) !== false) 
		{
		    set_time_limit(500);
			$ftype = strtoupper(substr($file,strrpos($file,".")));
			if ($file =='..'){
			}else
			{
			if ($file =='.'){
			}else
			{
			if ($ftype == '.TXT'){
				$ftitle = substr($file,0,strrpos($file,"."));


				$strFilename=$DOCUMENT_ROOT.$vloadfile;

				  $oInStream=fopen($dir.'/'.$file,"r");
				  $vTmpstr="";
				
				
				  while(!feof($oInStream))
				  {
				
					$strOutput=fgets($oInStream);
					if ($vTmpstr.""=="")
					{
				
					  $vTmpstr=$strOutput;
					}
					  else
					{
				
					  $vTmpstr=$vTmpstr.$strOutput;
					} 
				
				  } 

				$vloc = strpos($vTmpstr,".");
				if ($vloc == 0)
				{
				   $vloc = 200;
				}
 			   //$vloc = 200;
//				$vCode=$vCode."<tr><td>end ex</td><td>".$vloc."&nbsp;</td></tr>";
//				$vCode=$vCode."<tr><td>file</td><td>".$file."&nbsp;</td></tr>";
//				$tmpvarticle = substr($vTmpstr,0,strpos($vTmpstr,"PPPPP"));
//				$vCode=$vCode."<tr><td>file</td><td>".$tmpvarticle."&nbsp;</td></tr>";
//				$vCode=$vCode."<tr><td>Catagory</td><td>".$spCatagory."&nbsp;</td></tr>";
//				$vCode=$vCode."<tr><td>Title</td><td>".$ftitle."&nbsp;</td></tr>";
//				$vCode=$vCode."<tr><td>Excerpt</td><td>".substr($vTmpstr,0,$vloc)."&nbsp;</td></tr>";
//				$vCode=$vCode."<tr><td>Text</td><td>".$vTmpstr."&nbsp;</td></tr>";
				//submit_article($ftitle,$vTmpstr,substr($vTmpstr,0,$vloc),$spCatagory,'jannie.pieterse@gmail.com');

			}
			else
			{
				if (is_dir($dir.'/'.$file)) 
				{
					//$vCode=$vCode."<tr><td>dir</td><td>".$file."&nbsp;</td></tr>";
					//if (strtoupper($file) == 'DOC' or strtoupper($file) == 'TXT')
					//{
						//$vCode=$vCode.Loadall($dir.'/'.$file,$spCatagory);
					//}
					//else
					//{
						$vCode=$vCode.Loadall($dir.'/'.$file,$file);
					//}
				}
				else
				{
					if ($ftype == '.ZIP222'){
						$vCode=$vCode."<tr><td>dirf</td><td>".$file."&nbsp;</td></tr>";
						$vCode=$vCode."<tr><td>dirdf</td><td>".$dir.'/'.$file."&nbsp;</td></tr>";
						$vCode=$vCode."<tr><td>dirfull</td><td>".getcwd().$dir.'/'.$file."&nbsp;</td></tr>";
						$tdir = str_replace('./','\\',$dir);
						$tdir = str_replace('/','\\',$tdir);
						$fdir = $tdir.'\\'.substr($file,0,strrpos($file,"."));
						$dirPath = getcwd().$fdir;
						$zipFile = getcwd().$tdir.'\\'.$file;
						$vCode=$vCode."<tr><td>dirx</td><td>".$zipFile."&nbsp;</td></tr>";
						$zip = zip_open($zipFile);
						$vCode=$vCode."<tr><td>mkdir1</td><td>".$dirPath."&nbsp;</td></tr>";
					    mkdir( $dirPath, '0777' );
						
						if (is_resource($zip)) {
						  while ($zip_entry = zip_read($zip)) {
						  $sentry = zip_entry_name($zip_entry);
						  
						  $hasdir = strrpos($sentry,"/");
						  if ($hasdir)
						  {
						     $snewdir = substr($sentry,0,$hasdir);
							 //$vCode=$vCode."<tr><td>newdir</td><td>".$snewdir."&nbsp;</td></tr>";
							 $snewdir = str_replace("/","\\",$snewdir);
							 if (!file_exists($dirPath."\\".$snewdir))
							 {
							     $vCode=$vCode."<tr><td>mkdir2</td><td>".$dirPath."\\".$snewdir."&nbsp;</td></tr>";
							 	 mkdir( $dirPath."\\".$snewdir, '0777' );
							 }
						  }
						  //$vCode=$vCode."<tr><td>loc</td><td>".$isdir."&nbsp;</td></tr>";
						  //$vCode=$vCode."<tr><td>len</td><td>".strlen($sentry)."&nbsp;</td></tr>";
						  //$vCode=$vCode."<tr><td>fin</td><td>".$sentry."&nbsp;</td></tr>";
						  //$vCode=$vCode."<tr><td>$zip_entry</td><td>".$zip_entry."&nbsp;</td></tr>";
						  if ($hasdir == strlen($sentry)-1) 
							{
								//$vCode=$vCode."<tr><td>dir0</td><td>".$sentry."&nbsp;</td></tr>";
								//$vCode=$vCode.Loadall($dir.'/'.$file,$file);
								//mkdir( $dirPath."\\".$sentry, '0777' );
							}
							else
							{
							//$vCode=$vCode."<tr><td>dir1</td><td>".$dirPath."&nbsp;</td></tr>";
							//$vCode=$vCode."<tr><td>dir2</td><td>".zip_entry_name($zip_entry)."&nbsp;</td></tr>";
							$sentry = str_replace("/","\\",$sentry);
							$fp = fopen($dirPath."\\".$sentry, "w");
							if (zip_entry_open($zip, $zip_entry, "r")) {
							  $buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
//							  
							  fwrite($fp,"$buf");
							  zip_entry_close($zip_entry);
							  fclose($fp);
							}
							}
						  }
						  zip_close($zip);
						  $vdirpath = str_replace("\\","/",$dirPath);
						  $fcategory = substr($file,0,strrpos($file,"."));
						  //$vCode=$vCode.Loadall($dir ."/".substr($file,0,strrpos($file,".")),$fcategory);
						  //unlink($file);
						}
						else
						{
							//$vCode=$vCode."<tr><td>Failed</td><td>".$zip."&nbsp;</td></tr>";
						}

					}
					else
					{
						//$vCode=$vCode."<tr><td>other</td><td>".$file."&nbsp;</td></tr>";
					}
				}
			}
			}
			}
		}
		closedir($dh);
	}
  }
  //$vCode=str_replace("{*vName1*}","&nbsp;",$vCode);


  //$vCode=$vCode."<tr></tr>";



  return $vCode;
}  

function submit_article($ptitle,$particle,$pexcerpt,$pcategory,$pemail)
{
  extract($GLOBALS);
    $vtitle=mysql_real_escape_string($ptitle);

	$vcategory=$pcategory;
	$varticle=str_replace("\'","'",$particle);
	$vpos = strpos($varticle,"PPPPP");
	if ($vpos)
	{
	   $varticle = substr($varticle,0,$vpos);
	}
	$varticle = mysql_real_escape_string($varticle);

	$vexcerpt = str_replace("\'","'",$pexcerpt);
    $vexcerpt = mysql_real_escape_string($vexcerpt);

    $vsql="insert into `article` (`title`,`article`,`author`,`status`,`date`,`category`,`excerpt`) ";
    $vsql=$vsql."VALUES('".$vtitle."','".$varticle."','".$pemail."','c',NOW(),'".$vcategory."','".$vexcerpt."')";

    $result = $db->sql_query($vsql);
    $vsql="update users set `user_articles`=(`user_articles` + 1),`user_active_articles`=(`user_active_articles` + 1) ";
    $vsql=$vsql."where `user_email`='".$pemail."'";
	$result = $db->sql_query($vsql);
}
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
@import "css/aj.css";
</style>
<title>ArticleJar.com</title>
</head>
<body>
<?php
 $vsCode="<table width='50' border='1' cellspacing='0' cellpadding='0'>";
 $vsCode=$vsCode.LoadAll($sPath,'');
 $vsCode=$vsCode."</table>";
 print $vsCode;
?>			
</body>
</html>
