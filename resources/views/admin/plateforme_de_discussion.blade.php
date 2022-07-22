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
    @include('admin.header')
    <div class="container-fluid page-body-wrapper">
        @include('admin.nav-gauche')
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
                                  <tr style="background-color: lightgray">
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
                                    <td style="width: 0px" onclick="let queryParams = new URLSearchParams(window.location.search), id_sujet={{ $sujet[$i]->id }};queryParams.set('id_sujet', id_sujet);history.replaceState(null, null, '?' + queryParams.toString());window.location.reload();">
                                      <button type="button" style="border: none; background-color: #ffffff00">
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAACZUlEQVRoge2YwUsUcRTHP29KD2FQUIdcyDp3iNZ0BaHsoHbt4CU6pMSeXclY6uIhgkREsMBdAoVO0SUqMluDiDBUsv4BCRfSxVhU7FBszesgwsw66cy2O7tb87n93nvD7/ud95v3g4GAgICAgP8ZcQoOz62cB/O6iLSiHPZblA1hDZV3gg71Nte/3ZnOY3huOS5wxylXZhTVeCwSGrQGbSJHZpc7VZjMj1cQKqKdvU2h1HbAsGZNkX4qVzyAqEq/NWDkZSP+6imIFuvCZgChzlcphXHQujD+VFUtVL2B/V6KpxIJVtPpUmkB4GhDAxejUdf1njqgUvoB5XULTx3w8mb8ouq/gcBAuQmmULEJplC1ERgoN75NIa/TxS2+TaFSDbBgCpWbf87AZllUeGPDurAZUGTOXy0FYdNo74Cpg4D6qcYjiqjtz5zNQF9L/StU4ziYmEokeJlM7rnDZjbL89FRV7UeUZAbsabQtDW44yOORUKDAm0gz4Dsdnw1nebr0tKuO6wsLjI5NsZaJoOaZrGEZ0GeGgbnYs3HhvKTrq+XcHu3Aiykxh2fCXf0RFG9B9QovDC05vKH6eSGU20x8XSROXGqq6u2dr3uPqrXABXk7kLr8ZsMDBStBbvxVwYa26JHzPXc460jx3dFowup8Yek9ny0aBRs4Exnz2k1c08ETgBfTFMvfXo9MV9Eba4o6CZubL/aJabOsCV+Zl9Oz5ZDPBRgINzRfVuRR8ABhQc/Dn27MP9mIlMCba5wfYQE/azISZRbwE9V7fs4PTFaQm2ucN2BXyJXEN4Ds2JIRyWID6gEfgMQ5MIVabyvzQAAAABJRU5ErkJggg==">
                                      </button>
                                    </td>
                                    <td style="width: 0px">
                                      <button data-bs-toggle="modal" data-bs-target="#modalModificationSujet{{$sujet[$i]->id}}" type="button" style="border: none; background-color: #ffffff00">
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAABmJLR0QA/wD/AP+gvaeTAAAGnElEQVR4nO2aW2wcVxnHf2du612vvbvEdhMndmInrilpUwpNojQKDSpSGwkJaJtKBVVUQoKCmhYoDxXigScCqDyAEC88tIEHeEIVIlWi1IS0aQihpU1iJ3XS5tLYji87G2/svc3OzOFhWTvrSzN7s9dl/9JoZs7MfOf7/893vjlnzkAdddRRRx111FFHHf+fEMvtgFfIp3/a4LYN/0boYifqzcsiEP2GePH1eLl2V4QA8idPdUmn7T2ccPNMoXojLUID94sXDw+UY1sp27sqQ/7soTul23KugDyAE2lwT+nvyH2bP1OO/ZqMgL5/DuzRFOUlAV1NsTHfxnfPKsHJyYJ75FQCzp6H5kRG6bm2Tfx68EwpddWcAP84cf5JoYkDgJ4vU2ybu0+8RWh8PFfguMgz5yCVzp2HpzPKPVc/J/Z/cK7Y+mqqC/Sd6J9HHsDVNPof2Em8rQ1cF/n+xVnyAJNBn3t6w3/k871biq2zZgQ4cqL/YU1V/8At5AN+H9u2dLPjvk00hoL073iAaDwB8amCZ10ksZjuGxpoOxX9Xs9dxdRbMwLoqvoLhNDy5wG/jy2962jw6eiaSks4yPhUmmN7vsxER8fMc2nX5Wo6RTRrMX3D8CWuRI4WU2/NCCCQG/LHAb/Blt51GHpOD9txGbwyipW1sXWdN/c+wURHBxnXZdhKkZXujJ3keNMdQ49uX+e13poQQB7atSbkfDAT+ndtbC8gf/ztQaKx2bC3dZ2/f/VrnFkVxpFynj1rOJj1WveyCyAPbl2NL3DszuxfAppMArOvJsdxeevtQUYnCgd8WctiLB7j1MOPEFuzpuCaP5K81P2vvjGv9avluV8e5Gu7WgmEjiH0Xp0kEfcCE+q9RG9aZKws7w5cYdwsTHhZy8I0x5Gui6sojHVvJDJ6Hf/0NEZzJtUQULb+6sJHnofIyyaAPLh1NYHm4wi9N19myCki7gVG5GYuDU0ylUgXPJPNZomZE0h3ts+7ikK0s5Pu62etcNfEjtV/emewGD+WpQvkWn7VUYTeM/da0PmIzSPPQMYsKM9aFmZ0DNd15tnL+P2c3rNnf9vvB94r1pclF0C+tqsVf+MbCO3T8y86YJ4inPo3u5P78MlcJN8a9othtKFzqBR/llQAL+TzLR9xLrI78RwiE70teYEwLVf9ayk+LVkOKIZ8HsIyccZOMqJuxxXGYqZTmlD2/vCZx0uaDC2JAKWQz2RhOAa6O0mre5pRbQfOfBFSQjEe+/53Hjtcqm9VF6AU8uksDMUgH/U+GafVOcOE9lls0ZgrFEwYqtj7/LcfL5l8zkwVUQnyt8IV/ssnQ/tfisu108lM8uCPn/2mOf+u4lA1AUoN+6EYOAuQF4IPFfjiphe4Vkk/qyLASiEPVRCg1LAfXgbyUGEBVhp5qOBASL5MGHvs9QXJOxmInqw58lChCJAvE8bgCHA/RhgCnaA35Vo9Y0LiCriFU/RaIA8VEKCAvEfUCnkoU4CVTh5Au/0tC6Ma5IXO7k3PUdKsrlSUFAHVIt+zxOShBAE+SeShSAE+aeSh2HGAwatUiDyCC67NF5aTfM4Nj5CHV23HME4yMgrM/xY/F7Xe8nl4jwDD+BGhMKxtB/Hxuq2Els/D+2tQN7YB0NwMqgZD1xactHto+Yd6XmCkZI8rjGIioH3muDEAnZ2gFn5QWilhfys8CSCPtN6HphVGi98P69fD/9bwUtbHz+f9AR6sNfLgtQso+tfnFllZSSqrk27qIHV5CCu58HpknnzHdxkuz9XqwNNH0Udann1FNWRT46dMopMOo6bNjZsuiZRLxhY4jY2QTIFTuGpT6+TBowBfWfutX57t+5Jih/qRDSbzVqSFAk1BSKfBtnNFK4A8eMgBH/58b8gc7lDjyTRHDzxJ9Or6RSyp0L4GAn50jUFDYVetkwcPAkjJ5+2sTtKZxs4YHP/jU4uK4MNJR1qDf+uKsHPDD7hecW+rAE8jwVef+F124FxoJmFqPosHn35Ftq+9lNAV+33VtfsU3AMtj5rnq+dqdeDpLdB1z6G7fZHuQ+m0LxwOxy8Gms0/B82233buO2ZV28E66qijqqjkwogPCAANczY/ufGGIJdz8nuY/Ss0P4y0yc2183sHSAHpOVsSyFTC6XIECAJ3AC1ACFj0D4YqwQLiQBQYBRKlGClVgHuBdWU8X2lI4BpQ9F8ipS6N3f6T0ApBOS3YCKxm+bpABrjJMnWBhbBYEmxg8eQ3NwkulAznJsCKJsH/AkGXPeA8Fy3tAAAAAElFTkSuQmCC">
                                      </button>
                                    </td>
                                    <td style="width: 0px">
                                      <button data-bs-toggle="modal" data-bs-target="#modalValiderSuppressionSujet{{$sujet[$i]->id}}" type="button" style="border: none; background-color: #ffffff00">
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAAD30lEQVRoge2YT0xcVRTGf/feCe3MEHdE2g6Dy0Y3blzoorUMRQiJy8YulEQTYnCltVKQUv4EEmuhLoxpk7qx0cTqzqSiAlZMdeHGpNG1dqZqrAubwLxh5N3jAosMb+a9287LKIEvuclk5uTc77vnO++eN7CLXexsqLgS3Xn6mV4tXAQOROxY0CL96U8+/DSOfRNxJAFQf/kXJIr8OjJrcBHIxrFvbAJkbS1zD+Ftce0baSG5cqUJaydR6llE9sW1cQR+QanLKDWqjh0rhwVGV0BkAngNkbjIuWA/IoP/fD4VFqgdkj1XP5/7hEhfVEi0gMbZphpaowKcHqO3Hnq0of65iwM/fR/Jz+0ppGK7LmKHkwC13QXEd1/Hj51hoW0vQIV4SICi+KxaIak1SRX+ZPbE4lnLHq1IKVO3O10usvUKVFmiFMtiaX7lJQ7euI7q6WQFWzPeQ1A9nRy8cZ30ywMsi0VqxLpWvS4LFcXngRMDPPji8wC0n5/iZwXFuUVSWypRFIvuydE+O4UyhtaBF1AKlt+6QFoZJxrV4FSBWgdURmjpO/5vnDG0z05hejrwsBtxHhbT07FB/i5a+o5TFltPAeqzUFIb8kMTiO9XiMjOTKG7cxQRigi6O0d2ppK8+D754UmSJlGXhZyifnv48ZqjhCcWOg/Tfn56C0FL/tQYUi6Tnd1K3pIfPIN/9YuA1Taj9cdvI/m5CXjkidBZyBOLeuoI2TcnA6cMBL67efI0du5LUjrcAK0/fBPJz7EHVOhKaQOfX+PmiZGAnQInPzSOfHaNtDGReV3g2APRK6k1LHwVEFFJfgx7dZ6U0U45XRDzTRzefEpp5J7yRcOtAg7H5YlA7kmy5yr7YCOD0WSmR0n0drHiW6ecsQmI8moJQXUdIXtuItCwlT2hyUyfxnR3ULS2kT1Q+7r3RKDzEG1vjFWSt5bC65PkT44GGrvt7Dim9yhFkdDcMQqovjyx0HWYtrPBk88PnsHOLSKLX6/fB5tFaE1magR19BAlbF1NXJeFSmLJTAwHyBeGxmF+ibQxpI2B+SUKQ+OBSuwfeZVVqW2l2ATUKvEebfjj/Y8C5GV+iZQxG3EpY5AqIm5fukyTMo2wUPUNUokEK++8y++X3sMWPQrDE8hCJfnNIlhYF7H25x1+nXmb0gcfk0w0YBa6/Viu5ighQNH3WRVLymj2RozGJfEpWUsTmqQJf6Fp+W4hkp/jvxIhvwHNCUMzbjN9UhmS+v7n/63YGe/E215A2Ev9f42dUYH/swC3e0BTcBoe41352AQoUf1KqULU9BjjyqN0vwu3XexiF9scfwNH0V60TyzEiwAAAABJRU5ErkJggg==">
                                      </button>
                                    </td>
                                  </tr>
                                @else
                                  <tr>
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
                                    <td style="width: 0px" onclick="let queryParams = new URLSearchParams(window.location.search), id_sujet={{ $sujet[$i]->id }};queryParams.set('id_sujet', id_sujet);history.replaceState(null, null, '?' + queryParams.toString());window.location.reload();">
                                      <button type="button" style="border: none; background-color: #ffffff00">
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAACZUlEQVRoge2YwUsUcRTHP29KD2FQUIdcyDp3iNZ0BaHsoHbt4CU6pMSeXclY6uIhgkREsMBdAoVO0SUqMluDiDBUsv4BCRfSxVhU7FBszesgwsw66cy2O7tb87n93nvD7/ud95v3g4GAgICAgP8ZcQoOz62cB/O6iLSiHPZblA1hDZV3gg71Nte/3ZnOY3huOS5wxylXZhTVeCwSGrQGbSJHZpc7VZjMj1cQKqKdvU2h1HbAsGZNkX4qVzyAqEq/NWDkZSP+6imIFuvCZgChzlcphXHQujD+VFUtVL2B/V6KpxIJVtPpUmkB4GhDAxejUdf1njqgUvoB5XULTx3w8mb8ouq/gcBAuQmmULEJplC1ERgoN75NIa/TxS2+TaFSDbBgCpWbf87AZllUeGPDurAZUGTOXy0FYdNo74Cpg4D6qcYjiqjtz5zNQF9L/StU4ziYmEokeJlM7rnDZjbL89FRV7UeUZAbsabQtDW44yOORUKDAm0gz4Dsdnw1nebr0tKuO6wsLjI5NsZaJoOaZrGEZ0GeGgbnYs3HhvKTrq+XcHu3Aiykxh2fCXf0RFG9B9QovDC05vKH6eSGU20x8XSROXGqq6u2dr3uPqrXABXk7kLr8ZsMDBStBbvxVwYa26JHzPXc460jx3dFowup8Yek9ny0aBRs4Exnz2k1c08ETgBfTFMvfXo9MV9Eba4o6CZubL/aJabOsCV+Zl9Oz5ZDPBRgINzRfVuRR8ABhQc/Dn27MP9mIlMCba5wfYQE/azISZRbwE9V7fs4PTFaQm2ucN2BXyJXEN4Ds2JIRyWID6gEfgMQ5MIVabyvzQAAAABJRU5ErkJggg==">
                                      </button>
                                    </td>
                                    <td style="width: 0px">
                                      <button data-bs-toggle="modal" data-bs-target="#modalModificationSujet{{$sujet[$i]->id}}" type="button" style="border: none; background-color: #ffffff00">
                                        <img src="data:image/png;base64,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">
                                      </button>
                                    </td>
                                    <td style="width: 0px">
                                      <button data-bs-toggle="modal" data-bs-target="#modalValiderSuppressionSujet{{$sujet[$i]->id}}" type="button" style="border: none; background-color: #ffffff00">
                                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAAD30lEQVRoge2YT0xcVRTGf/feCe3MEHdE2g6Dy0Y3blzoorUMRQiJy8YulEQTYnCltVKQUv4EEmuhLoxpk7qx0cTqzqSiAlZMdeHGpNG1dqZqrAubwLxh5N3jAosMb+a9287LKIEvuclk5uTc77vnO++eN7CLXexsqLgS3Xn6mV4tXAQOROxY0CL96U8+/DSOfRNxJAFQf/kXJIr8OjJrcBHIxrFvbAJkbS1zD+Ftce0baSG5cqUJaydR6llE9sW1cQR+QanLKDWqjh0rhwVGV0BkAngNkbjIuWA/IoP/fD4VFqgdkj1XP5/7hEhfVEi0gMbZphpaowKcHqO3Hnq0of65iwM/fR/Jz+0ppGK7LmKHkwC13QXEd1/Hj51hoW0vQIV4SICi+KxaIak1SRX+ZPbE4lnLHq1IKVO3O10usvUKVFmiFMtiaX7lJQ7euI7q6WQFWzPeQ1A9nRy8cZ30ywMsi0VqxLpWvS4LFcXngRMDPPji8wC0n5/iZwXFuUVSWypRFIvuydE+O4UyhtaBF1AKlt+6QFoZJxrV4FSBWgdURmjpO/5vnDG0z05hejrwsBtxHhbT07FB/i5a+o5TFltPAeqzUFIb8kMTiO9XiMjOTKG7cxQRigi6O0d2ppK8+D754UmSJlGXhZyifnv48ZqjhCcWOg/Tfn56C0FL/tQYUi6Tnd1K3pIfPIN/9YuA1Taj9cdvI/m5CXjkidBZyBOLeuoI2TcnA6cMBL67efI0du5LUjrcAK0/fBPJz7EHVOhKaQOfX+PmiZGAnQInPzSOfHaNtDGReV3g2APRK6k1LHwVEFFJfgx7dZ6U0U45XRDzTRzefEpp5J7yRcOtAg7H5YlA7kmy5yr7YCOD0WSmR0n0drHiW6ecsQmI8moJQXUdIXtuItCwlT2hyUyfxnR3ULS2kT1Q+7r3RKDzEG1vjFWSt5bC65PkT44GGrvt7Dim9yhFkdDcMQqovjyx0HWYtrPBk88PnsHOLSKLX6/fB5tFaE1magR19BAlbF1NXJeFSmLJTAwHyBeGxmF+ibQxpI2B+SUKQ+OBSuwfeZVVqW2l2ATUKvEebfjj/Y8C5GV+iZQxG3EpY5AqIm5fukyTMo2wUPUNUokEK++8y++X3sMWPQrDE8hCJfnNIlhYF7H25x1+nXmb0gcfk0w0YBa6/Viu5ighQNH3WRVLymj2RozGJfEpWUsTmqQJf6Fp+W4hkp/jvxIhvwHNCUMzbjN9UhmS+v7n/63YGe/E215A2Ev9f42dUYH/swC3e0BTcBoe41352AQoUf1KqULU9BjjyqN0vwu3XexiF9scfwNH0V60TyzEiwAAAABJRU5ErkJggg==">
                                      </button>
                                    </td>
                                  </tr>
                                @endif
                              @else
                                <tr>
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
                                  <td style="width: 0px" onclick="let queryParams = new URLSearchParams(window.location.search), id_sujet={{ $sujet[$i]->id }};queryParams.set('id_sujet', id_sujet);history.replaceState(null, null, '?' + queryParams.toString());window.location.reload();">
                                    <button type="button" style="border: none; background-color: #ffffff00">
                                      <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAACZUlEQVRoge2YwUsUcRTHP29KD2FQUIdcyDp3iNZ0BaHsoHbt4CU6pMSeXclY6uIhgkREsMBdAoVO0SUqMluDiDBUsv4BCRfSxVhU7FBszesgwsw66cy2O7tb87n93nvD7/ud95v3g4GAgICAgP8ZcQoOz62cB/O6iLSiHPZblA1hDZV3gg71Nte/3ZnOY3huOS5wxylXZhTVeCwSGrQGbSJHZpc7VZjMj1cQKqKdvU2h1HbAsGZNkX4qVzyAqEq/NWDkZSP+6imIFuvCZgChzlcphXHQujD+VFUtVL2B/V6KpxIJVtPpUmkB4GhDAxejUdf1njqgUvoB5XULTx3w8mb8ouq/gcBAuQmmULEJplC1ERgoN75NIa/TxS2+TaFSDbBgCpWbf87AZllUeGPDurAZUGTOXy0FYdNo74Cpg4D6qcYjiqjtz5zNQF9L/StU4ziYmEokeJlM7rnDZjbL89FRV7UeUZAbsabQtDW44yOORUKDAm0gz4Dsdnw1nebr0tKuO6wsLjI5NsZaJoOaZrGEZ0GeGgbnYs3HhvKTrq+XcHu3Aiykxh2fCXf0RFG9B9QovDC05vKH6eSGU20x8XSROXGqq6u2dr3uPqrXABXk7kLr8ZsMDBStBbvxVwYa26JHzPXc460jx3dFowup8Yek9ny0aBRs4Exnz2k1c08ETgBfTFMvfXo9MV9Eba4o6CZubL/aJabOsCV+Zl9Oz5ZDPBRgINzRfVuRR8ABhQc/Dn27MP9mIlMCba5wfYQE/azISZRbwE9V7fs4PTFaQm2ucN2BXyJXEN4Ds2JIRyWID6gEfgMQ5MIVabyvzQAAAABJRU5ErkJggg==">
                                    </button>
                                  </td>
                                  <td style="width: 0px">
                                    <button data-bs-toggle="modal" data-bs-target="#modalModificationSujet{{$sujet[$i]->id}}" type="button" style="border: none; background-color: #ffffff00">
                                      <img src="data:image/png;base64,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">
                                    </button>
                                  </td>
                                  <td style="width: 0px">
                                    <button data-bs-toggle="modal" data-bs-target="#modalValiderSuppressionSujet{{$sujet[$i]->id}}" type="button" style="border: none; background-color: #ffffff00">
                                      <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAAD30lEQVRoge2YT0xcVRTGf/feCe3MEHdE2g6Dy0Y3blzoorUMRQiJy8YulEQTYnCltVKQUv4EEmuhLoxpk7qx0cTqzqSiAlZMdeHGpNG1dqZqrAubwLxh5N3jAosMb+a9287LKIEvuclk5uTc77vnO++eN7CLXexsqLgS3Xn6mV4tXAQOROxY0CL96U8+/DSOfRNxJAFQf/kXJIr8OjJrcBHIxrFvbAJkbS1zD+Ftce0baSG5cqUJaydR6llE9sW1cQR+QanLKDWqjh0rhwVGV0BkAngNkbjIuWA/IoP/fD4VFqgdkj1XP5/7hEhfVEi0gMbZphpaowKcHqO3Hnq0of65iwM/fR/Jz+0ppGK7LmKHkwC13QXEd1/Hj51hoW0vQIV4SICi+KxaIak1SRX+ZPbE4lnLHq1IKVO3O10usvUKVFmiFMtiaX7lJQ7euI7q6WQFWzPeQ1A9nRy8cZ30ywMsi0VqxLpWvS4LFcXngRMDPPji8wC0n5/iZwXFuUVSWypRFIvuydE+O4UyhtaBF1AKlt+6QFoZJxrV4FSBWgdURmjpO/5vnDG0z05hejrwsBtxHhbT07FB/i5a+o5TFltPAeqzUFIb8kMTiO9XiMjOTKG7cxQRigi6O0d2ppK8+D754UmSJlGXhZyifnv48ZqjhCcWOg/Tfn56C0FL/tQYUi6Tnd1K3pIfPIN/9YuA1Taj9cdvI/m5CXjkidBZyBOLeuoI2TcnA6cMBL67efI0du5LUjrcAK0/fBPJz7EHVOhKaQOfX+PmiZGAnQInPzSOfHaNtDGReV3g2APRK6k1LHwVEFFJfgx7dZ6U0U45XRDzTRzefEpp5J7yRcOtAg7H5YlA7kmy5yr7YCOD0WSmR0n0drHiW6ecsQmI8moJQXUdIXtuItCwlT2hyUyfxnR3ULS2kT1Q+7r3RKDzEG1vjFWSt5bC65PkT44GGrvt7Dim9yhFkdDcMQqovjyx0HWYtrPBk88PnsHOLSKLX6/fB5tFaE1magR19BAlbF1NXJeFSmLJTAwHyBeGxmF+ibQxpI2B+SUKQ+OBSuwfeZVVqW2l2ATUKvEebfjj/Y8C5GV+iZQxG3EpY5AqIm5fukyTMo2wUPUNUokEK++8y++X3sMWPQrDE8hCJfnNIlhYF7H25x1+nXmb0gcfk0w0YBa6/Viu5ighQNH3WRVLymj2RozGJfEpWUsTmqQJf6Fp+W4hkp/jvxIhvwHNCUMzbjN9UhmS+v7n/63YGe/E215A2Ev9f42dUYH/swC3e0BTcBoe41352AQoUf1KqULU9BjjyqN0vwu3XexiF9scfwNH0V60TyzEiwAAAABJRU5ErkJggg==">
                                    </button>
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
                      <form action="{{ asset('/administrateur/plateforme-de-discussion/publier-sujet') }}" method="post">
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
                      <button class="btn btn-sm btn-primary" type="button" onclick="document.getElementById('rowAjoutTheme').removeAttribute('style')">Ajouter un thème</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row" style="display: none" id="rowAjoutTheme">
                <div class="col-md-12 mb-4 stretch-card">
                  <div class="card">
                    <div class="card-body" style="margin: 1%">
                      <h3>Nouveau thème de discussion</h3><br>
                      <div class="form-group">
                        <form action="{{ asset('/administrateur/plateforme-de-discussion/ajouter-theme') }}" method="post">
                          @csrf
                          <div class="input-group">
                            <input class="form-control" name="theme" placeholder="Écrivez ici votre nouveau thème de discussion"/>
                            <div class="input-group-append">
                              <button class="btn btn-sm btn-primary" type="submit">Ajouter</button>
                            </div>
                          </div>
                        </form>
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
                            @if (isset($utilisateur_commentaire[$i]->est_admin))
                              @if ($utilisateur_commentaire[$i]->est_admin)
                                @if ($utilisateur_commentaire[$i]->id_admin == request()->session()->get('administrateur')->id)
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
                                      <img style="border-radius: 50%; height: 25px; width: 25px" src="{{asset('images/photo_de_profil/'.$utilisateur_commentaire[$i]->photo_de_profil)}}"/>
                                      <div class="ownBubble other">
                                          <?php
                                            $varTexteArea= str_replace('<br />', '<br/>', nl2br($commentaire[$i]->commentaire));
                                            echo $varTexteArea;
                                          ?>
                                        </div>
                                      </div><span class="own">{{ $commentaire[$i]->date }}</span>
                                  </div>
                                @endif
                              @else
                                <div class="bubbleWrapper">
                                  <div class="inlineContainer hovertext" data-hover="{{ $utilisateur_commentaire[$i]->prenom }} {{ $utilisateur_commentaire[$i]->nom }}">
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
                            @else
                              <div class="bubbleWrapper">
                                <div class="inlineContainer hovertext" data-hover="{{ $utilisateur_commentaire[$i]->prenom }} {{ $utilisateur_commentaire[$i]->nom }}">
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
                        <form action="{{ asset('/administrateur/plateforme-de-discussion/commenter') }}" method="post">
                          @csrf
                          <input type="hidden" name="id_sujet" value="<?php if(isset($_GET['id_sujet'])) { echo $_GET['id_sujet']; } else { echo $sujet[0]->id; } ?>">
                          <textarea class="form-control" name="commentaire" id="commenter" style="width: 100%" rows="10" wrap="on" placeholder="Votre commentaire ..."></textarea>
                          {{-- <img height="30 px" class="emoji" src="data:image/png;base64,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"> --}}
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


  {{-- modal --}}
    @for ($i = 0; $i < count($sujet); $i++)
      <div class="modal fade" id="modalValiderSuppressionSujet{{ $sujet[$i]->id }}" style="border-radius: 10%">
        <div class="modal-dialog">
            <div class="modal-content">
              <form action="{{ asset('/administrateur/plateforme-de-discussion/sujet/suppression') }}" method="post">
                @csrf
                <input type="hidden" name="id_sujet" value="{{ $sujet[$i]->id }}">
                <div class="modal-header">
                  <h5 class="modal-title">Confirmation de suppression de sujet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <h6>Voulez-vous vraiment supprimer ce sujet?</h6>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-inverse-danger btn-fw" data-bs-dismiss="modal">Oui</button>
                <button type="button" class="btn btn-inverse-info btn-fw" data-bs-dismiss="modal">Non</button>
                </div>
              </form>
            </div>
        </div>
      </div>

      <div class="modal fade" id="modalModificationSujet{{ $sujet[$i]->id }}" style="border-radius: 10%">
        <div class="modal-dialog">
            <div class="modal-content">
              <form action="{{ asset('/administrateur/plateforme-de-discussion/sujet/modification') }}" method="post">
                @csrf
                <input type="hidden" name="id_sujet" value="{{ $sujet[$i]->id }}">
                <div class="modal-header">
                  <h5 class="modal-title">Modification de sujet</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <h6>Veuillez faire votre modification ci-dessous:</h6>
                  <p>
                      <textarea name="sujet" class="form-control" rows="4" id="modificationSujet{{$sujet[$i]->id}}" required>{{ $sujet[$i]->sujet }}</textarea>
                  </p>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-inverse-warning btn-fw">Modifier</button>
                <button type="button" class="btn btn-inverse-info btn-fw" data-bs-dismiss="modal">Annuler</button>
                </div>
              </form>
            </div>
        </div>
      </div>
    @endfor
  {{-- fin modal --}}


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
  <script src="https://js.pusher.com/7.1/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = false;

    var pusher = new Pusher('9bf2d9ab257d9048b8bd', {
      cluster: 'eu'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      const id_sujet = data.id_sujet;
      const photo = data.photo;
      const nom_prenom = data.nom_prenom;
      const coms = data.commentaire;
      const date_heure = data.date_heure;
      <?php if (isset($_GET['id_sujet'])) { ?>
        if (id_sujet == <?php echo $_GET['id_sujet']  ?>) {
          var com = "";
          com += `<div class="bubbleWrapper">`;
                    com += `<div class="inlineContainer hovertext" data-hover="${nom_prenom}">`;
                      com += `<img style="border-radius: 50%; height: 25px; width: 25px" src="{{ asset('images/photo_de_profil/${photo}') }}"/>`;
                      com += `<div class="otherBubble other">`;
                        com += `<?php $varTexteArea= str_replace("<br />", "<br/>", nl2br('${coms}')); echo $varTexteArea; ?>`;
                      com += `</div>`;
                    com += `</div><span class="other">${date_heure}</span>`;
                  com += `</div>`;
          document.getElementById("commentaire").innerHTML += com;
          let scroll_commentaire = document.getElementById('commentaire');
          scroll_commentaire.scrollTop = scroll_commentaire.scrollHeight;
        }
      <?php } ?>
    });
    
    function change_id_themes_discussion() {
      window.location.href = "?id_theme="+document.getElementById('id_themes_discussion').value;
    }

    // function modifier_sujet(id_sujet) {
    //   console.log('modifier sujet '+id_sujet);
    // }

    // function supprimer_sujet(id_sujet) {
    //   console.log('supprimer sujet '+id_sujet);
    // }

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