/*switchClass CSS*/
$('#usersList').click(function(){
    $('.imaviaGrid').removeClass('imaviaGrid').addClass('imaviaList');
})

$('#usersGrid').click(function(){
    $('.imaviaList').removeClass('imaviaList').addClass('imaviaGrid');
})



/*Fonction de nettoyage de tous les champs input et restauration de la valeur par défaut des select*/
$('a#ClearAllFields').click(function()
{
    $('input').not('#ValidatorBtn').val('');
    $('select').prop('selectedIndex',0);
});


/*Fonction d'affichage du bloc icon+input*/
function showInputField(clickedElement) {
   // alert('clickedElementId = ' + clickedElement.id);
   divToShowId = '#'+clickedElement.id+'Div';
   // alert(divToShowId);
   $(divToShowId).show();
   removeIcon = $(divToShowId).children('.icon-remove');
  
   if (removeIcon.length === 0) {
        $('<i class="icon-remove"></i>').appendTo(divToShowId);
   }
};

/*Affiche le bloc icon+input du reseau social cliqué*/
$('div#socialIconsList i.icon-2x').click(function()
{
    showInputField(this);
});

/*Fonction pour masquer le bloc icon+input*/
function hideAndClearInputField(clickedRemoveIcon)
{
    $(clickedRemoveIcon).children('i.icon-remove').remove();
    $(clickedRemoveIcon).hide();
};

$('.icon-remove').live("click", function()
{
    hideAndClearInputField($(this).parent());
});

/*Fonction pour afficher le div masqué suivant*/
function toggleNextHiddenDiv(clickedElement)
{
    clickedElement.parent().next().toggle();
    if (clickedElement.hasClass('icon-plus-sign'))
    {
        clickedElement.removeClass('icon-plus-sign').addClass('icon-minus-sign');
    } else {
        clickedElement.removeClass('icon-minus-sign').addClass('icon-plus-sign');       
    }
}

$('.inputShow').click( function()
{
    toggleNextHiddenDiv($(this));
});


$(function() {
    $( ".datepicker" ).datepicker({
    showOn: "button",
    buttonImage: "http://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
    buttonImageOnly: true,
    dateFormat: "dd/mm/yy",
    dayNames: [ "Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi" ],
    dayNamesMin: [ "Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa" ],
    monthNamesShort: [ "Jan", "Fev", "Mar", "Avr", "Mai", "Jui", "Juil", "Aout", "Sept", "Oct", "Nov", "Dec" ],
    monthNames: [ "Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Decembre" ]
    });
});

$('#ValidatorBtn').click(function() {

  
   $('.modal-body > form').submit(function() {
        var route = Routing.generate('imavia_add');
        var str = $(this).serialize();  
        //alert(str);
       
       $.ajax({
           type: "POST",
           url: route,
           data: str,
           datatype:'html',
           error: function(jqxhr){
               alert(jqxhr.getResponseHeader);
           }
       })
   }) 
      alert(jqxhr.getResponseHeader);
});



$('#ModalOpener').click(function()
{
    $('#myModal').modal();
    var route = Routing.generate('imavia_add');
        $.ajax({
               type: "GET",
               url: route,
               complete: function(jqxhr)
               {
                    $('.modal-body').html(jqxhr.responseText);
                    $('#spinner').hide();
               }
        })
 });

	/*variable pour définir si le menu clic droit est activé ou non*/
	var rightClicMenu = false;

	/*réduit l'opacité des profils utilisateurs et modifie le background du profil sélectionné ou passé en hover
	*	@param object clickedProfil élément sur lequel on clique
	*	@return 
	*/
	function opacify(clickedProfil)
	{
		clickedProfil.siblings(':not(.navbar)').animate({opacity: "0.2"}, {queue: false});
		clickedProfil.css("background-color", "#fffb92");	
	}
	
	/*remet l'opacité des profils utilisateurs comme à leurs états de départ soit 100%
	*	@param object clickedProfil élément sur lequel on a cliqué
	*/
	function unopacify(clickedProfil)
	{
		clickedProfil.siblings().animate({opacity: "1"}, {queue: false});
		clickedProfil.css("background-color", "");
	}
	
	/*Evenement lors de l'entrée de la souris dans un bloc utilisateur*/
	$('.userBlock').mouseenter(function()
	{
		/*supprime la classe open crée lors de l'ouverture du dropdown menu du bouton action*/
		$(".open").removeClass("open");
		/*execute la fonction opacify, réduit l'opacité des blocs utilisateurs*/
		opacify($(this));
	});
	

	/*Evenement lors de la sortie de la souris d'un bloc utilisateur*/
	$('.userBlock').mouseleave(function()
	{
		/*supprime la classe open crée lors de l'ouverture du dropdown menu du bouton action*/
		$(".open").removeClass("open");
		/*lance la fonction unopacitfy pour réafficher tous les blocs avec une opacité de 1*/
		unopacify($(this));
	});
	

	
	/*masque le menu clic droit lors d'un clic dans le document*/
    $(document).click(function() {
        $('#UserContextMenu').hide();			
		$('.userBlock').bind({
			mouseenter:function()
			{
				opacify($(this));
			},
			
			mouseleave:function()
			{
				unopacify($(this));
			}
		});	
		if(rightClicMenu == true)
		{
			$('.userBlock').siblings().animate({opacity: "1"}, {queue: false});
			$('.userBlock').css("background-color", "");
			rightClicMenu = false;
		}		
	});
	
	/*fonction pour afficher le menu clic droit dans le div treeviewContainer*/
	$('.userBlock').bind('contextmenu',function(e){
		/*previent l'action par défaut soit l'ouverture du menu contextuel clic droit*/
		e.preventDefault();
		/*utilisation de .which pour connaitre la touche enfoncée, ici le clic droit*/
		var RightClick = e.which;
		
		/*si la touche enfoncée est équale à la touche 3 (clic droit par défaut)*/
		if(RightClick == 3)
		{
			$('#UserContextMenu').css(
			{
				top: e.pageY+'px',
				left: e.pageX+'px'
			}).show();	
			$('.userBlock').unbind("mouseenter mouseleave");
			rightClicMenu = true;			
		}		
	});
	

	
	/*affiche ou masque le bouton pour remonter en haut de page lors du scroll en fonction du scroll de la page*/
	$(window).scroll(function(){	
		 if($(window).scrollTop()<100){
			$('#btnGoUp').fadeOut();
		 }else{
			$('#btnGoUp').fadeIn();
		 }
	});
	
	/*action sur le bouton pour remonter en haut de page, scroll automatiquement de la page à 0, soit tout en haut*/
    $('#btnGoUp').click(function() {
		$('html,body').animate({scrollTop: 0}, 'fast');
    });	