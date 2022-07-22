@for ($i = 0; $i < count($utilisateurs); $i++)
    {{-- modal Plus --}}
    <div class="modal fade" id="modal{{ $utilisateurs[$i]->id }}" style="border-radius: 10%">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Plus d'informations sur l'utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <p>
                            <image src="{{asset('images/photo_de_profil/'.$utilisateurs[$i]->photo_de_profil)}}" alt="Photo_de_profil" style="height: 150px; width: 150px; float: right"/>
                        </p>
                        <p>
                            <b>Nom : </b>
                            {{ $utilisateurs[$i]->nom }}
                        </p>
                        <p>
                            <b>Prénom(s) : </b>
                            {{ $utilisateurs[$i]->prenom }}
                        </p>
                        <p>
                            <b>Fonction : </b>
                            {{-- <button class="btn btn-info" disabled><b>en tant que {{ $fonctions[$i]->nom }}</b></button> --}}
                            <e class="badge badge-warning">{{ $fonctions[$i]->nom }}</e>
                        </p>
                        <p>
                            <b>Région : </b>
                            {{ $regions[$i]->nom }}
                        </p>
                        <p>
                            <b>District : </b>
                            {{ $districts[$i]->nom }}
                        </p>
                        <p>
                            <b>Ministère : </b>
                            {{ $utilisateurs[$i]->ministere }}
                        </p>
                        <p>
                            <b>Direction : </b>
                            {{ $utilisateurs[$i]->direction }}
                        </p>
                        <p>
                            <b>Lieu de travail : </b>
                            {{ $utilisateurs[$i]->lieu_de_travail }}
                        </p>
                        <p>
                            <b>Téléphone 1 : </b>
                            <a href="tel:{{ $utilisateurs[$i]->telephone1 }}">{{ $utilisateurs[$i]->telephone1 }}</a>
                        </p>
                        <p>
                            <b>Téléphone 2 : </b>
                            <a href="tel:{{ $utilisateurs[$i]->telephone2 }}">{{ $utilisateurs[$i]->telephone2 }}</a>
                        </p>
                        <p>
                            <b>Téléphone 3 : </b>
                            <a href="tel:{{ $utilisateurs[$i]->telephone3 }}">{{ $utilisateurs[$i]->telephone3 }}</a>
                        </p>
                        <p>
                            <b>Adresse mail : </b>
                            <a href="mailto:{{ $utilisateurs[$i]->email }}">{{ $utilisateurs[$i]->email }}</a>
                        </p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-inverse-danger btn-fw" data-bs-toggle="modal" data-bs-target="#modalValiderSuppression{{ $utilisateurs[$i]->id }}" data-bs-dismiss="modal">Supprimer</button>
                    <button type="submit" class="btn btn-inverse-warning btn-fw" data-bs-toggle="modal" data-bs-target="#modalModif{{ $utilisateurs[$i]->id }}" data-bs-dismiss="modal">Modifier sa fonction</button>
                    <button type="submit" class="btn btn-inverse-info btn-fw" data-bs-dismiss="modal" autofocus>Fermer</button>
                </div>
            </div>
        </div>
    </div>
    {{-- fin modal Plus --}}

    {{-- modal Modif --}}
    <div class="modal fade" id="modalModif{{ $utilisateurs[$i]->id }}" style="border-radius: 10%">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Formulaire de modification de profil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <p>
                            <image src="{{asset('images/photo_de_profil/'.$utilisateurs[$i]->photo_de_profil)}}" alt="Photo_de_profil" style="height: 150px; width: 150px; float: right"/>
                        </p>
                        <p>
                            <b>Nom : </b>
                            {{ $utilisateurs[$i]->nom }}
                        </p>
                        <p>
                            <b>Prénom(s) : </b>
                            {{ $utilisateurs[$i]->prenom }}
                        </p>
                        <p>
                            <b>Fonction : </b>
                            <select class="input100" style="border-color: rgba(0, 0, 0, 0.178);" id="fonctionModif{{ $utilisateurs[$i]->id }}">
                            @for ($j = 0; $j < count($allFonctions); $j++)
                                @if ($fonctions[$i]->id ==  $allFonctions[$j]->id)
                                <option value="{{ $allFonctions[$j]->id }}" selected>{{ $allFonctions[$j]->nom }}</option>
                                @else
                                <option value="{{ $allFonctions[$j]->id }}">{{ $allFonctions[$j]->nom }}</option>
                                @endif
                            @endfor
                            </select>
                        </p>
                        <p>
                            <b>Région : </b>
                            {{ $regions[$i]->nom }}
                        </p>
                        <p>
                            <b>District : </b>
                            {{ $districts[$i]->nom }}
                        </p>
                        <p>
                            <b>Ministère : </b>
                            {{ $utilisateurs[$i]->ministere }}
                        </p>
                        <p>
                            <b>Direction : </b>
                            {{ $utilisateurs[$i]->direction }}
                        </p>
                        <p>
                            <b>Lieu de travail : </b>
                            {{ $utilisateurs[$i]->lieu_de_travail }}
                        </p>
                        <p>
                            <b>Téléphone 1 : </b>
                            <a href="tel:{{ $utilisateurs[$i]->telephone1 }}">{{ $utilisateurs[$i]->telephone1 }}</a>
                        </p>
                        <p>
                            <b>Téléphone 2 : </b>
                            <a href="tel:{{ $utilisateurs[$i]->telephone2 }}">{{ $utilisateurs[$i]->telephone2 }}</a>
                        </p>
                        <p>
                            <b>Téléphone 3 : </b>
                            <a href="tel:{{ $utilisateurs[$i]->telephone3 }}">{{ $utilisateurs[$i]->telephone3 }}</a>
                        </p>
                        <p>
                            <b>Adresse mail : </b>
                            <a href="mailto:{{ $utilisateurs[$i]->email }}">{{ $utilisateurs[$i]->email }}</a>
                        </p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-inverse-warning btn-fw" data-bs-toggle="modal" data-bs-target="#modalValiderMofification{{ $utilisateurs[$i]->id }}" data-bs-dismiss="modal">Modifier</button>
                    <button type="submit" class="btn btn-inverse-info btn-fw" data-bs-dismiss="modal" autofocus>Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <form action="{{asset('/administrateur/utilisateur/modification-fonction')}}" method="POST" id="formModification">
        @csrf
        <input type="hidden" name="id_utilisateur" value="{{ $utilisateurs[$i]->id }}">
        <input type="hidden" name="id_fonction" id="nouveauFonction{{ $utilisateurs[$i]->id }}">
        <input type="submit" value="Modifier" id="modification{{ $utilisateurs[$i]->id }}" style="display: none">
    </form>
    {{-- fin modal Modif --}}

    {{-- modal Validation Modif --}}
    <div class="modal fade" id="modalValiderMofification{{ $utilisateurs[$i]->id }}" style="border-radius: 10%">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title">Confirmation de modification de profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                <h4>Voulez-vous vraiment modifier la fonction de l'utilisateur?</h4>
                </div>
                <div class="modal-footer">
                <button type="submit" class="btn btn-inverse-warning btn-fw" onclick="document.getElementById('nouveauFonction'+{{ $utilisateurs[$i]->id }}).value = document.getElementById('fonctionModif'+{{ $utilisateurs[$i]->id }}).value;$('#modification'+{{ $utilisateurs[$i]->id }}).click();" data-bs-dismiss="modal">Oui</button>
                <button type="submit" class="btn btn-inverse-info btn-fw" data-bs-dismiss="modal">Non</button>
                </div>
            </div>
        </div>
    </div>
    {{-- fin modal Validation Modif --}}
    
    {{-- modal Validation Suppression --}}
    <div class="modal fade" id="modalValiderSuppression{{ $utilisateurs[$i]->id }}" style="border-radius: 10%">
        <div class="modal-dialog">
            <div class="modal-content">
              <form action="{{asset('/administrateur/utilisateur/suppression')}}" method="POST" id="formSuppression">
                @csrf
                <input type="hidden" name="id_utilisateur" value="{{ $utilisateurs[$i]->id }}">
                <div class="modal-header">
                  <h5 class="modal-title">Confirmation de suppression d'utilisateur</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                  <h6>Voulez-vous vraiment supprimer cet utilisateur?</h6>
                  <h6>Veuillez écrire le motif ci-dessous:</h6>
                  <p>
                    <textarea name="motif" class="form-control" rows="4" id="motifTextarea{{$utilisateurs[$i]->id}}" required></textarea>
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-inverse-danger btn-fw">Oui</button>
                  <button type="button" class="btn btn-inverse-info btn-fw" data-bs-dismiss="modal">Non</button>
                </div>
              </form>
            </div>
        </div>
    </div>
    {{-- fin modal Validation Suppression --}}
