<!-- ASSET FILE -->
<script src="aplikasi/<?php echo $_SESSION['aplikasi']; ?>/asset/js/pdfobject.js"></script>
	<script src="aplikasi/<?php echo $_SESSION['aplikasi']; ?>/asset/js/pdf.js"></script>
    <link href="aplikasi/<?php echo $_SESSION['aplikasi']; ?>/asset/css/themes/explorer-fa/theme.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="aplikasi/<?php echo $_SESSION['aplikasi']; ?>/asset/css/bootstrap-datetimepicker.css" media="all" rel="stylesheet" type="text/css"/>
    <link href="aplikasi/<?php echo $_SESSION['aplikasi']; ?>/asset/css/bootstrap-timepicker.min.css" media="all" rel="stylesheet" type="text/css"/>
     <link href="aplikasi/<?php echo $_SESSION['aplikasi']; ?>/asset/css/bootstrap-timepicker.css" media="all" rel="stylesheet" type="text/css"/>
    <script src="aplikasi/<?php echo $_SESSION['aplikasi']; ?>/asset/js/file/fileinput.js" type="text/javascript"></script>
    <script src="aplikasi/<?php echo $_SESSION['aplikasi']; ?>/asset/js/file/locales/fr.js" type="text/javascript"></script>
    <script src="aplikasi/<?php echo $_SESSION['aplikasi']; ?>/asset/js/file/locales/es.js" type="text/javascript"></script>
    <script src="aplikasi/<?php echo $_SESSION['aplikasi']; ?>/asset/css/themes/explorer-fa/theme.js" type="text/javascript"></script>
    <script src="aplikasi/<?php echo $_SESSION['aplikasi']; ?>/asset/css/themes/fa/theme.js" type="text/javascript"></script>
    <script src="aplikasi/<?php echo $_SESSION['aplikasi']; ?>/asset/js/bootstrap-datetimepicker.js" type="text/javascript"></script>
    <script src="aplikasi/<?php echo $_SESSION['aplikasi']; ?>/asset/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="aplikasi/<?php echo $_SESSION['aplikasi']; ?>/asset/js/bootstrap-timepicker.js" type="text/javascript"></script>
    <script src="aplikasi/<?php echo $_SESSION['aplikasi']; ?>/asset/js/ckeditor5-build-balloon/ckeditor.js" type="text/javascript"></script>
   
    



<!-- -->
<style>
.embed-responsive {
    position: relative;
    display: block;
    height:auto;
    padding: 0;
    overflow: hidden;
}
</style>
<style>
.MemoForm {overflow-y: auto;}
</style>


<style>
.badgebox
{
    opacity: 0;
}

.badgebox + .badge
{
    /* Move the check mark away when unchecked */
    text-indent: -999999px;
    /* Makes the badge's width stay the same checked and unchecked */
	width: 27px;
}

.badgebox:focus + .badge
{
    /* Set something to make the badge looks focused */
    /* This really depends on the application, in my case it was: */
    
    /* Adding a light border */
    box-shadow: inset 0px 0px 5px;
    /* Taking the difference out of the padding */
}

.badgebox:checked + .badge
{
    /* Move the check mark back when checked */
	text-indent: 0;
}
</style>

<div class="row">
	<div class="col-md-12 text-right">
		<button class="btn btn-success FormNew"><strong><i class="fa fa-plus"></i> New</strong></button>
		<button class="btn btn-success btnSend" disabled><strong><i class="fa fa-send"></i> Send</strong></button>
		<button class="btn btn-default btnHapus" disabled><strong><i class="fa fa-trash text-danger"></i></strong></button>
	</div>
</div>

<!--- MODAL -->
<div class="modal fade EventinvitationForm" id="MemoForm" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header ModalHeader">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel"><i class="fa fa-pencil"></i> Form Memo </h4>
      </div>
      <div class="modal-body">

<!-- Select departemen -->
<?php
$cr_data=array(
    'case'=>"nonlogin_search_unit_by_type",
    'batas'=>1,
    'halaman'=>1,
    'user_privileges_data'=>$_COOKIE['data_http'],
    'data'=>$data,
  );

    $SW=new SWITCH_DATA();
    $SW->data_location="local"; //local,external
    $SW->cr_data=$cr_data;
    $SW->CLS=new COMPANY_UNIT(); //nama class -> khusus untuk local data.
    $SW->ref="COMPANY_UNIT"; //nama file --> khusus untuk external data
    $unit=$SW->output();
   # echo "<pre>" .print_r($unit,true). "</pre>"; // print data array

    foreach($unit['query_result'] as $r){
    $departemen[]=$r;
    }
  #  echo $departemen;
