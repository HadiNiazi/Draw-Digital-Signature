<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Digital Signature</title>
        <!-- css -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body class="antialiased">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 mt-5">
                    <div class="card">
                        <div class="card-header">Digital Signature Form</div>

                        <div class="card-body">

                            @if(session('alert-success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('alert-success') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('send.signature') }}">
                                @csrf

                                <div class="form-group">
                                    <label for="name">{{ __('Name') }}</label>
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter name" autofocus>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>


                                <div class="form-group mt-3">
                                    <label>Draw signature</label>
                                    <div id="signature-pad" class="signature-pad">
                                        <div class="signature-pad-body">
                                            <canvas></canvas>
                                        </div>
                                        <div class="signature-pad-footer" style="text-align: right">
                                            <button type="button" id="clear-signature" class="btn btn-danger">Clear</button>
                                        </div>
                                    </div>
                                    <input type="hidden" name="signature" id="signature" value="">
                                </div>

                                <button type="submit" class="btn btn-primary mt-2">
                                    {{ __('Submit') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>
        <script>
            // Initialize Signature Pad
            var canvas = document.querySelector("canvas");
            var signaturePad = new SignaturePad(canvas);

            // Clear signature on button click
            document.getElementById('clear-signature').addEventListener('click', function() {
                signaturePad.clear();
            });

            // Handle form submission
            document.querySelector('form').addEventListener('submit', function(e) {
                var signatureInput = document.getElementById('signature');
                if (signaturePad.isEmpty()) {
                    e.preventDefault();
                    alert('Please draw your signature.');
                } else {
                    // Save signature as base64 image
                    signatureInput.value = signaturePad.toDataURL();
                }
            });
        </script>
    </body>
</html>
