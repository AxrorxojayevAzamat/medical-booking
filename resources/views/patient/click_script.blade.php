
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
            tokenCreate.expire_date = $("#c_expire_month").val() + '/' + $("#c_expire_year").val();
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
                    console.log(data);
                    $("#sms-sent-btn-click").click(function (e) {
                        e.preventDefault();
                        let verifyToken = {};
                        verifyToken.transaction_id = clickOrderId;
                        verifyToken.card_token = data.data.card_token;
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
                                        console.log("urraaa")
                                    },
                                    error: function (data) {
                                        console.log(data);
                                        console.log("eehh")

                                    }
                                });
                                console.log(data)
                            },
                            error: function (data) {
                                console.log(data)
                            }
                        })



                    })

                },
                error: function (data) {
                    $('.sms-click').css('display','none');
                    $('.error-container').val(data.message);
                    console.log(data);
                }
            })
        })

</script>

