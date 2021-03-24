/*
Bsale Test por Luis Sandoval 20 marzo 2021

Construir una tienda online que despliegue productos agrupados por la categoría a la que
pertenecen. Además, debes agregar un buscador, el cual tiene que estar implementado a nivel de
servidor, mediante una Api Rest cuyo lenguaje y framework puede ser de libre elección. Es decir,
los datos de productos deben llegar filtrados al cliente.
Opcionalmente, puedes implementar filtros por atributo, ordenar productos y paginación.
La aplicación de cliente tiene que estar desarrollada con vanilla javascript (javascript puro), sin
ningún framework, si puedes usar librerías o componentes específicos, tales como; boopstrap,
material, Jquery, entre otros.
Finalmente, debes disponibilizar la aplicación de forma pública (tales como Heroku u otro hosting) y
el repositorio con el código.

● El código debe ser limpio y seguir buenas prácticas.
● La aplicación debe ser eficiente y controlar errores.
● Documentar la aplicación.
● Entregar buena usabilidad y experiencia al usuario.
● Se debe utilizar control de versiones (excluyente).
● La aplicación debe tener deploy (excluyente).

Tablas
product(id,name,url_image,price,discount,category) category fk de category
category(id,name)

*/
document.addEventListener('DOMContentLoaded', () => {
//--------------Selectores--------------
    const cartBtn = document.querySelector('.cart-btn'); //abre carrito de compras
    const closeCarbtn = document.querySelector('.close-cart'); //cerrar el carro de compras
    const compra = document.querySelector('.cart-item');
    const agregarCarro = document.querySelector('.add-cart');
    const categorias = document.querySelector('.categoria');
    const mostrarProduct = document.querySelector('#mostrar');
    const link1 = document.querySelector('#bebida-energetica');
    const buscador = document.querySelector('#buscador');
    const formulario = document.querySelector('.formulario');
    //-------------EventListener----------
    buscador.addEventListener('input', buscadorProductos);
    //link1.addEventListener('click',enVenta)
//Fin del addEventListener DOMContentLoaded
});

//------------funciones---------------
function enVenta(str){
    console.log(str)
    var myobj;
    mostrar = document.getElementById('mostrar');
    if (str == "") {
        mostrar.innerHTML = `${alert('no se encuentra')}`;
        return;
    }else{
        dbConsulta = JSON.stringify(str);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                mostrar.innerHTML = this.responseText;
            }else {
                console.log('Error Code: ' +  this.status);
                console.log('Error Message: ' + this.statusText);
            }
        };
        xmlhttp.open("GET","request.php?q="+str,true);
        xmlhttp.send();
    }
    console.log(xmlhttp);
};

function buscadorProductos(e){
    e.preventDefault();
    dbConsulta = JSON.stringify(e.target.value);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            mostrar.innerHTML = this.responseText;
        }else {
            console.log('Error Code: ' +  this.status);
            console.log('Error Message: ' + this.statusText);
        }
    };
    xmlhttp.open("GET","buscador.php?q="+dbConsulta,true);
    xmlhttp.send();
}

/*function productos(str){
    //elementos html
    const p1 = document.createElement("p");
    const img = document.createElement("img");
    const p2 = document.createElement("p");
    const p3 = document.createElement("p");
    const a = document.createElement("a");
    console.log(str);
    //llenado
    if (str != null) { //si selecione un tipo de producto
        //filtro = enVenta(this.target.value);//filtro por el producto selecionado en la db y regreso una lista
        str.forEach(element => { //creo el contenido html que deseo agregar
            p1.textContent = element.name;
            img.src = element.url_image;
            img.alt = element.name;
            p2.textContent = `Precio: $${element.price}`;
            if (element.discount != null) {
                p3.textContent = `Descuento: ${element.discount}%`;
            }
            //querry selector donde lo quiero agregar mi html
        });   
    }
    
    mostrarProduct.appendChild(img,p1,p2,p3);

};*/

//------------consulta db--------------

