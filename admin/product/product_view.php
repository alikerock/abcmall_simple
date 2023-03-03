<?php
    session_start();
    ini_set('display_errors',1);
    if(!$_SESSION['AUID']){
        echo "<script>
            alert('접근 권한이 없습니다.');
            history.back();
        </script>";
    };
    include $_SERVER['DOCUMENT_ROOT']."/inc/header.php";
    
    $pid = $_GET['pid'];

    $query = "SELECT * from products where pid=".$pid;
    $result = $mysqli ->query($query) or die("Query Error =>".$mysqli->error);
    $rs = $result ->fetch_object();

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
?>
<style>
    .option_imgs img,
    .attached_imgs img{
        width:200px;
    }
    .attached_imgs{
        display: flex;
        gap:10px;
    }
    ul{
        list-style:none;
    }

</style>
<div class="container">
    <div class="image text-center p-3">
        <img src="<?php echo $rs -> thumbnail;?>" alt="" style="max-width:60%;">
    </div>
    <div class="info">
        <h3>제품명: <?php echo $rs -> name;?></h3>
        <h4>가격: <span class="price"><?php echo $rs -> price; ?></span></h4>
    </div>
    <?php if($options1) { ?>
        <div class="row">            
            <!-- 컬러 옵션 출력 -->
            <div class="options col-md-3">
                컬러:               
                    <?php foreach($options1 as $op1) { ?>
                        <span>
                            <?php echo $op1 -> option_name; ?> 
                            (+<i class="price"><?php echo $op1 -> option_price; ?></i>)
                        </span>                        
                    <?php } ?>              
            </div>
            <div class="option_imgs">
                <?php foreach($options1 as $op1) { ?>
                    <img src="../../<?php echo $op1 -> image_url; ?>" alt="">
                <?php } ?>
            </div>            
        </div>
    <?php } ?>
    <?php if($options2) { ?>
        <div class="row">            
            <!-- 사이즈 옵션 출력 -->
            <div class="options col-md-3">
                사이즈 :               
                    <?php foreach($options2 as $op2) { ?>
                        <span><?php echo $op2 -> option_name; ?> (+<i class="price"><?php echo $op2 -> option_price; ?></i>)</span>                        
                    <?php } ?>              
            </div>                      
        </div>
    <?php } ?>    
    <?php if($attached_imgs) { ?>
    <div class="row">
        <h3>추가 이미지들</h3>
        <ul class="attached_imgs">
        <?php foreach($attached_imgs as $ai) { ?>
            <li><img src="../../pdata/<?php echo $ai -> filename; ?>" alt=""></li>
        <?php } ?>
            <!--  -->
        </ul>
    </div>
    <?php } ?>
</div>

<script>

    $('.price').each(function(){
        let price = $(this).text(); //string
        let price2 = number_format(price);
        $(this).text(price2);
    });

    // let price = <?php echo $rs -> price; ?>;
    // $('.price').text(number_format(price));


    function number_format(num){
        ///12234 -> 12,234
        return num.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
    }
    // $('#poption').change(function(){
    //     let poid = $(this).val();
    //     console.log(poid);

    //     let data = {
    //         poid : poid
    //     }

    //     $.ajax({
    //         async:false,
    //         type:'post',
    //         url:'option_change.php',
    //         data:data,
    //         error:function(){
    //             alert('error');
    //         },
    //         success:function(returned_data){
    //             console.log(returned_data);
    //             $('.option_imgs').find('img').attr('src',returned_data);
    //         }
    //     });
    // });
</script>

<?php
    include $_SERVER['DOCUMENT_ROOT']."/inc/footer.php";
?>