?>

         	<form class="fData MemoForm form-group-sm" id="fData" action="javascript:download();">

                <div class="col-md-1" style="border: 1px solid black; height: 90px; align: center;">
                <img class="img-responsive" src="asset/images/logo_laporan.png" alt="Sambu logo" width="100px" height="100px">
                </div>

                <div class="col-md-9" style="border: 1px solid black; height: 30px">
                    <p style="font-weight:bold; font-size: 18px;" align= "center">PT PULAU SAMBU (KUALA ENOK)</p><br>
                </div>

                <div class="col-md-2" style="border: 1px solid black; height: 30px;">
                    <p align="left">Section <label style="padding-left:8px;">:</label>
                        <span class="COMPANY_UNIT_NAME"></span> 
                        <input type="hidden" class="COMPANY_UNIT_ID form-control" name="COMPANY_UNIT_ID" id="COMPANY_UNIT_ID">
                        <input type="hidden" class="COMPANY_UNIT_SHORT form-control" name="COMPANY_UNIT_SHORT" id="COMPANY_UNIT_SHORT">
                    </p>
                    <br>
                </div>

                <div class="col-md-9" style="border: 1px solid black; height: 60px;">
                    <label style="text-align:center; padding-left:45%; font-weight:bold; font-size: 24px; font-family: serif;">MEMO</label>
                    <p style="text-align:center; padding-right:20%; padding-left:20%; font-weight:bold; font-size: 16px; font-family: serif;">
                        <input type="text" class="no_memo form-control" name="no_memo" id="no_memo_id">
                    </p>
                </div>

                 <div class="col-md-2" style="border: 1px solid black; height: 30px;">
                    <p align="left">Revision <label style="padding-left:0px;">:</label> <label>00</label></p>
                </div>

                <div class="col-md-2" style="border: 1px solid black; height: 30px;">
                    <p align="left">Page <label style="padding-left:21px;">:</label> <label>1 of 1</label></p><br/><br/>
                </div>
    

            <!--- Mulai buat isi memo -->    
            <div class="col-md-12" style="border: 1px solid black">
                <div class="form-group row">
                </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Kepada Yth</label>
                        </div>
                            <div class="col-md-4">
                                <input class="form-control input-sm" name="kepada" id="kepada_id" placeholder="Kepada Yth .." type="text">
                            </div>
                                <div class="col-md-6" style="text-align: right;">
                                    <label for="centang" class="btn btn-info">Centang pada kolom ini bila obsolete<input type="checkbox" id="centang" name="obsolete" class="badgebox"><span class="badge">&check;</span></label>
                                </div>   
                    </div>
                
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>CC</label>
                        </div>
                            <div class="col-md-4">
                                <input class="form-control input-sm" name="cc" id="cc_id" placeholder="CC .." type="text">
                            </div> 
                   
                                <div class="col-md-6" style="text-align: right;">
                                   <label >Pilih Departemen yang bisa lihat memo:</label><br> <span>
                                    <select class="selectpicker" id="getProduct_id" data-width="50%" name="pilih_departemen[]" multiple>
                                    <!-- <option value="show-all"></option> -->
                                    <?php foreach($departemen as $r){echo"<option value='$r[COMPANY_UNIT_ID]' $sel>$r[COMPANY_UNIT_ID]-$r[COMPANY_UNIT_NAME]</option>"; } ?>
                                    </select>
                                    </span>
                                </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Dari</label>
                        </div>
                            <div class="col-md-4">
                                <input class="form-control input-sm" id="dari_id" name="dari" placeholder="Dari .." type="text">
                            </div>
                    </div>
               
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Hal</label>
                        </div>
                            <div class="col-md-4">
                                <input id="hal_id" class="form-control input-sm" name="hal" placeholder="Hal .." type="text">   
                            </div>
                    </div>        

                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Tujuan</label>
                        </div>
                            <div class="col-md-4">
                                <input id="tujuan_id" class="form-control input-sm" name="tujuan" placeholder="Tujuan .." type="text">   
                            </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-sm-2">
                            <label>Referensi</label>
                        </div>
                            <div class="col-md-4">
                                <input id="referensi_id" class="form-control input-sm" name="referensi" placeholder="Referensi .." type="text">   
                            </div>
                    </div>

                        <hr style="border-width: 1px;" >

                                <!-- ISI DARI MEMO               -->
                                <div class="form-group row">    
                                    <div class="col-md-12">
                                        <label>KEADAAN SEKARANG</label>
                                        <br>
                                            <div class="form-group">
                                                <textarea class="form-control" name="keadaan_sekarang" id="keadaan_sekarang_id" placeholder="Isikan Keadaan Sekarang .." rows="5"></textarea>
                                            </div>                                    
                                    </div>
                                </div>

                                <div class="form-group row">    
                                    <div class="col-md-12">
                                        <label>KEADAAN YANG DIHARAPKAN / SESUAI</label>
                                        <br>
                                            <div class="form-group">
                                                <textarea class="form-control" name="keadaan_yang_diharapkan" id="keadaan_yang_diharapkan_id" placeholder="Isikan Keadaan Yang diharapkan .." rows="5"></textarea>
                                            </div>                                    
                                    </div>
                                </div>

                                <div class="form-group row">    
                                    <div class="col-md-12">
                                        <label>DATA PENDUKUNG</label>
                                        <br>
                                            <div class="form-group">
                                                <textarea class="form-control" name="data_pendukung" id="data_pendukung_id" placeholder="Isikan Data Pendukung .." rows="5"></textarea>
                                            </div>                                    
                                    </div>
                                </div>

                                <div class="form-group row">    
                                    <div class="col-md-12">
                                        <label>RENCANA KERJA / TINDAKAN YANG AKAN DILAKSANAKAN</label>
                                        <br>
                                            <div class="form-group">
                                                <textarea class="form-control" name="rencana_kerja" id="rencana_kerja_id" placeholder="Isikan Rencana Kerja .." rows="5"></textarea>
                                            </div>                                    
                                    </div>
                                </div>
                               
                                <div class="form-group row">    
                                    <div class="col-md-12">
                                        <label>SCHEDULE KERJA</label>
                                        <br>
                                            <div class="form-group">
                                                <textarea class="form-control" name="schedule_kerja" id="schedule_kerja_id" placeholder="Isikan Schedule Kerja .." rows="5"></textarea>
                                            </div>                                   
                                    </div>
                                </div>

                                <div class="form-group row">    
                                    <div class="col-md-12">
                                        <label>LAIN-LAIN</label>
                                        <br>
                                            <div class="form-group">
                                                <textarea class="form-control" name="lain_lain" id="lain_lain_id" placeholder="Isikan Lain-lain jika ada .." rows="5"></textarea>
                                            </div>                                    
                                    </div>
                                </div>

                                <div class="form-group row">    
                                    <div class="col-md-12">
                                        <label>INSTRUKSI / REKOMENDASI / HIMBAUAN</label>
                                        <br>
                                            <div class="form-group">
                                                <textarea class="form-control" name="instruksi_rekomendasi" id="instruksi_rekomendasi_id" placeholder="Isikan Instruksi / rekomendasi / himbauan .." rows="5"></textarea>
                                            </div>                                    
                                    </div>
                                </div>

                                <div class="form-group row">    
                                    <div class="col-md-3">
                                        <label>PT PSKE, <?php $today = date("d-m-Y"); echo $today; ?></label>   
                                    
                                        <br>
                                            Diterbitkan oleh:
                                    </div>    
                                            <div class="col-sm-5" >
                                                Verified by :&nbsp
                                                <a href="#"><span data-toggle="tooltip" title="Klik icon ini untuk verifikasi" class="glyphicon glyphicon-thumbs-up" style="font-size: 30px;"></span></a> &nbsp                       
                                                <br>
                                                Sign &nbsp &nbsp &nbsp &nbsp &nbsp : <textarea class="form-control" name="komentar" id="komentar_id" placeholder="Isikan Komentar .." rows="4"></textarea>        
                                            </div>
                                               
                                                    
                                                    <div class="col-md-4" >
                                                         Date: <?php $today=date("d-m-Y"); echo $today; ?>
                                                        <br>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="pass_id" name="centang_pass">
                                                                <label class="custom-control-label" for="pass">Pass</label>
                                                            </div>
                                                        <br>
                                                        
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="fail_id" name="centang_fail">
                                                                <label class="custom-control-label" for="fail">Fail</label>
                                                            </div>
                                                        <br>
                                                       
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="close_id" name="centang_close">
                                                                <label class="custom-control-label" for="close">Close</label>
                                                            </div>
                                                    </div>
                                </div>

                                            <div class="form-group row">
                                                <div class="col-md-2">
                                                    <input class="form-control" id="diterbitkan_id" name="diterbitkan" style="text" placeholder="Nama yang menerbitkan memo">
                                                    <span class="COMPANY_STRUKTUR_ORGANISASI_JABATAN_NAME" id="jabatan_id" ></span>
                                                </div>   
                                            </div>                        
                               

            </div>  <!-- Akhir dari buat isi memo -->    

                                                <!-- Ini Nomor Dokumen     -->
                                                <br>   
                                                <div class="form-group row">
                                                    <div class="col-12 col-md-8">
                                                        <label>WIN-PSK-IMS-DDC(STD)-010509-001</label>
                                                    </div>   
                                                        <div class="col-6 col-md-4" style="text-align: right;">
                                                            <label>FRM-PSK-IMS-DOC(STD)-002-00</label>
                                                        </div>        
                                                </div>       
                                                            <!-- Ini Tombol Kirim -->
                                                               <div class="form-group-row">
                                                                    <div class="col-8" style="text-align: right;">
                                                                    <button type="button" class="btn btn-success btnkirim"><strong>Kirim Memo</strong></button>
                                                                    </div>
                                                               </div>     

        </div>
    </div>                        
