<?php
include ('connect.php');

function retorno_productos($q){
    //$q = $_GET['q'];

    if(str_contains($q,'energetica')){
      $q = 'bebida energetica';
    }
    $conet = conectar();
    
    $category = "SELECT id as num FROM category where name='".$q."'";
    $Qcategory = $conet->query($category);
    $row = $Qcategory->fetch_array(MYSQLI_ASSOC);
    $id = $row['num'];
    //echo "mi categoria: ".$Qcategory;
    $product = "SELECT * FROM product as p where category ='".$id."' group by p.name";
    //echo "mi producto".$product;
    $Qproduct = $conet->query($product,MYSQLI_USE_RESULT);
    $dataProducto = array();

    for ($set = array (); $row2 = $Qproduct->fetch_assoc(); $set[] = $row2);
    //print_r($set);
    for ($i=0; $i < sizeof($set) ; $i++) { 

      echo "<div class='item'>";
      if ($set[$i]['url_image'] == "") { //imagen
        echo "<img src='http://www.riobeauty.co.uk/images/product_image_not_found.gif' alt='".$set[$i]['name']."' height='300px' width='300px'>";
      }else {
        echo "<img src='".$set[$i]['url_image']."' alt='".$set[$i]['name']."' height='300px' width='300px'>";
      } //fin de la imagen
      echo "<p class='name'>".$set[$i]['name']."</p>"; //nombre
      echo "<div class='item-price'>";
      if ($set[$i]['discount']>0) { //precio,descuento y btn-add
        echo "<div class='item-price-desc'>";
        echo "<p class='precio' value='".$set[$i]['price']."'>Precio: <del>".$set[$i]['price']."</del></p>";
        echo "<p class='descuento'>con desc. ".$set[$i]['discount']."% ".$set[$i]['price']*(1-$set[$i]['discount']/100)."</p>";
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

}

$q = $_GET['q'];
//print_r($q);
retorno_productos($q);
?>