<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>UCP : Unité Coordination Projets</title>
  <link rel="icon" type="image/png" href="{{asset('images/ucp_logo.ico')}}"/>
  <link rel="stylesheet" href="{{asset('admin/vendors/select2/select2.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/vendors/select2-bootstrap-theme/select2-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('admin/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('admin/vendors/css/vendor.bundle.base.css')}}">
  <link rel="stylesheet" href="{{asset('admin/css/vertical-layout-light/style.css')}}">
  <link rel="stylesheet" href="{{asset('admin/vendors/mdi/css/materialdesignicons.min.css')}}">
  <style>
    .visible {
      /* visibility: visible !important; */
      display: none;
    }
    .opacity {
      opacity: 0.5;
    }
    #profile-container:hover {
      opacity: 0.5;
    }



    .bubbleWrapper {
      padding: 10px 10px;
      display: flex;
      justify-content: flex-end;
      flex-direction: column;
      align-self: flex-end;
      color: #fff;
    }
    .inlineContainer {
      display: inline-flex;
    }
    .inlineContainer.own {
      flex-direction: row-reverse;
    }
    .inlineIcon {
      width:20px;
      object-fit: contain;
    }
    .ownBubble {
      min-width: 60px;
      max-width: 700px;
      padding: 14px 18px;
      margin: 6px 8px;
      /* background-color: #5b5377; */
      background-color: #797196;
      border-radius: 16px 16px 0 16px;
      /* border: 1px solid #443f56; */
    
    }
    .otherBubble {
      min-width: 60px;
      max-width: 700px;
      padding: 14px 18px;
      margin: 6px 8px;
      /* background-color: #6C8EA4; */
      background-color: #4b49ac;
      border-radius: 16px 16px 16px 0;
      /* border: 1px solid #54788e; */
      
    }
    .own {
      align-self: flex-end;
    }
    .other {
      align-self: flex-start;
    }
    span.own,
    span.other{
      font-size: 14px;
      color: grey;
    }


    .hovertext {
      position: relative;
    }

    .hovertext:before {
      content: attr(data-hover);
      visibility: hidden;
      opacity: 0;
      width: 140px;
      background-color: black;
      color: #fff;
      text-align: center;
      border-radius: 5px;
      padding: 5px 0;
      transition: opacity 1s ease-in-out;

      position: absolute;
      z-index: 1;
      left: 0;
      top: 110%;
    }

    .hovertext:hover:before {
      opacity: 1;
      visibility: visible;
    }



  </style>
