<div class="content-page">
    <div class="content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Uplon</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Basic Tables</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Danh mục sản phẩm</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <div class="card-box">
                            <div align="right">
                                <button type="button" id="modal_button" class="btn btn-info">Thêm danh mục</button>
                                <!-- It will show Modal for Create new Records !-->
                            </div>
                            <!-- <form id="insert_data_category" method="POST">
                                <div class="form-group">
                                    <label for="">Tên danh mục</label>
                                    <input class="col-sm-4" type="text" name="name" id="name" style="border-radius:5px;border: 1px solid #ddd">
                                </div>
                                <div class="form-group">
                                    <label for="">Trạng thái</label>
                                    <select name="status" id="status" class="custom-select col-sm-4">
                                        <option value="1">On</option>
                                        <option value="0">OFF</option>
                                    </select>
                                    <input type="button" name="insert_data" id="button_insert" value="Thêm" class="btn btn-success">
                                </div>
                            </form> -->
                            <div id="customerModal" class="modal fade">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Thêm</h4>
                                        </div>
                                        <div class="modal-body">
                                            <label>Tên danh mục</label>
                                            <input type="text" name="name" id="name" class="form-control" />
                                            <br />
                                            <label>Trạng thái</label>
                                            <select name="status" id="status" class="custom-select col-sm-4">
                                                <option value="1">On</option>
                                                <option value="0">OFF</option>
                                            </select>
                                            <br />
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" name="id_category" id="id_category" />
                                            <input type="submit" name="action" id="action" class="btn btn-success" />
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title">Danh mục</h4>
                        <div id="result" class="table-responsive">

                        </div>
                    </div>

                </div>

            </div>
            <!--- end row -->
            <!--- end row -->

        </div> <!-- end container-fluid -->

    </div> <!-- end content -->



    <!-- Footer Start -->
    <footer class="footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    2016 - 2019 &copy; Uplon theme by <a href="">Coderthemes</a>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->

</div>



<script type="text/javascript">
   $(document).ready(function(){
 fetchUser(); //This function will load all data on web page when page load
 function fetchUser() // This function will fetch data from table and display under <div id="result">
 {
  var action = "Load";
  $.ajax({
   url : "model/categoryajax.php", //Request send to "model/categoryajax.php page"
   method:"POST", //Using of Post method for send data
   data:{action:action}, //action variable data has been send to server
   success:function(data){
    $('#result').html(data); //It will display data under div tag with id result
   }
  });
 }

 //This JQuery code will Reset value of Modal item when modal will load for create new records
 $('#modal_button').click(function(){
  $('#customerModal').modal('show'); //It will load modal on web page
  $('#name').val(''); //This will clear Modal first name textbox
  $('#status').val(''); //This will clear Modal last name textbox
  $('.modal-title').text("Tạo mới"); //It will change Modal title to Create new Records
  $('#action').val('Create'); //This will reset Button value ot Create
 });

 //This JQuery code is for Click on Modal action button for Create new records or Update existing records. This code will use for both Create and Update of data through modal
 $('#action').click(function(){
  var name = $('#name').val(); //Get the value of first name textbox.
  var status = $('#status').val(); //Get the value of last name textbox
  var id_category = $('#id_category').val();  //Get the value of hidden field customer id
  var action = $('#action').val();  //Get the value of Modal Action button and stored into action variable
  if(name != '' && status != '') //This condition will check both variable has some value
  {
   $.ajax({
    url : "model/categoryajax.php",    //Request send to "model/categoryajax.php page"
    method:"POST",     //Using of Post method for send data
    data:{name:name, status:status, id_category:id_category, action:action}, //Send data to server
    success:function(data){
     alert(data);    //It will pop up which data it was received from server side
     $('#customerModal').modal('hide'); //It will hide Customer Modal from webpage.
     fetchUser();    // Fetch User function has been called and it will load data under divison tag with id result
    }
   });
  }
  else
  {
   alert("Nhập thiếu trường"); //If both or any one of the variable has no value them it will display this message
  }
 });

 //This JQuery code is for Update customer data. If we have click on any customer row update button then this code will execute
 $(document).on('click', '.update', function(){
  var id_category = $(this).attr("id_category"); //This code will fetch any customer id from attribute id with help of attr() JQuery method
  var action = "Select";   //We have define action variable value is equal to select
  $.ajax({
   url:"model/categoryajax.php", //Request send to "model/categoryajax.php page"
   method:"POST",    //Using of Post method for send data
   data:{id_category:id_category, action:action},//Send data to server
   dataType:"json",   //Here we have define json data type, so server will send data in json format.
   success:function(data){
    $('#customerModal').modal('show');   //It will display modal on webpage
    $('.modal-title').text("Chỉnh sửa"); //This code will change this class text to Update records
    $('#action').val("Update");     //This code will change Button value to Update
    $('#id_category').val(id_category);     //It will define value of id variable to this customer id hidden field
    $('#name').val(data.name);  //It will assign value to modal first name texbox
    $('#status').val(data.status);  //It will assign value of modal last name textbox
   }
  });
 });

 //This JQuery code is for Delete customer data. If we have click on any customer row delete button then this code will execute
 $(document).on('click', '.delete', function(){
  var id_category = $(this).attr("id_category"); //This code will fetch any customer id from attribute id with help of attr() JQuery method
  if(confirm("Bạn có chắc là xoá dữ liệu không?")) //Confim Box if OK then
  {
   var action = "Delete"; //Define action variable value Delete
   $.ajax({
    url:"model/categoryajax.php",    //Request send to "model/categoryajax.php page"
    method:"POST",     //Using of Post method for send data
    data:{id_category:id_category, action:action}, //Data send to server from ajax method
    success:function(data)
    {
     fetchUser();    // fetchUser() function has been called and it will load data under divison tag with id result
     alert(data);    //It will pop up which data it was received from server side
    }
   })
  }
  else  //Confim Box if cancel then 
  {
   return false; //No action will perform
  }
 });
});
</script>