</div>
                                                

            

 



<script>
$('.FormNew').on('click',function(){
      //  alert("ada");
    $("#MemoForm").modal('show');
    load_data_company();
    
    // var loadModalPilihUnit=function(){
    //  $("#MemoForm").modal('show');
    // }
    // loadModalPilihUnit();
});

$('.btnkirim').on('click',function()
{
    
    var kepada_id=$('input#kepada_id').val();
    var cc_id=$('input#cc_id').val();
    var dari_id=$('input#dari_id').val();
    var hal_id=$('input#hal_id').val();
    var tujuan_id=$('input#tujuan_id').val();
    var referensi_id=$('input#referensi_id').val();
    var keadaan_sekarang_id=$('input#keadaan_sekarang_id').val();
    var keadaan_yang_diharapkan_id=$('input#keadaan_yang_diharapkan_id').val();
    var data_pendukung_id=$('input#data_pendukung_id').val();
    var rencana_kerja_id=$('input#rencana_kerja_id').val();
    var schedule_kerja_id=$('input#schedule_kerja_id').val();
    var lain_lain_id=$('input#lain_lain_id').val();
    var instruksi_rekomendasi_id=$('input#instruksi_rekomendasi_id').val();

    if (kepada_id=='' || cc_id=='' || dari_id=='' || hal_id=='' || tujuan_id=='' || referensi_id=='' || keadaan_sekarang_id=='' || keadaan_yang_diharapkan_id=='' || data_pendukung_id=='' || rencana_kerja_id=='' || schedule_kerja_id=='' || lain_lain_id=='' || instruksi_rekomendasi_id=='')
    {
        var index="Lengkapi data yang kosong!"
    }
        else
        {
           
            var index="";
        }
            if(index!='')
            {
                alert(index);
                return;
            }
                else
                {
                    // alert("aktif")
                    cek_no_memo_ditabel()
                    
                }
    });

