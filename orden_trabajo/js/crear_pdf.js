 $(document).on('ready',function(){

      $('#btn-ingresar').click(function(){
        var url = "crear_pdf.php";     
        var str = "Ver PDF";
        var result = str.link(url);

        $.ajax({                        
           type: "POST",                 
           url: url,                    
           data: $("#frm1").serialize(),
           success: function(data)            
           {
          // $('#resp').html(data);
           //$('#resp1').html(alert("Bien"));
          //   $('#resp1').html(alert(data));
           // document.getElementById('#resp').innerHTML = result;
          // window.open("crear_pdf.php" + data);
          // document.location.href = "crear_pdf.php" + $(this).serialize(data);
         //$.post( 'crear_pdf.php', { id: 0 } );
              location.href="crear_pdf.php?"+data+"";
           }
         });
      });
    });