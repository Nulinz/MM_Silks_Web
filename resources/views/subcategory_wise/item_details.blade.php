@extends('layouts.app')

 @if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>  
@endif 

<!-- @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info">
        {{ session('info') }}
    </div>
@endif -->



@section('content')

    <div class="sidebodydiv px-4 py-1 mb-3">
        <div class="sidebodyhead mb-4">
        <h4 class="m-0">Add Items</h4>
        </div>

        <form action="{{ route('items_store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            
            <div class="container-fluid p-1 maindiv">
                <div class="row">
                    <div class="col-sm-12 col-md-3 col-xl-6 mb-3 inputs">
                        <!--subcategory name-->
                        <label for="empcode">Subcategory Name</label>
                        <input type="text" class="form-control" name="subcategory_name" id="subcategory_name" value="{{ $subcategory->sc_name }}" readonly>
                        <input type="hidden" class="form-control" name="sub_id" id="sub_id" value="{{ $id }}" readonly>
                        <!--types-->
                        <label for="empname" class="col-form-label">Types</label><br>
                        <label for="contact">Finished</label>
                        <input type="radio" id="vehicle" name="types" value="finished">
                        <label for="altcontact">Not Finished</label>
                        <input type="radio" id="vehicle1" name="types" value="not_finished"><br>
                        <!--colors-->
                        <label for="color" class="col-form-label">Colors</label>
                        <select class="form-control" name="color" id="color">
                                <option value="" disabled selected>-- Choose a color --</option>
                                @foreach($color_list as $color)
                                    <option value="{{ $color->id }}">{{ $color->co_name }}</option>
                                @endforeach
                        </select>
                        <!--barcode-->
                        <label for="barcode_value">Scanned Barcode</label>
                        <input type="text" class="form-control" name="i_code" id="i_code">
                    </div>

                    <div id="my_camera" class="col-sm-12 col-md-3 col-xl-6 mb-3 inputs"></div>

                        <br/>

                        <input type=button value="Take Snapshot" onClick="take_snapshot()">

                        <input type="hidden" name="i_logo" class="image-tag">
                        
                   </div>
               </div>
                    
                <div id="results" class="col-sm-6 col-md-3 col-xl-3 mb-3 inputs"></div>
                   
        
          </div>               
        </form>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.min.js"></script>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    
    <script>
     document.addEventListener('DOMContentLoaded', function() {
     const barcodeInput = document.getElementById('i_code');
     const form = barcodeInput.closest('form');
     const captureButton = document.getElementById('capture-save-btn');
     let typingTimer;
     const doneTypingInterval = 500;

    document.getElementById('color').addEventListener('change', function() {
        setTimeout(() => {
            barcodeInput.focus();
        }, 100);
    });

    barcodeInput.addEventListener('input', function () {
        clearTimeout(typingTimer);
        if (barcodeInput.value.trim() !== '') {
            typingTimer = setTimeout(function() {
                showConfirmationPopup();
            }, doneTypingInterval);
        }
    });

    // barcodeInput.addEventListener('keydown', function(e) {
    //     if (e.key === 'Enter') {
    //         e.preventDefault();
    //         if (barcodeInput.value.trim() !== '') {
    //             showConfirmationPopup();
    //         }
    //     }
    // });

    function showConfirmationPopup() {
        const confirmation = confirm('Do you want to capture photo and save?');
        if (confirmation) {
            // YES clicked - proceed with photo capture
            Webcam.snap(function (data_uri) {
                document.querySelector('.image-tag').value = data_uri;
                document.getElementById('results').innerHTML = '<img src="' + data_uri + '"/>';
                form.submit();
            });
        } else {
            // CANCEL clicked - clear barcode input
            barcodeInput.value = '';
        }
    }
});
</script>


    <script>
            Webcam.set({
    width: 600,
    height: 350,
    image_format: 'jpeg',
    jpeg_quality: 90
});

Webcam.attach('#my_camera');    

// Webcam Load Error Handling
Webcam.on('error', function(err) {
    console.error('Webcam Error:', err);
    document.getElementById('webcam-error').style.display = 'block';
});
    </script>



    


    


@endsection