<script src="http://yui.yahooapis.com/3.14.1/build/yui/yui.js"></script>
<script src="css/masonry.pkgd.min.js"></script>
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

    var container = document.querySelector('#container');
    var msnry = new Masonry( container, {
        // options
        columnWidth: 200,
        itemSelector: '.item'
    });
</script>