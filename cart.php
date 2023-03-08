<?php 
    include $_SERVER["DOCUMENT_ROOT"]."/inc/head.php";

    if($_SESSION['UID']){
        $added_condition = " and c.userid= '".$_SESSION['UID']."'";
    } else{
        $added_condition = " and c.ssid= '".session_id()."'";
    }

    $sql = "SELECT *, c.cnt
            from cart c
            join products p on c.pid=p.pid where 1=1 ".$added_condition;

    $result = $mysqli -> query($sql) or die("query error=>".$myslqi->error);
    while($rs=$result ->fetch_object()){
        $rsc[]=$rs;
    }
?>

        <!-- ****** Cart Area Start ****** -->
        <div class="cart_area section_padding_100 clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="cart-table clearfix">
                            <table class="table table-responsive">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if(isset($rsc)){
                                        foreach($rsc as $p){
                                    ?>
                                    <tr id="<?php echo $p->cartid;?>">
                                        <td class="cart_product_img d-flex align-items-center">
                                            <a href="product.php?pid=<?php echo $p -> pid;?>"><img src="<?php echo $p->thumbnail; ?>" alt="Product"></a>
                                            <h6><?php echo $p->name; ?></h6>
                                        </td>
                                        <td class="price"><span><?php echo number_format($p->sale_price); ?></span></td>
                                        <td class="qty">
                                            <div class="quantity">
                                                <span class="qty-minus"
                                                    onclick="var effect = document.getElementById('qty_<?php echo $p->cartid;?>'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i
                                                        class="fa fa-minus" aria-hidden="true"></i></span>
                                                <input type="number" class="qty-text" id="qty_<?php echo $p->cartid;?>" step="1" min="1" max="99"
                                                    name="quantity" value="<?php echo $p->cnt;?>">
                                                <span class="qty-plus"
                                                    onclick="var effect = document.getElementById('qty_<?php echo $p->cartid;?>'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i
                                                        class="fa fa-plus" aria-hidden="true"></i></span>
                                            </div>
                                        </td>
                                        <td class="total_price"><span><?php echo number_format($p->sale_price*$p->cnt) ;?></span><button class="cart_item_del"> x
                                            </button>
                                    </tr>
                                    <?php 
                                       }
                                    } else{
                                    ?>
                                      <tr>
                                        <td colspan="4">
                                            장바구니에 상품이 없습니다.
                                        </td>
                                      </tr>  
                                    <?php 
                                       }                                    
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="cart-footer d-flex mt-30">
                            <div class="back-to-shop w-50">
                                <a href="shop-grid-left-sidebar.html">Continue shooping</a>
                            </div>
                            <div class="update-checkout w-50 text-right">
                                <a href="#">clear cart</a>
                                <a href="#">Update cart</a>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="coupon-code-area mt-70">
                            <div class="cart-page-heading">
                                <h5>Cupon code</h5>
                                <p>Enter your cupone code</p>
                            </div>
                           <?php
                           $cq = "SELECT ucid, c.coupon_name
                            FROM user_coupons uc
                            JOIN coupons c
                            ON c.cid = uc.couponid
                            WHERE c.status = 2 and uc.status = 1 and uc.use_max_date >= now() and uc.userid = '".$_SESSION['UID']."'";
                           $cq_result = $mysqli -> query($cq) or die('Query error=>'.$mysqli->error);
                           while($cr=$cq_result -> fetch_object()){
                                $csa[]=$cr;
                           }
                           ?> 
                           <select name="coupon" id="coupon">
                                <option value="">쿠폰을 선택해주세요</option>
                                
                                <?php
                                    if(isset($csa)){
                                    foreach($csa as $c){
                                ?>
                                <option value="<?php echo $c -> ucid; ?>"><?php echo $c -> coupon_name; ?></option>
                                <?php
                                   }
                                }
                                ?>
                           </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="shipping-method-area mt-70">
                            <div class="cart-page-heading">
                                <h5>Shipping method</h5>
                                <p>Select the one you want</p>
                            </div>

                            <div class="custom-control custom-radio mb-30">
                                <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label d-flex align-items-center justify-content-between"
                                    for="customRadio1"><span>Next day delivery</span><span>$4.99</span></label>
                            </div>

                            <div class="custom-control custom-radio mb-30">
                                <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label d-flex align-items-center justify-content-between"
                                    for="customRadio2"><span>Standard delivery</span><span>$1.99</span></label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                <label class="custom-control-label d-flex align-items-center justify-content-between"
                                    for="customRadio3"><span>Personal Pickup</span><span>Free</span></label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="cart-total-area mt-70">
                            <div class="cart-page-heading">
                                <h5>Cart total</h5>
                                <p>Final info</p>
                            </div>
                            <input type="hidden" name="cart_total" id="cart_total">    
                            <ul class="cart-total-chart">
                                <li><span>Subtotal</span> <span id="subtotal"></span></li>
                                <li><span>coupon</span> <span id="coupon_price"></span></li>
                                <li><span><strong>Total</strong></span> 
                                <span><strong id="total_amount"></strong></span>
                            </li>
                            </ul>
                            <a href="checkout.html" class="btn karl-checkout-btn">Proceed to checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ****** Cart Area End ****** -->
