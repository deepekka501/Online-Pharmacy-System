<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
  ul{
    background-color:#eee;
    cursor:pointer;
  }
  li{
    padding: 12px;
  }
</style>

  </head>
  <body>
    
    
    <br>
    <br>
    <div class="container">
          <h3 align="center">Auto complete</h3>
          <label>Enter product name</label>
          <div class="input-group mb-3">
            <!-- <input type="text" id="c_id" name="c_id"> -->
            



<div class="input-group">
  <select class="btn btn-outline-secondary dropdown-toggle" data-mdb-select-init data-mdb-filter="true"  id="c_id" name="c_id">
  <option value="1">One</option>
  <option value="2">Two</option>
  <option value="3">Three</option>
  <option value="4">Four</option>
  <option value="5">Five</option>
  <option value="6">Six</option>
  <option value="7">Seven</option>
  <option value="8">Eight</option>
  <option value="9">Nine</option>
  <option value="10">Ten</option>
</select>
<input type="text"  name="medicine" id="medicine" class="form-control" placeholder="Enter medicine" aria-label="Recipient's username" aria-describedby="button-addon2">
  <!-- <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button> -->
  <button class="btn btn-outline-secondary" type="button" id="button-addon2">Se</button>
  
</div>
          </div>

          <div id="medicineList" class="position-absolute" style="width: 100%;">
        </div>
          <h1>Hl</h1>
  </div>
<script>
  $(document).ready(function(){


    $('#medicine').keyup(function(){
      var query=$(this).val();
      var c_id=$('#c_id').val();
      if(query!=''){
        $.ajax({
          url:"search.php",
          method:"POST",
          //pass to varibale id here to search for select query c_id and search medicine
          data:{query:query,c_id:c_id},
          success:function(data){
            $('#medicineList').fadeIn();
            $('#medicineList').html(data);
          }
        });
      }
      else{
        $('#medicineList').fadeOut();
        $('#medicineList').html("");
      }
    });
    $(document).on('click','li',function(){
      $('#medicine').val($(this).text());
      $('#medicineList').fadeOut();
    });
  });

</script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>