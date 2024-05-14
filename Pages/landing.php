
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Landing Page</title>
<style>
    body, html {
    margin: 0;
    padding: 0;
    height: 100%;
}

.landing-page {
    background-image: url('https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/40dc4d2b-3bda-4ed8-9fbf-690f3609c720/dgwq423-660a7366-978f-43c5-93ed-07bb2a537192.png/v1/fit/w_640,h_362,q_70,strp/carbs_lightning_mcqueen_meme_by_loudcasafanrico_dgwq423-375w-2x.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9MzYyIiwicGF0aCI6IlwvZlwvNDBkYzRkMmItM2JkYS00ZWQ4LTlmYmYtNjkwZjM2MDljNzIwXC9kZ3dxNDIzLTY2MGE3MzY2LTk3OGYtNDNjNS05M2VkLTA3YmIyYTUzNzE5Mi5wbmciLCJ3aWR0aCI6Ijw9NjQwIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmltYWdlLm9wZXJhdGlvbnMiXX0.mZWkLRzcrRDrDrtRyGsbUexpWHHCFjpYOiwR9zan7OY');
    background-size: cover;
    background-position: center;
    height: 100vh;
    position: relative;
}

.overlay {
    background-color: rgba(0, 0, 0, 0.5);
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.content {
    text-align: center;
    color: white;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #337ab7;
    color: white;
    text-decoration: none;
    border-radius: 4px;
    transition: background-color 0.3s;
}

.btn:hover {
    background-color: #286090;
}

</style>
</head>
<body>
<div class="landing-page">
    <div class="overlay"></div>
    <div class="content">
        <h1>Welcome to Our Website</h1>
        <p>Discover the world of cars with us!</p>
        <a href="http://localhost/Car-Dealership/pages/Login.php" class="btn">Login</a>
        <a href="http://localhost/Car-Dealership/pages/Registration/Email.php" class="btn">Sign Up</a>
    </div>
</div>
</body>
</html>
