<!DOCTYPE html>
<html>
<head>
<title>
Conte XML Importer by Vitaly Soroko
</title>
<style>
header, nav, footer, section
{
text-align: center;
}
</style>
<script type="text/javascript">
function height_plus (elem, elem_height) {
        var height = elem.offsetHeight;
        if (height < elem_height) {
                elem.style.height = height + 1 + "px";
                setTimeout (function(){height_plus(elem, elem_height)}, 5);
        }
}
function Hide1 ()
{
//height_plus(document.getElementById('local_file'), 1);
document.getElementById("local_file").style.visibility = "hidden";
document.getElementById("local_file").style.height = "0px";
document.getElementById("server_file").style.visibility = "visible";
document.getElementById("server_file").style.height = "auto";
}
function Hide2 ()
{
//height_plus(document.getElementById('local_file'), 100);
document.getElementById("server_file").style.visibility = "hidden";
document.getElementById("server_file").style.height = "0px";
document.getElementById("local_file").style.visibility = "visible";
document.getElementById("local_file").style.height = "auto";
}

</script>
</head>
<body>
  <header> Conte XML Importer ver.0.1 Alpha by Vitaly Soroko</header>
  <nav> <a href="options.html"> Options </a></nav>
  <article>
    <section>
	
     <br />
	 <h1> Step 1- Select input file and press next button ... </h1>
	 
	 <p><b>Choose file location:</b></p>
	 <p><input type="radio" name="answer" value="a1" OnClick="javascript: Hide1();" checked>Existing file on server</input>
	 <input type="radio" name="answer" value="a2" OnClick="javascript: Hide2();"> On your local computer</input></p>
	 <div id="local_file" style="visibility: hidden; height: 0px;">
	 <form action="importer.php" method="post" enctype="multipart/form-data">
	 Input File: 
	 <input type="text" /> <input type="file" accept="text/xml" />
	 <br />
	 <br />
	 <input type="submit" value="Next ->" />      
	 </form>
	 </div>
	 <div id="server_file">
	 <form action="importer.php" method="post" enctype="multipart/form-data">
	 <div>
	 <b> Select existing file: </b>
	 </div>
	<br />
	 <table>
	 <tr>
         <td style="min-width: 30vw;">
	 </td>
	 <td>
	 <div id="files_from_server_list" style="margin: auto; text-align: left;">
	 <?php
  	 include_once 'controller.php';
	 $v1 = new OpenFile();
	 $v1->ListFromServer('xml_files');
	 //$v1->ListFromServer('/xmls/');
	 ?>
         </div>
	 </td>
	 </tr>
	 </table>
	 <br /> <br />
 	 <div>
	 <p>
	 <input type="submit" value="Next ->" />
	 </p>
	 </div>      
	 </form>
	 </div>
	 
	 <br />
	 <br />
    </section>
  </article>
  <footer><br/><br/><br/><br/><br/><br/><br/><br/>Conte 2014</footer>
</body>
</html>