<?php 
    // Access the variables
    $apikey = $_ENV['API_KEY'];
    $publickey = $_ENV['PUBLIC_KEY'];
    $secretkey = $_ENV['SECRET_KEY'];
    $username = $_ENV['NAME'];
    require_once('partials/header.php'); 
?>

<body>

    <?php require_once('partials/sidenav.php'); ?>

    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Utility Bills</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active">Electricity Bills</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        <div class="col-12 mt-5">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Electricity Payment</h5>

                    <!-- Vertical Form -->
                    <div class="row g-3">
                        <p id="msg" style="color: red;"></p>
                        <div class="col-12">
                            <label for="inputEmail4" class="form-label">Select Disco</label>
                            <!-- <input type="email" class="form-control" id="inputEmail4"> -->
                            <select class="form-select" id="dynamic-select"></select>
                        </div>

                        <div class="col-12">
                            <label for="inputPassword4" class="form-label">Select Meter Type</label>
                            <select id="meterType" class="form-select" aria-label="Default select example">
                                <option value="prepaid">Prepaid</option>
                                <option value="postpaid">Postpaid</option>
                            </select>
                        </div>
                        
                        <div class="col-12">
                            <label for="inputAddress" class="form-label">Meter Number</label>
                            <input type="text" class="form-control" id="meter" placeholder="Input Meter Number">
                        </div>

                        <div id="menu">

                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Customer's Name</label>
                                <input type="text" class="form-control" id="name" readonly>
                            </div>

                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Customer's Address</label>
                                <input type="text" class="form-control" id="address" readonly>
                            </div>

                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Customer's Phone Number</label>
                                <input type="text" class="form-control" id="phone" placeholder="enter phone number">
                            </div>

                            <div class="col-12">
                                <label for="inputPassword4" class="form-label">Amount</label>
                                <input type="number" min="500" class="form-control" id="amount" value="500">
                            </div>

                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary col-12" id="verify">Verify Meter Number</button>
                            <button type="submit" class="btn btn-primary col-12"  id="buy-utility">Pay Bill</button>
                        </div>
                    </div><!-- Vertical Form -->

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
    const menu = document.getElementById('menu');
    const verify = document.getElementById('verify');
    const apiKey = '<?=$apikey?>';
    const publicKey = '<?=$publickey?>';
    const secretkey = '<?=$secretkey?>';
    const username = '<?=$username?>';
    const userid = "<?=$_SESSION['user']['id']?>"
    const email = "<?=$_SESSION['user']['email']?>"
    const actbal = "<?=$_SESSION['user']['actbal']?>"
    const buy = document.getElementById('buy-utility');

    menu.style.display = 'none'
    buy.style.display = 'none'

    verify.addEventListener('click', () => {
        verify.disabled = true
        const meter = document.getElementById('meter');
        const meterValue = document.getElementById('meter').value

        const service = document.getElementById('dynamic-select')
        const serviceID = document.getElementById('dynamic-select').value

        const meterT = document.getElementById('meterType')
        const meterType = document.getElementById('meterType').value

        const name = document.getElementById('name');
        const address = document.getElementById('address');

        if (meterValue == '') {
            msg.innerHTML = 'enter a smartcard number'
            msg.style.color = 'red'
            verify.disabled = false

            setTimeout(() => {
                msg.innerHTML = ''
            }, 3000);
            return false
        }

        fetch('https://sandbox.vtpass.com/api/merchant-verify', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'api-key': apiKey,
                    'secret-key': secretkey
                },
                body: JSON.stringify({
                    serviceID: serviceID,
                    billersCode: meterValue,
                    type: meterType
                })
            })
            .then((response) => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then((data) => {
                if (data.content.Customer_Name !== "" && data.content.Customer_Name !== undefined) {

                    msg.innerHTML = 'meter number entered is correct'
                    msg.style.color = 'green'

                    verify.disabled = false

                    setTimeout(() => {
                        msg.innerHTML = ''
                    }, 3000);

                    meter.setAttribute('readonly', 'true')
                    service.setAttribute('readonly', 'true')
                    meterT.setAttribute('readonly', 'true')

                    verify.style.display = 'none'
                    menu.style.display = 'block'
                    buy.style.display = 'block'
                    name.value = data.content.Customer_Name
                    address.value = data.content.Address

                } else {
                    msg.innerHTML = 'check meter number or meter type'
                    msg.style.color = 'red'

                    verify.disabled = false

                    setTimeout(() => {
                        msg.innerHTML = ''
                    }, 3000);
                    return false
                }
            })
            .catch((error) => {
                console.error('There was an error!', error);
                msg.innerHTML = 'enter a meter number'
                msg.style.color = 'red'

                verify.disabled = false

                setTimeout(() => {
                    msg.innerHTML = ''
                }, 3000);
                return false
            })
    })


    document.addEventListener('DOMContentLoaded', () => {

        const selectElement = document.getElementById('dynamic-select');
        // Function to fetch data from the API
        async function fetchData() {
            try {
                const response = await fetch('https://sandbox.vtpass.com/api/services?identifier=electricity-bill', {
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
                msg.innerHTML = error
                msg.style.color = 'red'

                setTimeout(() => {
                    msg.innerHTML = ''
                }, 3000);
            }
        }

        // Function to populate the select element with options
        function populateSelect(data) {
            data.content.forEach(item => {
                const option = document.createElement('option')
                option.value = item.serviceID;
                option.textContent = item.serviceID;
                selectElement.appendChild(option);
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
            const buy = document.getElementById("buy-utility")

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

        const buy = document.getElementById("buy-utility");
        if (buy) {
            buy.addEventListener("click", () => {
                
                const service = document.getElementById("dynamic-select").value;
                const billersCode = document.getElementById("meter").value;
                const amount = parseFloat(document.getElementById("amount").value);
                const meterType = document.getElementById("meterType").value;
                const phone = document.getElementById("phone").value;

                buy.innerHTML = 'Processing...'
                buy.disabled = true

                let request_id = requestId()

                if(amount == null || amount == '' || amount == undefined || phone == '' || phone == undefined){
                    msg.innerHTML = 'please enter a valid phone number and amount'
                    msg.style.color = 'red'
                    buy.innerHTML = 'Pay Bill'
                    buy.disabled = false

                    setTimeout(() => {
                        msg.innerHTML = ''
                    }, 3000);

                    return false
                }

                if(amount < 500){
                    msg.innerHTML = 'enter value greater than 100'
                    msg.style.color = 'red'
                    buy.innerHTML = 'Pay Bill'
                    buy.disabled = false

                    setTimeout(() => {
                        msg.innerHTML = ''
                    }, 3000);

                    return false
                }

                if(amount > actbal){
                    msg.innerHTML = 'insufficient funds'
                    msg.style.color = 'red'
                    buy.innerHTML = 'Pay Bill'
                    buy.disabled = false

                    setTimeout(() => {
                        msg.innerHTML = ''
                    }, 3000); 

                    return false
                }

                let formdata = new FormData()
                formdata.append('userid', userid)
                formdata.append('package', service)
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
                                    variation_code: meterType,
                                    serviceID: service,
                                    amount: amount,
                                    phone: phone,
                                    billersCode: billersCode,
                                    request_id: request_id
                                })
                            })
                            .then(handleResponse)
                            .catch(handleError);
                        }else{
                            msg.innerHTML = 'error creating transaction'
                            msg.style.color = 'red'
                            buy.innerHTML = 'Pay Bill'
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