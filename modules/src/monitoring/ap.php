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
				//CARI FAKTUR-INVOICE
				
				$sqlFaktur="Select NoFaktur,Tanggal ,TglInvoice,
				Hutang-Creditnote+debitnote as NilaiFaktur,debitnote,Creditnote,
				Hutang-Creditnote as NilaiInvoice,
				BayarAP
				from vwGLTrnFaktur
				where 
				GroupWil IN (".$material.") and KodeSup='".$r['RMP_REKENING_RELASI']."' and			
				CONVERT(VARCHAR(10),TglInvoice,23)='".$tanggalAwals."'";
	
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
						$noAP["'".$noFaktur."'"]=0;
						$TotalNilaiFaktur["'".$no."'"]+=$rFaktur['NilaiFaktur'];
						$TotalNilaiInvoice["'".$no."'"]+=$rFaktur['NilaiInvoice'];
						$Totaldebitnote["'".$no."'"]+=$rFaktur['debitnote'];
						$rFaktur['TglInvoices']=Date('d-m-Y',strtotime($rFaktur['TglInvoice']));
						$rFaktur['NilaiFakturs']=round($rFaktur['NilaiFaktur'],2);
						$rFaktur['debitnotes']=round($rFaktur['debitnote'],2);
						$rFaktur['NilaiInvoices']=round($rFaktur['NilaiInvoice'],2);
						
						$sqlAP="select * from(Select NoInvoice,TglInvoice,NomorAP,Tanggal,CurrencyID,
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
								
								$JlhBayar["'".$noFaktur."'"]+=$rAP['IDREquivalentCB'];
								if($noAP["'".$noFaktur."'"]==0)
								{
									$hutang1=$rFaktur['NilaiInvoice']-$rAP['IDREquivalentCB'];
								}else{
									$hutang1=$rFaktur['NilaiInvoice']-$JlhBayar["'".$noFaktur."'"];
								}
								$rAP['HutangAP']=round($hutang1,2);

								$rAP['Tanggals']=Date('d-m-Y',strtotime($rAP['Tanggal']));
								$rAP['TglBayars']=Date('d-m-Y',strtotime($rAP['TglBayar']));
								$rAP['IDREquivalents']=round($rAP['IDREquivalent'],2);
								$rAP['IDREquivalentCBs']=round($rAP['IDREquivalentCB'],2);
								$result_APss["'".$noFaktur."'"][]=$rAP;
								$NilaiBayarFakturs["'".$noFaktur."'"] +=$rAP['IDREquivalentCB'];
								$NilaiBayarAPs["'".$noFaktur."'"] +=$rAP['IDREquivalent'];
								$noAP["'".$noFaktur."'"]++;
							}
							$rFaktur['AP']=$result_APss["'".$noFaktur."'"];
						}
						else{
							$NilaiBayarFakturs["'".$noFaktur."'"]=0;
							$NilaiBayarAPs["'".$noFaktur."'"]=0;
							$rFaktur['AP']=array();
	
						}
						$TotalNilaiBayarFaktur["'".$no."'"] +=$NilaiBayarFakturs["'".$noFaktur."'"];
						$TotalNilaiBayarAP["'".$no."'"] +=$NilaiBayarAPs["'".$noFaktur."'"];
	
	
						$rFaktur['JumlahAPFaktur']=count($result_AP["'".$noFaktur."'"]);
						$rFaktur['NilaiBayarFaktur']=round($NilaiBayarFakturs["'".$noFaktur."'"],2);
						$rFaktur['NilaiBayarAP']=round($NilaiBayarAPs["'".$noFaktur."'"],2);
						$rFaktur['SisaHutangFaktur']=round(($rFaktur['NilaiInvoice']-$NilaiBayarFakturs["'".$noFaktur."'"]),2);
	
						$yF["'".$no."'"][]=$rFaktur;
						$r['FAKTUR']=$yF["'".$no."'"];
						$noFaktur++;
					}				
				}else{
					$r['FAKTUR']=array();
				}
				$TotalNilaiFakturSS			=$TotalNilaiFaktur["'".$no."'"];
				$TotalNilaiInvoiceSS		=$TotalNilaiInvoice["'".$no."'"];
				$TotaldebitnoteSS			=$Totaldebitnote["'".$no."'"];
				$TotalNilaiBayarFakturSS	=$TotalNilaiBayarFaktur["'".$no."'"];
				$TotalNilaiBayarAPSS		=$TotalNilaiBayarAP["'".$no."'"];

				$r['TotalNilaiFaktur']=round($TotalNilaiFaktur["'".$no."'"],2);
				$r['TotalNilaiInvoice']=round($TotalNilaiInvoice["'".$no."'"],2);
				$r['Totaldebitnote']=round($Totaldebitnote["'".$no."'"],2);

				$r['TotalNilaiBayarFaktur']=round($TotalNilaiBayarFaktur["'".$no."'"],2);
				$r['TotalNilaiBayarAP']=round($TotalNilaiBayarAP["'".$no."'"],2);
				$r['TotalSisaHutangFaktur']=round(($TotalNilaiInvoice["'".$no."'"]-$TotalNilaiBayarFaktur["'".$no."'"]),2);
				$r['JLH_FAKTUR']=count($result_FAKTUR);
	
				$TOTAL_KESELURUHAN_JLH_FAKTUR+=$r['JLH_FAKTUR'];
				$TotalKeseluruhanNilaiFaktur+=$TotalNilaiFakturSS;
				$TotalKeseluruhanNilaiInvoice+=$TotalNilaiInvoiceSS;
				$TotalKeseluruhandebitnote+=$TotaldebitnoteSS;
				$TotalKeseluruhanNilaiBayarAP+=$TotalNilaiBayarAPSS;
				$TotalKeseluruhanNilaiBayarFaktur+=$TotalNilaiBayarFakturSS;
				$result[]=$r;
				$no++;
			}
			$resultTotal=array(
								"TOTAL_KESELURUHAN_JLH_FAKTUR"=>$TOTAL_KESELURUHAN_JLH_FAKTUR,
								"TotalKeseluruhanNilaiFaktur"=>round($TotalKeseluruhanNilaiFaktur,2),
								"TotalKeseluruhanNilaiInvoice"=>round($TotalKeseluruhanNilaiInvoice,2),
								"TotalKeseluruhandebitnote"=>round($TotalKeseluruhandebitnote,2),
								"TotalKeseluruhanNilaiBayarFaktur"=>round($TotalKeseluruhanNilaiBayarFaktur,2),
								"TotalKeseluruhanNilaiBayarAP"=>round($TotalKeseluruhanNilaiBayarAP,2),
								"TotalKeseluruhanSisaHutangFaktur"=>round(($TotalKeseluruhanNilaiInvoice-$TotalKeseluruhanNilaiBayarFaktur),2)
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
		{
			//CARI FAKTUR-INVOICE
			
            $sqlFaktur="Select NoFaktur,Tanggal ,TglInvoice,
			Hutang-Creditnote+debitnote as NilaiFaktur,debitnote,Creditnote,
			Hutang-Creditnote as NilaiInvoice,
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
						$noAP["'".$noFaktur."'"]=0;
						$TotalNilaiFaktur["'".$no."'"]+=$rFaktur['NilaiFaktur'];
						$TotalNilaiInvoice["'".$no."'"]+=$rFaktur['NilaiInvoice'];
						$Totaldebitnote["'".$no."'"]+=$rFaktur['debitnote'];
						$rFaktur['TglInvoices']=Date('d-m-Y',strtotime($rFaktur['TglInvoice']));
						$rFaktur['NilaiFakturs']=round($rFaktur['NilaiFaktur'],2);
						$rFaktur['debitnotes']=round($rFaktur['debitnote'],2);
						$rFaktur['NilaiInvoices']=round($rFaktur['NilaiInvoice'],2);
						
						$sqlAP="select * from(Select NoInvoice,TglInvoice,NomorAP,Tanggal,CurrencyID,
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
								
								$JlhBayar["'".$noFaktur."'"]+=$rAP['IDREquivalentCB'];
								if($noAP["'".$noFaktur."'"]==0)
								{
									$hutang1=$rFaktur['NilaiInvoice']-$rAP['IDREquivalentCB'];
								}else{
									$hutang1=$rFaktur['NilaiInvoice']-$JlhBayar["'".$noFaktur."'"];
								}
								$rAP['HutangAP']=round($hutang1,2);

								$rAP['Tanggals']=Date('d-m-Y',strtotime($rAP['Tanggal']));
								$rAP['TglBayars']=Date('d-m-Y',strtotime($rAP['TglBayar']));
								$rAP['IDREquivalents']=round($rAP['IDREquivalent'],2);
								$rAP['IDREquivalentCBs']=round($rAP['IDREquivalentCB'],2);
								$result_APss["'".$noFaktur."'"][]=$rAP;
								$NilaiBayarFakturs["'".$noFaktur."'"] +=$rAP['IDREquivalentCB'];
								$NilaiBayarAPs["'".$noFaktur."'"] +=$rAP['IDREquivalent'];
								$noAP["'".$noFaktur."'"]++;
							}
							$rFaktur['AP']=$result_APss["'".$noFaktur."'"];
						}
						else{
							$NilaiBayarFakturs["'".$noFaktur."'"]=0;
							$NilaiBayarAPs["'".$noFaktur."'"]=0;
							$rFaktur['AP']=array();
	
						}
						$TotalNilaiBayarFaktur["'".$no."'"] +=$NilaiBayarFakturs["'".$noFaktur."'"];
						$TotalNilaiBayarAP["'".$no."'"] +=$NilaiBayarAPs["'".$noFaktur."'"];
	
	
						$rFaktur['JumlahAPFaktur']=count($result_AP["'".$noFaktur."'"]);
						$rFaktur['NilaiBayarFaktur']=round($NilaiBayarFakturs["'".$noFaktur."'"],2);
						$rFaktur['NilaiBayarAP']=round($NilaiBayarAPs["'".$noFaktur."'"],2);
						$rFaktur['SisaHutangFaktur']=round(($rFaktur['NilaiInvoice']-$NilaiBayarFakturs["'".$noFaktur."'"]),2);
	
						$yF["'".$no."'"][]=$rFaktur;
						$r['FAKTUR']=$yF["'".$no."'"];
						$noFaktur++;
					}				
				}else{
					$r['FAKTUR']=array();
				}
				$TotalNilaiFakturSS			=$TotalNilaiFaktur["'".$no."'"];
				$TotalNilaiInvoiceSS		=$TotalNilaiInvoice["'".$no."'"];
				$TotaldebitnoteSS			=$Totaldebitnote["'".$no."'"];
				$TotalNilaiBayarFakturSS	=$TotalNilaiBayarFaktur["'".$no."'"];
				$TotalNilaiBayarAPSS		=$TotalNilaiBayarAP["'".$no."'"];

				$r['TotalNilaiFaktur']=round($TotalNilaiFaktur["'".$no."'"],2);
				$r['TotalNilaiInvoice']=round($TotalNilaiInvoice["'".$no."'"],2);
				$r['Totaldebitnote']=round($Totaldebitnote["'".$no."'"],2);

				$r['TotalNilaiBayarFaktur']=round($TotalNilaiBayarFaktur["'".$no."'"],2);
				$r['TotalNilaiBayarAP']=round($TotalNilaiBayarAP["'".$no."'"],2);
				$r['TotalSisaHutangFaktur']=round(($TotalNilaiInvoice["'".$no."'"]-$TotalNilaiBayarFaktur["'".$no."'"]),2);
				$r['JLH_FAKTUR']=count($result_FAKTUR);
	
				$TOTAL_KESELURUHAN_JLH_FAKTUR+=$r['JLH_FAKTUR'];
				$TotalKeseluruhanNilaiFaktur+=$TotalNilaiFakturSS;
				$TotalKeseluruhanNilaiInvoice+=$TotalNilaiInvoiceSS;
				$TotalKeseluruhandebitnote+=$TotaldebitnoteSS;
				$TotalKeseluruhanNilaiBayarAP+=$TotalNilaiBayarAPSS;
				$TotalKeseluruhanNilaiBayarFaktur+=$TotalNilaiBayarFakturSS;
				$result[]=$r;
				$no++;
			}
			$resultTotal=array(
								"TOTAL_KESELURUHAN_JLH_FAKTUR"=>$TOTAL_KESELURUHAN_JLH_FAKTUR,
								"TotalKeseluruhanNilaiFaktur"=>round($TotalKeseluruhanNilaiFaktur,2),
								"TotalKeseluruhanNilaiInvoice"=>round($TotalKeseluruhanNilaiInvoice,2),
								"TotalKeseluruhandebitnote"=>round($TotalKeseluruhandebitnote,2),
								"TotalKeseluruhanNilaiBayarFaktur"=>round($TotalKeseluruhanNilaiBayarFaktur,2),
								"TotalKeseluruhanNilaiBayarAP"=>round($TotalKeseluruhanNilaiBayarAP,2),
								"TotalKeseluruhanSisaHutangFaktur"=>round(($TotalKeseluruhanNilaiInvoice-$TotalKeseluruhanNilaiBayarFaktur),2)
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
			Hutang-Creditnote+debitnote as NilaiFaktur,debitnote,Creditnote,
			Hutang-Creditnote as NilaiInvoice,
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
						$noAP["'".$noFaktur."'"]=0;
						$TotalNilaiFaktur["'".$no."'"]+=$rFaktur['NilaiFaktur'];
						$TotalNilaiInvoice["'".$no."'"]+=$rFaktur['NilaiInvoice'];
						$Totaldebitnote["'".$no."'"]+=$rFaktur['debitnote'];
						$rFaktur['TglInvoices']=Date('d-m-Y',strtotime($rFaktur['TglInvoice']));
						$rFaktur['NilaiFakturs']=round($rFaktur['NilaiFaktur'],2);
						$rFaktur['debitnotes']=round($rFaktur['debitnote'],2);
						$rFaktur['NilaiInvoices']=round($rFaktur['NilaiInvoice'],2);
						
						$sqlAP="select * from(Select NoInvoice,TglInvoice,NomorAP,Tanggal,CurrencyID,
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
								
								$JlhBayar["'".$noFaktur."'"]+=$rAP['IDREquivalentCB'];
								if($noAP["'".$noFaktur."'"]==0)
								{
									$hutang1=$rFaktur['NilaiInvoice']-$rAP['IDREquivalentCB'];
								}else{
									$hutang1=$rFaktur['NilaiInvoice']-$JlhBayar["'".$noFaktur."'"];
								}
								$rAP['HutangAP']=round($hutang1,2);

								$rAP['Tanggals']=Date('d-m-Y',strtotime($rAP['Tanggal']));
								$rAP['TglBayars']=Date('d-m-Y',strtotime($rAP['TglBayar']));
								$rAP['IDREquivalents']=round($rAP['IDREquivalent'],2);
								$rAP['IDREquivalentCBs']=round($rAP['IDREquivalentCB'],2);
								$result_APss["'".$noFaktur."'"][]=$rAP;
								$NilaiBayarFakturs["'".$noFaktur."'"] +=$rAP['IDREquivalentCB'];
								$NilaiBayarAPs["'".$noFaktur."'"] +=$rAP['IDREquivalent'];
								$noAP["'".$noFaktur."'"]++;
							}
							$rFaktur['AP']=$result_APss["'".$noFaktur."'"];
						}
						else{
							$NilaiBayarFakturs["'".$noFaktur."'"]=0;
							$NilaiBayarAPs["'".$noFaktur."'"]=0;
							$rFaktur['AP']=array();
	
						}
						$TotalNilaiBayarFaktur["'".$no."'"] +=$NilaiBayarFakturs["'".$noFaktur."'"];
						$TotalNilaiBayarAP["'".$no."'"] +=$NilaiBayarAPs["'".$noFaktur."'"];
	
	
						$rFaktur['JumlahAPFaktur']=count($result_AP["'".$noFaktur."'"]);
						$rFaktur['NilaiBayarFaktur']=round($NilaiBayarFakturs["'".$noFaktur."'"],2);
						$rFaktur['NilaiBayarAP']=round($NilaiBayarAPs["'".$noFaktur."'"],2);
						$rFaktur['SisaHutangFaktur']=round(($rFaktur['NilaiInvoice']-$NilaiBayarFakturs["'".$noFaktur."'"]),2);
	
						$yF["'".$no."'"][]=$rFaktur;
						$r['FAKTUR']=$yF["'".$no."'"];
						$noFaktur++;
					}				
				}else{
					$r['FAKTUR']=array();
				}
				$TotalNilaiFakturSS			=$TotalNilaiFaktur["'".$no."'"];
				$TotalNilaiInvoiceSS		=$TotalNilaiInvoice["'".$no."'"];
				$TotaldebitnoteSS			=$Totaldebitnote["'".$no."'"];
				$TotalNilaiBayarFakturSS	=$TotalNilaiBayarFaktur["'".$no."'"];
				$TotalNilaiBayarAPSS		=$TotalNilaiBayarAP["'".$no."'"];

				$r['TotalNilaiFaktur']=round($TotalNilaiFaktur["'".$no."'"],2);
				$r['TotalNilaiInvoice']=round($TotalNilaiInvoice["'".$no."'"],2);
				$r['Totaldebitnote']=round($Totaldebitnote["'".$no."'"],2);

				$r['TotalNilaiBayarFaktur']=round($TotalNilaiBayarFaktur["'".$no."'"],2);
				$r['TotalNilaiBayarAP']=round($TotalNilaiBayarAP["'".$no."'"],2);
				$r['TotalSisaHutangFaktur']=round(($TotalNilaiInvoice["'".$no."'"]-$TotalNilaiBayarFaktur["'".$no."'"]),2);
				$r['JLH_FAKTUR']=count($result_FAKTUR);
	
				$TOTAL_KESELURUHAN_JLH_FAKTUR+=$r['JLH_FAKTUR'];
				$TotalKeseluruhanNilaiFaktur+=$TotalNilaiFakturSS;
				$TotalKeseluruhanNilaiInvoice+=$TotalNilaiInvoiceSS;
				$TotalKeseluruhandebitnote+=$TotaldebitnoteSS;
				$TotalKeseluruhanNilaiBayarAP+=$TotalNilaiBayarAPSS;
				$TotalKeseluruhanNilaiBayarFaktur+=$TotalNilaiBayarFakturSS;
				$result[]=$r;
				$no++;
			}
			$resultTotal=array(
								"TOTAL_KESELURUHAN_JLH_FAKTUR"=>$TOTAL_KESELURUHAN_JLH_FAKTUR,
								"TotalKeseluruhanNilaiFaktur"=>round($TotalKeseluruhanNilaiFaktur,2),
								"TotalKeseluruhanNilaiInvoice"=>round($TotalKeseluruhanNilaiInvoice,2),
								"TotalKeseluruhandebitnote"=>round($TotalKeseluruhandebitnote,2),
								"TotalKeseluruhanNilaiBayarFaktur"=>round($TotalKeseluruhanNilaiBayarFaktur,2),
								"TotalKeseluruhanNilaiBayarAP"=>round($TotalKeseluruhanNilaiBayarAP,2),
								"TotalKeseluruhanSisaHutangFaktur"=>round(($TotalKeseluruhanNilaiInvoice-$TotalKeseluruhanNilaiBayarFaktur),2)
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
