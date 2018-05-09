(function() {
    'use strict';
    var canvas = document.getElementById('logo');
    var context = canvas.getContext('2d');
    context.font = 'bold italic 97px Georgia';
    context.textBaseline = 'top';
    var image = new Image();
    image.src = 'robin.gif';

    image.onload = function()
    {
        var gradient = context.createLinearGradient(0, 0, 0, 89)
        gradient.addColorStop(0.00, '#faa')
        gradient.addColorStop(0.66, '#f00')
        context.fillStyle = gradient
        context.fillText(  "R  bin's Nest", 0, 0)
        context.strokeText("R  bin's Nest", 0, 0)
        context.drawImage(image, 50, 32)
    }
})();

function checkUser(user)
{
    if (user.value == '')
    {
        $('#info').html('');
        return
    }

    $.ajax({
        type: 'POST',
        url: 'checkuser.php',
        data: {
            user: user.value
        },
        success: function(result) {
            $('#info').html(result);
        }
    });
}
