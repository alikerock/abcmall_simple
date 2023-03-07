<?php 
    ob_start();
    include $_SERVER["DOCUMENT_ROOT"]."/inc/head.php";

    $pid = $_GET['pid'];

    $query = "SELECT * from products where status=1 and pid=".$pid;
    $result = $mysqli ->query($query) or die("Query Error =>".$mysqli->error);
    $rs = $result ->fetch_object();

    if(!$rs or !$rs->cnt){
        echo "<script>alert('제품이 없거나 품절된 제품입니다.');location.href='/';</script>";
        exit;
    }
    
        //옵션을 product_options에서 조회하고 그 결과를 $options에 담자
        $query2 = "SELECT * from product_options where pid=".$pid;
        $result2 = $mysqli ->query($query2) or die("Query Error =>".$mysqli->error);
            
        while($rs2 = $result2 ->fetch_object()){
                $options[] = $rs2;
        }
    
        //옵션을 product_options에서 컬러옵션을 조회하고 그 결과를 $options1에 담자
        $query4 = "SELECT * from product_options where cate='컬러' and pid=".$pid;
        $result4 = $mysqli ->query($query4) or die("Query Error =>".$mysqli->error);
            
        while($rs4 = $result4 ->fetch_object()){
                $options1[] = $rs4;
        }
    
        //옵션을 product_options에서 사이즈을 조회하고 그 결과를 $options2에 담자
        $query5 = "SELECT * from product_options where cate='사이즈' and  pid=".$pid;
        $result5 = $mysqli ->query($query5);
    
        while($rs5 = $result5 ->fetch_object()){
            $options2[] = $rs5;
        }
    
    
        //추가이미지를 product_image_table에서 조회하고 결과를 $attached_imgs에 담자
        $query3 = "SELECT * from product_image_table where pid='$pid' and status=1";
        $result3 = $mysqli ->query($query3) or die("Query Error =>".$mysqli->error);
            
        while($rs3 = $result3 ->fetch_object()){
            $attached_imgs[] = $rs3;
        }

        $i=0;//쿠키에 상품정보를 등록할 사용할 인덱스
        
        if($_COOKIE['recently_products']){
            $prs = json_decode($_COOKIE['recently_products']);
            if(!in_array($rs,$prs)){
                if(sizeof($prs)>= 3){
                    unset($prs[0]);
                }
                ksort($prs); //키값으로 알파벳순 정렬
                foreach($prs as $ps){
                    $cvalarray[$i]=$ps; 
                    $i++;
                }
                $cvalarray[$i]=$rs; 
                $cval = json_encode($cvalarray);
                setcookie('recently_products',$cval, time()+86400);
            }

        }else{
            $cvalarray[$i]=$rs;  
            $cval = json_encode($cvalarray);
            setcookie('recently_products',$cval, time()+86400);
        }

