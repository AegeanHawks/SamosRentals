
<div class="col s12 m8 tabregion" id="section_12">
    <ul class="collapsible" data-collapsible="accordion">
        <li>
            <div class="collapsible-header">
                <div id="id" class="col s1 truncate">ID</div>
                <div id="username" class="col s3 truncate">Ψευδώνυμο</div>
                <div id="name" class="col s2 truncate">Όνομα</div>
                <div id="lastname" class="col s3 truncate">Επώνυμο</div>
                <div id="email" class="col s3 truncate">E-mail</div>
            </div>
            <div class="collapsible-body">
                <div class="row col s12">
                    <div class="input-field col m4 l3 s12">
                        <i class="mdi-action-account-circle prefix"></i>
                        <input id="icon_prefix" type="text" class="validate">
                        <label for="icon_prefix">Όνομα</label>
                    </div>
                    <div class="input-field col m4 l3 s12">
                        <input id="icon_prefix" type="text" class="validate">
                        <label for="icon_prefix">Επώνυμο</label>
                    </div>
                    <div class="input-field col m4 l3 s12">
                        <i class="mdi-action-assignment-ind prefix"></i>
                        <input id="icon_prefix" type="text" class="validate">
                        <label for="icon_prefix">Ψευδώνυμο</label>
                    </div>
                    <div class="input-field col m4 l3 s12">
                        <i class="mdi-communication-vpn-key prefix"></i>
                        <input id="icon_prefix" type="password" class="validate">
                        <label for="icon_prefix">Κωδικός</label>
                    </div>
                    <div class="input-field col m4 l3 s12">
                        <i class="mdi-communication-email prefix"></i>
                        <input id="icon_prefix" type="email" class="validate">
                        <label for="icon_prefix">Email</label>
                    </div>
                    <div class="input-field col m4 l3 s12">
                        <i class="mdi-action-today prefix"></i>
                        <input id="icon_prefix" type="date" class="validate">
                    </div>
                    <div class="input-field col m4 l3 s12">
                        <i class="mdi-maps-local-phone prefix"></i>
                        <input id="icon_prefix" type="tel" class="validate">
                        <label for="icon_prefix">Τηλέφωνο</label>
                    </div>
                    <div class="input-field col m4 l3 s12">
                        <select>
                            <option value="1">Άνδρας</option>
                            <option value="2" selected>Γυναίκα</option>
                        </select>
                        <label>Φύλο</label>
                    </div>

                    <div class="col s12 m12">
                        <div class="col s2 m4">
                            <img class="circle responsive-img " src="images/website/avatar.jpg">
                        </div>
                        <div class="col s10 m8 file-field input-field">
                            <input class="file-path validate" type="text"/>

                            <div class="btn">

                                <span>File</span>
                                <input type="file"/>
                            </div>
                        </div>
                    </div>
                </div>
                <a onclick="Materialize.toast(\'<span>Η Αλλαγή Ολοκληρώθηκε!</span><a class=\\\'btn-flat yellow-text\\\' href=\\\'#!\\\'>Αναιρεση<a>\', 5000, \'rounded\')"
                   class="waves-effect green waves-light btn right"><i class="mdi-content-save left"></i>Αποθήκευση</a>
                <a class="waves-effect red waves-light btn modal-trigger left" href="#delete_question"><i
                        class="mdi-content-save left"></i>Διαγραφή</a>
            </div>
        </li>
        <li>
            <div class="collapsible-header">
                <div id="id" class="col s1 truncate">ID</div>
                <div id="username" class="col s3 truncate">Ψευδώνυμο</div>
                <div id="name" class="col s2 truncate">Όνομα</div>
                <div id="lastname" class="col s3 truncate">Επώνυμο</div>
                <div id="email" class="col s3 truncate">E-mail</div>
            </div>
            <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
        </li>
        <li>
            <div class="collapsible-header">
                <div id="id" class="col s1 truncate">ID</div>
                <div id="username" class="col s3 truncate">Ψευδώνυμο</div>
                <div id="name" class="col s2 truncate">Όνομα</div>
                <div id="lastname" class="col s3 truncate">Επώνυμο</div>
                <div id="email" class="col s3 truncate">E-mail</div>
            </div>
            <div class="collapsible-body"><p>Lorem ipsum dolor sit amet.</p></div>
        </li>
    </ul>

    <ul class="pagination">
        <li class="disabled"><a href="#!"><i class="mdi-navigation-chevron-left"></i></a></li>
        <li class="active"><a href="#!">1</a></li>
        <li class="waves-effect"><a href="#!">2</a></li>
        <li class="waves-effect"><a href="#!">3</a></li>
        <li class="waves-effect"><a href="#!">4</a></li>
        <li class="waves-effect"><a href="#!">5</a></li>
        <li class="waves-effect"><a href="#!"><i class="mdi-navigation-chevron-right"></i></a></li>
    </ul>
</div>