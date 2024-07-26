<?php 
    // Access the variables
    $apikey = $_ENV['API_KEY'];
    $publickey = $_ENV['PUBLIC_KEY'];
    $secretkey = $_ENV['SECRET_KEY'];
    $username = $_ENV['NAME'];
    
    require_once('partials/header.php'); ?>

<body>

    <?php require_once('partials/sidenav.php'); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Buy Airtime</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Buy Airtime</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="col-12 mt-5">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Airtime Topup</h5>

                    <!-- Vertical Form -->
                    <form class="row g-3" id="airtime-form">
                        <p id="msg" style="color: red;"></p>

                        <div class="col-12 place">
                            <label for="inputNanme4" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" maxlength="11" placeholder="11 digits only" id="airtime-phone" required>
                        </div>
                        <div class="col-12">
                            <label for="inputEmail4" class="form-label">Airtime Network</label>
                            <!-- <input type="email" class="form-control" id="inputEmail4"> -->
                            <select class="form-select" id="dynamic-select"></select>
                        </div>
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Amount</label>
                            <input type="number" min="50" class="form-control" id="airtime-amount" value="50" required>
                            <p>Minimum Topup: 50</p>
                        </div>
                        <div class="form-check form-switch col-12 d-flex ">
                            <label class="form-check-label ms-2 text-success" for="flexSwitchCheckDefault">Are your Input Details Correct?</label>
                            <input class="form-check-input ms-2" type="checkbox" id="flexSwitchCheckDefault">
                            <label class="form-check-label ms-2 text-danger" for="flexSwitchCheckDefault">Kindly Switch to Continue the Process...</label>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary col-12" id="airtime-buy">Buy Now</button>
                        </div>
                    </form><!-- Vertical Form -->

                </div>
            </div>
        </div>

    </main><!-- End #main -->


    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright. All Rights Reserved
        </div>
        <div class="credits text-center p-3">
            Designed by <a href="https://www.linkedin.com/in/chukwudi-uwakwe-24523a184/">cheese</a>
        </div>



<script src="/views/jquery-3.2.1.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const msg = document.getElementById('msg');
        const apiKey = '<?=$apikey?>';
        const publicKey = '<?=$publickey?>';
        const secretkey = '<?=$secretkey?>';
        const username = '<?=$username?>';
        const userid = "<?=$_SESSION['user']['id']?>"
        const email = "<?=$_SESSION['user']['email']?>"
        const actbal = "<?=$_SESSION['user']['actbal']?>"

        const selectElement = document.getElementById('dynamic-select');
        // Function to fetch data from the API
        async function fetchData() {
            try {
                const response = await fetch('https://sandbox.vtpass.com/api/services?identifier=airtime', {
                    method: 'GET',
                    headers: {
                        'api-key': apiKey,
                        'public-key': publicKey
                    }
                })
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                const data = await response.json();
                populateSelect(data);
            } catch (error) {
                console.error('There was an error!', error);
                msg.innerHTML = 'enter a smartcard number'
                msg.style.color = 'red'

                verify.disabled = false

                setTimeout(() => {
                    msg.innerHTML = ''
                }, 3000);
                return false
            }
        }

        // Function to populate the select element with options
        function populateSelect(data) {
            data.content.forEach(item => {
                const option = document.createElement('option');
                if(item.serviceID != 'foreign-airtime'){
                    option.value = item.serviceID;
                    option.textContent = item.serviceID;
                    selectElement.appendChild(option);
                }
            });
        }


        const handleResponse = (response) => {
            if (response.response_description === "TRANSACTION SUCCESSFUL") {
                window.location.href = '/history?success=Transaction Completed&ref=' + response.requestId + '&amount=' + response.amount

                return false
            } else {
                window.location.href = '/history?error=error completing Transaction&ref=' + response.requestId
                return false
            }
        };

        const handleError = (error) => {
            const buy = document.getElementById("airtime-buy")

            msg.innerHTML = error.message
            msg.style.color = 'red'
            buy.innerHTML = 'Buy Now'
            buy.disabled = false

            setTimeout(() => {
                msg.innerHTML = ''
            }, 3000); 

            return false
        };

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

        const fetchWithHandling = (url, options) => {
            return fetch(url, options)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                });
        };

        const airtimeForm = document.getElementById("airtime-form");
        if (airtimeForm) {
            airtimeForm.addEventListener("submit", function (e) {
                e.preventDefault();
                
                const network = document.getElementById("dynamic-select").value
                const amount = parseFloat(document.getElementById("airtime-amount").value)
                const phone = document.getElementById("airtime-phone").value
                const buy = document.getElementById("airtime-buy")

                buy.innerHTML = 'Processing...'
                buy.disabled = true

                let request_id = requestId()

                if(amount > actbal){
                    msg.innerHTML = 'insufficient funds'
                    msg.style.color = 'red'
                    buy.innerHTML = 'Buy Now'
                    buy.disabled = false

                    setTimeout(() => {
                        msg.innerHTML = ''
                    }, 3000); 

                    return false
                }

                let formdata = new FormData()
                formdata.append('userid', userid)
                formdata.append('package', network + ' airtime')
                formdata.append('ref', request_id)
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
						if(data == 'true'){
                            fetchWithHandling('https://sandbox.vtpass.com/api/pay', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'api-key': apiKey,
                                    'secret-key': secretkey
                                },
                                body: JSON.stringify({
                                    serviceID: network,
                                    amount: amount,
                                    phone: phone,
                                    request_id: request_id
                                })
                            })
                            .then(handleResponse)
                            .catch(handleError);
                        }else{
                            msg.innerHTML = 'error creating transaction'
                            msg.style.color = 'red'
                            buy.innerHTML = 'Buy Now'
                            buy.disabled = false

                            setTimeout(() => {
                                msg.innerHTML = ''
                            }, 3000); 

                            return false
                        }
					}
			 	});

            });
        }

        // Fetch the data when the page loads
        fetchData();
    });

</script>
<?php require_once('partials/footer.php'); ?>