<script>
    $(document).ready(function () {
        GLightbox({selector: ".image-popup", title: !1});
    });



    function updateStatus(id, status) {
        if (status == 1) {
            var message = "Do you want to activate this album!";
        }
        if (status == 2) {
            var message = "Do you want to block this album!";
        }
        if (status == 3) {
            var message = "Do you want to delete this album!";
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
                    url: '<?= ADMINPATH ?>update-image-status',
                    data: {encid: id, status: status},
                    success: function (data) {
                        var jsonData = JSON.parse(data);
                        if (jsonData.status == 'success') {                                                    
                            Swal.fire("Updated!", jsonData.message, jsonData.status);
                            window.location.reload();
                        } else {
                            Swal.fire("Error!", jsonData.message, jsonData.status);
                        }

                    }
                });
            }

        });
    }

</script>