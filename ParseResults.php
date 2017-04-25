<html>
<body background = 'blue'>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<script src="galleria/galleria-1.4.2.js"></script>

<div width="70%">
<table>
<tr>
<td>

<INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);">

<?php
$command = "python GenTagCloud.py ";
//$command = "C:\Python27\python.exe GenTagCloud.py";
$command .= " \"";
$command .= $_POST["sterm"];
$command .= "\"";
$search_term = $_POST["sterm"];
$filename = "TagCloud_";
$filename .= str_replace(' ', '_', $_POST["sterm"]);;
$filename .= ".png";

//echo $filename;

//echo $_POST["sterm"];
//echo "<br/>";
//echo $command;
// header('Content-Type: text/html; charset=utf-8');
// echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
 echo "<style type='text/css'>
  body{
  background:#FFF;
//  color: #7FFF00;
//  font-family:'Lucida Console',sans-serif !important;
//  font-size: 12px;
  }
  </style>";
 
$pid = popen( $command,"r");
echo $command; 
echo "<br />";
echo $pid;
 
echo "<body><pre>";
while( !feof( $pid ) )
{
 echo fread($pid, 256);
 flush();
 ob_flush();
 echo "<script>window.scrollTo(0,99999);</script>";
 usleep(100000);
}
pclose($pid);

//echo "<div align='center'><font face='Century Gothic' color='black' size='+2'>  TagCloud generated for $search_term</font></div>";

echo "<p class='pageheading'>  TagCloud generated for \"$search_term\"</p>";


// echo "<p class='centeredImage'> <img src='TagCloud.png',border=1></p>"; 

echo "<p class='centeredImage'> <img src='$filename',border=1></p>"; 
echo "</pre><script>window.scrollTo(0,99999);</script>";

?>
</div>
</td>
</tr>
</table>
<table>
<tr>
<td>
<div class="galleria" align="top" width="30%">
<?php
$filetype = '*.png';
$files = glob($filetype);
$count = count($files);
echo '<table>';
for ($i = 0; $i < $count; $i++) {
     echo '<tr><td>';     
     echo '<img src="'.$files[$i].'", title="'.$files[$i].'">';    
     echo '</td></tr>';
 }
echo '</table>';
?>

 
  </div>


<script>
    Galleria.loadTheme('galleria/themes/classic/galleria.classic.js');
    Galleria.run('.galleria');
</script>

<style>
    .galleria{ width: 400px; height: 350px; background: #000; position:"left"}
</style>
</td>
</tr>
</table>

<div>
<?php include("footer.html");?>
</div>
</body>
</html>