<script>
    cal_Sum();

     $('.cart_item_del').click(function(){
        let $this = $(this).closest('tr');
        let cid = $this.attr('id');

        if(!confirm('해당 상품을 정말 삭제할까요?')){
            return false;
        }
        let data = {
            cid:cid
        }
    
        $.ajax({
            async:false,
            type:'post',
            url:'cart_del.php',
            data:data,
            dataType:'json',
            error:function(){
                console.log('error');
            },
            success:function(result){               
                if(result.result == true){
                   $('#'+cid).remove();
                   cal_Sum();
                }                
            }
        });

     });                               

    $('.qty-minus').add('.qty-plus').click(function(){
        let $this = $(this).closest('tr');
        let cid = $this.attr('id');
        let qty = parseInt($('#qty_'+cid).val());

        let unitprice =$this.find('.price span').text();
        let price = parseInt(unitprice.replace(',', ''));
        let totalprice = qty*price;
        $this.find('.total_price span').text(number_format(totalprice));

        cal_Sum();

        let data = {
            cid:cid,
            qty:qty,
            price:totalprice
        }
        $.ajax({
            async:false,
            type:'post',
            url:'cart_edit.php',
            data:data,
            dataType:'json',
            error:function(){
                console.log('error');
            },
            success:function(result){               
                if(result.result =='ok'){
                    console.log('cart updated!')
                }                
            }
        });

    });

    function cal_Sum(){
        let cart_item = $('.cart-table tbody tr');
        let sum = 0;
        cart_item.each(function(){
            let total = $(this).find('.total_price span').text();
            let totalmd = parseInt(total.replace(',',''));
            sum+=totalmd;
        });
        $('#subtotal').text(number_format(sum));
        $('#cart_total').val(sum);
    }

    function number_format(num){
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g,',');
    }   

    $('#coupon').change(function(){
        let ucid = $(this).val();
        let cart_total = $('#cart_total').val();
        let data = {
            ucid :ucid,
            cart_total:cart_total
        }
        $.ajax({
            async:false,
            type:'post',
            url:'coupon_cal.php',
            data:data,
            dataType:'json',
            success:function(data){
                if(data.result == false){
                    alert(data.msg);
                    $('#coupon_price').text(0);
                    return false;
                } else if(data.result == true){
                    $('#coupon_price').text('-'+data.coupon_price);
                    $('#total_amount').text(number_format(cart_total - parseInt(data.coupon_price)));
                }

            }
        });
    });


</script>
<?php 
    include $_SERVER["DOCUMENT_ROOT"]."/inc/tail.php";
?>