?>

        <!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area Start <<<<<<<<<<<<<<<<<<<< -->
        <div class="breadcumb_area">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <ol class="breadcrumb d-flex align-items-center">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Dresses</a></li>
                            <li class="breadcrumb-item active">Long Dress</li>
                        </ol>
                        <!-- btn -->
                        <a href="#" class="backToHome d-block"><i class="fa fa-angle-double-left"></i> Back to Category</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- <<<<<<<<<<<<<<<<<<<< Breadcumb Area End <<<<<<<<<<<<<<<<<<<< -->

        <!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area Start >>>>>>>>>>>>>>>>>>>>>>>>> -->
        <section class="single_product_details_area section_padding_0_100">
            <div class="container">
                <div class="row">

                    <div class="col-12 col-md-6">
                        <div class="single_product_thumb">
                            <div id="product_details_slider" class="carousel slide" data-ride="carousel">

                                <ol class="carousel-indicators">
                                    <li class="active" data-target="#product_details_slider" data-slide-to="0" style="background-image: url(<?php echo $rs -> thumbnail;?>);">
                                    </li>
                                    
                                    <?php 
                                        if($attached_imgs) { 
                                            $i = 1;
                                        ?>
                                        <?php 
                                        foreach($attached_imgs as $ai) { 
                                            
                                            ?>
                                            <li data-target="#product_details_slider" data-slide-to="<?php echo $i;?>" style="background-image: url(/pdata/<?php echo $ai -> filename; ?>);">
                                            </li>                                                                                      
                                        <?php 
                                        $i++;
                                    } ?>
                                    <?php } ?>
                                    <!-- 
                                    <li data-target="#product_details_slider" data-slide-to="1" style="background-image: url(img/product-img/product-2.jpg);">
                                    </li>
                                    <li data-target="#product_details_slider" data-slide-to="2" style="background-image: url(img/product-img/product-3.jpg);">
                                    </li>
                                    <li data-target="#product_details_slider" data-slide-to="3" style="background-image: url(img/product-img/product-4.jpg);">
                                    </li> -->
                                </ol>

                                <div class="carousel-inner">
                                    <div class="carousel-item active"> <!-- 썸네일 -->
                                        <a class="gallery_img" href="<?php echo $rs -> thumbnail;?>">
                                        <img class="d-block w-100" src="<?php echo $rs -> thumbnail;?>" alt="First slide">
                                        </a>
                                    </div>
                                    <!-- 추가이미지 -->
                                    <?php if($attached_imgs) { ?>
                                        <?php foreach($attached_imgs as $ai) { ?>
                                            <div class="carousel-item">
                                                <a class="gallery_img" href="/pdata/<?php echo $ai -> filename; ?>">
                                                <img class="d-block w-100" src="/pdata/<?php echo $ai -> filename; ?>" alt="">
                                                </a>
                                            </div>                                            
                                        <?php } ?>
                                    <?php } ?>                                    
                                 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="single_product_desc">

                            <h4 class="title"><a href="#"><?php echo $rs -> name;?></a></h4>

                            <h4 class="price"><?php echo number_format($rs->sale_price);?>원</h4>

                            <p class="available">Available: 
                                <?php if($rs->cnt > 0) {?>
                                <span class="text-muted">In Stock</span>
                                <?php } else { ?>
                                <span class="text-muted">Out of Stock</span>
                                <?php } ?>

                            </p>

                            <div class="single_product_ratings mb-15">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <i class="fa fa-star-o" aria-hidden="true"></i>
                            </div>
                            <div>
                                <img src="" alt="" id="pimg">   
                            </div>
                            <div class="total">
                                    합계: <span id="price"><?php echo number_format($rs->sale_price);?></span>원
                            </div>
                            <?php if(isset($options1)){ ?>
                                <div class="widget size mb-50">
                                <?php foreach($options1 as $op1){?>
                                    <input type="radio" name="poption1" id="poption1_<?php echo $op1->poid;?>" value="<?php echo $op1->poid;?>">
                                        <span  onclick="jQuery('#poption1_<?php echo $op1->poid;?>').click();" style="content:url(<?php echo $op1->image_url;?>);height:100px;width:100px;"></span>
                                    </input>                                
                                <?php }?>
                                </div>
                            <?php }?>
                            <?php if(isset($options2)){ ?>
                            <div class="widget size mb-50">

                                <?php foreach($options2 as $op2){
                                    $option_name=$op2->option_name;
                                    if($op2->option_price)$option_name.="(+".number_format($op2->option_price).")";
                                    ?>
                                    <input type="radio" name="poption2" id="poption2_<?php echo $op2->poid;?>" value="<?php echo $op2->poid;?>">
                                        <span  onclick="jQuery('#poption2_<?php echo $op2->poid;?>').click();"><?php echo $option_name;?></span>
                                    </input>
                                <?php }?>


                            </div>
                            <?php }?>


                            <!-- Add to Cart Form -->
                            <form class="cart clearfix mb-50 d-flex" method="post">
                                <div class="quantity">
                                    <span class="qty-minus" onclick="var effect = document.getElementById('cnt'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                    <input type="number" class="qty-text" id="cnt" step="1" min="1" max="12" name="cnt" value="1">
                                    <span class="qty-plus" onclick="var effect = document.getElementById('cnt'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                </div>
                                <button type="button" name="addtocart" value="5" class="btn cart-submit d-block" onclick="cart_ins()">Add to cart</button>
                            </form>

                            <div id="accordion" role="tablist">
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingOne">
                                        <h6 class="mb-0">
                                            <a data-toggle="collapse" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Information</a>
                                        </h6>
                                    </div>

                                    <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">                                            
                                            <?php echo nl2br(stripslashes($rs->content));?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingTwo">
                                        <h6 class="mb-0">
                                            <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Cart Details</a>
                                        </h6>
                                    </div>
                                    <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo quis in veritatis officia inventore, tempore provident dignissimos nemo, nulla quaerat. Quibusdam non, eos, voluptatem reprehenderit hic nam! Laboriosam, sapiente! Praesentium.</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia magnam laborum eaque.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header" role="tab" id="headingThree">
                                        <h6 class="mb-0">
                                            <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">shipping &amp; Returns</a>
                                        </h6>
                                    </div>
                                    <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                                        <div class="card-body">
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse quo sint repudiandae suscipit ab soluta delectus voluptate, vero vitae, tempore maxime rerum iste dolorem mollitia perferendis distinctio. Quibusdam laboriosam rerum distinctio. Repudiandae fugit odit, sequi id!</p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae qui maxime consequatur laudantium temporibus ad et. A optio inventore deleniti ipsa.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- <<<<<<<<<<<<<<<<<<<< Single Product Details Area End >>>>>>>>>>>>>>>>>>>>>>>>> -->

        <!-- ****** Quick View Modal Area Start ****** -->
        <div class="modal fade" id="quickview" tabindex="-1" role="dialog" aria-labelledby="quickview" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                    <div class="modal-body">
                        <div class="quickview_body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-lg-5">
                                        <div class="quickview_pro_img">
                                            <img src="img/product-img/product-1.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-12 col-lg-7">
                                        <div class="quickview_pro_des">
                                            <h4 class="title">Boutique Silk Dress</h4>
                                            <div class="top_seller_product_rating mb-15">
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                                <i class="fa fa-star" aria-hidden="true"></i>
                                            </div>
                                            <h5 class="price">$120.99 <span>$130</span></h5>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia expedita quibusdam aspernatur, sapiente consectetur accusantium perspiciatis praesentium eligendi, in fugiat?</p>
                                            <a href="#">View Full Product Details</a>
                                        </div>
                                        <!-- Add to Cart Form -->
                                        <form class="cart" method="post">
                                            <div class="quantity">
                                                <span class="qty-minus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) effect.value--;return false;"><i class="fa fa-minus" aria-hidden="true"></i></span>

                                                <input type="number" class="qty-text" id="cnt" step="1" min="1" max="12" name="cnt" value="1">

                                                <span class="qty-plus" onclick="var effect = document.getElementById('qty'); var qty = effect.value; if( !isNaN( qty )) effect.value++;return false;"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                            </div>
                                            <button type="button" name="addtocart" value="5" class="cart-submit" onclick="cart_ins()">Add to cart</button>
                                            <!-- Wishlist -->
                                            <div class="modal_pro_wishlist">
                                                <a href="wishlist.html" target="_blank"><i class="ti-heart"></i></a>
                                            </div>
                                            <!-- Compare -->
                                            <div class="modal_pro_compare">
                                                <a href="compare.html" target="_blank"><i class="ti-stats-up"></i></a>
                                            </div>
                                        </form>

                                        <div class="share_wf mt-30">
                                            <p>Share With Friend</p>
                                            <div class="_icon">
                                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                                                <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ****** Quick View Modal Area End ****** -->

        <section class="you_may_like_area clearfix">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section_heading text-center">
                            <h2>related Products</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="you_make_like_slider owl-carousel">

                            <!-- Single gallery Item -->
                            <div class="single_gallery_item">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="img/product-img/product-1.jpg" alt="">
                                    <div class="product-quicview">
                                        <a href="#" data-toggle="modal" data-target="#quickview"><i class="ti-plus"></i></a>
                                    </div>
                                </div>
                                <!-- Product Description -->
                                <div class="product-description">
                                    <h4 class="product-price">$39.90</h4>
                                    <p>Jeans midi cocktail dress</p>
                                    <!-- Add to Cart -->
                                    <a href="#" class="add-to-cart-btn">ADD TO CART</a>
                                </div>
                            </div>

                            <!-- Single gallery Item -->
                            <div class="single_gallery_item">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="img/product-img/product-2.jpg" alt="">
                                    <div class="product-quicview">
                                        <a href="#" data-toggle="modal" data-target="#quickview"><i class="ti-plus"></i></a>
                                    </div>
                                </div>
                                <!-- Product Description -->
                                <div class="product-description">
                                    <h4 class="product-price">$39.90</h4>
                                    <p>Jeans midi cocktail dress</p>
                                    <!-- Add to Cart -->
                                    <a href="#" class="add-to-cart-btn">ADD TO CART</a>
                                </div>
                            </div>

                            <!-- Single gallery Item -->
                            <div class="single_gallery_item">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="img/product-img/product-3.jpg" alt="">
                                    <div class="product-quicview">
                                        <a href="#" data-toggle="modal" data-target="#quickview"><i class="ti-plus"></i></a>
                                    </div>
                                </div>
                                <!-- Product Description -->
                                <div class="product-description">
                                    <h4 class="product-price">$39.90</h4>
                                    <p>Jeans midi cocktail dress</p>
                                    <!-- Add to Cart -->
                                    <a href="#" class="add-to-cart-btn">ADD TO CART</a>
                                </div>
                            </div>

                            <!-- Single gallery Item -->
                            <div class="single_gallery_item">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="img/product-img/product-4.jpg" alt="">
                                    <div class="product-quicview">
                                        <a href="#" data-toggle="modal" data-target="#quickview"><i class="ti-plus"></i></a>
                                    </div>
                                </div>
                                <!-- Product Description -->
                                <div class="product-description">
                                    <h4 class="product-price">$39.90</h4>
                                    <p>Jeans midi cocktail dress</p>
                                    <!-- Add to Cart -->
                                    <a href="#" class="add-to-cart-btn">ADD TO CART</a>
                                </div>
                            </div>

                            <!-- Single gallery Item -->
                            <div class="single_gallery_item">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <img src="img/product-img/product-5.jpg" alt="">
                                    <div class="product-quicview">
                                        <a href="#" data-toggle="modal" data-target="#quickview"><i class="ti-plus"></i></a>
                                    </div>
                                </div>
                                <!-- Product Description -->
                                <div class="product-description">
                                    <h4 class="product-price">$39.90</h4>
                                    <p>Jeans midi cocktail dress</p>
                                    <!-- Add to Cart -->
                                    <a href="#" class="add-to-cart-btn">ADD TO CART</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<script>    
    $("input[name='poption1'], input[name='poption2']").change(function(){
        
        console.log('선택');

        let poid1 = $("input[name='poption1']:checked").val();
        let poid2 = $("input[name='poption2']:checked").val();
        let data = {
            poid1:poid1,
            poid2:poid2
        }

        $.ajax({
            async:false,
            type:'post',
            url:'admin/product/option_select.php',
            data:data,
            dataType:'json',
            success:function(result){
                let price1 = result.option_price1;
                let price2 = result.option_price2;

                (price1 !== null)? price1 = parseInt(price1) : price1 = 0;
                (price2 !== null)? price2 = parseInt(price2) : price2 = 0;

                let price=price1+price2+<?php echo $rs->sale_price;?>;

                $("#pimg").attr('src', result.image_url);
                $('#price').text(number_format(price));
            }
        });
    });
    function number_format(num){
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g,',');
    }       
    function cart_ins(){
        let poid1 = $("input[name='poption1']:checked").val() ?? '';
        let poid2 = $("input[name='poption2']:checked").val() ?? '';
        let opts = poid1 +'||'+ poid2;
        let cnt = $('#cnt').val();
        let data = {
            pid : <?php echo $pid ?>,
            opts : opts,
            cnt : cnt
        }
        console.log(data);

        $.ajax({
            async: false,
            type:'post',
            url:'cart_insert.php',
            data: data,
            dataType :'json',
            error:function(){alert('연결에러')},
            success:function(result){
                console.log(result);
                if(result.result == 'ok'){
                    alert('장바구니에 입력했습니다.');
                } else{
                    alert('실패했습니다. 다시 시도해주세요.');
                }
            }
        });
    }


</script>
<?php 
    include $_SERVER["DOCUMENT_ROOT"]."/inc/tail.php";
?>
