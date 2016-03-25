<?php
/*
Plugin Name: Post-From-Txt
Plugin URI: www.articlejar.com
Description: Scrapes txt files and post content
Version: 1.0
Author: c0nan
Author URI: http://mimeye.com
*/

class WPTxtPoster
{

  $Version="1.0";
  $vdumpfolder="dump";
  $sPath=$DOCUMENT_ROOT."./".$vdumpfolder;
  $vCode='';
  $vsCode='';

   function WPTxtPoster()
   {
   	global $wpdb, $wp_version;

    # Are we running the new admin panel (2.5+) ?
    $this->newadmin = version_compare($wp_version, '2.5.0', '>=');
 
    # Is installed ?
    $this->installed = get_option('wptft_version');
    $this->setup = get_option('wptft_setup');

    # Actions
    add_action('activate_post-from-txt/post-from-txt.php', array(&$this, 'activate'));        # Plugin activated
    add_action('deactivate_post-from-txt/post-from-txt.php', array(&$this, 'deactivate'));    # Plugin deactivated
    add_action('init', array(&$this, 'init'));                                                # Wordpress init      
    #add_action('admin_head', array(&$this, 'adminHead'));                                    # Admin head
    #add_action('admin_footer', array(&$this, 'adminWarning'));                               # Admin footer
    add_action('admin_menu', array(&$this, 'adminMenu'));                                    # Admin menu creation            

   }

   /**
    * Called when plugin is activated 
    *
    *
    */ 
   function activate($force_install = false)
   {
     global $wpdb;
	 add_option('wptft_version', $this->version, 'Installed version log');
	 $this->installed = true;
   }

   /**
    * Called when plugin is deactivated 
    *
    *
    */
   function deactivate()
   {    
   }       

   /**
    * Called when blog is initialized 
    *
    *
    */
   function init() 
   {
   } 

   /**
    * Executes the current section method.
    * 
    *
    */
   function admin()
   {                       
      this->adminHome();
   }


   /**
    * Adds the post-from-txt item to menu 
    *           
    * 
    */
   function adminMenu()
   {
     add_submenu_page('options-general.php', 'Post-From-Txt', 'Post-From-Txt', 10, basename(__FILE__), array(&$this, 'admin'));
   }                    

   /**
    * Home section
    *
    *
    */
   function adminHome()
   {                                   
     echo 'Post-From-Txt Admin';
     alert('home');
   }      

   /**
    * Called by cron.php to update the site
    *
    *
    */     
   function runCron()
   {
     $this->processAll();
   }   

  
   /**
    * Processes all 
    *
    */
   function processAll()
   {
     @set_time_limit(0);
     this->LoadAll($sPath,'');
   }


function Loadall($spPath,$spCatagory)
{

  $dir = $spPath;

  if (is_dir($dir)) {
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
				alert('Posted');
				#submit_article($ftitle,$vTmpstr,substr($vTmpstr,0,$vloc),$spCatagory,'jannie.pieterse@gmail.com');

			}
/*			else
			{
				if (is_dir($dir.'/'.$file)) 
						$vCode=$vCode.Loadall($dir.'/'.$file,$file);
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
							 $snewdir = str_replace("/","\\",$snewdir);
							 if (!file_exists($dirPath."\\".$snewdir))
							 {
							     $vCode=$vCode."<tr><td>mkdir2</td><td>".$dirPath."\\".$snewdir."&nbsp;</td></tr>";
							 	 mkdir( $dirPath."\\".$snewdir, '0777' );
							 }
						  }
						  if ($hasdir == strlen($sentry)-1) 
							{
							}
							else
							{
							$sentry = str_replace("/","\\",$sentry);
							$fp = fopen($dirPath."\\".$sentry, "w");
							if (zip_entry_open($zip, $zip_entry, "r")) {
							  $buf = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
							  fwrite($fp,"$buf");
							  zip_entry_close($zip_entry);
							  fclose($fp);
							}
							}
						  }
						  zip_close($zip);
						  $vdirpath = str_replace("\\","/",$dirPath);
						  $fcategory = substr($file,0,strrpos($file,"."));
						}
						else
						{
						}

					}
					else
					{
					}
				}
			}*/
			}
			}
		}
		closedir($dh);
	}
  }

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


} //End class WPTxtImport  
?>