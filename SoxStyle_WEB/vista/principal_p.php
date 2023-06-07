<?php $url = "../"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Css/pagina_producto.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Pagina Producto</title>
</head>
<?php include_once('../Complementos/Header.php') ?>
<body>
    <div class="container-title">Camisas</div>
    <main>
        <div class="container-img">
            <img src="https://img.freepik.com/vector-premium/diseno-camisetas-futbol-sublimacion-diseno-camisetas-deportivas_29096-3212.jpg" alt="">
        </div>
        <div class="container-info-product">
            <div class="container-price">
                <span>$25000</span>
                <i class="fa-solid fa-angle-right"></i></i>
        </div>
        <div class="container-details-product">
            <div class="form-group">
                <label for="colour">Color</label>
                <select name="colour" id="colour">
                    <option disabled selected value="">Escoge una opcion</option>
                    <option value="rojo">rojo</option>
                    <option value="Blanco">Blanco</option>
                    <option value="Beige">Beige</option>
                </select>
                    
                <div class="form-group">
                    <label for="size">Talla</label>
                    <select name="size" id="size">
                        <option disabled selected value="">Escoge una opcion</option>
                        <option value="40">40</option>
                        <option value="42">42</option>
                        <option value="43">43</option>
                        <option value="44">44</option>
                    </select>
                </div>  
             
            </div>
            <button class="btn-clean">Limpiar</button>
            <br>
            <br>
         
            <div class="container-add-cart">
                <div class="container-quantity">
                    <input type="number" placeholder="1" min="1" class="input-quantity">
                    <div class="btn-increment-decrement">
                        <i class="fa-solid fa-plus" id="Increment"></i>
                        <i class="fa-solid fa-minus" id="Decrement"></i>
                    </div>
                </div>
                <button class="btn-add-to-cart">
                    <img src="../icons/Lg-añadir-carrito.png" alt="" width="25px" height="25px">
                    Añadir al carrito</button>
                    
            </div>
            

            <br>
            <br>

            <div class="container-description">
                <div class="title-description">
                    <h4>Descripcion</h4>
                    <i class="fa-solid fa-chevron-down"></i></i>
                </div>
                <div class="text-description hidden">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iusto maxime quod perspiciatis voluptatum cupiditate corrupti dolorem magnam, exercitationem obcaecati consequatur id dolor et. Suscipit omnis saepe animi reprehenderit corporis eligendi! Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis ipsam libero, repellendus, aperiam culpa quod, corrupti excepturi reiciendis sint est architecto provident voluptas! Repellat ipsum similique, magnam esse debitis nam.</p>
                </div>
            </div>
            <div class="container-additional-information">
                <div class="title-additional-information">
                    <h4>Informacion adicional</h4>
                    <i class="fa-solid fa-chevron-down"></i></i>
                </div>
                <div class="text-additional-information hidden">
                    <p>------------------------------- </p>

                </div>
    
            </div>  

            <div class="container-reviews">
                <div class="title-reviews">
                    <h4>Reseñas</h4>
                    <i class="fa-solid fa-chevron-down"></i></i>
                </div>
                <div class="text-reviews hidden">
                    <p>------------------------------- </p>
                    
                </div>
    
            </div>  
        </div>
    </main>
    <section class="container-related-products">
        <h2>Productos relacionados</h2>
        <div class="card-list-products">
            <div class="card">
                <div class="card-img">
                    <img src="https://i.pinimg.com/474x/b0/51/7f/b0517f994ba914a3e1ee0019274e56fb.jpg" alt="producto-1">
                </div>
                <div class="info-card">
                    <div class="text-product">
                        <h3>Camisa hombre</h3>
                        <p class="category">
                            Camisasxd
                        </p>
                    </div>
                    <div class="price">$70.000</div>
                </div>
            </div>
        </div>
        <div class="card-list-products">
            <div class="card">
                <div class="card-img">
                    <img src="https://http2.mlstatic.com/D_NQ_NP_882560-MCO49091233620_022022-W.jpg" alt="producto-2">
                </div>
                <div class="info-card">
                    <div class="text-product">
                        <h3>Camisa mujer</h3>
                        <p class="category">
                            Camisasxd
                        </p>
                    </div>
                    <div class="price">$70.000</div>
                </div>
            </div>
        </div>
        <div class="card-list-products">
            <div class="card">
                <div class="card-img">
                    <img src="https://http2.mlstatic.com/D_NQ_NP_763184-MCO54061214742_022023-W.jpg" alt="producto-3">
                </div>
                <div class="info-card">
                    <div class="text-product">
                        <h3>Pantaloneta hombre</h3>
                        <p class="category">
                            Pantaloneta
                        </p>
                    </div>
                    <div class="price">$60.000</div>
                </div>
            </div>
        </div>
        <div class="card-list-products">
            <div class="card">
                <div class="card-img">
                    <img src="https://racketball.vteximg.com.br/arquivos/ids/186386-1248-1546/41962-LICRA-DEPORTIVA-ROSA-MUJER-PANTALONES-Y-LICRAS-RACKETBALL-7701650788425-1.jpg?v=637407337357900000" alt="producto-4">
                </div>
                <div class="info-card">
                    <div class="text-product">
                        <h3>Licra mujer</h3>
                        <p class="category">
                            Licra
                        </p>
                    </div>
                    <div class="price">$50.000</div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <p>Footer</p>
    </footer>
    <script src="https://kit.fontawesome.com/072c8eb564.js" crossorigin="anonymous"></script>
    <script src="../JavaScript/pagina_producto.js"></script>
 
    
    
</body>
<?php include_once('../Complementos/Footer.php') ?>
</html>