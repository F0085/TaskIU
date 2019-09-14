function UserRol(area,rol){
	
	$("#inforOrganigrama").modal();
	
	 $("#TablaUserRoles").html("");
    $.get('UserRoles/'+area+'/'+rol, function (data) {

        $.each(data, function(i, item) { //recorre el data 
            	$("#TablaUserRoles").append(` <tr align="center">
                    <td> ${item['Nombre']}  ${item['Apellido']}</td>
           
                    <td><button onclick="EditarRol()"  type="button" class=" btn btn-success btn-sm">  <span class="ti-eye"></span></td>
                 </tr>`);
        });      
    });
}


function organigrama(){

// console.log(data);  
        var webcallMeIcon=`<span class="fa fa-eye"></span>`;
      //   var webcallMeIcon = '<svg width="24" height="24" viewBox="0 0 300 400"><g transform="matrix(1,0,0,1,40,40)"><path fill="#5DB1FF" d="M260.423,0H77.431c-5.522,0-10,4.477-10,10v317.854c0,5.522,4.478,10,10,10h182.992c5.522,0,10-4.478,10-10V10 C270.423,4.477,265.945,0,260.423,0z M178.927,302.594c0,5.522-4.478,10-10,10c-5.523,0-10-4.478-10-10v-3.364h20V302.594z M250.423,279.229H87.431V58.624h162.992V279.229z" /><path fill="#5DB1FF" d="M118.5,229.156c4.042,4.044,9.415,6.271,15.132,6.271c5.715,0,11.089-2.227,15.133-6.269l29.664-29.662 c4.09-4.093,6.162-9.442,6.24-14.816c5.601-0.078,10.857-2.283,14.829-6.253l29.66-29.662c4.042-4.043,6.269-9.417,6.269-15.133 c0-5.716-2.227-11.09-6.269-15.13l-9.806-9.806c-4.041-4.043-9.415-6.27-15.132-6.27c-5.716,0-11.09,2.227-15.132,6.269 l-29.663,29.662c-4.092,4.092-6.164,9.443-6.242,14.817c-5.601,0.078-10.857,2.283-14.828,6.252l-29.661,29.662 c-4.042,4.043-6.269,9.418-6.268,15.136c0,5.716,2.227,11.089,6.269,15.129L118.5,229.156z M168.618,147.548l29.662-29.661 c1.587-1.587,3.696-2.461,5.94-2.461c2.243,0,4.353,0.874,5.938,2.461l9.808,9.808c1.586,1.586,2.46,3.694,2.46,5.937 c0,2.244-0.874,4.354-2.462,5.941l-29.658,29.661c-1.588,1.587-3.697,2.46-5.941,2.46c-2.243,0-4.353-0.874-5.938-2.46 l-0.309-0.309l19.598-19.598c2.539-2.539,2.539-6.654,0-9.192c-2.537-2.538-6.654-2.538-9.191,0l-19.599,19.598l-0.308-0.308 C165.344,156.152,165.345,150.823,168.618,147.548z M117.888,198.28l29.66-29.661c1.587-1.586,3.695-2.46,5.939-2.46 c2.242,0,4.349,0.872,5.934,2.455c0.002,0.001,0.004,0.003,0.005,0.005l0.309,0.309l-19.598,19.598 c-2.539,2.538-2.539,6.653,0,9.191c1.269,1.27,2.933,1.904,4.596,1.904s3.327-0.635,4.596-1.904l19.599-19.598l0.309,0.309 c3.273,3.273,3.273,8.603,0,11.877l-29.662,29.66c-1.588,1.588-3.698,2.462-5.941,2.462c-2.243,0-4.352-0.874-5.938-2.462 l-9.807-9.806c-1.586-1.586-2.46-3.694-2.46-5.938C115.426,201.978,116.3,199.868,117.888,198.28z" /></g></svg>';
   
	var Area =  Array();  
	var arrayArea = [];
	var SubAreas =  Array(); 
	var arraySubAreas = []; 
	var Roles =  Array();  
	var arrayRoles = [];

    var chart = new OrgChart(document.getElementById("orgchart"), {
               template: "olivia",
        layout: OrgChart.mixed,
        nodeBinding: {
            field_0: "name",
            field_1: "title",
            field_2: "Area",
            field_3: "Rol",
            img_0: "img",
           

    	},
        nodeMenu: {
                call: {
                    text: "  Ver Usuarios",
                    icon: webcallMeIcon,
                    onClick: callHandler
                }
        },
        nodes: [  
       //recorre el data 
             { id: "0", title: "CLINICA CARDIOCENTRO MANTA", "img": "images/logocc.png"},
        ]

        });


       	 $.get('AreasRoles', function (data) { 
       	 	$.each(data, function(i, item) { //recorre el data  
    
       	 		Areas = 
	            { "id": item['Id_Area']+'25', "pid": "0", "name": item['Descripcion'], "title": "Area", "img": "images/area.jpg" } ; 
				arrayArea.push(Areas);
				var n = arrayArea.splice(0, 1)[0];
		                chart.addNode(n);
       	 		$.each(item['sub_area'], function(i, item1) { //recorre el data 
       	 			SubAreas = 
		            { "id": item1['Id_Sub_Area']+'25', "pid": item1['Id_Area']+'25', "name": item1['Descripcion'], "title": "SubArea", "img": "images/UserORG.jpg"
					} ; 
					arraySubAreas.push(SubAreas);

					var n1 = arraySubAreas.splice(0, 1)[0];
			                chart.addNode(n1);
		        
       	 			$.each(item1['roles'], function(i, item2) {  
       	 				Roles = 
			            { "id": item2['Id_Roles'], "pid":  item2['Id_Sub_Area']+'25', "name": item2['Descripcion'], "title": "Programmer", "img": "images/UserORG.jpg" } ; 
						arrayRoles.push(Roles);
						var n2 = arrayRoles.splice(0, 1)[0];
				                chart.addNode(n2);
       	 			});
       			});
       	 			// console.log(item['Descripcion']);
       		});

       	 });

        //   
 //
// var newNodes =  Array();  var array = []; var array1 = []; var l=0;
// var newNodes1 =  Array();  var newNodes3 =  Array();  var array3 = [];
// var l2=0;
//     $.get('DistintAreas', function (data1) {
      
//    	 $.get('AreasRoles', function (data) {
//    	 		// console.log(data);
//      	$.each(data1, function(i, item1) { //recorre el data  
// 	        l=l+1;
// 	        newNodes = 
// 	            { "id": item1['Id_Area'], "pid": "0", "name": item1['Area'], "title": "Area", "img": "images/area.jpg" } ; 
	       
// 			array.push(newNodes);

// 			var n = array.splice(0, 1)[0];
// 	                chart.addNode(n);


// 	       	$.each(data, function(i, item) { //recorre el data 	       		
// 	        	if(item1['Id_Area']==item['Id_Area']){
// 	        		l2=l2+4;

// 	        	newNodes1 = 
// 	            { "id": item['Id_area_roles']+'25', "pid": item1['Id_Area'], "name": item['Rol'], "title": "Rol", "img": "images/UserORG.jpg", "Area":item1['Id_Area'], "Rol":item['Id_Roles'], } ; 
// 		       	console.log(newNodes1);
// 				array1.push(newNodes1);

// 				var n1 = array1.splice(0, 1)[0];
// 		                chart.addNode(n1);
// 		        }

// 		    //     $.get('UserRoles/'+item1['Id_Area']+'/'+item['Id_Roles'], function (data3) {
// 		    //     	$.each(data3, function(i, item3) {
// 		    //     	if(item1['Id_Area']==item3['Id_Area'] && item['Id_Roles']==item3['Id_Roles']){

// 		    //     		newNodes3 = 
// 			   //          { "id": item3['Id_Usuario']+'25', "pid":  item['Id_area_roles']+'25', "name": item3['Nombre'], "title": "Programmer", "img": "https://balkangraph.com/js/img/13.jpg" } ; 
// 				  //      	// console.log(newNodes3);
// 						// array3.push(newNodes3);

// 						// var n2 = array3.splice(0, 1)[0];
// 				  //               chart.addNode(n2);
				       
// 		    //     	 // console.log(item3['Nombre']);
// 		    //     	}
// 		    //     	 });
// 		    //     });

// 	        });
//         });
       

//       });
//    	      });
//     // document.getElementById("btn").addEventListener("click", function () {                
//     //             var n = array.splice(0, 1)[0];
//     //             chart.addNode(n);

//     //             if (array.length == 0) {
//     //                 this.style.display = "none";
//     //             }
//     //         });

              
      
// //        for (var i = 0; i <= 7; i++) { var n = array.splice(0, 1)[0]; 
       			 
// // chart.addNode(n);
// //        }

            
            

       function callHandler(nodeId) {
        var nodeData = chart.get(nodeId);
        var id_area = nodeData["Area"];
        var id_rol = nodeData["Rol"];
        UserRol(id_area,id_rol);
     //   window.open('https://webcall.me/' + employeeName, employeeName, 'width=340px, height=670px, top=50px, left=50px');
    }       
         
    
}





