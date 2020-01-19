<?php
  $content = 
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
                          <input type="button" class="btn btn-primary" onClick="Updatekurssi()" value="Tallenna"></input>
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
            url: "../api/kurssit/lueyksi.php?id=<?php echo $_GET['id']; ?>",
            dataType: 'json',
            success: function(data) {
                $('#nimi').val(data['nimi']);
                $('#koulutus_ala').val(data['koulutus_ala']);
            },
            error: function (result) {
                console.log(result);
            },
        });
    });
    function Updatekurssi(){
        $.ajax(
        {
            type: "POST",
            url: '../api/kurssit/muokkaa.php',
            dataType: 'json',
            data: {
                id: <?php echo $_GET['id']; ?>,
                nimi: $("#nimi").val(),
                koulutus_ala: $("#koulutus_ala").val()
            },
            error: function (result) {
                alert(result.responseText);
            },
            success: function (result) {
                if (result['status'] == true) {
                    alert("Muokkaus onnustui!");
                    window.location.href = '/luokat/kurssit';
                }
                else {
                    alert(result['message']);
                }
            }
        });
    }
</script>