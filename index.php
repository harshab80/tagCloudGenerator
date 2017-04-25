<!DOCTYPE HTML>
<html> 
<body>
<link rel="stylesheet" href="css/design.css">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<script src="galleria/galleria-1.4.2.js"></script>
<title>Tagcloud Generator</title>
</head>

<h1 align="center" height="400"><font face="Century Gothic" color="black" size="+2">TagCloud Generator</font></h1>


<br>
<br>
<br>
<div align="center" height="200" >
<img align ="center" src="images/main_page.PNG" width="500" height="201" />
</div>
<br>
<br>
<br>

<form action="ParseResults.php" method="post" vertical-align ="central">
	<table align="center" height = "50" border="0" cellspacing="0" cellpadding="3" style="font:Verdana" >
		<tr>
	 		<td>
	 			<font face="Verdana">	 
				<input type="text" name="sterm"><br>
				</font>
			</td>
		</tr>
		<tr><td align="center">
			<font face="Arial">            
			<input type="submit" value = "Generate Tagcloud" width="50px" height="30px">
		</td></tr>
	</table>
</form>

<div class="galleria" align="right">
<?php
$filetype = '*.png';
$files = glob($filetype);
$count = count($files);
echo '<table>';
for ($i = 0; $i < $count; $i++) {
     echo '<tr><td>';          
     /*echo '<img src="'.$files[$i].'">';    */
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

<div >
<?php include("footer.html");?>
</div>

</body>
</html>