"use strict";var txt_body=document.getElementsByClassName("div_text")[0],next=document.getElementsByClassName("next")[0],delay=100;next.addEventListener("click",function(){txt_body.style.left="-565px",setTimeout(function(){"-565px"===txt_body.style.left&&(txt_body.style.display="none",setTimeout(function(){txt_body.style.left="565px",txt_body.style.display="block",setTimeout(function(){txt_body.style.left="0px"},delay)},delay))},delay)});