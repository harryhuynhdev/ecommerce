<style>
  .product {
    width: 70%;
    margin: 0 auto;
    background-color: white;
    height: 100%;
  }

  .product-list1 h4 {
    font-size: 18px;
    margin-block-end: 0;
    margin-block-start: 0;
    text-decoration: none;
    color: black;
    font-weight: 500;
    margin-left: 10px;
    font-weight: 500;
    margin-bottom: 10px;
  }

  .product-list {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    text-decoration: none;
    list-style: none;
    padding-inline-start: 0;

  }

  .product-list1 {
    width: 24%;
    height: 100%;
    position: relative;
    overflow: hidden;
    border: 1px solid #ddd;
    border-radius: 5px;
    text-decoration: none;
    margin-bottom: 10px;
  }

  .product-list1 a {
    text-decoration: none;
  }

  .product-list1 strong {
    text-decoration: none;
    color: red;
    font-style: 14px;
    margin-left: 10px;

  }

  .product-list1 p {
    margin-left: 10px;
    margin-right: 10px;

  }

  .product-list1 a img {
    text-align: center;
    margin: 10px;


  }

  .main-product {
    display: flex;
    width: 1200px;
    margin: 0 auto;
  }

  .main-product__left {
    width: 20%;
    height: 100vh;
  }

  .ratings {
    padding-right: 10px;
    padding-left: 10px;
    color: #d17581;
  }
</style>

<body style="background-color: white;">
  <div class="main-product">
    <section class="main-product__left">
      <div class="list-group">
        <h3>Giá </h3>
        <input type="hidden" id="hidden_minimum_price" value="0" />
        <input type="hidden" id="hidden_maximum_price" value="30000000" />
        <p id="price_show">1.000.000- 30.000.000</p>
        <div id="price_range"></div>
      </div>
      <div class="list-group">
        <h3>Hãng</h3>
        <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
          <?php foreach ($filter as $list) { ?>
            <div class="list-group-item checkbox">
              <label><input type="checkbox" class="common_selector brand" value="<?php echo $list['id']; ?>"> <?php echo $list['name']; ?></label>
            </div>
          <?php } ?>
        </div>
      </div>
    </section>
    <section class="product">

      <ul class="product-list filter_data">



      </ul>
  </div>


  </section>

  <script>
    $(document).ready(function() {
      filter_data();
     
      function filter_data() {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var brand = get_filter('brand');
        // alert(brand);
        $.ajax({
          url: "model/fetchdata.php",
          method: "POST",
          data: {
            action: action,
            minimum_price: minimum_price,
            maximum_price: maximum_price,
            brand: brand
          },
          success: function(data) {
            $('.filter_data').html(data);
          }
        })
      }

      $('.common_selector').click(function(){
        filter_data();
      })
      function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function() {
          filter.push($(this).val());
        });
        return filter;
      }

      $('#price_range').slider({
        range: true,
        min: 1000000,
        max: 30000000,
        values: [1000000, 30000000],
        step: 500,
        stop: function(event, ui) {
          $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
          $('#hidden_minimum_price').val(ui.values[0]);
          $('#hidden_maximum_price').val(ui.values[1]);
          filter_data();
        }
      });

    });
  </script>