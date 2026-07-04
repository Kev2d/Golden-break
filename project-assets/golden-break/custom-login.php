<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<style>
@font-face{font-family:Poppins;font-style:normal;font-weight:100;src:url("../../../assets/fonts/Poppins/Poppins-100.ttf") format("truetype");font-display:swap}@font-face{font-family:Poppins;font-style:normal;font-weight:200;src:url("../../../assets/fonts/Poppins/Poppins-200.ttf") format("truetype");font-display:swap}@font-face{font-family:Poppins;font-style:normal;font-weight:300;src:url("../../../assets/fonts/Poppins/Poppins-300.ttf") format("truetype");font-display:swap}@font-face{font-family:Poppins;font-style:normal;font-weight:400;src:url("../../../assets/fonts/Poppins/Poppins-400.ttf") format("truetype");font-display:swap}@font-face{font-family:Poppins;font-style:normal;font-weight:500;src:url("../../../assets/fonts/Poppins/Poppins-500.ttf") format("truetype");font-display:swap}@font-face{font-family:Poppins;font-style:normal;font-weight:600;src:url("../../../assets/fonts/Poppins/Poppins-600.ttf") format("truetype");font-display:swap}@font-face{font-family:Poppins;font-style:normal;font-weight:700;src:url("../../../assets/fonts/Poppins/Poppins-700.ttf") format("truetype");font-display:swap}@font-face{font-family:Poppins;font-style:normal;font-weight:800;src:url("../../../assets/fonts/Poppins/Poppins-800.ttf") format("truetype");font-display:swap}@font-face{font-family:Poppins;font-style:normal;font-weight:900;src:url("../../../assets/fonts/Poppins/Poppins-900.ttf") format("truetype");font-display:swap}.custom-login{display:flex;height:100vh}.custom-login *{box-sizing:border-box;font-family:Poppins,Arial,sans-serif}.custom-login img{width:100%;height:auto;max-width:16rem}.custom-login a,.custom-login p{font-size:18px}.custom-login p{margin-block-start:1rem;margin-block-end:1rem;line-height:160%}.custom-login__login{display:flex;justify-content:space-between;flex-direction:column;width:60%;padding:24px 48px}.custom-login__login .logo{max-width:250px;height:auto;margin-bottom:48px}.custom-login__login h1{font-weight:600;color:#036;font-size:48px;line-height:110%}.custom-login__login p{color:#252525}.custom-login__login .forgot-password{display:flex;justify-content:center}.custom-login__login .forgot-password a{font-size:14px;color:#252525}.custom-login__login #custom_loginform{display:grid;grid-template-columns:repeat(auto-fill,minmax(50%,1fr));max-width:475px;width:100%}.custom-login__login #custom_loginform .login-password,.custom-login__login #custom_loginform .login-username{display:flex;flex-direction:column;gap:8px;grid-column:span 2}.custom-login__login #custom_loginform .login-remember label{display:flex;justify-content:flex-start;align-items:center;cursor:pointer;gap:8px;font-size:14px}.custom-login__login #custom_loginform .login-remember label input[type=checkbox]{cursor:pointer;transform:scale(1.5);accent-color:#036}.custom-login__login #custom_loginform .login-remember label input[type=checkbox]:hover{accent-color:#0276fd}.custom-login__login #custom_loginform .login-submit{display:flex;justify-content:flex-end}.custom-login__login #custom_loginform input{height:56px}.custom-login__login #custom_loginform input[type=password],.custom-login__login #custom_loginform input[type=text]{padding:12px;border-width:0 0 2px;font-size:18px;border-color:#252525;background:rgba(0,0,0,0)}.custom-login__login #custom_loginform input[type=password]:active,.custom-login__login #custom_loginform input[type=password]:focus,.custom-login__login #custom_loginform input[type=password]:valid,.custom-login__login #custom_loginform input[type=text]:active,.custom-login__login #custom_loginform input[type=text]:focus,.custom-login__login #custom_loginform input[type=text]:valid{outline:0!important;background:rgba(0,0,0,0)!important;border-color:#036!important}.custom-login__login #custom_loginform input[type=password]::placeholder,.custom-login__login #custom_loginform input[type=text]::placeholder{font-size:18px}.custom-login__login #custom_loginform input[type=password]:-webkit-autofill,.custom-login__login #custom_loginform input[type=password]:-webkit-autofill:active,.custom-login__login #custom_loginform input[type=password]:-webkit-autofill:focus,.custom-login__login #custom_loginform input[type=password]:-webkit-autofill:hover,.custom-login__login #custom_loginform input[type=text]:-webkit-autofill,.custom-login__login #custom_loginform input[type=text]:-webkit-autofill:active,.custom-login__login #custom_loginform input[type=text]:-webkit-autofill:focus,.custom-login__login #custom_loginform input[type=text]:-webkit-autofill:hover{-webkit-background-clip:text;-webkit-text-fill-color:#252525;box-shadow:inset 0 0 20px 20px transparent}.custom-login__login #custom_loginform input[type=submit]{background:#036;color:#fff;border-radius:100px;cursor:pointer;padding:12px 54px;outline:0;border:0;font-size:14px;transition:All .2s ease-in-out;font-weight:600}.custom-login__login #custom_loginform input[type=submit]:hover{background:#0276fd}.custom-login__contact{background:#036;width:40%;color:#fff;display:grid;grid-template-rows:1fr auto 1fr;align-items:center;justify-items:center;padding:24px 48px}.custom-login__contact .contact{display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;grid-row:2}.custom-login__contact .contact a,.custom-login__contact .contact h1,.custom-login__contact .contact p{color:#fff}.custom-login__contact .feedback{display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;grid-row:3;margin-top:auto}.custom-login__contact .feedback p{color:#fff}@media(max-width:900px){.custom-login a,.custom-login p{font-size:16px}.custom-login{min-height:100vh;height:auto;flex-direction:column}.custom-login__login{width:100%;height:100%;padding:24px 12px}.custom-login__login .logo{max-width:180px}.custom-login__login h1{font-size:40px}.custom-login__login #custom_loginform{grid-template-columns:1fr}.custom-login__login #custom_loginform p{order:0}.custom-login__login #custom_loginform .login-password,.custom-login__login #custom_loginform .login-username{grid-column:unset}.custom-login__login #custom_loginform .login-remember{order:1}.custom-login__login #custom_loginform input[type=password],.custom-login__login #custom_loginform input[type=text]{font-size:18px}.custom-login__login #custom_loginform input[type=password]::placeholder,.custom-login__login #custom_loginform input[type=text]::placeholder{font-size:18px}.custom-login__login #custom_loginform input[type=submit]{width:100%}.custom-login__contact{width:100%;height:48px;padding:12px;grid-template-rows:1fr}.custom-login__contact .contact{grid-row:unset}.custom-login__contact .contact :not(a),.custom-login__contact .feedback{display:none}}.custom-login__contact .feedback-btn{background:#fff;color:#036;padding:12px 54px;border-radius:100px;display:inline-block;text-decoration:none;font-weight:600;font-size:14px;transition:All .2s ease-in-out}.custom-login__contact .feedback-btn:hover{background:#0276fd;color:#fff}.reset-success-message{padding:15px;background-color:#e6ffed;border:1px solid #b3e6cc;border-radius:5px;color:#34a853;margin-bottom:20px}
</style>
<div class="custom-login">
    <div class="custom-login__login">
        <div>
            <div class="logo">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/img/defaultimages/keweblogo.svg" alt="Keweb logo" width="800" height="800">
            </div>
            <h1>Logi sisse oma kontosse</h1>
            <p>Kui logite sisse, leiate end oma veebisaidi halduskeskusest. Siit saate hõlpsasti kontrollida ja kohandada oma veebisaidi sisu ja aspekte.</p>

            <?php
            if (isset($_GET['checkemail']) && $_GET['checkemail'] == 'confirm') {
                echo '<p class="reset-success-message">Kontrollige oma e-posti kontot, et saada kätte parooli lähtestamise link.</p>'; // This translates to "Check your email account to retrieve the password reset link."
            }
            ?>

            <?php if (isset($login_error) && $login_error) : ?>
                <div style="background-color: #f7e6e6; padding: 10px 20px; margin-bottom: 20px; border-radius: 5px;">
                    <p style="margin: 0;"><?php echo $login_error; ?></p>
                </div>
            <?php endif; ?>

            <?php
            if (!is_user_logged_in()) {
                $args = array(
                    'redirect' => admin_url(), // redirect to admin dashboard.
                    'form_id' => 'custom_loginform',
                    'label_username' => __('Kasutajanimi/E-mail', 'golden-break'),
                    'label_password' => __('Parool', 'golden-break'),
                    'label_remember' => __('Salvesta konto', 'golden-break'),
                    'label_log_in' => __('Logi sisse', 'golden-break'),
                    'remember' => true,
                    'echo' => false, // don't echo the form, return it instead
                );
                $form = wp_login_form($args);

                // add placeholders
                $form = str_replace('name="log"', 'name="log" placeholder="Sisesta kasutajanimi"', $form);
                $form = str_replace('name="pwd"', 'name="pwd" placeholder="Sisesta parool"', $form);

                // Add the "Forgot Password" link
                echo $form; // echo the modified form

                $forgot_password_link = '<a href="' . wp_lostpassword_url() . '">Unustasid salasõna?</a>';
            }
            ?>
        </div>
        <div class="forgot-password">
            <?php
            echo $forgot_password_link;
            ?>
        </div>
    </div>
    <div class="custom-login__contact">
        <div class="contact">
            <h1>Tere!</h1>
            <p>Kui teil on küsimusi, muresid või vajate täiendavat abi, siis võtke julgelt ühendust</p>
            <a href="mailto:info@keweb.ee">info@keweb.ee</a>
            <p>Keweb tänab meeldiva koostöö eest!</p>
        </div>

        <div class="feedback">
            <p>Kas olete koostööga rahul? Palun jagage meiega oma tagasisidet.</p>
            <a href="https://g.page/r/CZGQOVoMUDA4EB0/review" target="_blank" class="feedback-btn">Jäta tagasiside</a>
        </div>
    </div>
</div>