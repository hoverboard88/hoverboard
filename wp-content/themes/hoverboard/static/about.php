<!doctype html>
<html lang="en" class="no-js">
<head>
  <?php $template_name = basename(__FILE__, '.php'); ?>
  <?php include('inc/head.php'); ?>
</head>
<body>

  <?php include('inc/search.php'); ?>

  <header class="wrap wrap--green wrap--small-gradient">
    <div class="container container--top-bottom-padding">
      <?php include('inc/header.php'); ?>
    </div>
  </header>

  <!-- TODO: possibily switch this out with the <main> tag -->
  <div role="main" class="main main--content">
    <div class="wrap">
      <div class="container container--medium container--padded">
        <div class="well well--no-padding centered">
          <div class="flex-row">
            <div class="flex-column flex-column-half">
              <h3 class="h6">Services</h3>
              <p>Full Stack Design and Development CMS Integration and Support Continued Support &amp; Maintenance Comprehensive Pagespeed Reports</p>
            </div>
            <div class="flex-column flex-column-half">
              <h3 class="h6">Languages</h3>
              <p>HTML, CSS, SASS, Javascript, Ruby, PHP, Python</p>
              <p><strong>and more… Just ask!</strong></p>
            </div>
          </div>
          <div class="flex-row">
            <div class="flex-column">
              <h3 class="black h2 base-font single-spaced">Thinking of a website revamp?</h3>
              <p class="italicized-callout">
                Looking for feedback on your latest project?<br>
                Not sure exactly how we could help?
              </p>
              <p><a href="#" class="btn single-spaced">Get in Touch</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- .main -->
  <?php include('inc/footer.php'); ?>
  <script src="../dist/js/main.min.js"></script>
</body>
</html>
