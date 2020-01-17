<?php
  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Varaus lista</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="varaus" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Opetus aihe</th>
                        <th>Kouluttaja</th>
                        <th>Kurssi</th>
                        <th>Tila</th>
                        <th>Varaus aika</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Opetus aihe</th>
                        <th>Kouluttaja</th>
                        <th>Kurssi</th>
                        <th>Tila</th>
                        <th>Varaus aika</th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
            </div>';
  include('../master.php');
?>
<!-- page script -->
<script>
  $(document).ready(function(){
    $.ajax({
        type: "GET",
        url: "../api/varaus/lue.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var user in data){
                response += "<tr>"+
                "<td>"+data[user].oppi_aine+"</td>"+
                "<td>"+data[user].kouluttaja_id+"</td>"+
                "<td>"+data[user].kurssi_id+"</td>"+
                "<td>"+data[user].tila_id+"</td>"+
                "<td>"+data[user].varaus+"</td>"+
                "<td><a href='../varaus/paivita.php?id="+data[user].id+"'>Muokkaa</a> | <a href='#' onClick=Remove('"+data[user].id+"')>Poista</a></td>"+
                "</tr>";
            }
            $(response).appendTo($("#opettajat"));
        }
    });
  });
  function Remove(id){
    var result = confirm("Oletko varma että haluat poistaa tämän varauksen?"); 
    if (result == true) { 
        $.ajax(
        {
            type: "POST",
            url: '../api/varaus/poista.php',
            dataType: 'json',
            data: {
                id: id
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Poistettu onnistuneesti!");
                    window.location.href = '/luokat/varaus';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
  }
</script>
