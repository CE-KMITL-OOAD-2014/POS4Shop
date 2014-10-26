<!doctype html>
<html>
<head>
    @include('header')
</head>
<body>
@include('topmenu')
<?php
if (isset($_POST['submit'])) {
    $id = Customer::all()->count();
    $cid = substr(sha1($id+1),0,5);
    $query = Customer::where('cid', $cid)->pluck('cid');
    if (!empty($query)) {
        echo "Already have this customer in database.";
        ?>
    <?php
    } else {
        $customer = new Customer;
        $customer->name = $_POST["customer_name"];
        $customer->cid = $cid;
        $customer->save();
    }
    ?>
<?php
} else {
    $customers = Customer::paginate(15);
    ?>
    <div class="pure-g">
        <div class="content pure-u-2-5">
            <div class="content">
                <table class="pure-table">
                    <thead>
                    <tr>
                        <th>ลำดับที่</th>
                        <th>ชื่อ</th>
                        <th>id</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($customers as $customer) {
                        ?>

                        <tr>
                            <td>
                                <?php
                                echo $customer->id;
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $customer->name;
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $customer->cid;
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="content pure-u-3-5">
            <div class="content">
                <form onsubmit="return submitAddCustomerForm();" class="pure-form pure-form-aligned" name="addCustomerForm" method="post" action="<?php echo action('CustomerController@add');?>">
                    <fieldset>
                        <div class="pure-control-group">
                            <label>Name</label>
                            <input name="customer_name" placeholder="name" type="text">
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
        function submitAddCustomerForm() {
            var nameId = document.addCustomerForm.product_name;
            if (nameId.value.length == 0) {
                alert("กรุณาระบุชือลูกค้า");
                nameId.focus();
            } else{
                return true;
            }
            return false;
        }
    </script>
    @include('footer')
</footer>
</html>