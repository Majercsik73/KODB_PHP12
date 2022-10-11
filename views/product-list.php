    
    <div class="card container p-3 m-3">

        <?php if ($params['isSuccess']) : ?>
            <div class="alert alert-success">
            Termék létrehozása sikeres!
            </div>
        <?php endif; ?>
        <form action="/KODB_PHP12/termekek" method="POST">
            <input type="text" name="name" placeholder="Név" />
            <input type="number" name="price" placeholder="Ár" />
            <button type="submit" class="btn btn-success">Küldés</button>
        </form>
        <?php foreach ($params['products'] as $product) : ?>
            <h3>Név: <?php echo $product["name"] ?></h3>
            <p>Ár: <?php echo $product["price"] ?> ft</p>
            
            <?php if($params['editedProductId'] == $product["id"]): ?>
                Szerkesztett elemet
            
            <?php else: ?>
                <div class="btn-group">
                    <a href="/KODB_PHP12/termekek?szerkesztes=<?php echo $product["id"]?>">
                        <button class="btn btn-warning mr-2">Szerkesztés</button>
                    </a>
                    <form method="post" action="/KODB_PHP12/delete-product?id=<?php echo $product["id"] ?>">
                        <button type="submit" class="btn btn-danger">Törlés</button>
                    </form>
                </div>
            <?php endif; ?>

            
            <hr>
        <?php endforeach; ?>

        
    </div>
