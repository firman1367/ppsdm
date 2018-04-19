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
	0 => 'kode_kab',
    1 => 'nama_kab',
	2 => 'nama_prov',
	3 => 'jml_puskesmas',
    4 => 'jml_rs'
);

// getting total number records without any search
$sql = "SELECT a.kode_prov, a.nama_prov, b.* FROM tb_kab_kota AS b
                                  INNER JOIN tb_prov AS a USING(kode_prov)";
$query=mysqli_query($conn, $sql) or die("data_kabupaten.php: get InventoryItems");
$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.


if( !empty($requestData['search']['value']) ) {
	// if there is a search parameter
	$sql = "SELECT a.kode_prov, a.nama_prov, b.* FROM tb_kab_kota AS b
                                      INNER JOIN tb_prov AS a USING(kode_prov)";
	$sql.=" WHERE kode_kab LIKE '".$requestData['search']['value']."%' ";    // $requestData['search']['value'] contains search parameter
	$sql.=" OR nama_kab LIKE '".$requestData['search']['value']."%' ";
    $sql.=" OR nama_prov LIKE '".$requestData['search']['value']."%' ";
	$query=mysqli_query($conn, $sql) or die("data_kabupaten.php: get PO");
	$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result without limit in the query

	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   "; // $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc , $requestData['start'] contains start row number ,$requestData['length'] contains limit length.
	$query=mysqli_query($conn, $sql) or die("data_kabupaten.php: get PO"); // again run query with limit

} else {

    $sql = "SELECT a.kode_prov, a.nama_prov, b.* FROM tb_kab_kota AS b
                                      INNER JOIN tb_prov AS a USING(kode_prov)";
	$sql.=" ORDER BY ". $columns[$requestData['order'][0]['column']]."   ".$requestData['order'][0]['dir']."   LIMIT ".$requestData['start']." ,".$requestData['length']."   ";
	$query=mysqli_query($conn, $sql) or die("data_kabupaten.php: get PO");

}

$data = array();
$no = $requestData['start'] + 1;
while( $row=mysqli_fetch_array($query) ) {  // preparing an array
	$nestedData=array();

    $nestedData[] = '<center>'.$no++.'</center>';
    $nestedData[] = '<span class="text-center">'.$row['kode_kab'].'</span>';
    $nestedData[] = $row["nama_kab"];
    $nestedData[] = $row["nama_prov"];
    $nestedData[] = $row["jml_puskesmas"];
    $nestedData[] = $row["jml_rs"];
    $nestedData[] = '<td>
                         <center>
                             <a href="#edit_kabupaten" data-toggle="modal" data-id="'.$row['kode_kab'].'" style="font-size:12px;text-decoration:none;"><span class="label label-warning">Edit data</span></a>
                             <a href="function/delete.php?aksi=del_kabupaten&kode_kab='.$row['kode_kab'].'" style="font-size:12px;text-decoration:none;"><span class="label label-warning">Delete data</span></a>
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
