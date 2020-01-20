<?php
  $content = '<div class="row">
                <div class="col-xs-12">
                <div class="box">
                  <div class="box-header">
                    <h3 class="box-title">Tilat lista</h3>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <table id="tilat" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Nimi</th>
                        <th>paikkkoja</th>
                        <th>Luotu</th>                        
                      </tr>
                      </thead>
                      <tbody>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>Nimi</th>
                        <th>paikkkoja</th>
                        <th>Luotu</th>                        
                      </tr>
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
        url: "../api/tilat/lue.php",
        dataType: 'json',
        success: function(data) {
            var response="";
            for(var user in data){
                response += "<tr>"+
                "<td>"+data[user].nimi+"</td>"+
                "<td>"+data[user].paikat+"</td>"+
                "<td>"+data[user].luotu+"</td>"+
                "<td><a href='../tilat/paivita.php?id="+data[user].id+"'>Muokkaa</a> | <a href='#' onClick=Remove('"+data[user].id+"')>Poista</a></td>"+
                "</tr>";
            }
            $(response).appendTo($("#tilat"));
        }
    });
  });
  function Remove(id){
    var result = confirm("Oletko varma että haluat poistaa tämän tilan?"); 
    if (result == true) { 
        $.ajax(
        {
            type: "POST",
            url: '../api/tilat/poista.php',
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
                    window.location.href = '/luokat/tilat';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
  }
</script>
