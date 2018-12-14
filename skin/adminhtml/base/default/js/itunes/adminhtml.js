(function($, window) {

    $.ituensAdminHtml = {
        tableId : 'magento-itunes-grid',
        init: function(){

            // this will start the main data from itunes_tracks table.
            // this.startTracks();

            // this will load the bootgrid
            this.loadBootgrid();

        },
        getTableId: function(){
            return `#${this.tableId}`;
        },
        loadBootgrid : function(){

            $(this.getTableId()).bootgrid({
                highlightRows: true,
                // navigation: 1,
                navigation: 3,
                ajax: true,
                post:  this.getData(),
                multiSelect: false,
                ajaxSettings: {
                    method: "POST",
                    cache: false
                },
                url: '/admin/itunes/loadTracks',
                // rowCount: -1

            })
            .on("loaded.rs.jquery.bootgrid", (e) =>{

                // check if the row count is lower than 10, so we cant have the pagination.
                var count = $j(this.getTableId()).bootgrid("getTotalRowCount");

                if(count <= 10) {
                    $(`${this.getTableId()}-footer`).hide();
                } else {

                    // TODO: test if this works as well
                    $(`${this.getTableId()}-footer`).show();
                }
            })
            ;


                    },
        getData : function(){
            return  {
                isAjax: 'true',
                form_key:  window.FORM_KEY
            };
        },
        getTableTbodySelector: function(){
          return `#${this.tableId} tbody`;
        },
        updateTableValues : function(data){


            if(data){

                var items = data.items;
                // cleaning the table
                $j(this.getTableTbodySelector()).html('');
                console.log(data.totalRecords);

                for(var index =0; index < data.totalRecords; index++){

                    // debugger;


                    const tr = `
                        <tr>
                            <td>${items[index]['itunes_artistname']}</td>
                            <td>${items[index]['itunes_albumname']}</td>
                            <td>${items[index]['itunes_trackprice']}</td>
                            <td>${items[index]['itunes_image']}</td>                            
                        </tr>
                    `;

                    $j(this.getTableTbodySelector()).append(tr);


                }
            }

        },

        startTracks: function(){

            $j.ajax({
                type: "POST",
                url: '/admin/itunes/loadTracks',
                data:  this.getData(),
                dataType :'json',
                success: function(data)
                {
                    $.ituensAdminHtml.updateTableValues(data);
                    console.log(data);
                }
            });
            console.log('run ?');
        }
    }

})($j,window);

// this will load only if the document is ready.
$j(document).ready(function($){

    $.ituensAdminHtml.init();

});