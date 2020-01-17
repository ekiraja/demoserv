<?php
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Muokkaa opettaja</h3>
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
                          <label for="exampleInputName1">Opetustehtävä</label>
                          <input type="text" class="form-control" id="oppi_aine" placeholder="Anna tehtävä">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="UpdateOpettaja()" value="Tallenna"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
                </div>
              </div>';
              
  include('../master.php');
?>
<script>
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "../api/opettaja/lueyksi.php?id=<?php echo $_GET['id']; ?>",
            dataType: 'json',
            success: function(data) {
                $('#nimi').val(data['nimi']);
                $('#email').val(data['email']);
                $('#password').val(data['password']);
                $('#puhelin').val(data['puhelin']);
                $('#oppi_aine').val(data['oppi_aine']);
            },
            error: function (result) {
                console.log(result);
            },
        });
    });
    function UpdateOpettaja(){
        $.ajax(
        {
            type: "POST",
            url: '../api/opettaja/muokkaa.php',
            dataType: 'json',
            data: {
                id: <?php echo $_GET['id']; ?>,
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
                    alert("Muokkaus onnustui!");
                    window.location.href = '/luokat/opettaja';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>