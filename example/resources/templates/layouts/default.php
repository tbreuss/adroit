<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="index, follow">
    <meta name="google-site-verification" content="tAP5VtcpL3YMRki-uW5DJlXlu8kQSqCRKVHZTHBmhkQ"/>
    <title>Action Domain Responder (ADR) Example</title>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css"
          integrity="sha384-nn4HPE8lTHyVtfCBi5yW9d20FjT8BJwUXyWZT9InLYax14RDjBj46LmSztkmNP9w" crossorigin="anonymous">
    <!--[if lte IE 8]>
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-old-ie-min.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
    <!--<![endif]-->
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
    <div class="header">
        <div class="container">
            <div class="pure-menu pure-menu-horizontal">
                <a class="pure-menu-heading pure-menu-link" href="<?= $this->url(['/']) ?>">ADR-Example</a>
                <ul class="pure-menu-list">
                    <li class="pure-menu-item">
                        <a class="pure-menu-link" href="<?= $this->url(['/']) ?>">Home</a>
                    </li>
                    <li class="pure-menu-item">
                        <a class="pure-menu-link" href="<?= $this->url(['/blog']) ?>">Blog</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="pure-g">
            <div class="pure-u-1-1">
                <?= $content ?>
            </div>
        </div>
    </div>

    <h3 class="masthead-brand"></h3>
    <nav class="nav nav-masthead">

    </nav>

    <div class="footer">
        <div class="container">
            <?php /*
            <div class="pure-g">
                <div class="pure-u-1 pure-u-md-1-2 footer-about">
                    <h3>Über HTPWGEN</h3>
                    <p>Mit HTPWGEN kannst du dir die notwendigen Dateien für eine HTTP-Authentifizierung erstellen
                        lassen.
                        HTPWGEN ist aber in erster Linie eine Beispielapplikation für das Arbeiten mit den
                        Frameworks und
                        Werkzeugen Pure.css, Vue.js und Herbie CMS.</p>
                </div>
                <div class="pure-u-1 pure-u-md-1-4 footer-links">
                    <h3>Links</h3>
                    <ul>
                        <li>
                            <router-link to="/impressum">Impressum</router-link>
                        </li>
                        <li><a target="_blank" href="http://www.tebe.ch">Über den Autor</a></li>
                    </ul>
                </div>
                <div class="pure-u-1 pure-u-md-1-4">
                    <h3>Toolset</h3>
                    <ul>
                        <li><a target="_blank" href="http://purecss.io">Pure.css</a></li>
                        <li><a target="_blank" href="http://vuejs.org">Vue.js</a></li>
                        <li><a target="_blank" href="https://www.getherbie.org">Herbie CMS</a></li>
                    </ul>
                </div>
            </div>
            <hr>*/ ?>
            <div class="pure-g">
                <div class="pure-u-1 footer-copyright">
                    &copy; <?= date('Y') ?> by Thomas Breuss
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
