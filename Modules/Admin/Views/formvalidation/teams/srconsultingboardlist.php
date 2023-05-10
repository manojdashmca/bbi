<script>
    function bindDatatable() {
        var name = $("#name").val();
        var username = $("#username").val();
        var daterange = $("#daterange").val();
        $('#example').DataTable().destroy();
        $('#example').DataTable({
            responsive: true,
            searching: false,
            processing: true,
            ordering: true,
            bLengthChange: false,
            serverSide: true,
            pageLength: 10,
            order: [[0, 'desc']],
            ajax: {
                method: "POST",
                url: '<?= ADMINPATH ?>sr_consulting_board_data',
                data: function (d) {
                    d.name = name;
                    d.username = username;
                    d.daterange = daterange;
                }
            }
        });
    }
</script>