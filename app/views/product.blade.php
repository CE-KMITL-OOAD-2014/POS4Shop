<!doctype html>
<html>
<head>
    @include('header')
</head>
<body>
@include('topmenu')
<?php
$count = 0;
if (isset($_POST['submit'])) {
    if (isset($_POST['product_search'])) {
        $products = Product::where('name', 'LIKE', '%' . $_POST['product_search'] . '%')->paginate(15);

    }
} else {
    $products = Product::paginate(15);
}
?>
<div class="pure-g">
    <div class="text-box u-1 u-med-1-2 u-lrg-1-3">
        <div class="l-box">
            <h1 class="text-box-head">Product</h1>

            <p class="text-box-subhead">เลือกสรรค์สินค้าคุณภาพ ถึงมือคุณ.</p>
        </div>
    </div>
    <?php
    foreach ($products as $product) {
        $count++;
        ?>
        <div class="photo-box u-1 u-med-1-2 u-lrg-1-3">
            <img src="<?php echo "http://ooad.ioniz.tk/upload/" . $product->img_filename; ?>">


            <aside class="photo-box-caption">
                <span>
                    <?php echo "http://ooad.ioniz.tk/upload/" . $product->img_filename; ?>
                    <?php echo $product->name; ?>
                </span>
            </aside>
        </div>
    <?php
    }
    if ($count == 0) {
        echo "No product name " . $_GET['product_search'] . ".";
    }
    ?>

    <?php echo $products->links(); ?>

</div>
</body>
<footer>
    @include('footer')
</footer>
</html>