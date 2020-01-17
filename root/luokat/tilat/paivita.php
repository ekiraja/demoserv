<?php
  $content = '<div class="row">
                <!-- left column -->
                <div class="col-md-12">
                  <!-- general form elements -->
                  <div class="box box-primary">
                    <div class="box-header with-border">
                      <h3 class="box-title">Muokkaa tila</h3>
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
                          <input type="number" class="form-control" id="paikat" placeholder="Anna paikkojen määrä">
                        </div>
                      </div>
                      <!-- /.box-body -->
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="UpdateTila()" value="Tallenna"></input>
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
            url: "../api/tilat/lueyksi.php?id=<?php echo $_GET['id']; ?>",
            dataType: 'json',
            success: function(data) {
                $('#nimi').val(data['nimi']);
                $('#paikat').val(data['paikat']);
            },
            error: function (result) {
                console.log(result);
            },
        });
    });
    function UpdateTila(){
        $.ajax(
        {
            type: "POST",
            url: '../api/tilat/muokkaa.php',
            dataType: 'json',
            data: {
                id: <?php echo $_GET['id']; ?>,
                nimi: $("#nimi").val(),
                paikat: $("#paikat").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Muokkaus onnustui!");
                    window.location.href = '/luokat/tilat';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>