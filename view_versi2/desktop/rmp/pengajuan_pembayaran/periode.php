<style>
  .modalMD {
    width: 1000px;
  }

  .modal {
    overflow-y: auto;
  }

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

  table {
    font-size: 12px;
  }
</style>
<script src="aplikasi/inventory_dept/asset/js/jquery.mask.min.js" type="text/javascript"></script>
<div class="row">
  <div class="col-lg-12 col-md-12">
    <div class="list-group">
      <div class="list-group-item">
        <div class="row">
          <div class="col-md-8">
            <h3><i class="fa fa-money"></i> Periode Pembayaran</h3>
            <hr>
          </div>
          <div class="col-md-4 text-right">

          </div>
        </div>
        <!--/.row-->

        <br>
        <div class="row">
          <div class="col-md-12">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Tanggal</th>
                  <th>Total Dana</th>
                  <th>Dana Kasir</th>
                  <th>Dana Cabang</th>
                  <th>Dana Faktur</th>
                  <th></th>
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
                <label>Jumlah Baris Per Halaman</label> <input class="form-control" id="REC_PER_HALAMAN" max='1000' min="1" name="REC_PER_HALAMAN" required="" type="number" value="150">
              </div>
            </div>
            <!--/row-->
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalPembagian" role="dialog" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pembagian Dana Material</h4>
      </div>
      <div class="modal-body">

        <form action="javascript:download();" class="fDataPembagianDana form-horizontal" id="fDataPembagianDana" name="fDataPembagianDana">
          <div class="form-group">
            <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Sisa Dana Material</label>
            <div class="col-sm-8">
              <p class="sisa_dana_material_p"></p>
              <input autocomplete="off" class="form-control TOTAL_DANA_MATERIAL" id="TOTAL_DANA_MATERIAL" name="TOTAL_DANA_MATERIAL" placeholder="" type="hidden">
              <p class="alert_pembagian_dana help-block"> </p>
            </div>
          </div>
          <hr>
          <div class="form-group">
            <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Kasir</label>
            <div class="col-sm-8">
              <input autocomplete="off" class="form-control ID_PEMBAGIAN_DANA_PERIODE" id="ID_PEMBAGIAN_DANA_PERIODE" name="ID_PEMBAGIAN_DANA_PERIODE" placeholder="" type="hidden">
              <input autocomplete="off" class="form-control DANA_KASIR" id="DANA_KASIR" name="DANA_KASIR" placeholder="" type="text" onkeyup="kalkulasi_pembagian()">
            </div>
          </div>
          <div class="form-group">
            <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Cabang</label>
            <div class="col-sm-8">
              <input autocomplete="off" class="form-control DANA_CABANG" id="DANA_CABANG" name="DANA_CABANG" placeholder="" type="number" onkeyup="kalkulasi_pembagian()" value="0">
            </div>
          </div>
          <div class="form-group">
            <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Faktur (Transfer)</label>

            <div class="col-sm-8">
              <input autocomplete="off" class="form-control DANA_FAKTUR" id="DANA_FAKTUR" name="DANA_FAKTUR" placeholder="" type="number" onkeyup="kalkulasi_pembagian()" value="0">
            </div>
          </div>
        </form>

        <div class="row">
          <div class="col-md-12 text-right">
            <div class="form-group">
              <button class="btn btn-success btn-sm SIMPAN_PEMBAGIAN_DANA">Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalPembagianDetail" role="dialog" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pembagian Detail</h4>
      </div>
      <div class="modal-body">

        <form action="javascript:download();" class="fDataPembagianDetailDana form-horizontal" id="fDataPembagianDetailDana" name="fDataPembagianDana">
          <input autocomplete="off" class="form-control PERIODE_ID_MATERIAL" id="PERIODE_ID_MATERIAL" name="PERIODE_ID_MATERIAL" placeholder="" type="hidden">
          <input autocomplete="off" class="form-control MASTER_DANA" id="MASTER_DANA" name="MASTER_DANA" placeholder="" type="hidden">
          <table class="table">
            <tr>
              <th>Keterangan</th>
              <th>Rupiah</th>
              <th></th>
            </tr>
            <tbody id="dynamic_field">
              <tr>
                <td>
                  <input class="form-control KETERANGAN_DETAIL_DANA" id="KETERANGAN_DETAIL_DANA" name="KETERANGAN_DETAIL_DANA[0]" type="text" autocomplete="off">
                </td>
                <td>
                  <input autocomplete="off" class="form-control RUPIAH_DETAIL_DANA" id="RUPIAH_DETAIL_DANA" name="RUPIAH_DETAIL_DANA[0]" type="text">
                </td>
                <td>
                  <center>
                    <button type="button" name="add" id="add" class="btn btn-primary add"><i class="fa fa-plus"></i></button>
                  </center>
                </td>
              </tr>
            </tbody>
          </table>
        </form>

        <div class="row">
          <div class="col-md-12 text-right">
            <div class="form-group">
              <button class="btn btn-success btn-sm SIMPAN_PEMBAGIAN_DETAIL_DANA">Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  // $(document).ready(function(){
  //    $('.DANA_KASIR').mask("#.##0", {reverse: true});
  //   $('.ICD_MAC_ADDRESS').mask('ZZ:ZZ:ZZ:ZZ:ZZ:ZZ', {translation: {'Z': {pattern: /[A-Za-z0-9]/, optional: true}}});
  // });
  function number_format(number, decimals, dec_point, thousands_sep) {
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
      prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
      sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep,
      dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
      s = '',
      toFixedFix = function(n, prec) {
        var k = Math.pow(10, prec);
        return '' + Math.round(n * k) / k;
      };
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
      s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
      s[1] = s[1] || '';
      s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
  }

  $(".tambah_periode").on("click", function() {
    $(".modalPeriode").modal("show")
  })

  $(function() {
    $(".datepicker").datepicker().on('changeDate', function(ev) {
      $('.datepicker').datepicker('hide');
    });

    //$('.DANA_KASIR').mask("#,##0.00", {reverse: true});
  });

  function filter() {
    console.log("filter")
    $("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
    faktur_list('1')
  }

  function dana_material_list(curPage) {
    console.log("run")
    console.log($(".FILTER_PROSES").val())
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
      data: 'ref=periode_list&batas=' + $('input#REC_PER_HALAMAN').val() + '&halaman=' + curPage + '&keyword=' + $("input#keyword").val() + '&material=' + $(".FILTER_MATERIAL").val() + '&bulan=' + $(".FILTER_BULAN").val() + '&tanggal=' + $(".FILTER_TANGGAL").val(),
      success: function(data) {
        if (data.respon.pesan == "sukses") {
          //alert(data.respon.text_msg)
          console.log(data.result)
          $("tbody#zone_data").empty();
          $('#tujuan-light-pagination').pagination({
            pages: data.result_option.jml_halaman,
            cssStyle: 'light-theme',
            currentPage: curPage,
          });
          console.log(data.result)
          for (i = 0; i < data.result.length; i++) {
            if (data.result[i].FINANCE_DANA_MATERIAL_STATUS == "AKTIF") {
              var tr = "success"
            } else {
              var tr = "default"
            }
            var detail_dana_kasir = ""
            var detail_dana_cabang = ""
            if (data.result[i].DETAIL_DANA_KASIR == null) {
              detail_dana_kasir = ""
            } else {
              for (j = 0; j < data.result[i].DETAIL_DANA_KASIR.length; j++) {
                detail_dana_kasir += "<li>" + data.result[i].DETAIL_DANA_KASIR[j].FINANCE_PEMBAGIAN_DANA_DETAIL_KETERANGAN + " : " + number_format(data.result[i].DETAIL_DANA_KASIR[j].FINANCE_PEMBAGIAN_DANA_DETAIL_RUPIAH) + "</li>"
              }
            }

            if (data.result[i].DETAIL_DANA_CABANG == null) {
              detail_dana_cabang = ""
            } else {
              for (j = 0; j < data.result[i].DETAIL_DANA_CABANG.length; j++) {
                detail_dana_cabang += "<li>" + data.result[i].DETAIL_DANA_CABANG[j].FINANCE_PEMBAGIAN_DANA_DETAIL_KETERANGAN + " : " + number_format(data.result[i].DETAIL_DANA_CABANG[j].FINANCE_PEMBAGIAN_DANA_DETAIL_RUPIAH) + "</li>"
              }
            }


            $("tbody#zone_data").append("<tr class=" + tr + ">" +
              "<td style='vertical-align: middle;'>" + data.result[i].NO + ".</td>" +
              "<td style='vertical-align: middle;'>" + data.result[i].TANGGAL + "</td>" +
              "<td style='vertical-align: middle;'><b>" + data.result[i].DANA + "</b></td>" +
              "<td >" + data.result[i].DANA_KASIR + "<br><ul>" + detail_dana_kasir + "</ul><a class='btn btn-default btn-xs bagi_dana_detail' master_dana='kasir' id_periode=" + data.result[i].FINANCE_DANA_MATERIAL_ID + "><span class='fa fa-calculator' aria-hidden='true'></span> Bagi dana Kasir</a></td>" +
              "<td >" + data.result[i].DANA_CABANG + "<br><ul>" + detail_dana_cabang + "</ul><a class='btn btn-default btn-xs bagi_dana_detail' master_dana='cabang' id_periode=" + data.result[i].FINANCE_DANA_MATERIAL_ID + "><span class='fa fa-calculator' aria-hidden='true'></span> Bagi dana Cabang</a></td>" +
              "<td >" + data.result[i].DANA_FAKTUR + "<br><small class='help-block'>Sisa : " + data.result[i].SISA + "</small><a class='btn btn-success btn-xs' href='?show=rmp/pengajuan_pembayaran/detail/" + data.result[i].FINANCE_DANA_MATERIAL_ID + "'><span class='fa fa-calculator' aria-hidden='true'></span> Detail Dana Faktur</a></td>" +
              "<td style='vertical-align: middle;'>" +
              " <a class='btn btn-default btn-sm btn_pembagian' id_periode=" + data.result[i].FINANCE_DANA_MATERIAL_ID + " dana=" + data.result[i].FINANCE_DANA_MATERIAL_DANA + "><span class='fa fa-calculator' aria-hidden='true'></span> Pembagian Dana</a>" +
              "</td>" +


              "</tr>");
          }
        } else if (data.respon.pesan == "gagal") {
          //alert(data.respon.text_msg)
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
    dana_material_list('1');
  });
  $(window).on('hashchange', function(e) {
    $("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
    dana_material_list('1');
  });
  $("input#REC_PER_HALAMAN").on('change', function() {
    $("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
    dana_material_list('1')
  });

  function search() {
    $("tbody#zone_data").html("<tr><td colspan='9'><center><div class='loader'></div></center></td></tr>")
    dana_material_list('1');
  }

  $("tbody#zone_data").on("click", "a.btn_pembagian", function() {
    var dana = $(this).attr("dana");
    $(".ID_PEMBAGIAN_DANA_PERIODE").val($(this).attr("id_periode"))
    $(".TOTAL_DANA_MATERIAL").val(dana)
    $("p.sisa_dana_material_p").html(number_format(dana))
    $(".modalPembagian").modal("show")
    $(".DANA_KASIR").val(0)
    $(".DANA_CABANG").val(0)
    $(".DANA_FAKTUR").val(0)
    kalkulasi_pembagian()
  })
  $("tbody#zone_data").on("click", "a.bagi_dana_detail", function() {
    // var dana = $(this).attr("dana");
    // $(".ID_PEMBAGIAN_DANA_PERIODE").val($(this).attr("id_periode"))
    // $(".TOTAL_DANA_MATERIAL").val(dana)
    // $("p.sisa_dana_material_p").html(number_format(dana))
    $(".PERIODE_ID_MATERIAL").val($(this).attr("id_periode"))
    $(".MASTER_DANA").val($(this).attr("master_dana"))
    $(".modalPembagianDetail").modal("show")
    // $(".DANA_KASIR").val(0)
    // $(".DANA_CABANG").val(0)
    // $(".DANA_FAKTUR").val(0)
    // kalkulasi_pembagian()
  })

  $(document).ready(function() {
    var i = 1;

    $('#add').click(function() {
      var ip = $("input.KETERANGAN_DETAIL_DANA").val();
      var mac = $("input.RUPIAH_DETAIL_DANA").val();
      i++;
      $('#dynamic_field').append('<tr id="row' + i + '">' +
        '<td><input type="text" name="KETERANGAN_DETAIL_DANA[' + i + ']" value="' + ip + '" class="form-control" /></td>' +
        '<td><input type="text" name="RUPIAH_DETAIL_DANA[' + i + ']" value="' + mac + '" class="form-control" /></td>' +
        '<td><center><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></center></td></tr>');

      $('input.KETERANGAN_DETAIL_DANA').val('');
      $('input.RUPIAH_DETAIL_DANA').val('');
    });
    $(document).on('click', '.btn_remove', function() {
      var button_id = $(this).attr("id");
      $('#row' + button_id + '').remove();
    });

  });

  $(".SIMPAN_PEMBAGIAN_DANA").on("click", function() {
    var fData = $('.fDataPembagianDana').serialize();

    $.ajax({
      type: 'POST',
      url: refseeAPI,
      dataType: 'json',
      data: 'ref=simpan_pembagian_dana&' + fData,
      success: function(data) {
        if (data.respon.pesan == "sukses") {
          dana_material_list('1');
          $(".modalPembagianDetail").modal("hide")
        } else if (data.respon.pesan == "gagal") {
          console.log(data.respon.text_msg);
          alert("Gagal Menyimpan");
        }
      }, //end success
      error: function(x, e) {
        console.log("Error Ajax");
      } //end error
    });
  })

  $(".SIMPAN_PEMBAGIAN_DETAIL_DANA").on("click", function() {
    var fData = $('.fDataPembagianDetailDana').serialize();
    console.log(fData)

    $.ajax({
      type: 'POST',
      url: refseeAPI,
      dataType: 'json',
      data: 'ref=simpan_detail_dana&' + fData,
      success: function(data) {
        if (data.respon.pesan == "sukses") {
          dana_material_list('1');
          //$(".modalPembagian").modal("hide")
        } else if (data.respon.pesan == "gagal") {
          console.log(data.respon.text_msg);
          alert("Gagal Menyimpan");
        }
      }, //end success
      error: function(x, e) {
        console.log("Error Ajax");
      } //end error
    });
  })

  function kalkulasi_pembagian() {
    var dana = $(".TOTAL_DANA_MATERIAL").val()
    var kasir = $(".DANA_KASIR").val()
    var cabang = $(".DANA_CABANG").val()
    var faktur = $(".DANA_FAKTUR").val()

    var total = parseInt(kasir) + parseInt(cabang) + parseInt(faktur)
    console.log(total)
    var sisa = dana - total
    $("p.sisa_dana_material_p").html(number_format(sisa))
    if (sisa < 0) {
      $(".SIMPAN_PEMBAGIAN_DANA").attr("disabled", true)
      $("p.alert_pembagian_dana").html("Pembagian dana melebihi Total yang diberikan.")
    } else {
      $(".SIMPAN_PEMBAGIAN_DANA").attr("disabled", false)
      $("p.alert_pembagian_dana").html(" ")
    }
  }
</script>