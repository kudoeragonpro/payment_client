<?php 
        session_start();
        function generateRandomString($length) {
            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, strlen($characters) - 1)];
            }
            return $randomString;
        }
        
        $randomString = generateRandomString(8)
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Payment Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <style>
    body {
        background-color: #efefef;
    }

    .card-header {
        text-align: center;
        font-weight: 700;
        font-size: 1.25rem;
        background-color: aliceblue;
    }

    .warning {
        color: red;
        font-weight: bold;
    }

    .note {
        font-weight: bold;
    }

    .container {
        width: 90%;
        background-color: #ffffff;
        margin-top: 10px;
        padding: 40px;
        height: auto;
    }

    .qr-code {
        width: 11.5rem !important;
        height: 11.5rem !important;
    }

    .qr {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-notice {
        padding-left: 20px;
    }

    .note {
        font-family: monospace;
    }

    @media (max-width: 576px) {
        .container {
            padding: 10px;
        }

        .card-header {
            font-size: 0.875rem;
        }

        .qr-code {
            width: 8rem !important;
            height: 8rem !important;
        }

        .card-notice {
            padding-left: 5px;
        }

        .card-body {
            padding: 10px;
        }

        .row {
            flex-direction: column;
        }

        .col-md-6 {
            width: 100%;
            margin-bottom: 10px;
        }

        .card-notice p,
        .card-body p {
            font-size: 0.875rem;
        }

        .note {
            font-size: 0.875rem;
        }

        .note div {
            font-size: 0.875rem;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Nạp tiền qua quét mã QR</div>
                    <div class="qr">
                        <img src="https://api.vietqr.io/<?php echo $_SESSION['shortName']?>/<?php echo $_SESSION['bank_account_number']?>/<?php echo str_replace(",", "", $_SESSION['Amount']);?>/<?php echo $_SESSION['user_id'].$randomString ?>/vietqr_net_2.jpg"
                            alt="QR Code" class="qr-code">
                    </div>
                    <div class="card-notice">
                        <div class="text-center mb-3"></div>
                        <p class="warning" style="font-style: monospace">
                            *Chú ý: mỗi mã QR chỉ dùng cho 1 giao dịch nạp tiền, không sử
                            dụng lại
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Nạp tiền qua SỐ THẺ</div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <label for="bankName" class="col-sm-6 col-form-label">Ngân Hàng</label>
                            <div class="col-sm-6 d-flex justify-content-between align-items-center">
                                <p id="bankName" class="text-info fw-bolder" style="cursor: pointer; color: red !important; font-family: Poppins, Helvetica, sans-serif;
    font-weight: 600;">
                                    <?php echo $_SESSION['name']." - ".$_SESSION['shortName']?>
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="accountName" class="col-sm-6 col-form-label">Tên chủ tài khoản</label>
                            <div class="col-sm-6 d-flex justify-content-between align-items-center">
                                <p id="accountName" class="text-info fw-bolder" style="cursor: pointer; color: red !important; font-family: Poppins, Helvetica, sans-serif;
    font-weight: 600;">
                                    <?php echo $_SESSION['bank_account_name']?>
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="cardNumber" class="col-sm-6 col-form-label">Số thẻ</label>
                            <div class="col-sm-6 d-flex justify-content-between align-items-center">
                                <p id="cardNumber" class="text-info fw-bolder" style="cursor: pointer; color: red !important; font-family: Poppins, Helvetica, sans-serif;
    font-weight: 600;">
                                    <?php  echo $_SESSION['bank_account_number'] ?>
                                </p>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="transferContent" class="col-sm-6 col-form-label">Nội dung chuyển khoản</label>
                            <div class="col-sm-6 d-flex justify-content-between align-items-center">
                                <p id="transferContent" class="text-info fw-bolder" style="cursor: pointer; color: red !important; font-family: Poppins, Helvetica, sans-serif;
    font-weight: 600;">
                                    </span><?php echo $_SESSION['user_id'].$randomString ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card note mt-4">
            <div class="card-body bg-light-warning rounded border-warning border border-dashed p-3">
                <div class="d-flex">
                    <div class="me-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                            <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)" fill="black">
                            </rect>
                            <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)" fill="black">
                            </rect>
                        </svg>
                    </div>
                    <div>
                        <h4 class="text-gray-900 fw-bolder">Lưu ý!</h4>
                        <div class="note" style="color:red;">
                            - Chú ý: Tài khoản bank không cố định. Vui lòng kiểm tra lại tên
                            và số tài khoản đang hiển thị trước khi thực hiện giao dịch. Xin
                            cảm ơn.
                        </div>
                        <div>
                            - Quý khách ghi đúng thông tin nạp tiền thì tài khoản sẽ được
                            cộng tự động sau khi giao dịch thành công.<br />
                            - Quý khách thực hiện chuyển tiền qua dịch vụ quốc tế tới ngân
                            hàng Việt Nam vui lòng chờ từ 3-5 ngày (tùy vào dịch vụ / không
                            tính Thứ 7 và Chủ Nhật)
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
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