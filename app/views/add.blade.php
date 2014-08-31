<!doctype html>
<html>
<head>
    @include('header')
</head>
<body>
@include('topmenu')
<?php
if (isset($_POST['submit'])) {
    $query = DB::table('products')->where('barcode', $_POST["product_barcode"])->pluck('barcode');
    if (!empty($query)) {
        echo "Already have this product barcode in store.";
        ?>
    <?php
    } else {
        $product = new Product;
        if (isset($_FILES['product_file'])){
          //  $name       = $_FILES['product_file']['name'];
         //   $temp_name  = $_FILES['product_file']['tmp_name'];

            if ($_FILES["product_file"]["error"] > 0) {
                echo "Error: " . $_FILES["file"]["error"] . "<br>";
            }else{
                if (file_exists("upload/" . $_FILES["product_file"]["name"])) {
                    echo $_FILES["product_file"]["name"] . " already exists. ";
                } else {
                   move_uploaded_file($_FILES["product_file"]["tmp_name"],
                        storage_path()."/upload/" . $_FILES["product_file"]["name"]);
                    echo "Stored in: " .storage_path(). "/upload/" . $_FILES["product_file"]["name"];

                    $product->img_filename = $_FILES['product_file']['name'];
                }
            }
        }else{
            $product->img_filename = "no image";
        }
        $product->name = $_POST["product_name"];
        $product->barcode = $_POST["product_barcode"];
        $product->price = $_POST["product_price"];
        $product->detail = $_POST["product_detail"];
        $product->save();
    }
    ?>
<?php
} else {
    ?>
    <div class="pure-g">
        <div class="content pure-u-2-5">
            <div class="content">
            </div>
        </div>
        <div class="content pure-u-3-5">
            <div class="content">
                <form onsubmit="return submitAddForm();" class="pure-form pure-form-aligned" name="addProductForm" method="post" action="" enctype="multipart/form-data">
                    <fieldset>
                        <div class="pure-control-group">
                            <label>Name</label>
                            <input name="product_name" placeholder="name" type="text">
                        </div>
                        <div class="pure-control-group">
                            <label>Barcode</label>
                            <input name="product_barcode" placeholder="barcode" type="text">
                        </div>
                        <div class="pure-control-group">
                            <label>Price</label>
                            <input name="product_price" placeholder="price" type="text">
                        </div>
                        <div class="pure-control-group">
                            <label>Detail</label>
                            <input name="product_detail" placeholder="detail" type="text">
                        </div>
                        <div class="pure-control-group">
                            <label>File</label>
                            <input type="file" name="product_file" id="product_file">
                        </div>
                        <button type="Submit" value="Submit" name='submit' class="pure-button pure-button-primary">Submit</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
<?php
}
?>
</body>
<footer>

    <script>
        function submitAddForm() {
            var nameId = document.addProductForm.product_name;
            var barcodeId = document.addProductForm.product_barcode;
            var priceId = document.addProductForm.product_price;
            var detailId = document.addProductForm.product_detail;
            if (nameId.value.length == 0) {
                alert("กรุณาระบุชือสินค้า");
                nameId.focus();
            } else if (barcodeId.value.length == 0) {
                alert("กรุณาระบุหมายเลข barcode");
                barcodeId.focus();
            } else if (priceId.value.length == 0) {
                alert("โปรดระบุราคาสินค้า");
                priceId.focus();
            } else if (detailId.value.length == 0) {
                alert("โปรดระบุรายละเอียดสินค้า");
                detailId.focus();
            } else{
                return true;
            }
            return false;
        }
    </script>
    @include('footer')
</footer>
</html>