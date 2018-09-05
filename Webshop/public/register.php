<?php
	// Hier pakt hij de boot.php bestand voor het laden
	require '../boot.php';

	// alle errors in een array
	$errors = [];

	if($_SERVER['REQUEST_METHOD'] === 'POST') {

		// Hier staan de variables voor het form in een array
		// Met required en de min/max tekens
		$variables = [
			'email' => ['required', 'email', 'min:7', 'max:155'],
			'password' => ['required', 'min:8', 'max:100', 'confirmed'],
			'first_name' => ['required', 'name', 'min:2', 'max:50'],
			'suffix_name' => ['min:1', 'max:15', 'name'],
			'last_name' => ['required', 'name', 'min:2', 'max:50'],
			'country' => ['min:2', 'max:15', 'name'],
			'city' => ['required', 'min:2', 'max:55', 'name'],
			'street' => ['required', 'min:2', 'max:85', 'name'],
			'street_number' => ['required', 'min:1', 'max:5'],
			'street_suffix' => ['min:1', 'max:25'],
			'zipcode' => ['required', 'postcode', 'min:6', 'max:7'],
		];

		// Hier pakt hij de validatie.php bestand
		require '../app/validation/validations.php';

		// hier de errors.
		if(count($errors) == 0) {
            require '../app/payment/new.php';
            // hier reset hij de cart na een gelukte betaling
            cart::reset();
            // hier de link naar de gelukt.php page als de betaling gelukt is.
            header('Location: '.asset('gelukt.php'));
            die();
        }

	}

	function errors()
	{

	}

	function value($key)
	{
		return @$_POST[$key];
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
        		<a class="navbar-brand" href="index.php">Kattenvoer.com</a>

        		<!-- Dropdown for mobile -->
        		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
				    <span class="navbar-toggler-icon"></span>
				</button>

		        <div class="collapse navbar-collapse" id="navbarSupportedContent">
		            <ul class="navbar-nav ml-auto">
		                <li class="nav-item">
		                    <a class="nav-link" href="index.php">Home</a>
		                </li>
		                <li class="nav-item">
		                    <a class="nav-link" href="#">register</a>
		                </li>
		                <li class="nav-item">
		                    <a class="nav-link" href="#">Login</a>
		                </li>
		            </ul>
		        </div>
    		</nav>

    		<section class="content">
			<h1 class="col-sm-3">Register</h1>

			<!-- Hier krijg je te zien als je een error hebt in de invoer veld. -->
			<?php if($errors) { ?>
				<div class="alert alert-danger">
				Whoops, not everything is filled in correctly.
				</div>
			<?php } ?>

			<form class="form-horizontal" method="POST">
			<legend class="col-sm-3">Pay</legend>

			<br>
			<!-- invul vak -->
			<div class="col-sm-3">
				<label class="col-sm-3 control-label">First Name</label>
				<div>
					<input class="form-control" name="first_name" type="text" placeholder="Voornaam" value="<?php echo value('first_name'); ?>">
					<?php echo (@$errors['first_name']) ? '<p class="text-danger">'.$errors['first_name'][0].'</p>' : ''; ?>
				</div>
			</div>

			<!-- invul vak -->
			<div class="col-sm-3">
				<label class="col-sm-3 control-label">Tussenvoegsel</label>
				<div>
					<input class="form-control" name="suffix_name" type="text" placeholder="Tussenvoegsel" value="<?php echo value('suffix_name'); ?>">
					<?php echo (@$errors['suffix_name']) ? '<p class="text-danger">'.$errors['suffix_name'][0].'</p>' : ''; ?>
				</div>
			</div>

			<!-- invul vak -->
			<div class="col-sm-3">
				<label class="col-sm-3 control-label">Achternaam</label>
				<div>
					<input class="form-control" name="last_name" type="text" placeholder="Achternaam" value="<?php echo value('last_name'); ?>">
					<?php echo (@$errors['last_name']) ? '<p class="text-danger">'.$errors['last_name'][0].'</p>' : ''; ?>
				</div>
			</div>

			<!-- invul vak -->
			<div class="form-group">
				<label class="col-sm-3 control-label">
					Land
				</label>
				<div class="col-sm-2">
					<select class="form-control" name="country" placeholder="Kies een land">
						<!-- een voor each voor meerdere landen -->
						<?php foreach([
							'NL' => 'Nederland',
							'BE' => 'België',
							'DE' => 'Deutschland'
						] as $iso => $country) { ?>
						<option value="<?php echo $iso; ?>" <?php echo (value('country')) ? 'selected="selected"' : ''; ?>><?php echo $country; ?></option>
						<?php } ?>
					</select>
					<?php echo (@$errors['country']) ? '<p class="text-danger">'.$errors['country'][0].'</p>' : ''; ?>
				</div>
			</div>

			<!-- invul vak -->
			<div class="col-sm-3">
				<label>Plaats</label>
				<div>
					<input class="form-control" name="city" type="text" placeholder="Plaats" value="<?php echo value('city'); ?>">
					<?php echo (@$errors['city']) ? '<p class="text-danger">'.$errors['city'][0].'</p>' : ''; ?>
				</div>
			</div>

			<!-- invul vak -->
			<div class="col-sm-3">
				<label>Adres</label>
				<div>
					<input class="form-control" name="street" type="text" placeholder="Adres" value="<?php echo value('street'); ?>">
					<?php echo (@$errors['street']) ? '<p class="text-danger">'.$errors['street'][0].'</p>' : ''; ?>
				</div>
			</div>

			<!-- invul vak -->
			<div class="col-sm-3">
				<label>Huisnummer</label>
				<div>
					<input class="form-control" name="street_number" type="text" placeholder="Huisnummer" value="<?php echo value('street_number'); ?>">
					<?php echo (@$errors['street_number']) ? '<p class="text-danger">'.$errors['street_number'][0].'</p>' : ''; ?>
				</div>
			</div>

			<!-- invul vak -->
			<div class="col-sm-3">
				<label>Bijvoeging</label>
				<div>
					<input class="form-control" name="street_suffix" type="text" placeholder="Bijvoeging" value="<?php echo value('street_suffix'); ?>">
					<?php echo (@$errors['street_suffix']) ? '<p class="text-danger">'.$errors['street_suffix'][0].'</p>' : ''; ?>
				</div>
			</div>

			<!-- invul vak -->
			<div class="col-sm-3">
				<label>Postcode</label>
				<div>
					<input class="form-control" name="zipcode" type="text" placeholder="Postcode" value="<?php echo value('zipcode'); ?>">
					<?php echo (@$errors['zipcode']) ? '<p class="text-danger">'.$errors['zipcode'][0].'</p>' : ''; ?>
				</div>
			</div>

			<!-- invul vak -->
			<div class="col-sm-3">
				<label>E-mail</label>
				<div>
					<input class="form-control" name="email" type="text" placeholder="E-mail" value="<?php echo value('email'); ?>">
					<?php echo (@$errors['email']) ? '<p class="text-danger">'.$errors['email'][0].'</p>' : ''; ?>
				</div>
			</div>

			<!-- invul vak -->
			<div class="col-sm-3">
				<label>Wachtwoord</label>
				<div>
					<input class="form-control" name="password" type="password" placeholder="Wachtwoord">
					<?php echo (@$errors['password']) ? '<p class="text-danger">'.$errors['password'][0].'</p>' : ''; ?>
				</div>
			</div>

			<!-- invul vak -->
			<div class="col-sm-3">
				<label>Herhaal wachtwoord</label>
				<div>
					<input class="form-control" name="password_confirmed" type="password" placeholder="Herhaal wachtwoord">
				</div>
			</div>

			<!-- invul vak -->
			<div class="col-sm-3">
				<label>Afronden</label>
				<div>
					<button type="submit" name="betaal_knop" class="btn btn-primary">Betalen</button>
				</div>
			</div>

			</form>
		</section>
		</div>

	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	    <!-- Link naar de js voor de cart -->
	    <script type="text/javascript" src="<?php echo asset('js/app.js'); ?>"></script>

	</body>
</html>

