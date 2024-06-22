<?php 
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        exit();
    }
    include 'ReloadAmount.php';
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
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles.css">
    <style>
    .body {
        display: flex;
        align-items: center;
        justify-content: center;
        height: 80vh;
    }

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

    .tick-icon {
        padding-top: 12px;
        font-size: 80px;
        color: #fff;
        text-shadow: 0 0 7px #fff, 0 0 10px #fff, 0 0 21px #fff, 0 0 42px rgba(0, 255, 0, 0.8), 0 0 1px rgba(0, 255, 0, 0.8), 0 0 1px rgba(0, 255, 0, 0.8), 0 0 5px rgba(0, 255, 0, 0.8), 0 0 7px rgba(0, 255, 0, 0.8);
    }


    .label {
        color: #fff;
        text-shadow:
            0 0 7px #fff,
            0 0 10px #fff,
            0 0 21px #fff,
            0 0 42px rgba(0, 255, 0, 0.8),
            0 0 82px rgba(0, 255, 0, 0.8),
            0 0 92px rgba(0, 255, 0, 0.8),
            0 0 102px rgba(0, 255, 0, 0.8),
            0 0 151px rgba(0, 255, 0, 0.8);
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

    .hidden {
        display: none;
    }

    .block {
        display: block;
    }
    
    .hold {
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
    }
    .circle {
        display: flex;
        width: 100px;
        height: 100px;
        border: 2px solid white;
        border-radius: 50%;
        align-items: center;
        text-align: center;
        justify-content: center;
    }

    .circle .tick {
        font-size: 40px;
        animation: fadeIn 3s ease;
        color: #fff;
        text-shadow: 0 0 7px #fff, 0 0 10px #fff, 0 0 21px #fff, 0 0 42px rgba(0, 255, 0, 0.8), 0 0 1px rgba(0, 255, 0, 0.8), 0 0 1px rgba(0, 255, 0, 0.8), 0 0 5px rgba(0, 255, 0, 0.8), 0 0 7px rgba(0, 255, 0, 0.8);

    }
    </style>
</head>

<body>
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
    <!-- Nội dung chính -->
    <div class="body">
        <div class="block">
            <div class="hold">
                <div class="circle">
                    <div id="tickIcon" class="tick-icon"><i class="bx bx-check"></i></div>
                </div>
            </div>
            <p style="text-shadow: 0 0 7px #fff, 0 0 10px #fff, 0 0 21px #fff, 0 0 42px rgba(0, 255, 0, 0.8), 0 0 1px rgba(0, 255, 0, 0.8), 0 0 1px rgba(0, 255, 0, 0.8), 0 0 5px rgba(0, 255, 0, 0.8), 0 0 7px rgba(0, 255, 0, 0.8);" class="label">Bạn đã yêu cầu rút tiền thành công.</p>
        </div>
    </div>
    <!-- Bootstrap JS và các thư viện -->
    <script>
    document.getElementById('account-balance').textContent = document.getElementById('account-balance').textContent
        .replace(
            /\B(?=(\d{3})+(?!\d))/g, ',');
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