// Bersihkan Form Memo
function bersihkan_form()
{
    document.getElementById("kepada_id").value ="";
    document.getElementById("cc_id").value ="";
    document.getElementById("dari_id").value ="";
    document.getElementById("hal_id").value ="";
    document.getElementById("tujuan_id").value ="";
    document.getElementById("referensi_id").value ="";
    document.getElementById("keadaan_sekarang_id").value ="";
    document.getElementById("keadaan_yang_diharapkan_id").value ="";
    document.getElementById("data_pendukung_id").value ="";
    document.getElementById("rencana_kerja_id").value ="";
    document.getElementById("schedule_kerja_id").value ="";
    document.getElementById("lain_lain_id").value ="";
    document.getElementById("instruksi_rekomendasi_id").value ="";
    document.getElementById("komentar_id").value ="";  
    document.getElementById("diterbitkan_id").value =""; 
    document.getElementById("pilih_departemen_id").value ="";
}    

// Script Untuk Tampilkan data Tabel Company
function load_data_company()
{
    $.ajax({
        type:'post',
        dataType:'json',
        url:refseeAPI,
        data:'ref=umum_memo_check_data_login',
        success:function(data)
        {
            //alert("asds");
            //alert(data.result[0].COMPANY_UNIT_ID);
            if (data.respon.pesan=='sukses') 
            {
                $('span.COMPANY_UNIT_NAME').html(data.result[0].COMPANY_UNIT_SHORT_NAME);
                $('input.COMPANY_UNIT_SHORT').val(data.result[0].COMPANY_UNIT_SHORT_NAME);
                $('input#COMPANY_UNIT_ID').val(data.result[0].COMPANY_UNIT_ID); 
                $('input#chairedid').val(data.result[0].PERSONAL_NAME);
                $('input#diterbitkan_id').val(data.result[0].PERSONAL_NAME);
                $('span.COMPANY_STRUKTUR_ORGANISASI_JABATAN_NAME').html(data.result[0].COMPANY_STRUKTUR_ORGANISASI_JABATAN_NAME);
                //$('span.no_event_invitation').html('<span class="no_event_invitation">No. : MAL/'+data.result[0].COMPANY_UNIT_SHORT_NAME+'/SYS/REVIEW(....)/'+data.result[0].TANGGAL_SEKARANG+'-</span>');
                $('input#no_memo_id').val(data.result[0].NO_MEMO);
                $('input#chairedid').attr('Readonly',true);  
                $('input#diterbitkan_id').attr('Readonly',true);
            
                // load_data_select(); 
               // alert(data.respon.text_msg);
            }
            else
            {
                alert(data.respon.text_msg);
            }
            
        },
        error:function(x,e)
        {

        }
    });
}

