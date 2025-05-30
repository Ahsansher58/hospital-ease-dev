@extends('frontend.layouts.after-login-doctors')

@section('title', 'Hospital Ease - Timings')
@include('frontend.includes.favicon')
@section('content')
<style type="text/css">
    .autocomplete{
        position: relative;
    }
    .autocomplete .searchResult{
        list-style: none;
        padding: 0px;
        width: 78%;
        position: absolute;
        margin: 0;
        margin-top: 40px;
        background: white;
        z-index: 5;
    }

    .is-invalid {
        border-color: #dc3545 !important; /* Red border for invalid fields */
        box-shadow: 0 0 5px rgba(220, 53, 69, 0.5); /* Optional: Add a red glow */
    }

    .autocomplete .searchResult li{
        background: #F2F3F4;
        padding: 10px;
        margin-bottom: 1px;
        white-space: break-spaces;
    }

    .autocomplete .searchResult li:nth-child(even){
        background: #E5E7E9;
        color: black;
    }

    .autocomplete .searchResult li:hover{
        cursor: pointer;
        background: #CACFD2;
    }
</style>
    @include('frontend.includes.after-login-doctor-header')
    <!--MAIN-->
    <main class="inner-page">
        <!--BANNER-->
        @include('frontend.includes.doctor-top-banner')
        <!--/BANNER-->

        <section class="pb-5">
            <div class="container">
                <div class="row">

                    <div class="col-xl-3">
                        <!--SIDE TAB-->
                        @include('frontend.includes.doctor-side-navbar')
                        <!--SIDE TAB-->
                    </div>

                    <div class="col-xl-9">
                        <div class="hospital-list-block my-favourite-hospital frame">
                            <h3 class="font-medium">Timings</h3>
                            <form>
                                <div class="row mb-4 g-2 align-items-center">
                                    <div class="col-md-4">
                                        <div class="autocomplete">
                                            <div class="search-widget bg-light border">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" placeholder="Search Day"
                                                        id="searchAppointmentDay">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="search-widget search-symptoms bg-light border">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="searchAppointmentFromTime"
                                                    placeholder="Search From Time">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="search-widget search-symptoms bg-light border">
                                            <div class="input-group">
                                                <input type="text" class="form-control" id="searchAppointmentHospital"
                                                    placeholder="Search Hospital">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="javascript:void()" class="btn btn-info btn-md rounded-50 w-100" data-bs-toggle="modal" data-bs-target="#appointments_modal">
                                            <img src="{{ asset('assets/frontend/images/icons/plus-icon.svg') }}" class="img-fluid me-0 me-sm-2" />
                                            <span class="d-none d-sm-inline-flex">Add</span>
                                        </a>
                                    </div>
                                </div>
                            </form>
                            <div id='show_messages'>
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                            <div class="table-responsive appointment-table">
                                <table id="Appointment" class="table mb-0 appointment-table">
                                    <thead>
                                        <tr>
                                            <th>Sno</th>
                                            <th>Day </th>
                                            <th>Timings</th>
                                            <th>Hospital Name</th>
                                            <th>Action </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </section>


    </main>
    <!--/MAIN-->
    @include('frontend.includes.user-footer')
    <!-- Modal -->
    <div class="modal fade" id="appointments_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-m modal-dialog-centered">
            <div class="modal-content rounded-24">
                <div class="modal-header border-0">
                    <h3 class="modal-title font-regular" id="staticBackdropLabel">Timings</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mt-4">
                    <form id="AppointmentForm" method="POST" action="{{ route('doctor.appointment-store') }}">
                        @csrf
                        <div class="row gy-3">
                            <!-- Day -->
                            
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="country" class="mb-2">Country</label>
                                    <select class="selectpicker form-select form-input-control w-100"
                                        name="country" required>
                                        @foreach ($uniqueCountries as $country)
                                            <option value="{{ $country }}">
                                                {{ $country }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select country
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="state" class="mb-2">State</label>
                                    <select class="selectpicker form-select form-input-control w-100"
                                        name="state" required>
                                        @foreach ($uniqueStates as $state)
                                            <option value="{{ $state }}">
                                                {{ $state }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select state
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="city" class="mb-2">City</label>
                                    <select class="selectpicker form-select form-input-control w-100"
                                        name="city" required>
                                        @foreach ($uniqueCities as $city)
                                            <option value="{{ $city }}">
                                                {{ $city }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select city
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="locality" class="mb-2">Locality</label>
                                    <select class="selectpicker form-select form-input-control w-100"
                                        name="locality" required>
                                        @foreach ($uniqueLocalities as $locality)
                                            <option value="{{ $locality }}">
                                                {{ $locality }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select locality
                                    </div>
                                </div>
                            </div>
                            <!-- Choose Hospital -->
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label" for="formValidationPlacement">Choose Hospital</label>
                                    <div class="input-group autocomplete">
                                        <input type="text" class="form-control form-input-control hospital-select" name="hospital_name" placeholder="Search Hospital" required>
                                            <input type="hidden" name="hospital_id">
                                            <ul class="searchResult"></ul> 
                                    </div> 
                                </div> 
                            </div>
                            <div class="col-md-6 mt-2 mb-2">
                                <label class="form-label" for="formValidationPlacement">Day</label>
                                <select id="" name="day" class="form-select">
                                    <option value="">Select Day</option>
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                        <option value="Sunday">Sunday</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label class="mb-2"> From Time<span class="text-danger">*</span></label>
                                <input type="time" class="form-control form-input-control" name="from_time" placeholder="Enter From Time" required>
                            </div>
                            <div class="col-lg-12">
                                <label class="mb-2"> To Time<span class="text-danger">*</span></label>
                                <input type="time" class="form-control form-input-control" name="to_time" placeholder="Enter To Time" required>
                            </div>
                        </div>
                        <div class="my-5">
                            <button type="submit" class="btn btn-info me-2 font-regular">Add</button>
                            <button type="button" class="btn btn-cancel font-size-16 font-regular"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-m modal-dialog-centered">
            <div class="modal-content rounded-24">
                <div class="modal-header border-0">
                    <h3 class="modal-title font-regular" id="staticBackdropLabel">Edit Timings</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body mt-4">
                    <form id="editForm">
                        <input type="hidden" id="appointment_id" name="appointment_id">
                        @csrf
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="country" class="mb-2">Country</label>
                                    <select class="form-select form-input-control w-100 country"
                                        name="country" required>
                                        @foreach ($uniqueCountries as $country)
                                            <option value="{{ $country }}">
                                                {{ $country }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select country
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="state" class="mb-2">State</label>
                                    <select class="form-select form-input-control w-100 state"
                                        name="state" required>
                                        @foreach ($uniqueStates as $state)
                                            <option value="{{ $state }}">
                                                {{ $state }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select state
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="city" class="mb-2">City</label>
                                    <select class="form-select form-input-control w-100 city"
                                        name="city" required>
                                        @foreach ($uniqueCities as $city)
                                            <option value="{{ $city }}">
                                                {{ $city }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select city
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <label for="locality" class="mb-2">Locality</label>
                                    <select class="form-select form-input-control w-100 locality"
                                        name="locality" required>
                                        @foreach ($uniqueLocalities as $locality)
                                            <option value="{{ $locality }}">
                                                {{ $locality }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select locality
                                    </div>
                                </div>
                            </div>
                            <!-- Choose Hospital -->
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label" for="formValidationPlacement">Choose Hospital</label>
                                    <div class="input-group autocomplete">
                                        <input type="text" class="form-control form-input-control hospital-select" name="hospital_name" placeholder="Search Hospital" required>
                                            <input type="hidden" name="hospital_id">
                                            <ul class="searchResult"></ul> 
                                    </div> 
                                </div> 
                            </div>
                            <div class="row gy-3">
                            <div class="col-md-6 mt-2 mb-2">
                                <label class="form-label" for="day">Day</label>
                                <select id="day" name="day" class="form-select">
                                    <option value="">Select Day</option>
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                        <option value="Saturday">Saturday</option>
                                        <option value="Sunday">Sunday</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <label class="mb-2"> From Time<span class="text-danger">*</span></label>
                                <input type="time" class="form-control form-input-control" name="from_time" id="from_time" required>
                            </div>
                            <div class="col-lg-12">
                                <label class="mb-2"> To Time<span class="text-danger">*</span></label>
                                <input type="time" class="form-control form-input-control" name="to_time" id="to_time" required>
                            </div>
                        </div>

                        <div class="my-5">
                            <button type="submit" class="btn btn-info me-2 font-regular">Update</button>
                            <button type="button" class="btn btn-cancel font-size-16 font-regular"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<!-- jQuery UI JS -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script>

        // Initialize hospital autocomplete for a specific modal
        function initializeHospitalAutocomplete(modalSelector) {
            $(modalSelector + ' .hospital-select').autocomplete({
                autoFocus: true,
                minLength: 2,
                source: function(request, response) {
                    if (request.term.length < 2) {
                        $(modalSelector + ' [name="hospital_id"]').val('');
                        return false;
                    }

                    $.ajax({
                        url: "{{ route('search-hospitals') }}",
                        type: 'POST',
                        dataType: 'json',
                        data: {
                            _token      : '{{ csrf_token() }}',
                            search_text : request.term,
                            country     : $(modalSelector + ' [name="country"]').val(),
                            state       : $(modalSelector + ' [name="state"]').val(),
                            city        : $(modalSelector + ' [name="city"]').val(),
                            locality    : $(modalSelector + ' [name="locality"]').val(),
                        },
                        success: function(json) {
                            if (json.error) {
                                $(modalSelector + ' [name="hospital_id"]').val('');
                                return false;
                            }
                            response($.map(json.result, function(item) {
                                return {
                                    id: item.id,
                                    name: item.name,
                                    label: item.name + ' - ' + item.city + ' (' + item.phone_no + ')'
                                };
                            }));
                        }
                    });
                },
                select: function(event, ui) {
                    event.preventDefault();
                    $(this).val(ui.item.name);
                    $(modalSelector + ' [name="hospital_id"]').val(ui.item.id);
                    return false;
                },
                appendTo: modalSelector + ' .modal-body'
            }).data("ui-autocomplete")._renderItem = function(ul, item) {
                return $("<li>")
                .append("<a>" + item.label + "</a>")
                .appendTo(ul);
            };
        }

        var table = $('#Appointment').DataTable({
            ajax: {
                url: '{{ route('doctor.getAppointments') }}',
                dataSrc: 'data'
            },
            lengthMenu: [50, 100, 200, 400, 500, "Display All"],
            order: [
                [0, 'desc']
            ],
            columnDefs: [{
                targets: 0, // Target the first column (index 0)
                visible: false, // Hide the first column
                searchable: false, // Disable search for the first column (optional)
            }, ],
            columns: [{
                    data: 0
                },
                {
                    data: 1
                },
                {
                    data: 2
                },
                {
                    data: 3
                },
                {
                    data: 4
                },
            ]
        });
        $(document).ready(function() {
            //filter
            $('#searchAppointmentDay').on('keyup', function() {
                table.column(1).search(this.value).draw();
            });
            $('#searchAppointmentFromTime').on('keyup', function() {
                table.column(2).search(this.value).draw();
            });
            $('#searchAppointmentHospital').on('keyup', function() {
                table.column(3).search(this.value).draw();
            });
            // Handle form submission (to update data)
            $('#editForm').on('submit', function(e) {
                e.preventDefault();

                var appointmentId = $('#appointment_id').val(); // Get the ID from the edit button
                var updateUrl = '{{ route('doctor.updateAppointment', ':id') }}'.replace(':id',
                    appointmentId);
                // Send the updated data to the server via AJAX
                $.ajax({
                    url: updateUrl, // Adjust with your update route
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: function(response) {

                        $('#editModal').modal('hide');
                        $('#show_messages').html('<div class="alert alert-success">' + response
                            .message +
                            '</div>');
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        // Show validation error messages
                        var errors = xhr.responseJSON.errors;
                        var errorMessages = '';
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                errorMessages += errors[key].join('<br>') + '<br>';
                            }
                        }

                        // Display error messages in your modal or alert box
                        $('#validationErrors').html(
                            errorMessages
                        ); // Assuming you have an element for errors in your modal
                    }
                });
            });
        });

        $(document).ready(function() {
            // Initialize for create modal
            initializeHospitalAutocomplete('#appointments_modal');
            
            // Initialize for edit modal when it's shown
            $('#editModal').on('shown.bs.modal', function() {
                initializeHospitalAutocomplete('#editModal');
            });

            // Close search results when clicking outside
            document.addEventListener("click", function(event) {
                if (!$(event.target).closest('.hospital-select').length && 
                    !$(event.target).closest('.searchResult').length) {
                    $(".searchResult").empty();
                }
            });
        });

        // Edit popup function
        function edit_popup(appointmentId) {
            var editUrl = '{{ route('doctor.editGetAppointment', ':id') }}'.replace(':id', appointmentId);

            $.ajax({
                url: editUrl,
                method: 'GET',
                success: function(data) {
                    var modal = $('#editModal');

                    // Populate basic fields
                    modal.find('[name="day"]').val(data.day);
                    modal.find('[name="from_time"]').val(data.from_time);
                    modal.find('[name="to_time"]').val(data.to_time);
                    modal.find('[name="appointment_id"]').val(data.id);

                    // Set location dropdowns
                    modal.find('[name="country"]').val(data.country).trigger('change');
                    modal.find('[name="state"]').val(data.state).trigger('change');
                    modal.find('[name="city"]').val(data.city).trigger('change');
                    modal.find('[name="locality"]').val(data.locality).trigger('change');

                    // Set hospital inputs
                    modal.find('[name="hospital_name"]').val(data.hospital_name);
                    modal.find('[name="hospital_id"]').val(data.hospital_id);

                    // Show the modal
                    modal.modal('show');
                },
                error: function(xhr) {
                    console.error("Error loading appointment data", xhr.responseText);
                }
            });
        }

        function delete_appointment(appointmentId) {
            // Show confirmation popup
            if (confirm("Are you sure you want to delete this Appointment?")) {
                // Make AJAX request to delete the medicine
                var deleteUrl = '{{ route('appointment.delete', ':id') }}'.replace(':id', appointmentId);
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: deleteUrl,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token
                    },
                    success: function(response) {
                        $('#show_messages').html('<div class="alert alert-success">' + response.message +
                            '</div>');
                        table.ajax.reload();
                    },
                    error: function(xhr) {
                        $('#show_messages').html(
                            '<div class="alert alert-danger">An error occurred while deleting the Appointment. Please try again.</div>'
                        );
                    }
                });
            } else {
                $('#show_messages').html(
                    '<div class="alert alert-danger">Appointment deletion was canceled</div>'
                );
            }
        }


        function autocomplete(inp, arr) {
            /*the autocomplete function takes two arguments,
            the text field element and an array of possible autocompleted values:*/
            var currentFocus;
            /*execute a function when someone writes in the text field:*/
            inp.addEventListener("input", function(e) {
                var a, b, i, val = this.value;
                /*close any already open lists of autocompleted values*/
                closeAllLists();
                if (!val) {
                    return false;
                }
                currentFocus = -1;
                /*create a DIV element that will contain the items (values):*/
                a = document.createElement("DIV");
                a.setAttribute("id", this.id + "autocomplete-list");
                a.setAttribute("class", "autocomplete-items");
                /*append the DIV element as a child of the autocomplete container:*/
                this.parentNode.appendChild(a);
                /*for each item in the array...*/
                for (i = 0; i < arr.length; i++) {
                    /*check if the item starts with the same letters as the text field value:*/
                    if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                        /*create a DIV element for each matching element:*/
                        b = document.createElement("DIV");
                        /*make the matching letters bold:*/
                        b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                        b.innerHTML += arr[i].substr(val.length);
                        /*insert a input field that will hold the current array item's value:*/
                        b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                        /*execute a function when someone clicks on the item value (DIV element):*/
                        b.addEventListener("click", function(e) {
                            /*insert the value for the autocomplete text field:*/
                            inp.value = this.getElementsByTagName("input")[0].value;
                            /*close the list of autocompleted values,
                            (or any other open lists of autocompleted values:*/
                            closeAllLists();
                        });
                        a.appendChild(b);
                    }
                }
            });
            /*execute a function presses a key on the keyboard:*/
            inp.addEventListener("keydown", function(e) {
                var x = document.getElementById(this.id + "autocomplete-list");
                if (x) x = x.getElementsByTagName("div");
                if (e.keyCode == 40) {
                    /*If the arrow DOWN key is pressed,
                    increase the currentFocus variable:*/
                    currentFocus++;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 38) { //up
                    /*If the arrow UP key is pressed,
                    decrease the currentFocus variable:*/
                    currentFocus--;
                    /*and and make the current item more visible:*/
                    addActive(x);
                } else if (e.keyCode == 13) {
                    /*If the ENTER key is pressed, prevent the form from being submitted,*/
                    e.preventDefault();
                    if (currentFocus > -1) {
                        /*and simulate a click on the "active" item:*/
                        if (x) x[currentFocus].click();
                    }
                }
            });

            function addActive(x) {
                /*a function to classify an item as "active":*/
                if (!x) return false;
                /*start by removing the "active" class on all items:*/
                removeActive(x);
                if (currentFocus >= x.length) currentFocus = 0;
                if (currentFocus < 0) currentFocus = (x.length - 1);
                /*add class "autocomplete-active":*/
                x[currentFocus].classList.add("autocomplete-active");
            }

            function removeActive(x) {
                /*a function to remove the "active" class from all autocomplete items:*/
                for (var i = 0; i < x.length; i++) {
                    x[i].classList.remove("autocomplete-active");
                }
            }

            function closeAllLists(elmnt) {
                /*close all autocomplete lists in the document,
                except the one passed as an argument:*/
                var x = document.getElementsByClassName("autocomplete-items");
                for (var i = 0; i < x.length; i++) {
                    if (elmnt != x[i] && elmnt != inp) {
                        x[i].parentNode.removeChild(x[i]);
                    }
                }
            }
            /*execute a function when someone clicks in the document:*/
            document.addEventListener("click", function(e) {
                closeAllLists(e.target);
            });
        }

        /*An array containing all the country names in the world:*/
        var medicine = ["Codeine", "Sulfa Drugs", "Amoxicillin", "Aspirin", "Ibuprofen", "Penicillin"];

        /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
        autocomplete(document.getElementById("medicineInput"), medicine);
    </script>
    <style>
        .dt-layout-row {
            display: none !important;
        }

        .dt-layout-row.dt-layout-table {
            display: flex !important;
            margin: 0 !important;
        }

        div.dt-container.dt-empty-footer tbody>tr:last-child>* {
            border-bottom: 0;
        }

        table.dataTable>thead>tr>th,
        table.dataTable>thead>tr>td {
            border-color: #D9D9D9;
        }

        table.dataTable>thead>tr>th:last-child .dt-column-order {
            display: none;
        }
    </style>
@endsection
