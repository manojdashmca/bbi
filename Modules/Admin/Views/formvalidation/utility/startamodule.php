<script>
    $(document).ready(function () {
        flatpickr("#daterange", {mode: "range", dateFormat: "d-m-Y"});
        //new Choices("#status", {removeItemButton: !0});
        bindDatatable();
        $('#searchsubmit').click(function () {
            bindDatatable();
        });
        
        
    });

   
    function bindDatatable(page = 0) {
        if (page != 0) {
            var page = parseInt(page) * 10;
        }
        var name = $("#name").val();
        var mobile = $("#mobile").val();
        var daterange = $("#daterange").val();
        var email = $("#email").val();
        var area = $("#area").val();
        
        $('#startamodule').DataTable().destroy();
        $('#startamodule').DataTable({
            responsive: true,
            searching: false,
            processing: true,
            ordering: true,
            bLengthChange: false,
            serverSide: true,
            displayStart: page,
            pageLength: 10,
            order: [[0, 'desc']],
            ajax: {
                method: "POST",
                url: '<?= ADMINPATH ?>startamodule-data',
                data: function (d) {
                    d.name = name;
                    d.mobile = mobile;
                    d.area = area;
                    d.daterange = daterange;
                    d.email = email;
                    
                }
            }
        });
    }
    
    
    
</script>