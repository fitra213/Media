<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Berhasil - Media Center</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('images/logo.png') center/cover no-repeat fixed;
        }
        .success-container {
            background: rgba(255, 255, 255, 0.9);
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            width: 90%;
        }
        .success-message {
            color: #2c3e50;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .back-button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            margin-top: 20px;
        }
        .back-button:hover {
            background-color: #2980b9;
        }
        .icon {
            font-size: 48px;
            color: #27ae60;
            margin-bottom: 20px;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="success-container">
        <div class="icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="success-message">
            TERIMA KASIH HARAP DITUNGGU KONFIRMASINYA
        </div>
        <a href="index.html" class="back-button">Kembali ke Beranda</a>
    </div>
</body>
</html> 