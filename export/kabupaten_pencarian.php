<?php

    //koneksi
    include "../config/koneksi.php";
    // Load plugin PHPExcel nya
    require_once '../phpexcel/PHPExcel.php';

    // Panggil class PHPExcel nya
    $excel = new PHPExcel();
    // Settingan awal file excel
    $excel->getProperties()->setCreator('Author')
                 ->setLastModifiedBy('Author')
                 ->setTitle("KODIFIKASI KABUPATEN")
                 ->setSubject("KODIFIKASI KABUPATEN")
                 ->setDescription("KODIFIKASI KABUPATEN")
                 ->setKeywords("KODIFIKASI KABUPATEN");

     // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
     $style_col = array(
         'font' => array('bold' => true), // Set font nya jadi bold
         'alignment' => array(
             'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
             'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
         ),
         'borders' => array(
             'outline' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            ),
        ),
     );

     // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
     $style_row = array(
         'alignment' => array(
             'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
         ),
         'borders' => array(
             'outline' => array(
                'style' => PHPExcel_Style_Border::BORDER_THIN
            ),
             'inside' => array(
               'style' => PHPExcel_Style_Border::BORDER_THIN
           ),
         ),
         'font' => array(
             'size' => 9 // Set text jadi di tengah secara vertical (middle)
         )
     );

     $excel->setActiveSheetIndex(0)->setCellValue('A2', "KODIFIKASI KABUPATEN");
     $excel->setActiveSheetIndex(0)->setCellValue('A6', "INDONESIA");
     $excel->getActiveSheet()->mergeCells('A2:D2');
     $excel->getActiveSheet()->mergeCells('A6:E6');
	 $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
	 $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
     $excel->getActiveSheet()->getStyle('A5:G5')->getFont()->setBold(TRUE);
	 $excel->getActiveSheet()->getStyle('A5:G5')->getFont()->setSize(9);
     $excel->getActiveSheet()->getStyle('F6:G6')->getFont()->setSize(10);
     $excel->getActiveSheet()->getStyle('A5:G5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom
     $excel->getActiveSheet()->getStyle('A5:G5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); // Set text center untuk kolom

     // Buat header tabel nya pada baris ke 3
     $excel->setActiveSheetIndex(0)->setCellValue('A5', "No.");
	 $excel->setActiveSheetIndex(0)->setCellValue('B5', "Kode Kabupaten");
     $excel->setActiveSheetIndex(0)->setCellValue('C5', "Nama Kabupaten");
     $excel->setActiveSheetIndex(0)->setCellValue('D5', "Kode Provinsi");
     $excel->setActiveSheetIndex(0)->setCellValue('E5', "Nama Provinsi");
     $excel->setActiveSheetIndex(0)->setCellValue('F5', "Jumlah Puskesmas");
     $excel->setActiveSheetIndex(0)->setCellValue('G5', "Jumlah RS");

     // Apply style header yang telah kita buat tadi ke masing-masing kolom header
     $excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
     $excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
     $excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);
     $excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);
     $excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_col);
     $excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_col);
     $excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_col);
     $excel->getActiveSheet()->getStyle('F6')->applyFromArray($style_col);
     $excel->getActiveSheet()->getStyle('G6')->applyFromArray($style_col);
     $excel->getActiveSheet()->getStyle('A6:E6')->applyFromArray($style_col);

     // Set height baris ke 1, 2 dan 3
	 $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(16);
	 $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(16);
	 $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(16);
	 $excel->getActiveSheet()->getRowDimension('4')->setRowHeight(16);
	 $excel->getActiveSheet()->getRowDimension('5')->setRowHeight(20);

	 // Set width kolom
	 $excel->getActiveSheet()->getColumnDimension('A')->setWidth(8); // Set width kolom

	 // Freeze Pane
	 $excel->getActiveSheet()->freezePane('C7');

     // Buat query untuk menampilkan semua data siswa
     $no  		= 1;
     $numrow 	= 7;
     $prov      = $_GET['kode_prov'];
     $sql 		= mysqli_query($koneksi,("SELECT a.kode_prov, a.nama_prov, b.* FROM tb_kab_kota AS b
                                          INNER JOIN tb_prov AS a USING(kode_prov)
                                          WHERE kode_prov = '$prov'
                                          ORDER BY kode_kab ASC"));
     while($data = mysqli_fetch_array($sql)){

        $excel->getActiveSheet()->setCellValue('A'.$numrow, $no)
                                ->setCellValue('B'.$numrow, $data['kode_kab'])
                                ->setCellValue('C'.$numrow, $data['nama_kab'])
                                ->setCellValue('D'.$numrow, $data['kode_prov'])
                                ->setCellValue('E'.$numrow, $data['nama_prov'])
                                ->setCellValue('F'.$numrow, $data['jml_puskesmas'])
                                ->setCellValue('G'.$numrow, $data['jml_rs']);

        // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
        $excel->getActiveSheet()->getStyle('A'.$numrow.':G'.$numrow)->applyFromArray($style_row);

        // Height
        $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(18);

        // Font Size
        $excel->getActiveSheet()->getStyle('A'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom

        // Auto width
        foreach(range('B'.$numrow,'G'.$numrow) as $columnID) {
            $excel->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
        }

        $no++; // Tambah 1 setiap kali looping
        $numrow++; // Tambah 1 setiap kali looping
     }

     $query1 = mysqli_query($koneksi,("SELECT SUM(jml_puskesmas) as jml_puskesmas from tb_kab_kota"));
     $data1  = mysqli_fetch_array($query1);
     $excel->getActiveSheet()->setCellValue('F6', $data1['jml_puskesmas']);

     $query2 = mysqli_query($koneksi,("SELECT SUM(jml_rs) as jml_rs from tb_kab_kota"));
     $data2  = mysqli_fetch_array($query2);
     $excel->getActiveSheet()->setCellValue('G6', $data2['jml_rs']);

     // Set orientasi kertas jadi LANDSCAPE
	 $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
	 // Set judul file excel nya
	 $excel->getActiveSheet(0)->setTitle("KODFIKASI KABUPATEN");
	 $excel->setActiveSheetIndex(0);
	 // Proses file excel
	 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	 header('Content-Disposition: attachment; filename="Kodifikasi Kabupaten.xlsx"'); // Set nama file excel nya
	 header('Cache-Control: max-age=0');
	 $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
	 $write->save('php://output');

?>
