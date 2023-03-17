/**
 * @link http://www.vishwayon.com/
 * @copyright Copyright (c) 2023 Vishwayon Software Pvt Ltd
 * @license MIT
 */

tpa = (window.tpa || {});

(function (tpa) {
    $(document).ready(function () {
        $('#formsubmit').click(function (event) {
            event.preventDefault();
            tpa.addlead();
            return false;
        });
    });

    function addlead() {
        var jsonData = {};
        var data = $('#leaddata').serializeArray();
        $(data).each(function (i) {
            jsonData[this.name] = this.value;
        });
        var leadData = jsonData;
        try {
            $.ajax({
                url: 'Server.php',
                method: 'POST',
                dataType: 'json',
                data: {'leadData': leadData},
                success: function (result) {
                    if (result.status === 'OK') {
                        alert('Lead added to CoreERP');
                    } else {
                        alert(result.message);
                    }
                },
                error: function (err) {
                    console.log(err.statusText);
                }
            });
        } catch (err) {
            console.log(err.message);
        }
    }
    tpa.addlead = addlead;

}(window.tpa));


 