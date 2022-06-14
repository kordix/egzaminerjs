<?php
session_start();

if (isset($_SESSION['zalogowany'])) {
    header('location:/');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zaloguj</title>
</head>
<body>


<div id="app">
<label for="">Login</label>
<input type="text" v-model="login" id="logininput" @keyup.enter="zaloguj()">
<label for="">Haslo</label>
<input type="password" v-model="password" @keyup.enter="zaloguj()">

<button @click="zaloguj">Zaloguj</button>

<button @click="test">Test</button>

<p><b>{{error}}</b></p>



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
        testdata:''
    },
    mounted(){
        document.getElementById('logininput').focus();
        document.getElementById('logininput').select();
    },
    methods:{
        test(){
            // axios.get('/api/test.php')
            //     .catch(function (error) {
            //         if (error.response) {
            //                 // Request made and server responded
            //                 console.log(error.response.data);
            //                 console.log(error.response.status);
            //                 console.log(error.response.headers);
            //                 } else if (error.request) {
            //                 // The request was made but no response was received
            //                 console.log(error.request);
            //                 } else {
            //                 // Something happened in setting up the request that triggered an Error
            //                 console.log('Error', error.message);
            //                 }

            //             });

            axios.get('api/test.php').then((res)=>{ if(res.data == 'DUPA'){ console.log('FAKTYCZNIE WIDZI TAM DUPE');}  })

        },
        zaloguj(){
            let self = this;
            try{
            axios.post('api/zaloguj.php',{login:this.login,password:this.password}).then((res)=>{
                console.log(res.data.length);

              

                if(res.data.trim() == 'ZALOGOWANY'){
                    console.log('JOŁ JOŁ ZALOGOWANY');
                   location.reload();
                }else if(res.data.trim() == 'NOCONNECTION'){
                    self.error = 'BRAK POŁĄCZENIA';
                }else if(res.data.trim() == 'BADLOGIN'){
                    self.error = 'Zły login lub hasło';
                    
                }else{
                    self.error = 'Wystąpił jakiś błąd';
                }
            })

            }catch(e){
                self.error = e;
            }

        }
    }
})

</script>
</body>
</html>