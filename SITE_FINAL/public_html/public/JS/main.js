$(document).ready(function(){

  $("#selectAll").click(function(){
    $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

  });

  load_product();

  load_cart_data();

  function load_product()
  {
    $.ajax({
     url:"selection.php",
     method:"POST",
     success:function(data)
     {
      $('#display_item').html(data);
    }
  });
  }

  function load_cart_data()
  {
    $.ajax({
     url:"../controller/fetch_cart.php",
     method:"POST",
     success:function(data)
     {
      $('#shopping_cart').html(data);
    }
  });
  }

  $(document).on('click', '.select_product', function(){
    var product_id = $(this).data('product_id');
    if($(this).prop('checked') == true)
    {
     $('#product_'+product_id).css('background-color', '#f1f1f1');
     $('#product_'+product_id).css('border-color', '#333');
   }
   else
   {
     $('#product_'+product_id).css('background-color', 'transparent');
     $('#product_'+product_id).css('border-color', '#ccc');
   }
 });

  $('#add_to_cart').click(function(){
    var product_id = [];
    var product_num = [];
    var product_type = [];
    var product_modele = [];
    var product_etat = [];
    var product_statut = [];
    var product_garantie = [];
    var product_lieu = [];
    var product_remarque = [];
    var product_inventaire = [];
    var product_immobilisation = [];
    var product_idcr = [];
    var product_nomcr = [];
    var action = "add";

    $('.select_product').each(function(){
     if($(this).prop('checked') == true)
     {
      product_id.push($(this).data('product_id'));
      product_num.push($(this).data('product_num'));
      product_type.push($(this).data('product_type'));
      product_modele.push($(this).data('product_modele'));
      product_etat.push($(this).data('product_etat'));
      product_statut.push($(this).data('product_statut'));
      product_garantie.push($(this).data('product_garantie'));
      product_lieu.push($(this).data('product_lieu'));
      product_remarque.push($(this).data('product_remarque'));
      product_inventaire.push($(this).data('product_inventaire'));
      product_immobilisation.push($(this).data('product_immobilisation'));
      product_idcr.push($(this).data('product_idcr'));
      product_nomcr.push($(this).data('product_nomcr'));
    }
  });

    if(product_id.length > 0)
    {
     $.ajax({
      url:"../controller/action.php",
      method:"POST",
      data:{product_id:product_id, product_num:product_num, product_type:product_type, product_modele:product_modele, product_etat:product_etat,
        product_statut:product_statut, product_garantie:product_garantie, product_lieu:product_lieu, product_remarque:product_remarque, product_inventaire:product_inventaire, product_immobilisation:product_immobilisation, product_idcr:product_idcr, product_nomcr:product_nomcr,
        action:action},
        success:function(data)
        {
         $('.select_product').each(function(){
          if($(this).prop('checked') == true)
          {
           $(this).attr('checked', false);
           var temp_product_id = $(this).data('product_id');
           $('#product_'+temp_product_id).css('background-color', 'transparent');
           $('#product_'+temp_product_id).css('border-color', '#ccc');
         }
       });

         load_cart_data();
         alert("L'ajout a été effectué avec succés ! ");
          window.location.href = "recherche.php";
       }
     });
   }
   else
   {
     alert('Veuillez sélectionner au moins un ordinateur');
   }

 });

  function ch_toggle(source) 
  {
   checkboxes = document.getElementsByName('choix[]');
   for(var i=0, n=checkboxes.length;i<n;i++) 
   {
    checkboxes[i].checked = source.checked;
  }
}

$(document).on('click', '.delete', function(){
  var product_id = $(this).attr("id");
  var action = 'remove';
  if(confirm(" Etes-vous sûr de retirer cet ordinateur ?"))
  {
    $.ajax({
      url:"../controller/action.php",
      method:"POST",
      data:{product_id:product_id, action:action},
      success:function()
      {
        load_cart_data();
        alert("L'ordinateur a été retiré du panier ");
         location.reload();
      }
    })
  }
  else
  {
    return false;
  }
});

$(document).on('click', '#clear_cart', function(){
  var action = 'empty';
  $.ajax({
    url:"../controller/action.php",
    method:"POST",
    data:{action:action},
    success:function()
    {
      load_cart_data();
      alert("Le panier a été vidé !");
      window.location.href = "recherche.php";
    }
  });
});

});



