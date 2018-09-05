<!-- Query for Database -->
<?php
	// Hier pakt hij de boot.php bestand voor het laden
    require '../boot.php';


    $database = db();
    $product = $database->prepare('SELECT * FROM products WHERE slug = :slug');

    try {
        $product->execute([
            'slug' => $_GET['slug']
        ]);
        $product->setFetchMode(PDO::FETCH_ASSOC);
        $product = $product->fetch();

        if(! $product) {
            // redirect naar 404
            header('Location: '.asset('partials/404.php')); // 404.php pagina
        }

    }
    catch(PDOException $e) {
        dd($e->getMessage());
    }
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Webshop</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Webshop opdracht ROCvA MBO Niveau 4 OA">
        <meta name="keywords" content="Webshop, verkoop, kattenvoer, verkoop kattenvoer, goedkoop, voordeelig, ROCvA, ROC van Amsterdam">
        <meta name="author" content="Jouri Zevenhek">

        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
	</head>

	<body>
		<div class="container">

			<!-- Header -->
    		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        		<a class="navbar-brand" href="../index.php"">Kattenvoer.com</a>

        		<!-- Dropdown for mobile -->
        		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
				    <span class="navbar-toggler-icon"></span>
				</button>

		        <div class="collapse navbar-collapse" id="navbarSupportedContent">
		            <ul class="navbar-nav ml-auto">
		                <li class="nav-item">
		                    <a class="nav-link" href="../index.php">Home</a>
		                </li>
		                <li class="nav-item">
		                    <a class="nav-link" href="../register.php">Register</a>
		                </li>
		                <li class="nav-item">
		                    <a class="nav-link" href="#">Login</a>
		                </li>
		            </ul>
		        </div>
    		</nav>

    		<!-- hier pakt hij het product -->
			<div class="row">
			    <div class="row">
		            <div class="col-lg-12 text-center product">
		            	<!-- Hier pakt hij automatich de Title van het product en de afbeelding van de DB -->
		                <h1><?php echo $product['title']; ?></h1>
		                <img src="../images/small/<?php echo $product['image']; ?>" width="200" height="250">
		                <!-- Hier pakt hij automatich de Title van het product en de afbeelding van de DB -->
		                <p><?php echo $product['description']; ?></p>
		                <h4> €<?php echo $product['price']; ?></h4>
		                <button class="btn btn-success add-to-cart" data-url="../cart/add.php?id=<?php echo $product['id']; ?>">Add product</button>
		            </div>
        		</div>
			</div>

			<!-- Cart -->
			<div id="cart" class="row">
			    <div class="col-lg-4">
			        <aside class="bucket" id="bucket">
		                <?php include "partials/bucket.php"; ?>
		            </aside>
			    </div>
			</div>
		</div>

	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	    <!-- Link naar de js voor de cart -->
	    <script type="text/javascript" src="<?php echo asset('js/app.js'); ?>"></script>

	</body>
</html>
