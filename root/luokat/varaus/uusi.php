<?php 
  $date = date('Y-m-d');
  $content = '<div class="row">
              <!-- left column -->
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">

                      <div class="box-header with-border">
                        <h3 class="box-title">Lisää varaus</h3>
                      </div>

                  <!-- /.box-header -->
                  <!-- form start -->
                  <form role="form">
                    <div class="box-body">

                      <div class="form-group">
                        <label for="date">Anna päivä</label>
                        <input type="date"   class="form-control" id="varaus" placeholder="" >
                      </div>
                      <div class="form-group">
                        <label for="date">Anna opetus aihe</label>
                        <input type="text"   class="form-control" id="aihe" placeholder="" >
                      </div>
                      <div class="form-group">
                        <label for="date">Anna kouluttaja</label>
                        <input type="text"   class="form-control" id="kouluttaja" placeholder="" >
                      </div>
                      <div class="form-group">
                        <label for="date">Anna kurssi</label>
                        <input type="text"   class="form-control" id="kurssi" placeholder="" >
                      </div>
                      <div class="form-group">
                        <label for="date">Anna tila</label>
                        <input type="text"   class="form-control" id="tila" placeholder="" >
                      </div>     
                            <!--
                            <div class="form-group">
                              <input type="text" value="02/16/12" data-date-format="mm/dd/yy" class="datepicker" >
                              </div>
                              -->
                      <!-- /.box-body -->

                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="AddVaraus()" value="Tallenna"></input>
                      </div>

                  </form>
                  </div>
              <!-- /.box -->
              </div>
            </div>';
include('../master.php');
?>
<script>
   //--haetaan aika--
   //$(document).ready(function(){
  //$('#datepicker').datepicker(); 
  //});
  function AddVaraus(){

        $.ajax(
        {
            type: "POST",
            url: '../api/varaukset/uusi.php',
            dataType: 'json',
            data: {
                varaus: $("#varaus").val(),
                aihe: $("#aihe").val(),        
                kouluttaja: $("#kouluttaja").val(),
                kurssi: $("#kurssi").val(),
                tila: $("#tila").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Lisätty uusi varaus!");
                    window.location.href = '/luokat/varaus';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>