@extends('layouts.student')

@section('content')


    
    <button>Download</button>
    <button>Print</button>
    <div class="container">
    <!-- <iframe src="https://docs.google.com/document/d/11-7CFVSP_DP1GcJIt--PYS_Urc8Iopq5GIy0XzeoWwg/edit?fbclid=IwAR1lVlHtfP2xie8-m_JpvTF7LH8GaLRiexr03an1l_MaQ66wtYMQ6hrz_T0"></iframe> -->
        
            <div>
                <!-- SOURCE -->
                <!-- <div id="printMe">
                    <h1>Print me!</h1>
                </div> -->
                <!-- OUTPUT -->
                <!-- <button @click="print"></button> -->
            </div>
        
    </div>

 
<script>
    // const App = new Vue({
    //     el:'#app',
    //     methods: {
    //         print() {
    //         // Pass the element id here
    //         // console.log("abc");
    //         this.$htmlToPaper('printMe');
    //         }
    //     }
        
    // })


</script> 
<script src="https://printjs-4de6.kxcdn.com/print.min.js"></script>
<!-- <link rel="stylesheet" type="text/css" href="pr"> -->

<span id="test">abcxyz</span>

 <button type="button" onclick="printJS('test', 'html')">
    Print Form
 </button>



@endsection