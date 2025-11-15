
function slugify(str) {
  return String(str)
      .normalize('NFKD') // split accented characters into their base characters and diacritical marks
      .replace(/[\u0300-\u036f]/g,
      '') // remove all the accents, which happen to be all in the \u03xx UNICODE block.
      .trim() // trim leading or trailing whitespace
      .toLowerCase() // convert to lowercase
      .replace(/[^a-z0-9 -]/g, '') // remove non-alphanumeric characters
      .replace(/\s+/g, '-') // replace spaces with hyphens
      .replace(/-+/g, '-'); // remove consecutive hyphens
}

async function select_cats(cat_id,type,show=0
  ){
   // console.log(cat_id+" "+type+" "+show);
    $('#selected_category_id').val(cat_id);
    $.get( "/admin-panel/categories/select-categories/"+cat_id+"/"+type+"/"+show, function( data ) {
        $( "#cats_div" ).html( data );
        
      });
    
    // // $('#cats_div').html('');



    //  if(cat_id>0){
    //  const response = await fetch('/admin-panel/categories/select-categories/' + cat_id, {
    //      headers: {
    //          'Accept': 'application/json'
    //      }
    //      });
    //      const contentType = response.headers.get('content-type');
    //      if (contentType && contentType.includes('application/json')) {
 
    //          const jsonData = await response.json();
    //          $.each(jsonData , function(index, categoryData) {
    //              if(categoryData.categories != undefined){
    //               appendSelect(categoryData.categories  ,cat_id);
    //              }
    //          });
            
    //      }
    //  }
 }