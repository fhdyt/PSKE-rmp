<?php

if (empty($params['case']))
    {
    $result['respon']['pesan'] == "gagal";
    $result['respon']['pesan'] == "Module tidak dapat di muat";
    echo json_encode($result);
    exit();
    }

$halaman = $params['halaman'];
$batas = $params['batas'];
$posisi = $this->PAGING->cariPosisi($batas, $halaman);
$input = $params['input_option'];

if (empty($input['keyword']) or $input['keyword'] == "")
    {
    $filter_a = "";
    }
  else
    {
    $filter_a = "AND (P.RMP_MASTER_PERSONAL_NAMA like '%" . $input['keyword'] . "%' OR W.RMP_MASTER_WILAYAH like '%" . $input['keyword'] . "%' )";
    }

if (empty($input['FILTER_WILAYAH_SUPPLIER']) or $input['FILTER_WILAYAH_SUPPLIER'] == "")
    {
    $filter_b = "";
    }
  else
    {
    $filter_b = "AND P.RMP_MASTER_WILAYAH_ID like '%" . $input['FILTER_WILAYAH_SUPPLIER'] . "%' ";
    }

$sql = "SELECT * FROM RMP_MASTER_PERSONAL AS P
        LEFT JOIN RMP_MASTER_WILAYAH AS W ON P.SUB_WILAYAH_ID=W.RMP_MASTER_WILAYAH_ID
        LEFT JOIN RMP_REKENING_RELASI AS R ON P.RMP_MASTER_PERSONAL_ID=R.RMP_MASTER_PERSONAL_ID
        WHERE
        P.RECORD_STATUS='A'
        AND
        W.RECORD_STATUS='A'
        AND
        R.RECORD_STATUS='A'
        AND
        R.RMP_MASTER_MATERIAL_ID='".$input['material_id']."'
        AND
        (P.RMP_MASTER_PERSONAL_ROLE='PETANI' OR P.RMP_MASTER_PERSONAL_ROLE='PENGEPUL') " . $filter_a . " " . $filter_b . " ORDER BY R.RMP_MASTER_WILAYAH_KODE, R.SUB_WILAYAH_KODE ASC";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql . " limit " . $posisi . "," . $batas;
$result_a = $this->MYSQL->data();

// -- >>

$no = $posisi + 1;
foreach($result_a as $r)
    {
        $r['NO'] = $no;
        $r['TANGGAL_DAFTAR']=tanggal_format(Date("Y-m-d",strtotime($r['RMP_MASTER_PERSONAL_TANGGAL_DAFTAR'])));

        $sql2 = "SELECT * FROM
                 RMP_MASTER_WILAYAH
                 WHERE
                 RMP_MASTER_WILAYAH_ID='".$r['RMP_MASTER_WILAYAH_PREV_LINK']."' AND RECORD_STATUS='A'";
        $this->MYSQL = new MYSQL();
        $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
        $this->MYSQL->queri = $sql2 ;
        $result_b = $this->MYSQL->data();

        foreach($result_b as $rb)
        {
          $r['MASTER_WILAYAH']=$rb['RMP_MASTER_WILAYAH'];
        }
        $tanggal = date("Y-m-d");
        if($input['material_id'] == '12')
        {
          $sql9 = "SELECT * FROM
                   RMP_PENYESUAIAN_HARGA_GL AS Q,
                   RMP_MASTER_MATERIAL AS M,
                   RMP_REKENING_RELASI AS R
                   WHERE
                   Q.RMP_MASTER_MATERIAL_ID=M.RMP_MASTER_MATERIAL_ID
                   AND
                   Q.RMP_MASTER_PERSONAL_ID='".$r['RMP_MASTER_PERSONAL_ID']."'
                   AND
                   Q.RMP_MASTER_MATERIAL_ID='".$input['material_id']."'
                   AND
                   Q.RMP_PENYESUAIAN_HARGA_GL_TANGGAL_BERLAKU <= '".$tanggal."'
                   AND
                   Q.RECORD_STATUS='A'
                   AND
                   M.RECORD_STATUS='A'";
        }

        $this->MYSQL = new MYSQL();
        $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
        $this->MYSQL->queri = $sql9 ;
        $result_b9 = $this->MYSQL->data();
        if(empty($result_b9))
        {
          $r['STATUS_QUALITED'] = 'EMPTY';
        }
        else
        {
          $r['STATUS_QUALITED'] = 'AVAILABLE';
          foreach($result_b9 as $rb9)
          {
            $r['MATERIAL']=$rb9['RMP_MASTER_MATERIAL'];
            $r['ID_PENYESUAIAN_HARGA']=$rb9['RMP_PENYESUAIAN_HARGA_ID'];
            $r['KUALITET']=$rb9['RMP_PENYESUAIAN_HARGA_KUALITET'];
            $r['HARGA_JADI']=$rb9['RMP_PENYESUAIAN_HARGA_JADI'];
            $r['HARGA_PATOKAN']=$rb9['RMP_PENYESUAIAN_HARGA_PATOKAN'];
            $r['HARGA_SETENGAH_JADI']=$rb9['RMP_PENYESUAIAN_HARGA_SETENGAH_JADI'];
            $r['HARGA_TRANSAKSI']=$rb9['RMP_PENYESUAIAN_HARGA_TRANSAKSI'];
            $r['HARGA_PATOKAN_A']=$rb9['RMP_PENYESUAIAN_HARGA_PATOKAN_A'];
            $r['HARGA_PATOKAN_B']=$rb9['RMP_PENYESUAIAN_HARGA_PATOKAN_B'];

            $r['HARGA_A']=$rb9['RMP_PENYESUAIAN_HARGA_GL_A'];
            $r['HARGA_B']=$rb9['RMP_PENYESUAIAN_HARGA_GL_B'];
            $r['HARGA_C']=$rb9['RMP_PENYESUAIAN_HARGA_GL_C'];
            $r['TANGGAL_BERLAKU']=tanggal_format(Date("Y-m-d",strtotime($rb9['RMP_PENYESUAIAN_HARGA_GL_TANGGAL_BERLAKU'])));
            if ($rb9['RMP_PENYESUAIAN_HARGA_GL_TANGGAL_BERAKHIR'] == '0000-00-00')
            {
              $r['TANGGAL_BERAKHIR'] = "";
            }
            else
            {
            $r['TANGGAL_BERAKHIR']=tanggal_format(Date("Y-m-d",strtotime($rb9['RMP_PENYESUAIAN_HARGA_GL_TANGGAL_BERAKHIR'])));
            }

            // $r['BERLAKU']=$rb9['RMP_QUALITED_HARGA_TANGGAL_BERLAKU'];
            // $r['TGL_BERLAKU']=tanggal_format(Date("Y-m-d",strtotime($r['BERLAKU'])));
            // $r['BERAKHIR']=$rb9['RMP_QUALITED_HARGA_TANGGAL_BERAKHIR'];
            // $r['TGL_BERAKHIR']=tanggal_format(Date("Y-m-d",strtotime($r['BERAKHIR'])));
          }

        }
        $result[] = $r;
        $no++;
    }

if (empty($result_a))
    {
    $this->callback['respon']['pesan'] = "gagal";
    $this->callback['respon']['text_msg'] = "Data tidak ada";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    }
else
    {
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = "OK..";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['result_option']['jml_halaman'] = $this->pagging(array(
        'sql' => $sql,
        'batas' => $batas
    ))->jmlhalaman;
    }

?>
