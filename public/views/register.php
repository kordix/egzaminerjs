<?php
session_start();

if(isset($_SESSION['zalogowany'])){
   // header('location:/');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaloguj</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>


<div id="app" class="container my-5">
<label for="">Login</label>
<input type="text" v-model="login">
<label for="">Haslo</label>
<input type="password" v-model="password">

<button @click="register">Zarejestruj</button>

<p v-html><b v-html>{{error}}</b></p>

<p v-if="success">Gratulacje, pomyślnie zarejestrowano użytkownika. Możesz <a href="/login.php"> się zalogować</a></p>



</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>

<script>
let app = new Vue({
    el:'#app',
    data:{
        login:'',
        password:'',
        error:'',
        success:false
    },
    methods:{
        register(){
            let self = this;
            axios.post('api/register.php',{login:this.login,password:this.password}).then((res)=>{
                // console.log(res.data)
                this.login = '';
                this.password = '';

                this.success = true;
              
            })
        }
    }
})

</script>
</body>
</html>