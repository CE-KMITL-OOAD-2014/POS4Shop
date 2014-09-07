<!doctype html>
<html>
<head>
    @include('header')
</head>
<body>
@include('topmenu')
<div class="l-box-lrg pure-u-1 pure-u-md-3-5">
    <table class="pure-table">
        <thead>
        <tr>
            <th>ลำดับที่</th>
            <th>ชื่อสินค้า</th>
            <th>บาร์โค้ด</th>
            <th>ราคา</th>
        </tr>
        </thead>

        <tbody>

        </tbody>
    </table>

    <a href="#myModal" role="button" class="pure-button-primary pure-button" data-toggle="modal">
        +
    </a>

    <div style="display: none;" id="myModal" class="modal hide fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <h1 id="myModalLabel">A Bootstrap Modal with Pure</h1>
        </div>

        <div class="modal-body">

            <form class="pure-form pure-form-stacked">
                <legend>A Stacked Form</legend>

                <label for="email">Email</label>
                <input id="email" placeholder="Email" type="text">

                <label for="password">Password</label>
                <input id="password" placeholder="Password" type="password">

                <label for="state">State</label>
                <select id="state">
                    <option>AL</option>
                    <option>CA</option>
                    <option>IL</option>
                </select>

                <label class="pure-checkbox">
                    <input type="checkbox"> Remember me
                </label>
            </form>
        </div>

        <div class="modal-footer">
            <button class="pure-button" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="pure-button pure-button-primary">Submit</button>
        </div>
    </div>
</div>
</body>
<footer>
    @include('footer')
</footer>
</html>