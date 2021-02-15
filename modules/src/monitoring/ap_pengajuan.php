<?php

//crontrol
if(empty($params['case'])){
	$result['respon']['pesan']=="gagal";
	$result['respon']['pesan']=="Module tidak dapat di muat";
	echo json_encode($result);
	exit();
}

$JENIS_LAPORAN=$input['JENIS_LAPORAN'];
###START MODULE
//--pagging start top--/
$halaman=$params['halaman'];
$batas = $params['batas'];
$posisi = $this->PAGING->cariPosisi($batas,$halaman);
//-- >>
$this->MYSQL=new MYSQL();
$this->MYSQL->database=$this->CONFIG->mysql_koneksi()->db_nama;
$this->MYSQL->queri="select COMPANY_UNIT_ID from PERSONAL  where PERSONAL_NIK='".$user_login['PERSONAL_NIK']."' 
AND RECORD_STATUS='A'";
//$COMPANY_UNIT_ID=$this->MYSQL->data()[0]['COMPANY_UNIT_ID'];
$COMPANY_UNIT_ID=$input['COMPANY_UNIT_ID'];
	//$this->callback['respon']['pesan']="gagal";
	//$this->callback['respon']['text_msg']="Data tidak ada, silahkan pilih tanggal".print_r($input,true);
	//return;
