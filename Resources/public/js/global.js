/*jslint browser: true*/
/*global $, jQuery*/

/*Refresh profile button*/
$('#Refresh').click(function () {
    location.reload();
});

/*switchClass CSS*/
$('#usersList').click(function () {
    "use strict";
    $('.imaviaGrid').removeClass('imaviaGrid').addClass('imaviaList');
});

$('#usersGrid').click(function () {
    "use strict";
    $('.imaviaList').removeClass('imaviaList').addClass('imaviaGrid');
});

/*Fonction de nettoyage de tous les champs input et restauration de la valeur par défaut des select*/
$('a#ClearAllFields').click(function () {
    "use strict";
    $('input').not('#ValidatorBtn').val('');
    $('select').prop('selectedIndex', 0);
});

/*Fonction d'affichage du bloc icon+input*/
function showInputField(clickedElement, clickedObject) {
    "use strict";
    clickedObject.animate({ 'opacity' : '0.2'});    
    var divToShowId, removeIcon;
    divToShowId = '#' + clickedElement.id + 'Div';
    removeIcon = $(divToShowId).children('.icon-remove');
    $(divToShowId).fadeIn();
    if (removeIcon.length === 0) {
        $('<i class="icon-remove"></i>').appendTo(divToShowId);
    }
}

/*Affiche le bloc icon+input du reseau social cliqué*/
$('div#socialIconsList img').click(function () {
    "use strict";
    showInputField(this, $(this));
});

/*Fonction pour masquer le bloc icon+input*/
function hideAndClearInputField(clickedRemoveIcon) {
    "use strict";
    $(clickedRemoveIcon).children('i.icon-remove').remove();
    $(clickedRemoveIcon).hide();
    var parentId;
    parentId = $(clickedRemoveIcon).attr("id");
    parentId = parentId.replace("Div","");
    $('#socialIconsList img[id*="' + parentId + '"]').animate({ 'opacity' : '1'});
}

$('.icon-remove').live("click", function () {
    "use strict";
    hideAndClearInputField($(this).parent());
});

$('.DualChoices').next().hide();
$('.DualChoices').append('<i class="icon-plus-sign inputShow"></i>');

function showOrHideRelatedDiv(clickedElement) {
    "use strict";
    if (clickedElement.hasClass('icon-plus-sign')) {
        clickedElement.hide();
        var nextDiv = clickedElement.parent().next();
        nextDiv
            .css({
                'display' : 'block',
                'height' : '1px',
                'min-height' : '1px',
                'overflow' : 'hidden',
                'margin-top' : '-21px'
            })
            .animate({
                'height' : '60px'
            });
    } else if (clickedElement.hasClass('icon-minus-sign')) {
        clickedElement
            .parent()
            .animate({
                'height' : '1px'
            });
        clickedElement.parent().prev().children(':hidden').show();
    }
}

$('.inputShow').click(function () {
    "use strict";
    showOrHideRelatedDiv($(this));
});

$(function () {
    "use strict";
    $(".datepicker").datepicker({
        showOn: "button",
        buttonImage: "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
        buttonImageOnly: true,
        dateFormat: "dd/mm/yy",
        dayNames: ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"],
        dayNamesMin: ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"],
        monthNamesShort: ["Jan", "Fev", "Mar", "Avr", "Mai", "Jui", "Juil", "Aout", "Sept", "Oct", "Nov", "Dec"],
        monthNames: ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre"]
    });
});


/*
 * Unbind previent la double execution de la fonction 
 * et l'ajout de profil deux par deux
 */
$('#ValidatorBtn').unbind("click").click(function (event) {
   "use strict";
        var route;
        event.preventDefault(); // empêche la soumission "classique"
        route = Routing.generate('imavia_add');
        //str = $('.modal-body > form#imaviaForm').serialize();
        var form = document.getElementById("imaviaForm");
        $('.modal-body > form').hide();
        $('.modal-body > #spinner').hide();
        $('.modal-body').append('<i class="icon-spinner icon-spin icon-4x" id="spinner"></i>');
        
        var timestamp = $.now();
        
        $.ajax({
            type: "POST",
            url: route,
            data: new FormData(form),          
            //data: str,
            contentType:false,
            processData: false,
           // datatype: "json" ,
            //contentType: 'multipart/form-data',
            error: function (jqXHR,textStatus, errorThrown) {
                $('.modal-body > #spinner').hide(); 
                $('.modal-body').html(jqXHR.statusCode+" : "+textStatus+","+errorThrown);     
            },
           
            success: function (data, textstatus, jqXHR) {
               console.log(jqXHR);
               if (jqXHR.responseText==='Formulaire Valide') {
                 alert("formulaire valide" + timestamp);
                 $('#myModal').modal('hide');
                 location.reload();
               } else {
                 alert("passe dans le else JS");
                 ('.modal-body').html(data);
               }
            }
            
        });
    });


