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

        @csrf
        <label for="name">Name</label>
        <input type="text" name="name" id="name"><br>
        <label for="price">Price</label>
        <input type="text" name="price" id="price"><br>
        <button type="button" class="btn btn-primary mt-3" onclick="create()">Submit</button>

        <div id="response"></div>
    </div>


    <script>
        function create() {
            var zhttp = new XMLHttpRequest();

            const values = {
                name: document.querySelector('#name').value,
                price: document.querySelector('#price').value
            }

            zhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 201) {
                    document.getElementById("response").innerHTML = "Successfully Created";
                    document.querySelector('#name').value = "";
                    document.querySelector('#price').value = "";
                }
            };

            zhttp.open("POST", "http://127.0.0.1:8010/api/fruits", true);
            zhttp.setRequestHeader('Content-type', 'application/json')
            zhttp.send(JSON.stringify(values));
        }
    </script>
</body>

</html>
