<html>
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, user-scalable=0"/>
        <link rel="stylesheet" type="text/css" href="style-edicao-a.css"/>

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&family=Montserrat:wght@300;400;800&family=Newsreader&display=swap" rel="stylesheet">
        
    </head>
    <body> 
        <aside> 
            <div class="menu">
                <div class="menu-box home" id="home"><a> 
                    <div class="home-img"> <img src="../Imagens/home-white-18dp.svg" height="60px"/> </div>
                </a></div>

                <div class="menu-box" id="logout"><a> 
                    <img src="../Imagens/logout-white-18dp.svg" height="40px"/> 
                </a></div>    
            </div>
        </aside>
        <main>
            <div class="principal">
                <div class="filler"></div>
                <div class="container">
                    <h1>Edição de artigo</h1>
                    <form>
                        <div class="form-box">
                            <div class="formulario">
                                <div class="form-item">
                                    <h2>Autores: <img class="info" src="../Imagens/info-white-18dp.svg" height="20px"> </h2>
                                    <input type="text" name="autores">
                                    <div class="info-box"> Este campo deve seguir a seguinte máscara: <br/> Nome 1, Nome 2, Nome 3...</div>
                                </div>
                                <div class="form-item">
                                    <h2> Título:</h2>
                                    <input type="text" name="titulo">
                                </div>
                                <div class="form-item">
                                    <h2> Palavras chave: </h2>
                                    <input type="text" name="keywords">
                                </div>
                                <div class="form-item">
                                    <h2> Arquivo: </h2>
                                    <input type="file" name="arquivo-artigo" accept="application/pdf">
                                </div>
                            </div>
                            <div class="formulario">
                                <div class="form-item">
                                    <h2> Orientador: </h2>
                                    <input type="text" name="orientador">
                                </div>
                                <div class="form-item">
                                    <h2> Curso: </h2>
                                    <input type="text" name="curso">
                                </div>
                                <div class="form-item">
                                    <h2> Avaliadores: <img class="info2" src="../Imagens/info-white-18dp.svg" height="20px"> </h2>
                                    <input type="text" name="email">
                                    <div class="info-box2"> Este campo deve seguir a seguinte máscara: <br/> Nome 1, Nome 2, Nome 3...</div>
                                </div>
                            </div>
                        </div>
                        <div class = "submit-box">
                                <input type="submit" id="confirma" value="Confirmar edição">
                                <input type="submit" id="cancela" value="Cancelar edição">
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <script type="text/javascript" src="../JavaScript/script-artigo.js"> </script>
    </body>
</html>