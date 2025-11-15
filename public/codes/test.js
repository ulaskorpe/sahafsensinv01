
var select_array = [];        
function appendSelect(jsonData,cat_id){
    
    var count = parseInt(jsonData.count); 
        var $rankSelect = $('#rank');
        $rankSelect.empty(); 
        for (var i = 1; i <= count+1; i++) {
            $('<option>').val(i).text(i).appendTo($rankSelect);
        }
        $rankSelect.prop('disabled', false); 
if(jsonData.count>0){
var newSelect = $("<select>")
    .attr("name", "cat_select_"+cat_id)
    .attr("id", "cat_select_"+cat_id)
    .attr("class", "form-control mt-2")
    .attr("onchange", "select_sub_cat(this.value)");

// Append the new select element to the specific div
$("#cats_div").append(newSelect);
select_array.push(cat_id);
 
 
const categorySelect = $('#cat_select_'+cat_id);

 
categorySelect.empty();
categorySelect.append($('<option>', {
        value: "0", 
        text: "seçiniz"
    }));
// Iterate over categories and append options to select element
$.each(jsonData.categories, function(index, category) {
   /// console.log(jsonData.categories);
    categorySelect.append($('<option>', {
        value: category.id, 
        text: category.id+":"+category.name  
    }));
});
}///countDRAKULL!!
} //// appendSelect


async function removeSelect(){
    $.each(select_array, function(index, select) {
         console.log("select"+select);
          $('#cat_select_'+select).remove();
     });
}
 

async function select_sub_cat(cat_id){
    if(cat_id>0){ 
    $('#parent_id').val(cat_id);
    last_select =  cat_id;
    const response = await fetch('/admin-panel/categories/show-sub-categories/' + cat_id, {
    headers: {
        'Accept': 'application/json'
    }
    });
    // const data = await response.json();
    if (response.ok) {
    const contentType = response.headers.get('content-type');
    if (contentType && contentType.includes('application/json')) {
        // Response is JSON
       
        const jsonData = await response.json();
        appendSelect(jsonData,cat_id);
       
    } else {
        // Response is HTML
        const htmlData = await response.text();
        // Handle HTML data or extract relevant data if needed
        console.log(htmlData);
    }
} else {
    // Handle error
    console.error('Error:', response.status);
}
}else{///// remove sub cats
    removeSelect();
    
    $('#cat_div').empty();
    $('#parent_id').val($('#cat_select').val());
}
      

}



//////////////////////////////v2

var last_select = 0;


async function fill_select(cat_id){

   // const response = await fetch('/admin-panel/categories/fill-select/' + cat_id, {
   //     headers: {
   //         'Accept': 'application/json'
   //     }
   //     });

   //     if (response.ok) {
          
   //      const contentType = response.headers.get('content-type');
   //      if (contentType && contentType.includes('application/json')) {
      
   //          const jsonData = await response.json();
 

   //           //  add upper cats;
   //           $.each(jsonData.categories, function(index, category) {
               

   //             });

              
   
    
            
           
   //      } else {
   //          // Response is HTML
   //          const htmlData = await response.text();
   //          // Handle HTML data or extract relevant data if needed
   //          console.log(htmlData);
   //      }
   //  } else {
   //      // Handle error
   //      console.error('Error:', response.status);
   //  }

}///fill select

