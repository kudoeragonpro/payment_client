<?php 
    session_start();
    if (isset($_SESSION['user_id'])) {
        header("Location: Home.php");
        exit(); 
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Đăng nhập hoặc đăng ký</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/lettering.js/0.6.1/jquery.lettering.min.js"></script>
    <link rel="stylesheet" href="loading.css" />
    <style>
    body {
        font-family: 'Poppins', Helvetica, sans-serif !important;
    }

    .body {
        color: #fff;
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .form-container {
        background-color: #1a1a1a;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        width: 350px;
        text-align: center;
        position: relative;
    }

    .form-container h3 {
        margin-bottom: 10px;
    }

    .form-container input[type="text"],
    .form-container input[type="password"],
    .form-container input[type="email"],
    .form-container select {
        width: calc(100%);
        padding: 8px;
        margin: 8px 0;
        border: none;
        border-radius: 4px;
        box-sizing: border-box;
        font-family: 'Poppins', Helvetica, sans-serif !important;
    }

    .form-container select {
        overflow-y: scroll;
    }

    .form-container input[type="submit"] {
        width: 100%;
        margin-top: 10px;
        padding: 10px;
        background-color: #4caf50;
        border: none;
        border-radius: 4px;
        color: #fff;
        font-size: 16px;
        cursor: pointer;
        font-family: 'Poppins', Helvetica, sans-serif !important;
    }

    .form-container input[type="submit"]:hover {
        background-color: #45a049;
    }

    .tabs {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-family: 'Poppins', Helvetica, sans-serif !important;
    }

    .tabs div {
        cursor: pointer;
        padding: 10px 20px;
        border-radius: 4px;
        background-color: #333;
        color: #fff;
        flex: 1;
        text-align: center;
    }

    .tabs .active {
        background-color: #4caf50;
    }

    .form-section {
        display: none;
    }

    .form-section.active {
        display: block;
    }

    .hidden {
        display: none !important;
    }

    .hien {
        display: block;
    }

    /* bắt đầu CSS của thông báo */
    body {
        background-color: #2c2c2c !important;
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
        top: 2%;
        right: 2%;
    }

    body {
        position: relative;
        overflow: hidden;
        padding: 10px !important;
    }

    /* Responsive CSS */
    @media (max-width: 768px) {
        .form-container {
            width: 90%;
            /* Reduce width for smaller screens */
            padding: 15px;
            /* Adjust padding */
        }

        body {
            height: 80vh;
            padding: 10px !important;
        }

        .tabs div {
            padding: 8px 16px;
            /* Adjust padding for tabs */
        }

        .form-container input[type="text"],
        .form-container input[type="password"],
        .form-container input[type="email"],
        .form-container select,
        .form-container input[type="submit"] {
            padding: 6px;
            /* Adjust padding for inputs and button */
        }

        .square_box.box_three,
        .square_box.box_four {
            display: none;
            /* Hide background squares on smaller screens */
        }
    }

    @media (max-width: 576px) {
        .form-container {
            width: 100%;
            /* Full width on very small screens */
        }

        body {
            height: 80vh;
            padding: 10px !important;
        }

        .tabs {
            flex-direction: column;
            /* Stack tabs vertically */
        }

        .tabs div {
            margin-bottom: 5px;
            /* Add margin between stacked tabs */
        }
    }

    /**
 * ----------------------------------------
 * animation blink-1
 * ----------------------------------------
 */
    @-webkit-keyframes blink-1 {

        0%,
        50%,
        100% {
            opacity: 1;
        }

        25%,
        75% {
            opacity: 0;
        }
    }

    @keyframes blink-1 {

        0%,
        50%,
        100% {
            opacity: 1;
        }

        25%,
        75% {
            opacity: 0;
        }
    }


    /* xog CSS thông báo */
    </style>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome-animation/0.2.1/font-awesome-animation.min.css">
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
    <div class="body div-father">
        <div class="form-container">
            <div class="tabs 1">
                <div class="tab active" onclick="showSection('login')">Đăng nhập</div>
                <div class="tab" onclick="showSection('register')">Đăng ký</div>
            </div>
            <div id="login" class="form-section active 1">
                <h3>Đăng nhập</h3>
                <form id="loginForm">
                    <input type="text" name="username" placeholder="Tên đăng nhập" required />
                    <input type="password" name="password" placeholder="Mật khẩu" required />
                    <input type="submit" value="Đăng nhập" />
                </form>
            </div>
            <div id="register" class="form-section 1">
                <h3>Đăng ký tài khoản</h3>
                <form id="registerForm">
                    <input type="text" name="username" placeholder="Tên đăng nhập" required />
                    <input type="text" name="sdt" placeholder="Số điện thoại" required />
                    <input type="password" name="password-regis" placeholder="Nhập mật khẩu" required />
                    <input type="password" name="re-password" placeholder="Nhập lại mật khẩu" required />
                    <input type="text" name="referral code" placeholder="Nhập mã giới thiệu (Nếu có)" />
                    <input type="submit" value="Đăng ký" />
                </form>
            </div>
            <div id="accBank" class="form-section hien hidden">
                <h3>Thêm tài khoản ngân hàng</h3>
                <form id="bankForm" action="process/regisBank.php" method="POST">
                    <select name="bankName" id="bankName" required>
                        <option value="" disabled selected>Chọn ngân hàng</option>
                        <option value="VCB Ngân hàng TMCP Ngoại Thương Việt Nam">Ngân hàng TMCP Ngoại Thương Việt Nam -
                            Vietcombank</option>
                        <option value="CTG Ngân hàng TMCP Công Thương Việt Nam">Ngân hàng TMCP Công Thương Việt Nam -
                            VietinBank</option>
                        <option value="BIDV Ngân hàng TMCP Đầu Tư và Phát Triển Việt Nam">Ngân hàng TMCP Đầu Tư và Phát
                            Triển Việt Nam - BIDV</option>
                        <option value="AGR Ngân hàng Nông nghiệp và Phát triển Nông thôn Việt Nam">Ngân hàng Nông nghiệp
                            và Phát triển Nông thôn Việt Nam - Agribank</option>
                        <option value="TCB Ngân hàng TMCP Kỹ Thương Việt Nam">Ngân hàng TMCP Kỹ Thương Việt Nam -
                            Techcombank</option>
                        <option value="ACB Ngân hàng TMCP Á Châu">Ngân hàng TMCP Á Châu - ACB</option>
                        <option value="VPB Ngân hàng TMCP Việt Nam Thịnh Vượng">Ngân hàng TMCP Việt Nam Thịnh Vượng -
                            VPBank</option>
                        <option value="MB Ngân hàng TMCP Quân Đội">Ngân hàng TMCP Quân Đội - MBBank</option>
                        <option value="HDB Ngân hàng TMCP Phát triển Nhà Thành phố Hồ Chí Minh">Ngân hàng TMCP Phát
                            triển Nhà Thành phố Hồ Chí Minh - HDBank</option>
                        <option value="VIB Ngân hàng TMCP Quốc Tế Việt Nam">Ngân hàng TMCP Quốc Tế Việt Nam - VIB
                        </option>

                        <!-- Thêm các ngân hàng khác tại đây -->
                    </select>
                    <input type="text" name="accNumber" placeholder="Số tài khoản" required />
                    <input type="text" name="accName" placeholder="Tên chủ tài khoản" required />
                    <input type="text" name="branchName" placeholder="Chi nhánh(Nếu có)" />
                    <input type="submit" value="Hoàn tất đăng ký" />
                </form>
            </div>
        </div>

    </div>
    <div class="word hidden">LOADING...</div>
    <div class="overlay hidden"></div>
    <script src="loading.js"></script>
    <script>
    function showSection(section) {
        document.querySelectorAll(".form-section").forEach((div) => div.classList.remove("active"));
        document.querySelectorAll(".tab").forEach((tab) => tab.classList.remove("active"));
        document.getElementById(section).classList.add("active");
        document.querySelector(".tab[onclick=\"showSection('" + section + "')\"]").classList.add("active");
    }

    function validatePhoneNumber(phoneNumber) {
        const pattern = /^(0[3|5|7|8|9][0-9]{8}|(\+84[3|5|7|8|9][0-9]{8}))$/;

        return pattern.test(phoneNumber);
    }

    $(document).ready(function() {
        $('#registerForm').on('submit', function(event) {
            event.preventDefault();
            let phoneNumber = document.querySelector('input[name="sdt"]').value;
            if (!validatePhoneNumber(phoneNumber)) {
                let div1 = document.querySelector('.word');
                div1.classList.add('hidden');
                let div2 = document.querySelector('.overlay');
                div2.classList.add('hidden');
                let div = document.querySelector(
                    '.alert.hidden.alert-simple.alert-danger.alert-dismissible.text-left.font__family-montserrat.font__size-16.font__weight-light.brk-library-rendered.rendered.show'
                );
                div.classList.remove('hidden');
                let firstStrongTag = document.querySelector('strong');
                firstStrongTag.innerHTML =
                    "Số điện thoại không hợp lệ! vui lòng kiểm tra lại."
                setTimeout(() => {
                    div.classList.add('hidden');
                }, 3000);
                return false;
            }
            let div1 = document.querySelector('.word');
            div1.classList.remove('hidden');
            let div2 = document.querySelector('.overlay');
            div2.classList.remove('hidden');
            var password = document.querySelector('input[name="password-regis"]').value;
            var rePassword = document.querySelector('input[name="re-password"]').value;
            let div = document.querySelector(
                '.alert.hidden.alert-simple.alert-danger.alert-dismissible.text-left.font__family-montserrat.font__size-16.font__weight-light.brk-library-rendered.rendered.show'
            );
            if (password !== rePassword) {
                let div1 = document.querySelector('.word');
                div1.classList.add('hidden');
                let div2 = document.querySelector('.overlay');
                div2.classList.add('hidden');
                div.classList.remove('hidden');
                let firstStrongTag = document.querySelector('strong');
                firstStrongTag.innerHTML =
                    "Mật khẩu nhập không khớp vui lòng kiểm tra lại!"
                setTimeout(() => {
                    div.classList.add('hidden');
                }, 3000);
                return false;
            }
            var formData = $(this).serialize();
            $.ajax({
                url: 'process/register.php',
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response === '1') {
                        let div1 = document.querySelector('.word');
                        div1.classList.add('hidden');
                        let div2 = document.querySelector('.overlay');
                        div2.classList.add('hidden');
                        let elements = document.getElementsByClassName('1');
                        for (let i = 0; i < elements.length; i++) {
                            elements[i].classList.add('hidden');
                        }
                        const ele = document.getElementById('accBank');
                        ele.classList.remove('hidden');
                    } else {
                        let div1 = document.querySelector('.word');
                        div1.classList.add('hidden');
                        let div2 = document.querySelector('.overlay');
                        div2.classList.add('hidden');
                        let div = document.querySelector(
                            '.alert.hidden.alert-simple.alert-danger.alert-dismissible.text-left.font__family-montserrat.font__size-16.font__weight-light.brk-library-rendered.rendered.show'
                        );
                        div.classList.remove('hidden');
                        let firstStrongTag = document.querySelector('strong');
                        firstStrongTag.innerHTML =
                            "Tên tài khoản đã tồn tại vui lòng nhập cái khác!"
                        setTimeout(() => {
                            div.classList.add('hidden');
                        }, 3000);
                        return false;
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX error:', textStatus, errorThrown);
                }
            });
        });
    });
    $(document).ready(function() {
        $('#loginForm').on('submit', function(event) {
            event.preventDefault();
            let div1 = document.querySelector('.word');
            div1.classList.remove('hidden');
            let div2 = document.querySelector('.overlay');
            div2.classList.remove('hidden');
            var formData = $(this).serialize();
            $.ajax({
                url: 'process/login.php',
                method: 'POST',
                data: formData,
                success: function(response) {
                    if (response === '3') {
                        let elements = document.getElementsByClassName('1');
                        for (let i = 0; i < elements.length; i++) {
                            elements[i].classList.add('hidden');
                        }
                        let div1 = document.querySelector('.word');
                        div1.classList.add('hidden');
                        let div2 = document.querySelector('.overlay');
                        div2.classList.add('hidden');
                        const ele = document.getElementById('accBank');
                        ele.classList.remove('hidden');
                        let div = document.querySelector(
                            '.alert.hidden.alert-simple.alert-danger.alert-dismissible.text-left.font__family-montserrat.font__size-16.font__weight-light.brk-library-rendered.rendered.show'
                        );
                        div.classList.remove('hidden');
                        let firstStrongTag = document.querySelector('strong');
                        firstStrongTag.innerHTML =
                            "Chưa đăng ký tài khoản ngân hàng mời bạn đăng ký để đăng nhập."
                        setTimeout(() => {
                            div.classList.add('hidden');
                        }, 3000);
                        return;
                    }
                    if (response === '1') {
                        let div1 = document.querySelector('.word');
                        div1.classList.add('hidden');
                        let div2 = document.querySelector('.overlay');
                        div2.classList.add('hidden');
                        window.location.href =
                            'Home.php';
                    } else {
                        let div1 = document.querySelector('.word');
                        div1.classList.add('hidden');
                        let div2 = document.querySelector('.overlay');
                        div2.classList.add('hidden');
                        let div = document.querySelector(
                            '.alert.hidden.alert-simple.alert-danger.alert-dismissible.text-left.font__family-montserrat.font__size-16.font__weight-light.brk-library-rendered.rendered.show'
                        );
                        div.classList.remove('hidden');
                        let firstStrongTag = document.querySelector('strong');
                        firstStrongTag.innerHTML =
                            "Mật khẩu hoặc tài khoản không đúng vui lòng kiểm tra lại"
                        setTimeout(() => {
                            div.classList.add('hidden');
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