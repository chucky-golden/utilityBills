<?php
    // Access the variables
    $apikey = $_ENV['MONIFYKEY'];
    $contract = $_ENV['MONIFYCONTRACT'];
    require_once('partials/header.php');
?>

<body>

    <?php require_once('partials/sidenav.php'); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Deposit </h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Deposit</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-12 mt-5">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Deposit </h5>

                            <div class="row g-3 mb-5">
                                <p id="msg" style="color: red;"></p>
                                <div class="col-12 place">
                                    <label for="inputNanme4" class="form-label">Enter Amount To Deposit</label>
                                    <input type="number" class="form-control" value="50" min="50" id="amount">
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary col-12" id="pay">Deposit Amount</button>
                                </div>
                                <div class="text-center">
                                    <p>Service charge of <s>N</s>50 will be deducted for each deposit transactions</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main><!-- End #main -->


    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright. All Rights Reserved
        </div>
        <div class="credits text-center p-3">
            Designed by <a href="https://www.linkedin.com/in/chukwudi-uwakwe-24523a184/">cheese</a>
        </div>


<script type="text/javascript" src="https://sdk.monnify.com/plugin/monnify.js"></script>
<script src="/views/jquery-3.2.1.min.js"></script>
<script>
    const requestId = () => {
        const now = new Date();

        // Adjusting to GMT+1
        const gmtOffset = now.getTimezoneOffset() + 60;
        const adjustedNow = new Date(now.getTime() + gmtOffset * 60000);

        const year = adjustedNow.getFullYear();
        const month = String(adjustedNow.getMonth() + 1).padStart(2, '0');
        const day = String(adjustedNow.getDate()).padStart(2, '0');
        const hour = String(adjustedNow.getHours()).padStart(2, '0');
        const minute = String(adjustedNow.getMinutes()).padStart(2, '0');
        const second = String(adjustedNow.getSeconds()).padStart(2, '0');

        const todayDate = `${year}${month}${day}`;
        const timeString = `${hour}${minute}${second}`;
        const timestamp = new Date().getTime().toString();

        return todayDate + timeString + timestamp.slice(13);
    }


    // click of check out button to save data into database and call payment system
    let btn = document.getElementById('pay')
    btn.addEventListener('click', () => {
        let msgcheck = document.getElementById('msg')
        btn.disabled = true
        btn.innerHTML = 'Processing...'

        let amount = parseFloat(document.getElementById('amount').value)
        const userid = "<?= $_SESSION['user']['id'] ?>"
        const fname = "<?= $_SESSION['user']['fname'] ?>"
        const lname = "<?= $_SESSION['user']['lname'] ?>"
        const email = "<?= $_SESSION['user']['email'] ?>"
        const actbal = "<?= $_SESSION['user']['actbal'] ?>"

        if (amount == '' || amount == undefined) {
            msgcheck.innerHTML = 'error processing request'
            msgcheck.style.color = 'red'
            btn.disabled = false
            btn.innerHTML = 'Deposit Amount'

            setTimeout(() => {
                msgcheck.innerHTML = ''
            }, 3000);
            
            return false
        }

        if(amount < 50){
            msg.innerHTML = 'enter amount above 50'
            msg.style.color = 'red'
            btn.innerHTML = 'Deposit Amount'
            btn.disabled = false

            setTimeout(() => {
                msg.innerHTML = ''
            }, 3000); 

            return false
        }

        let fullname = fname + ' ' + lname

        let ref = requestId()

        var formdata = new FormData();

        formdata.append('userid', userid)
        formdata.append('package', 'deposit transaction')
        formdata.append('ref', ref)
        formdata.append('amount', amount)
        formdata.append('email', email)
        formdata.append('actbal', actbal)

        $.ajax({
            url: "/history",
            method: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            success: function(data){
                if (data == 'true') {
                    return payWithMonnify(email, amount + 50, fullname, ref)
                } else {
                    msgcheck.innerHTML = 'error processing request'
                    msgcheck.style.color = 'red'
                    btn.innerHTML = 'Deposit Amount'
                    btn.disabled = false

                    setTimeout(() => {
                        msgcheck.innerHTML = ''
                    }, 3000);

                    return false
                }
            }
        });
    })

    function payWithMonnify(email, amt, fname, ref) {
        let msgcheck = document.getElementById('msg')
        const apiKey = '<?=$apikey?>';
        const contract = '<?=$contract?>';
        
        MonnifySDK.initialize({
            amount: amt,
            currency: "NGN",
            reference: ref,
            customerFullName: fname,
            customerEmail: email,
            apiKey: apiKey,
            contractCode: contract,
            paymentDescription: "DEposit Transaction",
            metadata: {
                "name": fname
            },
            onComplete: function(response) {
                //Implement what happens when the transaction is completed.
                window.location.href = '/history?success=Transaction Completed&ref=' + ref + '&amount=' + amt
                return false
            },
            onClose: function(data) {
                window.location.href = '/history?error=error completing Transaction&ref=' + ref + '&amount=' + amt
                return false
            }
        });
    }
</script>
<?php require_once('partials/footer.php'); ?>