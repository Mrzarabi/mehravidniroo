<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <div id="app">
            <h1> @{{ fuck }} </h1>
        </div>
    <!-- production version, optimized for size and speed -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/vue"></script> --}}
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                fuck: "hi"
            }
        });
        
    </script>
</body>
</html>