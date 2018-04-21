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
	0 => 'id_sdm',
    1 => 'nama',
	2 => 'jenis_kelamin',
	3 => 'status_kepegawaian',
    4 => 'nama_prov',
    5 => 'nama_kab',
    6 => 'nama_unit',
    7 => 'rumpun_sdmk',
    8 => 'jenis_sdmk',
    9 => 'strata_pendidikan',
    10 => 'program_studi'
);

// getting total number records without any search
$sql = "SELECT * ";
$sql.=" FROM tb_sdm";
$query=mysqli_query($conn, $sql) or die("data_sdm.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT * ";
	$sql.=" FROM tb_sdm";
	$sql.=" WHERE nama LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR id_sdm LIKE '".$requestData['search']['value']."%' ";
	$sql.=" OR status_kepegawaian LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR nama_prov LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR nama_kab LIKE '".$requestData['search']['value']."%' ";
	$query=mysqli_query($conn, $sql) or die("data_sdm.php: get PO");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("data_sdm.php: get PO"); // again run query with limit

} else {

	$sql = "SELECT * ";
	$sql.=" FROM tb_sdm";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("data_sdm.php: get PO");

}

$data = array();
$no = $requestData['start'] + 1;
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array();

    $nestedData[] = '<center>'.$no++.'</center>';
    $nestedData[] = '<center>'.$row['id_sdm'].'</center>';
    $nestedData[] = $row["nama"];
	$nestedData[] = '<center>'.$row["jenis_kelamin"].'</center>';
	$nestedData[] = $row["status_kepegawaian"];
    $nestedData[] = $row["nama_prov"];
    $nestedData[] = $row["nama_kab"];
    $nestedData[] = $row["nama_unit"];
    $nestedData[] = $row["rumpun_sdmk"];
    $nestedData[] = $row["jenis_sdmk"];
    $nestedData[] = $row["strata_pendidikan"];
    $nestedData[] = $row["program_studi"];
    $nestedData[] = '<td>
                         <center>
                             <a href="#edit_sdm" data-toggle="modal" data-id="'.$row['id_sdm'].'" style="font-size:12px;text-decoration:none;"><span class="label label-warning">Edit data</span></a>
                             <a onclick="return confirm(\'ingin menghapus data ?\')" href="function/delete.php?aksi=del_sdm&id_sdm='.$row['id_sdm'].'" style="font-size:12px;text-decoration:none;"><span class="label label-warning">Delete data</span></a>
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
