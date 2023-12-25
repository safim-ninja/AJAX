<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>New Fruit</title>
</head>

<body>
    <div class="container mt-5">
        <h2>
            Add a new fruit
        </h2>


        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <div class="row flex">
                <div class="col-1">
                    <label class="p-1 h5" for="name">Name</label><br>
                    <label class="p-1 h5" for="price">Price</label><br>
                    <label class="p-1 h5" for="image">Image</label>
                </div>
                <div class="col-6 p-0">
                    <input class="m-1" type="text" name="name"  id="name" ><br>
                    <input class="m-1" type="text" name="price" id="price"><br>
                    <input class="m-1" type="file" name="image" id="image"><br>
                </div>
            </div>

            <button type="button" id="create" class="btn btn-primary mt-3">Submit</button>
        </form> 
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script>
        $(document).ready(function() {
            $("#create").click(function() {
                var form = new FormData();
                var image = $('#image')[0].files[0];
                var name = $('#name')[0].value;
                var price = $('#price')[0].value;

                form.append('name', name);
                form.append('price', price);
                form.append('image', image);


                $.ajax({
                    url: 'http://127.0.0.1:8000/api/fruits',
                    type: 'post',
                    data: form,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response != 0) {
                            console.log("uploaded");

                        } else {
                            alert('file not uploaded');
                        }
                    },
                });

            })
        });


        // function create() {
        //     var zhttp = new XMLHttpRequest();

        //     let result;
        //     let inputImage = document.getElementById('image');
        //     // console.log(inputImage);

        //     const values = {
        //         name: document.querySelector('#name').value,
        //         price: document.querySelector('#price').value,
        //         image: inputImage
        //     }
        //     zhttp.open("POST", "http://127.0.0.1:8000/api/fruits", true);
        //     zhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        //     zhttp.send(values);


        //     console.log(zhttp.responseText);

        // }
    </script>
</body>

</html>