async function select_upper_cat(cat_id){
   
       const response = await fetch('/admin-panel/categories/show-upper-categories/' + cat_id, {
           headers: {
               'Accept': 'application/json'
           }
           });

           if (response.ok) {
               
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
          
                const jsonData = await response.json();
     

                 //  add upper cats;
                 $.each(jsonData.categories, function(index, category) {
                   console.log(category.name);
                   var newSelect = $("<select>")
                   .attr("name", "cat_select_"+category.id)
                   .attr("id", "cat_select_"+category.id)
                   .attr("class", "form-control mt-2")
                   .attr("onchange", "select_sub_cat(this.value)")
                   .attr("onclick", "fill_select(this.value)");
                   $("#upper_cats_div").append(newSelect);
                   
                   newSelect.append($('<option>', {
                           value: category.id, 
                           text: category.name
                       }));

                   });

     
               
            } else {
                // Response is HTML
                const htmlData = await response.text();
                // Handle HTML data or extract relevant data if needed
                console.log(htmlData);
            }
        } else {
            // Handle error
            console.error('Error:', response.status);
        }

   
}
async function select_sub_cat(cat_id){
           if(cat_id>0){ 
              
               $('#upper_cats_div select').remove();
               await select_upper_cat(cat_id);
                
               $('#cats_div select').remove();
               $('#parent_id').val(cat_id);
               last_select =  cat_id;
               const response = await fetch('/admin-panel/categories/show-sub-categories/' + cat_id, {
               headers: {
                   'Accept': 'application/json'
               }
               });
               // const data = await response.json();
           if (response.ok) {
                  // console.log(response);
               const contentType = response.headers.get('content-type');
               if (contentType && contentType.includes('application/json')) {
                   // Response is JSON
                  
                   const jsonData = await response.json();
                   appendSelect(jsonData,cat_id);
                  
               } else {
                   // Response is HTML
                   const htmlData = await response.text();
                   // Handle HTML data or extract relevant data if needed
                   console.log(htmlData);
               }
           } else {
               // Handle error
               console.error('Error:', response.status);
           }
           }else{///// remove sub cats
                
               
               $('#cat_div').empty();
               $('#parent_id').val($('#cat_select').val());
           }
}

async function append_sub_cat(cat_id){
    if(cat_id>0){ 
        
        $('#parent_id').val(cat_id);
        const response = await fetch('/admin-panel/categories/show-sub-categories/' + cat_id, {
            headers: {
                'Accept': 'application/json'
            }
            });
            const jsonData = await response.json();
            appendSelect(jsonData[0].categories,jsonData[0].count);
         
    }
 }

function rankSelect(count){
   var $rankSelect = $('#rank');
   $rankSelect.empty(); 
   for (var i = 1; i <= count+1; i++) {
       $('<option>').val(i).text(i).appendTo($rankSelect);
   }
   $rankSelect.prop('disabled', false); 
}

function appendSelect(jsonData,cat_id){
   
   var count = parseInt(jsonData.count); 
             rankSelect(count);
       if(jsonData.count>0){
       var newSelect = $("<select>")
           .attr("name", "cat_select_"+cat_id)
           .attr("id", "cat_select_"+cat_id)
           .attr("class", "form-control mt-2")
           .attr("onchange", "select_sub_cat(this.value)");
       
       // Append the new select element to the specific div
       $("#cats_div").append(newSelect);
       
        
        
       const categorySelect = $('#cat_select_'+cat_id);
       
        
       categorySelect.empty();
       categorySelect.append($('<option>', {
               value: "0", 
               text: "seçiniz"
           }));
       // Iterate over categories and append options to select element
       $.each(jsonData.categories, function(index, category) {
          /// console.log(jsonData.categories);
           categorySelect.append($('<option>', {
               value: category.id, 
               text: category.id+":"+category.name  
           }));
       });
       }///countDRAKULL!!
} //// appendSelect


async function select_sub_cat(cat_id){
     
    if(cat_id>0){ 
 
        $('#parent_id').val(cat_id);
        last_select =  cat_id;
        const response = await fetch('/admin-panel/categories/show-sub-categories/' + cat_id, {
        headers: {
            'Accept': 'application/json'
        }
        });
        // const data = await response.json();
    if (response.ok) {
           
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            // Response is JSON
           
            const jsonData = await response.json();
            appendSelect(jsonData,cat_id);
           
        } else {
            // Response is HTML
            const htmlData = await response.text();
            // Handle HTML data or extract relevant data if needed
            console.log(htmlData);
        }
    } else {
        // Handle error
        console.error('Error:', response.status);
    }
    }else{///// remove sub cats
         
        
        
        $('#parent_id').val($('#cat_select').val());
    }
}
