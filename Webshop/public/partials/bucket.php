<h2>Cart</h2>

<table class="table">
	<thead>
		<tr>
			<th>Title</th>
			<th>Quantity</th>
			<th>Price</th>
		</tr>
	</thead>

	<tbody>
        <?php foreach ($_SESSION['cart']['products'] as $cartProduct) { ?>
        <tr>
            <td><?php echo $cartProduct['title']; ?></td>
            <td class="oneline"><?php echo $cartProduct['quantity']; ?>
            <button class="btn1 btn-success add-to-cart" data-url="<?php echo asset('cart/add.php?id='.$cartProduct['id']); ?>">+</button>
            <button class="btn1 btn-danger add-to-cart" data-url="<?php echo asset('cart/remove.php?id='.$cartProduct['id']); ?>">-</button></td>
            <td>€<?php echo $cartProduct['price']; ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

Totaal: &euro; <?php echo $_SESSION['cart']['total']; ?>
<a href="<?php echo asset ('register.php'); ?>" class="btn btn-success">Betalen?</a>
