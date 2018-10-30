$(function () {
    var t1,t2;
    var d= {};
    var changes = [];
    var $sortable = $('#listdrops > tbody');
    $sortable.sortable({
        items: 'tr:has(td)',
        axix:'x',
        start: function (event, ui) {
          var idMoovedDef = parseInt(ui.item.attr('id'));
          console.log(idMoovedDef);
          t1 = $(ui.item.children().get(1)).text();  
          d = { avanti: true, after: true, idMoovedDef: idMoovedDef};
        },update: function (event, ui) {
            $('#btnsavefedchanges').attr('disabled',false);
            var targetTd=null;
            if(ui.item.prev().attr('id')) {
              targetTd = ui.item.prev();
            }else if (ui.item.next().attr('id')) {
              targetTd = ui.item.next();
              d.after = false;
            }else{}
            if(targetTd) {
              var idTargetDef = parseInt($(targetTd).attr('id'));
              t2 = $(targetTd.children().get(1)).text();
              d.idTargetDef = idTargetDef;
              if (t1 > t2) {
                 d.avanti = false;
              }
                changes.push(d);
                console.log("benne");
            }else{
                console.log("not benne");
            }
        }
    });

    function reduce() {
       var finalChanges = [];
       for (var i = changes.length -1; i >= 0; i--) {
           if (!exists(changes[i], finalChanges)) {
               if (!isNaN(changes[i].idTargetDef) && !isNaN(changes[i].idMoovedDef)) {
                   finalChanges.push(changes[i]);
               }
           }
       }
     return finalChanges;
    }

    function exists(needle,haystack) {
         var length = haystack.length;
         for (var i = 0; i < length; i++) {
             if (haystack[i].idMoovedDef == needle.idMoovedDef)
                return true;
         }
     return false;
    }

    $('#btnsavefedchanges').click(function(e) {
        e.preventDefault();
        var ret =  reduce();
        var csrf_token = $('meta[name="csrf-token"]').attr('content');
        console.log(ret);
        if(ret.length > 0) {
            $('#maskforloadingspinner').show();
            $.ajax({
                url: '/defenses/updateorder',
                type:'POST',
                dataType:'json',
                'X-CSRF-Token' : csrf_token,
                data : "changes=" + JSON.stringify(ret),
                success:function(response) {
                    $('#maskforloadingspinner').hide();
                    changes = [];
                    window.location.reload();
                }, error: function(xhr) {
                    $('#maskforloadingspinner').hide();
                    alert('une erreur est survenue, vous devez ressayez!')
                }
            });
       }
    });
});