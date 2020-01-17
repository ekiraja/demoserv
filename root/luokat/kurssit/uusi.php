<?php 
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">

                        <div class="box-header with-border">
                          <h3 class="box-title">Lisää opettaja</h3>
                        </div>

                    <!-- /.box-header -->
                    <!-- form start -->
                    <form role="form">
                      <div class="box-body">

                        <div class="form-group">
                          <label for="exampleInputName1">Nimi</label>
                         <input type="text" class="form-control" id="nimi" placeholder="Anna Nimi">
                        </div>

                          <div class="form-group">
                            <label for="exampleInputEmail1">Email osoite</label>
                            <input type="email" class="form-control" id="email" placeholder="Anna email">
                          </div>

                            <div class="form-group">
                              <label for="exampleInputPassword1">Salasana</label>
                              <input type="password" class="form-control" id="password" placeholder="Salasana">
                            </div>

                              <div class="form-group">
                                <label for="exampleInputName1">Puhelin</label>
                                <input type="text" class="form-control" id="puhelin" placeholder="Anna Puh.no.">
                              </div>

                                   <div class="form-group">
                                    <label for="exampleInputName1">Tehtävä</label>
                                    <input type="text" class="form-control" id="oppi_aine" placeholder="Anna tehtävä">
                                   </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">
                          <input type="button" class="btn btn-primary" onClick="AddOpettaja()" value="Tallenna"></input>
                        </div>

                     </form>
                    </div>
                 <!-- /.box -->
                 </div>
               </div>';
include('../master.php');
?>
<script>
  function AddOpettaja(){

        $.ajax(
        {
            type: "POST",
            url: '../api/opettaja/uusi.php',
            dataType: 'json',
            data: {
                nimi: $("#nimi").val(),
                email: $("#email").val(),        
                password: $("#password").val(),
                puhelin: $("#puhelin").val(),
                oppi_aine: $("#oppi_aine").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Lisätty uusi kouluttaja!");
                    window.location.href = '/luokat/opettaja';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>