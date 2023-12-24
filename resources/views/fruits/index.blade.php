<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>New Fruit</title>
</head>

<body onload="index()">
    <div class="container mt-5">
        <h2>
            All fruits
        </h2>
        <button type="button" class="btn p-0 mb-2" onclick="index()">Refresh</button>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody id="fruit-table">

            </tbody>
        </table>
        <div id="edit">

        </div>
        <div id="response"></div>

    </div>


    <script>
        function index() {
            var zhttp = new XMLHttpRequest();
            zhttp.open("GET", "http://127.0.0.1:8010/api/fruits", true);
            zhttp.setRequestHeader('Content-type', 'application/json');
            zhttp.send();
            zhttp.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                    var data = JSON.parse(zhttp.responseText);
                    var table = "";
                    for (var i = 0; i < data.length; i++) {
                        table += "<tr><th scope=\"row\">" + (i + 1) + "</th><td>" + data[i].name + "</td><td>" + data[i]
                            .price + "</td><td><button type=\"button\" class=\"btn py-0 px-2 mb-2\" onclick=\"edit(" +
                            data[i]
                            .id +
                            ")\">Edit</button><button type=\"button\" class=\"btn py-0 px-2  mb-2\" onclick=\"destroy(" +
                            data[i].id +
                            ")\">Delete</button></td></tr>"
                    }
                    document.getElementById("fruit-table").innerHTML = table;
                }
            };
        }

        function edit(id) {
            var zhttp = new XMLHttpRequest();
            // api/fruits/{fruit}/edit
            zhttp.open("GET", "http://127.0.0.1:8010/api/fruits/" + id + "/edit", true);
            zhttp.setRequestHeader('Content-type', 'application/json');
            zhttp.send();
            zhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var oldData = JSON.parse(zhttp.responseText);
                    var editTable =
                        "<label for=\"name\">Name</label><input type=\"text\" name=\"name\" id=\"name\" value=\"" +
                        oldData.name +
                        "\"><br><label for=\"price\">Price</label><input type=\"text\" name=\"price\" id=\"price\" value=\"" +
                        oldData.price +
                        "\"><br><button type=\"button\" class=\"btn btn-primary mt-3\" onclick=\"update(" + id +
                        ")\">Update</button>";
                    document.getElementById("edit").innerHTML = editTable;

                }
            }
        }

        function update(id) {
            var zhttp = new XMLHttpRequest();
            const values = {
                name: document.querySelector('#name').value,
                price: document.querySelector('#price').value
            }
            zhttp.open("PATCH", "http://127.0.0.1:8010/api/fruits/" + id, true);
            zhttp.setRequestHeader('Content-type', 'application/json');
            zhttp.send(JSON.stringify(values));
            zhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("edit").innerHTML = "";
                    index();
                }
            }
        }

        function destroy(id) {
            var zhttp = new XMLHttpRequest();
            zhttp.open("DELETE", "http://127.0.0.1:8010/api/fruits/" + id, true);
            zhttp.setRequestHeader('Content-type', 'application/json');
            zhttp.send();
            zhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    index();
                }
            }
        }
    </script>
</body>

</html>
