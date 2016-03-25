<?php
  session_start();
  session_register("UserIsOK_session");
  include('db/db.php');
  include('session.php');
  //include('fckeditor/fckeditor.php');
  extract($GLOBALS);

  $_SESSION['Header']=4;
  
  if (!$_SESSION['UserIsOK'])
  {
  	//$vLogedinas="You are logged in as:".$_SESSION['luser'];
  	header('Location: register_form.php');
  } 
  $vOperation=htmlspecialchars($_GET["a"]);
  $vArticle="";
  if ($vOperation.""=="e")
  {
    $vArticle=htmlspecialchars($_GET["aja"]);
	$vsql="select * from `article` ";
    $vsql=$vsql."where `id`='".$vArticle."' ";
	
	$result = $db->sql_query($vsql);
    $row = $db->sql_fetchrow($result);
    $afrow = $db->sql_affectedrows();
    if($afrow>0)
    {
      $utitle=$row["title"];
      $uarticle=$row["article"];
      $uauthor=$row["author"];
      $ucategory=$row["category"];
      $uexcerpt=$row["excerpt"];
    
    }
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
        //alert(""+Value+"");
   		if(document.getElementById(SelectName)[index].value==Value)
		{
			document.getElementById(SelectName).selectedIndex = index;
		}
   }
}

function setSubmitAction(saction)
{
   
   document.getElementById('submitaction').value=saction;
   
   return true;
}

function validate_form(theform)
{
   //alert ('Title may NOT be Blank');
   if (theform.title.value.length == 0)
   {
   		alert ('Title may NOT be Blank.');
  		return false;
   }
   if (theform.excerpt.value.length == 0)
   {
   		alert ('Please add an excerpt.');
  		return false;
   }
   if (theform.article_txt.value.length == 0)
   {
    alert (theform.article_txt.value.length+"-"+theform.article.value.length);
      if (theform.article.value.length == 0)
	  {
   		alert ('Your are trying to submit an empty article.');
  		return false;
	  }
   }
   return true;
}
</script>
<title>ArticleJar.com - Submit Article</title>
</head>

<body onload="select_value_set('category','<?php echo $ucategory ?>')">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="4"><?php include ('header.php') ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="18">&nbsp;</td>
    <td width="18">&nbsp;</td>
    <td width="696">
	<table width="100%" align="center">
	<tr>
	<td>
      <form id="submit_article" name="submit_article" method="post" onsubmit="return validate_form(this)" action="submit.php?voperation=submit">
	  <input type="hidden" id="type" name="type" value="text" />
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="3%">&nbsp;</td>
            <td width="13%">Article Title: </td>
            <td width="81%"><input type="text" name="title" size="50" value="<?php echo $utitle ?>"></td>
            <td width="3%">&nbsp;</td>
          </tr>
		  <tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  </tr>
          <tr>
            <td>&nbsp;</td>
            <td valign="top">Category:</td>
            <td>
			<?php include('category.php'); ?>
			</td>
            <td>&nbsp;</td>
          </tr>
		  <tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  </tr>
		  <tr>
		  <td>&nbsp;</td>
		  <td valign="top">Excerpt:&nbsp;</td>
		  <td><textarea name="excerpt" rows="1" cols="80"><?php echo $uexcerpt ?></textarea>&nbsp;</td>
		  <td>&nbsp;</td>
		  </tr>
		  <tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  </tr>
		  <tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  </tr>
		  <tr>
		  <td>&nbsp;</td>
		  <td valign="top">Article:</td>
		  <td>
		  <div id="txt" style="visibility:visible;height:auto"><textarea name="article_txt" id="article_txt" rows="10" cols="80"><?php echo $uarticle ?></textarea></div>
		  
		  
		  </td>
		  <td></td>
		  </tr>
		  <tr>
		  <td>&nbsp;</td>
		  <td>&nbsp;</td>
		  <td align="left">
		  	<input type="hidden" name="articleid" id="articleid" value="<?php echo $vArticle ?>" />
		  	<input type="hidden" name="submitaction" id="submitaction" />
			<?php if ($uauthor.""=="") { ?>
			<input type="submit" onclick="setSubmitAction('submit')" name="submit_article" value="Submit Article" />
			<?php }else{
			   if ($uauthor.""==$_SESSION['luemail'].""){?>
			<input type="submit" onclick="setSubmitAction('submit')" name="submit_article" value="Submit Article" />
			<input type="submit" onclick="setSubmitAction('save')" name="save_article" value="Save Article" />
			<?php   }
			}
			?>
			<?php if ($_SESSION['UserIsAdmin']) { ?>
			<input type="submit" onclick="setSubmitAction('savewait')" name="save_article" value="Save for Approval" />
			<input type="submit" onclick="setSubmitAction('saveapprove')" name="save_article" value="Save and Approve Article" />
			<?php }?>
			</td>
		  <td>&nbsp;</td>
		  </tr>
        </table>
        
      </form>  
	  </td>
	  </tr>
	  </table>
    </td>
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
