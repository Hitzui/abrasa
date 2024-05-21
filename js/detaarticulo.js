$('.data-subcategoria').select2({
    ajax: {        
        url: '/detaarticulo/subcategoria',
        dataType: 'json',
        data: function (params) {
            var query = {
              search: params.term,
            };      
            // Query parameters will be ?search=[term]&type=public
            return query;
        }      
    }
  });

  var $select_cat = $('.data-categoria').select2({
    ajax: {        
        url: '/detaarticulo/categoria',
        dataType: 'json',
        data: function (params) {
            var query = {
              search: params.term,
            };      
            // Query parameters will be ?search=[term]&type=public
            return query;
        }
    }
  });  
$select_cat.on('select2:select', function (e) {
    var data = e.params.data;
    var selected=data.id;    
    $('.data-subcategoria').select2({
        ajax: {        
            url: '/detaarticulo/subcategoria?idcategoria='+selected,
            dataType: 'json',
            data: function (params) {
                console.log(params);
                var query = {
                  search: params.term,
                };      
                // Query parameters will be ?search=[term]&type=public
                return query;
            }      
        }
      });
});