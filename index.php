<?php
$method = $_SERVER['REQUEST_METHOD'];

$parsed = parse_url($_SERVER['REQUEST_URI']);
$path = $parsed['path'];

$routes = [
    "GET" => [
        "/KODB_PHP12/" => "homeHandler",
        "/KODB_PHP12/termekek" => "productListHandler"
    ],
    "POST" => [
        "/KODB_PHP12/termekek" => "createProductHandler"
    ]
];
// ebbe a function-ba kötjük be a methodot és a path-t stringként
$handlerFunction = $routes[$method][$path] ?? "notFoundHandler";

// elírások kiküszöbölésére egy beépített függvényvizsgálatot hívunk
$safeHandlerFunction = function_exists($handlerFunction) ? $handlerFunction : "notFoundHandler";
$safeHandlerFunction();

function compileTemplate($filePath, $params = []): string
{
    ob_start();
    require $filePath;
    return ob_get_clean();
}

function homeHandler()
{
    $homeTemplate = compileTemplate('./views/home.php');
    echo compileTemplate("./views/wrapper.php", [
        'innerTemplate' => $homeTemplate,
        'activeLink' => "KODB_PHP12/"
    ]);
}

function productListHandler()
{
    $content = file_get_contents("./products.json");
    $products = json_decode($content, true);
    //echo "<pre>";
    //var_dump($products);
    $isSuccess = isset($_GET["siker"]);  //ha létezik ez a query paraméter true lesz, ha nem akkor faults
    
    $productTemplate = compileTemplate("./views/product-list.php", [
        "products" => $products,
        "isSuccess" => $isSuccess
    ]);

    echo compileTemplate("./views/wrapper.php", [
        'innerTemplate' => $productTemplate,
        'activeLink' => "KODB_PHP12/termekek"
    ]);
}

function createProductHandler()
{
    $newProduct = [
        "id" => uniqid(),
        "name" => $_POST["name"],
        "price" => (int)$_POST["price"]
    ];

    //lekérjük a termékeket
    $content = file_get_contents("./products.json");
    $products = json_decode($content, true);
    // módosítjuk a terméklistát az új elemmel
    array_push($products, $newProduct);
    // vissza alakítjuk json formátummá a kibővített terméklistát
    $json = json_encode($products);
    // módosítjuk a products.json fájlunkat
    file_put_contents("./products.json", $json);

    header("Location: /KODB_PHP12/termekek?siker=1");
}

function notFoundHandler()
{
    echo "Az oldal nem talélható";
}
?>
