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

  table {
    font-size: 12px;
  }
</style>
<div class="row">
  <div class="col-md-8">
    <select class="NAMA_SUPPLIER with-ajax-personal form-control" data-live-search="true" id="NAMA_SUPPLIER" name="NAMA_SUPPLIER" onchange="sel_nama_supplier()">
    </select>
  </div>
  <div class="col-md-2">
    <select id="FILTER_BULAN" onchange="filter()" name="FILTER_BULAN" type="text" class=" form-control FILTER_BULAN" autocomplete="off" onchange="filter_material()">
      <option value="01" <?php if (date("m") == "01") {
                            echo "selected";
                          } ?>>Januari</option>
      <option value="02" <?php if (date("m") == "02") {
                            echo "selected";
                          } ?>>Februari</option>
      <option value="03" <?php if (date("m") == "03") {
                            echo "selected";
                          } ?>>Maret</option>
      <option value="04" <?php if (date("m") == "04") {
                            echo "selected";
                          } ?>>April</option>
      <option value="05" <?php if (date("m") == "05") {
                            echo "selected";
                          } ?>>Mei</option>
      <option value="06" <?php if (date("m") == "06") {
                            echo "selected";
                          } ?>>Juni</option>
      <option value="07" <?php if (date("m") == "07") {
                            echo "selected";
                          } ?>>Juli</option>
      <option value="08" <?php if (date("m") == "08") {
                            echo "selected";
                          } ?>>Agusutus</option>
      <option value="09" <?php if (date("m") == "09") {
                            echo "selected";
                          } ?>>September</option>
      <option value="10" <?php if (date("m") == "10") {
                            echo "selected";
                          } ?>>Oktober</option>
      <option value="11" <?php if (date("m") == "11") {
                            echo "selected";
                          } ?>>November</option>
      <option value="12" <?php if (date("m") == "12") {
                            echo "selected";
                          } ?>>Desember</option>
    </select>
  </div>
  <div class="col-md-2">
    <select id="FILTER_TAHUN" onchange="filter()" name="FILTER_TAHUN" type="text" class=" form-control FILTER_TAHUN" autocomplete="off" onchange="filter_material()">
      <option value="2019" <?php if (date("Y") == "2019") {
                              echo "selected";
                            } ?>>2019</option>
      <option value="2020" <?php if (date("Y") == "2020") {
                              echo "selected";
                            } ?>>2020</option>
      <option value="2021" <?php if (date("Y") == "2021") {
                              echo "selected";
                            } ?>>2021</option>
      <option value="2022" <?php if (date("Y") == "2022") {
                              echo "selected";
                            } ?>>2022</option>
      <option value="2033" <?php if (date("Y") == "2023") {
                              echo "selected";
                            } ?>>2023</option>
      <option value="2024" <?php if (date("Y") == "2024") {
                              echo "selected";
                            } ?>>2024</option>
      <option value="2025" <?php if (date("Y") == "2025") {
                              echo "selected";
                            } ?>>2025</option>
    </select>
  </div>
</div>
<!--/.row-->
<br>
<table class="table table-hover table-bordered">
  <thead>
    <tr>
      <th rowspan="2">No.</th>
      <th rowspan="2">Tanggal</th>
      <th rowspan="2">No. Faktur</th>
      <th rowspan="2">Kapal</th>
      <th colspan="5">
        <center>KB-A</center>
      </th>
      <th colspan="5">
        <center>KB-B</center>
      </th>
      <th colspan="5">
        <center></center>
      </th>

    </tr>
    <tr>
      <th>
        <center>Kg BRUTO</center>
      </th>
      <th>
        <center>%</center>
      </th>
      <th>
        <center>Kg NETTO</center>
      </th>
      <th id="td_rp_a">@Rp</th>
      <th>
        <center>Rp</center>
      </th>

      <th>
        <center>Kg BRUTO</center>
      </th>
      <th>
        <center>%</center>
      </th>
      <th>
        <center>Kg NETTO</center>
      </th>
      <th id="td_rp_b">@Rp</th>
      <th>
        <center>Rp</center>
      </th>
      <th>
        <center></center>
      </th>

    </tr>
  </thead>
  <tbody id="zone_data">
    <tr>
      <td colspan="11">
        <center>
          <div class="loader"></div>
        </center>
      </td>
    </tr>
  </tbody>
  <tr class="success">
    <td colspan="4" style="text-align:right ;font-weight: bold;"></td>
    <td id="TOTAL_SUM_BRUTO_A" style="text-align:right ;font-weight: bold;"></td>
    <td id="TOTAL_SUM_PERSEN_A" style="text-align:right ;font-weight: bold;"></td>
    <td id="TOTAL_SUM_NETTO_A" style="text-align:right ;font-weight: bold;"></td>
    <td id="TOTAL_SUM_RP_KG_A" style="text-align:right ;font-weight: bold;"></td>
    <td id="TOTAL_SUM_RP_A" style="text-align:right ;font-weight: bold;"></td>

    <td id="TOTAL_SUM_BRUTO_B" style="text-align:right ;font-weight: bold;"></td>
    <td id="TOTAL_SUM_PERSEN_B" style="text-align:right ;font-weight: bold;"></td>
    <td id="TOTAL_SUM_NETTO_B" style="text-align:right ;font-weight: bold;"></td>
    <td id="TOTAL_SUM_RP_KG_B" style="text-align:right ;font-weight: bold;"></td>
    <td id="TOTAL_SUM_RP_B" style="text-align:right ;font-weight: bold;"></td>
  </tr>
