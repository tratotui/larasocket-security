<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Socket io app</title>
</head>
<body>

    <ul class="chat"></ul>
    <hr> 
    <form>
        <textarea style="width:100%;height:50px"></textarea>
        <input type="submit" value="Отправить">
    </form>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.js"></script>
    <script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
    <script>

       var socket = io(':6001');


        function appendMessage(data) {
            $('.chat').append(
                $('<li/>').text(data.message)
            );
        }


        $('form').on('submit', function() {
            var text = $('textarea').val(),
                msg = {message : text};

            socket.send(msg);
            appendMessage(msg);

            $('textarea').val('');
            return false;
        });


        socket.on('message', function(data) {
            appendMessage(data);
        });


    </script>
    
</body>
</html>