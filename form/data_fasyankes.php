<?php
/* Database connection start */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_kemenkes";

$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());

/* Database connection end */


// storing  request (ie, get/post) global array to a variable
$requestData= $_REQUEST;


$columns = array(
// datatable column index  => database column name
	0 => 'id_fasyankes',
    1 => 'kode_fasyankes',
	2 => 'nama_fasyankes',
	3 => 'tipe',
    4 => 'nama_prov',
    5 => 'nama_kab',
    6 => 'kode_fas_old',
    7 => 'rumpun_sdmk'
);

// getting total number records without any search
$sql = "SELECT a.kode_prov, a.nama_prov, b.kode_kab, b.nama_kab, c.* FROM tb_fasyankes AS c
                                  INNER JOIN tb_prov AS a USING(kode_prov)
                                  INNER JOIN tb_kab_kota AS b USING(kode_kab)";
$query=mysqli_query($conn, $sql) or die("data_fasyankes.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT a.kode_prov, a.nama_prov, b.kode_kab, b.nama_kab, c.* FROM tb_fasyankes AS c
                                      INNER JOIN tb_prov AS a USING(kode_prov)
                                      INNER JOIN tb_kab_kota AS b USING(kode_kab)";
	$sql.=" WHERE kode_fasyankes LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR nama_fasyankes LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR nama_prov LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR nama_kab LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR tipe LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR kode_fas_old LIKE '".$requestData['search']['value']."%' ";
	$query=mysqli_query($conn, $sql) or die("data_fasyankes.php: get PO");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("data_fasyankes.php: get PO"); // again run query with limit

} else {

	$sql = "SELECT a.kode_prov, a.nama_prov, b.kode_kab, b.nama_kab, c.* FROM tb_fasyankes AS c
                                      INNER JOIN tb_prov AS a USING(kode_prov)
                                      INNER JOIN tb_kab_kota AS b USING(kode_kab)
                                      ";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."  ";
	$query=mysqli_query($conn, $sql) or die("data_fasyankes.php: get PO");

}

$data = array();
$no = $requestData['start'] + 1;
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array();

    $nestedData[] = '<center>'.$no++.'</center>';
    $nestedData[] = '<span class="text-center">'.$row['kode_fasyankes'].'</span>';
    $nestedData[] = $row["nama_fasyankes"];
	$nestedData[] = $row["tipe"];
	$nestedData[] = $row["nama_prov"];
    $nestedData[] = $row["nama_kab"];
    $nestedData[] = $row["kode_fas_old"];
    $nestedData[] = '<td>
                         <center>
                             <a href="#edit_fasyankes" data-toggle="modal" data-id="'.$row['id_fasyankes'].'" style="font-size:12px;text-decoration:none;"><span class="label label-warning">Edit data</span></a>
                             <a href="function/delete.php?aksi=del_fasyankes&id_fasyankes='.$row['id_fasyankes'].'" style="font-size:12px;text-decoration:none;"><span class="label label-warning">Delete data</span></a>
                         </center>
                     </td>';

	$data[] = $nestedData;

}

$json_data = array(
			"draw"            => intval( $requestData['draw'] ),   // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
			"recordsTotal"    => intval( $totalData ),  // total number of records
			"recordsFiltered" => intval( $totalFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
			"data"            => $data   // total data array
			);

echo json_encode($json_data);  // send data as json format

?>
