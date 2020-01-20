<?php 
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">

                        <div class="box-header with-border">
                          <h3 class="box-title">Lisää tila</h3>
                        </div>

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">

                        <div class="form-group">
                          <label for="exampleInputName1">Nimi</label>
                         <input type="text" class="form-control" id="nimi" placeholder="Anna tilan nimi">
                        </div>                   
                          
                              <div class="form-group">
                                <label for="exampleInputName1">Paikkojen määrä</label>
                                <input type="text" class="form-control" id="paikat" placeholder="Anna paikkojen määrä ja muuta tietoa">
                              </div>
                                   
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                          <input type="button" class="btn btn-primary" onClick="Addtila()" value="Tallenna"></input>
                        </div>

                     </form>
                    </div>
                 <!-- /.box -->
                 </div>
               </div>';
include('../master.php');
?>
<script>
  function Addtila(){

        $.ajax(
        {
            type: "POST",
            url: '../api/tilat/uusi.php',
            dataType: 'json',
            data: {
                nimi: $("#nimi").val(),
                paikat: $("#paikat").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Lisätty uusi tila!");
                    window.location.href = '/luokat/tilat';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>