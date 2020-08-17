<style>
  .form-comment{
    width: 600px;
    display: flex;
    flex-direction: column;
  }
  .form-comment textarea{
    border: 1px solid #ddd;
    margin-bottom: 10px;
    font-size: 14px;
    color: black;
    padding-left: 10px;
    padding-top: 10px;
    outline: none;
  }
  .form-comment input{
    width: 200px;
    cursor: pointer;
    background-color: #288ad6;
    color: white;
    outline: none;
    border: 0;
    height: 50px;
    
  }
  .user-comment{
    font-size: 22px;
    font-weight: 600;
    color: black;
    margin-block-end: 0;
    margin-block-start: 0;
    
  }
 
  .comment-list__user{
    display: flex;
    flex-direction: column;
  }
  .comment-list__user p{
    font-size: 14px;
    color: black;
    margin-block-start: 0;
    margin-block-end: 0;
    margin: 10px 10px 10px 0;
  }
  .comment-list__user span{
    /* margin: 10px 10px 10px 0; */
    /* margin-block-start: 0;
    margin-block-end: 0; */
    margin-bottom: 10px;
    font-size: 14px;
    font-weight:500;
  }
  .fa-style{
    margin-right: 5px;
  }
  .comment__a{
    text-decoration: none;
    margin-right: 5px;
  }
  .comment_span{
    /* margin: 10px 10px 10px 0; */
     margin-block-start: 0;
    margin-block-end: 0;
  }
</style>

