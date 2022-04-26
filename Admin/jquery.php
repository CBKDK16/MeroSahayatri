<?php 

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
    <script type="text/javascript">
        
        $(document).ready(function() {
    function myrequest(e) {
        var name = $('.username').val();
        $.ajax({
            method: "GET",
            url: "http://localhost/merosahayatri/Admin/autofill.php", /* online, change this to your real url */
            data: {
                username: name
            },
            success: function( responseObject ) {
                alert('success');
                $('#posts').val( 'posts' );
                $('#joindate').val('testing join date');
                /*
                once you've gotten your ajax to work, then go through and replace these dummy vals with responseObject.whatever
                */
            },
            failure: function() {
                alert('fail');
            }
        });
    }

    $('#fetchFields').click(function(e) {
        e.preventDefault();
        myrequest();
    });
});

    </script>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="POST">
    <fieldset>
    <legend>Form</legend>
    <label for="username">Username: </label>

    <input type="text" id="username"  name="username" /> 
    <button onclick="myrequest()">fetch</button>
    <label for="posts">Posts: </label>
    <input type="text" id="posts" name="posts"  size="20"/>
    <label for="joindate">Joindate: </label>
    <input type="text" id="joindate" name="joindate"  size="20"/>
    <p><input type="submit" name="submitBtn" value="Submit" /></p>
</body>
</html>