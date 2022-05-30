const enviarViaAjax = (form, idModal) => {

  var formData = new FormData(form);

  $.ajax({
    url: form.action,
    dataType: 'json',
    type: form.method.toUpperCase(),
    processData: false, 
    contentType: false,
    data: formData,
    success: function(data) {
      console.log(data);
      if (data.status == 'true') {
        table.ajax.reload();
        $('#'+idModal).modal('hide');
      } else {
        alert('failed');
      }
    },
    error: function(data){
      console.log(data);
    }
  });

}