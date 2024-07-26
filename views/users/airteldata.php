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
            <h1>Data Airtel</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/dashbaord">Home</a></li>
                    <li class="breadcrumb-item">Buy Data</li>
                    <li class="breadcrumb-item active">Data Airtel</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-12 mt-5">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Airtel</h5>

                            <form class="row g-3 mb-5" id="data-form">

                                <p id="msg" style="color: red;"></p>

                                <div class="col-12 place">
                                    <label for="data-phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" maxlength="11" placeholder="11 digits only" id="data-phone">
                                </div>

                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">Select Plan</label>
                                    <select class="form-select" id="dynamic-select"></select>
                                </div>
                                <input type="hidden" name="" id="plan" value="airtel-data"><br>

                                <div class="col-12 place">
                                    <label for="inputNanme4" class="form-label">Amount</label>
                                    <input type="" class="form-control" id="amount" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" id="buy" class="btn btn-primary col-12">Buy Now</button>
                                </div>
                            </form>
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
                const response = await fetch('https://sandbox.vtpass.com/api/service-variations?serviceID=airtel-data', {
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
                const variationCodeWithoutEnding = item.variation_code.replace(/-\d+$/, '');
                option.value = item.variation_code;
                option.textContent = `${variationCodeWithoutEnding} ${item.name}`;
                selectElement.appendChild(option);
            });
            amount.value = data.content.varations[0].variation_amount
        }

        // Attach the checkSelection function to the select element's onchange event
        selectElement.addEventListener('change', checkSelection);


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
            const buy = document.getElementById("buy")

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

        const dataForm = document.getElementById("data-form");
        if (dataForm) {
            dataForm.addEventListener("submit", function (e) {
                e.preventDefault();
                
                const network = document.getElementById("dynamic-select").value;
                const amount = parseFloat(document.getElementById("amount").value);
                const plan = document.getElementById("plan").value;
                const phone = document.getElementById("data-phone").value;
                const buy = document.getElementById("buy")

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
                formdata.append('package', network + ' data')
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
                                    serviceID: plan,
                                    variation_code: network,
                                    billersCode: phone,
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