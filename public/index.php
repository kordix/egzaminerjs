<?php
session_start();

if(!isset($_SESSION['zalogowany'])){
    header('Location: /login.php');
}

if($_SESSION['zalogowany']){
    
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egzaminer noframework</title>
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        #wyloguj{
            display:block;
        }
    </style>
</head>
<body>

<div id="app">
<?php  include 'navbar.php' ?>
    
    <div  class="container" id="app">
    <!-- <app></app> -->

<!-- <test></test> -->
<!-- <crudcomp></crudcomp> -->
<settings></settings>
<tester></tester>

<categoriser></categoriser>


</div>

</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    

<?php include('../components/crudcomp.php') ?>
<?php include('../components/app.php') ?>
<?php include('../components/test.php') ?>
<?php include('../components/tester.php') ?>
<?php include('../components/categoriser.php') ?>
<?php include('../components/settings.php') ?>
<?php include('../components/Add.php') ?>





   <script>
   String.prototype.escapeDiacritics = function()
    {
        return this.replace(/ą/g, 'a').replace(/Ą/g, 'A')
            .replace(/ć/g, 'c').replace(/Ć/g, 'C')
            .replace(/ę/g, 'e').replace(/Ę/g, 'E')
            .replace(/ł/g, 'l').replace(/Ł/g, 'L')
            .replace(/ń/g, 'n').replace(/Ń/g, 'N')
            .replace(/ó/g, 'o').replace(/Ó/g, 'O')
            .replace(/ś/g, 's').replace(/Ś/g, 'S')
            .replace(/ż/g, 'z').replace(/Ż/g, 'Z')
            .replace(/ź/g, 'z').replace(/Ź/g, 'Z')
            .replace(/ü/g, 'u').replace(/ú/g, 'u')
            .replace(/ö/g, 'o').replace(/é/g,'e')
            .replace(/ä/g, 'a').replace(/í/g,'i')
            .replace(/á/g,'a').replace(/ö/g,'o')
            .replace(/ß/g,'ss')
            .replace(/ñ/g,'n')
            ;
    }
   </script>

<script src="script.js"></script>

</body>
</html>