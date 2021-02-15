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

		if($input['PERSONAL_NIK']=="0" or $input['PERSONAL_NIK']=="")
		{
			if($input['LAPORAN_KERJA_UNIT_ID']=="0" or $input['LAPORAN_KERJA_UNIT_ID']=="")
			{
				$queri="select a.PERSONAL_NIK,a.PERSONAL_NAME from LAPORAN_KERJA_UNIT_DETAIL a
				left join  LAPORAN_KERJA_UNIT b on a.LAPORAN_KERJA_UNIT_ID=b.LAPORAN_KERJA_UNIT_ID
				where 
				b.COMPANY_UNIT_ID='".$COMPANY_UNIT_ID."' and 
				b.RECORD_STATUS='A' and 
				a.RECORD_STATUS='A'";
			}else
			{
				$queri="select a.PERSONAL_NIK,a.PERSONAL_NAME from LAPORAN_KERJA_UNIT_DETAIL a
						where 
						a.LAPORAN_KERJA_UNIT_ID='".$input['LAPORAN_KERJA_UNIT_ID']."' and 
						a.RECORD_STATUS='A'";
			}
		}else
		{
			$queri="select a.PERSONAL_NIK,a.PERSONAL_NAME from LAPORAN_KERJA_UNIT_DETAIL a
						where 
						a.PERSONAL_NIK='".$input['PERSONAL_NIK']."' and 
						a.RECORD_STATUS='A'";
		}
		$this->MYSQL=new MYSQL();
		$this->MYSQL->database=$this->CONFIG->mysql_koneksi()->db_nama;
		$this->MYSQL->queri=$queri;
		$result_PERSONEL=$this->MYSQL->data();
		$no=0;

		foreach($result_PERSONEL as $r )
		{
			$begin = new DateTime($tanggalAwals);
			$end   = new DateTime($tanggalAwals);
			/*
			for($iy = $begin; $iy <= $end; $iy->modify('+1 day'))
			{
				$xy["'".$no."'"][]=$iy->format("Y-m-d");
				$r['TTT'] = $xy["'".$no."'"];
			}
			*/
			for($iy = $begin; $iy <= $end; $iy->modify('+1 day'))
			{
				$tglLaporan=$iy->format("Y-m-d");
				$tglLaporans=explode('-',$tglLaporan);
				$iys['TANGGAL']=$tglLaporans[2]."-".$tglLaporans[1]."-".$tglLaporans[0];

				//AMBIL LAPORAN
				$this->MYSQL=new MYSQL();
				$this->MYSQL->database=$this->CONFIG->mysql_koneksi()->db_nama;
				$this->MYSQL->queri="select * from LAPORAN_KERJA  where LAPORAN_KERJA_TANGGAL='".$tglLaporan."' AND 
									ENTRI_OPERATOR='".$r['PERSONAL_NIK']."' AND RECORD_STATUS='A'";
				$result_DETAIL["'".$no."'"]=$this->MYSQL->data();
				if(count($result_DETAIL["'".$no."'"])>=1)
				{
					$iys['LAPORAN']=$result_DETAIL["'".$no."'"];
				}else
				{
					$iys['LAPORAN']=array();
				}
				//END LAPORAN
				$xy["'".$no."'"][]=$iys;
				$r['DETAIL'] = $xy["'".$no."'"];
			}
			$result[]=$r;
			$no++;
		}


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
		{
			//CARI FAKTUR-INVOICE
			
            $sqlFaktur="Select NoFaktur,Tanggal ,TglInvoice,
			Hutang-Creditnote+debitnote as NilaiFaktur,
			BayarAP
			from vwGLTrnFaktur
            where 
			GroupWil IN (".$material.") and KodeSup='".$r['RMP_REKENING_RELASI']."' and			
			CONVERT(VARCHAR(10),TglInvoice,23)>='".Date('Y-m-d',strtotime($tanggalAwals))."' and
			CONVERT(VARCHAR(10),TglInvoice,23)<='".Date('Y-m-d',strtotime($tanggalAkhirs))."'";

			/*

            $sqlFaktur="Select KodeSup ,SupplierName,NoFaktur,Tanggal ,TglInvoice,
			Hutang-Creditnote+debitnote as NilaiFaktur,
			BayarAP
			from vwGLTrnFaktur
            where 
			GroupWil IN (".$material.") and KodeSup='".$r['RMP_REKENING_RELASI']."' and
				date('Y-m-d',strtotime(Tanggal)>='".Date('Y-m-d',strtotime($tanggalAwals))."' AND 
				date('Y-m-d',strtotime(Tanggal)<='".Date('Y-m-d',strtotime($tanggalAkhirs))."'";
				*/
            $this->MSSQL=new MSSQL();
            $this->MSSQL->database=$this->CONFIG->mysql_koneksi()->db_nama_mssql_gl;
            $this->MSSQL->queri=$sqlFaktur;
			$result_FAKTUR=$this->MSSQL->data();
			if(count($result_FAKTUR)>0)
			{
				foreach($result_FAKTUR as $rFaktur)
				{
					$TotalNilaiFaktur["'".$no."'"]+=$rFaktur['NilaiFaktur'];
					$rFaktur['TglInvoices']=Date('d-m-Y',strtotime($rFaktur['TglInvoice']));
					$rFaktur['NilaiFakturs']=round($rFaktur['NilaiFaktur'],2);
					
					$sqlAP="select top 100 * from(Select NoInvoice,TglInvoice,NomorAP,Tanggal,CurrencyID,
					Rate,Total,
					SupplierID,SupplierName,
					TransDate as TglBayar,ReffNo,CurrencyIDCB, Total*Rate as IDREquivalent,CurrencyRateCB,
					Total*CurrencyRateCB as IDREquivalentCB, (CurrencyRateCB)-(Rate) as RatePlusMinus 
					From vwGLTrnAPPayment 
					Where ReffNo Is Not Null and NoInvoice='".$rFaktur['NoFaktur']."') 
					as x 
					Order by NomorAP desc";
					$this->MSSQL=new MSSQL();
					$this->MSSQL->database=$this->CONFIG->mysql_koneksi()->db_nama_mssql_gl;
					$this->MSSQL->queri=$sqlAP;
					$result_AP["'".$noFaktur."'"]=$this->MSSQL->data();

					if(count($result_AP["'".$noFaktur."'"])>0)
					{
						foreach($result_AP["'".$noFaktur."'"] as $rAP)
						{	
							$rAP['Tanggals']=Date('d-m-Y',strtotime($rAP['Tanggal']));
							$rAP['TglBayars']=Date('d-m-Y',strtotime($rAP['TglBayar']));
							$rAP['IDREquivalents']=round($rAP['IDREquivalent'],2);
							$rAP['IDREquivalentCBs']=round($rAP['IDREquivalentCB'],2);
							$result_APss["'".$noFaktur."'"][]=$rAP;
							$NilaiBayarFakturs["'".$noFaktur."'"] +=$rAP['IDREquivalentCB'];
							

						}
						$rFaktur['AP']=$result_APss["'".$noFaktur."'"];
					}
					else{
						$NilaiBayarFakturs["'".$noFaktur."'"]=0;
						$rFaktur['AP']=array();

					}
					$TotalNilaiBayarFaktur["'".$no."'"] +=$NilaiBayarFakturs["'".$noFaktur."'"];


					$rFaktur['JumlahAPFaktur']=count($result_AP["'".$noFaktur."'"]);
					$rFaktur['NilaiBayarFaktur']=round($NilaiBayarFakturs["'".$noFaktur."'"],2);
					$rFaktur['SisaHutangFaktur']=round(($rFaktur['NilaiFaktur']-$NilaiBayarFakturs["'".$noFaktur."'"]),2);

					$yF["'".$no."'"][]=$rFaktur;
					$r['FAKTUR']=$yF["'".$no."'"];
					$noFaktur++;
				}				
			}else{
				$r['FAKTUR']=array();
			}
			$TotalNilaiFakturSS			=$TotalNilaiFaktur["'".$no."'"];
			$TotalNilaiBayarFakturSS	=$TotalNilaiBayarFaktur["'".$no."'"];
			$r['TotalNilaiFaktur']=round($TotalNilaiFaktur["'".$no."'"],2);
			$r['TotalNilaiBayarFaktur']=round($TotalNilaiBayarFaktur["'".$no."'"],2);
			$r['TotalSisaHutangFaktur']=round(($TotalNilaiFaktur["'".$no."'"]-$TotalNilaiBayarFaktur["'".$no."'"]),2);
			$r['JLH_FAKTUR']=count($result_FAKTUR);

			$TOTAL_KESELURUHAN_JLH_FAKTUR+=$r['JLH_FAKTUR'];
			$TotalKeseluruhanNilaiFaktur+=$TotalNilaiFakturSS;
			$TotalKeseluruhanNilaiBayarFaktur+=$TotalNilaiBayarFakturSS;
			$result[]=$r;
			$no++;
		}
		$resultTotal=array(
							"TOTAL_KESELURUHAN_JLH_FAKTUR"=>$TOTAL_KESELURUHAN_JLH_FAKTUR,
							"TotalKeseluruhanNilaiFaktur"=>round($TotalKeseluruhanNilaiFaktur,2),
							"TotalKeseluruhanNilaiBayarFaktur"=>round($TotalKeseluruhanNilaiBayarFaktur,2),
							"TotalKeseluruhanSisaHutangFaktur"=>round(($TotalKeseluruhanNilaiFaktur-$TotalKeseluruhanNilaiBayarFaktur),2)
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
		{
			//CARI FAKTUR-INVOICE
			
            $sqlFaktur="Select NoFaktur,Tanggal ,TglInvoice,
			Hutang-Creditnote+debitnote as NilaiFaktur,
			BayarAP
			from vwGLTrnFaktur
            where 
			GroupWil IN (".$material.") and KodeSup='".$r['RMP_REKENING_RELASI']."' and			
			CONVERT(VARCHAR(10),TglInvoice,23)>='".Date('Y-m-d',strtotime($tanggalAwals))."' and
			CONVERT(VARCHAR(10),TglInvoice,23)<='".Date('Y-m-d',strtotime($tanggalAkhirs))."'";

			/*

            $sqlFaktur="Select KodeSup ,SupplierName,NoFaktur,Tanggal ,TglInvoice,
			Hutang-Creditnote+debitnote as NilaiFaktur,
			BayarAP
			from vwGLTrnFaktur
            where 
			GroupWil IN (".$material.") and KodeSup='".$r['RMP_REKENING_RELASI']."' and
				date('Y-m-d',strtotime(Tanggal)>='".Date('Y-m-d',strtotime($tanggalAwals))."' AND 
				date('Y-m-d',strtotime(Tanggal)<='".Date('Y-m-d',strtotime($tanggalAkhirs))."'";
				*/
            $this->MSSQL=new MSSQL();
            $this->MSSQL->database=$this->CONFIG->mysql_koneksi()->db_nama_mssql_gl;
            $this->MSSQL->queri=$sqlFaktur;
			$result_FAKTUR=$this->MSSQL->data();
			if(count($result_FAKTUR)>0)
			{
				foreach($result_FAKTUR as $rFaktur)
				{
					$TotalNilaiFaktur["'".$no."'"]+=$rFaktur['NilaiFaktur'];
					$rFaktur['TglInvoices']=Date('d-m-Y',strtotime($rFaktur['TglInvoice']));
					$rFaktur['NilaiFakturs']=round($rFaktur['NilaiFaktur'],2);
					
					$sqlAP="select top 100 * from(Select NoInvoice,TglInvoice,NomorAP,Tanggal,CurrencyID,
					Rate,Total,
					SupplierID,SupplierName,
					TransDate as TglBayar,ReffNo,CurrencyIDCB, Total*Rate as IDREquivalent,CurrencyRateCB,
					Total*CurrencyRateCB as IDREquivalentCB, (CurrencyRateCB)-(Rate) as RatePlusMinus 
					From vwGLTrnAPPayment 
					Where ReffNo Is Not Null and NoInvoice='".$rFaktur['NoFaktur']."') 
					as x 
					Order by NomorAP desc";
					$this->MSSQL=new MSSQL();
					$this->MSSQL->database=$this->CONFIG->mysql_koneksi()->db_nama_mssql_gl;
					$this->MSSQL->queri=$sqlAP;
					$result_AP["'".$noFaktur."'"]=$this->MSSQL->data();

					if(count($result_AP["'".$noFaktur."'"])>0)
					{
						foreach($result_AP["'".$noFaktur."'"] as $rAP)
						{	
							$rAP['Tanggals']=Date('d-m-Y',strtotime($rAP['Tanggal']));
							$rAP['TglBayars']=Date('d-m-Y',strtotime($rAP['TglBayar']));
							$rAP['IDREquivalents']=round($rAP['IDREquivalent'],2);
							$rAP['IDREquivalentCBs']=round($rAP['IDREquivalentCB'],2);
							$result_APss["'".$noFaktur."'"][]=$rAP;
							$NilaiBayarFakturs["'".$noFaktur."'"] +=$rAP['IDREquivalentCB'];

						}
						$rFaktur['AP']=$result_APss["'".$noFaktur."'"];
					}
					else{
						$NilaiBayarFakturs["'".$noFaktur."'"]=0;
						$rFaktur['AP']=array();

					}
					$TotalNilaiBayarFaktur["'".$no."'"] +=$NilaiBayarFakturs["'".$noFaktur."'"];


					$rFaktur['JumlahAPFaktur']=count($result_AP["'".$noFaktur."'"]);
					$rFaktur['NilaiBayarFaktur']=round($NilaiBayarFakturs["'".$noFaktur."'"],2);
					$rFaktur['SisaHutangFaktur']=round(($rFaktur['NilaiFaktur']-$NilaiBayarFakturs["'".$noFaktur."'"]),2);

					$yF["'".$no."'"][]=$rFaktur;
					$r['FAKTUR']=$yF["'".$no."'"];
					$noFaktur++;
				}				
			}else{
				$r['FAKTUR']=array();
			}
			$TotalNilaiFakturSS			=$TotalNilaiFaktur["'".$no."'"];
			$TotalNilaiBayarFakturSS	=$TotalNilaiBayarFaktur["'".$no."'"];
			$r['TotalNilaiFaktur']=round($TotalNilaiFaktur["'".$no."'"],2);
			$r['TotalNilaiBayarFaktur']=round($TotalNilaiBayarFaktur["'".$no."'"],2);
			$r['TotalSisaHutangFaktur']=round(($TotalNilaiFaktur["'".$no."'"]-$TotalNilaiBayarFaktur["'".$no."'"]),2);
			$r['JLH_FAKTUR']=count($result_FAKTUR);

			$TOTAL_KESELURUHAN_JLH_FAKTUR+=$r['JLH_FAKTUR'];
			$TotalKeseluruhanNilaiFaktur+=$TotalNilaiFakturSS;
			$TotalKeseluruhanNilaiBayarFaktur+=$TotalNilaiBayarFakturSS;
			$result[]=$r;
			$no++;
		}
		$resultTotal=array(
							"TOTAL_KESELURUHAN_JLH_FAKTUR"=>$TOTAL_KESELURUHAN_JLH_FAKTUR,
							"TotalKeseluruhanNilaiFaktur"=>round($TotalKeseluruhanNilaiFaktur,2),
							"TotalKeseluruhanNilaiBayarFaktur"=>round($TotalKeseluruhanNilaiBayarFaktur,2),
							"TotalKeseluruhanSisaHutangFaktur"=>round(($TotalKeseluruhanNilaiFaktur-$TotalKeseluruhanNilaiBayarFaktur),2)
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