// function select_data_departemen(){
//     $.ajax({
//         type:'post',
//         dataType:'json',
//         url:refseeAPI,
//         data:'ref=umum_memo_load_data_departemen',
//         success:function(data)
//         {
//             if (data.respon.pesan=='sukses')
//             {
//                 for (ab=0;ab<data.result.length;ab++)
//                 {
//                     $('select.list_requestid').append('<option value="'+data.result[ab].COMPANY_UNIT_NAME+'"></option>');
//                 }
//             }
//         },
//     });
// }

function cek_no_memo_ditabel(){
    var fData=$('#fData').serialize();
    // alert("1 "+fData);
    $.ajax({
        type:'post',
        dataType:'json',
        url:refseeAPI,
        data:'ref=kirim_data_memo&'+fData,
        success:function(data)
        { 

            if (data.respon.pesan=='sukses') 
            {
                alert(data.respon.text_msg);
                 bersihkan_form();
                 $('#MemoForm').modal('hide');
                 
            }
            else
            {   
                alert(data.respon.text_msg);
             }

            // alert(fData);
            // if (data.respon.pesan=='gagal') 
            // {
        
            //     alert('data belum ada');
            //     // var fData=$('#fData').serialize();
            //         //alert(fData);
            //         $.ajax(
            //         {
            //         type:'post',
            //         dataType:'json',
            //         url:refseeAPI, 
            //         data:'ref=kirim_data_memo&'+fData,
            //         success:function(data)
            //         {   
            //             if (data.respon.pesan=='sukses') 
            //             {
            //                 alert(data.respon.text_msg);
            //                 bersihkan_form()
            //                 $('#MemoForm').modal('hide');
            //             }
            //         else
            //             {   
            //                 alert(data.respon.text_msg);
            //             }
            //         },
            //             error:function(x,e)
            //                 {
            //                     alert("Bolang"+data.respon.text_msg);
            //                 }
            //         });
            //     }
            //     else
            //     {
            //         alert('Data sudah ada');
            //         bersihkan_form()
            //     }
                
                // $('#no_memo_id').parent().find('text-warning').text("Nomor memo sudah ada");
                // return apply_feedback_error('#no_memo_id');    
           
        },
        error:function(x,e)
        {
            alert("Bolang"+data.respon.text_msg);
        }

    });
}

$(".KirimAprovalMemo").on('click', function(e) {

});
</script>