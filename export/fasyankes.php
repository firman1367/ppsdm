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
                 ->setTitle("KODIFIKASI FASYANKES")
                 ->setSubject("KODIFIKASI FASYANKES")
                 ->setDescription("KODIFIKASI FASYANKES")
                 ->setKeywords("KODIFIKASI FASYANKES");

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

     $excel->setActiveSheetIndex(0)->setCellValue('A2', "KODIFIKASI FASYANKES");
     $excel->getActiveSheet()->mergeCells('A2:C2');
	 $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
	 $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
     $excel->getActiveSheet()->getStyle('A5:I5')->getFont()->setBold(TRUE);
	 $excel->getActiveSheet()->getStyle('A5:I5')->getFont()->setSize(9);
     $excel->getActiveSheet()->getStyle('A5:I5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom
     $excel->getActiveSheet()->getStyle('A5:I5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); // Set text center untuk kolom

     // Buat header tabel nya pada baris ke 3
	 $excel->setActiveSheetIndex(0)->setCellValue('A5', "NO.");
     $excel->setActiveSheetIndex(0)->setCellValue('B5', "Kode Fasyankes");
     $excel->setActiveSheetIndex(0)->setCellValue('C5', "Nama Fasyankes");
     $excel->setActiveSheetIndex(0)->setCellValue('D5', "Tipe");
     $excel->setActiveSheetIndex(0)->setCellValue('E5', "Kode Provinsi");
     $excel->setActiveSheetIndex(0)->setCellValue('F5', "Nama Provinsi");
     $excel->setActiveSheetIndex(0)->setCellValue('G5', "Kode Kabupaten");
     $excel->setActiveSheetIndex(0)->setCellValue('H5', "Nama Kabupaten");
     $excel->setActiveSheetIndex(0)->setCellValue('I5', "Kode Fas Old");

     // Apply style header yang telah kita buat tadi ke masing-masing kolom header
     $excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
     $excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
     $excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);
     $excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);
     $excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_col);
     $excel->getActiveSheet()->getStyle('F5')->applyFromArray($style_col);
     $excel->getActiveSheet()->getStyle('G5')->applyFromArray($style_col);
     $excel->getActiveSheet()->getStyle('H5')->applyFromArray($style_col);
     $excel->getActiveSheet()->getStyle('I5')->applyFromArray($style_col);

     // Set height baris ke 1, 2 dan 3
	 $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(16);
	 $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(16);
	 $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(16);
	 $excel->getActiveSheet()->getRowDimension('4')->setRowHeight(16);
	 $excel->getActiveSheet()->getRowDimension('5')->setRowHeight(20);

	 // Set width kolom
	 $excel->getActiveSheet()->getColumnDimension('A')->setWidth(8); // Set width kolom

	 // Freeze Pane
	 $excel->getActiveSheet()->freezePane('B6');

     // Buat query untuk menampilkan semua data siswa
     $no  		= 1;
     $numrow 	= 6;
     $sql 		= mysqli_query($koneksi,("SELECT a.kode_prov, a.nama_prov, b.kode_kab, b.nama_kab, c.* FROM tb_fasyankes AS c
                                       JOIN tb_prov AS a USING(kode_prov)
                                       JOIN tb_kab_kota AS b USING(kode_kab)
                                       ORDER BY kode_fasyankes ASC"));
     while($data = mysqli_fetch_array($sql)){

        $excel->getActiveSheet()->setCellValue('A'.$numrow, $no)
                                ->setCellValue('B'.$numrow, $data['kode_fasyankes'])
                                ->setCellValue('C'.$numrow, $data['nama_fasyankes'])
                                ->setCellValue('D'.$numrow, $data['tipe'])
                                ->setCellValue('E'.$numrow, $data['kode_prov'])
                                ->setCellValue('F'.$numrow, $data['nama_prov'])
                                ->setCellValue('G'.$numrow, $data['kode_kab'])
                                ->setCellValue('H'.$numrow, $data['nama_kab'])
                                ->setCellValue('I'.$numrow, $data['kode_fas_old']);

        // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
        $excel->getActiveSheet()->getStyle('A'.$numrow.':I'.$numrow)->applyFromArray($style_row);

        // Height
        $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(18);

        // Font Size
        $excel->getActiveSheet()->getStyle('A'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom
        
        // Auto width
        foreach(range('B'.$numrow,'I'.$numrow) as $columnID) {
            $excel->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
        }

        $no++; // Tambah 1 setiap kali looping
        $numrow++; // Tambah 1 setiap kali looping
     }

     // Set orientasi kertas jadi LANDSCAPE
	 $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
	 // Set judul file excel nya
	 $excel->getActiveSheet(0)->setTitle("KODIFIKASI FASYANKES");
	 $excel->setActiveSheetIndex(0);
	 // Proses file excel
	 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	 header('Content-Disposition: attachment; filename="Kodifikasi fasyankes.xlsx"'); // Set nama file excel nya
	 header('Cache-Control: max-age=0');
	 $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
	 $write->save('php://output');

?>
