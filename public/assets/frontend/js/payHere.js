// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated')
        }, false)
    })
})()
$(document).ready(function () {
    $('#paymentFrom').submit(function (e) {
        let stuReg = $('#stuReg');
        let stuAmount = $('#stuAmount');

        let merchantSecret = '6baebdcb9ad832598d626c5ad47c76ad';
        let merchantId = '214854';
        let hashedSecret = CryptoJS.MD5(merchantSecret).toString().toUpperCase();
        let amountFormated = parseFloat(stuReg.val()).toLocaleString('en-us', {minimumFractionDigits: 2}).replaceAll(',', '');
        let currency = 'USD';
        let hash = CryptoJS.MD5(merchantId + stuAmount.val() + amountFormated + currency + hashedSecret).toString().toUpperCase();

        $('#merchant_id').val(merchantId)
        $('#hash').val(hash)
    })
})