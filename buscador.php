<?php
include ('connect.php');

function retorno_productos($q){
    $conet = conectar();
    
    $product = "SELECT * FROM product as p where UPPER(name) like UPPER('%".$q."%') group by p.name ";
    //print_r($product);
    $Qproduct = $conet->query($product);
    $dataProducto = array();
    $x = mysqli_num_rows($Qproduct);
    //print_r($x);
    $row2 = $Qproduct->fetch_assoc();
    if ($row2!='') {
        
        while ($set = $Qproduct->fetch_assoc()) {
            //var_dump($set);
            echo "<div class='item'>";
            if ($set['url_image'] == "") {
                echo "<img src='http://www.riobeauty.co.uk/images/product_image_not_found.gif' alt='".$set['name']."' height='300px' width='300px'>";
            }else {
                echo "<img src='".$set['url_image']."' alt='".utf8_encode($set['name'])."' height='300px' width='300px'>";
            }
            echo "<p>".$set['name']."</p>";
            echo "<div class='item-price'>";
            if ($set['discount']>0) { //precio,descuento y btn-add
                echo "<div class='item-price-desc'>";
                echo "<p class='precio' value='".$set['price']."'>Precio: <del>".$set['price']."</del></p>";
                echo "<p class='descuento'>con desc. ".$set['discount']."% ".$set['price']*(1-$set['discount']/100)."</p>";
                echo "</div>";
                echo "<a href='#' onclick='pagar()'><i class='fas fa-plus-circle'></i></a>";
            }else {
                echo "<p class='precio'>Precio: ".$set['price']."</p>";
                echo "<a href='#' onclick='pagar()'><i class='fas fa-plus-circle'></i></a>";
            }
            echo "</div>";
            echo "</div>";
        }
        $json = json_encode($dataProducto);
        return $json;
    }else {
        $eco = "<p>no se encontraron datos<p>";
        return $eco;
    }

}
function validate($data){
    //Este escapa los /
    $data = stripslashes($data);
   // $data = mysqli_real_escape_string($data,'"');
    //$data = real_escape($data);
    $data = htmlspecialchars($data,ENT_NOQUOTES);
    $data = preg_replace('/\&(.)[^;]=*;/','',$data);
    $data = str_replace('"','',$data);
    //echo "data validada ".$data."\n";
    return $data;
}
$q = $_GET['q'];
//echo "GET q".$q."\n";
if($q<>''){
$q=validate($q);
//echo "luego del if".$q;
retorno_productos($q);
}
/*if(str_contains($q,'"')){
    $q = str_replace(array('"'),'',$q);
}*/
?>