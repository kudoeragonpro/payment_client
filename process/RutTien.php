<?php  
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../index.php");
        exit(); 
    }
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Rút Tiền</title>
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


    .alert.alert-danger {
        background-color: rgba(220, 17, 1, 0.16);
        border: 1px solid rgba(241, 6, 6, 0.81);
        color: #ff0303;
    }

    .div-son {
        position: absolute;
        z-index: 1000;
        top: 2%;
        right: 2%;
    }

    .hidden {
        display: none !important;
    }

    @media (max-width: 768px) {
        .container {
            width: 90% !important;
            padding: 15px;
        }

        body{
            padding: 10px !important;
        }
        
        .radio-group {
            flex-direction: column;
            align-items: flex-start;
        }

        .radio-group label {
            width: 100%;
            margin-bottom: 10px;
        }

        .radio-group label:last-child {
            margin-right: 0;
        }
    }

    @media (max-width: 576px) {
        h2 {
            font-size: 1.5rem;
        }

        input[type="text"],
        button {
            font-size: 0.875rem;
            padding: 8px;
        }

        body{
            padding: 10px !important;
        }
        
        .radio-group label {
            font-size: 0.875rem;
        }

        .alert.alert-danger {
            font-size: 0.875rem;
        }
    }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.2.1/font-awesome-animation.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/lettering.js/0.6.1/jquery.lettering.min.js"></script>
    <link rel="stylesheet" href="../loading.css" />
</head>

<body>
    <div class="row div-son">

        <div class="col-sm-12">
            <div class="alert hidden alert-simple alert-danger alert-dismissible text-left font__family-montserrat font__size-16 font__weight-light brk-library-rendered rendered show"
                role="alert" data-brk-library="component__alert">
                <i class="start-icon  fa fa-info-circle faa-shake animated"></i>
                <strong class="font__weight-semibold">Lỗi rồi</strong>
            </div>

        </div>

    </div>
    <div class="body">
        <div class="word hidden" style="display: flex;justify-content: center;">LOADING...</div>
        <div class="overlay hidden"></div>
        <div class="container">
            <h2>Rút tiền về tài khoản</h2>
            <form id="moneyoForm">
                <label for="amount">Chọn số tiền bạn muốn rút:</label>
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
                <button type="submit">Rút tiền</button>
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
            let div1 = document.querySelector('.word');
            div1.classList.remove('hidden');
            let div2 = document.querySelector('.overlay');
            div2.classList.remove('hidden');
            var userAgent = navigator.userAgent;

            document.getElementById('userAgentInput').value = userAgent;
            var amountInput = document.getElementById('customAmount');
            var amountValue = amountInput.value.replace(/\D/g, '');
            if (parseInt(amountValue) < 200000) {
                let div1 = document.querySelector('.word');
                div1.classList.add('hidden');
                let div2 = document.querySelector('.overlay');
                div2.classList.add('hidden');
                $('.alert').removeClass('hidden').text(
                    "Số tiền rút phải lớn hơn hoặc bằng 200,000 VNĐ!").fadeIn();
                setTimeout(function() {
                    $('.alert').fadeOut();
                }, 3000);
                return false;
            }
            var formData = $(this).serialize();
            $.ajax({
                url: 'LogRutTien.php',
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response === '5') {
                        let div1 = document.querySelector('.word');
                        div1.classList.add('hidden');
                        let div2 = document.querySelector('.overlay');
                        div2.classList.add('hidden');
                        let div = document.querySelector('.alert');
                        div.classList.remove('hidden');
                        let firstStrongTag = document.querySelector('strong');
                        firstStrongTag.innerHTML =
                            "Giao dịch không thành công xin vui lòng thử lại."
                        setTimeout(() => {
                            div.classList.add('hidden');
                        }, 3000);
                    }
                    if (response === '1') {
                        let div1 = document.querySelector('.word');
                        div1.classList.add('hidden');
                        let div2 = document.querySelector('.overlay');
                        div2.classList.add('hidden');
                        window.location.href = 'RutSuccess.php';
                    } else {
                        if (response === '4') {
                            let div1 = document.querySelector('.word');
                            div1.classList.add('hidden');
                            let div2 = document.querySelector('.overlay');
                            div2.classList.add('hidden');
                            let div = document.querySelector('.alert');
                            div.classList.remove('hidden');
                            let firstStrongTag = document.querySelector('strong');
                            firstStrongTag.innerHTML =
                                "Bạn đang yêu cầu rút tiền quá nhah. Mỗi yêu phải cách nhau 30s."
                            setTimeout(() => {
                                div.classList.add('hidden');
                            }, 3000);
                        } else {
                            console.log(response);
                            let div1 = document.querySelector('.word');
                            div1.classList.add('hidden');
                            let div2 = document.querySelector('.overlay');
                            div2.classList.add('hidden');
                            let div = document.querySelector('.alert');
                            div.classList.remove('hidden');
                            let firstStrongTag = document.querySelector('strong');
                            firstStrongTag.innerHTML =
                                "Số tiền bạn muốn rút vượt quá số dư tài khoản vui lòng kiểm tra lại."
                            setTimeout(() => {
                                div.classList.add('hidden');
                            }, 3000);
                        }
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