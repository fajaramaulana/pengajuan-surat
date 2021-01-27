<?php ob_start(); ?>
<html>
<head>
	<title>Cetak PDF</title>
	<style>
		table {
			border-collapse:collapse;
			table-layout:fixed;width: 630px;
		}
		table td {
			word-wrap:break-word;
			width: 20%;
		}
	</style>
</head>
<body>
<h1 style="text-align: center;">Data Siswa</h1>
<table border="1" width="100%">
<tr>
	<th>ID SURAT</th>
	<th>ASAL</th>
	<th>Perihal</th>
	<th>ID Penerima</th>
	<th>ID Pengirim</th>
</tr>
<?php
// Load file koneksi.php
include "../../system/koneksi.php";

$query = "SELECT * FROM tbl_surat_upload"; // Tampilkan semua data gambar
$sql = mysqli_query($koneksi, $query); // Eksekusi/Jalankan query dari variabel $query
$row = mysqli_num_rows($sql); // Ambil jumlah data dari hasil eksekusi $sql

if($row > 0){ // Jika jumlah data lebih dari 0 (Berarti jika data ada)
    while($data = mysqli_fetch_array($sql)){ // Ambil semua data dari hasil eksekusi $sql
        echo "<tr>";
        echo "<td>".$data['id_surat']."</td>";
        echo "<td>".$data['asal_surat']."</td>";
        echo "<td>".$data['perihal']."</td>";
        echo "<td>".$data['id_pengirim']."</td>";
        echo "<td>".$data['id_penerima']."</td>";
        echo "</tr>";
    }
}else{ // Jika data tidak ada
    echo "<tr><td colspan='4'>Data tidak ada</td></tr>";
}
?>
</table>

</body>
</html>
<?php
$html = ob_get_contents();
ob_end_clean();

require '../../html2pdf/autoload.php';

$pdf = new Spipu\Html2Pdf\Html2Pdf('P','A4','en');
$pdf->WriteHTML($html);
$pdf->Output('log_surat.pdf', 'I');
?>
