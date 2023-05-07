<script>
    $(document).ready(function () {
       
        bindDatatable();
        $('#searchsubmit').click(function () {
            bindDatatable();
        });
        $('#addnew').click(function () {
            window.location.href = "<?= ADMINPATH ?>category-add";
        });
        
    });
  

    function bindDatatable() {
        var categoryname = $("#categoryname").val();
        var segmentname = $("#segmentname").val();        
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
                url: '<?= ADMINPATH ?>category-data',
                data: function (d) {
                    d.cname = categoryname;
                    d.sname = segmentname;                    
                }
            }
        });
    }

    function updateCategoryStatus(id, status) {
        if (status == 1) {
            var message = "Do you want to activate this category!";
        }
        if (status == 2) {
            var message = "Do you want to block this category!";
        }
        Swal.fire({
            title: "Are you sure?",
            text: message,
            icon: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#2ab57d",
            cancelButtonColor: "#fd625e",
            confirmButtonText: "Yes, do it!"
        }).then(function (e) {
            if (e.isConfirmed == true) {
                $.ajax({
                    type: "POST",
                    url: '<?= ADMINPATH ?>update-segcatsubcat-status',
                    data: {enctableid: id, status: status,type:2},
                    success: function (data) {
                        var jsonData = JSON.parse(data);
                        if (jsonData.status == 'success') {
                            var page = $('#example').DataTable().page.info().page;
                            bindDatatable(page);
                            Swal.fire("Updated!", jsonData.message, jsonData.status);
                        } else {
                            Swal.fire("Updated!", jsonData.message, jsonData.status);
                        }

                    }
                });
            }

        });
    }
</script>