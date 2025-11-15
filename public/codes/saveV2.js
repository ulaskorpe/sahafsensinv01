function save(formData,route,formID,btn,modal_btn) {
     
    
    var headers = new Headers();
    headers.append('Content-Type', 'application/json');
    headers.append('Accept', 'application/json');  
  //  var dataString = formData.serialize();

 
    fetch(route, {
        method: 'POST',
      //  headers: headers,
        body: formData // Use FormData object as the request body
    })
    .then(function(response) {
        // if (!response.ok) {
        //    // throw new Error('Network response was not ok');
        // }
        console.log(response);
        return response.json(); // Parse response JSON
    })
    // .then(function(data) {
    //     // Handle successful response
    //     console.log('Response:', data);
    // })
    .catch(function(error) {
        // Handle errors
        Swal.fire({
            icon: 'error',

            text:error

        });
       // console.log('Error:', error);
    });
}