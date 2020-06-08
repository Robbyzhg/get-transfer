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
              <a type="button" href="pesan.php"><img src="assets/img/taxi.png" alt="Taxi" class="float-left"></a>
              <h4>Airport Taxi</h4>
              <p style="color: grey;">Friendly and inexpensive taxi service</p>
            </div>
            <div class="col-lg">
              <a type="button" href="pesanhotel.php"><img src="assets/img/hotel.png" alt="Hotel"class="float-left"></a>
              <h4>Hotel</h4>
              <p style="color: grey;">Best and wallet-friendly lodging</p>
            </div>
            <div class="col-lg">
              <a type="button" data-toggle="modal" data-target="#exampleModal"><img src="assets/img/tour.png" alt="Tour" class="float-left"></a>
              <h4>Tour and Travel</h4>
              <p style="color: grey;">Convenient Transportation and Best Services from Us</p>
            </div>
          </div>
          
        </div>
        
      </div>
      <!-- Akhir info Panel -->
      
       <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><strong>Choose Package</strong></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <a class="btn btn-outline-success btn-lg text-center mb-2" href="halamanpaket.php">
                Our Recommendation
              </a>
              <a class="btn btn-outline-success btn-lg text-center" href="halamanpaket.php">
                Fullday/Halfday Tour
              </a>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <!-- Judul Kenapa Harus Kami -->
      <div class="row">
        <div id="section1" class="judulharuskami">
          <div class="col-lg judul-kami">
            <h3 class="judul-kamih3">Why Must Choose Us</h3>
          </div>
        </div>
      </div>
      <!-- Akhir Judul Harus Kami-->
      <!-- info kami -->
      <div class="row justify-content-center">
        <div class="col-lg info-kami justify-content-center d-flex">
          <div class="row">
            <div class="col-lg">
              <img src="assets/img/payment4.png" alt="Taxi" class="img-fluid info-kamiimg">
              <h4 class="info-kamih4">AFFORDABLE PRICES</h4>
              <p class="info-kamip">Enjoy Your Trip with Economical Costs</p>
            </div>
            <div class="col-lg">
              <img src="assets/img/shield2.png" alt="Hotel"class="img-fluid info-kamiimg">
              <h4 class="info-kamih4">GUARANTEED SECURITY</h4>
              <p class="info-kamip">Customer Safety and Comfort is Our Priority</p>
            </div>
            <div class="col-lg">
              <img src="assets/img/payment3.png" alt="Tour"class="img-fluid info-kamiimg">
              <h4 class="info-kamih4">NO MORE PAYMENT</h4>
              <p class="info-kamip">We will not charge more than specified</p>
            </div>
            <div class="col-lg">
              <img src="assets/img/time.png" alt="Tour"class="img-fluid info-kamiimg">
              <h4 class="info-kamih4">FREE WAITING TIME</h4>
              <p class="info-kamip">We allow a free waiting time of 60 minutes at the airport, all other locations including a free waiting time of 15 minutes</p>
            </div>
          </div>
        </div>
        
      </div>
      <!-- Akhir info kami -->

      
      <!-- Testimonial -->
      <section id="section3" class="testimonial">
        <div class="row justify-content-center">
          <div class="col-10 justify-content-center d-flex">
            <h5>"The driver is very friendly and knows the way"</h5>
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
                <h5 class="testimonialh5">Sellena Princes</h5>
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
              <h4>ABOUT US</h4>
              <p>
                GetTrans.id is a company engaged
                in the field of tour travel, which can be ordered via online / offline.
                GetTrans can only be booked for the Bali area.
              </p>
            </div>
            <div class="col-lg">
              <h4>CONTACT US</h4>
              <p>Phone: +62 811122233</p>
              <p>Email: gettrans.rgb@gmail.com</p>
              <p>Fax:(0331) 45678</p>
            </div>
            <div class="col-lg justify-content-center d-flex">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d208.28981826657554!2d115.1862985740429!3d-8.719429128999543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd246b30d0f3365%3A0x8d5fa33e60d5c631!2sSwarhaloka%20residence!5e1!3m2!1sid!2sid!4v1590984107906!5m2!1sid!2sid" width="200" height="200" frameborder="10" style="border:10;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div> 
          </div>          
        </div>
      </div>
      <!-- Akhir Tentang dan Hubungi -->
            
    </div>
    <!-- Akhir Container -->
    
    <!-- Whatsapp API  -->
    <div style="position:fixed;right:20px;bottom:20px;">
      <a href="https://api.whatsapp.com/send?phone=+62811122233">
      <button class="btn btn-outline-success btn-lg">
      <img src="https://web.whatsapp.com/img/favicon/1x/favicon.png"> Customer Service</button></a>
    </div>
    


<?php include 'templates/footer.php' ?>