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
                        <h4 class="page-title">Danh sách đơn hàng</h4>
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
                                <!-- <button type="button" id="modal_button" class="btn btn-info">Thêm sản phẩm</button> -->
                                <!-- It will show Modal for Create new Records !-->
                                <!-- <input type="checkbox" checked data-toggle="toggle" data-onstyle="primary"> -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <!-- <span class="input-group-addon">Search</span> -->
                                        <input type="text" name="search_text" id="search_text" placeholder="Tìm" class="form-control" />
                                    </div>
                                </div>
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
                        <h4 class="header-title">Danh sách đơn hàng</h4>
                        <div id="resultCart" class="table-responsive">

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
        listCart();

        function listCart(query) {
            
            $.ajax({
                url: "model/listcart.php",
                method: "POST",
                data: {
                    query:query
                },
                success: function(data) {
                    $('#resultCart').html(data);
                }
            });
        }
        $('#search_text').keyup(function() {
            var search = $(this).val();
            if (search != '') {
                listCart(search);
            } else {
                listCart();
            }
        });
    });
</script>