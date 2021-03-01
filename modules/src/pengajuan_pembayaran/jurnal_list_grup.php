<?php
//crontrol
if (empty($params['case'])) {
    $result['respon']['pesan'] == "gagal";
    $result['respon']['pesan'] == "Module tidak dapat di muat";
    echo json_encode($result);
    exit();
}
$halaman = $params['halaman'];
$batas = $params['batas'];
$posisi = $this->PAGING->cariPosisi($batas, $halaman);
$input = $params['input_option'];
$date = date("Y-m-d");
if (empty($input['material'])) {
    $material = "";
} else {
    $material = "AND RMP_JURNAL_MATERIAL LIKE '%" . $input['material'] . "%'";
}

$sql = "SELECT *
                FROM RMP_JURNAL WHERE FINANCE_DANA_MATERIAL_ID='" . $input['id_periode'] . "' " . $material . " AND RECORD_STATUS='A' GROUP BY RMP_JURNAL_GRUP_ID ";
$this->MYSQL = new MYSQL();
$this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri = $sql;
$result_a = $this->MYSQL->data();
//-- >>
$no = $posisi + 1;
foreach ($result_a as $r) {
    $sql_sum = "SELECT SUM(RMP_JURNAL_RUPIAH_PENGAJUAN) AS TOTAL
                FROM RMP_JURNAL WHERE RMP_JURNAL_GRUP_ID='" . $r['RMP_JURNAL_GRUP_ID'] . "' AND RECORD_STATUS='A'";
    $this->MYSQL = new MYSQL();
    $this->MYSQL->database = $this->CONFIG->mysql_koneksi()->db_nama;
    $this->MYSQL->queri = $sql_sum;
    $result_sum = $this->MYSQL->data();

    $r['NO'] = $no;
    $r['TANGGAL'] = tanggal_format(Date("Y-m-d", strtotime($r['RMP_JURNAL_TANGGAL_FAKTUR'])));
    $r['DANA'] = number_format($r['FINANCE_DANA_MATERIAL_DANA'], 0, ",", ".");
    $r['SISA'] = number_format($r['FINANCE_DANA_MATERIAL_DANA'], 0, ",", ".");
    $r['TOTAL'] = number_format($result_sum[0]['TOTAL'], 0, ",", ".");
    $result[] = $r;
    $no++;
}
if (empty($result_a)) {
    $this->callback['respon']['pesan'] = "gagal";
    $this->callback['respon']['text_msg'] = "Belum ada pengajuan.";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
} else {
    $this->callback['respon']['pesan'] = "sukses";
    $this->callback['respon']['text_msg'] = "OK..";
    $this->callback['filter'] = $params;
    $this->callback['result'] = $result;
    $this->callback['result_option']['jml_halaman'] = $this->pagging(array(
        'sql' => $sql,
        'batas' => $batas
    ))->jmlhalaman;
}