$('#ModalOpener').click(function () {
    "use strict";
    $('#myModal').modal();
    var route;
    route = Routing.generate('imavia_add');
    $.ajax({
        type: "GET",
        url: route,
        complete: function (jqxhr) {
            $('.modal-body').html(jqxhr.responseText);
            $('#spinner').hide();
        }
    });
});

/*variable pour définir si le menu clic droit est activé ou non*/
var rightClicMenu = false;
/*réduit l'opacité des profils utilisateurs et modifie le background du profil sélectionné ou passé en hover
* @param object clickedProfil élément sur lequel on clique
* @return 
*/
function opacify(clickedProfil) {
    "use strict";
    clickedProfil.siblings(':not(.navbar)').animate({opacity: "0.2"}, {queue: false});
    clickedProfil.css("background-color", "#fffb92");
}

/*remet l'opacité des profils utilisateurs comme à leurs états de départ soit 100%
* @param object clickedProfil élément sur lequel on a cliqué
*/
function unopacify(clickedProfil) {
    "use strict";
    clickedProfil.siblings().animate({opacity: "1"}, {queue: false});
    clickedProfil.css("background-color", "");
}

/*Evenement lors de l'entrée de la souris dans un bloc utilisateur*/
$('.userBlock').mouseenter(function () {
    "use strict";
    /*supprime la classe open crée lors de l'ouverture du dropdown menu du bouton action*/
    $(".open").removeClass("open");
    /*execute la fonction opacify, réduit l'opacité des blocs utilisateurs*/
    opacify($(this));
});

/*Evenement lors de la sortie de la souris d'un bloc utilisateur*/
$('.userBlock').mouseleave(function () {
    "use strict";
    /*supprime la classe open crée lors de l'ouverture du dropdown menu du bouton action*/
    $(".open").removeClass("open");
    /*lance la fonction unopacitfy pour réafficher tous les blocs avec une opacité de 1*/
    unopacify($(this));
});

/*masque le menu clic droit lors d'un clic dans le document*/
$(document).click(function () {
    "use strict";
    $('#UserContextMenu').hide();
    $('.userBlock').bind({
        mouseenter: function () {
            opacify($(this));
        },
        mouseleave: function () {
            unopacify($(this));
        }
    });
    if (rightClicMenu === true) {
        $('.userBlock').siblings().animate({opacity: "1"}, {queue: false});
        $('.userBlock').css("background-color", "");
        rightClicMenu = false;
    }
});

/*fonction pour afficher le menu clic droit dans le div treeviewContainer*/
$('.userBlock').bind('contextmenu', function (e) {
    "use strict";
    /*previent l'action par défaut soit l'ouverture du menu contextuel clic droit*/
    e.preventDefault();
    /*utilisation de .which pour connaitre la touche enfoncée, ici le clic droit*/
    var RightClick = e.which;
    /*si la touche enfoncée est équale à la touche 3 (clic droit par défaut)*/
    if (RightClick === 3) {
        $('#UserContextMenu').css({
            top: e.pageY + 'px',
            left: e.pageX + 'px'
        }).show();
        $('.userBlock').unbind("mouseenter mouseleave");
        rightClicMenu = true;
    }
});

/*affiche ou masque le bouton pour remonter en haut de page lors du scroll en fonction du scroll de la page*/
$(window).scroll(function () {
    "use strict";
    if ($(window).scrollTop() < 100) {
        $('#btnGoUp').fadeOut();
    } else {
        $('#btnGoUp').fadeIn();
    }
});

/*action sur le bouton pour remonter en haut de page, scroll automatiquement de la page à 0, soit tout en haut*/
$('#btnGoUp').click(function () {
    "use strict";
    $('html,body').animate({scrollTop: 0}, 'fast');
});