RMP_FAKTUR_PURCHASER_RP_KELAPA di RMP_FAKTUR_PURCHASER
RMP_REKAP_FC_PROSES_ADM_PKB di RMP_REKAP_FC
<!-- UPDATE RMP_FAKTUR_PURCHASER SET RMP_FAKTUR_PURCHASER_PURCHASER_NIK='5327' WHERE RMP_FAKTUR_PURCHASER_PURCHASER_NIK='5985'


CREATE TABLE `RMP_REKAP_FC_PROSES` (
	`RMP_REKAP_FC_PROSES_INDEX` INT(11) NOT NULL AUTO_INCREMENT,
	`RMP_REKAP_FC_PROSES_ID` VARCHAR(50) NOT NULL DEFAULT '0',
	`RMP_REKAP_FC_ID` VARCHAR(50) NOT NULL DEFAULT '0',
	`RMP_REKAP_FC_PROSES_NAMA` VARCHAR(50) NOT NULL DEFAULT '0',
	`RMP_REKAP_FC_PROSES_JENIS` VARCHAR(50) NOT NULL DEFAULT '0',
	`RMP_REKAP_FC_PROSES_TANGGAL` DATE NOT NULL,
	`RMP_REKAP_FC_PROSES_BRUTO` INT(11) NOT NULL DEFAULT '0',
	`RMP_REKAP_FC_PROSES_POTONGAN` INT(11) NOT NULL DEFAULT '0',
	`RMP_REKAP_FC_PROSES_NETTO` INT(11) NOT NULL DEFAULT '0',
	`RMP_REKAP_FC_PROSES_RP_KG` INT(11) NOT NULL DEFAULT '0',
	`RMP_REKAP_FC_PROSES_RUPIAH_KB` INT(11) NOT NULL DEFAULT '0',
	`RMP_REKAP_FC_PROSES_TAMBANG` INT(11) NOT NULL DEFAULT '0',
	`RMP_REKAP_FC_PROSES_BIAYA` INT(11) NOT NULL DEFAULT '0',
	`RMP_REKAP_FC_PROSES_RUPIAH_TOTAL` INT(11) NOT NULL DEFAULT '0',
	`ENTRI_OPERATOR` VARCHAR(10) NULL DEFAULT NULL,
	`ENTRI_WAKTU` DATETIME NULL DEFAULT NULL,
	`EDIT_OPERATOR` VARCHAR(10) NULL DEFAULT NULL,
	`EDIT_WAKTU` DATETIME NULL DEFAULT NULL,
	`HAPUS_OPERATOR` VARCHAR(10) NULL DEFAULT NULL,
	`HAPUS_WAKTU` DATETIME NULL DEFAULT NULL,
	`RECORD_STATUS` VARCHAR(2) NULL DEFAULT NULL,
	PRIMARY KEY (`RMP_REKAP_FC_PROSES_INDEX`)
)
COMMENT='FAKTUR CABANG'
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
ROW_FORMAT=COMPACT
; -->
