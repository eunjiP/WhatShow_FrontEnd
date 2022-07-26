<?php
    exec('C:\Users\Administrator\AppData\Local\Programs\Python\Python310\python.exe movieImage.py');

    
    $f_image = file("./movie_image.txt");
    $img_arr = [];
    foreach($f_image as $img) {
        $img_arr += explode("	",$img);
    }
    // $img_arr = explode("  ", $f_image);

    $f_title = file("./movie_title.txt");
    $title_arr = [];
    foreach($f_title as $title) {
        $title_arr += explode("	",$title);
    }

?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
    <title>Parallax</title>
    <style>
        @charset "utf8";

*{  box-sizing: border-box; margin: 0 auto; }
ul{ padding: 0; list-style: none; }
a{  text-decoration: none; color: #000; }

    body::-webkit-scrollbar { display:none; }

body{
    position: relative;
    background-color: #fff;
    margin: 0;
    padding: 0;
    -ms-overflow-style:none; 
}

.wrap{
    position: relative;
    max-width: 1440px;
    background-color: #fff;
    padding-top: 100vh;
}

.title{
    color: #fff;
}

.parallax_ex{
    position: fixed;
    top: 0; left: 0;
    width: 100%;
    height: 100vh;
    z-index: 1;
}

.parallax_txt1{
    position: absolute;
    top: 50%; left: 50%;
    transform: translate(-50%, -50%);
    display: inline-block;
    font-size: 50px;
    white-space: nowrap;
    transition: 0.22s; 
}

.main{
    position: relative;
    box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    background-color: #001216;
    z-index: 5;
}

section{
    position: relative;
    width: 100%;
    height: 700px;
    z-index: 99;
    font-size: 0;
}


.parallax_txt2, .parallax_txt3, .parallax_txt4, .parallax_txt5, .test{
    position: absolute;
    display: inline-block;
    font-size: 40px;
    transition: 0.5s ease;
}

.parallax_txt2{ 
    color: #c57f1e; 
    top: 35%; 
    left: -70%; }

/* .container{ 
    top: 45%; 
    left: -70%; 
    opacity: 0; } */

.parallax_txt3{ 
    color: #c57f1e; 
    top: 35%; 
    right: -70%; }

.parallax_txt4{ 
    color: #c57f1e; 
    top: 35%; 
    left: 65%; 
    opacity: 0; 
    transform: translate(-50%, -50%); }

.parallax_txt5{ 
    color: #c57f1e; top: 100%;
    left: 50%; 
    transform: translate(-50%, 0);
    opacity: 0;
}

.container {
    position: relative;
    right: 0;
}

li{
    display: flex;
    border : 1px solid white;
    color:azure;
    width: 200px;
    height:300px;

    transform-style: preserve-3d;
    transition: all 1s;
}

/* li > section{
    position: relative;
    text-align: center;
} */

li:hover{
    transform: rotateY(180deg);
}

li img{
    height: 300px;
    width: 200px;
    padding-top: 5px;
}

li:hover img{
    background:linear-gradient(
        to right,
        rgba(20, 20, 20, 0) 20%,
        rgba(20, 20, 20, 0.25) 25%,
        rgba(20, 20, 20, 0.5) 50%,
        rgba(20, 20, 20, 0.75) 75%,
        rgba(20, 20, 20, 1) 100%
        );
}

li:hover .frontli{
    z-index: 1;
    display: none;
}
li:hover .backli{
    z-index: 2;
}

li:hover button{
    display: inline-block;
}

.frontli{ 
    position: absolute; 
    z-index: 2;
    transform: rotateY(0deg);}

.backli{ 
    position: absolute; 
    z-index: 1;
    transform: rotateY(180deg);
}
span{
    color: white;
}

    </style>
</head>
<body>
    <div class="parallax_ex">
        <h1 class="parallax_txt1">What Show</h1>
    </div>

    <div class="wrap">
        
        <main class="main">
            <section class="sec1">
                <h2 class="parallax_txt2">Top Rank 10</h2>
                <div class="container">
                    <ul class="col row-cols-4 justify-content-sarte">
                        <?php
                        $num = 1;
                        for ($i=0; $i < 11; $i++) { ?>
                            <li class="col">
                                <section class="frontli">
                                    <span><?=$num++?></span>
                                    <img src="<?=$img_arr[$i]?>">
                                    <div style="height: 100px"><?=$title_arr[$i]?></div> 
                                </section>
                                <section class="backli">
                                    <img src="<?=$img_arr[$i]?>" style="opacity: 0.2;"> 
                                    <button>예매 하기</button>
                                </section>    
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </section>
            <section class="sec2">
                <h2 class="parallax_txt3">New Movie</h2>
            </section>
            <section class="sec3">
                <h2 class="parallax_txt4">News</h2>
            </section>
            <section class="sec4">
                <h2 class="parallax_txt5">Made by</h2>
            </section>
        </main>
    </div>


<script>
    var tl = gsap.timeline();
        tl.to(".parallax_txt1", { duration: 1, x: 200, ease: 'steps(10)' });
        tl.to(".parallax_txt1", {duration: 1, y: 200, opacity: 1, borderRadius:10 });
        tl.to(".parallax_txt1", { duration: 1, x: 0, width: 400, backgroundColor: '#001216', fontSize: '2rem', color:'white' });
        tl.to(".parallax_txt1", { duration: 1, y: 0, height: 400});
        tl.to(".parallax_txt1", { duration: 1, y: 0, backgroundColor: 'white', color:'#c57f1e'});

    


const p_ex1 = document.querySelector(".parallax_txt1");
const p_ex2 = document.querySelector(".parallax_txt2");
const p_ex3 = document.querySelector(".parallax_txt3");
const p_ex4 = document.querySelector(".parallax_txt4");
const p_ex5 = document.querySelector(".parallax_txt5");

const test = document.querySelector(".test");
let timer;

window.scroll({top : 0, behavior: 'smooth'});


document.addEventListener('scroll', (e) =>{

    if(!timer){

        timer = setTimeout(()=>{
            timer = null;

            let top = document.documentElement.scrollTop;
            console.log(top)
            if(window.scrollY < 10){
                p_ex1.style.fontSize = '50px';
            }
            if(window.scrollY > 10){
                p_ex1.style.fontSize = '70px';
            }
            if(window.scrollY > 130){
                p_ex1.style.fontSize = '90px';
            }
            if(window.scrollY > 250){
                p_ex1.style.fontSize = '110px';
            }
            if(window.scrollY > 390){
                p_ex1.style.fontSize = '130px';
                p_ex1.style.transform = 'translate(-50%, -50%) rotate(0deg)';
                p_ex1.style.top = '50%';
                p_ex1.style.left = '50%';
            }
            if(window.scrollY < 500){
                p_ex2.style.left = '-100%';
                test.style.left = '-100%';
                test.style.opacity = '1';
            }
            if(window.scrollY > 500){
                p_ex2.style.left = '10%';
                test.style.left = '10%';
            }
            if(window.scrollY > 1000){
                p_ex1.style.transition = '0.22s ease';
                p_ex1.style.fontSize = '80px';
                p_ex1.style.transform = 'translate(-50%, -50%) rotate(90deg)';
                p_ex1.style.top = '60%';
                p_ex1.style.left = '50%';
            }
            if(window.scrollY < 1200){
                p_ex3.style.right = '-70%';
            }
            if(window.scrollY > 1200){
                p_ex3.style.right = '10%';
            }
            if(window.scrollY > 1300){
                p_ex1.style.transition = '0.7s ease';
                p_ex1.style.transform = 'translate(-50%, -50%) rotate(90deg)';
                p_ex1.style.left = '5%';
            }
            if(window.scrollY < 2100){
                p_ex4.style.opacity = '0';
                p_ex4.style.left = '65%';
            }
            if(window.scrollY > 2100){
                p_ex4.style.opacity = '1';
                p_ex4.style.left = '50%';
            }
            if(window.scrollY > 2600){
                p_ex5.style.opacity = '1';
                p_ex5.style.top = '50%';
            }
        if(window.scrollY < 2600){
                p_ex5.style.opacity = '0';
                p_ex5.style.top = '100%';
            }
            
        }, 100);

    }
});

</script>
</body>
</html>