<body style="background-color: white;">
  <main>
    <div class="section">

      <h3 class="txt"><?php echo $detail['name']; ?></h3>
      <div class="rangting">
        <input type="radio" name="rangting" id="star5">
        <label for="star5"></label>

        <input type="radio" name="rangting" id="star4">
        <label for="star4"></label>

        <input type="radio" name="rangting" id="star3">
        <label for="star3"></label>

        <input type="radio" name="rangting" id="star2">
        <label for="star2"></label>

        <input type="radio" name="rangting" id="star1">
        <label for="star1"></label>

        <span class="result"></span>
      </div>
    </div>
  </main>
  <hr class="hr">
  <section class="detail">
    <div class="detail-img">
      <img width="400" height="460" src="upload/<?php echo $detail['image'] ?>" alt="">
      <div class="detail-carousel">
        <h3 class="txt-img">Xem hình ảnh thực tế của ảnh</h3>
        <div class="owl-carousel-wrap">
          <div class="owl-carousel owl-theme">
            <div class="item">
              <img class="" src="//cdn.tgdd.vn/Products/Images/42/220654/oppo-a92-black-200x200-180x125.png"></div>
            <div class="item">
              <img class="" src="//cdn.tgdd.vn/Products/Images/42/220654/oppo-a92-black-200x200-180x125.png"></div>
            <div class="item">
              <img class="" src="//cdn.tgdd.vn/Products/Images/42/220654/oppo-a92-black-200x200-180x125.png"></div>

          </div>
          <div class="popup"></div>
        </div>
      </div>
    </div>
    <div class="detail-info">
      <h3><?php echo number_format($detail['price'], 0, ',', '.'); ?>VNĐ</h3>
      <label class="detail-label">Trả góp 0%</label>
      <img src="https://cdn.tgdd.vn/2020/07/banner/380-100-380x100-1.png" alt="">
      <div class="detail-box">
        <p>Giảm ngay 500.000đ (áp dụng đặt và nhận hàng từ 3 - 19/7) (đã trừ vào giá) </p>
        <p>Tặng 2 suất mua Đồng hồ thời trang giảm 40% (không áp dụng thêm khuyến mãi khác)</p>
        <h3>Khuyến mãi</h3>
        <p>Tặng 2 suất mua Đồng hồ thời trang giảm 40% (không áp dụng thêm khuyến mãi khác</p>
      </div>
      <div>
        <form action="index.php?act=viewcart" method="POST">
          <input type="hidden" name="id_product" value="<?php echo $detail['id_product'] ?>">
          <input type="hidden" name="name" value="<?php echo $detail['name'] ?>">
          <input type="hidden" name="price" value="<?php echo $detail['price'] ?>">
          <input type="hidden" name="image" value="<?php echo $detail['image'] ?>">
          <input class="btn-detail" type="submit" name="submit" value="Thêm giỏ hàng">
        </form>
      </div>
    </div>
    <div class="detail-service">
      <p class="detail-txt">Bạn có tại nơi mua hàng không?</p>
      <div class="detail-service__box">
        <p>Bộ sản phẩm gồm: Hộp, Sạc, Tai nghe, sách hướng dẫn.</p>
        <p>Bảo hành chính hãng 12 tháng!</p>
      </div>
    </div>
  </section>
  <section class="comment">
    <h3 class="txt-commnet">Phần bình luận:</h3>
    <?php
    if (isset($_SESSION['id_user'])) {
    ?>
      <form method="POST" id="commentForm" class="form-comment">
        <input type="hidden" value="<?= $_GET['id_product'] ?>" name="id_product">
        <input type="hidden" name="id_user" value="<?= $_SESSION['id_user'] ?>">
        <input type="hidden" name="name" value="<?= $_SESSION['name'] ?>">
        <textarea name="comment" class="form-control" placeholder="Vui lòng nhập" rows="5" required></textarea>
        <input type="submit" name="sendcomment" value="Gửi bình luận" />

      </form>
    <?php } else {
      echo "<h3> Bạn phải <a href='?act=login'> đăng nhập </a> đăng nhập mới bình luận được";
    }
    ?>

    <div id="message"></div>

    <div class="hr1"></div>
    <h3 class="txt-comment">Danh sách bình luận:</h3>
    <div id="id_comment" class="comment-list">
      <?php
      // var_dump($listcmt);
      foreach ($listcmt as $list) {
        echo '
              <div  class="comment-list__user">
              <h3 class="user-comment"><i class="fa fa-user-o fa-style" aria-hidden="true"></i>' . $list['name'] . '</h3>
              <p>' . $list['comment'] . '</p>
              <span class="comment_span"><a class="comment__a" href="#">Trả lời</a>-' . $list['date'] . '</span>
              </div>
            ';
      }
      ?>
    </div>

  </section>

</body>
<script type="text/javascript">
  $(".owl-carousel").owlCarousel({
    loop: true,
    margin: 10,
    nav: true,
    responsive: {
      0: {
        items: 1
      },
      600: {
        items: 5
      },
      1000: {
        items: 5
      }
    }
  });

  var topItem = 0,
    leftItem = 0,
    popupHeight = 500;

  $(".owl-carousel .item").on("click", function(e) {
    var $this = $(this),
      $parent = $this.parents(".owl-carousel-wrap"),
      content = $this.html(),
      $popup = $parent.find(".popup");

    topItem = $this.offset().top - $parent.offset().top + $this.height() / 2;
    leftItem = $this.offset().left - $parent.offset().left + $this.width() / 2;

    $popup.css({
      top: topItem,
      left: leftItem,
      width: 0,
      height: 0
    });

    $popup.html(content).stop().animate({
        top: -((popupHeight - $this.parent().outerHeight()) / 2),
        left: 0,
        width: "100%",
        height: popupHeight,
        opacity: 1
      },
      400
    );
  });

  $(".popup").on("click", function(e) {
    $(this).stop().animate({
        width: 0,
        height: 0,
        top: topItem,
        left: leftItem,
        opacity: 0
      },
      400
    );
  });

  // $(document).ready(function() {
  //   $('#id_comment').load('comment_list.php');
  //   $('#commentForm').on('submit', function(event){
  //     event.preventDefault();
  //     var id_product = $('#id_pro').val();
  //     var name = $('#comment_name').val();
  //     var comment = $('#text_comment').val();

  //     if ((name != "") && (message != "") && (id_pro > 0)) {
  //       $.ajax({
  //         url: 'commnet_send.php',
  //         type: 'POST',
  //         data: {
  //           id_product: id_product,
  //           comment: comment,
  //           name: name
  //         },
  //         success: function(reponse) {
  //           var msg = "";
  //           if (reponse != "") {
  //             $("#id_pro").val('');
  //             $('#text_comment').val('');
  //             $('#name').val('');
  //             msg = "Bình luận thành công";
  //             $("#text_commnet").html(reponse);
  //           } else {
  //             msg = "lỗi không thêm được bình luận";
  //           }
  //           $('#text_comment').html(msg);
  //         }
  //       });
  //     } else {
  //       $("#text_comment").html('chưa bình luận thành công!');
  //     }
  //   });
  // });
</script>