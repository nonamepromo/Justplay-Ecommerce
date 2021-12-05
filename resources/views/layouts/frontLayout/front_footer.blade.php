<!-- News Letter -->
<section class="news-letter style-2 padding-top-100 padding-bottom-100">
    <div class="container">
        <div class="heading light-head text-center margin-bottom-30">
            <h4>NEWSLETTER</h4>
            <span>Iscriviti per ricevere offerte sui nostri prodotti migliori </span> </div>
        <form action="javascript:void(0);" type="post">{{csrf_field()}}
            <input onfocus="enableSubscriber();" onfocusout="checkSubscriber();" name="subscriber_email" id="subscriber_email" type="email" style="outline: none"
                   placeholder="Inserisci la tua Email" required >
            <button onclick="checkSubscriber(); addSubscriber();" id="btnSubmit" type="submit" style="outline: none">UNISCITI</button>
            <div id="statusSubscribe" style="display: none;"></div>
        </form>
    </div>
</section><!--======= FOOTER =========-->
<footer>


    <div class="container">



        <!-- ABOUT Location -->
        <div class="col-md-3">
            <div class="about-footer"> <img class="margin-bottom-30" src="{{ asset ('images/frontend_images/logo3.png') }}" alt="" >
                <p><i class="icon-pointer"></i> Jagiellońska 74, 03-301 Warszawa,  <br>
                    Polonia.</p>
                <p><i class="icon-call-end"></i> +48225196900</p>
                <p><i class="icon-envelope"></i> media@cdprojektred.com</p>
            </div>
        </div>

        <!-- SHOP -->
        <div class="col-md-3">
            <h6>LINK UTILI</h6>
            <ul class="link">
                <li><a href="{{url('page/termini-condizioni')}}"> Termini & Condizioni</a></li>
                <li><a href="{{url('page/about-us')}}"> About Us</a></li>
                <li><a href="{{url('page/privacy-policy')}}"> Privacy</a></li>
                <li><a href="{{url('page/contact')}}"> Contattaci</a></li>
                <li><a href="{{url('page/politiche-reso')}}"> Politiche di reso</a></li>
            </ul>
        </div>
        <!-- Rights -->
        <div class="rights">
            <p>©  2020 JUSTPLAY Tutti diritti riservati. </p>
        </div>
    </div>
</footer>

<script>
    function checkSubscriber(){
        var subscriber_email = $("#subscriber_email").val();
        $.ajax({
            type:"post",
            url:'/check-subscriber-email',
            data:{subscriber_email:subscriber_email},
            success:function(resp){
                if(resp === "exists"){
                    $("#statusSubscribe").show();
                    $("#btnSubmit").show();
                    $("#statusSubscribe").html("<div style='padding: 25px'> &nbsp;</div><font color='red'><b>Errore: Email già registrata!</b></font>");
                }
            },error:function (){

            }
        });
    }

    function addSubscriber(){
        var subscriber_email = $("#subscriber_email").val();
        $.ajax({
            type:"post",
            url:'/add-subscriber-email',
            data:{subscriber_email:subscriber_email},
            success:function(resp) {
                if (resp === "exists") {
                    $("#statusSubscribe").show();
                    $("#btnSubmit").show();
                    $("#statusSubscribe").html("<div style=' padding: 25px'> &nbsp;</div><font color='red'><b>Errore: Email già registrata!</b></font>");

                } else if (resp === "saved"){
                $("#statusSubscribe").show();
                $("#statusSubscribe").html("<div style=' padding: 25px'> &nbsp;</div><font color='#90ee90'><b>Successo: Email registrata!</b></font>");
                }
            },error:function (){
                //alert("Error");
            }
        });
    }

    function enableSubscriber(){
        $("btnSubmit").show();
        $("#statusSubscribe").hide();
    }
</script>