</head>
<body>
  <div class="container-scroller" id="container">
    @include('atr.header')
    <div class="container-fluid page-body-wrapper">
      @include('atr.nav-gauche')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-8 grid-margin">
              <div class="row">
                <div class="col-md-12 mb-4 stretch-card">
                  <div class="card">
                    <div class="card-body" style="margin: 1%">
                      <p class="fs-30 mb-2">Rechercher un sujet sur le thème évènements</p><br>
                      <div class="form-group">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Rechercher un sujet sur le thème évènements ..." id="search">
                          <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" type="button" id="searchButton">Rechercher</button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12 mb-4 stretch-card">
                  <div class="card">
                    <div class="card-body" style="margin: 1%">
                      <p class="fs-30 mb-2">Les sujets de discussion</p><br>
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <tbody>
                            <tr>
                              <td style="width: 10%; text-align: center">
                                <div class="hovertext" data-hover="Hello, this is the tooltip">
                                  <img src="https://cdn1.iconfinder.com/data/icons/ninja-things-1/1772/ninja-simple-512.png" style="height: 50px; width: 50px"><br><br>
                                </div>
                                <p class="text-secondary">05/07/2022 à 10:59</p>
                              </td>
                              <td>
                                <p style="width: 90%; font-weight: bold; font-size: larger">Titre ...</p>
                                <a href="" data-toggle="collapse" data-target="#demo1" class="text-secondary">À propos...</a><br><br>
                                <p id="demo1" class="collapse">Commentaire ...<br>......<br>.....<br>......<br>.....<br>......<br>.....</p>
                              </td>
                            </tr>
                            <tr>
                              <td style="width: 10%; text-align: center">
                                <div class="hovertext" data-hover="Hello, this is the tooltip">
                                  <img src="https://cdn1.iconfinder.com/data/icons/ninja-things-1/1772/ninja-simple-512.png" style="height: 50px; width: 50px"><br><br>
                                </div>
                                <p class="text-secondary">05/07/2022 à 10:59</p>
                              </td>
                              <td>
                                <p style="width: 90%; font-weight: bold; font-size: larger">Titre ...</p>
                                <a href="" data-toggle="collapse" data-target="#demo2" class="text-secondary">À propos...</a><br><br>
                                <p id="demo2" class="collapse">Commentaire ...<br>......<br>.....<br>......<br>.....<br>......<br>.....</p>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4 grid-margin">
              <div class="row">
                <div class="col-md-12 mb-4 stretch-card">
                  <div class="card">
                    <div class="card-body" style="margin: 1%">
                      <p class="fs-30 mb-2">Les thèmes de discussion</p><br>
                      <div class="form-group">
                        <select style="height: 10px" class="js-example-basic-single w-100">
                          <option value="AL">Alabama</option>
                          <option value="WY">Wyoming</option>
                          <option value="AM">America</option>
                          <option value="CA">Canada</option>
                          <option value="RU">Russia</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row" style="min-height: 800px">
                <div class="col-md-12 mb-4 mb-lg-0 stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <p class="fs-30 mb-2">Commentaires</p>
                      <hr style="color: lightgray; width: 109%; margin-left: -4.5%;">
                      <div style="min-height: 60%">
                        
                        


                        <div class="bubbleWrapper">
                          <div class="inlineContainer hovertext" data-hover="Hello, this is the tooltip">
                            <img class="inlineIcon" src="https://cdn1.iconfinder.com/data/icons/ninja-things-1/1772/ninja-simple-512.png">
                            <div class="otherBubble other">
                              Commentaire 1 ...
                            </div>
                          </div><span class="other">08:41</span>
                        </div>
                        <div class="bubbleWrapper">
                          <div class="inlineContainer own hovertext" data-hover="Hello, this is the tooltip">
                            <img class="inlineIcon" src="https://www.pinclipart.com/picdir/middle/205-2059398_blinkk-en-mac-app-store-ninja-icon-transparent.png">
                            <div class="ownBubble own">
                             Commentaire 2 ...
                            </div>
                          </div><span class="own">08:55</span>
                        </div>
                        <div class="bubbleWrapper">
                          <div class="inlineContainer hovertext" data-hover="Hello, this is the tooltip">
                            <img class="inlineIcon" src="https://cdn1.iconfinder.com/data/icons/ninja-things-1/1772/ninja-simple-512.png">
                            <div class="otherBubble other">
                              Commentaire 3 ...
                            </div>
                          </div><span class="other">08:41</span>
                        </div>
                        <div class="bubbleWrapper">
                          <div class="inlineContainer hovertext" data-hover="Hello, this is the tooltip">
                            <img class="inlineIcon" src="https://cdn1.iconfinder.com/data/icons/ninja-things-1/1772/ninja-simple-512.png">
                            <div class="otherBubble other">
                              Commentaire 4 ...
                            </div>
                          </div><span class="other">08:41</span>
                        </div>
                        <div class="bubbleWrapper">
                          <div class="inlineContainer hovertext" data-hover="Hello, this is the tooltip">
                            <img class="inlineIcon" src="https://cdn1.iconfinder.com/data/icons/ninja-things-1/1772/ninja-simple-512.png">
                            <div class="otherBubble other">
                              Commentaire 5 ...
                            </div>
                          </div><span class="other">08:41</span>
                        </div>
                        <div class="bubbleWrapper">
                          <div class="inlineContainer own hovertext" data-hover="Hello, this is the tooltip">
                            <img class="inlineIcon" src="https://www.pinclipart.com/picdir/middle/205-2059398_blinkk-en-mac-app-store-ninja-icon-transparent.png">
                            <div class="ownBubble own">
                             Commentaire 6 ...
                            </div>
                          </div><span class="own">08:55</span>
                        </div>







                      </div>
                      <hr style="color: lightgray; width: 109%; margin-left: -4.5%;">
                      <textarea class="form-control" name="" id="" style="width: 100%" rows="10" placeholder="Votre commentaire ..."></textarea>
                      <button class="btn btn-primary btn-sm" style="border-radius: 0%;">Commenter</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>



          </div>
        </div>
      </div>
    </div>
  </div>


  <div id="loader" class="visible" style="position: fixed; top:40%; left:45%;">
    <img src = "{{asset('images/loader.svg')}}" alt="Chargement..."/>
  </div>


  <script src="{{asset('admin/vendors/js/vendor.bundle.base.js')}}"></script>
  <script src="{{asset('admin/vendors/typeahead.js/typeahead.bundle.min.js')}}"></script>
  <script src="{{asset('admin/vendors/select2/select2.min.js')}}"></script>
  <script src="{{asset('admin/js/typeahead.js')}}"></script>
  <script src="{{asset('admin/js/select2.js')}}"></script>
  <script src="{{asset('admin/js/off-canvas.js')}}"></script>
  <script src="{{asset('admin/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('admin/js/template.js')}}"></script>
  <script src="{{asset('admin/js/settings.js')}}"></script>
  <script src="{{asset('admin/js/todolist.js')}}"></script>
  <script src="{{asset('js/bootstrap-animate-css.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
  <script>

    $(document).ready(function(){
      $("#formChangementMotDePasse").submit(function(){
        $("#loader").removeClass("visible");
        $("#container").addClass("opacity");
      });
      $("#form_changer_photo_de_profil").submit(function(){
        $("#loader").removeClass("visible");
        $("#container").addClass("opacity");
      });
      $("#formChangementDeProfil").submit(function(){
        $("#loader").removeClass("visible");
        $("#container").addClass("opacity");
      });
    });
	</script>
</body>
</html>