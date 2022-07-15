<?php
    $header = 'admin.header';
    $nav_gauche = 'admin.nav-gauche';
    $publier_sujet = asset('/administrateur/plateforme-de-discussion/publier-sujet');
    $commenter = asset('/administrateur/plateforme-de-discussion/commenter');
?>
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
      /* min-width: 60px;
      max-width: 700px; */
      min-width: 5%;
      max-width: 200px;
      padding: 14px 18px;
      margin: 6px 8px;
      /* background-color: #5b5377; */
      background-color: #797196;
      /* border-radius: 16px 16px 0 16px; */
      border-radius: 16px 0 16px 16px;
      /* border: 1px solid #443f56; */
    
    }
    .otherBubble {
      /* min-width: 60px;
      max-width: 700px; */
      min-width: 5%;
      max-width: 200px;
      padding: 14px 18px;
      margin: 6px 8px;
      /* background-color: #6C8EA4; */
      background-color: #4b49ac;
      /* border-radius: 16px 16px 16px 0; */
      border-radius: 0 16px 16px 16px;
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
      /* width: 140px; */
      width: auto;
      background-color: rgba(0, 0, 0, 0.57);
      color: #fff;
      text-align: center;
      border-radius: 5px;
      padding: 5px 0;
      transition: opacity 1s ease-in-out;

      position: absolute;
      z-index: 1;
      left: 0;
      /* top: 110%; */
      /* top: -20%; */
    }

    .hovertext:hover:before {
      opacity: 1;
      visibility: visible;
    }



  </style>
