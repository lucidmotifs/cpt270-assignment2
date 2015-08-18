<?php
# Included for technical marking purposes - comment back in on submission
#include_once("/home/eh1/e54061/public_html/wp/debug.php"); ?>

<?php
# Content include files
include_once("inc/header.html");
include_once("inc/navigation.html"); ?>

<!-- Banner splitting header and content -->
<section id="banner">
  <h3>Selling Dreams</h3>
  <!-- Image used under fair use for academic purposes -->
  <img alt="Brige Banner" src="img/banner-bridge.jpg">
</section>

<!-- Content Area -->
<main class="container">

  <section id="page-title">
    <h1>Our Products</h1>
  </section>

  <hr>

  <section id="products">

    <ul id="product-list">

      <li>
        <a href="single_product.html">
          <!-- Image used under fair use for academic purposes -->
          <img alt="Golden Gate Bridge" src="img/golden-gate.jpg">
        </a>
        <div class="product-meta">
          <h2>
            <a href="/single_product.html">
              Golden Gate Bridge
            </a>
          </h2>
          <small class="loc-small">San Francisco</small>
          <small>Landmarks</small>
          <div class="row-fluid">
            <div class="price">24,000,000 AUD</div>
            <div class="pull-right"></div>
          </div>
        </div>
      </li>

      <li>
        <a href="single_product.html">
          <!-- Image used under fair use for academic purposes -->
          <img alt="London Bridge" src="img/london-bridge.jpg">
        </a>
        <div class="product-meta">
          <h2>
            <a href="single_product.html">
              London Bridge
            </a>
          </h2>
          <small class="loc-small">London</small>
          <small>City Bridges</small>
          <div class="row-fluid">
            <div class="span4 price">50,000,000 AUD</div>
          </div>
        </div>
      </li>

      <li>
        <a href="single_product.html">
          <!-- Image used under fair use for academic purposes -->
          <img alt="Brooklyn Bridge" src="img/brooklyn-bridge.jpg">
        </a>
        <div class="product-meta">
          <h2>
            <a href="single_product.html">
              Brooklyn Bridge
            </a>
          </h2>
          <small class="loc-small">New York</small>
          <small>Large Bridges</small>
          <div class="row-fluid">
            <div class="price">42,000,000 AUD</div>
          </div>
        </div>
      </li>

      <li>
        <a href="single_product.html">
          <!-- Image used under fair use for academic purposes -->
          <img alt="Sydney Harbour Bridge" src="img/harbour-bridge.jpg">
        </a>
        <div class="product-meta">
          <h2>
            <a href="single_product.html">
              Harbour Bridge
            </a>
          </h2>
          <small class="loc-small">Sydney</small>
          <small>Landmarks</small>
          <div class="row-fluid">
            <div class="price">99,000,000 AUD</div>
          </div>
        </div>
      </li>

      <li>
        <a href="single_product.html">
          <!-- Image used under fair use for academic purposes -->
          <img alt="Millau Viaduct" src="img/millau-viaduct.jpg">
        </a>
        <div class="product-meta">
          <h2>
            <a href="single_product.html">
              Millau Viaduct
            </a>
          </h2>
          <small class="loc-small">France</small>
          <small>Modern Wonders</small>
          <div class="row-fluid">
            <div class="price">4,238,000,000 AUD</div>
          </div>
        </div>
      </li>
    </ul>
  </section>

</main>

<?php
# Footer include file
include_once("inc/footer.html"); ?>
