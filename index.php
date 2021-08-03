<!DOCTYPE HTML>
<html lang="en-US">
    <head>
        <meta charset="iso-8859">
        <title>Formulário de Login com PHP OO</title>

        <link rel="stylesheet" href="css/style.css" />
        <script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.6.3.min.js"> </script>
    </head>
    <body>
        
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>

        <div class="container-geral">
        
                <div class="container login">   
        
                    <h3>Login teste KABUM</h3>
        
                    
            <br>
                    <form action="" method="POST" id="frmLogin">
                        <label for="nomeUsuario">Nome Usuário:</label>
                            
                        <input type="text" name="name" id="name" required/>
                        <br>
                        <br>

                        <label for="senha">Senha:</label>
                            
                        <input type="password" name="password" id="password" required/>
                        <br>
                        <br>
                            
                        <input  type="button" value="Entrar" name="send" id="enviar"/>
                    </form>
                </div>
        </div>
    </body>
</html>

<script type="text/javascript">
    $('#frmLogin').submit(function (){
        $.ajax({
            type: 'POST',
            //url: 'http://localhost/php_KABUM/ValidaLogin.php',
            url: 'http://localhost/php_KABUM/DAO/UserDB.php/Login',
            data:$('#frmLogin').serialize(),  
            success: function (data) {
                var result = JSON.parse(data);

                console.log(result.msg);

                if (result.success){
                    alert(result.msg);
                }                
            },
            error: function (data) {
                alert('ERRO');
            },
        });
    });

    $('#enviar').click(function () {
        $.ajax({            
            type: 'POST',            
            url: 'http://localhost/php_KABUM/DAO/UserDB.php',
            data:{
                name:    $("#name").val(),
                password: $("#password").val()
            },  
            success: function (data) {
                var result = JSON.parse(data);

                console.log(result.msg);

                if (result.success){
                    alert(result.msg);
                }
                else{
                    window.location.href = 'http://localhost/php_KABUM/Views/ClientView.php';
                }                
            },
            error: function (data) {
                alert('ERRO');
            },
        });
    });

</script>