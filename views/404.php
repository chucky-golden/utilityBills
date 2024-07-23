<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f3f3f3;
            color: #333;
        }
        .container {
            text-align: center;
        }
        h1 {
            font-size: 6rem;
            margin: 0;
        }
        p {
            font-size: 1.5rem;
            margin: 0;
        }
        .error-code {
            font-size: 8rem;
            font-weight: bold;
            color: #ff6f61;
        }
        a {
            text-decoration: none;
            color: #ff6f61;
            font-weight: bold;
            transition: color 0.3s;
        }
        a:hover {
            color: #333;
        }
        .btn-home {
            margin-top: 20px;
            display: inline-block;
            padding: 10px 20px;
            border: 2px solid #ff6f61;
            border-radius: 5px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-code">404</div>
        <h1>Page Not Found</h1><br>
        <p>Sorry, the page you are looking for does not exist.</p>
        <a href="/" class="btn-home">Go to Homepage</a>
    </div>
</body>
</html>
