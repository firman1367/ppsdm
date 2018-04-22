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
                 ->setTitle("SDM")
                 ->setSubject("SDM")
                 ->setDescription("SDM")
                 ->setKeywords("SDM");

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

     $excel->setActiveSheetIndex(0)->setCellValue('A2', "SDM");
     $excel->getActiveSheet()->mergeCells('A2:C2');
	 $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
	 $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
     $excel->getActiveSheet()->getStyle('A5:L5')->getFont()->setBold(TRUE);
	 $excel->getActiveSheet()->getStyle('A5:L5')->getFont()->setSize(9);
     $excel->getActiveSheet()->getStyle('A5:L5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom
     $excel->getActiveSheet()->getStyle('A5:L5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); // Set text center untuk kolom

     // Buat header tabel
	 $excel->setActiveSheetIndex(0)->setCellValue('A5', "NO.");
     $excel->setActiveSheetIndex(0)->setCellValue('B5', "ID SDM");
     $excel->setActiveSheetIndex(0)->setCellValue('C5', "Nama");
     $excel->setActiveSheetIndex(0)->setCellValue('D5', "Kelamin");
     $excel->setActiveSheetIndex(0)->setCellValue('E5', "Status Kepegawaian");
     $excel->setActiveSheetIndex(0)->setCellValue('F5', "Nama Provinsi");
     $excel->setActiveSheetIndex(0)->setCellValue('G5', "Nama Kabupaten");
     $excel->setActiveSheetIndex(0)->setCellValue('H5', "Nama Unit");
     $excel->setActiveSheetIndex(0)->setCellValue('I5', "Rumpun SDMK");
     $excel->setActiveSheetIndex(0)->setCellValue('J5', "Jenis SDMK");
     $excel->setActiveSheetIndex(0)->setCellValue('K5', "Strata Pendidikan");
     $excel->setActiveSheetIndex(0)->setCellValue('L5', "Program Studi");

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
     $excel->getActiveSheet()->getStyle('J5')->applyFromArray($style_col);
     $excel->getActiveSheet()->getStyle('K5')->applyFromArray($style_col);
     $excel->getActiveSheet()->getStyle('L5')->applyFromArray($style_col);

     // Set height baris ke 1, 2 dan 3
	 $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(16);
	 $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(16);
	 $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(16);
	 $excel->getActiveSheet()->getRowDimension('4')->setRowHeight(16);
	 $excel->getActiveSheet()->getRowDimension('5')->setRowHeight(20);

	 // Set width kolom
	 $excel->getActiveSheet()->getColumnDimension('A')->setWidth(8); // Set width kolom

	 // Freeze Pane
	 $excel->getActiveSheet()->freezePane('C6');

     // Buat query untuk menampilkan semua data siswa
     $no  		    = 1;
     $numrow 	    = 6;
     $prov          = $_GET['nama_prov'];
     $rumpun        = $_GET['rumpun_sdmk'];
     $kode_strata   = $_GET['strata_pendidikan'];
     $sql           = mysqli_query($koneksi,("SELECT * FROM tb_sdm WHERE nama_prov = '$prov' AND rumpun_sdmk = '$rumpun' AND strata_pendidikan = '$kode_strata'"));
     while($data = mysqli_fetch_array($sql)){

        $excel->getActiveSheet()->setCellValue('A'.$numrow, $no)
                                ->setCellValue('B'.$numrow, $data['id_sdm'])
                                ->setCellValue('C'.$numrow, $data['nama'])
                                ->setCellValue('D'.$numrow, $data['jenis_kelamin'])
                                ->setCellValue('E'.$numrow, $data['status_kepegawaian'])
                                ->setCellValue('F'.$numrow, $data['nama_prov'])
                                ->setCellValue('G'.$numrow, $data['nama_kab'])
                                ->setCellValue('H'.$numrow, $data['nama_unit'])
                                ->setCellValue('I'.$numrow, $data['rumpun_sdmk'])
                                ->setCellValue('J'.$numrow, $data['jenis_sdmk'])
                                ->setCellValue('K'.$numrow, $data['strata_pendidikan'])
                                ->setCellValue('L'.$numrow, $data['program_studi']);

        // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
        $excel->getActiveSheet()->getStyle('A'.$numrow.':L'.$numrow)->applyFromArray($style_row);

        // Height
        $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(18);

        // Font Size
        $excel->getActiveSheet()->getStyle('A'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom
        $excel->getActiveSheet()->getStyle('D'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom

        // Auto width
        foreach(range('B'.$numrow,'L'.$numrow) as $columnID) {
            $excel->getActiveSheet()->getColumnDimension($columnID)
            ->setAutoSize(true);
        }

        $no++; // Tambah 1 setiap kali looping
        $numrow++; // Tambah 1 setiap kali looping
     }

     // Set orientasi kertas jadi LANDSCAPE
	 $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
	 // Set judul file excel nya
	 $excel->getActiveSheet(0)->setTitle("SDM");
	 $excel->setActiveSheetIndex(0);
	 // Proses file excel
	 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	 header('Content-Disposition: attachment; filename="SDM.xlsx"'); // Set nama file excel nya
	 header('Cache-Control: max-age=0');
	 $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
	 $write->save('php://output');

?>
