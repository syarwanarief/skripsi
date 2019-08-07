<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Hasil Pencarian</title>

<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
    
    <div style="text-align:justify;width:auto; height:75px; padding:10px; text-align:center; background-color:#C00; border:1px solid #000099">

	<img src="../../../UNIVERSITASTEKNOKRAT.png" style="float:left; margin:0 3px 4px 0; width:70px; height:70px" />

	<b><font size="6" color="#000000"><br>Implementasi Web Scraping pada Mesin Pencari Jurnal</b></font></div>
</head>

<body>
<style>

.menu {
    
	float: right;
    width: 100%;
    height: 50px;
    margin: auto;
	padding-right::30px;
    border: 1px solid #543535;
	background-color:#999;
}
.sumberJurnal{
	height:1000px;
	padding:30px;
	border: 1px solid #543535;
}
.cari{
	border:1px solid #543535;
	height:100px;
	padding:20px;
}
</style>

<div class="menu">
  <nav style="float:right; padding-right:20px; padding-bottom:50px">
  <ul>
    <li><a href="http://localhost:8080/a_skripsi/"><font size="5" ><b>Home   </b></font></a>
    <a href="http://localhost:8080/a_skripsi/about.php"><font size="5" ><b>      About</b></font></a></li>
  </ul>
</nav>	
</div>

    <fieldset style="padding:40px; margin:20px">
    <form id="formCari" name="formCari" method="post">
    	Cari Jurnal Lain :
		<input name="txtCari" type="text" id="txtCari" style="width:500px; padding:5px">
        
        <input type="submit" name="submitCari" id="submitCari" value="Cari..." style="padding:5px">
           </form>
</fieldset>


 <?php
			include("simple_html_dom_helper.php");
 			if (isset($_POST['submitCari'])) {
		
				$example = $_POST['txtCari'];
				$html=file_get_html("https://scholar.google.co.id/scholar?hl=id&as_sdt=0%2C5&q=".$example);
				
				echo '<br><br>'."Judul". '<br><br>';
				//ambil judul
				foreach($html->find("div[class=gs_a]") as $judul){
				$tampilJudul=$judul->plaintext;
				echo $tampilJudul.'<br>';
				}
				
				//ambil Link
				echo '<br><br>'."Link DOwnload". '<br><br>';
				foreach($html->find("div[class=gs_or_ggsm]") as $ambilLink){
					$links = $ambilLink->find('a');
					foreach ($links as $link){
						echo '<a href='.$link->href.'></a>'.$link.'<br>';
						
						//echo '<a href="'.$linkUnduh.'"></a>';
					}
			}
  		}

             ?>

<table border="1" width="95%" style="margin-left:30px">
  <tbody>
    <tr>
      <th bgcolor="#D9D9D9">No</th>
      <th bgcolor="#D9D9D9">Judul</th>
      <th bgcolor="#D9D9D9">Penulis</th>
      <th bgcolor="#D9D9D9">Penerbit</th>
      <th bgcolor="#D9D9D9">Tahun Publish</th>
      <th bgcolor="#D9D9D9">Link Unduh</th>
    </tr>
    </tbody>
</table>
</div>
</body>
</html>