<!doctype html>
<html>
<head>
    @include('header')
</head>
<body>
@include('topmenu')
<?php
if(isset($_POST["submitEdit"])){
    $editProduct = Product::where('barcode', $_POST["submitEdit"])->first();
}else if(isset($_POST["submitSave"])){
    $saveProduct = Product::where('barcode', $_POST["old_barcode"])->first();
    $saveProduct->name = $_POST["product_name"];
    $saveProduct->barcode = $_POST["product_barcode"];
    $saveProduct->price = $_POST["product_price"];
    $saveProduct->detail = $_POST["product_detail"];
    $saveProduct->save();
}
$products = Product::paginate(15);
?>
<div class="pure-g">
    <div class="content pure-u-3-5">
        <div class="content">
            <table class="pure-table">
                <thead>
                <tr>
                    <th>ลำดับที่</th>
                    <th>ชื่อสินค้า</th>
                    <th>บาร์โค้ด</th>
                    <th>ราคา</th>
                    <th>แก้ไขสินค้า</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($products as $product) {
                    ?>

                    <tr>
                        <td>
                            <?php
                            echo $product->id;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $product->name;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $product->barcode;
                            ?>
                        </td>
                        <td>
                            <?php
                            echo $product->price;
                            ?>
                        </td>
                        <td>
                            <form class="pure-form pure-form-aligned" method="post" action="<?php echo action('ProductController@edit');?>">
                                <fieldset>
                                    <button type="Submit" value="<?php echo $product->barcode;?>" name='submitEdit' class="pure-button pure-button-primary">Edit</button>
                                </fieldset>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
    if(isset($_POST["submitEdit"])){
        $editProduct = Product::where('barcode', $_POST["submitEdit"])->first();        ;
    ?>
    <div class="content pure-u-2-5">
        <div class="content">
            <form onsubmit="return submitEditForm();" class="pure-form pure-form-aligned" name="editProductForm" method="post" action="<?php echo action('ProductController@edit');?>" enctype="multipart/form-data">
                <fieldset>
                    <div class="pure-control-group">
                        <label>Name</label>
                        <input name="product_name" value="<?php echo $editProduct->name;?>" placeholder="<?php echo $editProduct->name;?>" type="text">
                    </div>
                    <div class="pure-control-group">
                        <label>Barcode</label>
                        <input name="product_barcode" value="<?php echo $editProduct->barcode;?>" placeholder="<?php echo $editProduct->barcode;?>" type="text">
                    </div>
                    <div class="pure-control-group">
                        <label>Price</label>
                        <input name="product_price" value="<?php echo $editProduct->price;?>" placeholder="<?php echo $editProduct->price;?>" type="text">
                    </div>
                    <div class="pure-control-group">
                        <label>Detail</label>
                        <input name="product_detail" value="<?php echo $editProduct->detail;?>" placeholder="<?php echo $editProduct->detail;?>" type="text">
                    </div>
                    <input name="old_barcode" value="<?php echo $editProduct->barcode;?>" type="hidden">
                    <button type="Submit" value="Submit" name='submitSave' class="pure-button pure-button-primary">Submit</button>
                </fieldset>
            </form>
        </div>
    </div>
    <?php
    }

    ?>
</div>

    <?php echo $products->links(); ?>

</body>
<footer>
    <script>
        function submitEditForm() {
            var nameId = document.editProductForm.product_name;
            var barcodeId = document.editProductForm.product_barcode;
            var priceId = document.editProductForm.product_price;
            var detailId = document.editProductForm.product_detail;
            if (nameId.value.length == 0) {
                alert("กรุณาระบุชือสินค้า");
                nameId.focus();
            } else if (barcodeId.value.length == 0) {
                alert("กรุณาระบุหมายเลข barcode");
                barcodeId.focus();
            } else if (isNaN(barcodeId.value)){
                alert("กรุณาระบุราคาเลขบาร์โค้ดให้ถูกต้อง");
            } else if (priceId.value.length == 0) {
                alert("โปรดระบุราคาสินค้า");
                priceId.focus();
            } else if (isNaN(priceId.value)){
                alert("กรุณาระบุราคาสินค้าให้ถูกต้อง");
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