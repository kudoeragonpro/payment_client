<?php  
    session_start();
    if (!isset($_SESSION['user_id'])) {
        
        header("Location: ../Home.php");
        exit(); 
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Nạp tiền bằng VietQR</title>
    <style>
    body {
        position: relative;
        overflow: hidden;
        font-family: 'Poppins', Helvetica, sans-serif !important;
    }

    h2 {
        font-family: 'Poppins', Helvetica, sans-serif !important;
    }

    .body {
        font-family: 'Poppins', Helvetica, sans-serif !important;
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        width: 550px !important;
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-top: 10px;
        font-weight: bold;
    }

    input[type="text"],
    button {
        font-family: 'Poppins', Helvetica, sans-serif !important;
        margin-top: 5px;
        padding: 10px;
        width: calc(100%);
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-left: auto;
        margin-right: auto;
    }

    button {
        margin-top: 20px !important;
        background-color: #4caf50;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    button:hover {
        background-color: #45a049;
    }

    .radio-group {
        display: flex;
        justify-content: space-between;
        margin: 10px 0;
    }

    .radio-group label {
        flex: 1;
        margin-right: 10px;
        cursor: pointer;
    }

    .radio-group input[type="radio"] {
        margin-right: 5px;
    }

    .alert {
        position: absolute;
        top: 20px;
        right: 20px;
        padding: 10px;
        border-radius: 4px;
        display: none;
    }

    .alert.alert-danger {
        background-color: rgba(220, 17, 1, 0.16);
        border: 1px solid rgba(241, 6, 6, 0.81);
        color: #ff0303;
    }

    .son {
        position: absolute;
        z-index: 1000;
        top: 2%;
        right: 2%;
    }

    .hidden {
        display: none !important;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .container {
            width: 90% !important;
            padding: 10px;
        }

        .radio-group {
            flex-direction: column;
            align-items: flex-start;
        }
        
        body{
            padding: 10px !important;
        }

        .radio-group label {
            margin-right: 0;
            margin-bottom: 5px;
        }

        button {
            width: 100%;
        }
    }

    @media (max-width: 480px) {
        body{
            padding: 10px !important;
        }
        .alert {
            top: 10px;
            right: 10px;
            font-size: 12px;
            padding: 5px;
        }
    }
    </style>

    <link rel="stylesheet" href="../loading.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.2.1/font-awesome-animation.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/lettering.js/0.6.1/jquery.lettering.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>

<body style="background-color: #f0f0f0 !important;">
    <div class="son">
        <div class="alert alert-danger" role="alert">
            <i class="start-icon fa fa-info-circle faa-shake animated"></i>
            <strong class="font-weight-semibold">Lỗi rồi</strong>
        </div>
    </div>
    <div class="body">
        <div class="word hidden" style="display: flex;justify-content: center; z-index: 9999">LOADING...</div>
        <div class="overlay hidden" style="background-color: #000000"></div>
        <div class="container">
            <h2>Nạp tiền bằng QR</h2>
            <form id="moneyoForm">
                <label for="amount">Chọn mức nạp:</label>
                <div class="radio-group">
                    <label>
                        <input type="radio" name="amount" value="200000" onclick="updateInputValue(this)">
                        200k
                    </label>
                    <label>
                        <input type="radio" name="amount" value="500000" onclick="updateInputValue(this)">
                        500k
                    </label>
                    <label>
                        <input type="radio" name="amount" value="1000000" onclick="updateInputValue(this)">
                        1,000k
                    </label>
                    <label>
                        <input type="radio" name="amount" value="5000000" onclick="updateInputValue(this)">
                        5,000k
                    </label>
                    <label>
                        <input type="radio" name="amount" value="10000000" onclick="updateInputValue(this)">
                        10,000k
                    </label>
                </div>
                <label for="customAmount">Nhập số tiền khác:</label>
                <input type="text" id="customAmount" name="customAmount" placeholder="Nhập số tiền khác"
                    onkeyup="formatCurrency(this)" required>
                <input type="hidden" name="userAgent" id="userAgentInput">
                <button type="submit">Nạp tiền</button>
            </form>
        </div>
    </div>

    <script src="../loading.js"></script>
    <script>
    function formatCurrency(input) {
        var value = input.value.replace(/\D/g, '');
        value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        input.value = value;
    }

    function updateInputValue(radio) {
        document.getElementById('customAmount').value = radio.value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    }

    $(document).ready(function() {
        $('#moneyoForm').on('submit', function(event) {
            event.preventDefault();

            var userAgent = navigator.userAgent;
            let div1 = document.querySelector('.word');
            div1.classList.remove('hidden');
            let div2 = document.querySelector('.overlay');
            div2.classList.remove('hidden');

            document.getElementById('userAgentInput').value = userAgent;
            var amountInput = document.getElementById('customAmount');
            var amountValue = amountInput.value.replace(/\D/g, '');
            if (parseInt(amountValue) < 100000) {
                let div1 = document.querySelector('.word');
                div1.classList.add('hidden');
                let div2 = document.querySelector('.overlay');
                div2.classList.add('hidden');
                $('.alert').removeClass('hidden').text(
                    "Số tiền nạp phải lớn hơn hoặc bằng 100,000 VNĐ!").fadeIn();
                setTimeout(function() {
                    $('.alert').fadeOut();
                }, 3000);
                return false;
            }
            var formData = $(this).serialize();
            $.ajax({
                url: 'GenQR.php',
                method: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                    if (response === '1') {
                        let div1 = document.querySelector('.word');
                        div1.classList.add('hidden');
                        let div2 = document.querySelector('.overlay');
                        div2.classList.add('hidden');
                        window.location.href = 'QR_Nap.php';
                    } else {
                        let div1 = document.querySelector('.word');
                        div1.classList.add('hidden');
                        let div2 = document.querySelector('.overlay');
                        div2.classList.add('hidden');
                        console.log(response)
                        $('.alert').removeClass('hidden').text(
                            "Hiện tại không có tài khoản admin nào hoạt động. Xin hãy liên hệ với quản trị viên!"
                        ).fadeIn();
                        setTimeout(function() {
                            $('.alert').fadeOut();
                        }, 3000);
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                }
            });
        });
    });
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