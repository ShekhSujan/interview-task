@extends('welcome')
@section('content')
    <script>
        $(document).ready(function() {

            filter_data();

            function filter_data(page) {

                var action = 'fetch_data';
                var branch = $('#branch').val();
                var gender = $('#gender').val();

                var url = '{{ route('customer_list') }}';
                $.ajax({
                    url: url,
                    method: "GET",
                    data: {
                        action: action,
                        branch: branch,
                        gender: gender,
                        page: page,

                    },
                    success: function(data) {
                        $('.filter_data').html(data.customers);
                        $('#pagination-links').html(data.links);
                    }
                });
            }

            $('.common_selector').change(function() {
                filter_data();
            });
            $('.search_selector').keyup(function() {
                filter_data();
            });


            $(document).on('click', '.page-link', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                filter_data(page);
            });


        });
    </script>
    <div class="p-5">
        <div class="row">
            <div class="col-4">
                <label>Gender</label>
                <select id="gender" name="gender" class="form-select common_selector" aria-label="Default select example">
                    <option value="">All</option>
                    <option value="M">M</option>
                    <option value="F">F</option>
                </select>
            </div>
            <div class="col-4">
                <label>Branch</label>
                <input id="branch" type="text" name="branch" class="form-control sz search_selector"
                    placeholder="Search" value="">
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Branch</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">email</th>
                    <th scope="col">phone</th>
                    <th scope="col">gender</th>
                </tr>
            </thead>
            <tbody class="filter_data">

            </tbody>
        </table>
        <nav  id="pagination-links"></nav>
    </div>
@endsection
