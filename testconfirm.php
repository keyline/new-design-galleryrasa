<!DOCTYPE html>
<html>
    <body>

        <p>Click the button to display a confirm box.</p>


        <?php
        for ($i = 0; $i < 5; $i++) {
            
            

            $var1 = '<a href="google.com" target="_blank" onclick="myFunction()">Try it</a>';


//            $var2 = '<script>
//function myFunction' . $i . '() {
//  confirm("Press a button! ' . $i . ' ");
//}
//</script>';

            echo  $var1 ;
            ?>

           

            <?php
        }
        ?>

    </body>
</html>

 <script>
                function myFunction() {
                    var txt;
                    var r = confirm("Press a button!");
                    if (r == true) {
                        txt = "You pressed OK!";
                    } else {
                        txt = "You pressed Cancel!";
                        event.preventDefault();
                    }
                    //document.getElementById("demo").innerHTML = txt;
                }
            </script>
