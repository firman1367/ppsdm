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
                 ->setTitle("KODIFIKASI PROVINSI")
                 ->setSubject("KODIFIKASI PROVINSI")
                 ->setDescription("KODIFIKASI PROVINSI")
                 ->setKeywords("KODIFIKASI PROVINSI");

     $objWorkSheet      = $excel->createSheet();
     $work_sheet_count  = 6;//number of sheets you want to create
     $work_sheet        = 0;

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

     while($work_sheet<=$work_sheet_count){
         if($work_sheet==0){
             $excel->getActiveSheet($work_sheet)->setTitle("KODIFIKASI SDMK");
             $excel->setActiveSheetIndex($work_sheet);
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('A1', "KODIFIKASI SDMK"); // Set kolom A1
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('A2', "KODIFIKASI MENURUT RUMPUN DAN JENIS SDMK");
             $excel->getActiveSheet()->mergeCells('A1:G1'); // Set Merge Cell pada kolom
             $excel->getActiveSheet()->mergeCells('A2:G2');
             $excel->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(TRUE); // Set bold kolom A1
             $excel->getActiveSheet()->getStyle('A1:A2')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
             $excel->getActiveSheet()->getStyle('A5:E5')->getFont()->setBold(TRUE);
             $excel->getActiveSheet()->getStyle('A5:E5')->getFont()->setSize(9);
             $excel->getActiveSheet()->getStyle('A5:E5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom
             $excel->getActiveSheet()->getStyle('A5:E5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); // Set text center untuk kolom

             // Buat header tabel nya pada baris ke 3
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('A5', "NO. Urut");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('B5', "ID SDMK");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('C5', "Nomenklatur");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('D5', "RUMPUN");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('E5', "Jenis Rumpun");

             // Apply style header yang telah kita buat tadi ke masing-masing kolom header
             $excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
             $excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
             $excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);
             $excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);
             $excel->getActiveSheet()->getStyle('E5')->applyFromArray($style_col);

             // Set height baris ke 1, 2 dan 3
             $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(16);
             $excel->getActiveSheet()->getRowDimension('2')->setRowHeight(16);
             $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(16);
             $excel->getActiveSheet()->getRowDimension('4')->setRowHeight(16);
             $excel->getActiveSheet()->getRowDimension('5')->setRowHeight(20);

             // Set width kolom
             $excel->getActiveSheet()->getColumnDimension('A')->setWidth(10); // Set width kolom

             // Freeze Pane
             $excel->getActiveSheet()->freezePane('B6');

             // Buat query untuk menampilkan semua data siswa
             $no  		= 1;
             $numrow 	= 6;
             $sql 		= mysqli_query($koneksi,("SELECT * FROM tb_kodesdmk"));
             while($data = mysqli_fetch_array($sql)){

                 $excel->getActiveSheet()->setCellValue('A'.$numrow, $no)
                 ->setCellValue('B'.$numrow, $data['id_sdmk'])
                 ->setCellValue('C'.$numrow, $data['nomenklatur'])
                 ->setCellValue('D'.$numrow, $data['rumpun'])
                 ->setCellValue('E'.$numrow, $data['rumpun_jenis']);

                 // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                 $excel->getActiveSheet()->getStyle('A'.$numrow.':E'.$numrow)->applyFromArray($style_row);

                 // Height
                 $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(18);

                 // Font Size
                 $excel->getActiveSheet()->getStyle('A'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom
                 $excel->getActiveSheet()->getStyle('B'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom

                 // Auto width
                 foreach(range('B'.$numrow,'E'.$numrow) as $columnID) {
                     $excel->getActiveSheet()->getColumnDimension($columnID)
                     ->setAutoSize(true);
                 }

                 $no++; // Tambah 1 setiap kali looping
                 $numrow++; // Tambah 1 setiap kali looping
             }
         }
         if($work_sheet==1){
             $objWorkSheet->setTitle("KODIFIKASI PENDIDIKAN");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('A1', "KODIFIKASI PENDIDIKAN"); // Set kolom A1
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('A2', "KODIFIKASI MENURUT STRATA DAN JENIS PROGRAM STUDI");
        	 $excel->getActiveSheet()->mergeCells('A1:D1'); // Set Merge Cell pada kolom
             $excel->getActiveSheet()->mergeCells('A2:D2');
        	 $excel->getActiveSheet()->getStyle('A1:A2')->getFont()->setBold(TRUE); // Set bold kolom A1
        	 $excel->getActiveSheet()->getStyle('A1:A2')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
             $excel->getActiveSheet()->getStyle('A5:D5')->getFont()->setBold(TRUE);
        	 $excel->getActiveSheet()->getStyle('A5:D5')->getFont()->setSize(9);
             $excel->getActiveSheet()->getStyle('A5:D5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom
             $excel->getActiveSheet()->getStyle('A5:D5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); // Set text center untuk kolom

             // Buat header tabel nya pada baris ke 3
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('A5', "No.");
        	 $excel->setActiveSheetIndex($work_sheet)->setCellValue('B5', "Kode Pendidikan");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('C5', "Kode Strata");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('D5', "Nama Pendidikan");

             // Apply style header yang telah kita buat tadi ke masing-masing kolom header
             $excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
             $excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
             $excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);
             $excel->getActiveSheet()->getStyle('D5')->applyFromArray($style_col);

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
             $sql 		= mysqli_query($koneksi,("SELECT * FROM tb_kodedik"));
             while($data = mysqli_fetch_array($sql)){

                $excel->getActiveSheet()->setCellValue('A'.$numrow, $no)
                                        ->setCellValue('B'.$numrow, $data['kode_dik'])
                                        ->setCellValue('C'.$numrow, $data['kode_strata'])
                                        ->setCellValue('D'.$numrow, $data['nama_dik']);

                // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                $excel->getActiveSheet()->getStyle('A'.$numrow.':D'.$numrow)->applyFromArray($style_row);

                // Height
                $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(18);

                // Font Size
                $excel->getActiveSheet()->getStyle('A'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom

                // Auto width
                foreach(range('B'.$numrow,'D'.$numrow) as $columnID) {
                    $excel->getActiveSheet()->getColumnDimension($columnID)
                    ->setAutoSize(true);
                }

                $no++; // Tambah 1 setiap kali looping
                $numrow++; // Tambah 1 setiap kali looping
             }
         }
         if($work_sheet==2){
             $objWorkSheet = $excel->createSheet($work_sheet_count);
             $objWorkSheet->setTitle("KODIFIKASI PROVINSI");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('A2', "KODIFIKASI PROVINSI");
             $excel->getActiveSheet()->mergeCells('A2:D2');
        	 $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
        	 $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
             $excel->getActiveSheet()->getStyle('A5:C5')->getFont()->setBold(TRUE);
        	 $excel->getActiveSheet()->getStyle('A5:C5')->getFont()->setSize(9);
             $excel->getActiveSheet()->getStyle('A5:C5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom
             $excel->getActiveSheet()->getStyle('A5:C5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); // Set text center untuk kolom

             // Buat header tabel nya pada baris ke 3
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('A5', "No.");
        	 $excel->setActiveSheetIndex($work_sheet)->setCellValue('B5', "Kode Provinsi");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('C5', "Nama Provinsi");

             // Apply style header yang telah kita buat tadi ke masing-masing kolom header
             $excel->getActiveSheet()->getStyle('A5')->applyFromArray($style_col);
             $excel->getActiveSheet()->getStyle('B5')->applyFromArray($style_col);
             $excel->getActiveSheet()->getStyle('C5')->applyFromArray($style_col);

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
             $sql 		= mysqli_query($koneksi,("SELECT * FROM tb_prov"));
             while($data = mysqli_fetch_array($sql)){

                $excel->getActiveSheet()->setCellValue('A'.$numrow, $no)
                                        ->setCellValue('B'.$numrow, $data['kode_prov'])
                                        ->setCellValue('C'.$numrow, $data['nama_prov']);

                // Apply style row yang telah kita buat tadi ke masing-masing baris (isi tabel)
                $excel->getActiveSheet()->getStyle('A'.$numrow.':C'.$numrow)->applyFromArray($style_row);

                // Height
                $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(18);

                // Font Size
                $excel->getActiveSheet()->getStyle('A'.$numrow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom

                // Auto width
                foreach(range('B'.$numrow,'C'.$numrow) as $columnID) {
                    $excel->getActiveSheet()->getColumnDimension($columnID)
                    ->setAutoSize(true);
                }

                $no++; // Tambah 1 setiap kali looping
                $numrow++; // Tambah 1 setiap kali looping
             }
         }
         if($work_sheet==3){
             $objWorkSheet = $excel->createSheet($work_sheet_count);
             $objWorkSheet->setTitle("KODIFIKASI KABUPATEN");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('A2', "KODIFIKASI KABUPATEN");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('A6', "INDONESIA");
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
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('A5', "No.");
        	 $excel->setActiveSheetIndex($work_sheet)->setCellValue('B5', "Kode Kabupaten");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('C5', "Nama Kabupaten");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('D5', "Kode Provinsi");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('E5', "Nama Provinsi");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('F5', "Jumlah Puskesmas");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('G5', "Jumlah RS");

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
        	 $excel->getActiveSheet()->freezePane('B7');

             // Buat query untuk menampilkan semua data siswa
             $no  		= 1;
             $numrow 	= 7;
             $sql 		= mysqli_query($koneksi,("SELECT a.kode_prov, a.nama_prov, b.* FROM tb_kab_kota AS b
                                               INNER JOIN tb_prov AS a USING(kode_prov)
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
         }
         if($work_sheet==4){
             $objWorkSheet = $excel->createSheet($work_sheet_count);
             $objWorkSheet->setTitle("KODIFIKASI FASYANKES");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('A2', "KODIFIKASI FASYANKES");
             $excel->getActiveSheet()->mergeCells('A2:C2');
        	 $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
        	 $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
             $excel->getActiveSheet()->getStyle('A5:I5')->getFont()->setBold(TRUE);
        	 $excel->getActiveSheet()->getStyle('A5:I5')->getFont()->setSize(9);
             $excel->getActiveSheet()->getStyle('A5:I5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom
             $excel->getActiveSheet()->getStyle('A5:I5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); // Set text center untuk kolom

             // Buat header tabel nya pada baris ke 3
        	 $excel->setActiveSheetIndex($work_sheet)->setCellValue('A5', "NO.");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('B5', "Kode Fasyankes");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('C5', "Nama Fasyankes");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('D5', "Tipe");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('E5', "Kode Provinsi");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('F5', "Nama Provinsi");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('G5', "Kode Kabupaten");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('H5', "Nama Kabupaten");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('I5', "Kode Fas Old");

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
         }
         if($work_sheet==5){
             $objWorkSheet = $excel->createSheet($work_sheet_count);
             $objWorkSheet->setTitle("SDM");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('A2', "SDM");
             $excel->getActiveSheet()->mergeCells('A2:C2');
        	 $excel->getActiveSheet()->getStyle('A2')->getFont()->setBold(TRUE); // Set bold kolom A1
        	 $excel->getActiveSheet()->getStyle('A2')->getFont()->setSize(12); // Set font size 15 untuk kolom A1
             $excel->getActiveSheet()->getStyle('A5:L5')->getFont()->setBold(TRUE);
        	 $excel->getActiveSheet()->getStyle('A5:L5')->getFont()->setSize(9);
             $excel->getActiveSheet()->getStyle('A5:L5')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom
             $excel->getActiveSheet()->getStyle('A5:L5')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); // Set text center untuk kolom

             // Buat header tabel
        	 $excel->setActiveSheetIndex($work_sheet)->setCellValue('A5', "NO.");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('B5', "ID SDM");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('C5', "Nama");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('D5', "Kelamin");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('E5', "Status Kepegawaian");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('F5', "Nama Provinsi");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('G5', "Nama Kabupaten");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('H5', "Nama Unit");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('I5', "Rumpun SDMK");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('J5', "Jenis SDMK");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('K5', "Strata Pendidikan");
             $excel->setActiveSheetIndex($work_sheet)->setCellValue('L5', "Program Studi");

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
             $no  		= 1;
             $numrow 	= 6;
             $sql 		= mysqli_query($koneksi,("SELECT * FROM tb_sdm ORDER BY id_sdm ASC"));
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
         }
         $work_sheet++;
     }

     // Set orientasi kertas jadi LANDSCAPE
	 $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

	 // Proses file excel
	 header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	 header('Content-Disposition: attachment; filename="Laporan.xlsx"'); // Set nama file excel nya
	 header('Cache-Control: max-age=0');
	 $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
	 $write->save('php://output');

?>
