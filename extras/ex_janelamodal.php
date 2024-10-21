<?php 


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar registro</title>

    <style>
        *{
            margin:0;
            padding:0;
            box-sizing: border-box;
   
        }
        .btn{
            padding: 25px 60px;
            display: inline;
            background-color: red;
            border-radius: 20px;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            transition: background-color 0.5s;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 1;
        }
        .btn:hover{
            background-color: #ff4c2c;
        }

        .janela-modal{
            width: 100vw;
            height: 100vh;
            position: relative;
            top:0;
            left:0;
            background-color:#00000080;
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 999;
        }

        .modal{
            width: 60%;
            min-width: 450px;
            min-height: 200px;
            background-color: #cccccc80;
            backdrop-filter: blur(10px);
            padding: 50px;
            border-radius: 15px;

        }
        .fechar{
            position: absolute;
            top: 3px;
            right: 3px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 0;
            background-color: red;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
        }
        .janela-modal.abrir{
            display: flex;
        }
        @keyframes abrirmodal{
            from{
                opacity:0;
                transform: translate3d(-20px, 40px, 0);
            }
            to{
                opacity: 1;
                transform: translate3d(0,50,0);
            }
        }

        .abrir .modal{
            animation: abrirmodal .2s;
        }
    </style>
</head>
<body>
    <div onclick="abrirModal()" class="btn"> Clique aqui. </div>

    <div class="janela-modal" id="janela-modal">
        <div class="modal">
            <button class="fechar" id="fechar">X</button>
            <h1>Janela Modal</h1>
            <p>Lorem ipsum dolor sit amet consector adpisicing alit. Lorem ipsum dolor sit amet consector adpisicing alit. Lorem ipsum dolor sit amet consector adpisicing alit. Lorem ipsum dolor sit amet consector adpisicing alit. Lorem ipsum dolor sit amet consector adpisicing alit. Lorem ipsum dolor sit amet consector adpisicing alit. Lorem ipsum dolor sit amet consector adpisicing alit.</p>

        </div>

    </div>
    <label>Numero da Ação</label>
    <input type="text" value="<?php echo isset($_GET['numeroAcao']) ? $_GET['numeroAcao']:''?>"></input>
    <script src="script.js"></script>
</body>
</html>