(function($, window) {

    $.ituensAdminHtml = {
        tableId : 'magento-itunes-grid',
        formId : 'magento-itunes-tracks',
        searchFieldId: 'itunes-search',
        formObject : null,
        init: function(){

            // this will load the bootgrid
            this.loadBootgrid();

            // building the form
            this.buildMagentoForm();

        },
        getSearchFieldId: function(){
          return `#${this.searchFieldId}`;
        },
        getTableId: function(){

            return `#${this.tableId}`;

        },
        buildMagentoForm: function() {

            // loading the form object by the Magento VarienForm
            this.formObject = new varienForm(this.formId);

            // loading all form validations
            this.buildFormValidations();

        },
        buildFormValidations: function() {

            // this validation will check if the field is empty as well different from the main phrase by function this.caSearch
            Validation.add('itunes-search', 'You must type a searchable value', (v) => {;

                return !Validation.get('IsEmpty').test(v) && this.canSearch();

            });

            // creating an observer for the submit of the form
            new Event.observe(this.formId, 'submit', (e) => {
                e.stop();
                this.submitAction();
            });
        },
        submitAction: function()
        {
            // this will check if the validator works
            var response = this.formObject.validator.validate();

            // check if the form was valid or not
            if (response) {

                var postData = this.getMainData();
                postData["itunes-search"] = $j(this.getSearchFieldId()).val();

                $j.ajax({
                    type: "POST",
                    url: '/admin/itunes/searchArtist',
                    data:  postData,
                    dataType :'json',
                    success: (data) => {


                        if(data.success){
                            $(this.getTableId()).bootgrid('reload');
                        } else {
                            $j('.magento-errors').html(data.msg).show();

                            setTimeout(function(){
                                $j('.magento-errors').hide();
                            }, 4000);

                        }
                    }
                });
            } else {

                $j('#advice-itunes-search-itunes-search').html(Validation.get('itunes-search').error);
            }
        },
        loadBootgrid : function(){

            $(this.getTableId()).bootgrid({
                highlightRows: true,
                // navigation: 1,
                navigation: 3,
                ajax: true,
                post:  this.getMainData(),
                multiSelect: false,
                ajaxSettings: {
                    method: "POST",
                    cache: false
                },
                url: '/admin/itunes/loadTracks',

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
            });
        },
        getMainData : function(data = null){

            return {
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

                for(var index =0; index < data.totalRecords; index++){

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
        canSearch : function(){

            // this will check if the main text value is equal to the actual value on the search input
            if($j('#itunes-search').val() == $j('#mainValue').val()){
                return false;
            }
            return true;
        }


    }

})($j,window);

// this will load only if the document is ready.
$j(document).ready(function($){

    $.ituensAdminHtml.init();

});