</table>

<div aria-labelledby="myLargeModalLabel" class="modal fade bs-example-modal-lg modalPengajuanPembayaran" role="dialog" tabindex="-1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Pengajuan Pembayaran</h4>
      </div>
      <div class="modal-body">

        <form action="javascript:download();" class="fDataPengajuan form-horizontal" id="fDataManualNota" name="fDataManualNota">
          <div class="form-group">
            <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Periode Pembayaran</label>
            <div class="col-sm-8">
              <input autocomplete="off" class="form-control PERIODE_ID" id="PERIODE_ID" name="PERIODE_ID" placeholder="" type="hidden">
              <input autocomplete="off" class="form-control PERIODE_PEMBAYARAN" id="PERIODE_PEMBAYARAN" name="PERIODE_PEMBAYARAN" placeholder="" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">No. Faktur</label>
            <div class="col-sm-8">
              <input autocomplete="off" class="form-control NO_FAKTUR_PENGAJUAN datepicker" id="NO_FAKTUR_PENGAJUAN" name="NO_FAKTUR_PENGAJUAN" placeholder="" type="text">
            </div>
          </div>
          <div class="form-group">
            <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Rupiah Faktur</label>
            <div class="col-sm-8">
              <input autocomplete="off" class="form-control TOTAL_RUPIAH" id="TOTAL_RUPIAH" name="TOTAL_RUPIAH" placeholder="" type="number">
            </div>
          </div>
          <div class="form-group">
            <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Rupiah Pengajuan</label>
            <div class="col-sm-8">
              <input autocomplete="off" class="form-control PENGAJUAN_RUPIAH" id="PENGAJUAN_RUPIAH" name="PENGAJUAN_RUPIAH" placeholder="" type="number" onkeyup="kalkulasi_pengajuan()">
            </div>
          </div>
          <div class="form-group">
            <label class="ICD_TRANSAKSI_INVENTORI_LOKASI col-sm-4 control-label">Sisa</label>
            <div class="col-sm-8">
              <input autocomplete="off" class="form-control SISA_RUPIAH" id="SISA_RUPIAH" name="SISA_RUPIAH" placeholder="" type="number" onkeyup="kalkulasi_pengajuan()">
            </div>
          </div>
        </form>
        <hr>
        <table class="table">
          <tr>
            <td><b>Total Faktur</b></td>
            <td><b>:</b></td>
            <td>Rp.</td>
            <td align="right"><b>
                <p class="total_rupiah"></p>
              </b></td>
          </tr>
          <tr>
            <td><b>Rupiah Pengajuan</b></td>
            <td><b>:</b></td>
            <td>Rp.</td>
            <td align="right"><b>
                <p class="pengajuan_rupiah"></p>
              </b></td>
          </tr>
          <tr>
            <td><b>Sisa</b></td>
            <td><b>:</b></td>
            <td>Rp.</td>
            <td align="right"><b>
                <p class="sisa_rupiah"></p>
              </b></td>
          </tr>
        </table>
        <div class="row">
          <div class="col-md-12 text-right">
            <div class="form-group">
              <button class="btn btn-success btn-sm SIMPAN_PENGAJUAN_PEMBAYARAN">Simpan</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(function() {
    $('a.sidebar-toggle').click()
  });

  $(function() {
    $("tbody#zone_data").html("<tr><td colspan='20'><center><div class='loader'></div></center></td></tr>")
    $('.select2').select2()
    sel_nama_supplier();
    laporan_faktur_list()
    total_laporan()
  })

  function sel_nama_supplier() {
    var options = {
      ajax: {
        url: refseeAPI,
        type: 'POST',
        dataType: 'json',
        data: {
          q: '{{{q}}}',
          material: 'JAMBUL',
          ref: 'sel_nama_supplier_with_rek',
        }
      },
      locale: {
        emptyTitle: 'Pilih Nama'
      },
      log: 3,
      preprocessData: function(data) {
        var i, l = data.result.length,
          array = [];
        if (l) {
          for (i = 0; i < l; i++) {
            array.push($.extend(true, data.result[i], {
              text: data.result[i].RMP_REKENING_RELASI + ' - ' + data.result[i].RMP_MASTER_PERSONAL_NAMA,
              value: data.result[i].RMP_MASTER_PERSONAL_ID,
              data: {
                subtext: ''
              }
            }));
          }
        } else {}
        return array;
      }
    };
    $('.NAMA_SUPPLIER').selectpicker().filter('.with-ajax-personal').ajaxSelectPicker(options);
    laporan_faktur_list()
    total_laporan()
  }


  function laporan_faktur_list(curPage, wilayah) {
    $.ajax({
      type: 'POST',
      url: refseeAPI,
      dataType: 'json',
      data: 'ref=laporan_relasi_faktur&supplier=' + $(".NAMA_SUPPLIER").val() + '&material=jambul' + '&bulan=' + $(".FILTER_BULAN").val() + '&tahun=' + $(".FILTER_TAHUN").val(),
      success: function(data) {
        if (data.respon.pesan == "sukses") {
          $("tbody#zone_data").empty();

          for (i = 0; i < data.result.length; i++) {
            if (data.result[i].PURCHASER_STATUS == "A") {
              var tr = ""
            } else {
              var tr = "danger"
              var btn_kirim = ""
            }
            $("tbody#zone_data").append("<tr clas='" + tr + "' id='list_laporan' >" +
              "<td >" + data.result[i].NO + ".</td>" +
              "<td>" + data.result[i].RMP_FAKTUR_TANGGAL + "</td>" +
              "<td>" + data.result[i].RMP_FAKTUR_NO_FAKTUR + "</td>" +
              "<td>" + data.result[i].RMP_FAKTUR_KAPAL + "</td>" +

              "<td align='right'>" + data.result[i].BRUTO_A + "</td>" +
              "<td align='right'>" + data.result[i].PERSEN_A + "</td>" +
              "<td align='right'>" + data.result[i].NETTO_A + "</td>" +
              "<td align='right'>" + data.result[i].RP_KG_A + "</td>" +
              "<td align='right'>" + data.result[i].RP_A + "</td>" +

              "<td align='right'>" + data.result[i].BRUTO_B + "</td>" +
              "<td align='right'>" + data.result[i].PERSEN_B + "</td>" +
              "<td align='right'>" + data.result[i].NETTO_B + "</td>" +
              "<td align='right'>" + data.result[i].RP_KG_B + "</td>" +
              "<td align='right'>" + data.result[i].RP_B + "</td>" +

              "<td><a class='btn btn-success btn-xs' target='_blank' href='?show=rmp/purchaser/detail_faktur/" + data.result[i].RMP_FAKTUR_ID + "'><span class='fa fa-calculator' aria-hidden='true'></span></a>" +
              // " <a class='btn btn-warning btn-xs pengajuan_pembayaran' no_faktur='"+data.result[i].RMP_FAKTUR_NO_FAKTUR+"' total='"+data.result[i].TOTAL_RUPIAH+"'><span class='fa fa-money' aria-hidden='true'></span></a>"+
              "</td>" +
              "</tr>");
          }
        } else if (data.respon.pesan == "gagal") {
          $("tbody#zone_data").html("<tr><td colspan='20'></td></tr>");
        }
      }, //end success
      error: function(x, e) {
        console.log("Error AjaxX");
      } //end error
    });
  }

  function total_laporan() {

    $.ajax({
      type: 'POST',
      url: refseeAPI,
      dataType: 'json',
      data: 'ref=total_laporan_relasi&supplier=' + $(".NAMA_SUPPLIER").val() + '&material=jambul' + '&bulan=' + $(".FILTER_BULAN").val() + '&tahun=' + $(".FILTER_TAHUN").val(),
      success: function(data) {
        console.log(data.result)
        if (data.respon.pesan == "sukses") {

          $("td#TOTAL_SUM_BRUTO_A").html(data.result[0].TOTAL_SUM_BRUTO_A)
          $("td#TOTAL_SUM_PERSEN_A").html(data.result[0].TOTAL_SUM_PERSEN_A)
          $("td#TOTAL_SUM_NETTO_A").html(data.result[0].TOTAL_SUM_NETTO_A)
          $("td#TOTAL_SUM_RP_A").html(data.result[0].TOTAL_SUM_RP_A)
          $("td#TOTAL_SUM_RP_KG_A").html(data.result[0].TOTAL_SUM_RP_KG_A)

          $("td#TOTAL_SUM_BRUTO_B").html(data.result[0].TOTAL_SUM_BRUTO_B)
          $("td#TOTAL_SUM_PERSEN_B").html(data.result[0].TOTAL_SUM_PERSEN_B)
          $("td#TOTAL_SUM_NETTO_B").html(data.result[0].TOTAL_SUM_NETTO_B)
          $("td#TOTAL_SUM_RP_B").html(data.result[0].TOTAL_SUM_RP_B)
          $("td#TOTAL_SUM_RP_KG_B").html(data.result[0].TOTAL_SUM_RP_KG_B)


        } else if (data.respon.pesan == "gagal") {
          $("td#TOTAL_SUM_BRUTO_A").html("0")
          $("td#TOTAL_SUM_NETTO_A").html("0")
          $("td#TOTAL_SUM_RP_A").html("0")

          $("td#TOTAL_SUM_BRUTO_B").html("0")
          $("td#TOTAL_SUM_NETTO_B").html("0")
          $("td#TOTAL_SUM_RP_B").html("0")

          $("td#TOTAL_BULAN_SUM_BRUTO_A").html("0")
          $("td#TOTAL_BULAN_SUM_NETTO_A").html("0")
          $("td#TOTAL_BULAN_SUM_RP_A").html("0")

          $("td#TOTAL_BULAN_SUM_BRUTO_B").html("0")
          $("td#TOTAL_BULAN_SUM_NETTO_B").html("0")
          $("td#TOTAL_BULAN_SUM_RP_B").html("0")
        }
      }, //end success
      error: function(x, e) {
        console.log("Error Ajax");
      } //end error
    });
  }

  function filter() {
    $("tbody#zone_data").html("<tr><td colspan='20'><center><div class='loader'></div></center></td></tr>")
    laporan_faktur_list()
    total_laporan()
  }


  // ------------------------------------------------ pengajuan pembayaran
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

  function periode_tersedia() {
    $.ajax({
      type: 'POST',
      url: refseeAPI,
      dataType: 'json',
      data: 'ref=periode_tersedia',
      success: function(data) {
        if (data.respon.pesan == "sukses") {
          $('.PERIODE_PEMBAYARAN').val(data.result[0].TANGGAL)
          $('.PERIODE_ID').val(data.result[0].FINANCE_DANA_MATERIAL_ID)
        } else if (data.respon.pesan == "gagal") {}
      }, //end success
      error: function(x, e) {
        console.log("Error Ajax");
      } //end error
    });
  }

  function kalkulasi_pengajuan() {
    var total_rupiah = $(".TOTAL_RUPIAH").val()
    var pengajuan_rupiah = $(".PENGAJUAN_RUPIAH").val()
    $("p.pengajuan_rupiah").html(number_format(pengajuan_rupiah))
    var sisa = total_rupiah - pengajuan_rupiah
    $(".SISA_RUPIAH").val(sisa)
    $("p.sisa_rupiah").html(number_format(sisa))
  }

  $("tbody").on('click', 'a.pengajuan_pembayaran', function() {
    periode_tersedia()
    $(".PENGAJUAN_RUPIAH").val("")
    $(".SISA_RUPIAH").val("")
    $("p.sisa_rupiah").html("0")
    $("p.pengajuan_rupiah").html("0")
    var no_faktur = $(this).attr('no_faktur');
    var total = $(this).attr('total');
    $(".modalPengajuanPembayaran").modal('show');
    $(".NO_FAKTUR_PENGAJUAN").val(no_faktur);
    $(".TOTAL_RUPIAH").val(total);
    $("p.total_rupiah").html(number_format(total))
  });

  $(".SIMPAN_PENGAJUAN_PEMBAYARAN").on("click", function() {
    var fData = $('.fDataPengajuan').serialize();
    $.ajax({
      type: 'POST',
      url: refseeAPI,
      dataType: 'json',
      data: 'ref=kirim_pengajuan_pembayaran&' + fData,
      success: function(data) {
        if (data.respon.pesan == "sukses") {
          $(".modalPengajuanPembayaran").modal('hide');
        } else if (data.respon.pesan == "gagal") {
          alert("Gagal Menyimpan");
        }
      }, //end success
      error: function(x, e) {
        console.log("Error Ajax");
      } //end error
    });
  })
</script>