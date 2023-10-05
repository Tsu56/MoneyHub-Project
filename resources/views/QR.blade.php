<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- custom css file link  -->
    <link rel="stylesheet"  href="{{ asset('/css/QR.css') }}">

</head>
<body>

<div class="container">
    
    <form action="{{ route('moneyhub.Qrcodelink') }}">
        
        <div class="row">
             <h1 class="h1 text-center">จ่ายเงินเข้าใช้พรีเมียม</h1>
            <H2>สแกน QR CODE</H2>
            <div class="col">
             
                <div id="image-container">
                    <img src="{{ asset('/img/QR2.png') }}" class="qr" alt="คำอธิบายรูปภาพ">
                    
                </div>
                
            

            <div class="col">
       

                <div class="flex">
                    
                    
                </div>

            </div>
    
        </div>

        <input type="submit" value="เสร็จสิ้น" class="submit-btn">

    </form>

</div>    
    
</body>
</html>