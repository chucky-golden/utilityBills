document.addEventListener("DOMContentLoaded", function () {
    
    const username = 'chuckycheese';
    const apiKey = 'f9aa17291bdb645c66af682d1e7377b6';
    const secretKey = 'SK_346684bf199556d0c9daa32c2b286f325471bd63d1b';

    const handleResponse = (response) => {
        if (response.response_description === "TRANSACTION SUCCESSFUL") {
            console.log(response);
            msg.innerHTML = 'operation successful'
            msg.style.color = 'green'

            setTimeout(() => {
                msg.innerHTML = ''
            }, 3000);

            return false
        } else {
            console.log(response);
            msg.innerHTML = 'error completing operation'
            msg.style.color = 'red'

            setTimeout(() => {
                msg.innerHTML = ''
            }, 3000);

            return false
        }
    };

    const handleError = (error) => {
        alert("Error: " + error.message);
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
            const amount = document.getElementById("airtime-amount").value
            const phone = document.getElementById("airtime-phone").value

            let request_id = requestId()

            fetchWithHandling('https://sandbox.vtpass.com/api/pay', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'api-key': apiKey,
                    'secret-key': secretKey
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
        });
    }


    const dataForm = document.getElementById("data-form");
    if (dataForm) {
        dataForm.addEventListener("submit", function (e) {
            e.preventDefault();
            const network = document.getElementById("dynamic-select").value;
            const plan = document.getElementById("plan").value;
            const phone = document.getElementById("data-phone").value;

            let request_id = requestId()

            fetchWithHandling('https://sandbox.vtpass.com/api/pay', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'api-key': apiKey,
                    'secret-key': secretKey
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
        });
    }


    const buy = document.getElementById("buy-btn");
    if (buy) {
        buy.addEventListener("click", () => {
            const service = document.getElementById("dynamic-select").value;
            const billersCode = document.getElementById("bcode").value;
            const amount = document.getElementById("amount").value;
            const plan = document.getElementById("plan").value;
            const phone = document.getElementById("phone").value;

            let request_id = requestId()

            if(service == ''){
                msg.innerHTML = 'please select a package'
                msg.style.color = 'red'

                setTimeout(() => {
                    msg.innerHTML = ''
                }, 3000);

                return false
            }

            if(plan == 'startimes' && phone == ''){
                msg.innerHTML = 'please enter a valid number'
                msg.style.color = 'red'

                setTimeout(() => {
                    msg.innerHTML = ''
                }, 3000);

                return false
            }

            fetchWithHandling('https://sandbox.vtpass.com/api/pay', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'api-key': apiKey,
                    'secret-key': secretKey
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
        });
    }


    const electricityForm = document.getElementById("buy-utility");
    if (electricityForm) {
        electricityForm.addEventListener("click", () => {
            const service = document.getElementById("dynamic-select").value;
            const billersCode = document.getElementById("meter").value;
            const amount = document.getElementById("amount").value;
            const meterType = document.getElementById("meterType").value;
            const phone = document.getElementById("phone").value;

            let request_id = requestId()

            if(amount == '' || amount == undefined || phone == '' || phone == undefined){
                msg.innerHTML = 'please enter a valid phone number and amount'
                msg.style.color = 'red'

                setTimeout(() => {
                    msg.innerHTML = ''
                }, 3000);

                return false
            }

            if(amount < 500){
                msg.innerHTML = 'enter value greater than 100'
                msg.style.color = 'red'

                setTimeout(() => {
                    msg.innerHTML = ''
                }, 3000);

                return false
            }

            fetchWithHandling('https://sandbox.vtpass.com/api/pay', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'api-key': apiKey,
                    'secret-key': secretKey
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
        });
    }

    
});
