

<script src="{{ url('public/assets/login/vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<script src="{{ url('public/assets/login/vendor/animsition/js/animsition.min.js')}}"></script>
<script src="{{ url('public/assets/login/vendor/bootstrap/js/popper.js')}}"></script>
<script src="{{ url('public/assets/login/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{ url('public/assets/login/vendor/select2/select2.min.js')}}"></script>
<script src="{{ url('public/assets/login/vendor/daterangepicker/moment.min.js')}}"></script>
<script src="{{ url('public/assets/login/vendor/daterangepicker/daterangepicker.js')}}"></script>
<script src="{{ url('public/assets/login/vendor/countdowntime/countdowntime.js')}}"></script>
<script src="{{ url('public/assets/login/js/main.js')}}"></script>

<script>
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");

    togglePassword.addEventListener("click", function() {
        // toggle the type attribute
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        // toggle the icon
        this.classList.toggle("rui-show-password-btn--hidden");
    });
</script>
