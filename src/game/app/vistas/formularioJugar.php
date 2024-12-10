<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charmander</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Archivo+Black&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Nunito:ital,wght@0,200..1000;1,200..1000&family=Press+Start+2P&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Nunito', sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .container {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        max-width: 800px;
        width: 100%;
    }
    .container form {
        display: flex;
        flex-direction: column;
    }
    .container form div {
        margin-bottom: 15px;
    }
    .container form label {
        font-weight: bold;
        margin-bottom: 5px;
        display: block;
    }
    .container form input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .card-container {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }
    .card {
        border: 1px solid #ccc;
        border-radius: 10px;
        padding: 20px;
        text-align: center;
        font-family: 'Press Start 2P', cursive;
        background-color: #fafafa;
    }
    .card img {
        width: 100px;
        height: 100px;
        margin-bottom: 10px;
    }
    .card input {
        margin-top: 10px;
    }
    button {
        background-color: #007bff;
        color: #fff;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }
    button:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
    <div class="container">
        <form id="formularioJugar">
            <div>
                <label for="username">Nombre de Usuario:</label>
                <input type="text" id="username" name="username">
            </div>
            <div class="card">
                <img src="charmander.jpg" alt="Charmander">
                <div>Charmander</div>
                <input type="radio" name="character" value="Charmander" required>
            </div>
            <div class="card">
                <img src="bulbasaur.jpg" alt="Bulbasaur">
                <div>Bulbasaur</div>
                <input type="radio" name="character" value="Bulbasaur" required>
            </div>
            <div class="card">
                <img src="squirtle.jpg" alt="Squirtle">
                <div>Squirtle</div>
                <input type="radio" name="character" value="Squirtle" required>
            </div>
            <button type="submit">Jugar</button>
        </form>
    </div>
    <?php echo '<script src="' . VIEW_JS_PATH . 'formularioJugar.js"></script>' ?>
</body>