<?php
include ('connect.php');

function retorno_productos($q){
    $conet = conectar();
    
    $product = "SELECT * FROM product as p where name like '%".$q."%' group by p.name ";
    //print_r($product);
    $Qproduct = $conet->query($product);
    $dataProducto = array();
    $row2 = $Qproduct->fetch_assoc();
    if ($row2!='') {
        for ($set = array (); $row2 = $Qproduct->fetch_assoc(); $set[] = $row2);
        //print_r($set);
        for ($i=0; $i < sizeof($set) ; $i++) { 

        echo "<div class='item'>";
        if ($set[$i]['url_image'] == "") {
            echo "<img src='http://www.riobeauty.co.uk/images/product_image_not_found.gif' alt='".$set[$i]['name']."' height='300px' width='300px'>";
        }else {
            echo "<img src='".$set[$i]['url_image']."' alt='".utf8_encode($set[$i]['name'])."' height='300px' width='300px'>";
        }
        echo "<p>".$set[$i]['name']."</p>";
        echo "<div class='item-price'>";
        if ($set[$i]['discount']>0) { //precio,descuento y btn-add
            echo "<div class='item-price-desc'>";
            echo "<p class='precio' value='".$set[$i]['price']."'>Precio: <del>".$set[$i]['price']."</del></p>";
            echo "<p class='descuento'>con desc.".$set[$i]['discount']."% ".$set[$i]['price']*(1-$set[$i]['discount']/100)."</p>";
            echo "</div>";
            echo "<a href='#' onclick='pagar()'><i class='fas fa-plus-circle'></i></a>";
        }else {
            echo "<p class='precio'>Precio: ".$set[$i]['price']."</p>";
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

$q = $_GET['q'];
if(str_contains($q,'"')){
    $q = str_replace(array('"'),'',$q);
}
//print_r($q);
retorno_productos($q);
?>