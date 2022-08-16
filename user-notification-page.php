<?php include_once 'admin/header.php' ?>

<style>
    .note-msg{
        display: none;
    }
    #notImg{
        width: 50px;
        border-radius: 10px;
    }
    .notify{
        border: 1px solid #f8f9fa;
        border-radius: 10px;
        background: white;
    }
    .note-fs{
        font-size: 1rem;
        
    }

    @media screen and (max-width: 493px) {
        .note-fs{
        font-size: .8rem;
    }
    }

    .open-note{
        cursor: pointer;
    }
    .open-note:hover{
        opacity: .8;
        background-color: white;   
    }

    .seen0{
        font-weight: 1000;
        color: black!important;
    }
    .seen1{
        font-weight: lighter!important;
        
    }
</style>

<title>Notification page</title>
<?php include_once 'admin/navbar.php' ?>


                    <div class="container">
                        <div class="row bg-light">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8 align-items-center">
                                
                                <?php if(isset($_SESSION['id'])) : ?>
                                    
                                    <div class="notify p-3">
                                        <div class="mt-2 mb-5">
                                        <span class="page-title my-4">Notifications</span>
                                        <span id="mark-read" class="text-warning" title="mark all as read">
                                            Mark all as read
                                        </span>
                                        </div>
                                       
                                            <div id="note-body">
                                            <?php $results = getAllNote($_SESSION['id']) ?>
                                            <?php foreach($results as $index=>$result) : ?>
                                                
                                                
                                                <div> 
                                                    <div class="open-note p-2">
                                                        <button  id=<?php echo  $result['id'] ?>></button>
                                                        <span class="note-fs mx-2 text-secondary <?php echo "seen".strval($result['seen']) ?>">
                                                        <?php echo $result['first_name']." "; echo $result['last_name'] ?></span>
                                                        <span class="note-fs text-secondary <?php echo "seen".strval($result['seen']) ?>"><?php echo $result['title'] ?>
                                                        <span class="text-secondary mt-2" style="float: right;"><?php echo $result['created_at'] ?></span>
                                                    </div>
                                                    <div class="row mb-5 note-msg ">
                                                        <div class="col-sm-1">
                                                            <image id="notImg" src=<?php echo $result['image'] ?> >
                                                        </div>
                                                        <div class="col-sm-10">
                                                            
                                                            <div>
                                                            <span class="note mx-2 text-secondary <?php echo "seen".strval($result['seen']) ?>"><?php echo $result['first_name']." "; echo $result['last_name'] ?></span>
                                                            <span class="text-secondary mt-2 <?php echo "seen".strval($result['seen']) ?>"><?php echo $result['message'] ?></span>
                                                            
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                   
                                                    
                                                </div>
                                                <hr>
                                                
                                            <?php endforeach ?>
                                            </div>
                                       
                                            
                                         
                                        
                                            
                                        
                                        
                                    </div>
                                   
                                <?php endif ?>
                            </div>
                            <div class="col-sm-2"></div>
                        </div>
                    </div>
                
                 
                       


                      <!-- </div>
                  </div> -->


              


<?php include_once 'admin/footer.php' ?>

<script>
    //  var notification_id = document.querySelectorAll('.ous').value;
    //  console.log(notification_id)
   
    $(document).ready(function(){
        
        

        // getAllNotification(user_id);

       

       

        $("#note-body .open-note").click(function(){
            var _this = $(this);
            _this.siblings().slideToggle();

            $('.open-note').not(_this).siblings().slideUp();

           var notification_id = $(this).children("button").attr("id");
           
           $.ajax({
                url: 'includes/notification.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    read_one: 1, 
                    notification_id: notification_id,
                    
                },
                success: function(response){
                    // $("#note-body span").removeClass("seen0");
                    var result = reponse;
                    return result;
                }
            });

            $(this).children("span").removeClass('seen0');
            $(this).siblings().children().children().children("span").removeClass('seen0');
            

           
        });


        // AJAX for fetching notifications
        $("#mark-read").click(function(){
            
            $.ajax({
                url: 'includes/notification.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    read_all: 1, 
                    user_id: user_id,
                    
                },
                success: function(response){
                    $("#note-body span").removeClass("seen0");
                }
            });
                    
        }) 

        
        
        function getAllNotification(user_id){
            $.ajax({
                url: 'includes/notification.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    all_notification: 1, 
                    user_id: user_id,
                    
                },
                success: function(response){
                    $("#note-body").html(response);  
                    // console.log(response) 
                }
            });
        }   
        
    })


</script>
