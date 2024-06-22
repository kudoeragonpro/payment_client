<?php 
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        exit(); 
    }
    include 'process/ReloadAmount.php';
    ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Trang Chủ</title>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.2.1/font-awesome-animation.min.css'
        rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
    .large-icon-container {
        text-align: center;
        position: relative;
    }

    .large-icon {
        display: inline-block;
        margin-bottom: 20px;
    }

    .large-icon i {
        font-size: 7rem;
        color: rgb(56 51 51 / 58%);
    }

    .label {
        display: block;
        font-size: 1.5rem;
        font-weight: bold;
        margin-top: 10px;
    }

    /* Hiệu ứng sáng */
    .label {
        color: #fff;
        text-shadow: 0 0 7px #fff, 0 0 10px #fff, 0 0 21px #fff, 0 0 42px rgba(0, 255, 0, 0.8), 0 0 1px rgba(0, 255, 0, 0.8), 0 0 1px rgba(0, 255, 0, 0.8), 0 0 5px rgba(0, 255, 0, 0.8), 0 0 7px rgba(0, 255, 0, 0.8);

    }

    @keyframes blink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    /* bắt đầu CSS của thông báo */
    body {
        background-color: #2c2c2c;
    }

    .alert>.start-icon {
        margin-right: 0;
        min-width: 20px;
        text-align: center;
    }

    .alert>.start-icon {
        margin-right: 5px;
    }

    .greencross {
        font-size: 18px;
        color: #25ff0b;
        text-shadow: none;
    }

    .alert-simple.alert-success {
        border: 1px solid rgba(36, 241, 6, 0.46);
        background-color: rgba(7, 149, 66, 0.12156862745098039);
        box-shadow: 0px 0px 2px #259c08;
        color: #0ad406;
        text-shadow: 2px 1px #00040a;
        transition: 0.5s;
        cursor: pointer;
    }

    .alert-success:hover {
        background-color: rgba(7, 149, 66, 0.35);
        transition: 0.5s;
    }

    .alert-simple.alert-info {
        border: 1px solid rgba(6, 44, 241, 0.46);
        background-color: rgba(7, 73, 149, 0.12156862745098039);
        box-shadow: 0px 0px 2px #0396ff;
        color: #0396ff;
        text-shadow: 2px 1px #00040a;
        transition: 0.5s;
        cursor: pointer;
    }

    .alert-info:hover {
        background-color: rgba(7, 73, 149, 0.35);
        transition: 0.5s;
    }

    .blue-cross {
        font-size: 18px;
        color: #0bd2ff;
        text-shadow: none;
    }

    .alert-simple.alert-warning {
        border: 1px solid rgba(241, 142, 6, 0.81);
        background-color: rgba(220, 128, 1, 0.16);
        box-shadow: 0px 0px 2px #ffb103;
        color: #ffb103;
        text-shadow: 2px 1px #00040a;
        transition: 0.5s;
        cursor: pointer;
    }

    .alert-warning:hover {
        background-color: rgba(220, 128, 1, 0.33);
        transition: 0.5s;
    }

    .warning {
        font-size: 18px;
        color: #ffb40b;
        text-shadow: none;
    }

    .alert-simple.alert-danger {
        border: 1px solid rgba(241, 6, 6, 0.81);
        background-color: rgba(220, 17, 1, 0.16);
        box-shadow: 0px 0px 2px #ff0303;
        color: #ff0303;
        text-shadow: 2px 1px #00040a;
        transition: 0.5s;
        cursor: pointer;
    }

    .alert-danger:hover {
        background-color: rgba(220, 17, 1, 0.33);
        transition: 0.5s;
    }

    .danger {
        font-size: 18px;
        color: #ff0303;
        text-shadow: none;
    }

    .alert-simple.alert-primary {
        border: 1px solid rgba(6, 241, 226, 0.81);
        background-color: rgba(1, 204, 220, 0.16);
        box-shadow: 0px 0px 2px #03fff5;
        color: #03d0ff;
        text-shadow: 2px 1px #00040a;
        transition: 0.5s;
        cursor: pointer;
    }

    .alert-primary:hover {
        background-color: rgba(1, 204, 220, 0.33);
        transition: 0.5s;
    }

    .alertprimary {
        font-size: 18px;
        color: #03d0ff;
        text-shadow: none;
    }

    .square_box {
        position: absolute;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
        border-top-left-radius: 45px;
        opacity: 0.302;
    }

    .square_box.box_three {
        background-image: -moz-linear-gradient(-90deg, #290a59 0%, #3d57f4 100%);
        background-image: -webkit-linear-gradient(-90deg, #290a59 0%, #3d57f4 100%);
        background-image: -ms-linear-gradient(-90deg, #290a59 0%, #3d57f4 100%);
        opacity: 0.059;
        left: -80px;
        top: -60px;
        width: 500px;
        height: 500px;
        border-radius: 45px;
    }

    .square_box.box_four {
        background-image: -moz-linear-gradient(-90deg, #290a59 0%, #3d57f4 100%);
        background-image: -webkit-linear-gradient(-90deg, #290a59 0%, #3d57f4 100%);
        background-image: -ms-linear-gradient(-90deg, #290a59 0%, #3d57f4 100%);
        opacity: 0.059;
        left: 150px;
        top: -25px;
        width: 550px;
        height: 550px;
        border-radius: 45px;
    }

    .alert:before {
        content: '';
        position: absolute;
        width: 0;
        height: calc(100% - 44px);
        border-left: 1px solid;
        border-right: 2px solid;
        border-bottom-right-radius: 3px;
        border-top-right-radius: 3px;
        left: 0;
        top: 50%;
        transform: translate(0, -50%);
        height: 20px;
    }

    .fa-times {
        -webkit-animation: blink-1 2s infinite both;
        animation: blink-1 2s infinite both;
    }

    .div-son {
        position: absolute;
        z-index: 1000;
        top: 17%;
        right: 2%;
    }

    body {
        position: relative;
        overflow: hidden;
    }

    .hidden {
        display: none;
    }

    @media (max-width: 768px) {
        .large-icon-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .large-icon{
            width: 350px;
        }

        .large-icon i {
            font-size: 4rem;
        }
        .col-lg-6{
            padding: 0px !important;
        }
        .label {
            font-size: 1.2rem;
        }

        .div-son {
            top: 10%;
        }

        body {
            position: relative;
            overflow: auto;
        }
    }

    @media (max-width: 576px) {
        .large-icon i {
            font-size: 3rem;
        }

        .large-icon{
            width: 350px;
        }
        
        .label {
            font-size: 1rem;
        }

        .div-son {
            top: 5%;
        }
    }
    </style>
</head>

<body>
    <!-- Navbar -->
    <div class="row div-son">

        <div class="col-sm-12">
            <div class="alert hidden alert-simple alert-danger alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show"
                role="alert" data-brk-library="component__alert">
                <i class="start-icon  fa fa-info-circle faa-shake animated"></i>
                <strong class="font__weight-semibold">Lỗi rồi</strong>
            </div>

        </div>

    </div>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-wallet"></i> <span
                                id="account-balance"><?php echo  intval($user['balance']) ?>đ</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="fas fa-bell"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link icon-user" href="#">
                            <img src="https://viotp.com/images/avatar-default.png" alt="">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 large-icon-container">
                <a href="process/NapTien.php">
                    <div class="large-icon">
                        <i class='bx bxs-bank'></i>
                    </div>
                    <div class="label">Nạp tiền</div>
                </a>
            </div>
            <div class="col-lg-6 large-icon-container">
                <a href="process/RutTien.php" onclick="sendData(event)">
                    <div class="large-icon">
                        <i class="fas fa-money-check-alt"></i>
                    </div>
                    <div class="label">Rút tiền</div>
                </a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    document.getElementById('account-balance').textContent = document.getElementById('account-balance').textContent
        .replace(
            /\B(?=(\d{3})+(?!\d))/g, ',');
    </script>
    <script type="text/javascript">
    function sendData(event) {
        event.preventDefault();
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "process/checkAmount.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = xhr.responseText;
                console.log(response);
                if (response == '1') {
                    window.location.href = 'process/RutTien.php';
                } else {
                    let div1 = document.querySelector(
                        '.alert.hidden.alert-simple.alert-danger.alert-dismissible.text-left.font__family-montserrat.font__size-16.font__weight-light.brk-library-rendered.rendered.show'
                    );
                    div1.classList.remove('hidden');
                    let firstStrongTag = document.querySelector('strong');
                    firstStrongTag.innerHTML =
                        "Số dư tài khoản phải có ít nhất 500,000VNĐ thì mới có thể rút"
                    setTimeout(() => {
                        div1.classList.add('hidden');
                    }, 3000);
                }
            }
        };
        xhr.send();
    }
    document.addEventListener('keydown', function(event) {
            if ((event.ctrlKey === true || event.metaKey === true) && (event.key === '+' || event.key === '-' || event.key === '0')) {
                event.preventDefault();
            }
        });

    document.addEventListener('wheel', function(event) {
        if (event.ctrlKey === true || event.metaKey === true) {
            event.preventDefault();
        }
    });
    </script>
</body>

</html>