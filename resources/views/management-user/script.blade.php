<script>
    $(document).ready(function() {
        var table = $('#management-user').DataTable({
            processing: false,
            serverSide: false,
            searching: false,
            paginate: false,
            info: false,
            columnDefs: [
                {
                    orderable: false,
                    targets: 0
                },
                {
                    orderable: false,
                    targets: 2
                }
            ],
            order: [[1, 'asc']]
        })
    })

</script>
