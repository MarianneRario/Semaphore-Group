<?php include('server.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link
      rel="stylesheet"
      href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
      integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
      integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/error.css" />
    <title>Semaphore</title>
  </head>

  <body data-spy="scroll" data-target="#main-nav" id="home">
    <nav
      class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top"
      id="main-nav"
    >
      <div class="container">
        <a href="insert.php" class="navbar-brand"><b>SEMAPHORE</b></a>
        <button
          class="navbar-toggler"
          data-toggle="collapse"
          data-target="#navbarCollapse"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
    </nav>

    <!-- HOME SECTION -->
    <header id="home-section">
      <div class="dark-overlay">
        <div class="home-inner container">
          <!-- SUCCESS -->
          <div class="success-card">
            <div class="col d-flex justify-content-center">
              <div class="card col-lg-8 text-center">
                <div class="card-header">Success!</div>
                <div class="card-body">
                  <h5 class="card-title">Thank You for Signing Up</h5>
                  <p class="card-text">
                    By signing up, you agreed to our terms and conditions.
                  </p>
                  <a href="insert.php" class="btn btn-success">Go back</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- FOOTER -->
    <footer id="main-footer" class="bg-dark">
      <div class="container">
        <div class="row">
          <div class="col text-center py-4">
            <p>
              SEMAPHORE &copy;
              <span id="year"></span>
            </p>
          </div>
        </div>
      </div>
    </footer>

    <script
      src="http://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
      integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"
      integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
      crossorigin="anonymous"
    ></script>

    <script>
      // Get the current year for the copyright
      $("#year").text(new Date().getFullYear());

      // Init Scrollspy
      $("body").scrollspy({ target: "#main-nav" });

      // Smooth Scrolling
      $("#main-nav a").on("click", function (event) {
        if (this.hash !== "") {
          event.preventDefault();

          const hash = this.hash;

          $("html, body").animate(
            {
              scrollTop: $(hash).offset().top,
            },
            800,
            function () {
              window.location.hash = hash;
            }
          );
        }
      });
    </script>
  </body>
</html>