</head>
<body>
  <div class="container-scroller" id="container">
    @include($header)
    <div class="container-fluid page-body-wrapper">
        @include($nav_gauche)
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-8 grid-margin">
              <div class="row">
                <div class="col-md-12 mb-4 stretch-card">
                  <div class="card">
                    <div class="card-body" style="margin: 1%">
                      <h3>
                        Rechercher un sujet sur le thème <b>
                        @for ($i = 0; $i < count($theme); $i++)
                          @if (isset($_GET['id_theme']))
                            @if ($theme[$i]->id == $_GET['id_theme'])
                              {{ $theme[$i]->theme }}
                            @endif
                          @else
                            {{ $theme[0]->theme }}
                            @break
                          @endif
                        @endfor</b>
                        </h3><br>
                      <div class="form-group">
                        <div class="input-group">
                          @if (isset($_GET['sujet']))
                            <input type="text" class="form-control" name="recherche_sujet" id="recherche_sujet" placeholder="Rechercher un sujet sur sur le thème sélectionné ..." value="{{ $_GET['sujet'] }}">
                          @else
                            <input type="text" class="form-control" name="recherche_sujet" id="recherche_sujet" placeholder="Rechercher un sujet sur sur le thème sélectionné ...">
                          @endif
                          <div class="input-group-append">
                            <button class="btn btn-sm btn-primary" onclick="let queryParams = new URLSearchParams(window.location.search), recherche_sujet=document.getElementById('recherche_sujet').value;queryParams.set('sujet', recherche_sujet);history.replaceState(null, null, '?' + queryParams.toString());window.location.reload();">Rechercher</button>
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
                      <h3 style="float: left">Les sujets de discussion</h3>
                      <br>
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <tbody>
                            @for ($i = 0; $i < count($sujet); $i++)
                              @if (isset($_GET['id_sujet']))
                                @if ($sujet[$i]->id == $_GET['id_sujet'])
                                  <tr style="background-color: lightgray" onclick="let queryParams = new URLSearchParams(window.location.search), id_sujet={{ $sujet[$i]->id }};queryParams.set('id_sujet', id_sujet);history.replaceState(null, null, '?' + queryParams.toString());window.location.reload();">
                                    <td style="width: 10%; text-align: center">
                                      <div class="hovertext" data-hover="{{ $utilisateur_sujet[$i]->prenom }} {{ $utilisateur_sujet[$i]->nom }}">
                                        <img src="{{asset('images/photo_de_profil/'.$utilisateur_sujet[$i]->photo_de_profil)}}" style="height: 50px; width: 50px"><br><br>
                                      </div>
                                      <p class="text-secondary">{{ $sujet[$i]->date }}</p>
                                    </td>
                                    <td>
                                      <?php
                                        $varTexteArea= str_replace('<br />', '<br/>', nl2br($sujet[$i]->sujet));
                                        echo $varTexteArea;
                                      ?>
                                    </td>
                                  </tr>
                                @else
                                  <tr onclick="let queryParams = new URLSearchParams(window.location.search), id_sujet={{ $sujet[$i]->id }};queryParams.set('id_sujet', id_sujet);history.replaceState(null, null, '?' + queryParams.toString());window.location.reload();">
                                    <td style="width: 10%; text-align: center">
                                      <div class="hovertext" data-hover="{{ $utilisateur_sujet[$i]->prenom }} {{ $utilisateur_sujet[$i]->nom }}">
                                        <img src="{{asset('images/photo_de_profil/'.$utilisateur_sujet[$i]->photo_de_profil)}}" style="height: 50px; width: 50px"><br><br>
                                      </div>
                                      <p class="text-secondary">{{ $sujet[$i]->date }}</p>
                                    </td>
                                    <td>
                                      <?php
                                        $varTexteArea= str_replace('<br />', '<br/>', nl2br($sujet[$i]->sujet));
                                        echo $varTexteArea;
                                      ?>
                                    </td>
                                  </tr>
                                @endif
                              @else
                                <tr onclick="let queryParams = new URLSearchParams(window.location.search), id_sujet={{ $sujet[$i]->id }};queryParams.set('id_sujet', id_sujet);history.replaceState(null, null, '?' + queryParams.toString());window.location.reload();">
                                  <td style="width: 10%; text-align: center">
                                    <div class="hovertext" data-hover="{{ $utilisateur_sujet[$i]->prenom }} {{ $utilisateur_sujet[$i]->nom }}">
                                      <img src="{{asset('images/photo_de_profil/'.$utilisateur_sujet[$i]->photo_de_profil)}}" style="height: 50px; width: 50px"><br><br>
                                    </div>
                                    <p class="text-secondary">{{ $sujet[$i]->date }}</p>
                                  </td>
                                  <td>
                                    <?php
                                      $varTexteArea= str_replace('<br />', '<br/>', nl2br($sujet[$i]->sujet));
                                      echo $varTexteArea;
                                    ?>
                                  </td>
                                </tr>
                              @endif
                            @endfor
                          </tbody>
                        </table>
                      </div>
                      <br>
                      <div style="float: left">
                        {!! $sujet->withQueryString()->links('pagination::bootstrap-4') !!}
                      </div>
                      <button type="submit" class="btn btn-primary btn-md" style="float: right;" onclick="document.getElementById('rowNouveauSujet').removeAttribute('style')">Ajouter un sujet</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row" style="display: none" id="rowNouveauSujet">
                <div class="col-md-12 mb-4 stretch-card">
                  <div class="card">
                    <div class="card-body" style="margin: 1%">
                      <h3>Ajout d'un nouveau sujet</h3>
                      <form action="{{ $publier_sujet }}" method="post">
                        @csrf
                        @if (isset($_GET['id_theme']))
                          <input type="hidden" name="id_theme" value="{{ $_GET['id_theme'] }}">
                        @else
                          <input type="hidden" name="id_theme" value="{{ $theme[0]->id }}">
                        @endif
                        <textarea class="form-control" name="sujet" style="width: 100%" rows="10" wrap="on" placeholder="Écrivez ici votre nouveau sujet de discussion ..."></textarea>
                        <button type="submit" class="btn btn-primary btn-sm" style="border-radius: 0%;">Publier</button>
                      </form>
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
                      <h3>Les thèmes de discussion</h3><br>
                      <div class="form-group">
                        <select style="height: 10px; width: 100%" class="js-example-basic-single" id="id_themes_discussion" onchange="change_id_themes_discussion()">
                          @for ($i = 0; $i < count($theme); $i++)
                            @if (isset($_GET['id_theme']))
                              @if ($theme[$i]->id == $_GET['id_theme'])
                                <option value="{{ $theme[$i]->id }}" selected>{{ $theme[$i]->theme }}</option>
                              @else
                                <option value="{{ $theme[$i]->id }}">{{ $theme[$i]->theme }}</option>
                              @endif
                            @else
                              <option value="{{ $theme[$i]->id }}">{{ $theme[$i]->theme }}</option>
                            @endif
                          @endfor
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row" style="height: 850px">
                <div class="col-md-12 mb-4 mb-lg-0 stretch-card">
                  <div class="card">
                    <div class="card-body">
                        <h3>Commentaires</h3>
                        <hr style="color: lightgray; width: 109%; margin-left: -4.5%;">
                      @if (isset($_GET['id_sujet']))
                        {{-- <div style="height: 550px; overflow-y: scroll; background-color: rgb(237, 237, 237); width: 108.4%; margin-left: -4.25%; margin-top: -16px" id="commentaire"> --}}
                        <div style="height: 550px; overflow: scroll; background-color: rgb(237, 237, 237)" id="commentaire">
                          @for ($i = 0; $i < count($commentaire); $i++)
                            {{-- @if ($commentaire[$i]->id_utilisateur == request()->session()->get('administrateur')->id) --}}
                            @if (0 == request()->session()->get('administrateur')->id)
                              <div class="bubbleWrapper">
                                <div class="inlineContainer own">
                                  <img style="border-radius: 50%; height: 25px; width: 25px" src="{{asset('images/photo_de_profil/'.$utilisateur_commentaire[$i]->photo_de_profil)}}"/>
                                  <div class="ownBubble own">
                                      <?php
                                        $varTexteArea= str_replace('<br />', '<br/>', nl2br($commentaire[$i]->commentaire));
                                        echo $varTexteArea;
                                      ?>
                                    </div>
                                  </div><span class="own">{{ $commentaire[$i]->date }}</span>
                              </div>
                            @else
                              <div class="bubbleWrapper">
                                <div class="inlineContainer hovertext" data-hover="{{ $utilisateur_commentaire[$i]->prenom }} {{ $utilisateur_commentaire[$i]->nom }}">
                                  {{-- <img class="inlineIcon" src="{{asset('images/photo_de_profil/'.$utilisateur_commentaire[$i]->photo_de_profil)}}"> --}}
                                  <img style="border-radius: 50%; height: 25px; width: 25px" src="{{asset('images/photo_de_profil/'.$utilisateur_commentaire[$i]->photo_de_profil)}}"/>
                                  <div class="otherBubble other">
                                    <?php
                                      $varTexteArea= str_replace('<br />', '<br/>', nl2br($commentaire[$i]->commentaire));
                                      echo $varTexteArea;
                                    ?>
                                  </div>
                                </div><span class="other">{{ $commentaire[$i]->date }}</span>
                              </div>
                            @endif
                          @endfor
                        </div>
                        <hr style="color: lightgray; width: 109%; margin-left: -4.5%; margin-top: 0">
                        <form action="{{ $commenter }}" method="post">
                          @csrf
                          <input type="hidden" name="id_sujet" value="<?php if(isset($_GET['id_sujet'])) { echo $_GET['id_sujet']; } else { echo $sujet[0]->id; } ?>">
                          <textarea class="form-control" name="commentaire" id="commenter" style="width: 100%" rows="10" wrap="on" placeholder="Votre commentaire ..."></textarea>
                          {{-- <img height="30 px" class="emoji" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAASxklEQVR4nO2beZhU1ZXAf/e9V3tV7/sG3dJs3TSgIptRQHCNRqM4ahKX6IDrKKBoJo4iGmMMGJeJzsR8JnFGNLaJGBckiJI4SoOASNM0zdo0vUGv1VVde707fzR0ddHVTdE0mXzf5Hxffd979557z7nnnXvuOeeegn/A/28QfwsiU0oX56u6Mh1FL0aKYgS5SBIQWAGQeBB0IalHsFfocq+uaRs37Xi2/kzzdkYEMGvWMs3f4pyrS2W+EMwBRg5xqoMgPxWI8rzxdZ+Ul5eHh5NPGGYBTC1bmqeE9PulkDcDGcM5N3BEwuuKpr+w8ZtfNAzXpMMigBnjlozQFZ4AbgSMwzHnIBBA8EYY+fhXO587fLqTnZYASkqWGe3CdZeQPAXY4xkzZnwO8y4rIzHJis1hBsDd5aXL6WXdRzuoqW6Mk7r0IJSfm932ZzbULvMNcQlDF8B5JYsnKoi3gLHx4M+9rIwrrj6bjCwH7i4vzY1teL0BAKxWE5nZqdgTzLQ0ufhg9VY++bgyTk5EtRTcsGnnih1DWceQBDC1ZMndAlYC5pPhWswGHln+XYpGpVF7oJnyVR/zxYZvUDULQmgASD1EWPcy88KJXH/TpRQUZVG7t4WfPv4uXl8wHpZ8CBZV7Fz5H6e6llMVgJg+/sFnpZAPxoOckGjhqRU3YraqvPbKH/l0bSVmcyqKaoqJr4f9+H1tXHRZGbctvAavJ8SPF6/C5fLHyR0vVex0PADL9LgXFC9iSckyox3Xb0WPoTspKIrC08/fSGKimWVLX6axUUdVLXHRCoW85OYqPPHze+hy+njk/lXoerxrkquCZvetW7f+Ki7VUeKcVdhxvxrv4gEW3DeXjCwHLz67iqYmNe7FA2iahaYmlRefXUVapp077rko7rEgbjL4HK/DsrjWpsaDNK1kyXMC7oyXhcRkK7ct+BZbK3bx4erdKKoBVVW5deFs5lxcSrfbx5FmZ9SYsskj+N4PL2BsSR6VX9cBgiNNbgpGJnLutNF8/mk1Pm9cHxWgNC8jkF7fsvGjkyGeVADHDN6T8VIGuHXBheTkJbH8R28ij9nJZc9cT8nEbGw2I7PmlVJVeZj2VjcAY8bl8PBjV2GxaJw1Op3J5xSx4ZMqhKKxbUs13776PJKTHWzdfOBU2JiSnz69ub5l49bBkAZVkxnjHiwVsOJUqAIUjkrnwL5GgqGIscsbmcQnazZzx/eW4/F6mXvJhN6+2ReX4PF4ueN7y1n/8RbyC5N7+4IBCwf2N1A4KvVU2UAK8fx5JYsnDoYzoABmjVxm1hVZDsS/eY9BVlYS+2uaEX2md7a7OW/6RB77yX3YHRZ27zrY27dn9yGsDguP/eQ+pkwrxdnu7u0TQrC/5giZ2UmnygaAWUGsumzUfbGPHQYRgN/mWkqcTk5fSEmzYzQZqDvUFtX+0sq38ft9FBQms+HP21i3JuK3rPtwO39Zt5WCwmR8Pj8vrnw7amzdoTZMJhOJydZTZQdgfKfRtHigTi1W45TSxflSsnQo1FKSbQA4O71R7fv3eLj/n1ei6yEMxiRMpoiaq5qVV55fQzDwFopiwGzJRFEMvf2d7R5Akp7mwNnhOWWepNAfnTFuyaovq1ceOrEvpgaoUiwHbKdMCWhoaEVKyMpOiSakGLDa8rE7CqMWfxxMphTsjkKstryoxQPk5KchkTQ0tA6FJUBYdYVHY/X0E8D0iYtygZuGSAmPJ4jX62VEUeZQp+gHBSPT8Xb78HjiPgZjwQ9mjlmac2Jj/y0QVB9AyCGHtAKF+roWziqOTgfYbGYW/ejbqOrg/kk4rPOLn35Ad3ckwCsalcHhuqNRRnUIYAproX8BHunbGDXjrFnLNCnkD06HCkB1ZR15I1LJzo1sA6NZxWiQQGDQn9EgMZoj7kl2bgp5I9Ko3tlv+w4BxG2zZi2L+uhRscD0kkWXSpQ1p0tG0s3Lr91Dc5ObJ3/8Tk+b1PF6m0GexKcXChZLFkL0fJvHnr6OzBw7d9/6cm8K8bRAF/Mqqld8cvw1yhPMy5z5r8Dk0yYijUA3F15chh6Gml2NCCEwGBwYjAmD/wwOhOj5LtdcP5XzZ43inTc+Y1+NGzEc+Ssh/fUtG98//hq9qSSzh4EEQsCf/vg127/aw9Xzz2HupRNOPugEmHvZBK66djJbN9fw/uodw7P4Hu6i1tirAVPLluYJKZcPFxlFMfL5Z18x8ewiZl8ygZycVLZ9VYuUctBxqqpy1wMXc8U1k9i7+zBP/9sqDIbE4WILIGVEyrdePdz2hQv6CKAgdeolCDF/OCkpipW1H/6VlBQ7M2eVMO/yMnLyUmhu7MTVFZ3Gy85N4cZbZnL73XMoKExl/ZrN/PzJ32MyD3dyGaQqv6w/urEa+hyDUogxw04JsFiy+PXLn7C6fD33LLqJqeePYtZF43E6u/F6Q8dwNBITbXj9AfZVH+bl59+ktUVisWadCZaQktHHnyMCQBQLBlfPWPCtswJMy/eSYJUYVPD4JXUdGu9WWnH6ehTMaEyisyPM4w+/hi7dzLt8GmPGnkVCUk8iuavTTc3u/az7qAJF2DGZ0zAaI/Y5waByWW4aOWYTVqNGUNdx+UNs63SxqcUZk6/BJUDx8cde0zKtdMk6JHPjGW836Tw0u4tzClWSrIIuHzi9OuGQjs2iknTstDp4JMxvN1n46/7oYCwU8qKH/eiyRwMUoaGoJjQtOvCckZHE/KIsRqQ4QIDTH6DbH0DVFBKNRmwGAy5/gG2NHbxSU483FN/FkUD+eWPVc5dAX09Q4ohn8HVlHn54fhBNUfhyt5M3t/j5qk6iKhog0GUYhynEzecZmFtq56lrDOw44GHp+4l4gj2HjqZZQBs4yrZogkfLRlGan0ZtcytvbNtO+cE9dIckilABSVgPMSk1le8WjmZqUQFnZ6fwRvVh1sQRL0hE7x1GrwZML1myU0LJYAMXz+riO+cY+WZfGw+t9tEVSMJgcKAo0Z6zlJJwqBu/v4Pvnxdi4exUurqD3P9uEk3OwZNQWRYTy88uxmE18NrX21hdW4/RlISm2Xv9g+Og6wGCQReJwsOjU2YwfmQOa6obeHXPSe9UKyuqVpZB/ElRbp7i4epzVd7bfIQFb2n4KMRkSu23eOhJYmgGOzZ7PuU7MrjjN60YNXjuaidGdWA7Y1IUlk06C4MGi9av4+NmDzZ7fpRz1BcUxYjJlIrXkMuSiq9YW1nNFSX5zB9x0kCslwmlT4s7Ni6Mzwxyywydz6vaeeaTBMyWzF5X9WSgaTbq3AU8+HsXKQ6Npy7vHBD3kbKRJCWYeWLjlzSGklC1+CJyccx9fqn6EBU1+7m+JJ9Cx6Buc+9aI6sQuAbCfuDCLtpdHpa+Z8HYJ5ZPNA9sdMxazw9AUTT2OHMpr+hkSrGRkqz+Ye24JDsT89N4t2oXB3wWFCVmrmZQMJqSeWp7FZ3ubhaMyR0QTxJZq9KnNeaV87jMIGPzjby1yY/BmAZAmk3nndva+PDOTt66pR3rCRm3hdO7WXN3B2vu7mDh9O4eQoqB/6xIprXTy4Lp/WV9U1EWrU4Xb9a29kuInApoxnTe3bOXcdnJA2qBQPYaiT4aIPfGQr52gotub5jyykhWduE0Jzaryoq1XaQlqtxxXvRZfNWkEJWHuqis7eKqSZGvrWoOth30UpyjoiiRPa0IhaJUB980HEHRIpfMP5tczIRkB2UpDp6ZXBxF46LsFB6dWATAQ6UjuTI/vbfvg3oXbn+Ab+dGZ6UioPSutVfPhM4eGSPgGJkuqGnyoSiRrOzqSsnOBid/3JmBUW1hS0N0imv1lk7e3m5BR3LDJCfQd6yVK85WODffx+ZDPaozMcWOw2RkbXMbfSP05AQj947N63kxRDNnVSXnFKTxJIKS/BQaKiNapWgWDrS0MSJpABvS52P3aoCuaRtj4SZYBR2uaMtd2eTgDzszUDUbq7ans689mtArXybTGUilK5DOK19GC6em1YEuwxQlR2KBkRYDIV2yzx2dK3hxy1Y8MohHhnhhS/T9xuraej6t3kdqopkv9tXyX/vrovo7PQEc5th2RA2qFcefezE27Xi2flrJkoNAYV9kq0mhOxAtfUU1oNCzT7UYllozJMR8BtAx0h3wkmWPbI1Ug4pPD4CI9hF2dCksXL8BicRszkTt061qNlZU7SW4/WsMmg2TOS1qbHcwjNUUUwB7v6h5trcK4wQM+SmI2/u2eP06FuNp5eKiQFEEFg1auiNC7QwGMIn+zCqqEastb8C5TKZUTKbYN0Y2gxFvINSvXcBnfd+jqEqhvi2kHiUAty9MknX4BFCQFEJTBIc6I5a+3utHUwT5NjOHu/tXuyhCYW5WMuekObCYjeghyZFuH+83tFAfAx/AYTbiPlaB0hfCiN9HzR3F3Lja9cCRvm2HW/wUZfU/lt6/vZkVV3WgKbFTNXOKfXy4sJ3bp0YfeddO6MITkGw8GPEgN7d14Q2HuTS7v9W+ICuFX11Qyt2TiihMsWMWOglmwYUj03npglIen3gWJqW/e12YmkBDR79IsXnE+EN/6dsQpQHl5eXhqSVLXhfw0PG2D3ZpzC5TmD3Kx2f7IhUxv9sU4s45Fv5wRydbDkq21pvp9CmMS/czpTDE+DwDNXU+Vm2JVu2yfNjb5CUsE3oNflgaqG1pozQ9EfZFiqTm5qRw1+RRHGxu5fHP11Pj7D7mI0iQXu4YO4Grxo9jhWU091VU946bmZ5Mit3CuqaWE9Yvf3dirWE/0RXkTNuFLu493ne4Q+OiUS4m5em8uyMSwX3TqLJ2+xHGZcLkIgPzxviZNzZAWR64/Tr//UUHj3+oIdXUXj/+yvEerjhb45frfdR2RoJPIcDpcXJVSTGdLh/7XD3XXwZCdDlbWb5tOx4lFZM5tU8CNZVtre1U1O3Dqmps74yU0SydWEi7281re5tRItrhD+r6jU2tFVEuf0z9nVa65DUktx1/Pz+vgZ/ckEx5RZh//58I47oeJhBoIxjoIsEcIs2ucLAVhGLBZE6JOiHS7Tq/vqmLhjYvC99ORlWj66v0sJ8VU0aTmZDAoo27afcH0fUgobAH4yA5QV0PEg55MBh7cG4flceVJTk88ekXfO2KbF0Bv9pYtXLhieNjxqbZGdO3KYgFHCt6rO0wkWNp4cpz7bi6g1Qf6ZlYCAVNs2EypYCSQncoGZM5HaMxMSpKtJt0Xr6uHaNBcu+bYQL0vxsUisbGxlouLxrBzNQkNhztICRFP0H1GyfUXpwr8tK5oayAtbtqeK/RjRI5WdxC0+fXH6no54PHFEDj0Y1deRkzFGDOcebW14Q4O9vNd6ZYSTd5+bL2hABAiJgR4vjMIC9e58Ru1Xj4HReH3dkDRpJ+TOw+WsulxYXMzUpld6ebdv/J7wMVoXDXmDyuKxvB1wfqeGbHXgxa37pN8VhF5XMxL3wGzE6Msl2yOWQMXgukA2ialfe2e8k0dXHluVYuH+fBrITYfdRAOIYPXZId5OE5Xdx+oaTL7Wfh6y4OOnMGDXSEELT44fMDu5idm8fV4woYYzHR5PPTFkMQRiG4uiCDRWWFTMhJ4aOdu3jmm+oop0hAVbI/8MN97Ztjhq6DXjfMGPdgqa7IzfSpEgn4Oxib1sbDl9oZm28nENapbxM4PRI9LLGYBRkJgswEQUd3kD9tc/HiBjCbcxBxhrhSD+P1NrJw7GjmjS4m0WKh1eOjxePH6w+iqioJRgM5iRYMqmBPYwsvbd/KAZ+K0RhVSeLTkdM2Vz33zUC0TnrfMq10yZ1IXunbputBfL6jZNg83DzVSFGGBbtFw6SCyxem3R1gbZWPP1eD2ZyOwZgw0PSDQiDoxO9tZXZuDhfmjiDZZsVmMhEIh+n2+jnY0Ub5gRragypmc3oM7RILKqpWvDoYjbgunKaVPLgSZL8yEynDhEJuwiEfuh5CoqMoGkIxYNDsJzVg8UI47CMUdKPLILoeQqCgKBqKZsagOWLaFAm/3FS18t6TzR3vjZuYVrLkN8Atp8j7/wlIeHNTleP78ZTMxuvkSxeOBRLePE3e/gYgV4XMrlvirRc+5WLpqSVLftbXVf67AilfrNiVsOiMFEv3hWOG8TmGUEN4hsAL4v6TGbxYMORb9+kTFk2QuvIWMH6ocwwHCKgKSf2fvtr1i6qhjI+rWDoW1B+tOJpZMOFVJWxqEzATGLAa88yA9CCUp5P9gR/8peaFpqHOMix1F1NKF+erksdBfJ8zLwi/gN+h6cuH499jw/q3uZljluaEtPADAm4Ghq9QEBDQJJGvB3X9ha3Vzw/5i8eYd/hh/vz5al11wRwhuR6YDZw1xKn2CvgMKd/OKzm84e/+j5MDwfSJi3L1kDJdkaJYR44SgnwJdnGsHFdCt4J0STgsEfuEYI8aVCv6Zm//Af+AMwP/CwNvuI1dEeSIAAAAAElFTkSuQmCC"> --}}
                          {{-- <e class="emoji">Émoji</e> --}}
                          <button type="button" class="emoji btn btn-primary btn-sm" style="border-radius: 0%;">Émoji</button>
                          <button type="submit" class="btn btn-primary btn-sm" style="border-radius: 0%;">Commenter</button>
                        </form>
                      @endif
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
  <script src="{{asset('js/vanillaEmojiPicker.js')}}"></script>
  <script>
    function change_id_themes_discussion() {
      window.location.href = "?id_theme="+document.getElementById('id_themes_discussion').value;
    }

    new EmojiPicker({
        trigger: [
            {
                selector: '.emoji',
                insertInto: ['#commenter']
            }
        ],
        closeButton: true,
        //specialButtons: green
    });

    $(document).ready(function(){
      // $("#formChangementMotDePasse").submit(function(){
      //   $("#loader").removeClass("visible");
      //   $("#container").addClass("opacity");
      // });
      // $("#form_changer_photo_de_profil").submit(function(){
      //   $("#loader").removeClass("visible");
      //   $("#container").addClass("opacity");
      // });
      // $("#formChangementDeProfil").submit(function(){
      //   $("#loader").removeClass("visible");
      //   $("#container").addClass("opacity");
      // });
      let scroll_commentaire = document.getElementById('commentaire');
      scroll_commentaire.scrollTop = scroll_commentaire.scrollHeight;
    });
	</script>
</body>
</html>