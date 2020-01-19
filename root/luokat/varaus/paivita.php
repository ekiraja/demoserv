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
                      <div class="box-footer">
                        <input type="button" class="btn btn-primary" onClick="UpdateVaraus()" value="Tallenna"></input>
                      </div>
                    </form>
                  </div>
                  <!-- /.box -->
              </div>';
              
  include('../master.php');
?>

<script>
    $(document).ready(function(){
        $.ajax({
            type: "GET",
            url: "../api/varaukset/lueyksi.php?id=<?php echo $_GET['id']; ?>",
            dataType: 'json',
            success: function(data) {
                $('#aihe').val(data['aihe']);
                $('#kouluttaja').val(data['kouluttaja']);
                $('#kurssi').val(data['kurssi']);
                $('#tila').val(data['tila']);
                $('#varaus').val(data['varaus']);
            },
            error: function (result) {
                console.log(result);
            },
        });
    });
    function UpdateVaraus(){
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