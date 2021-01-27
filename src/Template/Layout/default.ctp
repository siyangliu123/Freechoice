<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->Html->css('footer'); ?>

    <?= $this->fetch('script') ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8"
            src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css"
          integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous"/>
    <link rel="icon" href="http://www.freechoicestores.com.au/img/icons/FCS.ico" type="shortcut icon" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <link rel='stylesheet' id='fontawesome-css' href='https://bbcdn.us/font-awesome/4.5.0/css/font-awesome.min.css?ver=4.5.0' type='text/css' media='all' />
    <link rel='stylesheet' id='bfa-font-awesome-css' href='//cdn.jsdelivr.net/fontawesome/4.7.0/css/font-awesome.min.css?ver=4.7.0' type='text/css' media='all' />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>
<body>
<?php
echo $this->Html->css('default');
if (isset($authUser)) {
    ?>
    <header>
        <div id="topNav" class="topNav grid-container">
            <span class="grid1">Welcome,
                <?php $company = $authUser['user_company'];
                echo $company; ?> <a href='<?php echo $this->Url->build([
                    "controller" => "Users",
                    "action" => "logout",
                ]); ?>'>Log out</a></span>
            <span class="grid2">
                <?php echo $this->Html->Link("View Previous Orders", ["controller" => "Orders", "action" => "index"]); ?>
            </span>
            <span class="grid3"><?php echo $this->Html->image('Freechoice.jpg', ['class' => 'logoImage', 'alt' => 'Freechoice']); ?></span>
            <span class="grid4">
                <?php echo $this->Html->Link("View Announcements", ["controller" => "Announcement", "action" => "view"]); ?>
            </span>
            <span class="grid5"> <input id="search" type="text" placeholder="Search.."
                                        onkeyup="searchFunction()"></span>
        </div>
    </header>
    <div id="container" class="content">
        <?php if ($authUser["user_id"] == 1) {
            echo $this->element('admin_menu');
        } ?>
        <?= $this->fetch('content') ?>

    </div>
    <a href="#" id="scrollTop"><?php echo $this->Html->image('Down.png', ['id' => "scrollTopImg"]); ?></a>
    <a href="#" id="scrollDown"><?php echo $this->Html->image('Down.png', ['id' => "scrollDownImg"]); ?></a>
    <?php
} else {
    echo "<div>" . $this->Html->image('Freechoice.jpg', ['class' => 'centerImage', 'alt' => 'Freechoice']) . "</div>";
    ?>
    <div id="container2" class="content">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
        <div class="container">
            <div class="footer-top">
                <div class="row">
                    <div class="col-md-4 col-lg-4 about-footer">
                        <h3>Freechoice Tobacconist Greensborough</h3>
                        <ul>
                            <li><a href="tel:(03) 9434 1441"><i class="fas fa-phone fa-flip-horizontal"></i>(03) 9434
                                    1441</a></li>
                            <li><a href="mailto: greensborough@freechoice.com.au"><i class="fas fa-envelope"></i>greensborough@freechoice.com.au</a>
                            </li>
                            <li><a href="http://maps.google.com/?q=Shop2A/35-39 Main St, Greensborough VIC 3088">
                                    <i class="fas fa-map-marker-alt"></i>
                                    Shop 2A/35-39 Main Street
                                    <br/>Greensborough,
                                    <br/>VIC 3088
                                </a>
                            </li>

                        </ul>
                    </div>
                    <div class="col-md-3 col-lg-3 about-footer">
                        <div class="footer-title">
                            <h4>Location</h4>
                        </div>
                        <div id="googleMap" style="width:100%;height:200px;"></div>
                        <script>
                            function myMap() {
                                var location = {lat: -37.703440, lng: 145.103840};
                                var mapProp = {
                                    center: new google.maps.LatLng(-37.703440,145.103840),
                                    zoom: 13,
                                };
                                var map = new google.maps.Map(document.getElementById("googleMap"), mapProp);
                                var marker = new google.maps.Marker({position: location, map: map, animation:google.maps.Animation.DROP});
                            }
                        </script>

                        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBP1J5h21XE7WhxJa1oRV02mJ7EOssuy90&callback=myMap"></script>
                    </div>
                    <div class="col-md-5 col-lg-5 open-hour">
                        <div class="footer-title">
                            <h4>Opening Hours</h4>
                        </div>
                        <table class="open-hour">
                            <tbody>
                            <tr>
                                <td><i class="far fa-clock"></i> Monday - Wednesday</td>
                                <td>9:00am - 5:00pm</td>
                            </tr>
                            <tr>
                                <td><i class="far fa-clock"></i> Thursday - Friday</td>
                                <td>9:00am - 5:30pm</td>
                            </tr>
                            <tr>
                                <td><i class="far fa-clock"></i> Saturday</td>
                                <td>10:00am - 4:00pm</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <hr>
        </div>
    </footer>
    <?php
}
?>
</body>


</html>
<script>
    $(document).ready(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 0) {
                $(".topNav").addClass('smallLogoImage');
                $(".b-nav").addClass('scrolled');
                $(".b-menu").addClass('scrolled');
                $(".logoImage").addClass('smallLogoImage');
            } else {
                $('.topNav').removeClass('smallLogoImage');
                $(".b-nav").removeClass('scrolled');
                $(".b-menu").removeClass('scrolled');
                $(".logoImage").removeClass('smallLogoImage');
            }
        });

    });
</script>
<script>

    function searchFunction() {
        var input, filter, table, tr, td, td1, i;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.getElementById("tableBody");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            td1 = tr[i].getElementsByTagName("td")[1];
            if (td || td1) {
                if (td.innerHTML.toUpperCase().includes(filter) || td1.innerHTML.toUpperCase().includes(filter)) {
                    tr[i].hidden = "";
                }
                else {
                    tr[i].hidden = "hidden";
                }
            }
        }
    }

    $("#search").on("click", function (){
        let searchDom = $(this);
        searchDom.val("");
    })

    $('#scrollDown').click(function () {
        $('html, body').animate({scrollTop: $(document).height()}, 'slow');
        return false;
    });

    $('#scrollTop').click(function () {
        $('html, body').animate({scrollTop: 0}, 'slow');
        return false;
    });

</script>
