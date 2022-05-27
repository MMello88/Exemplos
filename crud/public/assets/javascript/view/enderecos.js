$(document).ready(function () {
  $('#data-endereco').DataTable( {
    ajax: base_url + '/usuario/perfil/getEnderecos',
    responsive: true,
    dom: `<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>
      <'table-responsive'tr>
      <'row align-items-center'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 d-flex justify-content-end'p>>`,
    language: {
      paginate: {
        previous: '<i class="fa fa-lg fa-angle-left"></i>',
        next: '<i class="fa fa-lg fa-angle-right"></i>'
      }
    },
    columns: [
      { data: 'nome' },
      { data: 'rua' },
      { data: 'id', className: 'align-middle text-right', orderable: false, searchable: false }
    ],
    columnDefs: [{
      targets: 2,
      render: function (data, type, row, meta) {
        console.log(data, type, row, meta);
        return `
        <a class="btn btn-sm btn-icon btn-secondary" href="#${data}"><i class="fa fa-pencil-alt"></i></a>
        <a class="btn btn-sm btn-icon btn-secondary" href="#${data}"><i class="far fa-trash-alt"></i></a>
        `
      }
    }]
  } );
});
