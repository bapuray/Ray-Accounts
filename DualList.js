$(function () {
	var autoinc=3;
	
    var move_right = '<span class="glyphicon glyphicon-minus pull-left  dual-list-move-right" title="Remove Selected"></span>';
    var move_left  = '<span class="glyphicon glyphicon-plus  pull-right dual-list-move-left " title="Add Selected"></span>';
	
	var vendersDetails=[{"id": 0,"name":"Select Vendor"},{"id": 1,"name":"Vender1"},{"id": 2,"name":"Vender2"},{"id": 3,"name":"Vender3"}];
	
	var operatorDetails=[{"id":1,"name":"operator1"},
	{"id":2,"name":"operator2"},
	{"id":3,"name":"operator3"},
	{"id":4,"name":"operator4"},
	{"id":5,"name":"operator5"},
	{"id":6,"name":"operator6"},
	{"id":7,"name":"operator7"},
	{"id":8,"name":"operator8"},
	{"id":9,"name":"operator9"},
	{"id":10,"name":"operator10"},
	{"id":11,"name":"operator11"}];

	var venderoperatorMapping=[{"id":1,"name":"operator1","venderid":1},
	{"id":2,"name":"operator2","venderid":1},
	//{"id":3,"name":"operator3","venderid":1},
	//{"id":4,"name":"operator4","venderid":1},
	{"id":5,"name":"operator5","venderid":1},
	{"id":6,"name":"operator6","venderid":1},
	{"id":7,"name":"operator7","venderid":1},
	{"id":8,"name":"operator8","venderid":1},
	{"id":9,"name":"operator9","venderid":1},
	{"id":10,"name":"operator10","venderid":1},
	{"id":1,"name":"operator1","venderid":2},
	{"id":2,"name":"operator2","venderid":2},
	{"id":3,"name":"operator3","venderid":2},
	{"id":4,"name":"operator4","venderid":2},
	//{"id":5,"name":"operator5","venderid":2},
	//{"id":6,"name":"operator6","venderid":2},
	{"id":7,"name":"operator7","venderid":2},
	{"id":8,"name":"operator8","venderid":2},
	{"id":9,"name":"operator9","venderid":2},
	{"id":10,"name":"operator10","venderid":2},
	{"id":1,"name":"operator1","venderid":3},
	{"id":2,"name":"operator2","venderid":3},
	{"id":3,"name":"operator3","venderid":3},
	{"id":4,"name":"operator4","venderid":3},
	{"id":5,"name":"operator5","venderid":3},
	{"id":6,"name":"operator6","venderid":3},
	{"id":7,"name":"operator7","venderid":3},
	{"id":8,"name":"operator8","venderid":3},
	{"id":9,"name":"operator9","venderid":3},
	{"id":10,"name":"operator10","venderid":3}];
	
  
  var options="";
  
  $.each(vendersDetails, function( index, value ) {  
 options+='<option data-tokens="'+value.name+'" value="'+value.id+'" >'+value.name+'</option>';  
   });
   
   $('.selectpicker').html(options);
  $('.selectpicker').selectpicker();
  
  
  var operatorright="";
  var operatorleft=""; 
 
  $.each(operatorDetails, function( index, value ) {  
         operatorright+='<li class="list-group-item" data-value="'+value.id+'">'+value.name+'</li>';  
   });
    $('#dual-list-right').html(operatorright);
	$('#dual-list-left').html(operatorleft);
   
   

$('.selectpicker').on('change', function(e){
	
	var selectedvenderid=parseInt($(this).find("option:selected").val());
	if(selectedvenderid !=0){
	
var operatorwisevendor=	$.grep(venderoperatorMapping, function( n, i ) {
  return n.venderid==selectedvenderid;
});

var leftopeartortemp=[];
$.each(operatorwisevendor, function(i, item) {
    leftopeartortemp.push(operatorwisevendor[i].id);
});


var leftlistdata = $.grep(operatorDetails, function(v) {
  return leftopeartortemp.indexOf(v.id) > -1;
});


var rightlistdata = $.grep(operatorDetails, function(v) {
  return leftopeartortemp.indexOf(v.id) == -1;
});

var operatorrighttemp="";
  var operatorlefttemp=""; 
 
  $.each(leftlistdata, function( index, value ) {  
         operatorlefttemp+='<li class="list-group-item" data-value="'+value.id+'">'+value.name+move_right +'</li>';  
   });
   
   $.each(rightlistdata, function( index, value ) {  
         operatorrighttemp+='<li class="list-group-item" data-value="'+value.id+'">'+value.name+move_left+'</li>';  
   });
   
    $('#dual-list-right').html(operatorrighttemp);
	$('#dual-list-left').html(operatorlefttemp);

	}
 alert($(this).find("option:selected").val());
});



$("#addvender").click(function(){
	
	autoinc++;
	vendersDetails.push({"id": autoinc,"name":$("#addedvender").val()});
	
	 var options1="";
  
  $.each(vendersDetails, function( index, value ) {  
 options1+='<option data-tokens="'+value.name+'" value="'+value.id+'" >'+value.name+'</option>';  
   });
   
   $('.selectpicker').html(options1);
  $('.selectpicker').selectpicker('refresh');
	
	
	$("#addedvender").val('');
	
 $('#addvenderModal').modal('hide');
});



$("#savevenderdetails").click(function(){
	
alert($(".selectpicker").find("option:selected").val());
	
});
    
    $(".dual-list.list-left .list-group").sortable({
        stop: function( event, ui ) {
            updateSelectedOptions();
        }
    });
    
    
    $('body').on('click', '.list-group .list-group-item', function () {
        $(this).toggleClass('active');
    });
    
	
    
    $('body').on('click', '.dual-list-move-right', function (e) {
        e.preventDefault();

        actives = $(this).parent();
        $(this).parent().find("span").remove();
        $(move_left).clone().appendTo(actives);
        actives.clone().appendTo('.list-right ul').removeClass("active");
        actives.remove();
        
        sortUnorderedList("dual-list-right");
        
        updateSelectedOptions();
    });
    
    
    $('body').on('click', '.dual-list-move-left', function (e) {
        e.preventDefault();

        actives = $(this).parent();
        $(this).parent().find("span").remove();
        $(move_right).clone().appendTo(actives);
        actives.clone().appendTo('.list-left ul').removeClass("active");
        actives.remove();
        
        updateSelectedOptions();
    });
    
    
    $('.move-right, .move-left').click(function () {
        var $button = $(this), actives = '';
        if ($button.hasClass('move-left')) {
            actives = $('.list-right ul li.active');
            actives.find(".dual-list-move-left").remove();
            actives.append($(move_right).clone());
            actives.clone().appendTo('.list-left ul').removeClass("active");
            actives.remove();
            
        } else if ($button.hasClass('move-right')) {
            actives = $('.list-left ul li.active');
            actives.find(".dual-list-move-right").remove();
            actives.append($(move_left).clone());
            actives.clone().appendTo('.list-right ul').removeClass("active");
            actives.remove();
            
        }
        
        updateSelectedOptions();
    });
    
    
    function updateSelectedOptions() {
        $('#dual-list-options').find('option').remove();

        $('.list-left ul li').each(function(idx, opt) {
            $('#dual-list-options').append($("<option></option>")
                .attr("value", $(opt).data("value"))
                .text( $(opt).text())
                .prop("selected", "selected")
            ); 
        });
    }
    
    
    $('.dual-list .selector').click(function () {
        var $checkBox = $(this);
        if (!$checkBox.hasClass('selected')) {
            $checkBox.addClass('selected').closest('.well').find('ul li:not(.active)').addClass('active');
            $checkBox.children('i').removeClass('glyphicon-unchecked').addClass('glyphicon-check');
        } else {
            $checkBox.removeClass('selected').closest('.well').find('ul li.active').removeClass('active');
            $checkBox.children('i').removeClass('glyphicon-check').addClass('glyphicon-unchecked');
        }
    });
    
    
    $('[name="SearchDualList"]').keyup(function (e) {
        var code = e.keyCode || e.which;
        if (code == '9') return;
        if (code == '27') $(this).val(null);
        var $rows = $(this).closest('.dual-list').find('.list-group li');
        var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
        $rows.show().filter(function () {
            var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
            return !~text.indexOf(val);
        }).hide();
    });
    
    
    $(".glyphicon-search").on("click", function() {
        $(this).next("input").focus();
    });
    
    
    function sortUnorderedList(ul, sortDescending) {
        $("#" + ul + " li").sort(sort_li).appendTo("#" + ul);
        
        function sort_li(a, b){
            return ($(b).data('value')) < ($(a).data('value')) ? 1 : -1;    
        }
    }
        
    
    $("#dual-list-left li").append(move_right);
    $("#dual-list-right li").append(move_left);


/*

    // let the gallery items be draggable
    $( ".dual-list.list-left .list-group .list-group-item" ).draggable({
      cancel: "a.ui-icon", // clicking an icon won't initiate dragging
      revert: "invalid", // when not dropped, the item will revert back to its initial position
      containment: "document",
      helper: "clone",
      cursor: "move"
    });
 
    $( ".dual-list.list-right .list-group .list-group-item" ).draggable({
      //connectToSortable: ".dual-list.list-right .list-group",
      cancel: "a.ui-icon", // clicking an icon won't initiate dragging
      revert: "invalid", // when not dropped, the item will revert back to its initial position
      containment: "document",
      helper: "clone",
      cursor: "move"
    });
 
    // let the trash be droppable, accepting the gallery items
    $( ".dual-list.list-right .list-group .list-group-item" ).droppable({
      accept: ".dual-list.list-left .list-group .list-group-item",
      drop: function( event, ui ) {
        //deleteImage( ui.draggable );
        console.log(this);
        console.log(event);
        console.log(ui);
        
        moveItem(ui.draggable);
      }
    });
 
    // let the trash be droppable, accepting the gallery items
    $( ".dual-list.list-left .list-group .list-group-item" ).droppable({
      accept: ".dual-list.list-right .list-group .list-group-item",
      drop: function( event, ui ) {
        //deleteImage( ui.draggable );
        console.log(this);
        console.log(event);
        console.log(ui);
        
        moveItem(ui.draggable);
      }
    });


    // let the gallery be droppable as well, accepting items from the trash
    $gallery.droppable({
      accept: "#trash li",
      activeClass: "custom-state-active",
      drop: function( event, ui ) {
        recycleImage( ui.draggable );
      }
    });


    function moveItem(item) {
        console.log("move item");
        console.log($(item));
        var from = $(item).closest(".dual-list").hasClass("list-left") ? "left" : "right"
        var to = $(item).closest(".dual-list").hasClass("list-left") ? "right" : "left"
        console.log(from, to);
        
        if (to == "left") {
            $(item).find("span.dual-list-move-left").remove();
            $(item).append($(move_right).clone());
            $(item).appendTo('.list-' + to + ' ul');
            
        } else if (to == "right") {
            $(item).find("span.dual-list-move-right").remove();
            $(item).append($(move_left).clone());
            $(item).appendTo('.list-' + to + ' ul');
            
        }
        
    
    }


*/


});

