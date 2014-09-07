<script src="http://yui.yahooapis.com/3.14.1/build/yui/yui.js"></script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
<script>
    function submitSearchForm() {
        var searchId = document.searchForm.product_search;
        if (searchId.value.length == 0) {
            alert("กรุณาระบุชือสินค้าที่ต้องดการค้นหา");
            searchId.focus();
        } else{
            return true;
        }
        return false;
    }
</script>