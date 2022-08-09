{{--Common Ajax will be here--}}
<script type="text/javascript">
    ;(function ($, window, document) {
        /**Auto Execute Part*/
        $(document).ready(function () {

            //Search for Product Test here
            $('.select2-ajax').select2({
                minimumInputLength: 3,
                ajax: {
                    url: $('.select2-ajax').data('link'),
                    dataType: 'json',
                    method: 'post',
                    data: function (params) {
                        var query = {
                            "_token": "{{ csrf_token() }}",
                            "search": params.term
                        }
                        return query;
                    },

                    processResults: function (data) {
                        return {
                            results: data,
                            flag: 'selectProgram',
                        };
                    },
                    cache: true
                },
                placeholder: $('.select2-ajax').data('text'),
            });
            //End search for product
        });

    }(window.jQuery, window, document));


    function getCompanyBranch(str) {
        let url = '';
        let comBranchId = $('#companyBranch');
        let role = $('#role');
        //let type = this.val();

        $.ajax({
            url: url + '?type=' + str,
            method: 'get',
            contentType: 'application/json',
        }).success(response => {

            comBranchId.find('option').remove();
            role.find('option').remove();

            if (response.info) {

                if (response.info.role) {
                    for (i = 0; i < response.info.role.length; i++) {
                        role.append('<option value="' + response.info.role[i].id + '"> ' + response.info.role[i].name + ' </option>');
                    }
                }
                if (response.info.data) {
                    for (i = 0; i < response.info.data.length; i++) {
                        comBranchId.append('<option value="' + response.info.data[i].id + '"> ' + response.info.data[i].name + ' </option>');
                    }
                }

            } else {
                comBranchId.append('<option value=""> not found </option>');
                role.append('<option value=""> not found </option>');
            }


        });
    }

    function getBranch(str) {

        let url = '{{route('branch.branch.getBranch')}}';

        let branch = $('#branch').val();

        $.ajax({
            url: url + '/' + str,
            method: 'get',
            contentType: 'application/json',
        }).success(response => {

            if (response.info) {

                if (response.info.role) {
                    for (i = 0; i < response.info.role.length; i++) {
                        branch.append('<option value="' + response.info.role[i].id + '"> ' + response.info.role[i].name + ' </option>');
                    }
                }
            } else {
                branch.append('<option value=""> not found </option>');
            }


        });
    }


</script>
