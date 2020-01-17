<?php
  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Kouluttaja lista</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="opettajat" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Nimi</th>
                        <th>Email</th>
                        <th>Puhelin</th>
                        <th>Opetus tehtävä</th>
                        <th>Toiminto</th>
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Nimi</th>
                        <th>Email</th>
                        <th>Puhelin</th>
                        <th>Opetus tehtävä</th>
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
        url: "../api/opettaja/lue.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var user in data){
                response += "<tr>"+
                "<td>"+data[user].nimi+"</td>"+
                "<td>"+data[user].email+"</td>"+
                "<td>"+data[user].puhelin+"</td>"+
                "<td>"+data[user].oppi_aine+"</td>"+
                "<td><a href='../opettaja/paivita.php?id="+data[user].id+"'>Muokkaa</a> | <a href='#' onClick=Remove('"+data[user].id+"')>Poista</a></td>"+
                "</tr>";
            }
            $(response).appendTo($("#opettajat"));
        }
    });
  });
  function Remove(id){
    var result = confirm("Oletko varma että haluat poistaa tämän kouluttajan?"); 
    if (result == true) { 
        $.ajax(
        {
            type: "POST",
            url: '../api/opettaja/poista.php',
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
                    window.location.href = '/luokat/opettaja';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
  }
</script>
