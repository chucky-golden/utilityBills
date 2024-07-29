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
            <h1>CableTV Subscriptions </h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard">Home</a></li>
                    <li class="breadcrumb-item">CableTV</li>
                    <li class="breadcrumb-item active">DsTV</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-12 mt-5">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">CableTV (DSTV) </h5>

                            <div class="row g-3 mb-5">
                                <p id="msg" style="color: red;"></p>


                                <div class="col-12 place">
                                    <label for="inputNanme4" class="form-label">SmartCard / IUC Number</label>
                                    <input type="text" class="form-control" placeholder="IUC Number" id="bcode" required>
                                </div>

                                <div id="menu">

                                    <div class="col-12">
                                        <label for="inputPassword4" class="form-label">Customer's Name</label>
                                        <input type="text" class="form-control" id="name" readonly>
                                    </div>

                                    <input type="hidden" name="" id="plan" value="dstv">

                                    <div class="col-12">
                                        <label for="inputPassword4" class="form-label">Customer's Phone Number</label>
                                        <input type="text" class="form-control" id="phone" placeholder="enter phone number">
                                    </div>

                                    <div class="col-12">
                                        <label for="inputEmail4" class="form-label">Select cable plan</label>
                                        <select class="form-select" id="dynamic-select"></select>
                                    </div>

                                    <div class="col-12">
                                        <label for="inputPassword4" class="form-label">Amount</label>
                                        <input type="number" min="500" class="form-control" id="amount" value="500" readonly>
                                    </div>

                                </div>

                                <div class="text-center">
                                    <button type="submit" id="buy-btn" class="btn btn-primary col-12">Pay Bill</button>
                                    <button type="submit" id="verify" class="btn btn-primary col-12">Verify Cable Number</button>
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


<script src="/views/jquery-3.2.1.min.js"></script>
<script>
    let returnedData = []
    const menu = document.getElementById('menu');
    const verify = document.getElementById('verify');
    const msg = document.getElementById('msg');
    const apiKey = '<?=$apikey?>';
    const publicKey = '<?=$publickey?>';
    const secretkey = '<?=$secretkey?>';
    const username = '<?=$username?>';
    const userid = "<?=$_SESSION['user']['id']?>"
    const email = "<?=$_SESSION['user']['email']?>"
    const actbal = "<?=$_SESSION['user']['actbal']?>"
    const buy = document.getElementById('buy-btn');

    menu.style.display = 'none'
    buy.style.display = 'none'

    verify.addEventListener('click', () => {
        verify.disabled = true
            const bcode = document.getElementById('bcode');
            const bcodeValue = document.getElementById('bcode').value
            const name = document.getElementById('name');
            const phone = document.getElementById('phone');
            const msg = document.getElementById('msg');


            if(bcodeValue == ''){
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
                    serviceID: 'dstv',
                    billersCode: bcodeValue,
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
                    msg.innerHTML = 'smartcard number entered is correct'
                    msg.style.color = 'green'

                    verify.disabled = false

                    setTimeout(() => {
                        msg.innerHTML = ''
                    }, 3000);

                    bcode.setAttribute('readonly', 'true')
                    verify.style.display = 'none'
                    menu.style.display = 'block'
                    buy.style.display = 'block'
                    name.value = data.content.Customer_Name
                    phone.value = data.content.Customer_Number

                } else {
                    msg.innerHTML = 'error verifying smartcard number'
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
                msg.innerHTML = 'enter a smartcard number'
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
                const response = await fetch('https://sandbox.vtpass.com/api/service-variations?serviceID=dstv', {
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
                returnedData.push(data.content.varations)

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
            const amount = document.getElementById("amount")

            data.content.varations.forEach(item => {
                const option = document.createElement('option');
                option.value = item.variation_code;
                option.textContent = item.name;
                selectElement.appendChild(option);
            });
            amount.value = data.content.varations[0].variation_amount
        }

        // Attach the checkSelection function to the select element's onchange event
        selectElement.addEventListener('change', checkSelection);

        // Fetch the data when the page loads
        fetchData();


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
            const buy = document.getElementById("buy-btn")

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

        const buy = document.getElementById("buy-btn");
        if (buy) {
            buy.addEventListener("click", () => {
                
                const service = document.getElementById("dynamic-select").value;
                const billersCode = document.getElementById("bcode").value;
                const amount = parseFloat(document.getElementById("amount").value);
                const plan = document.getElementById("plan").value;
                const phone = document.getElementById("phone").value;

                buy.innerHTML = 'Processing...'
                buy.disabled = true

                let request_id = requestId()

                if(phone == '' || phone == undefined){
                    msg.innerHTML = 'please enter a valid phone number and amount'
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
                                    variation_code: service,
                                    serviceID: plan,
                                    amount: amount,
                                    phone: phone,
                                    billersCode: billersCode,
                                    subscription_type: 'renew',
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

    function checkSelection() {
        const msg = document.getElementById('msg');
        const selectedValue = document.getElementById('dynamic-select').value
        const amt = document.getElementById('amount');
        const foundObject = returnedData[0].find(obj => obj.variation_code === selectedValue);
        
        if(selectedValue == ''){
            msg.innerHTML = 'choose a plan'
            msg.style.color = 'red'

            setTimeout(() => {
                msg.innerHTML = ''
            }, 3000);
            return false
        }

        amt.value = foundObject.variation_amount
    }
</script>
<?php require_once('partials/footer.php'); ?>