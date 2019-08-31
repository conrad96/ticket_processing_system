$(document).ready(function(){

    $("#add-user-save").click(function(e){
        var baseUrl = $("#base-url").val();
        var url =  baseUrl + 'index.php/super_admin/add_user';
        var data = $("#add-user").serialize();      
        
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            beforeSend: function(){
                $("#loader").html('<span style="padding-right: 100px;"><img src="'+baseUrl+'assets/gifs/loading.gif" style="width: 150px;height: 85px;" /></span>');
            },
            error: function(xhr, error, status){},
            success:function(data){
                $("#msg-detail").html(data);
                if(data === '<span class="alert alert-success">Account created successfully</span>'){
                    window.location.href = baseUrl + 'index.php/super_admin/users';
                }               
            }
        });
    });

    $("#dash-link").click(function(e){
        window.location.href = $("#base-url").val() + 'index.php/' + $("#role").val() + '/index';
    });

    $("#write-ticket").click(function(e){
        var baseUrl = $("#base-url").val();
        var url =  baseUrl + 'index.php/admin/add_ticket';
        var data = $("#ticket-form").serialize();      
        
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            beforeSend: function(){
                $("#loader").html('<span style="padding-right: 100px;"><img src="'+baseUrl+'assets/gifs/loading.gif" style="width: 150px;height: 85px;" /></span>');
            },
            error: function(xhr, error, status){},
            success:function(data){
                $("#msg-detail").html(data);
                console.log(data);
                if(data === '<span class="alert alert-success">Ticket added successfully</span>'){
                    window.location.href = baseUrl + 'index.php/admin/tickets';
                }               
            }
        });
    });

    $("#comment-text").keypress(function(e){
        $("#post-comment-form").submit(function(e){ e.preventDefault(); });

        if(e.which == 13){
            var baseUrl = $("#base-url").val();
            var url =  baseUrl + 'index.php/'+ $("#role").val() + '/post_comment';
            var data = $("#post-comment-form").serialize();  

            $.ajax({
                type: "POST",
                url: url,
                data: data,
                beforeSend: function(){
                    $("#avatar-pic").html('<img src="'+ baseUrl +'assets/gifs/loading.gif" style="width: 50px;height: 50px;" />');
                },
                success: function (data){
                   location.reload();
                },
                error: function(xhr, error, status){

                }
            });
        }
    });
});