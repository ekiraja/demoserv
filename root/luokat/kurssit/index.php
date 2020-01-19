<?php
  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Kurssi lista</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="kurssit" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Nimi</th>
                        <th>Koulutus ala</th>
                        <th>Luotu</th>
                        <th>Toiminto</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Nimi</th>
                        <th>Koulutus ala</th>
                        <th>Luotu</th>
                        <th>Toiminto</th>
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
        url: "../api/kurssit/lue.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var user in data){
                response += "<tr>"+
                "<td>"+data[user].nimi+"</td>"+
                "<td>"+data[user].koulutus_ala+"</td>"+
                "<td>"+data[user].luotu+"</td>"+
                "<td><a href='../kurssit/paivita.php?id="+data[user].id+"'>Muokkaa</a> | <a href='#' onClick=Remove('"+data[user].id+"')>Poista</a></td>"+
                "</tr>";
            }
            $(response).appendTo($("#kurssit"));
        }
    });
  });
  function Remove(id){
    var result = confirm("Oletko varma että haluat poistaa tämän kurssin?"); 
    if (result == true) { 
        $.ajax(
        {
            type: "POST",
            url: '../api/kurssit/poista.php',
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
                    window.location.href = '/luokat/kurssit';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
  }
</script>