//filter
if($JENIS_LAPORAN=="Harian")
	{
		$tanggalAwal=$input['DATA_sDATE'];
			$tanggalAwals=Date('Y-m-d',strtotime($tanggalAwal));

			if($input['NAMA_SUPPLIER']=="0" or $input['NAMA_SUPPLIER']=="")
			{
				$queri="SELECT P.RMP_MASTER_PERSONAL_NAMA, RR.RMP_REKENING_RELASI FROM RMP_MASTER_PERSONAL AS P 
							LEFT JOIN RMP_REKENING_RELASI AS RR
								ON P.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
							WHERE RR.RMP_REKENING_RELASI LIKE '%".$input['NOMOR_REKENING']."%' AND
								P.RECORD_STATUS='A' AND 
								RR.RECORD_STATUS='A' order by RR.RMP_REKENING_RELASI asc";
			}else
			{
				$queri="SELECT P.RMP_MASTER_PERSONAL_NAMA, RR.RMP_REKENING_RELASI FROM RMP_MASTER_PERSONAL AS P 
							LEFT JOIN RMP_REKENING_RELASI AS RR
								ON P.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
							WHERE RR.RMP_REKENING_RELASI='".$input['NAMA_SUPPLIER']."' AND
								P.RECORD_STATUS='A' AND 
								RR.RECORD_STATUS='A' order by RR.RMP_REKENING_RELASI asc";
			}
			$this->MYSQL=new MYSQL();
			$this->MYSQL->database=$this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->queri=$queri;
			$result_PERSONEL=$this->MYSQL->data();
			$no=0;
			$noFaktur=0;
			
	
			if ($input['material'] == 'KOPRA'){
				$material = '4';
			  }
			  else if ($input['material'] == 'JAMBUL'){
				$material = '3';
			  }
			  else if ($input['material'] == 'GELONDONG'){
				$material = '2';
			  }
			  else{
				$material = '2,3,4';
			  }
	
			foreach($result_PERSONEL as $r )
			{
				//CARI AP PAYMENT
				$sqlAP="select * from (Select NomorAP
						From vwGLTrnAPPayment 
						Where ReffNo Is Not Null and CONVERT(VARCHAR(10),Tanggal,23)='".$tanggalAwals."' and
						SupplierID='".$r['RMP_REKENING_RELASI']."') 
						as x 
						group by NomorAP Order by NomorAP asc";
				$this->MSSQL=new MSSQL();
				$this->MSSQL->database=$this->CONFIG->mysql_koneksi()->db_nama_mssql_gl;
				$this->MSSQL->queri=$sqlAP;
				$result_AP=$this->MSSQL->data();
				if(count($result_AP)>0)
				{
					foreach($result_AP as $rAP)
					{
						
						$sqlTAGLAP="Select Tanggal From vwGLTrnAPPayment Where ReffNo Is Not Null and NomorAP='".$rAP['NomorAP']."'";
						$this->MSSQL=new MSSQL();
						$this->MSSQL->database=$this->CONFIG->mysql_koneksi()->db_nama_mssql_gl;
						$this->MSSQL->queri=$sqlTAGLAP;
						$rAP['TanggalAP']=Date('d-m-Y',strtotime($this->MSSQL->data()[0]['Tanggal']));
						$sqlFaktur="Select A.NoInvoice, 
									A.Tanggal,A.CurrencyID,
									A.Rate,A.Total,
									A.TransDate as TglBayar,
									A.ReffNo,
									A.CurrencyIDCB, 
									A.Total*A.Rate as IDREquivalent,
									A.CurrencyRateCB,
									A.Total*A.CurrencyRateCB as IDREquivalentCB, 
									(A.CurrencyRateCB)-(A.Rate) as RatePlusMinus,
									B.NoFaktur,B.Tanggal ,B.TglInvoice,
									B.Hutang-B.Creditnote+B.debitnote as NilaiFaktur,
									B.BayarAP		
								From vwGLTrnAPPayment A
									LEFT JOIN vwGLTrnFaktur B 
										ON A.NoInvoice=B.NoFaktur
								Where 	A.NomorAP='".$rAP['NomorAP']."' AND
										A.SupplierID='".$r['RMP_REKENING_RELASI']."'  AND
										B.GroupWil IN (".$material.") AND
										B.KodeSup='".$r['RMP_REKENING_RELASI']."'";
						$this->MSSQL=new MSSQL();
						$this->MSSQL->database=$this->CONFIG->mysql_koneksi()->db_nama_mssql_gl;
						$this->MSSQL->queri=$sqlFaktur;
						$result_Faktur["'".$noAP."'"]=$this->MSSQL->data();
	
						if(count($result_Faktur["'".$noAP."'"])>0)
						{
							foreach($result_Faktur["'".$noAP."'"] as $rFaktur)
							{

								$TotalNilaiAP["'".$no."'"]+=$rFaktur['IDREquivalent'];
								$TotalNilaiInvoice["'".$no."'"]+=$rFaktur['NilaiFaktur'];
								$TotalNilaiBayar["'".$no."'"]+=$rFaktur['IDREquivalentCB'];

								$rFaktur['IDREquivalents']=round($rFaktur['IDREquivalent'],2);
								$rFaktur['TglInvoices']=Date('d-m-Y',strtotime($rFaktur['TglInvoice']));
								$rFaktur['NilaiFakturs']=round($rFaktur['NilaiFaktur'],2);
								$rFaktur['TglBayars']=Date('d-m-Y',strtotime($rFaktur['TglBayar']));
								$rFaktur['IDREquivalentCBs']=round($rFaktur['IDREquivalentCB'],2);

								$NilaiAPs["'".$noAP."'"] +=$rFaktur['IDREquivalent'];								
								$NilaiFakturs["'".$noAP."'"] +=$rFaktur['NilaiFaktur'];					
								$IDREquivalentCBs["'".$noAP."'"] +=$rFaktur['IDREquivalentCB'];

								$result_Fakturss["'".$noAP."'"][]=$rFaktur;
							}
							$rAP['FAKTUR']=$result_Fakturss["'".$noAP."'"];
						}
						else{
							$rAP['FAKTUR']=array();
						}
						//$TotalNilaiFakturSS["'".$no."'"] = $TotalNilaiAP["'".$noAP."'"];


						$rAP['NilaiAP']=$NilaiAPs["'".$noAP."'"];
						$rAP['NilaiBayar']=round($IDREquivalentCBs["'".$noAP."'"],2);
						$rAP['NilaiInvoice']=round($NilaiFakturs["'".$noAP."'"],2);
						$rAP['JumlahInvoice']=count($result_Faktur["'".$noAP."'"]);
						$yF["'".$no."'"][]=$rAP;
						$r['AP']=$yF["'".$no."'"];
						$noAP++;
					}				
				}else{
					$r['AP']=array();
				}

				$r['TotalNilaiAP']=round($TotalNilaiAP["'".$no."'"],2);
				$TotalNilaiAPSS=$TotalNilaiAP["'".$no."'"];
				$r['TotalNilaiInvoice']=round($TotalNilaiInvoice["'".$no."'"],2);
				$TotalNilaiInvoiceSS=$TotalNilaiInvoice["'".$no."'"];
				$r['TotalNilaiBayar']=round($TotalNilaiBayar["'".$no."'"],2);
				$TotalNilaiBayarSS=$TotalNilaiBayar["'".$no."'"];$r['JLH_AP']=count($result_AP);


				$TOTAL_KESELURUHAN_JLH_AP+=$r['JLH_AP'];
				$TotalKeseluruhanNilaiAP+=$TotalNilaiAPSS;
				$TotalKeseluruhanNilaiInvoice+=$TotalNilaiInvoiceSS;
				$TotalKeseluruhanNilaiBayar+=$TotalNilaiBayarSS;



				$result[]=$r;
				$no++;
			}
			$resultTotal=array(
				"TOTAL_KESELURUHAN_JLH_AP"=>$TOTAL_KESELURUHAN_JLH_AP,
				"TotalKeseluruhanNilaiAP"=>round($TotalKeseluruhanNilaiAP,2),
				"TotalKeseluruhanNilaiInvoice"=>round($TotalKeseluruhanNilaiInvoice,2),
				"TotalKeseluruhanNilaiBayar"=>round($TotalKeseluruhanNilaiBayar,2)
			 );
	
			if(empty($result)){
				$this->callback['respon']['pesan']="gagal";
				$this->callback['respon']['text_msg']="Data tidak ada".$posisi.$batas;
				$this->callback['filter']=$params;
				$this->callback['result']=$result;
				//$this->callback['log']=$log;
			}else{
				$this->callback['respon']['pesan']="sukses";
				$this->callback['respon']['text_msg']="OK..";
				$this->callback['filter']=$params;
				$this->callback['result']=$result;
				$this->callback['resultTotal']=$resultTotal;
				//$this->callback['log']=$log;
				$this->callback['result_option']['jml_halaman']=$this->pagging(array('sql'=>$sql,'batas'=>$params['batas'],'tabel'=>$tabel,'dimana_default'=>$dimana_default))->jmlhalaman;
			}

	}else if($JENIS_LAPORAN=="Mingguan" || $JENIS_LAPORAN=="Pengaturan")
	{
		
		$tanggalAwal=$input['DATA_sDATE'];
			$tanggalAwals=Date('Y-m-d',strtotime($tanggalAwal));
		$tanggalAkhir=$input['DATA_eDATE'];
			$tanggalAkhirs=Date('Y-m-d',strtotime($tanggalAkhir));
	
		$periodeBulanAwal = date("m",strtotime($tanggalAwal));
		$periodeTahunAwal = date("Y",strtotime($tanggalAwal));
		$tanggalTerakhirAwal =date("Y-m-t", strtotime($periodeTahunAwal.'-'.$periodeBulanAwal));
		
		$periodeBulanAkhir = date("m",strtotime($tanggalAkhir));
		$periodeTahunAkhir = date("Y",strtotime($tanggalAkhir));
		$tanggalAwalTerakhir = $periodeTahunAkhir."-".$periodeBulanAkhir."-01";
	
		$queriPeriodeAwal=$periodeBulanAwal.$periodeTahunAwal;
		$queriPeriodeAkhir=$periodeBulanAkhir.$periodeTahunAkhir;
		
			if($input['NAMA_SUPPLIER']=="0" or $input['NAMA_SUPPLIER']=="")
			{
				$queri="SELECT P.RMP_MASTER_PERSONAL_NAMA, RR.RMP_REKENING_RELASI FROM RMP_MASTER_PERSONAL AS P 
							LEFT JOIN RMP_REKENING_RELASI AS RR
								ON P.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
							WHERE RR.RMP_REKENING_RELASI LIKE '%".$input['NOMOR_REKENING']."%' AND
								P.RECORD_STATUS='A' AND 
								RR.RECORD_STATUS='A' order by RR.RMP_REKENING_RELASI asc";
			}else
			{
				$queri="SELECT P.RMP_MASTER_PERSONAL_NAMA, RR.RMP_REKENING_RELASI FROM RMP_MASTER_PERSONAL AS P 
							LEFT JOIN RMP_REKENING_RELASI AS RR
								ON P.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
							WHERE RR.RMP_REKENING_RELASI='".$input['NAMA_SUPPLIER']."' AND
								P.RECORD_STATUS='A' AND 
								RR.RECORD_STATUS='A' order by RR.RMP_REKENING_RELASI asc";
			}
			$this->MYSQL=new MYSQL();
			$this->MYSQL->database=$this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->queri=$queri;
			$result_PERSONEL=$this->MYSQL->data();
			$no=0;
			$noFaktur=0;
			
	
			if ($input['material'] == 'KOPRA'){
				$material = '4';
			  }
			  else if ($input['material'] == 'JAMBUL'){
				$material = '3';
			  }
			  else if ($input['material'] == 'GELONDONG'){
				$material = '2';
			  }
			  else{
				$material = '2,3,4';
			  }
	
			foreach($result_PERSONEL as $r )
			{	//CARI AP PAYMENT
				$sqlAP="select * from (Select NomorAP
						From vwGLTrnAPPayment 
						Where ReffNo Is Not Null and 
						CONVERT(VARCHAR(10),Tanggal,23)>='".Date('Y-m-d',strtotime($tanggalAwals))."' and
						CONVERT(VARCHAR(10),Tanggal,23)<='".Date('Y-m-d',strtotime($tanggalAkhirs))."' and 
						SupplierID='".$r['RMP_REKENING_RELASI']."') 
						as x 
						group by NomorAP Order by NomorAP asc";
				$this->MSSQL=new MSSQL();
				$this->MSSQL->database=$this->CONFIG->mysql_koneksi()->db_nama_mssql_gl;
				$this->MSSQL->queri=$sqlAP;
				$result_AP=$this->MSSQL->data();
				if(count($result_AP)>0)
				{
					foreach($result_AP as $rAP)
					{
						
						$sqlTAGLAP="Select Tanggal From vwGLTrnAPPayment Where ReffNo Is Not Null and NomorAP='".$rAP['NomorAP']."'";
						$this->MSSQL=new MSSQL();
						$this->MSSQL->database=$this->CONFIG->mysql_koneksi()->db_nama_mssql_gl;
						$this->MSSQL->queri=$sqlTAGLAP;
						$rAP['TanggalAP']=Date('d-m-Y',strtotime($this->MSSQL->data()[0]['Tanggal']));
						$sqlFaktur="Select A.NoInvoice, 
									A.Tanggal,A.CurrencyID,
									A.Rate,A.Total,
									A.TransDate as TglBayar,
									A.ReffNo,
									A.CurrencyIDCB, 
									A.Total*A.Rate as IDREquivalent,
									A.CurrencyRateCB,
									A.Total*A.CurrencyRateCB as IDREquivalentCB, 
									(A.CurrencyRateCB)-(A.Rate) as RatePlusMinus,
									B.NoFaktur,B.Tanggal ,B.TglInvoice,
									B.Hutang-B.Creditnote+B.debitnote as NilaiFaktur,
									B.BayarAP		
								From vwGLTrnAPPayment A
									LEFT JOIN vwGLTrnFaktur B 
										ON A.NoInvoice=B.NoFaktur
								Where 	A.NomorAP='".$rAP['NomorAP']."' AND
										A.SupplierID='".$r['RMP_REKENING_RELASI']."'  AND
										B.GroupWil IN (".$material.") AND
										B.KodeSup='".$r['RMP_REKENING_RELASI']."'";
						$this->MSSQL=new MSSQL();
						$this->MSSQL->database=$this->CONFIG->mysql_koneksi()->db_nama_mssql_gl;
						$this->MSSQL->queri=$sqlFaktur;
						$result_Faktur["'".$noAP."'"]=$this->MSSQL->data();
	
						if(count($result_Faktur["'".$noAP."'"])>0)
						{
							foreach($result_Faktur["'".$noAP."'"] as $rFaktur)
							{

								$TotalNilaiAP["'".$no."'"]+=$rFaktur['IDREquivalent'];
								$TotalNilaiInvoice["'".$no."'"]+=$rFaktur['NilaiFaktur'];
								$TotalNilaiBayar["'".$no."'"]+=$rFaktur['IDREquivalentCB'];

								$rFaktur['IDREquivalents']=round($rFaktur['IDREquivalent'],2);
								$rFaktur['TglInvoices']=Date('d-m-Y',strtotime($rFaktur['TglInvoice']));
								$rFaktur['NilaiFakturs']=round($rFaktur['NilaiFaktur'],2);
								$rFaktur['TglBayars']=Date('d-m-Y',strtotime($rFaktur['TglBayar']));
								$rFaktur['IDREquivalentCBs']=round($rFaktur['IDREquivalentCB'],2);

								$NilaiAPs["'".$noAP."'"] +=$rFaktur['IDREquivalent'];								
								$NilaiFakturs["'".$noAP."'"] +=$rFaktur['NilaiFaktur'];					
								$IDREquivalentCBs["'".$noAP."'"] +=$rFaktur['IDREquivalentCB'];

								$result_Fakturss["'".$noAP."'"][]=$rFaktur;
							}
							$rAP['FAKTUR']=$result_Fakturss["'".$noAP."'"];
						}
						else{
							$rAP['FAKTUR']=array();
						}
						//$TotalNilaiFakturSS["'".$no."'"] = $TotalNilaiAP["'".$noAP."'"];


						$rAP['NilaiAP']=$NilaiAPs["'".$noAP."'"];
						$rAP['NilaiBayar']=round($IDREquivalentCBs["'".$noAP."'"],2);
						$rAP['NilaiInvoice']=round($NilaiFakturs["'".$noAP."'"],2);
						$rAP['JumlahInvoice']=count($result_Faktur["'".$noAP."'"]);
						$yF["'".$no."'"][]=$rAP;
						$r['AP']=$yF["'".$no."'"];
						$noAP++;
					}				
				}else{
					$r['AP']=array();
				}

				$r['TotalNilaiAP']=round($TotalNilaiAP["'".$no."'"],2);
				$TotalNilaiAPSS=$TotalNilaiAP["'".$no."'"];
				$r['TotalNilaiInvoice']=round($TotalNilaiInvoice["'".$no."'"],2);
				$TotalNilaiInvoiceSS=$TotalNilaiInvoice["'".$no."'"];
				$r['TotalNilaiBayar']=round($TotalNilaiBayar["'".$no."'"],2);
				$TotalNilaiBayarSS=$TotalNilaiBayar["'".$no."'"];$r['JLH_AP']=count($result_AP);


				$TOTAL_KESELURUHAN_JLH_AP+=$r['JLH_AP'];
				$TotalKeseluruhanNilaiAP+=$TotalNilaiAPSS;
				$TotalKeseluruhanNilaiInvoice+=$TotalNilaiInvoiceSS;
				$TotalKeseluruhanNilaiBayar+=$TotalNilaiBayarSS;



				$result[]=$r;
				$no++;
			}
			$resultTotal=array(
				"TOTAL_KESELURUHAN_JLH_AP"=>$TOTAL_KESELURUHAN_JLH_AP,
				"TotalKeseluruhanNilaiAP"=>round($TotalKeseluruhanNilaiAP,2),
				"TotalKeseluruhanNilaiInvoice"=>round($TotalKeseluruhanNilaiInvoice,2),
				"TotalKeseluruhanNilaiBayar"=>round($TotalKeseluruhanNilaiBayar,2)
			 );
	
			if(empty($result)){
				$this->callback['respon']['pesan']="gagal";
				$this->callback['respon']['text_msg']="Data tidak ada".$posisi.$batas;
				$this->callback['filter']=$params;
				$this->callback['result']=$result;
				//$this->callback['log']=$log;
			}else{
				$this->callback['respon']['pesan']="sukses";
				$this->callback['respon']['text_msg']="OK..";
				$this->callback['filter']=$params;
				$this->callback['result']=$result;
				$this->callback['resultTotal']=$resultTotal;
				//$this->callback['log']=$log;
				$this->callback['result_option']['jml_halaman']=$this->pagging(array('sql'=>$sql,'batas'=>$params['batas'],'tabel'=>$tabel,'dimana_default'=>$dimana_default))->jmlhalaman;
			}

	}else if($JENIS_LAPORAN=="Bulanan")
	{
		$periodeTahunSekarang=$input['TAHUN_FILTER'];
		$periodeBulanSekarang=$input['BULAN_FILTER'];
		$tanggalAwals=$periodeTahunSekarang."-".$periodeBulanSekarang."-01";
		//$input['TAHUN_FILTER'];//MENAMPILKAN TANGGAL TERAKHIR DARI BULAN BERJALAN
		
		$tanggalterakhir =date("Y-m-t", strtotime($periodeTahunSekarang.'-'.$periodeBulanSekarang));
		$tanggalAkhirs=Date('Y-m-d',strtotime($tanggalterakhir));
        $tanggalterakhirnya = date("d",strtotime($tanggalterakhir));
        

        //$begin = new DateTime($tanggalAwals);
        //$end   = new DateTime($tanggalAkhirs);

		if($input['NAMA_SUPPLIER']=="0" or $input['NAMA_SUPPLIER']=="")
			{
				$queri="SELECT P.RMP_MASTER_PERSONAL_NAMA, RR.RMP_REKENING_RELASI FROM RMP_MASTER_PERSONAL AS P 
							LEFT JOIN RMP_REKENING_RELASI AS RR
								ON P.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
							WHERE RR.RMP_REKENING_RELASI LIKE '%".$input['NOMOR_REKENING']."%' AND
								P.RECORD_STATUS='A' AND 
								RR.RECORD_STATUS='A' order by RR.RMP_REKENING_RELASI asc";
			}else
			{
				$queri="SELECT P.RMP_MASTER_PERSONAL_NAMA, RR.RMP_REKENING_RELASI FROM RMP_MASTER_PERSONAL AS P 
							LEFT JOIN RMP_REKENING_RELASI AS RR
								ON P.RMP_MASTER_PERSONAL_ID=RR.RMP_MASTER_PERSONAL_ID
							WHERE RR.RMP_REKENING_RELASI='".$input['NAMA_SUPPLIER']."' AND
								P.RECORD_STATUS='A' AND 
								RR.RECORD_STATUS='A' order by RR.RMP_REKENING_RELASI asc";
			}
			$this->MYSQL=new MYSQL();
			$this->MYSQL->database=$this->CONFIG->mysql_koneksi()->db_nama;
			$this->MYSQL->queri=$queri;
			$result_PERSONEL=$this->MYSQL->data();
			$no=0;
			$noFaktur=0;
			
	
			if ($input['material'] == 'KOPRA'){
				$material = '4';
			  }
			  else if ($input['material'] == 'JAMBUL'){
				$material = '3';
			  }
			  else if ($input['material'] == 'GELONDONG'){
				$material = '2';
			  }
			  else{
				$material = '2,3,4';
			  }
	
			foreach($result_PERSONEL as $r )
			{	//CARI AP PAYMENT
				$sqlAP="select * from (Select NomorAP
						From vwGLTrnAPPayment 
						Where ReffNo Is Not Null and 
						CONVERT(VARCHAR(10),Tanggal,23)>='".Date('Y-m-d',strtotime($tanggalAwals))."' and
						CONVERT(VARCHAR(10),Tanggal,23)<='".Date('Y-m-d',strtotime($tanggalAkhirs))."' and 
						SupplierID='".$r['RMP_REKENING_RELASI']."') 
						as x 
						group by NomorAP Order by NomorAP asc";
				$this->MSSQL=new MSSQL();
				$this->MSSQL->database=$this->CONFIG->mysql_koneksi()->db_nama_mssql_gl;
				$this->MSSQL->queri=$sqlAP;
				$result_AP=$this->MSSQL->data();
				if(count($result_AP)>0)
				{
					foreach($result_AP as $rAP)
					{
						
						$sqlTAGLAP="Select Tanggal From vwGLTrnAPPayment Where ReffNo Is Not Null and NomorAP='".$rAP['NomorAP']."'";
						$this->MSSQL=new MSSQL();
						$this->MSSQL->database=$this->CONFIG->mysql_koneksi()->db_nama_mssql_gl;
						$this->MSSQL->queri=$sqlTAGLAP;
						$rAP['TanggalAP']=Date('d-m-Y',strtotime($this->MSSQL->data()[0]['Tanggal']));
						$sqlFaktur="Select A.NoInvoice, 
									A.Tanggal,A.CurrencyID,
									A.Rate,A.Total,
									A.TransDate as TglBayar,
									A.ReffNo,
									A.CurrencyIDCB, 
									A.Total*A.Rate as IDREquivalent,
									A.CurrencyRateCB,
									A.Total*A.CurrencyRateCB as IDREquivalentCB, 
									(A.CurrencyRateCB)-(A.Rate) as RatePlusMinus,
									B.NoFaktur,B.Tanggal ,B.TglInvoice,
									B.Hutang-B.Creditnote+B.debitnote as NilaiFaktur,
									B.BayarAP		
								From vwGLTrnAPPayment A
									LEFT JOIN vwGLTrnFaktur B 
										ON A.NoInvoice=B.NoFaktur
								Where 	A.NomorAP='".$rAP['NomorAP']."' AND
										A.SupplierID='".$r['RMP_REKENING_RELASI']."'  AND
										B.GroupWil IN (".$material.") AND
										B.KodeSup='".$r['RMP_REKENING_RELASI']."'";
						$this->MSSQL=new MSSQL();
						$this->MSSQL->database=$this->CONFIG->mysql_koneksi()->db_nama_mssql_gl;
						$this->MSSQL->queri=$sqlFaktur;
						$result_Faktur["'".$noAP."'"]=$this->MSSQL->data();
	
						if(count($result_Faktur["'".$noAP."'"])>0)
						{
							foreach($result_Faktur["'".$noAP."'"] as $rFaktur)
							{

								$TotalNilaiAP["'".$no."'"]+=$rFaktur['IDREquivalent'];
								$TotalNilaiInvoice["'".$no."'"]+=$rFaktur['NilaiFaktur'];
								$TotalNilaiBayar["'".$no."'"]+=$rFaktur['IDREquivalentCB'];

								$rFaktur['IDREquivalents']=round($rFaktur['IDREquivalent'],2);
								$rFaktur['TglInvoices']=Date('d-m-Y',strtotime($rFaktur['TglInvoice']));
								$rFaktur['NilaiFakturs']=round($rFaktur['NilaiFaktur'],2);
								$rFaktur['TglBayars']=Date('d-m-Y',strtotime($rFaktur['TglBayar']));
								$rFaktur['IDREquivalentCBs']=round($rFaktur['IDREquivalentCB'],2);

								$NilaiAPs["'".$noAP."'"] +=$rFaktur['IDREquivalent'];								
								$NilaiFakturs["'".$noAP."'"] +=$rFaktur['NilaiFaktur'];					
								$IDREquivalentCBs["'".$noAP."'"] +=$rFaktur['IDREquivalentCB'];

								$result_Fakturss["'".$noAP."'"][]=$rFaktur;
							}
							$rAP['FAKTUR']=$result_Fakturss["'".$noAP."'"];
						}
						else{
							$rAP['FAKTUR']=array();
						}
						//$TotalNilaiFakturSS["'".$no."'"] = $TotalNilaiAP["'".$noAP."'"];


						$rAP['NilaiAP']=$NilaiAPs["'".$noAP."'"];
						$rAP['NilaiBayar']=round($IDREquivalentCBs["'".$noAP."'"],2);
						$rAP['NilaiInvoice']=round($NilaiFakturs["'".$noAP."'"],2);
						$rAP['JumlahInvoice']=count($result_Faktur["'".$noAP."'"]);
						$yF["'".$no."'"][]=$rAP;
						$r['AP']=$yF["'".$no."'"];
						$noAP++;
					}				
				}else{
					$r['AP']=array();
				}

				$r['TotalNilaiAP']=round($TotalNilaiAP["'".$no."'"],2);
				$TotalNilaiAPSS=$TotalNilaiAP["'".$no."'"];
				$r['TotalNilaiInvoice']=round($TotalNilaiInvoice["'".$no."'"],2);
				$TotalNilaiInvoiceSS=$TotalNilaiInvoice["'".$no."'"];
				$r['TotalNilaiBayar']=round($TotalNilaiBayar["'".$no."'"],2);
				$TotalNilaiBayarSS=$TotalNilaiBayar["'".$no."'"];$r['JLH_AP']=count($result_AP);


				$TOTAL_KESELURUHAN_JLH_AP+=$r['JLH_AP'];
				$TotalKeseluruhanNilaiAP+=$TotalNilaiAPSS;
				$TotalKeseluruhanNilaiInvoice+=$TotalNilaiInvoiceSS;
				$TotalKeseluruhanNilaiBayar+=$TotalNilaiBayarSS;



				$result[]=$r;
				$no++;
			}
			$resultTotal=array(
				"TOTAL_KESELURUHAN_JLH_AP"=>$TOTAL_KESELURUHAN_JLH_AP,
				"TotalKeseluruhanNilaiAP"=>round($TotalKeseluruhanNilaiAP,2),
				"TotalKeseluruhanNilaiInvoice"=>round($TotalKeseluruhanNilaiInvoice,2),
				"TotalKeseluruhanNilaiBayar"=>round($TotalKeseluruhanNilaiBayar,2)
			 );
	
			if(empty($result)){
				$this->callback['respon']['pesan']="gagal";
				$this->callback['respon']['text_msg']="Data tidak ada".$posisi.$batas;
				$this->callback['filter']=$params;
				$this->callback['result']=$result;
				//$this->callback['log']=$log;
			}else{
				$this->callback['respon']['pesan']="sukses";
				$this->callback['respon']['text_msg']="OK..";
				$this->callback['filter']=$params;
				$this->callback['result']=$result;
				$this->callback['resultTotal']=$resultTotal;
				//$this->callback['log']=$log;
				$this->callback['result_option']['jml_halaman']=$this->pagging(array('sql'=>$sql,'batas'=>$params['batas'],'tabel'=>$tabel,'dimana_default'=>$dimana_default))->jmlhalaman;
			}
	}else if($JENIS_LAPORAN=="TAHUNAN")
	{

	}else
	{}
?>
