<?php 
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">

                        <div class="box-header with-border">
                          <h3 class="box-title">Lisää kurssi</h3>
                        </div>

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">

                        <div class="form-group">
                          <label for="exampleInputName1">Kurssin nimi</label>
                         <input type="text" class="form-control" id="nimi" placeholder="Anna kurssin nimi">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputName1">Koulutus ala</label>
                         <input type="text" class="form-control" id="koulutus_ala" placeholder="Anna koulutus ala">
                        </div>
                         
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                          <input type="button" class="btn btn-primary" onClick="Addkurssi()" value="Tallenna"></input>
                        </div>

                     </form>
                    </div>
                 <!-- /.box -->
                 </div>
               </div>';
include('../master.php');
?>
<script>
  function Addkurssi(){

        $.ajax(
        {
            type: "POST",
            url: '../api/kurssit/uusi.php',
            dataType: 'json',
            data: {
                nimi: $("#nimi").val(),
                koulutus_ala: $("#koulutus_ala").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Lisätty uusi kouluttaja!");
                    window.location.href = '/luokat/kurssit';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>