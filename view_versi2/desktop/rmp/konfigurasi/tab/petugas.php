<style>

.loader {
  border: 5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 5px solid #3498db;
  width: 40px;
  height: 40px;
  -webkit-animation: spin 2s linear infinite;
  /* Safari */
  animation: spin 2s linear infinite;
}
/* Safari */

@-webkit-keyframes spin {
  0% {
    -webkit-transform: rotate(0deg);
  }
  100% {
    -webkit-transform: rotate(360deg);
  }
}
@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
<a class="btn btn-primary btn-sm tambah_material">Tambah Petugas</a> <!-- <button class="btn btn-primary btn-sm tambah" type="button"><i class="fa fa-plus-square" aria-hidden="true"></i> Tambah Inventori</button> -->
<table class="table table-hover">
  <thead>
    <tr>
      <th>No.</th>
      <th>Petugas</th>
      <th>NIK</th>
      <th>Nama</th>

    </tr>
  </thead>
  <tbody id="zone_data">
    <tr>
      <td colspan="9">
        <center>
          <div class="loader"></div>
        </center>
      </td>
    </tr>
  </tbody>
</table>
<div class="row">
<div class="col-md-9">
<div class="pagination-holder clearfix">
<div class="pagination" id="tujuan-light-pagination"></div>
</div>
</div>
<div class="col-md-3 text-right">
<label>Jumlah Baris Per Halaman</label> <input class="form-control" id="REC_PER_HALAMAN" max='1000' min="1" name="REC_PER_HALAMAN" required="" type="number" value="10">
</div>
</div><!--/row-->
<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalJenisMaterial" role="dialog" tabindex="-1">
	<div class="modal-dialog modalMD" role="document">
		<div class="modal-content ">
			<div class="modal-header ">
				<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Petugas</h4>
			</div>
			<div class="modal-body ">
				<form action="javascript:download();" class="fDataPetugas" id="fDataPetugas" name="fDataPetugas">
							<div class="form-group">
								<label for="exampleInputEmail1">Kode Material</label>
                <select class="PETUGAS form-control" id="PETUGAS" name="PETUGAS">
                  <option value="OPERATOR TIMBANG">Operator Timbang</option>
                  <option value="INSPEKTUR MUTU">Inspektur Mutu</option>
                </select>
								<p class="help-block">Pilih Tipe Petugas.</p>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Nama</label>
                <select class="NIK_PETUGAS with-ajax-personal form-control" data-live-search="true" id="NIK_PETUGAS" name="NIK_PETUGAS" onchange="sel_nama_karyawan()">
                </select>
                <input type="hidden" class="form-control PETUGAS_NAMA" id="PETUGAS_NAMA" name="PETUGAS_NAMA" />
								<p class="help-block">Pilih Nama Petugas.</p>
							</div>
              <div class="form-group">
    						<button class="btn btn-success btn-sm FormKirimPetugas">Simpan</button> <button class="btn btn-default btn-sm BatalJenisMaterial">Batal</button>
          </div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
$('.tambah_material').on('click', function()
{
	$(".modalJenisMaterial").modal('show');
});
$('.BatalJenisMaterial').on('click', function()
{
	$(".modalJenisMaterial").modal('hide');
});

$(function()
{
  sel_nama_karyawan();
});

function sel_nama_karyawan()
{
  var options =
  {
    ajax: {
      url: refseeAPI,
      type: 'POST',
      dataType: 'json',
      data: {
        q: '{{{q}}}',
        ref: 'sel_nama_karyawan',
      }
    },
    locale:
    {
      emptyTitle: 'Pilih Nama'
    },
    log: 3,
    preprocessData: function(data)
    {
      var i, l = data.result.length,
        array = [];
      if (l)
      {
        for (i = 0; i < l; i++)
        {
          array.push($.extend(true, data.result[i],
          {
            // text: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
            // value: data.result[i].RMP_HASIL_TIMBANG_NO_NOTA,
            text: data.result[i].PERSONAL_NAME,
            value: data.result[i].PERSONAL_NIK,
            data:
            {
              subtext: data.result[i].PERSONAL_NIK,
              nama: data.result[i].PERSONAL_NAME,
            }
          }));
        }
      }
      else
      {
      }
      return array;
    }
  };
  $('.NIK_PETUGAS').selectpicker().filter('.with-ajax-personal').ajaxSelectPicker(options);
}

$('select.NIK_PETUGAS').on('change', function()
{
	var nama = $('.NIK_PETUGAS option:selected').data('nama');
	$('input.PETUGAS_NAMA').val(nama);
});

function petugas_list(curPage)
{
  var url = window.location.href;
  var pageA = url.split("#");
  if (pageA[1] == undefined) {} else {
    var pageB = pageA[1].split("page-");
    if (pageB[1] == '') {
      var curPage = curPage;
    } else {
      var curPage = pageB[1];
    }
  }
  $.ajax({
    type: 'POST',
    url: refseeAPI,
    dataType: 'json',
    data: 'ref=petugas_list&batas=' + $('input#REC_PER_HALAMAN').val() + '&halaman=' + curPage + '&keyword=' + $("input#keyword").val(),
    success: function(data) {
      if (data.respon.pesan == "sukses") {
				console.log("Sukses");
        $("tbody#zone_data").empty();
        $('#tujuan-light-pagination').pagination({
          pages: data.result_option.jml_halaman,
          cssStyle: 'light-theme',
          currentPage: curPage,
        });
        for (i = 0; i < data.result.length; i++) {
          $("tbody#zone_data").append("<tr class='detailLogId'  >" +
					"<td >" + data.result[i].NO + ".</td>" +
					"<td>" + data.result[i].RMP_KONFIGURASI_PETUGAS_TIPE + "</td>" +
					"<td>" + data.result[i].RMP_KONFIGURASI_PETUGAS_NIK + "</td>" +
					"<td>" + data.result[i].RMP_KONFIGURASI_PETUGAS_NAMA + "</td>" +
          "</tr>");
					}
      } else if (data.respon.pesan == "gagal") {
        console.log("Gagal");
        $("tbody#zone_data").html("<tr><td colspan='9'><div class='alert alert-danger' role='alert'><span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span> " + data.respon.text_msg + "</div></td></tr>");
      }
    }, //end success
    error: function(x, e) {
      console.log("Error Ajax");
    } //end error
  });
}
$(function() {
  console.log("function");
  petugas_list('1');
});
$(window).on('hashchange', function(e) {
  petugas_list('1');
});
$("input#REC_PER_HALAMAN").on('change', function() {
  petugas_list('1')
});

function search() {
  petugas_list('1');
}


$('.FormKirimPetugas').on('click',function(){
var formpetugas = $('form.fDataPetugas').serialize();

$.ajax({
	type: 'POST',
	url: refseeAPI,
	dataType: 'json',
	data: 'ref=petugas_add&' + formpetugas ,
	success: function(data) {
		if (data.respon.pesan == "sukses")
		{
			console.log(data.respon.text_msg);
			//window.location.href = "?show=rmp/supplier/MASTER_PERSONAL";
      	$(".modalJenisMaterial").modal('hide');
        petugas_list('1');
		}
		else if (data.respon.pesan == "gagal")
		{
			console.log(data.respon.text_msg);
			alert("Gagal Menyimpan");
		}
	}, //end success
	error: function(x, e) {
		console.log("Error Ajax");
	} //end error
});
})
</script>