@endfor

{{-- ajout --}}
<div class="modal fade" id="modalAjoutUtilisateur" style="border-radius: 10%">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Formulaire d'insertion d'utilisateur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{asset('/administrateur/inscription-utilisateur')}}" method="POST" id="formAjout">
                  @csrf
                  <div class="form-group row">
                    <div class="col">
                      <label>Nom</label>
                      <div id="the-basics">
                        <input class="typeahead" type="text" name="nom" placeholder="Votre nom" required>
                      </div>
                    </div>
                    <div class="col">
                      <label>Prénom(s)</label>
                      <div id="bloodhound">
                        <input class="typeahead" type="text" name="prenom" placeholder="Votre prénom" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label>Fonction</label>
                      <div id="the-basics">
                        <select class="typeahead" name="id_fonction" required>
                          <option value="">Fonction</option>
                          @for ($i = 0; $i < count($allFonctions); $i++)
                              <option value="{{ $allFonctions[$i]->id }}">{{ $allFonctions[$i]->nom }}</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                    <div class="col">
                      <label>Région</label>
                      <div id="bloodhound">
                        <select class="typeahead" name="id_region" id="id_regionAjout" onchange="showDistricts()" required>
                          <option value="">Région</option>
                          @for ($i = 0; $i < count($allRegions); $i++)
                              <option value="{{ $allRegions[$i]->id }}">{{ $allRegions[$i]->nom }}</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label>District</label>
                      <div id="the-basics">
                        <select class="typeahead" name="id_district" id="id_districtAjout" required>
                          <option value="">District</option>
                        </select>
                      </div>
                    </div>
                    <div class="col">
                      <label>Ministère</label>
                      <div id="bloodhound">
                        <select class="typeahead" name="ministere" required>
                          <option value="">Ministère</option>
                          @for ($i = 0; $i < count($allMinisteres); $i++)
                            <option value="{{ $allMinisteres[$i]->nom }}">{{ $allMinisteres[$i]->nom }}</option>
                          @endfor
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label>Direction</label>
                      <div id="the-basics">
                        <input class="typeahead" type="text" name="direction" placeholder="Direction" required>
                      </div>
                    </div>
                    <div class="col">
                      <label>Lieu de travail</label>
                      <div id="bloodhound">
                        <input class="typeahead" type="text" name="lieu_de_travail" placeholder="Lieu de travail" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label>Téléphone 1</label>
                      <div id="the-basics">
                        <input class="typeahead" type="tel" name="telephone1" id="phone1" onchange="document.getElementById('phone1').value = phoneInput1.getNumber()" required>
                      </div>
                    </div>
                    <div class="col">
                      <label>Téléphone 2</label>
                      <div id="bloodhound">
                        <input class="typeahead" type="tel" name="telephone2" id="phone2" onchange="document.getElementById('phone2').value = phoneInput2.getNumber()" required>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col">
                      <label>Téléphone 3</label>
                      <div id="the-basics">
                        <input class="typeahead" type="tel" name="telephone3" id="phone3" onchange="document.getElementById('phone3').value = phoneInput3.getNumber()" required>
                      </div>
                    </div>
                    <div class="col">
                      <label>Adresse mail</label>
                      <div id="bloodhound">
                        <input class="typeahead" type="email" name="email" placeholder="Adresse mail" required>
                      </div>
                    </div>
                  </div>
                  <input type="submit" value="Insérer" style="display: none" id="idFormAjout">
                </form>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-inverse-success btn-fw" data-bs-dismiss="modal" onclick="$('#idFormAjout').click()">Ajouter</button>
              <button type="submit" class="btn btn-inverse-info btn-fw" data-bs-dismiss="modal" autofocus>Fermer</button>
            </div>
        </div>
    </div>
</div>
{{-- finAjout --}}