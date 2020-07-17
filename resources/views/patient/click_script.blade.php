
<script>

        $("#tokenCreate").click(function (e) {
            e.preventDefault();
            console.log("logings");

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Auth': '90671400913337'
                }
            });

            let tokenCreate = {};
            tokenCreate.transaction_id = clickOrderId;
            tokenCreate.card_token = $("#c_card_number").val();
            tokenCreate.expire_date = $("#c_expire_month").val() + $("#c_expire_year").val();
            console.log(tokenCreate);

            $.ajax({
                url: '/book/click/create-token',
                method: 'POST',
                data: tokenCreate,
                dataType: 'json',
                success: function (data) {
                    $('.sms-click').css('display','block');
                    $('.click').hide();
                    let card_token = data.data.card_token;
                    countDown(59, 'timerclickuz');
                    console.log(data);
                    $("#sms-sent-btn-click").click(function (e) {
                        e.preventDefault();
                        //timer needed
                        let verifyToken = {};
                        verifyToken.transaction_id = clickOrderId;
                        verifyToken.card_token = card_token;
                        verifyToken.sms_code = $("#sms_number").val();

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                'XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                'X-Auth': '90671400913337'
                            }
                        });
                        $.ajax({
                            url: '/book/click/verify-token',
                            method: 'POST',
                            data: verifyToken,
                            dataType: 'json',
                            success: function (data) {
                                let performOrder = {};
                                performOrder.transaction_id = clickOrderId;
                                performOrder.card_token = card_token;
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                        'XSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                        'X-Auth': '90671400913337'
                                    }
                                });
                                $.ajax({
                                    url: '/book/click/perform',
                                    method: 'POST',
                                    data: performOrder,
                                    dataType: 'json',
                                    success: function (data) {
                                        console.log(data);
                                        $('.successed').show();
                                        let reply = "{{ trans('book.book_id') }}" + data.data.book_id;
                                        $('.successed').val(reply);
                                    },
                                    error: function (data) {
                                        $('.error-container').show();
                                        $('.error-container').text(data.responseJSON.message);
                                        console.log(data);

                                    }
                                });
                                $('.error-container').show();
                                $('.error-container').text(data.responseJSON.message);
                                console.log(data);
                            },
                            error: function (data) {
                                $('.error-container').show();
                                $('.error-container').text(data.responseJSON.message);
                            }
                        })



                    })

                },
                error: function (data) {
                    $('.error-container').show();
                    $('.error-container').text(data.responseJSON.message);
                    console.log(data);
                }
            })
        })
        function disablingElements(id) {
            $(id).prop('disabled', true);
        }
        function countDown(secs, elem){
            var element = document.getElementById(elem);
            element.innerHTML = ""+secs+" ";
            if(secs < 1){
                clearTimeout(timer);
                disablingElements('#sms_number');
                disablingElements('#sms-sent-btn-click');
                return false;
            }
            secs--;
            var timer = setTimeout('countDown('+secs+',"'+elem+'")', 1000);
        }

</script>

