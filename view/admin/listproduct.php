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
                        <h4 class="page-title">Sản phẩm</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <div class="card-box">
                            <div align="right">
                                <!-- <button class="close" data-dismiss="modal" type="button"></button> -->
                                <!-- <h3 class="pmd-cart-title-text" id="modal_button"></h3> -->
                                <button type="button" id="modal_button" class="btn btn-info">Thêm sản phẩm</button>
                                <!-- It will show Modal for Create new Records !-->
                                <!-- <input type="checkbox" checked data-toggle="toggle" data-onstyle="primary"> -->
                            </div>

                            <div id="customerModal" class="modal fade">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form id="form_act" method="POST" enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Thêm</h4>
                                                
                                            </div>
                                            <div class="modal-body">
                                                <label>Danh mục</label>
                                                <select name="id_category" id="id_category" class="custom-select col-sm-4">
                                                    <?php foreach ($listcate as $list) {
                                                        echo '<option value="' . $list['id_category'] . '">' . $list['name'] . '</option>';
                                                    } ?>
                                                </select>
                                                <br />
                                                <label>Trạng thái</label>
                                                <select name="status" id="status" class="custom-select col-sm-4">
                                                    <option value="1">On</option>
                                                    <option value="0">OFF</option>
                                                </select>
                                                <label>Loại</label>
                                                <select name="type" id="type" class="custom-select col-sm-4">
                                                    <option value="1">Hot</option>
                                                    <option value="0">Thường</option>
                                                </select>
                                                <br />
                                                <label>Tên sản phẩm</label>
                                                
                                                <input type="text" name="name" id="name" class="form-control" />
                                                <br />
                                                <label>Giá</label>
                                                <input type="text" name="price" id="price" class="form-control" />
                                                <br />
                                                <label>Giá khuyến mãi</label>
                                                <input type="text" name="price_promotion" id="price_promotion" class="form-control" />
                                                <br />
                                                <label>Chi tiết</label>
                                                <input type="text" id="demo" name="detail" class="ckeditor" />
                                                <br />
                                                <label>image</label>
                                                <input type="file" id="image" name="image" accept="image/*">
                                                <span id="hidden_img_show"></span>
                                                <br />

                                              
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="action" id="action" value="create" />
                                                <input type="hidden" name="id_product" id="id_product" />
                                                <input type="hidden" name="upload_img" id="upload_img">
                                                <input type="submit" name="submit" id="submit" value="Thêm" class="btn btn-success" />
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card-box">
                        <h4 class="header-title">Danh sách sản phẩm</h4>
                        <div id="resultPro" class="table-responsive">

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
    $(document).ready(function() {
        fetchUser(); //This function will load all data on web page when page load
        function fetchUser() // This function will fetch data from table and display under <div id="result">
        {
            var action = "LoadPro";
            $.ajax({
                url: "model/productajax.php", //Request send to "model/productajax.php page"
                method: "POST", //Using of Post method for send data
                data: {
                    action: action
                }, //action variable data has been send to server
                success: function(data) {
                    $('#resultPro').html(data); //It will display data under div tag with id result
                }
            });
        }

        //This JQuery code will Reset value of Modal item when modal will load for create new records
        $('#modal_button').click(function() {
            $('#customerModal').modal('show'); //It will load modal on web page
            $('#id_category').val(''); //This will clear Modal first name textbox
            $('#name').val(''); //This will clear Modal last name textbox
            $('#price').val(''); //This will clear Modal last name textbox
            $('#detail').val(''); //This will clear Modal last name textbox
            $('#image').val(''); //This will clear Modal last name textbox
            $('#status').val(''); //This will clear Modal last name textbox
            $('#type').val(''); //This will clear Modal last name textbox
            $('#price_promotion').val(''); //This will clear Modal last name textbox
            $('.modal-title').text("Tạo mới"); //It will change Modal title to Create new Records
            $('#action').val('Create'); //This will reset Button value ot Create
        });

        //This JQuery code is for Click on Modal action button for Create new records or Update existing records. This code will use for both Create and Update of data through modal

        //This JQuery code is for Update customer data. If we have click on any customer row update button then this code will execute
        $(document).on('submit', '#form_act', function(event) {
            event.preventDefault();
            var name = $('#name').val(); //Get the value of first name textbox.
            var status = $('#status').val(); //Get the value of last name textbox
            var type = $('#type').val(); //Get the value of last name textbox
            var price_promotion = $('#price_promotion').val(); //Get the value of last name textbox
            var price = $('#price').val(); //Get the value of last name textbox
            var detail = $('#detail').val(); //Get the value of last name textbox
            var id_category = $('#id_category').val(); //Get the value of hidden field customer id
            var action = $('#action').val(); //Get the value of Modal Action button and stored into action variable
            var image = $('#image').val();
            var image_extention = $('#image').val().split('.').pop().toLowerCase();

            if (image_extention != '') {

                if (jQuery.inArray(image_extention, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                    swal({
                        title: "Bạn chưa nhập đúng file hình",
                        icon: "warning"
                    });
                    $('#image').val('');
                    return false;
                }
            }
            if (name == '') {
                swal({
                    title: "Bạn chưa nhập tên",
                    icon: "warning"
                });

            } else if (status == '') {
                swal({
                    title: "Bạn chưa trạng thái",
                    icon: "warning"
                });

            } else if (type == '') {
                swal({
                    title: "Bạn chưa nhập loại",
                    icon: "warning"
                });

            } else if (id_category == '') {
                swal({
                    title: "Bạn chưa chọn loại sản phẩm",
                    icon: "warning"
                });

            } else if (price_promotion == '') {
                swal({
                    title: "Bạn chưa nhập tiên khuyến mãi",
                    icon: "warning"
                });

            } else if (detail == '') {
                swal({
                    title: "Bạn chưa nhập chi tiết",
                    icon: "warning"
                });

            } else if (price == '') {
                swal({
                    title: "Bạn chưa nhập tiền",
                    icon: "warning"
                });
            } else {
                $.ajax({
                    url: "model/productajax.php",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $('#form_act')[0].reset();
                        // if (data.trim() == 'created') {
                        //     swal({
                        //         title: "Bạn đã thêm thành công",
                        //         icon: "success"
                        //     });
                        // }
                        fetchUser();  
                    }
                });

            }
        });
        $(document).on('click', '#edit_btn', function(event) {
            event.preventDefault();
            $('#customerModal').modal('show');
            var editId = $(this).attr("edit");
            var action = "fetchSingle";
            $.ajax({
                url: "model/productajax.php",
                method: "POST",
                data: {
                    editId: editId,
                    action: action
                },
                dataType: "json",
                success: function(data) {
                    $('#id_product').val(editId);
                    $('#id_category').val(data.id_category); //Get the value of hidden field customer id
                    $('#name').val(data.name); //Get the value of first name textbox.
                    $('#price').val(data.price); //Get the value of last name textbox
                    $('#detail').val(data.detail); //Get the value of last name textbox
                    $('#upload_img').val(data.uplopaded_image);
                    $('#hidden_img_show').html(data.upload_hidden_img);
                    $('#status').val(data.status); //Get the value of last name textbox
                    $('#type').val(data.type); //Get the value of last name textbox
                    $('#price_promotion').val(data.price_promotion); //Get the value of last name textbox  
                    $('#action').val("update");
                    $("#submit").val("update");
                    // $('#modal_button').text('Sửa');
                }
            });
        });

        $(document).on('click', '#delete_btn', function(event) {
            event.preventDefault()
                // swal({
                //     title: "Bạn có chắc chắn xoá không",
                //     text: "Bạn xoá chứ?",
                //     buttons: true,
                //     dangerMode: true,
                // });
            var delete_btn_id = $(this).attr('delete_data');
            var delete_btn_img = $(this).attr('delete_btn_img');
            var action = "delete";
            $.ajax({
                url: "model/productajax.php",
                method: "POST",
                data: {
                    delete_btn_id: delete_btn_id,
                    delete_btn_img: delete_btn_img,
                    action: action
                },
                success: function(data) {
                    if (data.trim() == "delete") {
                        swal({
                            title: "Xoá thành công",
                            icon: "success"
                        });
                    }
                    fetchUser();
                }
            });



        });

    });
</script>