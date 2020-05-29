<?php 

include 'templates/header.php'; 

$myfunc = new functions();

if ( isset($_GET['setlang']) ) {
  $myfunc->set_lang($_GET['setlang']);
} elseif ( !isset($_SESSION["lang"]) ) {
  $myfunc->set_lang("id");
}

?>
    <!-- Jumbotron -->
    <div id="section2" class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">The <span>Best</span> Price to get round <br>in the City of <span>Bali</span></h1>
      </div>
    </div>
    <!-- Akhir Jumbotron -->

    <!-- Container -->
    <div class="container">
      <!-- info panel -->
      <div class="row justify-content-center">
        <div class="col-10 info-panel">
          <div class="row">
            <div class="col-lg">
              <a href="pesan.php"><img src="assets/img/taxi.png" alt="Taxi" class="float-left"></a>
              <h4>
                <?php if ($_SESSION["lang"] == 'id'): ?>
                  Taxi Bandara
                <?php else: ?>
                  Airport Taxi
                <?php endif ?>
              </h4>
              <p>Lorem ipsum dolor sit amet</p>
            </div>
            <div class="col-lg">
              <a href="pesanhotel.php"><img src="assets/img/hotel.png" alt="Hotel"class="float-left"></a>
              <h4>
                <?php if ($_SESSION["lang"] == 'id'): ?>
                  Penginapan
                <?php else: ?>
                  Hotel
                <?php endif ?>
              </h4>
              <p>Lorem ipsum dolor sit amet</p>
            </div>
            <div class="col-lg">
              <a href="pesantravel.php"><img src="assets/img/tour.png" alt="Tour"class="float-left"></a>
              <h4>
                <?php if ($_SESSION["lang"] == 'id'): ?>
                  Wisata dan Perjalanan
                <?php else: ?>
                  Tour and Travel
                <?php endif ?>
              </h4>
              <p>Lorem ipsum dolor sit amet</p>
            </div>
          </div>
          
        </div>
        
      </div>
      <!-- Akhir info Panel -->

      <!-- Judul Kenapa Harus Kami -->
      <div class="row">
        <div id="section1" class="judulharuskami">
          <div class="col-lg judul-kami">
            <h3>
              <?php if ($_SESSION["lang"] == 'id'): ?>
                KENAPA HARUS MEMILIH KAMI?
              <?php else: ?>
                WHY MUST CHOOSE US?
              <?php endif ?>
          </h3>
          </div>
        </div>
      </div>
      <!-- Akhir Judul Harus Kami-->
      <!-- info kami -->
      <div class="row justify-content-center">
        <div class="col-lg info-kami justify-content-center d-flex">
          <div class="row">
            <div class="col-lg">
              <img src="assets/img/payment4.png" alt="Taxi" class="img-fluid float-left">
              <h4>
                <?php if ($_SESSION["lang"] == 'id'): ?>
                  HARGA TERJANGKAU
                <?php else: ?>
                  AFFORDABLE PRICES
                <?php endif ?>
              </h4>
              <p>Lorem ipsum dolor sit amet</p>
            </div>
            <div class="col-lg">
              <img src="assets/img/shield2.png" alt="Hotel"class="img-fluid float-left">
              <h4>
                <?php if ($_SESSION["lang"] == 'id'): ?>
                  KEAMANAN TERJAMIN
                <?php else: ?>
                  GUARANTEED SECURITY
                <?php endif ?>
              </h4>
              <p>Lorem ipsum dolor sit amet</p>
            </div>
            <div class="col-lg">
              <img src="assets/img/payment3.png" alt="Tour"class="img-fluid float-left">
              <h4>
                <?php if ($_SESSION["lang"] == 'id'): ?>
                  TIDAK ADA BAYARAN LEBIH
                <?php else: ?>
                  NO MORE PAYMENT
                <?php endif ?>
              </h4>
              <p>Lorem ipsum dolor sit amet</p>
            </div>
          </div>
        </div>
        
      </div>
      <!-- Akhir info kami -->

      
      <!-- Testimonial -->
      <section id="section3" class="testimonial">
        <div class="row justify-content-center">
          <div class="col-10 justify-content-center d-flex">
            <h5>"Sopirnya sangat Ramah Sekali dan tahu jalan banget"</h5>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6 d-flex justify-content-center">
            <figure class="figure">
              <img src="assets/img/img1.png" class="figure-img img-fluid rounded-circle" alt="img 1">
            </figure>
            <figure class="figure">
              <img src="assets/img/img2.png" class="figure-img img-fluid rounded-circle utama" alt="img 2">
              <figcaption class="figure-caption">
                <h5>Sellena Princes</h5>
                <p>Doctor</p>
              </figcaption>
            </figure>
            <figure class="figure">
              <img src="assets/img/img3.png" class="figure-img img-fluid rounded-circle" alt="img 3">
            </figure>
          </div>
          
        </div>
      </section>
      <!-- Akhir Testimonial -->

      <!-- Tentang dan Hubungi -->
      <div id="section4" class="row hubungi justify-content-center">
        <div class="col-lg justify-content-center d-flex">
          <div class="row">
            <div class="col-lg">
              <h4>
                <?php if ($_SESSION["lang"] == 'id'): ?>
                  TENTANG KAMI
                <?php else: ?>
                  ABOUT US
                <?php endif ?>
              </h4>
              <p>
                <?php if ($_SESSION["lang"] == 'id'): ?>
                  GetTrans.id adalah perusahaan yang bergerak
          dibidang tour travel, yang bisa dipesan melalui online/offline.
          GetTrans hanya bisa dibooking untuk wilayah Bali.
                <?php else: ?>
                  GetTrans.id is a company engaged
                  in the field of tour travel, which can be ordered via online / offline.
                  GetTrans can only be booked for the Bali area.
                <?php endif ?>
        </p>
            </div>
            <div class="col-lg">
              <h4>
                <?php if ($_SESSION["lang"] == 'id'): ?>
                  HUBUNGI KAMI
                <?php else: ?>
                  CONTACT US
                <?php endif ?>
              </h4>
              <p>Phone: +62 811122233</p>
              <p>Email: gettrans.rgb@gmail.com</p>
              <p>Fax:(0331) 45678</p>
            </div>
            <div class="col-lg justify-content-center d-flex">
              <img src="assets/img/map.png" alt="map"class="img-fluid">
            </div> 
          </div>          
        </div>
        
      </div>
      <!-- Akhir Tentang dan Hubungi -->
            
    </div>
    <!-- Akhir Container -->


<?php include 'templates/footer.php' ?>