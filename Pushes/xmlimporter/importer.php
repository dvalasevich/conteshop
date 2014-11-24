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
	 <h1> Step 2 - Verification of chosen file </h1>
	 
	 
	 <b>You have selected the following file:</b><br /><br />
	 <?php
	 print_r($_POST['u1000']);
	 ?>
	 <br /><br />
	 <b>Verification status:</b><br /><br />
	 <?php
	 include_once 'controller.php';
	 $v1 = new TestFile();
	 $v1->VerifyFile('xml_files/'.$_POST['u1000']);
	 ?>
	 
	 <form action="calculator.php" method="post" enctype="multipart/form-data">
	 <br />
	 <?php 
	 print  '<input type="hidden" name="file" value="'.$_POST['u1000'].'">';
	 ?>
	 <input type="button" value="<- Back" OnClick="javascript: history.go(-1);" /> &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp
	 <input type="submit" value="Calculate ->" /><br />
	 </form>
	 
	 
    </section>
  </article>
  <footer><br /> <br /><br/><br/><br/>
	 
	 <br/><br/><br/>Conte 2014</footer>
</body>
</html>
