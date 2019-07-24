function UserRol(area,rol){
    $.get('UserRoles/'+area+'/'+rol, function (data) {
        $("#TablaUserRoles").html("");
        $.each(data, function(i, item) { //recorre el data 
            	$("#TablaUserRoles").append(` <tr align="center">
                    <td> ${item['Nombre']}</td>
           
                    <td><button onclick="EditarRol()"  type="button" class=" btn btn-success btn-sm">  <span class="ti-eye"></span></td>
                 </tr>`);
        });      
    });
}
