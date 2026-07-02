<?php
// Check if the current user is not an admin
if (!current_user_can('administrator')) {

?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<style>
    * {
        font-family: 'Trebuchet MS', sans-serif;
    }

    body,html{
        overflow-x: hidden !important;
        color:#252525;
    }
    
    a{
        color: #036;
        text-decoration: none;
    }

    .primary {
        max-width: 100vw;
        width: 100%;
        max-height: 100vh;
        height: 100%;
        display: flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
        padding: 1rem;
        box-sizing: border-box;
    }

    footer{
        margin-top:2rem;
    }

    .site-main {
        width: 100%;
        height: 100%;
        max-width: 70rem;
        max-height: 36rem;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        gap: 2rem;
    }

    @media (max-width: 996px) {
        .site-main {
            flex-direction: column-reverse;
            max-width: 100%;
            max-height: 100%;
            gap:0.5rem;
        }
        .primary {
            max-width: 100%;
            max-height: 100%;
        }
        .site-main-text,
        .site-main-image {
            width: 100% !important;
        }
        h1 {
            font-size: 2rem !important;
        }
        h2 {
            font-size: 1.8rem !important;
        }
    }

    .site-main-text {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        text-align: center;
        width: 50%;
    }

    .site-main-image {
        width: 50%;
    }

    img {
        width: 100%;
        height: auto;
    }

    h1 {
        font-size: 3rem;
    }

    h2 {
        font-size: 2.8rem;
    }

    p {
        font-size: 1rem;
    }
</style>

    <div class="primary">
        <main class="site-main">
            <div class="site-main-text">
            <header class="entry-header">
                <h1 class="entry-title">Oleme varsti tagasi!</h1>

                <h2 class="entry-title"><span>Leheküljel</span> <span>toimuvad hooldustööd</span></h2>
            </header>

            <div class="entry-content">
                <p>Teostame hetkel hooldustöid. Palun külastage meid mõne aja pärast.</p>
            </div>
            </div>
            <div class="site-main-image">
			<img src="<?php echo get_template_directory_uri(); ?>/assets/img/defaultimages/maintenance.png" alt="Maintenance" width="800" height="800">
            </div>
        </main>
        <footer>
            <a href="https://keweb.ee/" target="_blank">Keweb.ee</a>
        </footer>
    </div>

<?php
    exit(); // Stop further execution of the template
}
